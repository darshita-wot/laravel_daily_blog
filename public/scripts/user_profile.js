"use strict";

var KTLogin = function () {
    var _login;

    var _handleChangePasswordForm = function () {
        var validation;
        var form = KTUtil.getById('change_password_form');

        validation = FormValidation.formValidation(
            form, {
                fields: {
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required',
                            },
                            stringLength: {
                                message: 'The name must be more than 5 characters long',
                                min: 5,
                            },
                        },
                    },
                    password_confirmation: {
                        validators: {
                            notEmpty: {
                                message: "The password confirmation is required",
                            },

                            identical: {
                                compare: function () {
                                    return form.querySelector('[name="password"]')
                                        .value;
                                },
                                message: "The password and its confirm are not the same",
                            },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            },
        );

        $('#password_change_submit').on('click', function (e) {
            e.preventDefault();

            let formData = $("#change_password_form").serialize();

            validation.validate().then(function (status) {
                if (status == 'Valid') {

                    $.ajax({
                        url: '/changepassword',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',

                        success: function (response) {
                            if (response.status == 'success') {
                                // alert(response.status);
                                toastr.success(`${response.data}`);
                                $('#password_change_submit').trigger('reset');
                                // window.location.href = '/login';
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
    }
    // Public Functions
    return {
        // public functions
        init: function () {
            _login = $('#kt_login');

            _handleChangePasswordForm();
        }
    };
}();

$(document).ready(function () {

    KTLogin.init();
    //update my profile
    $('#myprofile_form').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        console.log(formData.get("mobileno"));
        console.log(formData.get("id"));

        $.ajax({
            url: '/myprofileupdate',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",

            success: function (response) {
                if (response.status == 'success') {

                    $('#profile_photo').attr('src', `storage/${response.profile_photo}`);
                    window.location.href = '/home';
                }
            },
        });
    })

    $('.delete_account').on('click', function (e) {
        let user_id = $(this).attr('id');
        let id = user_id.substring(4, user_id.length);
        console.log(id);
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
                    text: "Account has been deleted.",
                    icon: "success",
                });

                $.ajax({
                    url: `/delete-user-account`,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "POST",
                    data:{id:id},
                   
                    dataType: "json",

                    success: function (response) {
                        if (response.status == 'success') {
                            toastr.success(`${response.data}`);
                            window.location.href = '/login';
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
})
