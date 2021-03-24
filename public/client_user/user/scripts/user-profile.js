/*
 filename: user-profile.js
 author: digyata
*/
//------------------------------------------------------------------------------------------------

$(document).ready(function () {

      //State options
      $("#us_state").append(
            '<option value="-1" disabled>Select State</option>'
      );
      var url = "/data/Text File/states.txt";
      $.get(url, function (data) {
            var arr = data.split(",");
            $.each(arr, function (key, entry) {
                  if (entry === 'Gujarat') {
                        var text = 'selected'
                  } else {
                        text = '';
                  }
                  $("#us_state").append(
                        '<option value="' + entry + '" ' + text + '>' + entry + "</option>"
                  );
            });
      });

      //On click Edit Image Hide/Show Div
      /* $(document).on('click', '#us-edit-photo', function () {
            $('#edit-photo-div').removeAttr('hidden');
            if (!($(this).siblings().is('#remove-photo'))) {
                  $(this).after('<button type="button" class="btn_1 bg-secondary btn-secondary smaller ml-md-2" id="remove-photo">Remove Image</button>');
            }
            $(this).text('Update Image');   
      }); */

      //on change gender bold class toggle
      $(document).on('change', 'input[name = gender]', function () {
            $(this).siblings('label').addClass('font-weight-bold');
            $('input[name = gender]').not(':checked').siblings('label').removeClass('font-weight-bold');
      });

      //On click Edit Password Hide/Show Div
      $(document).on('click', '#chngpswdbtn, #cncpswdbtn', function () {
            $('#chngepassworddiv').toggleClass('display-hidden');
      });

      //remove profile image
      /* $(document).on('click', '#remove-photo, #clspassbtn', function () {
            $('#user-propic').attr('src', '/client_user/client/img/avatar.jpg')
      });
   */
      //profile form Validation
      
    /*         $('#updt-prof-btn').click(function () {
            $('#profile-update-form').validate({

                  rules: {
                        name: 'required',
                        gender: "required",
                        mobile: {
                              required: true,
                              number: true,
                              minlength: 10,
                              maxlength: 10
                        },
                        email: {
                              required: true,
                              email: true
                        },
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
                              equalTo: '#us_new_pswd'
                        }
                  },
                  messages: {
                        name: "Please enter your Name",
                        gender: "Please select your Gender",
                        mobile: {
                              required: "Please enter your mobile no.",
                              minlength: "Mobile No. must have 10 digit",
                              maxlength: "Mobile No. must have 10 digit",
                              number: "Please enter only digits",
                        },
                        email: {
                              required: "Please enter your Email Address",
                              email: "Please enter a valid email address"
                        },
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
      })*/
 

})