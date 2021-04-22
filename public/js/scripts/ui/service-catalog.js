/*=========================================================================================
    File Name: service-catlog.js
    Author Name: Digyata
==========================================================================================*/


$(document).ready(function () {

  const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-left',
    showConfirmButton: true,
    showCancelButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

  const confirmbox = Swal.mixin({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  });

  "use strict"
  // init list view datatable
  var dataListView = $(".data-list-view").DataTable({
    responsive: false,
    columnDefs: [
      {
        orderable: true,
        targets: 0,
        checkboxes: { selectRow: true }
      }
    ],
    dom:
      '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
    oLanguage: {
      sLengthMenu: "_MENU_",
      sSearch: ""
    },
    aLengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
    select: {
      style: "multi"
    },
    order: [[1, "asc"]],
    bInfo: false,
    pageLength: 5,
    buttons: [
      {
        text: "<i class='feather icon-plus'></i> Add Service",
        action: function () {
          $(".add-new-data").addClass("show")
          $(".overlay-bg").addClass("show")
          $("#data-category, #data-status").prop("selectedIndex", 0)
          $("#service-name").focus();
        },
        className: "btn-outline-primary"
      }
    ],
    initComplete: function (settings, json) {
      $(".dt-buttons .btn").removeClass("btn-secondary")
    }
  });

  // To append actions dropdown before add new button
  var actionDropdown = $(".actions-dropodown")
  actionDropdown.insertBefore($(".top .actions .dt-buttons"))

  //on change Image-preview
  $(document).on('change', '#service-img', function (e) {
    if (!$(this).val() == "") {
      imagePreview(e, 'image_prevw', 'prevw_div');
    } else {
      $('#prevw_div').addClass('display-hidden');
    }
  });

  // Scrollbar
  if ($(".data-items").length > 0) {
    new PerfectScrollbar(".data-items", { wheelPropagation: false })
  }

  // Close sidebar
  $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function () {
    $(".add-new-data").removeClass("show");
    $(".overlay-bg").removeClass("show");
    // $('.custom-file-label').text("Choose file");
    $('#image_prevw').removeAttr('src');
    $('#prevw_div').addClass('display-hidden');
    $('.text-uppercase').text('Add New Service');
    $("#service-submit").text('Add Service');
    $('#service-submit').attr('data-action', "insert");
    $('#addServiceForm')[0].reset();
    $('#addServiceForm').trigger('reset').validate().resetForm();
    removeCheck();
  })

  $.validator.addMethod("required_image", function (value, element, param) {
    if ($('#service-submit').attr('data-action') === "insert") {
      return ($.isEmptyObject(value) ? false : true);
    } else if ($('#service-submit').attr('data-action') === "update") {
      return true;
    }
  }, $.validator.format("This field is required."));

  $.validator.addMethod("accept", function (value, element, param) {
    var typeParam = typeof param === "string" ? param.replace(/\s/g, "") : "image/*",
      optionalValue = this.optional(element),
      i, file, regex;

    if (optionalValue) {
      return optionalValue;
    }

    if ($(element).attr("type") === "file") {
      typeParam = typeParam
        .replace(/[\-\[\]\/\{\}\(\)\+\?\.\\\^\$\|]/g, "\\$&")
        .replace(/,/g, "|")
        .replace(/\/\*/g, "/.*");

      // Check if the element has a FileList before checking each file
      if (element.files && element.files.length) {
        regex = new RegExp(".?(" + typeParam + ")$", "i");
        for (i = 0; i < element.files.length; i++) {
          file = element.files[i];

          // Grab the mimetype from the loaded file, verify it matches
          if (!file.type.match(regex)) {
            return false;
          }
        }
      }
    }
    return true;
  }, $.validator.format("Please enter a value with a valid type."));


  // On Insert and update
  $(document).on('click', '#service-submit', function (e) {
    e.stopPropagation();
    $('#addServiceForm').validate({
      rules: {
        serviceName: 'required',
        serviceCategory: 'required',
        serviceDescription: 'required',
        serviceImage: {
          required_image: true,
          accept: "jpg,png,jpeg,gif"
        }
      },
      messages: {
        serviceImage: {
          accept: "Only image type jpg/png/jpeg/gif is allowed."
        }
      },
      submitHandler: function (form) {
        HoldOn.open(options);
        var data = $(form).serializeArray();
        if (!$.isEmptyObject(data)) {
          uploadImg('addServiceForm', "/service-store-img")
            .then((path) => {
              if (!$.isEmptyObject(path)) {
                data[data.length] = { name: "serviceImage", value: path };
              }
              if ($('#service-submit').attr('data-action') === "insert") {
                var url = "/service-store";
                var str = "Data added successfully.";
              } else if ($('#service-submit').attr('data-action') === "update") {
                url = '/service-update';
                data[data.length] = { name: "id", value: ($('#service-submit').attr('data-id')) };
                data[data.length] = { name: "action", value: "service" };
                str = "Data updated successfully.";
              }
              $.ajax({
                url: url,
                type: "POST",
                data: data,
                success: function (data) {
                  if (!data.errors) {
                    getData(dataListView);
                    $(".add-new-data").removeClass("show");
                    $(".overlay-bg").removeClass("show");
                    $('#image_prevw').removeAttr('src');
                    $('#service-img').val('');
                    $('#prevw_div').addClass('display-hidden');
                    // $('.custom-file-label').text("Choose file");
                    $('.text-uppercase').text('Add New Service');
                    $('#service-submit').text('Add Service').attr('data-action', "insert");
                    $('#addServiceForm')[0].reset();
                    HoldOn.close();
                    Toast.fire({
                      icon: 'success',
                      title: str
                    })
                  }
                },
                error: function (xhr, error) {
                  errorView(xhr);
                }
              });
            });
        }
      }
    });
  });

  // On Edit
  $(document).on("click", '.action-edit', function (e) {
    e.stopPropagation();
    var $this = $(this);
    imagePreview('#service-img', 'image_prevw', 'prevw_div', $this.data('img'));
    $('#service-name').val($this.data('service'));
    $('#service-category').val($this.data('category'));
    $('#service-desc').val($this.data('desc'));
    // $('.custom-file-label').text("Choose file");
    $('.text-uppercase').text('Update Service');
    $('#service-submit').text('Update Service').attr({ 'data-action': "update", 'data-id': $this.data('id') });
    $(".add-new-data").addClass("show");
    $(".overlay-bg").addClass("show");
    removeCheck();
  });

  // On Delete
  $(document).on("click", '.action-delete', function (e) {
    e.stopPropagation();
    var id = $(this).data('id');
    var $this = $(this);
    confirmbox.fire({
      showLoaderOnConfirm: true,
      preConfirm: () => {
        HoldOn.open(options);
        return $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "/service-destroy",
          type: "POST",
          data: { id },
          success: function (data) {
            HoldOn.close();
            dataListView.row($this.closest('td').parent('tr')).remove().draw();
            Toast.fire({
              icon: 'success',
              title: 'Data Deleted Successfully.'
            });
          },
          error: function (xhr, error) {
            errorView(xhr);
          }
        });
      }
    });
    removeCheck();
  });

  //on multiple-delete
  $(document).on("click", '.action-delete-group', function (e) {
    e.stopPropagation();
    var tablearr = $('#ServiceCatlogTable tbody input[type="checkbox"]:checked').closest('td').parent('tr').find('.action-delete');
    if (tablearr.length > 0) {
      confirmbox.fire({
        showLoaderOnConfirm: true,
        preConfirm: () => {
          HoldOn.open(options);
          tablearr.each(function () {
            var id = $(this).data('id');
            var $this = $(this);
            return $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "/service-destroy",
              type: "POST",
              data: { id },
              success: function (data) {
                $this.prop("checked", false);
                dataListView.row($this.closest('td').parent('tr')).remove().draw();
                HoldOn.close();
                Toast.fire({
                  icon: 'success',
                  title: 'Data Deleted Successfully.'
                });
              },
              error: function (xhr, error) {
                errorView(xhr);
              }
            });
          });
        }
      });
    } else {
      confirmbox.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'No data selected...',
        showCancelButton: false
      });
    }
    removeCheck();
  });

  // on status
  $(document).on('click', '.service-status', function (e) {
    e.stopPropagation();
    var id = $(this).data('id');
    var $this = $(this);
    var txt = $(this).hasClass('chip-success');
    confirmbox.fire({
      text: "This will " + ((txt) ? "Disable" : "Enable") + " services on website",
      showLoaderOnConfirm: true,
      preConfirm: () => {
        HoldOn.open(options);
        return $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "/service-update",
          type: "POST",
          data: { id: id, action: "status" },
          success: function (data) {
            if (data) {
              $this.removeClass('chip-danger').addClass('chip-success')
              $this.find('.chip-text').text('Active');
            } else {
              $this.removeClass('chip-success').addClass('chip-danger')
              $this.find('.chip-text').text('Inactive');
            }
            HoldOn.close();
            Toast.fire({
              icon: 'success',
              title: 'Status Changed Successfully.'
            });
          },
          error: function (xhr, error) {
            errorView(xhr);
          }
        });
      }
    });
    removeCheck();
  });

  //on multiple-status-enable
  $(document).on('click', '.service-enable-group', function (e) {
    e.stopPropagation();
    var tablearr = $('#ServiceCatlogTable tbody input[type="checkbox"]:checked').closest('td').parent('tr').find('.service-status');
    if (tablearr.length > 0) {
      confirmbox.fire({
        text: "This will Enable all selected services on website",
        showLoaderOnConfirm: true,
        preConfirm: () => {
          HoldOn.open(options);
          tablearr.each(function () {
            var id = $(this).data('id');
            var $this = $(this);
            return $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "/service-update",
              type: "POST",
              data: { id: id, action: "status-enable" },
              success: function (data) {
                if (data) {
                  $this.removeClass('chip-danger').addClass('chip-success')
                  $this.find('.chip-text').text('Active');
                }
                HoldOn.close();
                Toast.fire({
                  icon: 'success',
                  title: 'Status Changed Successfully.'
                });
              },
              error: function (xhr, error) {
                errorView(xhr);
              }
            });
          });
        }
      });
    } else {
      confirmbox.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'No data selected...',
        showCancelButton: false
      });
    }
    removeCheck();
  });

  //on multiple-status-disable
  $(document).on('click', '.service-disable-group', function (e) {
    e.stopPropagation();
    var tablearr = $('#ServiceCatlogTable tbody input[type="checkbox"]:checked').closest('td').parent('tr').find('.service-status');
    if (tablearr.length > 0) {
      confirmbox.fire({
        text: "This will Disable all selected services on website",
        showLoaderOnConfirm: true,
        preConfirm: () => {
          HoldOn.open(options);
          tablearr.each(function () {
            var id = $(this).data('id');
            var $this = $(this);

            return $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "/service-update",
              type: "POST",
              data: { id: id, action: "status-disable" },
              success: function (data) {
                if (data) {
                  $this.removeClass('chip-success').addClass('chip-danger')
                  $this.find('.chip-text').text('Inactive');
                }
                HoldOn.close();
                Toast.fire({
                  icon: 'success',
                  title: 'Status Changed Successfully.'
                });
              },
              error: function (xhr, error) {
                errorView(xhr);
              }
            });
          });
        },
      });
    } else {
      confirmbox.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'No data selected...',
        showCancelButton: false
      });
    }
    removeCheck();
  });

  //upload Image
  function uploadImg(form_id, url) {
    let myform = document.getElementById(form_id);
    let formData = new FormData(myform);
    return new Promise((resolve, reject) => {
      if (!$('#service-img').val() == "") {
        $.ajax({
          url: url,
          type: "post",
          data: formData,
          contentType: false,
          processData: false,
          cache: false,
          success: function (data) {
            resolve(data)
          },
          error: function (xhr, error) {
            errorView(xhr);
            reject(error);
          }
        });
      } else {
        resolve();
      }
    });
  }

  // function For error View
  function errorView(id) {
    var text = "<ul class='mt-1'>";
    $.each(id.responseJSON.errors, function (key, item) {
      text += ("<li class='text-danger'>" + item + "</li>");
    });
    text += "</ul>";
    HoldOn.close();
    Toast.fire({
      icon: 'error',
      position: 'top-left',
      title: text,
      timer: false,
    })
  }
});

