<?php
require_once('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $userID = $_POST['userID'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Update the user data in the database
    $query = "UPDATE user SET username = ?, password = ? WHERE userID = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssi', $username, $password, $userID);
    $result = mysqli_stmt_execute($stmt);

    // Check if the update was successful
    if ($result) {
        echo "User updated.";
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>
