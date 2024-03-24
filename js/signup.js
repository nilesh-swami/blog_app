$(document).ready(function() {

    $('#signupForm').submit(function (e) {
        // Prevent form submission
        e.preventDefault();

        // Function to validate the form fields
        function validateForm() {
            // Get input values
            var fname = $('#fname').val().trim();
            var lname = $('#lname').val().trim();
            var email = $('#email').val().trim();
            var password = $('#pass').val();
            var confirmPassword = $('#cpass').val();
            var phone = $('#phone').val().trim();

            // Regular expressions for validation
            var nameRegex = /^[a-zA-Z]+$/;
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,30}$/;
            var phoneRegex = /^\d{10}$/;

            $('.error-message').remove();

            // Validate first name
            if (!fname.match(nameRegex)) {
                displayError($('#fname'), 'Please enter a valid first name.');
                return false;
            }

            // Validate last name
            if (!lname.match(nameRegex)) {
                displayError($('#lname'), 'Please enter a valid last name.');
                return false;
            }

            // Validate email
            if (!email.match(emailRegex)) {
                displayError($('#email'), 'Please enter a valid email address.');
                return false;
            }

            // Validate password
            if (!password.match(passwordRegex)) {
                displayError($('#pass'), 'Password should contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be between 5 to 30 characters long.');
                return false;
            }

            // Validate confirm password
            if (password !== confirmPassword) {
                displayError($('#cpass'), 'Passwords do not match.');
                return false;
            }

            // Validate phone (optional)
            if (phone && !phone.match(phoneRegex)) {
                displayError($('#phone'), 'Phone number should be 10 digits long.');
                return false;
            }

            // If all validations pass, return true
            return true;
        }

        // Function to display error message
        function displayError(element, message) {
            // Remove existing error message, if any
            element.next('.error-message').remove();

            // Append error message after the input field
            element.after('<div class="error-message text-danger">' + message + '</div>');
        }

        function submitFormData(formData){

           // If all validations pass, send form data to the server using AJAX
           $.ajax({
               url: 'ajax/signup_member.php',
               type: 'POST',
               data: formData,
               dataType: 'json', // Expecting JSON response
               success: function(response) {
                   // Display success or error message based on JSON response
                   if (response.status === 'success') {
                       alert(response.message); // Success message
                       // Optionally, you can redirect the user or perform other actions
                   } else {
                       alert(response.message); // Error message
                   }
               },
               error: function(xhr, status, error) {
                   // Handle error response
                   // Handle AJAX error
                   console.error(xhr.responseText);
                   alert('Error occurred while processing your request.');
               }
           });
        }

        var formData = $(this).serialize();

        // Validate the form
        if (validateForm()) {
            // If form validation passed, submit the form
            submitFormData(formData);
        } else {
            // If form validation failed, do not submit the form
            return false;
        }

    });
});




