/*=========================================================================================
    File Name: user-register.js
    Author: Digyata
==========================================================================================*/

$(document).ready( function () {

  //User-register validation
  $('#User-register').validate({
    rules: {
      User_fname: "required",
      User_lname: "required",
      User_gender: "required",
      User_email: {
        required: true,
        email: true
      },
      User_mobile: {
        required: true,
        matches: "[7-9][0-9]{9}"
      },
      User_password: {
        required: true,
        minlength: 5
      },
      User_cnf_password: {
        required: true,
        equalTo: 'password_register'
      },
      User_captcha: {
        required: true,

      }
    },

    messages: {
      User_fname: "Please enter your First Name",
      User_lname: "Please enter your Last Name",
      User_gender: "Please select your Gender",
      User_email: {
        required: "Please enter your Email Address",
        email: "Please enter a valid email address"
      },
      User_password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      User_mobile: {
        required: "Please enter your Mobile No.",
        matches: "Mobile No. must have 10 digit.",
      },
      User_cnf_password: {
        required: "Please enter a confirm password.",
        equalTo: "Password and Confirm Password must be same."
      } ,
      User_captcha: {
        required: "Please Enter Captcha Code"
      }
    },
    submitHandler: function(form) {
      form.submit();
      window.location.replace('/user-dashboard');
    }
  });

})
