let $ = require('jquery')
global.$ = global.jQuery = $
require('../vendor/bootstrap/js/bootstrap.min')

$('.btn-create').on('click', function (e) {
    e.preventDefault()
    $.get('/guestbook/create?_=' + new Date().getTime(), function(data){
        if (!data.error) {
          $('.modal-body').html(data.form)
          $('#myModal').modal('show')
          console.log('opened modal')
        }
    }, 'json');
})

$(document).on('click', '.btn-cancel', function(e) {
  e.preventDefault();
  $('#myModal').modal('hide')
})

$(document).on('keypress', '#guestbook_username', function(event){
  let ew = event.which;
  if(48 <= ew && ew <= 57)
    return true;
  if(65 <= ew && ew <= 90)
    return true;
  if(97 <= ew && ew <= 122)
    return true;

  return false;
})

$(document).on('submit', '.guestbook-create', function(e) {
  e.preventDefault();
  let $form = $(this)
  $form.find('.btn').prop('disabled', true);



  let fd = new FormData(this)
  $.ajax({
    url: $form.attr('action'),
    data: fd,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function(data){
      console.log(data)
      if (data.error) {
        $('.modal-body').html(data.form)
        // $form.siblings('.alert').remove()
        // let errorBlock = $('<div />').addClass('alert alert-danger').html(data.errorText)
        // $form.before(errorBlock.get(0).outerHTML)
        // $form.find('.btn').prop('disabled', false)
        return
      }

      let dt = new Date(data.message.created)
      const date = (dt.getDate() < 10 ? "0" : "") + (dt.getDate())
      const month = (dt.getMonth() < 10 ? "0" : "") + (dt.getMonth() + 1)
      const year = dt.getFullYear()
      const hour = (dt.getHours() < 10 ? "0" : "") + dt.getHours()
      const minutes = (dt.getMinutes() < 10 ? "0" : "") + dt.getMinutes()
      const fullDate = date + '.' + month + '.' + year + ' ' + hour + ':' + minutes

      let $tr = $('<tr />')
        .append('<td>' + data.message.id + '</td>')
        .append('<td>' + data.message.username + '<br><small>Browser: ' + data.message.browser + ',<br>IP: ' + data.message.ip + '</small></td>')
        .append('<td>' + data.message.email + '</td>')
        .append('<td><a target="_blank" href="' + data.message.homepage + '">' + data.message.homepage + '</a></td>')
        .append('<td>' + data.message.message + '</td>')
        .append('<td>' + fullDate + '</td>')

      let $table = $('.table').prepend($tr.get(0).outerHTML)
      $('h6>span').html(+$('h6>span').html()+1)
      if ($table.find('tr').length > 25) {
        $table.find('tr:last-child').remove()
      }
      $form.find('input, textarea').val('')
      $('#myModal').modal('hide')
      grecaptcha.reset()
    }
  })

})

$(document).ready(function () {
    console.log('test app.js')
})
