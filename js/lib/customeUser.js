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
        errorClass: 'error-message-red',

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
        errorClass: 'error-message-red',

        submitHandler: function(form) {
            // Form is valid, submit it
            form.submit();
        }
    });
});



$(document).ready(function() {
    $('#inquery').validate({
        rules: {
            name : {
                required : true,
            },
            email: {
                required: true,
                email: true, 
            },
            contactNo: {
                required: true,
            },
        
            message: {
                required: true,
            },
            

        },
        messages: {

            name:{
                required: 'Please Enter Your Name',
            },
           
            email: {
                required: 'Please Enter Email',
                email: 'Please enter a valid email address',
            },
            contactNo: {
                required: 'Please Enter ContactNo'
            },
            
            message: {
                required: 'Please Enter  Message'
            },
            
    
        },
        
        errorElement: 'span', 
        errorClass: 'error-message-red',

        submitHandler: function(form) {
            form.submit();
        }
    });
});

$(document).ready(function() {
    $('#hostelForm').validate({
        rules: {
            image: {
                required: true,
                extension: "jpg|jpeg|png|gif"
            },
            hostelName: {
                required: true,
            },
            description: {
                required: true,
            },
            location: {
                required: true,
            }
        },
        messages: {
            image: {
                required: 'Please select an image file',
                extension: 'Please upload a valid image file (jpg, jpeg, png, gif)'
            },
            hostelName: {
                required: 'Please enter hostel name'
            },
            description: {
                required: 'Please enter description'
            },
            location: {
                required: 'Please enter location'
            },
        },
        errorElement: 'span',
        errorClass: 'error-message-red-red',
        submitHandler: function(form) {
            form.submit();
        }
    });
});




$(document).ready(function() {
    $('#image').change(function() {
        var fileInput = $(this);
        var filePath = fileInput.val();
        
        // Check if the selected file is an image
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload a valid image file (jpg, jpeg, png, gif).');
            fileInput.val('');
            return false;
        }
        return true;
    });
});

$(document).ready(function() {
    $('#EdithostelForm').validate({
        rules: {
            image: {
                required: true,
                extension: "jpg|jpeg|png|gif"
            },
            hostelName: {
                required: true,
            },
            description: {
                required: true,
            },
            location: {
                required: true,
            }
        },
        messages: {
            image: {
                required: 'Please select an image file',
                extension: 'Please upload a valid image file (jpg, jpeg, png, gif)'
            },
            hostelName: {
                required: 'Please enter hostel name'
            },
            description: {
                required: 'Please enter description'
            },
            location: {
                required: 'Please enter location'
            },
        },
        errorElement: 'span',
        errorClass: 'error-message-red',
        submitHandler: function(form) {
            form.submit();
        }
    });
});








$(document).ready(function() {
    $('#EditOwnerForm').validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            phone: {
                required: true,
                digits: true,
                maxlength: 10,
                number: true,
            },
        
            address: {
                required: true,
            }
        },
        messages: {
            name: {
                required: 'Please enter name'
            },
            email: {
                required: 'Please enter email'
            },
            phone: {
                required: 'Please enter  phone no',
                digits: "Please enter only numerical values.",
                maxlength: "Please enter a 10-digit phone number."
            },
            address: {
                required: 'Please enter address'
            },
        },
        
        errorElement: 'span', 
        errorClass: 'error-message-red',

        submitHandler: function(form) {
            // Form is valid, submit it
            form.submit();
        }
    });
});


$(document).ready(function() {
    $('#picture').change(function() {
        var fileInput = $(this);
        var filePath = fileInput.val();
        
        // Check if the selected file is an image
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload a valid image file (jpg, jpeg, png, gif).');
            fileInput.val('');
            return false;
        }
        return true;
    });
});


$(document).ready(function() {
    $('#EditStudentForm').validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            phone: {
                required: true,
                digits: true,
                maxlength: 10,
                number: true,
            },
        
            address: {
                required: true,
            }
        },
        messages: {
            name: {
                required: 'Please enter name'
            },
            email: {
                required: 'Please enter email'
            },
            phone: {
                required: 'Please enter  phone no',
                digits: "Please enter only numerical values.",
                maxlength: "Please enter a 10-digit phone number."
            },
            address: {
                required: 'Please enter address'
            },
        },
        
        errorElement: 'span', // Wrap error messages in <span> tags
        errorClass: 'error-message-red', // Custom class for error messages

        submitHandler: function(form) {
            // Form is valid, submit it
            form.submit();
        }
    });
});


$(document).ready(function() {
    $('#picture').change(function() {
        var fileInput = $(this);
        var filePath = fileInput.val();
        
        // Check if the selected file is an image
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload a valid image file (jpg, jpeg, png, gif).');
            fileInput.val('');
            return false;
        }
        return true;
    });
});

