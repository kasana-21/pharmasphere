<?php
require_once('connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $SSN = $_POST['SSN'];
    $fname = $_POST['adm_fname'];
    $lname = $_POST['adm_lname'];
    $email = $_POST['adm_email'];
    $phone = $_POST['adm_phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = 'Admin';

    $query = "INSERT INTO user (username, password, usertype) VALUES ('$username', '$password', '$usertype')";

    // Execute the query to insert user data
    if (mysqli_query($conn, $query)) {
        echo "User data inserted successfully!<br>";
        
        // Get the inserted user's ID
        $userID = mysqli_insert_id($conn);
        
        $query1 = "INSERT INTO admin (userID, SSN, fname, lname, email, phone) VALUES ('$userID', '$SSN', '$fname', '$lname', '$email', '$phone')";
        
        // Execute the query to insert admin data
        if (mysqli_query($conn, $query1)) {
            echo "Admin data inserted successfully!";
        } else {
            echo "Error inserting admin data: " . mysqli_error($conn) . "<br>";
        }
    } else {
        echo "Error inserting user data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

    </body>
</html>