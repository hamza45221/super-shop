"use strict";

// Class definition
var KTAppEcommerceSaveProduct = function () {

    // Private functions
    var images = [];

    // Init Quill editor
    const initQuill = () => {
        const elements = [
            '#kt_ecommerce_add_product_description',
            '#kt_ecommerce_add_product_meta_description'
        ];

        elements.forEach(element => {
            let quillElement = document.querySelector(element);
            if (!quillElement) return;

            new Quill(quillElement, {
                modules: {
                    toolbar: [
                        [{ header: [1, 2, false] }],
                        ['bold', 'italic', 'underline'],
                        ['image', 'code-block']
                    ]
                },
                placeholder: 'Type your text here...',
                theme: 'snow' // or 'bubble'
            });
        });
    }

    // Init Tagify
    const initTagify = () => {
        // Implement tagify initialization if required
    }

    // Init Form Repeater
    const initFormRepeater = () => {
        $('#kt_ecommerce_add_product_options').repeater({
            initEmpty: false,
            defaultValues: { 'text-input': 'foo' },
            show: function () {
                $(this).slideDown();
                initConditionsSelect2();
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }

    // Init Select2 for repeated elements
    const initConditionsSelect2 = () => {
        $('[data-kt-ecommerce-catalog-add-product="product_option"]').each(function () {
            if (!$(this).hasClass("select2-hidden-accessible")) {
                $(this).select2({ minimumResultsForSearch: -1 });
            }
        });
    }

    // Init NoUISlider (Placeholder, can be expanded)
    const initSlider = () => {
        let slider = document.querySelector("#kt_ecommerce_add_product_discount_slider");
        let value = document.querySelector("#kt_ecommerce_add_product_discount_label");
        if (slider) {
            // Initialize the slider here if necessary
        }
    }

    // Init Dropzone
    const initDropzone = () => {
        let dropzoneElement = document.querySelector("#kt_ecommerce_add_product_media");
        if (!dropzoneElement) return;

        let myDropzone = new Dropzone(dropzoneElement, {
            url: "/admin/vehicle/upload-media?_token=" + $('[name=csrf-token]').attr('content'),
            paramName: "image",
            maxFiles: 10,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            thumbnailWidth: 150,
            thumbnailHeight: null,
            init: function () {
                if (typeof existingFiles !== "undefined" && Array.isArray(existingFiles)) {
                    existingFiles.forEach(fileInfo => {
                        let mockFile = { url: fileInfo, size: 99, type: "image/jpeg", serverId: null };
                        this.emit("addedfile", mockFile);
                        this.emit("thumbnail", mockFile, "/storage/" + fileInfo);
                        this.emit("complete", mockFile);
                        images.push({ path: fileInfo });
                        mockFile.previewElement.classList.add('dz-success', 'dz-complete');
                    });

                    document.querySelectorAll('.dz-image img').forEach(img => {
                        let parent = img.parentElement;
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

                this.on("removedfile", function (file) {
                    images = images.filter(item => item.path !== file.url);
                    document.getElementById('images_json').value = JSON.stringify(images);
                    if (file.url) {
                        fetch(`/admin/vehicle/delete-file?name=${file.url}`, {
                            method: "GET",
                            headers: { "Content-Type": "application/json" }
                        }).then(response => {
                            if (response.ok) {
                                console.log("File deleted successfully on the server");
                            } else {
                                console.error("Error deleting file on the server");
                            }
                        }).catch(error => {
                            console.error("Error:", error);
                        });
                    }
                });
            }
        });

        myDropzone.on("success", function (file, response) {
            images.push({ uuid: file.upload.uuid, path: response.path });
            document.getElementById('images_json').value = JSON.stringify(images);
        });
    }

    // Handle discount options (Placeholder)
    const handleDiscount = () => {
        // Implement discount logic if required
    }

    // Init function
    const init = () => {
        initQuill();
        initTagify();
        initFormRepeater();
        initConditionsSelect2();
        initSlider();
        initDropzone();
        handleDiscount();
    }

    return {
        init: init
    };

}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSaveProduct.init();
});
