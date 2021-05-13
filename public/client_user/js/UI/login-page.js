/*
 File Name: login-page.js
 */
//-------------------------------------------------------------------------------------------


$(document).ready(function () {

      $(".toggle-password").on('click', function (e) {
            e.preventDefault();
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                  input.attr("type", "text");
            } else {
                  input.attr("type", "password");
            }
      });

      if ($('#login-form').prop('action') == window.location.origin + '/login/client') {
            link();
      };

      //on user radio click
      $(document).on('click', '#radio_user', function () {
            console.log($(this));
            $('#radio_user label').addClass('selected');
            $('#radio_client label').removeClass('selected');
            $('#login-form').attr('action', "/login/customer")
                  .find('p').text('Login as a Customer');
            $('#login-form strong a').attr('href', "/register/customer");
            $('#forgot').attr('href', "/login/forgot/customer");
            $('.social_bt.google').attr('href', "login/google/customer");
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
      $('#forgot').attr('href', "/login/forgot/client");
      $('.social_bt.google').attr('href', "login/google/client");
}
