/**
 * Filename   : client-add-service-listing.js
 * Author       : Digyata
 */

$(document).ready(function() {
  // for Add Options to select input field Dynamicaly
  $("#SL_ser_state").append(
      '<option value="-1" selected disabled>Select</option>'
  );
  var url = "data/Text File/states.txt";
  $.get(url, function(data) {
      var arr = data.split(",");
      $.each(arr, function(key, entry) {
          $("#SL_ser_state").append(
              '<option value="' + entry + '">' + entry + "</option>"
          );
      });
  });

  $(".optime").append(
      '<option value="-1" disabled selected>Opening Time</option>'
  );

  $(".cltime").append(
      '<option value="-1" disabled selected>Closing Time</option>'
  );

  for (var i = 0; i < 25; i++) {
      $(".styled-select-value").append(
          '<option value="' + i + '">' + i + "</option>"
      );
  }

  // Add Days On Select WORKING DAYS
  var data;
  $('input[name = "days"]').change(function() {

      if ($(this).val() === "Custom") {

          $("#add-day-div").removeAttr("hidden");

          $("#def_days").hide();

          for (var j = 2; j <= 7; j++) {
              
              if ($("#add-day-div").is("*")) {
                  var day;
                  var newElem = $(".add-day-data").first().clone();
                  
                  if (newElem.is("*")) {
                      data = newElem;
                  }
                  
                  switch (j) {

                      case 2:
                          day = "Tuesday";
                          break;

                      case 3:
                          day = "Wednesday";
                          break;

                      case 4:
                          day = "Thursday";
                          break;

                      case 5:
                          day = "Friday";
                          break;

                      case 6:
                          day = "Saturday";
                          break;

                      case 7:
                          day = "Sunday";
                          break;

                  }

                  data.find("label.fix_spacing").text(day);
                  data.find(".add-day-data").addClass("add-day-data-extra");
                  data.appendTo("#add-day-div");
              }
          }
      } else {
          $("#add-day-div")
              .attr("hidden", "hidden")
              .find(".add-day-data:not(:first)")
              .remove();
          $("#def_days").show();
          var days = "";
          if($(this).val() === "All"){
              days = "All Days";
          }else if($(this).val() === "5D") {
              days = "Mon - Fri";
          }else {
              days = "Mon - Sat";
          }
          $("#days_name").html(days);
      }
  });

  $(".custom-file-input").change(function(e) {
      $(this)
          .siblings(".custom-file-label")
          .text(e.target.files[0].name);
  });

  $("#addServiceListbtn").click(function() {
      $("#addServiceListForm").validate({

          rules: {
              SL_ser_name: "required",
              SL_ser_category: "required",
              SL_Ser_shopname: "required",
              SL_Ser_experience: "required",
              "note-codable": "required",
              SL_ser_photos: {
                  required: true,
                  file: true
              },
              SL_ser_idproof: "required",
              SL_Ser_aadharNo: {
                  required: true,
                  number: true,
                  minlength: 12,
                  maxlength: 12
              },
              SL_ser_city: "required",
              SL_ser_state: "required",
              SL_ser_address: "required",
              SL_ser_pincode: {
                  required: true,
                  number: true,
                  minlength: 6,
                  maxlength: 6
              },
              days: "required",
              add_day_data_optime: "required",
              add_day_data_cltime: "required",
              pli_name: "required",
              pli_desc: "required",
              pli_price: {
                  required: true,
                  number: true,
                  min: 0
              },
              // pli_maxprice: {
              //     required: true,
              //     number: true,
              //     min: 0,
              //     equal: "pli_minprice"
              // }
          },
          messages: {},

          submitHandler: function(form) {
              form.submit();
           }
      });
  });


  // Category Value
  $(document).on('change', '#SL_ser_name', function(e) {
      var serviceCategory = $(this).children(":selected").attr("data-category");
      if (serviceCategory == null || serviceCategory == undefined || serviceCategory == "") {
          location.reload();
      }else {
          $("#SL_ser_category").val(serviceCategory);
      }
      
  });

  $(document).on('click', "#addServiceListbtn", function(e) {
      
      uploadImg("addServiceListForm", "/service-listing-store-img", "POST")
          .then((path) => {

              var dec_msg = $('.note-editable').html();
              var obj = getFormValue("#addServiceListForm");

              obj['dec_msg'] = dec_msg;
              obj['ser_img'] = path['ser_img']; 
              obj['doc_img'] = path['doc_img'];
              obj['days'] = $("input[name='days']:checked").val();
              obj['time'] = obj['opening_time'] + "-" + obj['closing_time'];
              console.log(obj);
              $.ajax({
                  url : "/service-listing-store",
                  type: "POST",
                  data : obj,
                  success: function(result) {
                      alert(result);
                      console.log(result);
                  },
                  error: function (error){
                      alert('error');
                  }
              });
          })
          .catch((error) => {
              console.log(error);
          });

  })

});
function getFormValue(form_id) {
  var dataObj = {};
  $.each($(form_id).serializeArray(), function (i, field) {
    dataObj[field.name] = field.value;
  });
  return dataObj;
}

function uploadImg(form_id, url, method = "GET"){
  let myform = document.getElementById(form_id);
  let formData = new FormData(myform);

  return new Promise((resolve, reject) => {
      $.ajax({
          url: url,
          type: method,
          data: formData,
          contentType: false,
          processData:false,
          cache: false,
          success: function (data) {
              resolve(data)
          },
          error: function (error) {
              reject(error)
          },
      })
    })
}