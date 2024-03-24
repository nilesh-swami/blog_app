$(document).ready(function() {
    // Function to fetch all posts and populate the table
    function getAllPosts() {
        $.ajax({
            url: '../member/ajax/get_all_posts.php', 
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Clear the table body
                $('#postTable tbody').empty();

                // Check if there are any posts
                if (response.length > 0) {
                    // Iterate over each post and append to the table
                    $.each(response, function(index, post) {
                        var shortDesc = post.post_desc.substring(0, 50);

                        $('#postTable tbody').append(
                            '<tr data-post-id="'+ post.post_id +'">' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + post.post_title + '</td>' +
                            '<td>' + shortDesc + '</td>' +
                            '<td>' + post.post_status + '</td>' +
                            '<td>' +
                            '<button class="btn btn-sm btn-info view-post">View</button>' +
                            '&nbsp;<button class="btn btn-sm btn-danger delete-post">Delete</button>' +
                            '</td>' +
                            '</tr>'
                        );
                    });

                    // Initialize DataTables
                    $('#postTable').DataTable();


                } else {
                    // If no posts found, display a message
                    $('#postTable tbody').append(
                        '<tr><td colspan="5">No posts found</td></tr>'
                    );
                }
            },
            error: function(xhr, status, error) {
                console.log('Error fetching posts:', error);
            }
        });
    }

    // Call the function to fetch posts on page load
    getAllPosts();

    // Attach click event listener to the "View" button
    $('#postTable').on('click', '.view-post', function() {
        var postId = $(this).closest('tr').data('post-id'); // Get the post ID from the data attribute

        // Redirect to the post details page with the post ID as a query parameter
        window.location.href = '../member/view_post_details.php?postId=' + postId;
    });


    // Function to update serial numbers
    function updateSerialNumbers() {
        $('#postTable tbody tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
    }

    // Attach click event listener to the delete button
    $('#postTable').on('click', '.delete-post', function() {
        var postId = $(this).closest('tr').data('post-id'); 
        
        // Confirm deletion with the user
        if (confirm('Are you sure you want to delete this post?')) {
            // Send AJAX request to delete the post
            $.ajax({
                url: '../member/ajax/delete_post.php', // Update with your delete script URL
                type: 'POST',
                data: { postId: postId }, // Send post ID to the server
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // If post deletion is successful, remove the corresponding row from the table
                        $('[data-post-id="' + postId + '"]').remove();

                        // Update serial numbers
                        updateSerialNumbers();
                    } else {
                        // Handle deletion error
                        alert('Error deleting post: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error
                    console.error('Error deleting post:', error);
                    alert('Error deleting post. Please try again later.');
                }
            });
        }
    });
    

});