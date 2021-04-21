/*
  * File Name: localization.js
  * Author: Digyata
  */
 
$(document).ready(function () {

  $('#location-state').append('<option value="" selected>select</option>');
  var url = "data/Text File/states.txt";
  $.get(url, function (data) {
    var arr = data.split(',');
    $.each(arr, function (key, entry) {
      $('#location-state').append('<option value="' + entry + '">' + entry + '</option>');
    })
  });

  $('#locationFormDiv').on('hidden.bs.modal', function () {
    $(this).find('form').trigger("reset");
    $(this).find('form button[type="submit"]').attr('data-action', 'insert').removeAttr('data-id').removeClass('btn-outline-success').addClass('btn-outline-primary').text('Add Location');

    //removing validation
    $("#addLocationForm").find(".error").removeClass("error");
    $("#addLocationForm").find("ul").remove();
    // change names
    $('#locationFormModel').text("Add Location Data");
    $('#location-submit').text("Add Location");
  });

  $('.modal').on('shown.bs.modal', function () {
    $('#location-state').focus();
  });

  var isRtl;
  isRtl = $('html').attr('data-textdirection') === 'rtl';

  //  Rendering badge in status column
  var customBadgeHTML = function (params) {
    var color = "";
    if (params.value['text'] === "Enable") {
      color = "success";
      return '<div class="badge-pill bg-rgba-success status-set-text loc_status" data-id="' + params.value['id'] + '" ><span class="text-success font-weight-bold" > ' + params.value['text'] + '</span></div>'
    } else if (params.value['text'] === "Disable") {
      color = "danger";
      return '<div class="badge-pill bg-rgba-danger status-set-text loc_status" data-id="' + params.value['id'] + '" ><span class="text-danger font-weight-bold" > ' + params.value['text'] + '</span></div>'
    }
  }

  // Renering Icons in Actions column
  var customIconsHTML = function (params) {
      var usersIcons = document.createElement("span");
      var editIconHTML = '<i class="users-edit-icon feather icon-edit-1 mr-50 upd_btn" data-id="' + params.data['location_id'] + '"></i>';
      usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
    /* var deleteIconHTML = document.createElement('i');
    var attr = document.createAttribute("class")
    attr.value = "users-delete-icon feather icon-trash-2"
    deleteIconHTML.setAttributeNode(attr);
    var attr2 = document.createAttribute("data-id")
    attr2.value = params.data['main_id']
    deleteIconHTML.setAttributeNode(attr2);

    selected row delete functionality
    deleteIconHTML.addEventListener("click", function () {
      var id = $(this).attr('data-id');
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showLoaderOnConfirm: true,
        preConfirm: () => {
          $.ajax({
            url: '/localization-update/' + id,
            type: 'GET',
            data: {'action': 'delete'},
            success: function (result) {
              deleteArr = [
                params.data
              ];
              // var selectedData = gridOptions.api.getSelectedRows();
              gridOptions.api.updateRowData({
                remove: deleteArr
              });
              toastFire('Data Deleted Successfully.');
            },
            error: function (error) {
              swalError();
            }
          });
        }
      });
    });
    usersIcons.appendChild(deleteIconHTML);*/
      return usersIcons
  }

  //  Rendering avatar in username column
  var customAvatarHTML = function (params) {
    return params.value
  }

  // ag-grid
  /*** COLUMN DEFINE ***/

  var columnDefs = [{
    headerName: 'ID',
    field: 'id',
    width: 125,
    filter: true,
    checkboxSelection: true,
    headerCheckboxSelectionFilteredOnly: true,
    headerCheckboxSelection: true,
  },
    {
      headerName: 'State',
      field: 'state',
      filter: true,
      width: 175,
      cellRenderer: customAvatarHTML,
    },
    {
      headerName: 'City',
      field: 'city',
      filter: true,
      width: 175,
    },
    {
      headerName: 'Area-Agent',
      field: 'area-agent',
      filter: true,
      width: 225,
    },
    {
      headerName: 'Services',
      field: 'services',
      filter: true,
      width: 175,
    },
    {
      headerName: 'Status',
      field: 'status',
      filter: true,
      width: 125,
      cellRenderer: customBadgeHTML,
      cellStyle: {
        "text-align": "center"
      }
    },
    {
      headerName: 'Actions',
      field: 'transactions',
      width: 125,
      cellRenderer: customIconsHTML,
      cellStyle: {
        "text-align": "center"
      }
    }
  ];

  /*** GRID OPTIONS ***/
  var gridOptions = {
    defaultColDef: {
      sortable: true,
      resizable: true
    },
    enableRtl: isRtl,
    columnDefs: columnDefs,
    rowSelection: "multiple",
    floatingFilter: true,
    filter: true,
    pagination: true,
    paginationPageSize: 20,
    pivotPanelShow: "always",
    colResizeDefault: "shift",
    animateRows: true,
    domLayout: 'autoHeight',
    autoSizeAllColumns: true,
    overlayNoRowsTemplate:
      '<span class="pt-5">No Data To Show</span>'

  };
  if (document.getElementById("myGrid")) {
    /*** DEFINED TABLE VARIABLE ***/
    var gridTable = document.getElementById("myGrid");

    function getTableData() {
      /*** GET TABLE DATA FROM URL ***/
      agGrid
        .simpleHttpRequest({
          url: "/localization-show"
        })
        .then(function (result) {
          gridOptions.api.setRowData(result);
        });
    }

    getTableData();

    /*** FILTER TABLE ***/
    function updateSearchQuery(val) {
      gridOptions.api.setQuickFilter(val);
    }

    $(".ag-grid-filter").on("keyup", function () {
      updateSearchQuery($(this).val());
    });

    /*** CHANGE DATA PER PAGE ***/
    function changePageSize(value) {
      gridOptions.api.paginationSetPageSize(Number(value));
    }

    $(".sort-dropdown .dropdown-item").on("click", function () {
      var $this = $(this);
      changePageSize($this.text());
      $(".filter-btn").text("1 - " + $this.text() + " of 50");
    });

     /*** EXPORT AS CSV BTN ***/
    /* $(".ag-grid-export-btn").on("click", function (params) {
      gridOptions.api.exportDataAsCsv();
    });  */

    /* //  filter data function
    var filterData = function agSetColumnFilter(column, val) {
      var filter = gridOptions.api.getFilterInstance(column)
      var modelObj = null
      if (val !== "all") {
        modelObj = {
          type: "equals",
          filter: val
        }
      }
      filter.setModel(modelObj)
      gridOptions.api.onFilterChanged()
    }
    //  filter inside state
    $("#filter-state").on("change", function () {
      var filterState = $("#filter-state").val();
      filterData("is_verified", filterState)
    });
    //  filter inside city
    $("#filter-city").on("change", function () {
      var filterCity = $("#filter-city").val();
      filterData("role", filterCity)
    });
    //  filter inside services
    $("#filter-services").on("change", function () {
      var filterServices = $("#filter-services").val();
      filterData("services", filterServices)
    });
    //  filter inside status
    $("#filter-status").on("change", function () {
      var filterStatus = $("#filter-status").val();
      filterData("status", filterStatus)
    });
    // filter reset
    $(".users-data-filter").click(function () {
      $('#filter-city').prop('selectedIndex', 0).change();
      $('#filter-state').prop('selectedIndex', 0).change();
      $('#filter-services').prop('selectedIndex', 0).change();
      $('#filter-status').prop('selectedIndex', 0).change();
    }); */

    /*** INIT TABLE ***/
    new agGrid.Grid(gridTable, gridOptions);
  }

  // Input, Select, Textarea validations except submit button validation initialization
  if ($(".users-edit").length > 0) {
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
  }


  // START: Insert or Update Data
  $(document).on('submit', '#addLocationForm', function (e) {
    e.preventDefault();
    HoldOn.open(options);
    var url = "", msg = "", data = "", action = "";
    data = getFormValue('#addLocationForm');
    action = $('#addLocBtn').attr('data-action');
    if (action === 'insert') {
      url = '/localization-store';
      msg = 'Successfully add data.'
    } else if (action === 'update') {
      var id = $('#addLocBtn').attr('data-id');
      url = '/localization-update/' + id;
      msg = 'Successfully updated data.'
      data['action'] = 'update';
    }
    $.ajax({
      url: url,
      type: 'GET',
      data: data,
      success: function (result) {
        toastFire(Swal, msg);
        $('#locationFormDiv').modal('toggle');
        getTableData();
        HoldOn.close();
      },
      error: function (error) {
        HoldOn.close();
        swalFire(Swal, "Something went wrong!", "Oops...", "error");
      }
    })
  });
  // END: Insert or Update Data

  // START: Fetch Data for model
  $(document).on('click', '.upd_btn', function () {
    HoldOn.open(options);
    var id = $(this).attr('data-id');
    $.ajax({
      url: '/localization-edit/' + id,
      type: 'GET',
      success: function (result) {
        result = JSON.parse(result);
        $('#location-state').val(result[0]['loc_state']);
        $('#location-place').val(result[0]['loc_location']);
        $('#location-agentEmail').val(result[0]['loc_agent_email']);
        $('#addLocBtn').attr('data-action', 'update').attr('data-id', id).removeClass('btn-outline-primary').addClass('btn-outline-success').text('Update');
        HoldOn.close();
        $('#locationFormDiv').modal('show');

      },
      error: function (error) {
        HoldOn.close();
        swalFire(Swal, "Something went wrong!", "Oops...", "error");
      }

    });
  });
  // END: Fetch Data for model

  // START: Change Status
  $(document).on('click', '.loc_status', function () {
    var btn = $(this);
    var text = "";
    var id = btn.attr('data-id');
    var hasClass = btn.hasClass('bg-rgba-success');
    if (hasClass) {
      text = 'This will Disable services on website';
    } else {
      text = 'This will Enable services on website';
    }
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      showLoaderOnConfirm: true,
      preConfirm: () => {
        HoldOn.open(options);
        $.ajax({
          url: '/localization-update/' + id,
          type: 'GET',
          data: {
            "action": "status",
            "hasClass": hasClass
          },
          success: function (result) {
            HoldOn.close();
            if (hasClass) {
              btn.removeClass("bg-rgba-success").addClass("bg-rgba-danger");
              btn.find('span').removeClass('text-success').addClass("text-danger").text("Disable");
            } else {
              btn.removeClass("bg-rgba-danger").addClass("bg-rgba-success");
              btn.find('span').addClass('text-success').removeClass("text-danger").text("Enable");
            }

            toastFire(Swal, "Changed Status.");
          },
          error: function (error) {
            HoldOn.close();
            swalFire(Swal, "Something went wrong!", "Oops...", "error");
          }
        })
      }
    });

  });
  // END: Change Status

  function getFormValue(form_id) {
    var dataObj = {};
    $.each($(form_id).serializeArray(), function (i, field) {
      dataObj[field.name] = field.value;
    })
    return dataObj;
  }
});
