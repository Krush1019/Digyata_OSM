/*
 File Name: custom.js
 */
//-------------------------------------------------------------------------------------------


$(document).ready(function () {


  $('#user-login-modal').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset').validate().resetForm();
    $('#signIn-form').show();
    $('#forgot_pw-form').attr('hidden', 'hidden');
  });

  $('#forgot').click(function () {
    $('#signIn-form').hide();
    $('#forgot_pw-form').removeAttr('hidden');
  })

  $('#backlgbtn').click(function () {
    $('#signIn-form').show();
    $('#forgot_pw-form').attr('hidden', 'hidden');
  })

  $(document).on('keyup' , function(e){
    if (e.keyCode === 27 ){
      $('#user-login-modal').modal('hide');
    }
})   

})
