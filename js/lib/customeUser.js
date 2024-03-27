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
            },
            contact_no: {
                required: true,
            }

        },
        messages: {
            account_type: {
                required: 'Please Select Your role '
            },
            username: {
                required: 'Please Enter UserName '
            },
            email: {
                required: 'Please Enter Email',
                email: 'Please enter a valid email address',
            },
            password: {
                required: 'Please Enter Password'
            },
            
            contact_no: {
                required: 'Please Enter ContactNo'
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


$(document).ready(function() {
    $('#loginForm').validate({
        rules: {
           
            email: {
                required: true,
                email: true, 
            },
            password: {
                required: true,
            },
            

        },
        messages: {
           
            email: {
                required: 'Please Enter Email',
                email: 'Please enter a valid email address',
            },
            password: {
                required: 'Please Enter Password'
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

