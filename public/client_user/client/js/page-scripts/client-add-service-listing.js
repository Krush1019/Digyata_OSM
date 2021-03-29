/**
 *  Filename   : client-service-listing.js
 *  Author       : Digyata
 */

 $(document).ready(function () {

   var action = ""; var ser_id = "";
   $(window).on('load', function () {
       // for Add Options to select input field Dynamicaly
       action = $("#addServiceListbtn").attr("data-action").trim();
       ser_id = $("#addServiceListbtn").attr("data-id").trim();
       if (action == "update") {
           var des = $("#ser_des").val();
           $('.note-editable').empty().html(des);
           var ser_days = $("#days").val().split(",");
           var ser_days_time = $("#days_time").val().split(",");
           $("input[name='days'][value='" + ser_days[0] + "']").attr("checked", true);
           if (ser_days[0] == "CUSTOM") {
               printDays(ser_days, ser_days_time);
           } else {
               var temp = ser_days_time[0].split("-");
               $("select.optime option[value='" + temp[0].trim() + "']").attr("selected", true);
               $("select.cltime option[value='" + temp[1].trim() + "']").attr("selected", true);
           }
       }
   });

   // $('#start_time option[value=""]').attr("selected",true);

   $("#SL_ser_state").append(
       '<option value="-1" selected disabled>Select</option>'
   );
   var url = "/data/Text File/states.txt";
   $.get(url, function (data) {
       var arr = data.split(",");
       $.each(arr, function (key, entry) {
           $("#SL_ser_state").append(
               '<option value="' + entry + '">' + entry + "</option>"
           );
       });
   });

   $(".optime, .start_time").append(
       '<option value="-1" disabled selected>Opening Time</option>'
   );

   $(".cltime, .end_time").append(
       '<option value="-1" disabled selected>Closing Time</option>'
   );

   for (var i = 0; i < 24; i++) {
       $(".styled-select-value").append(
           '<option value="' + i + '">' + i + "</option>"
       );
   }

   // Add Days On Select WORKING DAYS
   var data;
   $('input[name = "days"]').change(function () {
       if ($(this).val() === "CUSTOM") {
           printDays();
       } else {
           $("#add-day-div")
               .attr("hidden", "hidden")
               .find(".add-day-data:not(:first)")
               .remove();
           $("#def_days").show();
           var days = "";
           if ($(this).val() === "ALL") {
               days = "All Days";
           } else if ($(this).val() === "5D") {
               days = "Mon - Fri";
           } else {
               days = "Mon - Sat";
           }
           $("#days_name").html(days);
       }
   });

   function printDays(ser_day = "", ser_day_time = "") {

       $("#add-day-div").removeAttr("hidden");
       $("#def_days").hide();
       var days = ['Tuesday', 'wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
       for (var j = 2; j <= 7; j++) {
           if ($("#add-day-div").is("*")) {
               var newElem = $(".add-day-data").first().clone();
               if (newElem.is("*")) {
                   data = newElem;
               }
               if (ser_day_time != "") {
                   var temp = ser_day_time[j - 1].split("-");
                   data.find("select.start_time option[value='" + temp[0].trim() + "']").attr("selected", true);
                   data.find("select.end_time option[value='" + temp[1].trim() + "']").attr("selected", true);
               }
               data.find("label.fix_spacing").text(days[j - 2]);
               data.find(".add-day-data").addClass("add-day-data-extra");
               data.appendTo("#add-day-div");
           }
       }
   }

   $(".custom-file-input").change(function (e) {
       $(this)
           .siblings(".custom-file-label")
           .text(e.target.files[0].name);
   });

   $("#addServiceListbtn").click(function () {
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
               opening_time: "required",
               closing_time: "required",
               pli_name: "required",
               pli_desc: "required",
               pli_price: {
                   required: true,
                   number: true,
                   min: 0
               },
           },
           messages: {},

           submitHandler: function (form) {
               form.submit();
           }
       });
   });


   // Category Value
   $(document).on('change', '#SL_ser_name', function (e) {
       var serviceCategory = $(this).find("option:selected").attr("data-category");
       if (serviceCategory == null || serviceCategory == undefined || serviceCategory == "") {
           swalError();
       } else {
           $("#SL_ser_category").val(serviceCategory);
       }
   });


   // Submit Form Data
   $(document).on('click', "#addServiceListbtn", function (e) {
       uploadImg("addServiceListForm", "/service-listing-store-img", "POST")
           .then((path) => {

               var dec_msg = $('.note-editable').html();
               var obj = getFormValue("#addServiceListForm");

               var img = (path['ser_img'] == undefined || path['ser_img'] == "") ? obj['ser_img_file'] : path['ser_img'];
               var doc_file = (path['doc_img'] == undefined || path['doc_img'] == "") ? obj['ser_doc_file'] : path['doc_img'];

               var url = ""; var method = "";
               obj['action'] = action;
               if (action == "insert") {
                   method = "POST";
                   url = "/service-listing-store";
               } else if (action == "update") {
                   obj['id'] = ser_id;
                   method = "GET";
                   url = "/service-listing-update";
               } else {
                   swalError();
               }

               obj['dec_msg'] = dec_msg;
               obj['ser_img'] = img;
               obj['doc_img'] = doc_file;

               obj['days'] = $("input[name='days']:checked").val();
               obj['time'] = obj['opening_time'] + "-" + obj['closing_time'];
               if (obj['days'].toUpperCase() == "CUSTOM") {
                   var data = getDayTime("#add-day-div");
                   obj['days'] = data["days"];
                   obj['time'] = data["time"];
               }
               
               obj['items'] = getItemValue("#pricing-list-container");
               obj['serviceCat_id'] = $("#SL_ser_name option:selected").attr("data-id");
               delete obj['ser_doc_file']
               delete obj['ser_img_file'];

               $.ajax({
                   url: url,
                   type: method,
                   data: obj,
                   success: function (result) {
                       swalSuccess("/service-listing", "");
                   },
                   error: function (error) {
                       swalError(error);
                   }
               });
           })
           .catch((error) => {
               swalError(error);
           });
   });

   numberValidation("#SL_ser_phone");
   numberValidation("#item_price");
});

