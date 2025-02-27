"use strict";

// Class definition
var KTModalCustomersAdd = function () {
    var submitButton;
    var cancelButton;
    var closeButton;
    var validator;
    var form;
    var modal;

    // Init form inputs
    var handleForm = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'code': {
                        validators: {
                            notEmpty: {
                                message: 'code Name is required'
                            }
                        }
                    },
                    'valid_from': {
                        validators: {
                            notEmpty: {
                                message: 'valid from  is required'
                            }
                        },
                    },
                    'valid_till': {
                        validators: {
                            notEmpty: {
                                message: 'valid till  is required'
                            }
                        },
                    },
                    'use_limit': {
                        validators: {
                            notEmpty: {
                                message: 'total uses  is required'
                            }
                        },
                    },
                    'total_uses': {
                        validators: {
                            notEmpty: {
                                message: 'total uses  is required'
                            }
                        },
                    },
                    'discount_type': {
                        validators: {
                            notEmpty: {
                                message: 'discount type  is required'
                            }
                        },
                    },
                    'minimum_amount': {
                        validators: {
                            notEmpty: {
                                message: 'minimum amount  is required'
                            }
                        },
                    },
                    'discount': {
                        validators: {
                            notEmpty: {
                                message: 'discount  is required'
                            }
                        },
                    },


                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Revalidate country field. For more info, plase visit the official plugin site: https://select2.org/
        $(form.querySelector('[name="country"]')).on('change', function() {
            // Revalidate the field when an option is chosen
            validator.revalidateField('country');
        });
        var edit=false;
        var editId=0;
        $(document).on("click",'.btn-edit',function(){
            editId=$(this).attr('data-id');
            console.log($(this).attr('data-dt'));
            var data=JSON.parse($(this).attr('data-dt'));

            $('input[name=domain_id]').val(data.domain_id);
            $('input[name=code]').val(data.code);
            $('input[name=valid_from]').val(data.valid_from);
            $('input[name=valid_till]').val(data.valid_till);
            $('input[name=use_limit]').val(data.use_limit);
            $('input[name=total_uses]').val(data.total_uses);
            $('input[name=discount_type]').val(data.discount_type);
            $('input[name=minimum_amount]').val(data.minimum_amount);
            $('input[name=discount]').val(data.discount);
            $('input[name=status]').val(data.status);
            edit=true;

        })
        $('#kt_modal_add_customer').on('hide.bs.modal',function(){
            edit=false;
            $('input[name=domain_id]').val('');
            $('input[name=code]').val('');
            $('input[name=valid_from]').val('');
            $('input[name=valid_till]').val('');
            $('input[name=use_limit]').val('');
            $('input[name=total_uses]').val('');
            $('input[name=discount_type]').val('');
            $('input[name=minimum_amount]').val('');
            $('input[name=discount]').val('');
            $('input[name=status]').val('');
            console.log('modal hide');

        });

        // Action buttons
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');

                    if (status == 'Valid') {
                        var formData=new FormData($('#kt_modal_add_customer_form')[0]);
                        if (edit==true){
                            formData.append('edit',true);
                            formData.append('id',editId);
                        }
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable submit button whilst loading
                        submitButton.disabled = true;
                        $.ajax({
                            url: $('#kt_modal_add_customer_form').attr('action'),
                            method: $('#kt_modal_add_customer_form').attr('method'),
                            data:formData,
                            cache : false,
                            processData: false,
                            contentType: false,
                            success:function(data){
                                submitButton.removeAttribute('data-kt-indicator');
                                edit=false;
                                swal.fire({
                                    text: "Successfully added new Promocode.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Continue",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-light-primary"
                                    }
                                });
                                modal.hide();


                                // Enable submit button after loading
                                submitButton.disabled = false;
                                setTimeout(function(){
                                    window.location.reload();
                                },500)

                            },
                            error:function(error){
                                console.log(error);
                                submitButton.disabled = false;
                                submitButton.removeAttribute('data-kt-indicator');
                                edit=false;
                                toastr.error('',error.responseJSON.message);

                            }
                        });
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        });

        cancelButton.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form
                    modal.hide(); // Hide modal
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        closeButton.addEventListener('click', function(e){
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form
                    modal.hide(); // Hide modal
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        })
    }

    return {
        // Public functions
        init: function () {
            // Elements
            modal = new bootstrap.Modal(document.querySelector('#kt_modal_add_customer'));

            form = document.querySelector('#kt_modal_add_customer_form');
            submitButton = form.querySelector('#kt_modal_add_customer_submit');
            cancelButton = form.querySelector('#kt_modal_add_customer_cancel');
            closeButton = form.querySelector('#kt_modal_add_customer_close');
            $('.my-from-to-datepicker').flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
            });
            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTModalCustomersAdd.init();
});
