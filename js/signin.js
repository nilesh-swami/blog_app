$(document).ready(function() {

    function validateForm() {
        // Regular expressions for email and password validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,30}$/;
    
        // Get the values of email and password fields
        var email = $('#email').val();
        var password = $('#pass').val();
    
        // Perform email and password validations
        var emailValid = emailRegex.test(email);
        var passwordValid = passwordRegex.test(password);

        // Remove existing error messages
        $('.error-message').remove();
    
        // Display error messages if validations fail
        if (!emailValid) {
            $('#email').after('<div class="error-message text-danger">Please enter a valid email address.</div>');
            return false; // Return false if email validation fails
        }
        if (!passwordValid) {
            $('#pass').after('<div class="error-message text-danger">Password should contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be between 5 to 30 characters long.</div>');
            return false; // Return false if password validation fails
        }
    
        // Return true if all validations pass
        return true;
    }
    

    $('#signinForm').submit(function (e) {
        // Prevent form submission
        e.preventDefault();
        
        // validation
        var formData = $(this).serialize();
        if(validateForm()){
            submitFormData(formData);
        }

    });
});

function submitFormData(formData){

    // If all validations pass, send form data to the server using AJAX
    $.ajax({
        url: 'ajax/signin_member.php',
        type: 'POST',
        data: formData,
        dataType: 'json', // Expecting JSON response
        success: function(response) {
            // Handle JSON response
            if (response.authenticated) {
                // Authentication successful
                alert('Login successful. Welcome, ' + response.user_name);
                // Redirect to dashboard or perform other actions
                window.location.href = 'member/dashboard.php';
            } else {
                // Authentication failed
                alert('Invalid email or password.');
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