function swalError(msg = "Something went wrong!", title = "Oops...") {
   Swal.fire({
       icon: 'error',
       title: title,
       text: msg,
   }).then((result) => {
       location.reload();
   });
}

function swalSuccess(url, msg = 'Successfuly saved Data!', title = 'Success!') {
   Swal.fire({
       icon: 'success',
       title: title,
       text: msg,
   }).then((result) => {
       window.location = url;
   });
}

function getDayTime(id) {
   var obj = {}; var days = "CUSTOM, "; var time = "";
   $('div.add-day-data').each(function (e) {
       var opening = $(this).find("div div select.start_time");
       var closing = $(this).find("div div select.end_time");

       var opening_val = opening.find(":selected").val();
       var closing_val = closing.find(":selected").val();

       var day = $(this).find("div label.fix_spacing").text();

       days += day.trim().slice(0, 3).toLocaleUpperCase() + ", ";
       time += opening_val + "-" + closing_val + ", ";
   });
   obj["days"] = days;
   obj["time"] = time;
   return obj;
}


function getItemValue(id) {
   var obj = {}; var i = 0;
   $(id).find("tr").each(function () {
       var data = {};
       $(this).find("input").each(function (i, field) {
           if (field.value != "" && field.value != null) {
               data[field.name] = field.value;
           }
       });
       if (!jQuery.isEmptyObject(data)) {
           obj[i] = data;
           i++;
       }
   });
   return obj;
}


function numberValidation(input_id) {
   $(input_id).keypress(function (event) {
       return /\d/.test(String.fromCharCode(event.keyCode));
   });
}

function getFormValue(form_id) {
   var dataObj = {};
   $.each($(form_id).serializeArray(), function (i, field) {
       dataObj[field.name] = field.value;
   });
   return dataObj;
}

function uploadImg(form_id, url, method) {
   let myform = document.getElementById(form_id);
   let formData = new FormData(myform);

   return new Promise((resolve, reject) => {
       $.ajax({
           url: url,
           type: method,
           data: formData,
           contentType: false,
           processData: false,
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