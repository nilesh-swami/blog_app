<?php
// Include your Member class and database connection
include_once '../db/Database.php';
include_once '../db/Member.php';

// Check if mbrid is provided in the GET request
if(isset($_GET['mbrid'])) {
    // Sanitize the input to prevent SQL injection
    $mbrid = intval($_GET['mbrid']);

    // Instantiate the Database class to get the database connection
    $database = new Database();

    // Instantiate the Member class
    $member = new Member($database->conn);

    // Call the getMemberDetails() method
    $memberDetails = $member->getMemberDetails($mbrid);

    // Check if member details are found
    if(!empty($memberDetails)) {
        // Return member details in JSON format
        echo json_encode($memberDetails);
    } else {
        // Member not found, return empty JSON object
        echo json_encode(array());
    }

    // Close the database connection
    $database->conn->close();
} else {
    // mbrid parameter is missing, return error message
    echo json_encode(array('error' => 'mbrid parameter is missing'));
}
?>
