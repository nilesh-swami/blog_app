<?php
// Include the Database class file
include_once '../db/Database.php';
include_once '../db/Member.php';


// Don't forget to close the database connection when you're done
// $database->closeConnection();

// Initialize response array
$response = array();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(isset($_POST['email']) && isset($_POST['pass'])){

        $db = new Database();
        // Instantiate the Member class
        $member = new Member($db->conn);
    
        // Set the login credentials
        $member->setLoginEmail($_POST['email']);
        $member->setPwd($_POST['pass']);

        // Attempt to authenticate the user
        $response = $member->authenticate();
        
    }
} else {
    // If the request method is not POST, return an error
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
