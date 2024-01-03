<?php

session_start();

include "db_conn.php";

$conn = OpenCon();
if ($conn != null) {
    echo "Connected Successfully";

}

// Assuming the email and password were submitted via a form

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

/* $email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? ''; */




//hashing the password
$hashed_password = sha1($password);
//password_hash($password, PASSWORD_DEFAULT);

// Session variables are saved to variables

$_SESSION["email"] = $email;
$_SESSION["password"] = $password;
$_SESSION["hashed_password"] = $hashed_password;

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND hashed_password=?");




// Bind the parameters
if (!$stmt->bind_param('ss', $email, $hashed_password)) {
    die('bind param fault');

}


// Execute the query
if (!$stmt->execute()) {
    die('execute fault');

}



// Get the result
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('error in login');
}

// Fetch the row as an associative array
$row = $result->fetch_assoc();
var_dump($row);
// Extract the hashed password from the row
$hashed_password_in_db = $row['hashed_password'];
// Saveing the name to a variable
$name = $row['name'];
$user_id = $row['id'];
// Formatted output
printf(" %s %s \n", $row['email'], $row['hashed_password']);

// Save to sessin variable the name
$_SESSION['name'] = $name;
$_SESSION['user_id'] = $user_id;
$_SESSION['user_type'] = 0;
print_r($result);
echo $hashed_password;
// Check if the user exists
// Add to if statement :   && password_verify($password, $hashed_password_in_db)



if ($result->num_rows > 0) {
    // User exists and credentials are correct
    // Do something, like log the user in
    echo " User exists and credentials are correct";
    echo " " . $email . "\n";
    echo " " . $password . "\n";
    echo " " . $hashed_password . "\n";

    $_SESSION["loggedin"] = true;

    // Redirect to dashboard
    header('Location:../html/dashboard.php');

} else {



    // User does not exist or credentials are incorrect
    // Do something, like display an error message

    echo ' User does not exist or credentials are incorrect';
}

// Close the statement
$stmt->close();

// Close the connection
CloseCon($conn);

?>