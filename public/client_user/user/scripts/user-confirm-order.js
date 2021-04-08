/*
 File Name: user-custom-order.js
 */
//-------------------------------------------------------------------------------------------

$(document).ready(function () {

      //State options
      $("#cnfod_state").append(
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
                  $("#cnfod_state").append(
                        '<option value="' + entry + '" ' + text + '>' + entry + "</option>"
                  );
            });
      });

      //DIV hide-show 
      $(document).on('click', '#BO_btn2', function () {

            if (validation()) {
                  $('.s_state').text($('#cnfod_state').val());
                  $('.s_city').text($('#cnfod_city').val());
                  $('.s_ad1').text($('#cnfod_ad1').val());
                  $('.s_ad2').text($('#cnfod_ad2').val());
                  $('.s_pin').text($('#cnfod_pin').val());
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

      /* //location permission
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
      }); */

})

function validation(params) {
      var form = $('#cnfm-od-form');
      form.validate({
            rules: {
                  city: "required",
                  state: "required",
                  address1: "required",
                  address2: "required",
                  pincode: {
                        required: true,
                        number: true,
                        minlength: 6,
                        maxlength: 6
                  }
            }
      });
      return form.valid();
}
