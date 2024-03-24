$(document).ready(function() {
    // Event listener for form submission
    $('#postForm').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Serialize form data
        var formData = new FormData($(this)[0]);

        // Send AJAX request to update post
        $.ajax({
            url: '../member/ajax/update_post.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response
                console.log(response);
                alert('Post updated successfully!');
                // Redirect to view post page or perform any other action
                window.location.href = 'view_post.php';
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error('Error updating post:', error);
                alert('Error updating post. Please try again.');
            }
        });
    });
});