function getData(dataListView) {
  HoldOn.open(options);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/service-retrive',
    type: 'POST',
    success: function (data) {
      dataListView.clear().draw();
      for (var i = 0; i <= data.length; i++) {
        dataListView.row.add(['<td></td>',
          '<td class="product-img"><img src="' + window.location.origin + '/storage/' + data[i]['serviceImage'] + '" height="110px" width="110px" ></td>',
          '<td class="product-name">' + data[i]['serviceName'] + '</td>',
          '<td class="product-category">' + data[i]['serviceCategory'] + '</td>',
          '<td><div class="service-status chip ' + ((data[i]['serviceStatus']) ? "chip-success" : "chip-danger") + '" data-id="' + data[i]['id'] + '">' +
          '<div class="chip-body">' +
          '<div class="chip-text">' + ((data[i]['serviceStatus']) ? "Active" : "Inactive") + '</div>' +
          '</div>' +
          '</div></td>',
          '<td class="product-action">' +
          '<span class="action-edit" data-id="' + data[i]['id'] + '" data-service="' + data[i]['serviceName'] + '" data-category="' + data[i]['serviceCategory'] + '" data-desc="' + data[i]['serviceDescription'] + '" data-img="' + data[i]['serviceImage'] + '"><i class="feather icon-edit"></i></span>' +
          '<span class="action-delete" data-id="' + data[i]['id'] + '"><i class="feather icon-trash"></i></span>' +
          '</td>']).draw(false);
      }
    }
  });
  HoldOn.close();
}

// function for checkbox remove check
function removeCheck() {
  $('#ServiceCatlogTable :checked').prop("checked", false);
  $('#ServiceCatlogTable tr').removeClass("selected");
}

//Image Preview function
function imagePreview(e, imgId, imgDivId, img = "") {
  var image = "";
  if (!$.isEmptyObject(img)) {
    image = window.location.origin + '/storage/' + img;
  } else {
    image = URL.createObjectURL(e.target.files[0]);
  }
  $('#' + imgId).prop('src', image);
  $('#' + imgDivId).removeClass('display-hidden');
}


