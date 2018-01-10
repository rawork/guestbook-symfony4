<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GuestbookRepository")
 * @ORM\Table(name="guestbook", indexes={@ORM\Index(name="username", columns={"username"}), @ORM\Index(name="ip", columns={"ip"}), @ORM\Index(name="email", columns={"email"})})
 */
class Guestbook
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer", options={"unsigned"=true})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=190)
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9]+/")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=190)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="homepage", type="string", length=255)
     * @Assert\Url()
     */
    private $homepage;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     * @Assert\NotBlank()
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="browser", type="string", length=255)
     */
    private $browser;

    /**
     * @var integer
     *
     * @ORM\Column(name="ip", type="integer", options={"unsigned"=true})
     */
    private $ip;

    /**
     * @var \Datetime $created
     *
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * @param string $homepage
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = strip_tags($message);
    }

    /**
     * @return string
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * @param string $browser
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return long2ip($this->ip);
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = ip2long($ip);
    }

    /**
     * @return \Datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \Datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }
}
