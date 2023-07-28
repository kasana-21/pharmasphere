<?php
require_once('connect.php');

// Check if the user is logged in as a pharmacy
session_start();
if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'Pharmacy') {
    header("Location: login.html"); // Redirect to the login page if not logged in as a pharmacy
    exit();
}

$userID = $_SESSION['userID']; // Retrieve the user ID from the session variable
$username = $_SESSION['username']; // Retrieve the username from the session variable

// Retrieve the pharmacy ID for the logged-in pharmacy
$query = "SELECT pharmacyID FROM pharmacy WHERE userID = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);
$pharmacyID = $data['pharmacyID'];

// Retrieve the prescriptions dispensed from this pharmacy with drugPrice
$query = "SELECT p.prescriptionID, p.patID, p.drugID, p.frequency, p.quantity, p.startDate, p.endDate, d.drugName, d.drugPrice, pa.fname, pa.lname
          FROM prescription AS p
          INNER JOIN drug AS d ON p.drugID = d.drugID
          INNER JOIN patient AS pa ON p.patID = pa.patID
          INNER JOIN dispensedrug AS dp ON p.prescriptionID = dp.prescriptionID
          WHERE dp.pharmacyID = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $pharmacyID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$prescriptions = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prescriptions Dispensed</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="username-header">
        <?php echo $username; ?>!  
    </header>
    <br>
    <div class="container">
        <h2>Prescriptions Dispensed</h2>
        <table class="viewdata">
            <thead>
                <tr>
                    <th>Prescription ID</th>
                    <th>Patient ID</th>
                    <th>Drug Name</th>
                    <th>Drug Price</th>
                    <th>Frequency</th>
                    <th>Quantity</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prescriptions as $prescription): ?>
                    <tr>
                        <td><?php echo $prescription['prescriptionID']; ?></td>
                        <td><?php echo $prescription['patID']; ?></td>
                        <td><?php echo $prescription['drugName']; ?></td>
                        <td><?php echo $prescription['drugPrice']; ?></td>
                        <td><?php echo $prescription['frequency']; ?></td>
                        <td><?php echo $prescription['quantity']; ?></td>
                        <td><?php echo $prescription['startDate']; ?></td>
                        <td><?php echo $prescription['endDate']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button class="back-button" onclick="goBack()">Back</button>
            <script>
                function goBack() {
                    history.back();
                }
            </script>
    </div>
</body>
</html>
