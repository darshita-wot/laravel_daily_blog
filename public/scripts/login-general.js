"use strict";

// Class Definition
var KTLogin = function () {
    var _login;

    var _showForm = function (form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');
        _login.removeClass('login-signup-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }

    var _handleSignInForm = function () {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            KTUtil.getById('kt_login_signin_form'), {
                fields: {
                    username: {
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
                    password: {
                        validators: {
                            notEmpty: {
                                message: "Password is required",
                            },
                            stringLength: {
                                message:
                                    "The password must be more than 5 characters long",
                                min: 5,
                            },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();
            let formData = $("#kt_login_signin_form").serialize();

            validation.validate().then(function (status) {
                if (status == 'Valid') {
                    $.ajax({
                        url: '/login',
                        type: 'POST',
                        data : formData,
                        dataType: 'json',
                        success: function(response){
                            if(response.status == 'success'){
                                window.location.href = '/home';
                            }else if(response.status == 'error'){
                                if (response.data.username) {
                                    $("#username_error").html(
                                        `${response.data.username}`
                                    );
                                } else {
                                    $("#username_error").html("");
                                }

                                if (response.data.password) {
                                    $("#password_error").html(
                                        `${response.data.password}`
                                    );
                                } else {
                                    $("#password_error").html("");
                                }
                            }else if(response.status == 'invalid'){
                                if (response.data) {
                                    $("#invalid_error").html(
                                        `${response.data}`
                                    );
                                } else {
                                    $("#invalid_error").html("");
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

        // Handle forgot button
        $('#kt_login_forgot').on('click', function (e) {
            e.preventDefault();
            _showForm('forgot');
        });

        // Handle signup
        $('#kt_login_signup').on('click', function (e) {
            e.preventDefault();
            _showForm('signup');
        });
    }

    var _handleSignUpForm = function (e) {
        var validation;
        var form = KTUtil.getById('kt_login_signup_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
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
                    cpassword: {
                        validators: {
                            notEmpty: {
                                message: "The password confirmation is required",
                            },
    
                            identical: {
                                compare: function () {
                                    return form.querySelector('[name="password"]')
                                        .value;
                                },
                                message:
                                    "The password and its confirm are not the same",
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
                    
                    agree: {
                        validators: {
                            notEmpty: {
                                message: "You must accept the terms and conditions",
                            },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        $('#kt_login_signup_submit').on('click', function (e) {
            e.preventDefault();
            let formData = $("#kt_login_signup_form").serialize();

            validation.validate().then(function (status) {
                if (status == 'Valid') {
                    
                    $.ajax({
                        url: '/registration',
                        type: 'POST',
                        data : formData,
                        dataType: 'json',
                        success: function(response){
                            alert('here');
                            if(response.status == 'success'){
                                window.location.href = '/login';
                            }else{
                                console.log('inside else');
                            }
                        
                            // else{
                            //     if (response.data.name) {
                            //         $("#fullname_error").html(
                            //             `${response.data.name}`
                            //         );
                            //     } else {
                            //         $("#fullname_error").html("");
                            //     }

                            //     if (response.errors.email) {
                            //         $("#email_error").html(
                            //             `${response.errors.email}`
                            //         );
                            //     } else {
                            //         $("#email_error").html("");
                            //     }

                            //     if (response.data.password) {
                            //         $("#password_error").html(
                            //             `${response.data.password}`
                            //         );
                            //     } else {
                            //         $("#password_error").html("");
                            //     }

                            //     if (response.data.mobile_no) {
                            //         $("#mobileno_error").html(
                            //             `${response.data.mobile_no}`
                            //         );
                            //     } else {
                            //         $("#mobileno_error").html("");
                            //     }

                            //     if (response.data.birthday_date) {
                            //         $("#birthdaydate_error").html(
                            //             `${response.data.birthday_date}`
                            //         );
                            //     } else {
                            //         $("#birthdaydate_error").html("");
                            //     }
                            // }
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

        // Handle cancel button
        $('#kt_login_signup_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    var _handleForgotForm = function (e) {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            KTUtil.getById('kt_login_forgot_form'), {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email address is required'
                            },
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        // Handle submit button
        $('#kt_login_forgot_submit').on('click', function (e) {
            e.preventDefault();
            var formData = $("#kt_login_forgot_form").serialize();

            validation.validate().then(function (status) {
                if (status == 'Valid') {
                    // Submit form
                    // KTUtil.scrollTop();
                    $.ajax({
                        url: "/forgotpassword",
                        type: "post",
                        data: formData,
                        dataType: "json",

                        beforeSend:function(){
                            KTApp.blockPage({
                                overlayColor: '#000000',
                                state: 'danger',
                                message: 'Please wait...'
                            });
                        
                        },

                        success: function (response) {
                            
                            if (response.status == 'success') {
                                toastr.success( `${response.data}`);
                            }else if(response.status == 'error') {
                                toastr.warning(`${response.data}`);
                            }

                        },

                        complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                            KTApp.unblockPage();
                        },
                    });
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

        // Handle cancel button
        $('#kt_login_forgot_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function () {
            _login = $('#kt_login');

            _handleSignInForm();
            _handleSignUpForm();
            _handleForgotForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function () {
    KTLogin.init();
});

