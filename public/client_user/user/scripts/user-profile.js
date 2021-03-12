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
      var url = "data/Text File/states.txt";
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
      $(document).on('click', '#us-edit-photo', function () {
            $('#edit-photo-div').removeAttr('hidden');
            if (!($(this).siblings().is('#remove-photo'))) {
                  $(this).after('<button type="button" class="btn_1 bg-secondary btn-secondary smaller ml-md-2" id="remove-photo">Remove Image</button>');
            }
            $(this).text('Update Image');
      });

      //on change gender bold class toggle
      $(document).on('change', 'input[name = us_gender]', function () {
            $(this).siblings('label').addClass('font-weight-bold');
            $('input[name = us_gender]').not(':checked').siblings('label').removeClass('font-weight-bold');
      })

      //On click Edit Password Hide/Show Div
      $(document).on('click', '#chngpswdbtn, #cncpswdbtn', function () {
            $('#chngepassworddiv').toggleClass('display-hidden');
      })

      //remove profile image
      $(document).on('click', '#remove-photo, #clspassbtn', function () {
            $('#user-propic').attr('src', '/client_user/client/img/avatar.jpg')
      });

      //profile form Validation
      $(document).on('click', '#updt-prof-btn', function () {

            $('#profile-update-form').validate({

                  rules: {
                        'First Name': 'required',
                        'Last Name': 'required',
                        us_gender: "required",
                        'Mobile': {
                              required: true,
                              // matches: "(0/91)?[7-9][0-9]{9}"
                        },
                        'Email': {
                              required: true,
                              email: true
                        },
                        'Old Password': {
                              required: true,
                              minlength: 5
                        },
                        'New Password': {
                              required: true,
                              minlength: 5
                        },
                        'Confirm New Password': {
                              required: true,
                              equalTo: 'new Password'
                        }
                  },
                  messages: {
                        'First Name': "Please enter your First Name",
                        'Last Name': "Please enter your Last Name",
                        us_gender: "Please select your Gender",
                        'Mobile': {
                              required: "Please enter the mobile no.",
                              // matches: "Mobile No. must have 10 digit.",
                        },
                        'Email': {
                              required: "Please enter your Email Address",
                              email: "Please enter a valid email address"
                        },
                        'Old Password': {
                              required: "Please enter the old password.",
                              minlength: "Your password must be at least 5 characters long."
                        },
                        'New Password': {
                              required: "Please enter the new password.",
                              minlength: "Your password must be at least 5 characters long."
                        },
                        'Confirm New Password': {
                              required: "Please confirm new password.",
                              equalTo: "New password and confirm new password must be same."
                        }
                  },
                  submitHandler: function (form) {
                        form.submit();
                  }
            });
      })


})
