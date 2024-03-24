$(document).ready(function() {

    var cardsPerPage = 6; // Number of cards per page
    var currentPage = 1; // Current page number

    function getPostDate(pdate){
        var regex = /\b\d{4}-\d{2}-\d{2}\b/;
        if (pdate !== null) {
            var match = pdate.match(regex);
            if (match) {
                var date = match[0];
                return date;
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }

    // Function to fetch posts and update UI
    function fetchPosts(page) {
        $.ajax({
            url: 'get_posts.php',
            type: 'GET',
            data: { page: page },
            dataType: 'json',
            success: function(data) {
                $('#postCards').empty();

                // Function to fetch member details
                function fetchMemberDetails(mbrid, callback) {
                    $.ajax({
                        url: 'ajax/get_member_details.php',
                        type: 'GET',
                        data: { mbrid: mbrid },
                        dataType: 'json',
                        success: function(memberData) {
                            callback(memberData);
                        },
                        error: function(xhr, status, error) {
                            // console.error('Error fetching member details:', error);
                            callback(null);
                        }
                    });
                }

                // Add posts to the container
                $.each(data.posts, function(index, post) {

                    fetchMemberDetails(post.mbrid, function(memberData) {
                        var shortDesc = post.post_desc.substring(0, 200);
                        var memberName = (memberData && memberData.fname && memberData.lname) ? memberData.fname + ' ' + memberData.lname : 'Unknown Member';
                        
                        // Append post details to the container
                        $('#postCards').append(
                            '<div class="col mb-4 card-deck">' +
                            '<div class="card">' +
                            '<input type="hidden" name="mid" value="' + post.mbrid + '">' +
                            '<input type="hidden" name="pid" value="' + post.post_id + '">' +
                            '<img src="member/uploads/' + post.post_img_file_name + '" class="card-img-top" alt="Post Image">' +
                            '<div class="card-body">' +
                            '<h2 class="card-title">' + post.post_title + '</h2>' +
                            '<p class="card-text text-muted">By: ' + memberName + ' | ' + getPostDate(post.post_date) + '</p>' +
                            '<p class="card-text">' + shortDesc + '</p>' +
                            '</div>' +
                            '<div class="card-footer">'+
                            '<button class="btn btn-dark btn-lg read-more-btn">Read More</button>'+
                            '</div>'+
                            '</div>' +
                            '</div>'
                        );
                    });
                });

                // Add pagination buttons
                $('#paginationButtons').empty();

                // Previous button
                if (currentPage > 1) {
                    $('#paginationButtons').append('<button class="btn btn-lg btn-dark mr-1 page-btn prev-btn">Previous</button>');
                }

                // Page number buttons
                for (var i = 1; i <= data.totalPages; i++) {
                    $('#paginationButtons').append('<button class="btn btn-lg btn-dark mr-1 page-btn">' + i + '</button>');
                }

                // Next button
                if (currentPage < data.totalPages) {
                    $('#paginationButtons').append('<button class="btn btn-lg btn-dark mr-1 page-btn next-btn">Next</button>');
                }
            },
            error: function(xhr, status, error) {
                // console.log('Error fetching posts:', error);
            }
        });
    }

    // Initial call to fetch posts on page load
    fetchPosts();

    // Pagination button click event
    $(document).on('click', '.page-btn', function() {
        var btnText = $(this).text();
        if (btnText === 'Previous') {
            currentPage--;
        } else if (btnText === 'Next') {
            currentPage++;
        } else {
            currentPage = parseInt(btnText);
        }
        fetchPosts(currentPage);
    });

    $(document).on('click', '.read-more-btn', function() {
        var postId = $(this).closest('.card').find('input[name="pid"]').val();
        window.location.href = 'post_details.php?post_id=' + postId;
    });
    

});
