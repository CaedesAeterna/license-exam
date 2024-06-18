<?php



require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


/**
 * This script handles user authentication and session management.
 * It retrieves the email and password submitted via a form, checks their validity,
 * and sets session variables if authentication is successful.
 */


// Assuming the email and password were submitted via a form
$email = $db->escape_string($_POST['email']);
$password = $db->escape_string($_POST['password']);

// echo 'on backend sha1: ' . sha1('a') . "\n";

// Check if the email and password are empty
if (empty ($email) || empty ($password)) {
    die ('{"success": false, "message": "Missing email or password"}');
}

// Check if the session salt is set
if (!isset ($_SESSION['salt'])) {
    die ('{"success": false, "message": "session salt not set"}');
}

// Escape the email to prevent SQL injection
$email = $db->escape_string($email);


// Prepare the SQL query to retrieve the hashed password from the database
$sql = "SELECT hpassword, id, position, email, name FROM `users` WHERE `email`='$email';";

// Execute the SQL query
$res = $db->query($sql);

// Check if the query returned any rows
if ($res->num_rows == 0) {
    // If no rows were returned, output an error message
    die ('{"success": false, "message": "Invalid email or password"}');
}


// Fetch the associated row from the result set
$row = $res->fetch_assoc();
// Get the password from the table
$password_from_table = $row['hpassword'];
$salt = $_SESSION['salt'];
// Hash the password from the table using SHA1 algorithm
$backed_hashed_password = sha1($password_from_table . $salt); // This is the hashed password

// Check if the hashed password does not match the provided password
if ($backed_hashed_password != $password) {
    // If the passwords don't match, return a JSON response with an error message
    die ('{"success": false, "message": "Invalid email or password at hashing TODO"}');
}

// Create an array to store the response data
$array = array();

// Set the success flag to true
$array['success'] = true;

// Set session variables with values from $row array
$_SESSION['id'] = $row['id']; // User ID
$_SESSION['position'] = $row['position']; // User position
$_SESSION['email'] = $row['email']; // User email
$_SESSION['name'] = $row['name']; // User name

// Add the id and email from the row to the array
$array['id'] = $row['id'];
$array['email'] = $row['email'];
$array['redirect'] = 'dashboard';

// Convert the array to JSON and terminate the script
die (json_encode($array));