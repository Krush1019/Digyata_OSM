$(document).ready(function () {

    var isRtl;
    isRtl = $('html').attr('data-textdirection') === 'rtl';

    //  Rendering badge in status column
    var customBadgeHTML = function (params) {
        switch (params.value['val']) {
            case 'Pending':
                return '<div class="badge-pill bg-rgba-warning status-set-text" data-id="' + params.value['id'] + '" ><span class="text-warning font-weight-bold" >Pending</span></div>'

            case 'Rejected':
                return '<div class="badge-pill bg-rgba-secondary status-set-text" data-id="' + params.value['id'] + '" ><span class="text-secondary font-weight-bold" >Rejected</span></div>'

            case 'Active':
                return '<div class="badge-pill bg-rgba-success status-set-text status_btn" data-id="' + params.value['id'] + '" data-action="Active" ><span class="text-success font-weight-bold" >Active</span></div>'

            case 'Blocked':
                return '<div class="badge-pill bg-rgba-danger status-set-text status_btn" data-id="' + params.value['id'] + '" data-action="Blocked" ><span class="text-danger font-weight-bold" >Blocked</span></div>'

        }
    }

    // Renering Icons in Actions column
    var customIconsHTML = function (params) {
        var usersIcons = document.createElement("span");
        var editIconHTML = '<a href="/client-view"><i class="feather icon-eye mr-50"></i></a>';
        usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
        return usersIcons
    }

    // Renering Approval Icons in Actions column
    var customApproveIconsHTML = function (params) {
        var id = document.createAttribute("data-id");
        id.value = params.value['id'];

        var usersIcons = document.createElement("span");
        var acceptIconHTML = '<i class="users-accept-icon feather icon-user-check status_btn" data-action="Approve" data-id="'+id.value+'"></i>';
        var rejectIconHTML = document.createElement('i');

        var attr = document.createAttribute("class");
        attr.value = " ml-2 users-delete-icon feather icon-user-x status_btn";
        rejectIconHTML.setAttributeNode(attr);
        rejectIconHTML.setAttributeNode(id);
        var attr2 = document.createAttribute("data-action");
        attr2.value = "Rejected";
        rejectIconHTML.setAttributeNode(attr2);

        var passIconHTML = document.createElement('i');
        attr = document.createAttribute("class");
        attr.value = "users-accept-icon feather icon-check"
        passIconHTML.setAttributeNode(attr);

        var failIconHTML = document.createElement('i');
        attr = document.createAttribute("class");
        attr.value = "users-delete-icon feather icon-slash"
        failIconHTML.setAttributeNode(attr);

        switch (params.value['val']) {
            case 'Pending':
                usersIcons.appendChild($.parseHTML(acceptIconHTML)[0]);
                usersIcons.appendChild(rejectIconHTML);
                break;

            case 'Rejected':
                usersIcons.appendChild($.parseHTML(acceptIconHTML)[0]);
                break;

            case 'Active':
                usersIcons.appendChild(passIconHTML);
                break;

            case 'Blocked':
                usersIcons.appendChild(failIconHTML);
                break;
        }
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

    // Renering Links in Government Id Column
    var customLinkHTML = function (params) {
        var usersIcons = document.createElement("span");
        var linkHTML = '<a href="' + params.value['url'] + '" target="_blank" title="' + params.value['name'] + '">' + params.value['name'] + '</a>';
        usersIcons.appendChild($.parseHTML(linkHTML)[0]);
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
        headerCheckboxSelection: true
    },
        {
            headerName: 'Name',
            field: 'client-name',
            filter: true,
            width: 200,
            cellRenderer: customAvatarHTML,
        },
        {
            headerName: 'WorkPlace',
            field: 'workplace',
            filter: true,
            width: 200
        },
        {
            headerName: 'Profession',
            field: 'profession',
            filter: true,
            width: 150
        },
        {
            headerName: 'Location',
            field: 'location',
            filter: true,
            width: 150
        },
        {
            headerName: 'Experience',
            field: 'experience',
            filter: true,
            width: 140
        },
        {
            headerName: 'Avalibility',
            field: 'avalibility',
            filter: true,
            width: 150,
            cellStyle: {
                "text-align": "left"
            }
        },
        {
            headerName: 'Mobile No.',
            field: 'mobileNo',
            filter: true,
            width: 150,
            cellRenderer: customPhoneHTML
        },
        {
            headerName: 'Email',
            field: 'email',
            filter: true,
            cellRenderer: customEmailHTML,
            width: 200
        },
        {
            headerName: 'ID Proof',
            field: 'IDProof',
            filter: true,
            width: 125,
            cellRenderer: customLinkHTML,
            cellStyle: {
                "text-align": "center"
            }
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
            headerName: 'Approval',
            field: 'approval',
            width: 125,
            cellRenderer: customApproveIconsHTML,
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
                        getPendingCount();
                        toastFire(Swal,"Changed Status.");
                    },
                    error : function (error) {
                        swalFire(Swal, "Something went wrong!", "Oops...", "error");
                    }
                });
            }
        })
    });
    // END: Approve Data

    getPendingCount();
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
        })
    }
});
