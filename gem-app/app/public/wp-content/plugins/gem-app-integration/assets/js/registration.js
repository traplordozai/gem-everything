(function($) {
    'use strict';

    const GEMRegistration = {
        init: function() {
            this.form = $('#gem-registration-form');
            this.messages = this.form.find('.form-messages');
            
            this.bindEvents();
        },

        bindEvents: function() {
            this.form.on('submit', this.handleSubmit.bind(this));
        },

        handleSubmit: function(e) {
            e.preventDefault();

            this.clearMessages();
            this.setLoading(true);

            const formData = new FormData(e.target);
            
            $.ajax({
                url: gemAppReg.ajaxUrl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: this.handleResponse.bind(this),
                error: this.handleError.bind(this)
            });
        },

        handleResponse: function(response) {
            this.setLoading(false);

            if (response.success) {
                this.showSuccess(response.data.message);
                
                // Redirect after successful registration
                if (response.data.redirect) {
                    setTimeout(() => {
                        window.location.href = response.data.redirect;
                    }, 1500);
                }
            } else {
                this.showError(response.data);
            }
        },

        handleError: function(xhr) {
            this.setLoading(false);
            this.showError('Registration failed. Please try again.');
        },

        showSuccess: function(message) {
            this.messages
                .removeClass('error')
                .addClass('success')
                .html(`<p>${message}</p>`);
        },

        showError: function(message) {
            this.messages
                .removeClass('success')
                .addClass('error')
                .html(`<p>${message}</p>`);
        },

        clearMessages: function() {
            this.messages
                .removeClass('success error')
                .empty();
        },

        setLoading: function(isLoading) {
            const btn = this.form.find('button[type="submit"]');
            
            if (isLoading) {
                btn.prop('disabled', true)
                   .html('<span class="spinner"></span>Loading...');
            } else {
                btn.prop('disabled', false)
                   .html('Register');
            }
        }
    };

    $(document).ready(function() {
        GEMRegistration.init();
    });

})(jQuery);