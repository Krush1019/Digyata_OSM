/*
 filename: client-profile.js
 author: digyata
*/
//------------------------------------------------------------------------------------------------

$(document).ready(function () {

  //change password model validation
  $('#changepasswdbtn').click(function () {
    $('#changepasswdform').validate({

      rules: {
        odpasswd: {
          required: true,
          minlength: 5
        },
        nwpasswd: {
          required: true,
          minlength: 5
        },
        cnfnewpasswd: {
          required: true,
          equalTo: nwpasswd
        }
      },
      messages: {
        odpasswd: {
          required: "Please enter the old password.",
          minlength: "Your password must be at least 5 characters long."
        },
        nwpasswd: {
          required: "Please enter the new password.",
          minlength: "Your password must be at least 5 characters long."
        },
        cnfnewpasswd: {
          required: "Please confirm new password.",
          equalTo: "New password and confirm new password must be same."
        }
      },
      submitHandler:  function(form){
        form.submit();
        $('#changepasswdmodel').hide();
      }
    })
  });

  //password show-hide button
  $('#nwpasswd').focus(function () {
    if ($('#btn1').is(':hidden')){
      $('#btn1').removeAttr('hidden');
    }
  });
  $('#btn1').click(function () {
    if ( $(this).text() === 'show'){
      $('#nwpasswd').attr('type', 'text');
      $(this).text('hide');
    } else {
      $('#nwpasswd').attr('type', 'password');
      $(this).text('show');
    }
  });

  //change password model reset on close
  $('#changepasswdmodel').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset').validate().resetForm();
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
          // matches: "(0/91)?[7-9][0-9]{9}"
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
          required: "Please enter the mobile no.",
          // matches: "Mobile No. must have 10 digit.",
        },
        cl_email: {
          required: "Please enter your Email Address",
          email: "Please enter a valid email address"
        }
      },
      submitHandler:  function(form){
        form.submit();
        $('#clientimgupload').submit();
      }
    })
  });

})
