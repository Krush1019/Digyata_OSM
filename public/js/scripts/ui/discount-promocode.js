/*=========================================================================================
    File Name: discount-promocode.js
    Author: Digyata
=======================================================================================*/
$(document).ready(function () {

// ----------------------- START: Custom JS ----------------------- //

  $('#promocodeFormDiv').on('hidden.bs.modal', function () {
    $(this).find('form').trigger("reset");
    $(this).find('form button[type="submit"]').attr('data-action', 'insert').removeAttr('data-id').removeClass('btn-outline-success').addClass('btn-outline-primary').text('Add Promo-Code');

    //removing validation
    $("#addPromocodeForm").find(".error").removeClass("error");
    $("#addPromocodeFormForm").find("ul").remove();
    // change names
    $('#promocodeFormModel').text("Add Promo-Code Data");
    $('#promocode-submitbtn').text("Add Promo-Code");
  });

  $('.modal').on('shown.bs.modal', function () {
    $('#promocode-name').focus();
  });

  $(document).on('click', 'a .users-edit-icon', function () {
    $('#promocodeFormModel').text("Update Location Data");
    $('#promocode-submitbtn').text("Update Location");
  });

// ----------------------- END: Custom JS ----------------------- //

  var isRtl;
  isRtl = $('html').attr('data-textdirection') === 'rtl';

  //  Rendering badge in status column
  var customBadgeHTML = function (params) {
    if (params.value['text'] === "Enable") {
      return '<div class="badge-pill bg-rgba-success status-set-text dpc_status" data-id="' + params.value['id'] + '" ><span class="text-success font-weight-bold" > ' + params.value['text'] + '</span></div>'
    } else if (params.value['text'] === "Disable") {
      return '<div class="badge-pill bg-rgba-danger status-set-text dpc_status" data-id="' + params.value['id'] + '" ><span class="text-danger font-weight-bold" > ' + params.value['text'] + '</span></div>'
    }
  }

  // Renering Icons in Actions column
  var customIconsHTML = function (params) {
    var usersIcons = document.createElement("span");
    var editIconHTML = '<i class="users-edit-icon feather icon-edit-1 mr-50 upd_btn" data-id="' + params.data['main_id'] + '"></i>';
    var deleteIconHTML = document.createElement('i');
    var attr = document.createAttribute("class")
    attr.value = "users-delete-icon feather icon-trash-2"
    deleteIconHTML.setAttributeNode(attr);
    var attr2 = document.createAttribute("data-id")
    attr2.value = params.data['main_id']
    deleteIconHTML.setAttributeNode(attr2);

    // selected row delete functionality
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
            url: '/discount-promo-update/' + id,
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
    usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
    usersIcons.appendChild(deleteIconHTML);
    return usersIcons
  }

  // ag-grid
  /*** COLUMN DEFINE ***/

  var columnDefs = [{
    headerName: '#',
    field: '#',
    width: 125,
    filter: true,
    checkboxSelection: true,
    headerCheckboxSelectionFilteredOnly: true,
    headerCheckboxSelection: true,
  },
    {
      headerName: 'Promocode',
      field: 'promocode-name',
      filter: true,
      width: 200,
    },
    {
      headerName: 'Type',
      field: 'promo-type',
      filter: true,
      width: 165,
    },
    {
      headerName: 'Discount',
      field: 'discount',
      filter: true,
      width: 175,
    },
    {
      headerName: 'Min Amount',
      field: 'min-amount',
      filter: true,
      width: 165,
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
  if (document.getElementById("myGrid-discountPromo")) {
    /*** DEFINED TABLE VARIABLE ***/
    var gridTable = document.getElementById("myGrid-discountPromo");

    function getTableData() {
      /*** GET TABLE DATA FROM URL ***/
        agGrid
          .simpleHttpRequest({
            url: "/discount-promo-show"
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
    $(".ag-grid-export-btn").on("click", function (params) {
      gridOptions.api.exportDataAsCsv();
    });

    //  filter data function
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

    /*** INIT TABLE ***/
    new agGrid.Grid(gridTable, gridOptions);
  }

  // Input, Select, Textarea validations except submit button validation initialization
  if ($(".users-edit").length > 0) {
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
  }


  // START: Insert or Update Data
  $(document).on('submit', '#addPromocodeForm', function (e) {
    e.preventDefault();
    var url = "", msg = "", data = "", action = "";
    data = getFormValue('#addPromocodeForm');
    action = $('#promocode-submitbtn').attr('data-action');
    if (action === 'insert') {
      url = '/discount-promo-store';
      msg = 'Successfully added data.'
    }
    else if (action === 'update') {
      var id = $('#promocode-submitbtn').attr('data-id');
      url = '/discount-promo-update/' + id;
      msg = 'Successfully updated data.'
      data['action'] = 'update';
    }
    $.ajax({
      url: url,
      type: 'GET',
      data: data,
      success: function (result) {
        toastFire(Swal, msg);
        $('#promocodeFormDiv').modal('toggle');
        getTableData();
      },
      error: function (error) {
        swalFire(Swal, "Something went wrong!", "Oops...", "error");
      }
    })
  });


// START: Fetch Data for model
  $(document).on('click', '.upd_btn', function () {
    var id = $(this).attr('data-id');
    $.ajax({
      url: '/discount-promo-edit/' + id,
      type: 'GET',
      success: function (result) {
        result = JSON.parse(result);
        $('#promocode-name').val(result[0]['sdpc_name']);
        $('pmc_Type').val(result[0]['sdpc_type']);
        $('#promocode-discount').val(result[0]['fdpc_discount']);
        $('#promocode-minamt').val(result[0]['fdpc_minAmount']);
        $('#promocode-submitbtn').attr('data-action', 'update').attr('data-id', id).removeClass('btn-outline-primary').addClass('btn-outline-success').text('Update');
        $('#promocodeFormDiv').modal('show');

      },
      error: function (error) {
        swalFire(Swal, "Something went wrong!", "Oops...", "error");
      }

    });
  });
  // END: Fetch Data for model

  // START: Change Status
  $(document).on('click', '.dpc_status', function () {
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
        $.ajax({
          url: '/discount-promo-update/' + id,
          type: 'GET',
          data: {
            "action": "status",
            "hasClass": hasClass
          },
          success: function (result) {
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
