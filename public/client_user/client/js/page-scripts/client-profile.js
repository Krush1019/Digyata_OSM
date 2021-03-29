/*
 filename: client-profile.js
 author: digyata
*/
//------------------------------------------------------------------------------------------------

$(document).ready(function () {

  //change password model validation
  /* $('#changepasswdbtn').click(function () {
    alert("hello");

    $('#changepasswdform').validate({

      rules: {
        oldpassword: {
          required: true,
          minlength: 6
        },
        newpassword: {
          required: true,
          minlength: 6
        },
        confirmnewpassword: {
          required: true,
          equalTo: '#cl_new_pswd'
        }
      },
      messages: {
        oldpassword: {
          required: "Please enter the old password.",
          minlength: "Your password must be at least 5 characters long."
        },
        newpassword: {
          required: "Please enter the new password.",
          minlength: "Your password must be at least 5 characters long."
        },
        confirmnewpassword: {
          required: "Please confirm new password.",
          equalTo: "New password and confirm new password must be same."
        }
      },
      submitHandler:  function(form){
        form.submit();
      }
    })
  }); */

  $('#changepasswdbtn').click(function () {
    $('#changepasswdform').validate({

      rules: {
        oldpassword: {
          required: true,
          minlength: 6
        },
        newpassword: {
          required: true,
          minlength: 6
        },
        confirmnewpassword: {
          required: true,
          equalTo: "#cl_new_pswd"
        }
      },
      messages: {
        oldpassword: {
          required: "Please enter the old password.",
          minlength: "Your password must be at least 6 characters long."
        },
        newpassword: {
          required: "Please enter the new password.",
          minlength: "Your password must be at least 6 characters long."
        },
        confirmnewpassword: {
          required: "Please confirm new password.",
          equalTo: "New password and confirm new password must be same."
        }
      },
      submitHandler: function (form) {
        form.submit();
      }
    });
  })


  /* 
  //change password model reset on close
  $('#changepasswdmodel').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset').validate().resetForm();
  });
//password show-hide button
  $('.new-password').focus(function () {
    if ($('#btn1').is(':hidden')){
      $('#btn1').removeAttr('hidden');
    }
  });
  $('#btn1').click(function () {
    if ( $(this).text() === 'show'){
      $('.new-password').attr('type', 'text');
      $(this).text('hide');
    } else {
      $('.new-password').attr('type', 'password');
      $(this).text('show');
    }
  });
 */

  $(document).on('click', '.cncpswdbtn', function () {
    $('#chngepassworddiv').toggleClass('display-hidden');
  });

  //client detail form validation
  $('#updtClientDtlbtn').click(function () {
    $('#updateClientDetail').validate({
      rules: {
        cl_name: 'required',
        cl_lname: 'required',
        _gender: "required",
        cl_mobile: {
          required: true,
          number: true,
          minlength: 10,
          maxlength: 10
        },
        cl_email: {
          required: true,
          email: true
        }
      },
      messages: {
        cl_name: "Please enter your First Name",
        cl_lname: "Please enter your Last Name",
        User_gender: "Please select your Gender",
        cl_mobile: {
          required: "Please enter your mobile no.",
          minlength: "Mobile No. must have 10 digit",
          maxlength: "Mobile No. must have 10 digit",
          number: "Please enter only digits",
        },
        cl_email: {
          required: "Please enter your Email Address",
          email: "Please enter a valid email address"
        }
      },
      submitHandler: function (form) {
        form.submit();
        $('#clientimgupload').submit();
      }
    })
  });

})
