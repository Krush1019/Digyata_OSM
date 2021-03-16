/*=========================================================================================
    File Name: contact.js
    Author: Digyata
==========================================================================================*/

$(document).ready( function () {

  // Jquery validate form contact
  $('#contactform').submit(function () {

    var action = $(this).attr('action');

    $("#message-contact").slideUp(750, function () {
      $('#message-contact').hide();

      $('#submit-contact')
        .after('<i class="icon_loading loader"></i>')
        .attr('disabled', 'disabled');

      $.post(action, {
          name_contact: $('#name_contact').val(),
          email_contact: $('#email_contact').val(),
          message_contact: $('#message_contact').val(),
          verify_contact: $('#verify_contact').val()
        },
        function (data) {
          document.getElementById('message-contact').innerHTML = data;
          $('#message-contact').slideDown('slow');
          $('#contactform .loader').fadeOut('slow', function () {
            $(this).remove()
          });
          $('#submit-contact').removeAttr('disabled');
          if (data.match('success') != null) $('#contactform').slideUp('slow');

        }
      );
    });
    return false;
  });


})
