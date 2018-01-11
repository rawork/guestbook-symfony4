<?php

namespace App\Controller;

use App\Entity\Guestbook;
use App\Form\GuestbookType;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\Serializer;

class GuestbookController extends Controller
{
    /**
     * @Route("/guestbook/{page}", name="guestbook", requirements={"page"="\d+"})
     */
    public function index(Request $request, $page = 1)
    {
        $sortTypes = ['username' => 'ASC', 'email' => 'ASC', 'id' => 'DESC'];

        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'DESC');
        if (!in_array($sort, array_keys($sortTypes)) ) {
            $this->redirectToRoute('guestbook');
        }
        $sortTypes[$sort] = $order == 'ASC' ? 'DESC' : 'ASC';
        $messages = $this->getDoctrine()
            ->getRepository(Guestbook::class)
            ->getAllMessages($page, $sort, $order, $this->container->getParameter('guestbook.rpp'));
        $totalMessages = $messages->count();
        $maxPages = ceil($messages->count() / 25);
        $currentPage = $page;
        $sortOrder = $order == 'DESC' ? '&darr;' : '&uarr;';

        return $this->render('Guestbook/index.html.twig', compact('messages', 'currentPage', 'totalMessages', 'maxPages', 'sort', 'sortTypes', 'sortOrder', 'order'));
    }

    /**
     * @Route("/guestbook/create", name="guestbook_create", methods={"GET", "POST"})
     */
    public function create(Request $request)
    {
        $message = new Guestbook();
        $data = ['error' => false];

        $form = $this->createForm(GuestbookType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $this->captchaVerify($request->get('g-recaptcha-response'))) {
            $message = $form->getData();
            $message->setBrowser($this->getBrowserName());
            $message->setIp($_SERVER['REMOTE_ADDR']);
            $message->setCreated(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            $data['message'] = $this->get('serializer')->normalize($message);

            return $this->json($data);
        } elseif ('POST' == $_SERVER['REQUEST_METHOD']) {
            $data['error'] = true;
        }

        $formview = $form->createView();
        $data['form'] = $this->container->get('twig')->render('Guestbook/create.html.twig', compact('formview'));

        return $this->json($data);
    }

    /*
     * Get success response from recaptcha and return it to controller
     */
    protected function captchaVerify($recaptcha)
    {
        $url = $this->container->getParameter('recaptcha.url');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            "secret" => $this->container->getParameter('recaptcha.secret_key'),
            "response" => $recaptcha
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);

        return $data->success;
    }

    /*
     * Helper function to get browser name, in real project must be separated to Special Helper class
     */
    protected function getBrowserName()
    {
        $userAgent = $_SERVER["HTTP_USER_AGENT"];
        if (strpos($userAgent, "Firefox") !== false) {
            $browser = "Firefox";
        } elseif (strpos($userAgent, "Opera") !== false) {
            $browser = "Opera";
        } elseif (strpos($userAgent, "Chrome") !== false) {
            $browser = "Chrome";
        } elseif (strpos($userAgent, "MSIE") !== false) {
            $browser = "Internet Explorer";
        } elseif (strpos($userAgent, "Safari") !== false) {
            $browser = "Safari";
        } else {
            $browser = "Unknown";
        }

        return $browser;
    }
}
