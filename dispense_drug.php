<!DOCTYPE html>
<html>
<head>
    <title>Dispense Drug</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Dispense Drug</h1>
        <img src="images\pills.png" alt="Prescription image" height="75" width="75"><br><br>
        <?php if (isset($dispenseMessage)): ?>
            <p><?php echo $dispenseMessage; ?></p>
        <?php endif; ?>
        <a href="view_prescription.php">Back to View Prescriptions</a>
    </div>

    <?php
    require_once('connect.php');
    session_start();

    // Check if the user is logged in as a pharmacist
    if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'Pharmacist') {
        header("Location: login.html"); // Redirect to the login page if not logged in as a pharmacist
        exit();
    }

    $userID = $_SESSION['userID']; // Retrieve the user ID (pharmacist ID) from the session variable

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dispensePrescriptionID'])) {
        $prescriptionID = $_POST['dispensePrescriptionID'];

        // Retrieve the prescription details, including drug price
        $query = "SELECT p.prescriptionID, p.patID, p.drugID, p.frequency, p.quantity, p.startDate, p.endDate, d.drugName, d.drugPrice, pa.fname, pa.lname
                  FROM prescription AS p
                  INNER JOIN drug AS d ON p.drugID = d.drugID
                  INNER JOIN patient AS pa ON p.patID = pa.patID
                  WHERE p.prescriptionID = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $prescriptionID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            // Prescription exists, continue with dispensing operation
            $prescriptionData = mysqli_fetch_assoc($result);
            $drugName = $prescriptionData['drugName'];
            $drugPrice = $prescriptionData['drugPrice']; // Added drugPrice
            $patientName = $prescriptionData['fname'] . ' ' . $prescriptionData['lname'];
            $quantity = $prescriptionData['quantity'];

            // Retrieve the pharmacyID of the logged-in pharmacist
            $pharmacyIDQuery = "SELECT pharmacyID FROM pharmacist WHERE userID = ?";
            $pharmacyIDStmt = mysqli_prepare($conn, $pharmacyIDQuery);
            mysqli_stmt_bind_param($pharmacyIDStmt, 'i', $userID);
            mysqli_stmt_execute($pharmacyIDStmt);
            $pharmacyIDResult = mysqli_stmt_get_result($pharmacyIDStmt);

            if (mysqli_num_rows($pharmacyIDResult) === 1) {
                $pharmacyData = mysqli_fetch_assoc($pharmacyIDResult);
                $pharmacyID = $pharmacyData['pharmacyID'];

                // Perform the dispensing operation here
                // For example, you can update the drug inventory and mark the prescription as dispensed

                // Perform the dispensing operation here
            }
// For example, you can update the drug inventory and mark the prescription as dispensed

// Insert into the dispensedrug table
$insertQuery = "INSERT INTO dispensedrug (prescriptionID, pharmacyID) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $insertQuery);
mysqli_stmt_bind_param($stmt, 'ii', $prescriptionID, $pharmacyID);
mysqli_stmt_execute($stmt);

// Check if the insertion was successful and show appropriate message
if (mysqli_stmt_affected_rows($stmt) > 0) {
    $dispenseMessage = "Drug '$drugName' has been successfully dispensed to patient '$patientName'. Quantity: $quantity. Price: $drugPrice"; // Display drug price in the message
} else {
    $dispenseMessage = "Error dispensing the drug. Please try again.";
}

// Close the statement
// mysqli_stmt_close($stmt); // Remove this line, as the statement is already closed after execution
}
    }
 ?>
</body>
</html>
