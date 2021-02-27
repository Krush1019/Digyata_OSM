/* <![CDATA[ */

/// Jquery validate newsletter
$('#newsletter_form').submit(function () {

	var action = $(this).attr('action');

	$("#message-newsletter").slideUp(750, function () {
		$('#message-newsletter').hide();

		$('#submit-newsletter')
			.after('<i class="icon_loading loader newsletter"></i>')
			.attr('disabled', 'disabled');

		$.post(action, {
				// email_newsletter: $('#email_newsletter').val()
			},
			function (data) {
				document.getElementById('message-newsletter').innerHTML = data;
				$('#message-newsletter').slideDown('slow');
				$('#newsletter_form .loader').fadeOut('slow', function () {
					$(this).remove()
				});
				$('#submit-newsletter').removeAttr('disabled');
				if (data.match('success') != null) $('#newsletter_form').slideUp('slow');

			}
		);

	});
	return false;
});

// Jquery validate form register
// $('#submit-register').submit(function(){
//
// 		$("#message-register").slideUp(750,function() {
// 		$('#message-register').hide();
//
//  		$('#submit-register')
// 			.after('<i class="icon_loading loader register"></i>')
// 			.attr('disabled','disabled');
//
//
// 			}
// 		);
// });

//Client Register
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

//User-register
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

//SignIn-Modal Validation
$('#signIn-submit').click(function () {
  $('#signIn-form').validate(
    {
      rules: {
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 5
        }
      },
      messages: {
        email: {
          required: "Please enter your email address.",
          email: "Please enter a valid email address."
        },
        password: {
          required: "please enter the password.",
          minlength: "Your password must be at least 5 characters long."
        }
      },
      submitHandler: function (form) {
        form.submit();
        window.location.replace('/user-dashboard');
      }

    }
  );
})

//Reset Password Validation
$('#repasswdbtn').click(function () {
  $('#forgot_pw-form').validate(
    {
      rules: {
        email_forgot: {
          required: true,
          email: true
        }
      },
      messages: {
        email_forgot: {
          required: "Please enter your email address.",
          email: "Please enter a valid email address."
        }
      },
      submitHandler: function (form) {
        form.submit();
      }

    }
  );
})
