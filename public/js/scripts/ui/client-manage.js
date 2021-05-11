$(document).ready(function () {
    var isRtl;
    isRtl = $('html').attr('data-textdirection') === 'rtl';

    //  Rendering badge in status column
    var customBadgeHTML = function (params) {
        switch (params.value['val']) {
            
            case 'Active':
                return '<div class="badge-pill bg-rgba-success status-set-text status_btn" data-id="' + params.value['id'] + '" data-action="Active" ><span class="text-success font-weight-bold" >Active</span></div>'

            case 'Blocked':
                return '<div class="badge-pill bg-rgba-danger status-set-text status_btn" data-id="' + params.value['id'] + '" data-action="Blocked" ><span class="text-danger font-weight-bold" >Blocked</span></div>'

        }
    }

    // Renering Icons in Actions column
    var customIconsHTML = function (params) {
        var usersIcons = document.createElement("span");
        var editIconHTML = '<a href="#" class="modal_btn" data-id="' + params.value['id'] + '"><i class="feather icon-eye mr-50 "></i></a>';
        usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
        return usersIcons
    }

    //  Rendering avatar in username column
    var customAvatarHTML = function (params) {
        return "<span class='avatar'><img src='" + params.data.avatar + "' height='32' width='32'></span>" + params.value
    }

    var customEmailHTML = function (params) {
        return "<a href='mailto:"+params.value+"'>"+params.value+"</a>"
    }

    var customPhoneHTML = function (params) {
        return "<a href='tel:"+params.value+"'>"+params.value+"</a>"
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
        headerCheckboxSelection: true
    },

    {
        headerName: 'Client Id',
        field: 'client-id',
        filter: true,
        width: 150,
    },
        {
            headerName: 'Name',
            field: 'client-name',
            filter: true,
            width: 245,
            cellRenderer: customAvatarHTML,
        },
        {
            headerName: 'Email',
            field: 'email',
            filter: true,
            cellRenderer: customEmailHTML,
            width: 250
        },
        {
            headerName: 'Mobile No.',
            field: 'mobileNo',
            filter: true,
            width: 150,
            cellRenderer: customPhoneHTML
        },        
        {
            headerName: 'Status',
            field: 'client-status',
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
            resizable: true,
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
        overlayNoRowsTemplate:
            '<span class="pt-5">No Data To Show</span>'
    };
    if (document.getElementById("myGrid-clientManage")) {
        /*** DEFINED TABLE VARIABLE ***/
        var gridTable = document.getElementById("myGrid-clientManage");

        function getTableData() {
            agGrid
                .simpleHttpRequest({
                    url: "/client-manage-show",
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

        /*** INIT TABLE ***/
        new agGrid.Grid(gridTable, gridOptions);
    }


    // Input, Select, Textarea validations except submit button validation initialization
    if ($(".users-edit").length > 0) {
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
    }

    // START: Approve Data
    $(document).on('click', '.status_btn', function (e) {
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-action');
        if(status == "Active")
            status = "Blocked"
        else if (status == "Blocked")
            status = "Active"

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#78d278',
            cancelButtonColor: '#d33',
            confirmButtonText: status
        }).then((result) => {
            if (result.isConfirmed) {
               HoldOn.open(options);
                $.ajax({
                    url : '/client-manage-update',
                    type : 'GET',
                    data : {
                        action: "status",
                        status: status,
                        id: id
                    },
                    success : function (result){
                        getTableData();
                        if(status == "Approve")
                           getPendingCount();
                        toastFire(Swal,"Changed Status.");
                        HoldOn.close();
                    },
                    error : function (error) {
                        swalFire(Swal, "Something went wrong!", "Oops...", "error");
                       HoldOn.close();
                    }
                });

            }
        })
    });
    // END: Approve Data

    // getPendingCount();
    function getPendingCount() {
        $.ajax({
            url : '/client-manage-show',
            type: 'GET',
            data: {
                action: "Pending"
            },
            success: function (result) {
                if(result > 0)
                    $('a[href="client-manage"] span:last').text(result);
                else
                    $('a[href="client-manage"] span:last').text("");
            }
        });
    }

    //show modal woth data
    $(document).on('click', ".modal_btn", function (e) {
        HoldOn.open(options);
        var id = $(this).attr("data-id");
        var url = "/show-client-data";
        var form = $("#viewClientModal");
        var html = "";
        var data = {
            "id": id,
            "_token" :  $("meta[name='csrf-token']").attr("content"),
        }
        $.post(url, data, function (result) {
              var data = JSON.parse(result);
            form.find('.clientId').text('#'+ data[0]['sClientID']);
            form.find('.client_img').attr('src' , data[0]['sClPhotoURL'] );
            form.find('.client_name').text(data[0]['sClName']);
            form.find('.client_gender').text(data[0]['sClGender']);
            form.find('.client_email').attr("href", "mailto:" + data[0]['sClEmail']).text(data[0]['sClEmail']);
            form.find('.client_moblie').attr("href", "tel:" + data[0]['sClMobile']).text(data[0]['sClMobile']);
            if(data[0]['sClientStatus'] == 'Active'){
                form.find('.client_status').addClass('badge-success').text('Active');
            } else {
                form.find('.client_status').addClass('badge-danger').text('Blocked');
            }
            form.find(".service_list tbody").empty();
            if(data[0]['ser_pro_name']){
                $.each(data, function (key, value) {
                    html += '<tr><th scope="row">' + (key + 1) + '</th><td>' + value['ser_pro_name'] + '</td><td>' + value['serviceName'] + '</td><td>' + value['serviceCategory'] + '</td></tr>';
                })
            } else {
                    html =  '<tr class="text-center"><td colspan="3">Services not Added.</td></tr>';
            }
            form.find(".service_list tbody").append(html);
            HoldOn.close();
            form.modal("show");
        })
            .fail(function (error) {
                swalError();
            })
            .always(function () {   
                HoldOn.close();
            });
    });
});

function  swalError() {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong!',
    });
}