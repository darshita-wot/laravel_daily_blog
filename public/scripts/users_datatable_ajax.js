"use strict";
// Class definition

var KTDatatableRemoteAjaxDemo = function() {
    // Private functions

    // basic demo
    var demo = function() {

        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            rows: {
                beforeTemplate: function (raw, data, index) {
                    var page = datatable.getCurrentPage()	;
                    var length = datatable.getPageSize();
                    var serial = (page * length) - (length-1) +(index) ;
                    $("td:eq(0)", raw).html(`<span width='80px'>${serial}</span>`);
                },

            },
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/userlist',
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        map: function(raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    },
                },
                pageSize: 10,
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
            columns: [
                {
                    field: "id",
                    title: "No",
                    // sortable: false,
                    width: 100,
                    type: "number",
                    selector: false,
                    textAlign: "center",
                   
                },
             {
                field: 'name',
                width: 100,
                title: 'Name',
            }, {
                field: 'email',
                width:100,
                title: 'Email',
            }, {
                field: 'mobile_no',
                title: 'Mobile No',
            },
            {
                field: 'birth_date',
                title: 'Birth Date',
            }, 
            {
                field: 'is_active',
                title: 'Status',
                // callback function support for column rendering
                template: function(row) {
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
                                <input id='user${row.id}' class='check-class' ${row.is_active == 1 ? 'checked' : ''} type="checkbox"  value='${row.is_active}' name="select"/>
                                <span></span>
                            </label>
                        </span>
                    </div>`;
                },
            }, 
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                overflow: 'visible',
                autoHide: false,
                template: function(raw) {
                    return `\
                        <button id='edit${raw.id}'  class="edit btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </button>\
                        <button id='delete${raw.id}' class="delete btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </button>\
                    `;
                },
            }
        ],

        });

		$('#kt_datatable_search_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Status');
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Type');
        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };


    return {
        // public functions
        init: function() {
            demo();
        },
    };
}();

var KTUser = function(){

    var _handleAddUserForm = function (){
        var validation;
        var form = KTUtil.getById('addUser');
    
        validation = FormValidation.formValidation(
            form, {
                fields: {
                    fullname: {
                        validators: {
                            notEmpty: {
                                message: "Username is required",
                            },
                            stringLength: {
                                message:
                                    "The Username must be more than 5 characters long",
                                min: 5,
                            },
                        },
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: "Email address is required",
                            },
                            emailAddress: {
                                message: "The value is not a valid email address",
                            },
                        },
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "The password is required",
                            },
                            stringLength: {
                                message:
                                    "The password must be more than 5 characters long",
                                min: 5,
                            },
                        },
                    },
                    mobile_no:{
                        validators: {
                            notEmpty: {
                                message: "The mobile no is required",
                            },
                        }
                    },
                    birthday_date :{
                        validators: {
                            notEmpty: {
                                message: "The birthday date is required",
                            },
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            },
        );
    
        $('#saveUser').on('click', function (e) {
            e.preventDefault();
    
            let formData = $("#addUser").serialize();
    
            validation.validate().then(function (status) {
                if (status == 'Valid') {
    
                    $.ajax({
                        url: '/registration',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
    
                        success: function (response) {
                            if(response.status == 'success'){
                                $("#addUserModal").modal('hide');
                                $("#kt_datatable").KTDatatable('reload');
                                $('#addUser').trigger('reset');
                                $(".fv-plugins-message-container").html('');
                                $(".form-control").removeClass('is-invalid');
                                $(".form-control").removeClass('is-valid'); 
                                toastr.success("New User Added!");
                            }else{
                                if (response.data.fullname) {
                                    $("#fullname_error").html(
                                        `${response.data.fullname}`
                                    );
                                } else {
                                    $("#fullname_error").html("");
                                }

                                if (response.data.email) {
                                    $("#email_error").html(
                                        `${response.data.email}`
                                    );
                                } else {
                                    $("#email_error").html("");
                                }

                                if (response.data.password) {
                                    $("#password_error").html(
                                        `${response.data.password}`
                                    );
                                } else {
                                    $("#password_error").html("");
                                }

                                if (response.data.mobile_no) {
                                    $("#mobileno_error").html(
                                        `${response.data.mobile_no}`
                                    );
                                } else {
                                    $("#mobileno_error").html("");
                                }

                                if (response.data.birthday_date) {
                                    $("#birthdaydate_error").html(
                                        `${response.data.birthday_date}`
                                    );
                                } else {
                                    $("#birthdaydate_error").html("");
                                }
                            }
                        }
                    })
                } else {
                    swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function () {
                        KTUtil.scrollTop();
                    });
                }
            });
        });

        $(".closeAddModal").on("click",function(){
            $('#addUser').trigger('reset');
            $(".fv-plugins-message-container").html('');
            $(".form-control").removeClass('is-invalid');
            $(".form-control").removeClass('is-valid'); 
            $('.error').html('');
        });
    }

    var _handleUpdateUserForm = function(){
        var validation;
        var form = KTUtil.getById('updateUser');
    
        validation = FormValidation.formValidation(
            form, {
                fields: {
                    fullname: {
                        validators: {
                            notEmpty: {
                                message: "Username is required",
                            },
                            stringLength: {
                                message:
                                    "The Username must be more than 5 characters long",
                                min: 5,
                            },
                        },
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: "Email address is required",
                            },
                            emailAddress: {
                                message: "The value is not a valid email address",
                            },
                        },
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "The password is required",
                            },
                            stringLength: {
                                message:
                                    "The password must be more than 5 characters long",
                                min: 5,
                            },
                        },
                    },
                    mobile_no:{
                        validators: {
                            notEmpty: {
                                message: "The mobile no is required",
                            },
                        }
                    },
                    birthday_date :{
                        validators: {
                            notEmpty: {
                                message: "The birthday date is required",
                            },
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            },
        );
    
        $('#updateUserBtn').on('click', function (e) {
            e.preventDefault();
    
            let formData = $("#updateUser").serialize();
    
            validation.validate().then(function (status) {
                if (status == 'Valid') {
    
                    $.ajax({
                        url: '/updateuser',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
    
                        success: function (response) {
                            if(response.status == 'success'){
                                $("#editUserModal").modal('hide');
                                $("#kt_datatable").KTDatatable('reload');
                                $('#updateUser').trigger('reset');
                                $(".fv-plugins-message-container").html('');
                                $(".form-control").removeClass('is-invalid');
                                $(".form-control").removeClass('is-valid'); 
                                toastr.success(`${response.data}`);
                            }else{
                                if (response.data.fullname) {
                                    $("#edit_fullname_error").html(
                                        `${response.data.fullname}`
                                    );
                                } else {
                                    $("#edit_fullname_error").html("");
                                }

                                if (response.data.email) {
                                    $("#edit_email_error").html(
                                        `${response.data.email}`
                                    );
                                } else {
                                    $("#edit_email_error").html("");
                                }

                                if (response.data.password) {
                                    $("#edit_password_error").html(
                                        `${response.data.password}`
                                    );
                                } else {
                                    $("#edit_password_error").html("");
                                }

                                if (response.data.mobile_no) {
                                    $("#edit_mobileno_error").html(
                                        `${response.data.mobile_no}`
                                    );
                                } else {
                                    $("#edit_mobileno_error").html("");
                                }

                                if (response.data.birthday_date) {
                                    $("#edit_birthdaydate_error").html(
                                        `${response.data.birthday_date}`
                                    );
                                } else {
                                    $("#edit_birthdaydate_error").html("");
                                }
                            }
                        }
                    })
                } else {
                    swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function () {
                        KTUtil.scrollTop();
                    });
                }
            });
        });

        $(".closeEditModal").on("click",function(){
            $('#updateUser').trigger('reset');
            $(".fv-plugins-message-container").html('');
            $(".form-control").removeClass('is-invalid');
            $(".form-control").removeClass('is-valid'); 
            $('.error').html('');
        });
    }
   
     // Public Functions
     return {
        // public functions
        init: function () {
            _handleAddUserForm();
            _handleUpdateUserForm();
        }
    };
}();



jQuery(document).ready(function() {
    KTDatatableRemoteAjaxDemo.init();
    KTUser.init();

    $(document).on('click','.edit',function(){
        let edit_id = $(this).attr('id');
        let id = edit_id.substring(4,edit_id.length);
        
        $('#editUserModal').modal('show');

        $.ajax({
            url: '/edituser',
            type:'GET',
            data:{id : id},
            dataType:'json',
            success:function(response){
                if(response.status == 'success'){
                    $("#editUserModal").find("#fullname").val(`${response.data.user_info.name}`);
                    $("#editUserModal").find("#email").val(`${response.data.user_info.email}`);
                    $("#editUserModal").find("#password").val(`${response.data.user_info.password}`);
                    $("#editUserModal").find("#kt_inputmask_5").val(`${response.data.user_info.mobile_no}`);
                    $("#editUserModal").find("#kt_datepicker").val(`${response.data.user_info.birth_date}`);
                }
                
            }
        })
    })

    $(document).on('click','.delete',function(){
        let delete_id = $(this).attr('id');
        let del_user_id = delete_id.substring(6,delete_id.length);
        
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true,
        }).then(function (result) {
            if (result.value) {
                Swal.fire({
                    title: "Deleted!",
                    text: "User has been deleted.",
                    icon: "success",
                    // delete:$(`#${del_user_id}`).closest('tr').remove(),
                });

                $.ajax({
                    url: `/userdelete`,
                    type: "GET",
                    data:{id : del_user_id},
                    dataType: "json",
                    success: function (response) {
                        $(`#delete${del_user_id}`).closest("tr").remove();
                        if(response.status == 'success'){
                            $("#kt_datatable").KTDatatable('reload');
                            toastr.error(`${response.data}`);
                        }else{
                            toastr.error(`${response.data}`);
                        }
                    },
                });
                
            } else if (result.dismiss === "cancel") {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your record is safe :)",
                    icon: "error",
                });
            }
        });
    })

    $(document).on('click','.check-class',function(){
        let user_id = $(this).attr('id');
        let id = user_id.substring(4,user_id.length);
        console.log(id);

        let is_active = $(this).is(':checked') ? 1 : 0;
        $.ajax({
            url: '/userstatus',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type:'POST',
            data:{is_active : is_active,id : id },
            dataType:'json',
            success:function(response){
                if(response.status == 'success'){
                    toastr.success(`${response.data}`)
                }else{
                    toastr.error(`${response.data}`);
                }
            }
        })
    })
});
