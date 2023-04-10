"use strict";

var KTLogin = function(){
    var _login;

    var _handleResetForm = function (){
        var validation;
        var form = KTUtil.getById('kt_login_reset_form');
    
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
    
        $('#kt_login_reset_submit').on('click', function (e) {
            e.preventDefault();
    
            let formData = $("#kt_login_reset_form").serialize();
    
            validation.validate().then(function (status) {
                if (status == 'Valid') {
    
                    $.ajax({
                        url: '/resetpassword',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
    
                        success: function (response) {
                            if (response.status == 'success') {
                                // alert(response.status);
                                window.location.href = '/login';
                            } else if (response.status == 'error') {
                                    $("#password_error").html(`${response.data.password}`);
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

            _handleResetForm();
        }
    };
}();



$(document).ready(function () {
    KTLogin.init();
})
