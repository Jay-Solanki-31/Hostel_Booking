$(document).ready(function() {
    $('#account_form').validate({
        rules: {
            account_type: {
                required: true,
            },
            username: {
                required: true,
                username: true,
            },
            email: {
                required: true,
                email: true, 
            },
            password: {
                required: true,
            }
        },
        messages: {
            account_type: {
                required: 'Please enter Your role '
            },
            username: {
                required: 'Please enter UserName '
            },
            email: {
                required: 'Please enter Email',
                email: 'Please enter a valid email address',
            },
            password: {
                required: 'Please enter password'
            },
        },
        
        errorElement: 'span', 
        errorClass: 'error-message',

        submitHandler: function(form) {
            // Form is valid, submit it
            form.submit();
        }
    });
});
