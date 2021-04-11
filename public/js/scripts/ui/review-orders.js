/*=========================================================================================
    File Name: review-orders.js
    Author: Digyata
==========================================================================================*/
$(document).ready(function () {

  var isRtl;
  isRtl = $('html').attr('data-textdirection') === 'rtl';

  //  Rendering badge in status column
  var customBadgeHTML = function (params) {
    if (params.value === "Good") {
      return '<div class="badge-pill bg-rgba-success status-set-text width-100 status_btn" data-id="'+params.value+'" ><span class="text-success font-weight-bold" > ' + params.value + '</span></div>'
    } else if (params.value === "Bad") {
      return '<div class="badge-pill bg-rgba-danger status-set-text width-100 status_btn" data-id="'+params.value+'" ><span class="text-warning font-weight-bold" > ' + params.value + '</span></div>'
    }
  }

  //  Rendering avatar in username column
  var customUserAvatarHTML = function (params) {
    return '<a href=' + "user-view" + '>' + params.value['userName'] + '</a>';
  }

  //  Rendering avatar in client-name column
  var customClientAvatarHTML = function (params) {
    return '<a href=' + "client-view" + '><span class="avatar"><img src="' + params.value['clientImg'] + '" height="32" width="32" alt=" "></span>' + params.value['clientName'] + '</a>';
  }


  //  Rendering rating in Rating column
  var customRatingHTML = function ({value}) {
    var ratingicons = document.createElement("span");
    ratingicons.setAttribute("class", "pl-1 font-medium-3");
    ratingicons.setAttribute("data-value", value);
    var rateicon = '<i class="fa fa-star text-warning"></i>';
    var ratehalficon = '<i class="fa fa-star-half-o text-warning"></i>';
    var unrateicon = '<i class="fa fa-star text-secondary"></i>';
    if(value <= 5){
      var first = value % 1;
      var second = value - first;

      for (var i = 0; i < second; i++) {
        ratingicons.appendChild($.parseHTML(rateicon)[0]);
      }
      if (first !== 0) {
        ratingicons.appendChild($.parseHTML(ratehalficon)[0]);
        for (i = 0; i < (5 - value) - 1; i++){
          ratingicons.appendChild($.parseHTML(unrateicon)[0]);
        }
      } else {
        for (i = 0; i < (5 - value); i++){
          ratingicons.appendChild($.parseHTML(unrateicon)[0]);
        }
      }
    }
    return ratingicons
  }

// ag-grid
  /*** COLUMN DEFINE ***/

  var columnDefs = [{
    headerName: 'Order Id',
    field: 'order-id',
    width: 200,
    filter: true,
    checkboxSelection: true,
    headerCheckboxSelectionFilteredOnly: true,
    headerCheckboxSelection: true
  },
    {
      headerName: 'Service Name',
      field: 'service-name',
      filter: true,
      width: 200
    },
    {
      headerName: 'Rating',
      field: 'rating',
      filter: true,
      width: 150,
      cellRenderer: customRatingHTML
    },
    {
      headerName: 'Service Provider',
      field: 'service-provider',
      filter: true,
      width: 200,
      cellRenderer: customClientAvatarHTML
    },
    {
      headerName: 'User',
      field: 'user-name',
      filter: true,
      width: 200,
      cellRenderer: customUserAvatarHTML
    },
    {
      headerName: 'Feedback',
      field: 'feedback',
      filter: true,
      width: 200,
    },
    {
      headerName: 'Avarage Rating',
      field: 'avarage-rating',
      filter: true,
      width: 150,
      cellRenderer: customRatingHTML
    },
    {
      headerName: 'Review Status',
      field: 'review-status',
      filter: true,
      width: 175,
      cellRenderer: customBadgeHTML,
      cellStyle: {
        "text-align": "center"
      }
    }
  ];

  /*** GRID OPTIONS ***/
  var gridOptions = {
    defaultColDef: {
      sortable: true,
      resizable: true,
      suppressColumnVirtualisation: true,
      autoHeight: true
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
    domLayout: "autoHeight",
    autoSizeAllColumns: true,
    overlayNoRowsTemplate:
      '<span class="pt-5">No Data To Show</span>'
  };
  if (document.getElementById("myGrid-revworder")) {
    /*** DEFINED TABLE VARIABLE ***/
    var gridTable = document.getElementById("myGrid-revworder");

    function getTableData(data = "all") {
      agGrid
        .simpleHttpRequest({
          url: "review-order-show/"+data,
        })
        .then(function (data) {

          gridOptions.api.setRowData(data);
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

    /*** Dropdown btn-Download CSV BTN ***/
    $("#Aggrid-export-btn").on("click", function (params) {
      gridOptions.api.exportDataAsCsv();
    });

    $('#Aggrid-print-btn').on('click', function () {
      gridOptions.api.setDomLayout('print');
      print();
    } )

    /*** INIT TABLE ***/
    new agGrid.Grid(gridTable, gridOptions);
  }

  //start: Search Data
  $(document).on('click', '#search_btn', function (e) {

    var text = $("#search-text").val();
    if(text !== ""){
      $(this).attr('type', 'button');
      getTableData("search?text="+text);
    }
    // $.ajax({
    //   url : '/review-order-search',
    //   type : 'GET',
    //   data : {
    //     "action": colval,
    //     "text": txt
    //   },
    //   success : function (result) {
    //     console.log(result);
    //     gridOptions.api.setRowData(result);
    //   },
    //   error : function (error) {
    //     console.log(result);
    //     gridOptions.api.setRowData([]);
    //   }
    // })
  })
  //end: Search Data

});
