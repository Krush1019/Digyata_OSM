/*
 File Name: user-custom-order.js
 */
//-------------------------------------------------------------------------------------------

$(document).ready(function () {

      //State options
      $("#cnfod_state").append(
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
                  $("#cnfod_state").append(
                        '<option value="' + entry + '" ' + text + '>' + entry + "</option>"
                  );
            });
      });

      //DIV hide-show 
      $(document).on('click', '#BO_btn1', function () {
            $('#switch_inner1').slideUp();
            $('#switch_inner2').removeAttr('hidden').fadeIn();            
      });

      $(document).on('click', '#BO_btn2', function () {

                  if (validation()) {
                        $('#switch_inner2').slideUp();
                        $('#switch_inner3').removeAttr('hidden').fadeIn();;
                  }
            });

      $(document).on('click', '#BO_btn3', function () {
            if (validation()) {
                  $('#switch1').slideUp();
                  $('#switch2').removeAttr('hidden').fadeIn();
                  // $('#cnfm-od-form').submit();
            }
      });

      //location permission
      $(document).on('click', '#uselocation', function () {
            var getPosition = {
                  enableHighAccuracy: true,
                  timeout: 9000,
                  maximumAge: 0
            };

            function success(gotPosition) {
                  var uLat = gotPosition.coords.latitude;
                  var uLon = gotPosition.coords.longitude;
                  console.log(`${uLat}`, `${uLon}`);
            };

            function error(err) {
                  console.warn(`ERROR(${err.code}): ${err.message}`);
                  $('#uselocation').prop('checked', false);
            };

            navigator.geolocation.getCurrentPosition(success, error, getPosition);
      });
})

function validation(params) {
      var form = $('#cnfm-od-form');
      form.validate({
            rules: {
                  od_name: "required",
                  od_email: {
                        required: true,
                        email: true,
                  },
                  od_mno: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10
                  },
                  od_city: "required",
                  od_state: "required",
                  od_ad1: "required",
                  od_ad2: "required",
                  od_pin: {
                        required: true,
                        number: true,
                        minlength: 6,
                        maxlength: 6
                  }
            }
      });
      return form.valid();
}
