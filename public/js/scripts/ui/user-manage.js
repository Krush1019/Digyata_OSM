$(document).ready(function () {

    var isRtl;
    isRtl = $('html').attr('data-textdirection') === 'rtl';

    //  Rendering badge in status column
    var customBadgeHTML = function (params) {
        if (params.value['text'] === "Active") {
            return '<div class="badge-pill bg-rgba-success status-set-text status_btn" data-id="' + params.value['id'] + '" ><span class="text-success font-weight-bold" >Active</span></div>'
        } else if (params.value['text'] === "Inactive") {
            return '<div class="badge-pill bg-rgba-danger status-set-text status_btn" data-id="' + params.value['id'] + '" ><span class="text-danger font-weight-bold" >Inactive</span></div>'
        }
    }

    // Renering Icons in Actions column
  var customIconsHTML = function (params) {
    var usersIcons = document.createElement("span");
    var editIconHTML = '<a href="/user-view"><i class="users-edit-icon feather icon-eye mr-50 upd_btn"></i></a>';
    usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
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
        cellStyle: {
            "text-align": "center"
        }
    },
        {
            headerName: 'User Name',
            field: 'user-name',
            filter: true,
            width: 180,
            cellStyle: {
                "text-align": "left"
            }
        },
        {
            headerName: 'Mobile No.',
            field: 'mobileNo',
            filter: true,
            width: 150,
            cellStyle: {
                "text-align": "left"
            }
        },
        {
            headerName: 'Email',
            field: 'email',
            filter: true,
            width: 260,
            cellStyle: {
                "text-align": "left"
            }
        },
        {
            headerName: 'Status',
            field: 'user-status',
            filter: true,
            width: 125,
            cellRenderer: customBadgeHTML,
            cellStyle: {
                "text-align": "center"
            }
        },
        {
            headerName: 'Location',
            field: 'user-location',
            filter: true,
            width: 140,
            cellStyle: {
                "text-align": "left"
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
        overlayNoRowsTemplate:
        '<span class="pt-5">No Data To Show</span>'
    };
    if (document.getElementById("myGrid-userManage")) {
        /*** DEFINED TABLE VARIABLE ***/
        var gridTable = document.getElementById("myGrid-userManage");


        function getTableData() {
            agGrid
                .simpleHttpRequest({
                    url: "/user-manage-show"
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

        /*** EXPORT AS CSV BTN ***/
        $(".ag-grid-export-btn").on("click", function (params) {
            gridOptions.api.exportDataAsCsv();
        });

        /*** INIT TABLE ***/
        new agGrid.Grid(gridTable, gridOptions);
    }


    // Input, Select, Textarea validations except submit button validation initialization
    if ($(".users-edit").length > 0) {
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
    }

    // START: Change status
    $(document).on('click', '.status_btn', function (e) {
        var btn = $(this); var text = "";
        var id = btn.attr('data-id');
        var hasClass = btn.hasClass('bg-rgba-success');
        if(hasClass){
            text = 'This will Disable services on website';
        }else {
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
                    url : '/user-manage-update',
                    type : 'GET',
                    data : {
                        "action": "status",
                        "hasClass" : hasClass,
                        'id': id
                    },
                    success : function (result){
                        if(hasClass){
                            btn.removeClass("bg-rgba-success").addClass("bg-rgba-danger");
                            btn.find('span').removeClass('text-success').addClass("text-danger").text("Inactive");
                        }else {
                            btn.removeClass("bg-rgba-danger").addClass("bg-rgba-success");
                            btn.find('span').addClass('text-success').removeClass("text-danger").text("Active");
                        }

                        toastFire(Swal,"Changed Status.");
                    },
                    error : function (error) {
                        swalFire(Swal, "Something went wrong!", "Oops...", "error");
                    }
                })
            }
        });
    });
    // END: Change status
});