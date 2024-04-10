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
                digits: true,
                maxlength: 10,
                number: true,
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
                required: 'Please enter  phone no',
                digits: "Please enter only numerical values.",
                maxlength: "Please enter a 10-digit phone number."
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
        errorClass: 'error-message-red',
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


    $(document).ready(function() {
        $('#passwordForm').validate({
            rules: {
                current_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                },
                confirm_password: {
                    required: true,
                    equalTo: "#new_password" // Ensure new password and confirm password match
                }
            },
            messages: {
                current_password: {
                    required: 'Please enter your current password.'
                },
                new_password: {
                    required: 'Please enter a new password.',
                },
                confirm_password: {
                    required: 'Please confirm your new password.',
                    equalTo: 'Passwords do not match. Please enter the same password as above.'
                }
            },
            errorElement: 'span', // Wrap error messages in <span> tags
            errorClass: 'error-message-red', // Custom class for error messages

            submitHandler: function(form) {
                // Form is valid, submit it
                form.submit();
            }
        });
    });


// // add hostel ajex part will hear 


//     $(document).ready(function() {
//         $('#submitHostel').click(function() {
//             var formData = new FormData($('#hostelForm')[0]);

//             $.ajax({
//                 url: 'UserController.php',
//                 type: 'POST',
//                 data: formData,
//                 processData: false,
//                 contentType: false,
//                 success: function(response) {
//                     console.log(response);
//                 },
//                 error: function(xhr, status, error) {
//                     console.error(xhr.responseText);
//                     alert("Error adding hostel. Please try again later.");
//                 }
//             });
//         });
//     });
    $(document).ready(function() {
        $('#AssignHostel').click(function() {
            var formData = new FormData($('#assignhostelForm')[0]);
    
            $.ajax({
                url: 'config/ajax.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    try {
                        var responseData = JSON.parse(response);
                        if (responseData.success) { 
                            alert(responseData.message); 
                            // window.location.href = 'success.php';
                        } else {
                            alert(responseData.message); 
                        }
                    } catch (error) {
                        console.error("Error parsing JSON response: " + error);
                        alert("Error parsing response. Please try again later.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Error assigning hostel. Please try again later.");
                }
            });
        });
    });
    