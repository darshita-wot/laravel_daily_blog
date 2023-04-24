$(document).ready(function(){
    var permissions_datatable = {
        table: () => {
            var datatable = $("#kt_permissions_datatable").KTDatatable({
                // datasource definition
                rows: {
                    beforeTemplate: function (raw, data, index) {
                        var page = datatable.getCurrentPage();
                        var length = datatable.getPageSize();
                        var serial = (page * length) - (length - 1) + (index);
                        $("td:eq(0)", raw).html(`<span width='80px'>${serial}</span>`);
                    },

                },

                data: {
                    type: "remote",

                    source: {
                        read: {
                            url: "/user-permission-list",
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            map: function (raw) {
                                // sample data mapping
                                var dataSet = raw;
                                if (typeof raw.data !== "undefined") {
                                    dataSet = raw.data;
                                }

                                return dataSet;
                            },
                        },
                    },
                    pageSize: 5,
                    serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true,
                },

                // layout definition
                layout: {
                    scroll: false,
                    footer: false,
                },

                // column sorting
                sortable: true,

                pagination: true,

                search: {
                    input: $('#kt_datatable_search_query'),
                    key: 'generalSearch'
                },

                // columns definition
                columns: [{
                        field: "id",
                        title: " No",
                        sortable: false,
                        width: 100,
                        type: "number",
                        selector: false,
                        textAlign: "center",

                    },
                    {
                        field: 'name',
                        sortable: true,
                        width: 100,
                        title: 'Name',
                    },
                    {
                        field: 'create',
                        sortable: false,
                        title: 'Create Blog',
                        
                        // callback function support for column rendering
                        template: function (row) {
                            var status = {
                                1: {
                                    'title': 'Active',
                                    'class': 'checked'
                                },
                                0: {
                                    'title': 'Inactive',
                                    'class': ' '
                                },
                            };
                            // return '<span class="label font-weight-bold label-lg ' + status[row.is_active].class + ' label-inline">' + status[row.is_active].title + '</span>';
                            return `
                            <div class="col-3">
                                <span class="switch switch-primary">
                                    <label>
                                        <input id='createpermission${row.id}' class='create-permission' ${jQuery.inArray( 'create-blog-posts', row.permission_names ) == -1 ? '' : 'checked'} type="checkbox"  value='${row.status}' name="select"/>
                                        <span></span>
                                    </label>
                                </span>
                            </div>`;
                        },
                    },
                    {
                        field: 'edit',
                        sortable: false,
                        title: 'Edit Blog',
                        
                        // callback function support for column rendering
                        template: function (row) {
                            var status = {
                                1: {
                                    'title': 'Active',
                                    'class': 'checked'
                                },
                                0: {
                                    'title': 'Inactive',
                                    'class': ' '
                                },
                            };
                            // return '<span class="label font-weight-bold label-lg ' + status[row.is_active].class + ' label-inline">' + status[row.is_active].title + '</span>';
                            return `
                            <div class="col-3">
                                <span class="switch switch-primary">
                                    <label>
                                        <input id='editpermission${row.id}' class='edit-permission' ${jQuery.inArray( 'edit-blog-posts', row.permission_names ) == -1 ? '' : 'checked'} type="checkbox"  value='${row.status}' name="select"/>
                                        <span></span>
                                    </label>
                                </span>
                            </div>`;
                        },
                    },
                    {
                        field: 'delete',
                        sortable: false,
                        title: 'Delete Blog',
                        
                        // callback function support for column rendering
                        template: function (row) {
                            var status = {
                                1: {
                                    'title': 'Active',
                                    'class': 'checked'
                                },
                                0: {
                                    'title': 'Inactive',
                                    'class': ' '
                                },
                            };
                            // return '<span class="label font-weight-bold label-lg ' + status[row.is_active].class + ' label-inline">' + status[row.is_active].title + '</span>';
                            return `
                            <div class="col-3">
                                <span class="switch switch-primary">
                                    <label>
                                        <input id='delpermission${row.id}' class='del-permission' ${jQuery.inArray( 'delete-blog-posts', row.permission_names ) == -1 ? '' : 'checked'} type="checkbox"  value='${row.status}' name="select"/>
                                        <span></span>
                                    </label>
                                </span>
                            </div>`;
                        },
                    },

                ],
            });
        },
    };
    permissions_datatable.table(); 


    $(document).on('click','.create-permission',function(){
        let user_id = $(this).attr('id');
        let id = user_id.substring(16,user_id.length);
        console.log(id);

        let can_create = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '/blog-permission',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type:'POST',
            data:{can_create : can_create,id : id },
            dataType:'json',
            success:function(response){
                if(response.status == 'success'){
                    toastr.success(`${response.data}`)
                }else{
                    toastr.success(`${response.data}`);
                }
            }
        })
    })

    $(document).on('click','.edit-permission',function(){
        let user_id = $(this).attr('id');
        let id = user_id.substring(14,user_id.length);
        console.log(id);

        let can_edit = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '/blog-permission',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type:'POST',
            data:{can_edit : can_edit,id : id },
            dataType:'json',
            success:function(response){
                if(response.status == 'success'){
                    toastr.success(`${response.data}`)
                }else{
                    toastr.success(`${response.data}`);
                }
            }
        })
    })

    $(document).on('click','.del-permission',function(){
        let user_id = $(this).attr('id');
        let id = user_id.substring(13,user_id.length);
        console.log(id);

        let can_delete = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '/blog-permission',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type:'POST',
            data:{can_delete : can_delete,id : id },
            dataType:'json',
            success:function(response){
                if(response.status == 'success'){
                    toastr.success(`${response.data}`)
                }else{
                    toastr.success(`${response.data}`);
                }
            }
        })
    })

    $(document).on('click', '#clear_permission', function () {
        $('#kt_datatable_search_query').val('');
        const myDataTable = $("#kt_permissions_datatable").KTDatatable();
        myDataTable.search('');
        myDataTable.sort('name');    
    })
});