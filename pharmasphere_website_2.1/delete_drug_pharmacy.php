<?php
// Connect to the database
require_once('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the orderID parameter is provided
    if (isset($_POST['orderID'])) {
        $orderID = $_POST['orderID'];

        // Perform the deletion query
        $deleteQuery = "DELETE FROM orderpharmacy WHERE orderID = ?";
        $stmt = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($stmt, 'i', $orderID);
        mysqli_stmt_execute($stmt);

        // Check if the deletion was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo 'success';
        } else {
            echo 'Error: Failed to delete the drug. ' . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo 'Error: Invalid request.';
    }
}

// Close the database connection
mysqli_close($conn);
?>
