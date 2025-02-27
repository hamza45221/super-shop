"use strict";

// Class definition
var KTAppEcommerceSaveProduct = function () {

    // Private functions
    var images = [];

    // Init quill editor
    const initQuill = () => {
        // Define all elements for quill editor
        const elements = [
            '#kt_ecommerce_add_product_description',
            '#kt_ecommerce_add_product_meta_description'
        ];

        // Loop all elements
        elements.forEach(element => {
            // Get quill element
            let quill = document.querySelector(element);

            // Break if element not found
            if (!quill) {
                return;
            }

            // Init quill --- more info: https://quilljs.com/docs/quickstart/
            quill = new Quill(element, {
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        ['image', 'code-block']
                    ]
                },
                placeholder: 'Type your text here...',
                theme: 'snow' // or 'bubble'
            });
        });
    }

    // Init tagify
    const initTagify = () => {
        // Define all elements for tagify
        // const elements = [
        //     '#kt_ecommerce_add_product_category',
        //     '#kt_ecommerce_add_product_tags'
        // ];
        //
        // // Loop all elements
        // elements.forEach(element => {
        //     // Get tagify element
        //     const tagify = document.querySelector(element);
        //
        //     // Break if element not found
        //     if (!tagify) {
        //         return;
        //     }
        //
        //     // Init tagify --- more info: https://yaireo.github.io/tagify/
        //     new Tagify(tagify, {
        //         whitelist: ["new", "trending", "sale", "discounted", "selling fast", "last 10"],
        //         dropdown: {
        //             maxItems: 20,           // <- mixumum allowed rendered suggestions
        //             classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
        //             enabled: 0,             // <- show suggestions on focus
        //             closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
        //         }
        //     });
        // });
    }

    // Init form repeater --- more info: https://github.com/DubFriend/jquery.repeater
    const initFormRepeater = () => {
        $('#kt_ecommerce_add_product_options').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();

                // Init select2 on new repeated items
                initConditionsSelect2();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }
    const initHighDemandRepeater = () => {
        $('#high_demand_repeater').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();

                // Init select2 on new repeated items
                initConditionsSelect2();
                $('.date-range-high-demand').daterangepicker();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }
    const additionalOptionRepeater = () => {
        $('#additional_option_repeater').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();

                // Init select2 on new repeated items
                // initConditionsSelect2();
                // $('.date-range-high-demand').daterangepicker();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }

    // Init condition select2
    const initConditionsSelect2 = () => {
        // Tnit new repeating condition types
        const allConditionTypes = document.querySelectorAll('[data-kt-ecommerce-catalog-add-product="product_option"]');
        allConditionTypes.forEach(type => {
            if ($(type).hasClass("select2-hidden-accessible")) {
                return;
            } else {
                $(type).select2({
                    minimumResultsForSearch: -1
                });
            }
        });
    }


    // Init noUIslider
    const initSlider = () => {
        var slider = document.querySelector("#kt_ecommerce_add_product_discount_slider");
        var value = document.querySelector("#kt_ecommerce_add_product_discount_label");

        // noUiSlider.create(slider, {
        //     start: [10],
        //     connect: true,
        //     range: {
        //         "min": 1,
        //         "max": 100
        //     }
        // });
        //
        // slider.noUiSlider.on("update", function (values, handle) {
        //     value.innerHTML = Math.round(values[handle]);
        //     if (handle) {
        //         value.innerHTML = Math.round(values[handle]);
        //     }
        // });
    }

    // Init DropzoneJS --- more info:

    const initDropzone = () => {

        var myDropzone = new Dropzone("#kt_ecommerce_add_product_media", {
            url: "/admin/vehicle/upload-media?_token=" + $('[name=csrf-token]').attr('content'), // Set the url for your upload script location
            paramName: "image", // The name that will be used to transfer the file
            maxFiles: 10,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            thumbnailWidth: 150,
            thumbnailHeight: null,
            init: function () {
                if (typeof existingFiles !== "undefined" && Array.isArray(existingFiles)) {
                    existingFiles.forEach(fileInfo => {

                        console.log('http://localhost/storage/' + fileInfo);
                        // Erzeuge ein Mock-File Objekt
                        let mockFile = {
                            url: fileInfo,
                            size: 99,
                            type: "image/jpeg",
                            serverId: null,
                        };
                        // Füge es dem Dropzone-Interface hinzu
                        this.emit("addedfile", mockFile);
                        let previewEl = mockFile.previewElement;
                        let imgEl = previewEl.querySelector(".dz-image img");
                        if (imgEl) {
                            imgEl.src = "/storage/" + fileInfo;
                        }
                        this.emit("thumbnail", mockFile, "/storage/" + fileInfo);


                        // Markiere es als vollständig hochgeladen
                        this.emit("complete", mockFile);
                        images.push({path: fileInfo});
                        // Optional: Setze optisch die Klassen, damit es "grün" ist
                        mockFile.previewElement.classList.add('dz-success');
                        mockFile.previewElement.classList.add('dz-complete');
                    });
                    document.querySelectorAll('.dz-image img').forEach((img) => {
                        const parent = img.parentElement; // Der übergeordnete Container

                        // CSS-Eigenschaften für den Container setzen
                        parent.style.display = 'flex';
                        parent.style.justifyContent = 'center';
                        parent.style.alignItems = 'center';
                        parent.style.overflow = 'hidden';
                        parent.style.width = '150px';
                        parent.style.height = '150px';
                        img.style.objectFit = 'cover';
                        img.style.width = '100%';
                        img.style.height = '100%';
                    });

                    document.getElementById('images_json').value = JSON.stringify(images);
                }
                // Handle the `removedfile` event
                this.on("removedfile", function (file) {
                    console.log("File removed:", file);
                    images = images.filter(item => item.path !== file.url);
                    document.getElementById('images_json').value = JSON.stringify(images);
                    if (file.url) {
                        fetch(`/admin/vehicle/delete-file?name=${file.url}`, {
                            method: "GET",
                            headers: {
                                "Content-Type": "application/json"
                            },
                        })
                            .then(response => {
                                if (response.ok) {
                                    console.log(response);
                                    console.log("File deleted successfully on the server");
                                } else {
                                    console.error("Error deleting file on the server");
                                }
                            })
                            .catch(error => {
                                console.error("Error:", error);
                            });
                    }
                });
            },
            accept: function (file, done) {
                if (file.name == "wow.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        });
        myDropzone.on("success", function (file, response) {
            console.log("File uploaded successfully:", file);
            console.log("Server response:", response);
            images.push({uuid: file.upload.uuid, path: response.path})
            document.getElementById('images_json').value = JSON.stringify(images);

            // You can process the response here
            // For example:
            // if (response.status === "success") {
            //     alert("Upload successful!");
            // }
        });
    }

    // Handle discount options
    const handleDiscount = () => {

    }

    // Shipping option handler
    const handleShipping = () => {

    }

    // Category status handler
    const handleStatus = () => {
        const target = document.getElementById('kt_ecommerce_add_product_status');
        const select = document.getElementById('kt_ecommerce_add_product_status_select');
        const statusClasses = ['bg-success', 'bg-warning', 'bg-danger'];

        $(select).on('change', function (e) {
            const value = e.target.value;

            switch (value) {
                case "published": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-success');
                    hideDatepicker();
                    break;
                }
                case "scheduled": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-warning');
                    showDatepicker();
                    break;
                }
                case "inactive": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-danger');
                    hideDatepicker();
                    break;
                }
                case "draft": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-primary');
                    hideDatepicker();
                    break;
                }
                default:
                    break;
            }
        });


        // Handle datepicker
        const datepicker = document.getElementById('kt_ecommerce_add_product_status_datepicker');

        // Init flatpickr --- more info: https://flatpickr.js.org/
        $('#kt_ecommerce_add_product_status_datepicker').flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        const showDatepicker = () => {
            // datepicker.parentNode.classList.remove('d-none');
        }

        const hideDatepicker = () => {
            // datepicker.parentNode.classList.add('d-none');
        }
    }

    // Condition type handler
    const handleConditions = () => {
        const allConditions = document.querySelectorAll('[name="method"][type="radio"]');
        const conditionMatch = document.querySelector('[data-kt-ecommerce-catalog-add-category="auto-options"]');
        allConditions.forEach(radio => {
            radio.addEventListener('change', e => {
                if (e.target.value === '1') {
                    conditionMatch.classList.remove('d-none');
                } else {
                    conditionMatch.classList.add('d-none');
                }
            });
        })
    }
    const handleProtectionPackage = () => {
        $('#protection_package').on('change', function (e) {
            console.log(e);
            var selectedPackages = $('#protection_package').select2('data');
            console.log('Packages', selectedPackages);

            // Store existing inputs and their values
            var existingValues = {};
            $('.protection-package-detail input').each(function () {
                var id = $(this).data('id');
                existingValues[id] = $(this).val();
            });

            var html = ``;
            for (var i = 0; i < selectedPackages.length; i++) {
                var packageId = selectedPackages[i].id;
                var packageText = selectedPackages[i].text;
                var packagePrice = selectedPackages[i].price_per_day;

                // Use existing value if available, otherwise default to `price_per_day`
                var inputValue = existingValues[packageId] || packagePrice;

                html += `<input type="number"
                       name="packages[${packageId}][price_per_day]"
                       placeholder="Price Per Day ${packageText}"
                       value="${inputValue}"
                       data-id="${packageId}"
                       class="form-control mb-2" />`;
            }

            $('.protection-package-detail').html(html);
        });
    }

    // Submit form handler
    const handleSubmit = () => {
        // Define variables
        let validator;

        // Get elements
        const form = document.getElementById('kt_ecommerce_add_product_form');
        const submitButton = document.getElementById('kt_ecommerce_add_product_submit');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'Product name is required'
                            }
                        }
                    },
                    'location_id': {
                        validators: {
                            notEmpty: {
                                message: 'Location  is required'
                            }
                        }
                    },
                    'category_id': {
                        validators: {
                            notEmpty: {
                                message: 'Category  is required'
                            }
                        }
                    },
                    'subtitle': {
                        validators: {
                            notEmpty: {
                                message: 'Subtitle is required'
                            }
                        }
                    },
                    // 'price': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Vehicle base price/day is required'
                    //         }
                    //     }
                    // },
                    'seats': {
                        validators: {
                            notEmpty: {
                                message: 'No of seats are required'
                            }
                        }
                    },
                    'carry_bag': {
                        validators: {
                            notEmpty: {
                                message: 'This field is required '
                            }
                        }
                    },
                    'suitcase': {
                        validators: {
                            notEmpty: {
                                message: 'This field is required '
                            }
                        }
                    },

                    'min_driving_age': {
                        validators: {
                            notEmpty: {
                                message: 'This field is required '
                            }
                        }
                    },
                    'doors': {
                        validators: {
                            notEmpty: {
                                message: 'This field is required '
                            }
                        }
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

        // Handle submit button
        submitButton.addEventListener('click', e => {
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');

                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable submit button whilst loading
                        submitButton.disabled = true;


                        // Create a FormData object from the form
                        const formData = new FormData(form);

                        formData.append('images', JSON.stringify(images))
                        $.ajax({
                            url: $(form).attr('action'), // Form action URL
                            method: $(form).attr('method'), // Form method (e.g., POST)
                            data: formData, // Send the FormData object

                            processData: false, // Prevent jQuery from automatically transforming the FormData object
                            contentType: false, // Prevent jQuery from overriding the Content-Type
                            success: function (response) {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                $('.vehicle_id').val(response.id);
                                console.log('Form submitted successfully:', response); // Handle success
                                Swal.fire({
                                    text: "Vehicle has been added successfully!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        // Enable submit button after loading
                                        submitButton.disabled = false;

                                        if($('.general-tab').hasClass('active')){
                                            $('.pricing-tab').tab('show');
                                        }else if( $('.pricing-tab').hasClass('active')){
                                            $('.documents-tab').tab('show');
                                        }else{
                                            window.location = form.getAttribute("data-kt-redirect");
                                        }
                                        // Redirect to customers list page
                                        //
                                    }
                                })
                            },
                            error: function (xhr, status, error) {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                console.error('Error submitting form:', error); // Handle error
                            }
                        });
                        // setTimeout(function () {
                        //     submitButton.removeAttribute('data-kt-indicator');
                        //
                        //     Swal.fire({
                        //         text: "Form has been successfully submitted!",
                        //         icon: "success",
                        //         buttonsStyling: false,
                        //         confirmButtonText: "Ok, got it!",
                        //         customClass: {
                        //             confirmButton: "btn btn-primary"
                        //         }
                        //     }).then(function (result) {
                        //         if (result.isConfirmed) {
                        //             // Enable submit button after loading
                        //             submitButton.disabled = false;
                        //
                        //             // Redirect to customers list page
                        //             window.location = form.getAttribute("data-kt-redirect");
                        //         }
                        //     });
                        // }, 2000);
                    } else {
                        Swal.fire({
                            html: "Sorry, looks like there are some errors detected, please try again. <br/><br/>Please note that there may be errors in the <strong>General</strong> or <strong>Advanced</strong> tabs",
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
        })
    }

    // Public methods
    return {
        init: function () {
            // Init forms
            initQuill();
            initTagify();
            initSlider();
            initFormRepeater();
            initHighDemandRepeater();
            initDropzone();
            initConditionsSelect2();
            handleProtectionPackage();
            additionalOptionRepeater();
            // Handle forms
            handleStatus();
            handleConditions();
            handleDiscount();
            handleShipping();
            handleSubmit();
            $('.date-range-high-demand').daterangepicker();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSaveProduct.init();
});
