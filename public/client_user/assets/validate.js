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


/* //SignIn-Modal Validation
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
}) */
