/*=========================================================================================
    File Name: client-register.js
    Author: Digyata
==========================================================================================*/

$(document).ready( function () {

  //Client Register validation
  $('#submit-register').click(function () {
    $('#Client-register').validate({
      rules: {
        name_register: "required",
        email_register: {
          required: true,
          email: true
        },
        mobile_register: {
          required: true,
          matches: "(0/91)?[7-9][0-9]{9}"
        },
        gender_register: "required",
        password_register: {
          required: true,
          minlength: 5
        },
        Cnf_password_register: {
          required: true,
          equalTo: 'password_register'
        },
        location_register : "required",
        captcha_register: {
          required: true,
        }
      },

      messages: {
        name_register: "Please enter your Name",
        email_register: {
          required: "Please enter your Email Address",
          email: "Please enter a valid email address"
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
        mobile_register: {
          required: "Please enter your Mobile No.",
          matches: "Mobile No. must have 10 digit",
        },
        gender_register: "Please select your Gender",
        Cnf_password_register: {
          required: "Please enter a confirm password",
          equalTo: "Password and Confirm Password must be same"
        },
        location_register : "Please enter your Location.",
        captcha_register: {
          required: "Please enter the captcha."
        }
      },
      submitHandler: function(form) {
        form.submit();
        window.location.replace('/client-dashboard');
      }
    });
  })


})
