<?php

/**
 * This script handles user authentication and session management.
 * It retrieves the email and password submitted via a form, checks their validity,
 * and sets session variables if authentication is successful.
 */

// Assuming the email and password were submitted via a form
$email = $_POST['email'];
$password =$_POST['password'];

echo 'email and password after post ' . $email . ' ' . $password . "\n";


// Check if the email and password are empty
if (empty($email) || empty($password)) {
    die('{"success": false, "error": "Missing email or password"}');
}

// Check if the session salt is set
if (!isset($_SESSION['salt'])) {
    die('{"success": false, "error": "No salt"}');
}

// Escape the email to prevent SQL injection
$email = $db->escape_string($email);


// Prepare the SQL query to retrieve the hashed password from the database
$sql = "SELECT hpassword FROM `users` WHERE `email`='$email';";

// Execute the SQL query
$res = $db->query($sql);

// Check if the query returned any rows
if ($res->num_rows == 0) {
    // If no rows were returned, output an error message
    die('{"success": false, "error": "Invalid email or password"}');
}


// Fetch the associated row from the result set
$row = $res->fetch_assoc();

// Get the password from the table
$password_from_table = $row['hpassword'];

// Hash the password from the table using SHA1 algorithm
$temp = sha1($password_from_table); // This is the hashed password

// Get the salt value from session
$salt = $_SESSION['salt'];


// Print the temporary variable
echo 'temp: ' . $temp . "\n";

// Concatenate the temporary variable with the salt variable
$temp_password = $temp . $salt;

// Hash the concatenated password using the SHA1 algorithm
$backed_hashed_password = sha1($temp_password);

// Print the hashed password
echo 'backed_hashed_password: ' . $backed_hashed_password . "\n";

echo 'password: ' . $password . "\n";

if ($backed_hashed_password != $password) {
    die('{"success": false, "error": "Invalid email or password at hashing"}');
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

// Convert the array to JSON and terminate the script
die(json_encode($array));