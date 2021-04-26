/*
 File Name: login-page.js
 */
//-------------------------------------------------------------------------------------------


$(document).ready(function () {

      if ($('#login-form').prop('action') == 'http://127.0.0.1:8000/login/client') {
            link();
      };

      //on user radio click
      $(document).on('click', '#radio_user', function () {
            $('#radio_user label').addClass('selected');
            $('#radio_client label').removeClass('selected');
            $('#login-form').attr('action', "/login/customer")
                  .find('p').text('Login as a Customer');
            $('#login-form strong a').attr('href', "/register/customer");

      });


      //on client radio click
      $(document).on('click', '#radio_client', link);
});

function link() {
      $('#radio_client label').addClass('selected');
      $('#radio_user label').removeClass('selected');
      $('#login-form').attr('action', "/login/client")
            .find('p').text('Login as a Client');
      $('#login-form strong a').attr('href', "/register/client");
}
