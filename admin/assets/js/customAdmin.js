$(document).ready(function() {
    $('#hostelForm').validate({
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
            password: {
                required: true,
            },
        
            image: {
                required: true,
                //  picture: true,
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
            password: {
                required: 'Please enter password'
            },
            image: {
                required: 'Please enter image'
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
        
        errorElement: 'span', // Wrap error messages in <span> tags
        errorClass: 'error-message', // Custom class for error messages

        submitHandler: function(form) {
            // Form is valid, submit it
            form.submit();
        }
    });
});


$(document).ready(function() {
    $('#EdithostelForm').validate({
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
                maxlength: 10
            },
            // password: {
            //     required: true,
            // },
        
            // picture: {
            //     required: true,
            //     picture: true
            // },
        
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
            password: {
                required: 'Please enter password'
            },
            picture: {
                required: 'Please enter picture'
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
        
        errorElement: 'span', // Wrap error messages in <span> tags
        errorClass: 'error-message', // Custom class for error messages

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
    $('#StudentInfo').validate({
        rules: {
            studentname: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            contact_no: {
                required: true,
                digits: true,
                maxlength: 10,
                number: true,
            },
            password: {
                required: true,
            },
        
            image: {
                required: true,
                //  picture: true,
            },
        
            address: {
                required: true,
            }
        },
        messages: {
            studentname: {
                required: 'Please enter name'
            },
            email: {
                required: 'Please enter email'
            },
            contact_no: {
                required: 'Please enter  phone no',
                digits: "Please enter only numerical values.",
                maxlength: "Please enter a 10-digit phone number."
            },
            password: {
                required: 'Please enter password'
            },
            image: {
                required: 'Please select Image '
            },
        
            address: {
                required: 'Please enter address'
            },
        },
        
        errorElement: 'span', // Wrap error messages in <span> tags
        errorClass: 'error-message', // Custom class for error messages

        submitHandler: function(form) {
            // Form is valid, submit it
            form.submit();
        }
    });
});



$(document).ready(function() {
    $('#EditStudentInfo').validate({
        rules: {
            studentname: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            contact_no: {
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
            studentname: {
                required: 'Please enter name'
            },
            email: {
                required: 'Please enter email'
            },
            contact_no: {
                required: 'Please enter  phone no',
                digits: "Please enter only numerical values.",
                maxlength: "Please enter a 10-digit phone number."
            },
            address: {
                required: 'Please enter address'
            },
        },
        
        errorElement: 'span', // Wrap error messages in <span> tags
        errorClass: 'error-message', // Custom class for error messages

        submitHandler: function(form) {
            // Form is valid, submit it
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

