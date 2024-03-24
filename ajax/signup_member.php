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
    
    if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['phone'])){

        $db = new Database();
        // Instantiate the Member class
        $member = new Member($db->conn);
    
        // Set the properties of the Member object with form data
        $member->setFname($_POST['fname']);
        $member->setLname($_POST['lname']);
        $member->setLoginEmail($_POST['email']);
        $member->setPwd($_POST['pass']);
        // Assuming 'created_on' should be set to the current timestamp
        $member->setCreatedOn(date('Y-m-d H:i:s'));
        $member->setPhone($_POST['phone']);
    
        //chech if alread exists
        if($member->isExists($member->getLoginEmail())){
            $response['status'] = 'error';
            $response['message'] = 'Member already registered';
        }
        else{
            // Call the create() method to save the member data into the database
            $result = $member->create();
        
            // Prepare JSON response
            $response = array();
        
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = 'Member created successfully.';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error creating member.';
            }
        }
    }
    else{
        $response['status'] = 'error';
        $response['message'] = 'Values not set';
    }
    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);

} else {
    // If the request method is not POST, return an error
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}
?>
