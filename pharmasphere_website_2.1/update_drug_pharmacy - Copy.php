<?php
// Connect to the database
// Connect to the database
require_once('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form data is submitted
    if (isset($_POST['orderID'], $_POST['newQuantity'], $_POST['newDrugWeight'], $_POST['newDrugName'])) {
        // Retrieve the submitted form data
        $orderID = $_POST['orderID'];
        $newQuantity = $_POST['newQuantity'];
        $newDrugWeight = $_POST['newDrugWeight'];
        $newDrugName = $_POST['newDrugName'];

        // Retrieve the current drug name from the orderpharmacy table
        $currentDrugName = '';
        $getDrugNameQuery = "SELECT drugName FROM orderpharmacy WHERE orderID = ?";
        $stmt = mysqli_prepare($conn, $getDrugNameQuery);
        mysqli_stmt_bind_param($stmt, 'i', $orderID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        if ($data) {
            $currentDrugName = $data['drugName'];
        } else {
            echo "Error: Order not found.";
            exit(); // Stop further processing if order not found
        }
        mysqli_stmt_close($stmt);

        // If the drug name is not provided in the form, use the current drug name
        if (empty($newDrugName)) {
            $newDrugName = $currentDrugName;
        }

        // Prepare and execute the update statement
        $updateQuery = "UPDATE orderpharmacy
                        SET quantity = ?, drugWeight = ?, drugName = ?
                        WHERE orderID = ?";
        $stmt = mysqli_prepare($conn, $updateQuery);

        // Bind the parameters and execute the update statement
        mysqli_stmt_bind_param($stmt, 'iisi', $newQuantity, $newDrugWeight, $newDrugName, $orderID);
        mysqli_stmt_execute($stmt);

        // Check if the update was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Stock updated successfully.";
        } else {
            echo "Error: Failed to update stock.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Invalid form data.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
