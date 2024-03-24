$(document).ready(function () {

    // Function to handle file input change event
    $("#file").change(function () {
        filePreview(this);
    });

    function filePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#postImgContainer img').remove();
                $('#postImgContainer').append('<img src="' + e.target.result + '" alt="Image preview"/>');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }


    $('#postForm').submit(function (e) {
        e.preventDefault(); // Prevent form submission
        var formData = new FormData(this); // Create FormData object to send form data including files
        
        $.ajax({
            type: 'POST',
            url: '../ajax/add_post.php', // PHP script to handle form submission and database insertion
            data: formData,
            contentType: false, // Don't set contentType
            processData: false, // Don't process the data
            dataType: 'json', // Expect JSON response
            success: function (response) {
                // Handle JSON response
                alert(response.message); // Display success or error message
                if (response.status === 'success') {
                    // Optional: Redirect to a new page or perform additional actions after successful form submission
                }
            },
            error: function (xhr, status, error) {
                // Handle AJAX error
                console.error(xhr.responseText);
                alert('Error occurred while processing your request.');
            }
        });
    });
});