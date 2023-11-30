<?php
require_once('connect.php');

if (isset($_POST['userID'])) {
    $userID = $_POST['userID'];

    // Perform the deletion
    $query = "DELETE FROM user WHERE userID = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $userID);
    mysqli_stmt_execute($stmt);

    // Check if the deletion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo 'success';
    } else {
        echo 'Failed to delete user.';
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo 'Invalid request.';
}

// Close the database connection
mysqli_close($conn);
?>
