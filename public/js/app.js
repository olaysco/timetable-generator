var App = {
    Init: function () {
        $('.alert.fade-in').delay(10000).slideUp('fade-in');

        var closeButtons = $('.modal div.alert-danger a[data-dismiss=alert]');

        closeButtons.removeAttr('data-dismiss');

        closeButtons.on('click', function (event) {
            event.preventDefault();
            $(this).parent().addClass('hidden');
        });

        // Select 2
        $(".select2").select2();

        // Date Picker
        $(".datepicker").datepicker({
            autoclose: true
        });

        // iCheck
        $('input').iCheck({
            labelHover: false,
            cursor: true,
            checkboxClass: 'icheckbox_flat-green'
        });

        App.registerEventListeners();
    },

    buildErrorHtml: function (errors) {
        var errorHtml = "";

        if (errors.constructor == Object) {
            // If errors is a complex object returned by Laravel
            // validation methods
            $.each(errors, function (key, value) {
                var curr = value[0];

                // Expand errors if current item is itself an array
                if (curr) {
                    if (curr.constructor == Array) {
                        $.each(curr, function (key, value) {
                            errorHtml += "<li>" + value + "</li>";
                        });
                    }
                    else {
                        errorHtml += "<li>" + curr + "</li>";
                    }
                }
            });
        } else {
            // Else errors is simply an array of error strings stored in the field
            // called errors
            $.each(errors, function (key, value) {
                errorHtml += "<li>" + value + "</li>";
            });
        }

        return errorHtml;
    },

    showConfirmDialog: function (message) {
        $('#confirm-dialog .modal-body p#delete-message').text(message);
        $('#confirm-dialog').modal('show');
    },

    hideConfirmDialog: function () {
        $('#confirm-dialog').modal('hide');
    },

    setDeleteForm: function (actionURL, header, attributes) {
        var form = $('#confirm-dialog .delete-form');

        if (header) {
            form.find('#delete-dialog-header').text(header);
        }

        if (attributes) {
            $.each(attributes, function (attribute, value) {
                form.attr(attribute, value);
            });
        }

        form.attr('action', actionURL);
    },

    submitForm: function (form, callback, $errorContainer, hideModal = true, withFormData = false) {
        var actionURL;
        var formData;

        if (!withFormData) {
            formData = new FormData(form);
            actionURL = $(form).attr('action');
        } else {
            formData = form.data;
            actionURL = form.url;
        }

        NProgress.start();

        // Submit form via ajax
        var ajaxData = {
            url: actionURL,
            type: 'POST',
            data: formData,
            processData: false,
            cache: false,
            contentType: false,
            success: function (responseMsg) {
                // Notify of sucessful action
                new PNotify({
                    title: 'Success',
                    text: responseMsg.message,
                    styling: 'bootstrap3',
                    type: 'success'
                });

                // HIde modal if form is in modal
                if (hideModal) {
                    $('.modal').modal('hide');
                }

                // Run callback functions(usually for refreshing items view after updates)
                if (callback) {
                    callback();
                }

                // Reset the form by clearing the form and re-loading image placeholder
                if (!withFormData) {
                    $(form)[0].reset();
                }

                $(form).find('.image-placeholder').attr('src', '/images/item_image_placeholder.png');

                $('.modal-error-div').find('ul').html('');
            },

            error: function (response, text_status, xhr) {
                if ($errorContainer && response.status == 422) {
                    // We make it possible to extract errors whether they were returned
                    // by Laravel $this->validator or by Validator::make()
                    // The former has errors array directly in JSON response body
                    // while Validator::make() has it in an errors field
                    var responseContent = response.responseJSON;
                    var errors = responseContent.errors ? responseContent.errors : responseContent;

                    var errorHtml = App.buildErrorHtml(errors);

                    $errorContainer.find('ul').html(errorHtml);
                    $('.modal-error-div').removeClass('hidden')
                        .delay(15000).queue(function () {
                            $(this).addClass('hidden').dequeue();
                        });
                    $('#errors-container').show();
                }

                var text = (response.status == 422) ?
                    'The form submission failed. Check form for details.' :
                    'Oops! A system error occurred';

                new PNotify({
                    title: 'Error',
                    text: text,
                    styling: 'bootstrap3',
                    type: 'error',
                    delay: 9500
                });
            }
        };

        $.ajax(ajaxData).always(function () {
            NProgress.done();
        });
    },

	/**
	 * Display the current chosen image to be uploaded in the img tags
	 * set on the img element
	 */
    PreviewImage: function () {
        var imageElement = $(this).data('image-element');
        var defaultImage = $(this).data('default-image');

        if (this.files.length === 0) {
            $(imageElement).attr('src', defaultImage);
            return;
        }

        var image = this.files[0];
        var allowedTypes = ['image/jpeg', 'image/png'];

        if (allowedTypes.indexOf(image.type) === -1 || image.size > $(this).data('parsley-max-file-size') * 1024) {
            $(imageElement).attr('src', defaultImage);
            return;
        }

        var reader = new FileReader();

        // Read the uploaded image file
        reader.readAsDataURL(image);

        // On load then assign it to the image element
        reader.onload = function (event) {
            $(imageElement).attr('src', event.target.result);
        };
    },

    registerEventListeners: function () {
        $(document).on('change', ':file', function () {
            var input = $(this);
            var numFiles = input.get(0).files ? input.get(0).files.length : 1;
            var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        $(document).on('fileselect', ':file', function (event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) console.log(log);
            }
        });

        $(document).on('click', '.menu-link', function(event){
            var url = $(event.target).find('a').attr('href');
            window.location.href = url;
        });

        $('[name=logo]').change(App.PreviewImage);
        $('[name=image]').change(App.PreviewImage);
    },

    extend: function(class1, class2) {
        class2.prototype = Object.create(class1.prototype);
        class1.prototype.constructor = class1;
    },

    appendFormdata: function(FormData, data, name){
        name = name || '';
        if (typeof data === 'object') {
            $.each(data, function (index, value) {
                if (name == '') {
                    App.appendFormdata(FormData, value, index);
                } else {
                    App.appendFormdata(FormData, value, name + '[' + index + ']');
                }
            })
        } else {
            FormData.append(name, data);
        }
    }
};

window.addEventListener('load', App.Init);