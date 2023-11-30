<?php
require_once('connect.php');
session_start();

// Check if the user is logged in as a pharmacist
if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'Pharmacist') {
    header("Location: login.html"); // Redirect to the login page if not logged in as a pharmacist
    exit();
}

$userID = $_SESSION['userID']; // Retrieve the user ID from the session variable

// Retrieve all prescriptions
$query = "SELECT p.prescriptionID, p.patID, p.drugID, p.frequency, p.quantity, p.startDate, p.endDate, d.drugName, pa.fname, pa.lname
          FROM prescription AS p
          INNER JOIN drug AS d ON p.drugID = d.drugID
          INNER JOIN patient AS pa ON p.patID = pa.patID";

$result = mysqli_query($conn, $query);

// Process dispense action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dispensePrescriptionID'])) {
    $prescriptionID = $_POST['dispensePrescriptionID'];

    // Perform the dispensing operation here
    // ...

    // Redirect back to the view prescriptions page after dispensing
    header("Location: view_prescriptions.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Prescriptions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>View Prescriptions</h1>
        <img src="images\pills.png" alt="Prescription image" height="75" width="75"><br><br>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="viewdata">
                <thead>
                    <tr>
                        <th>Prescription ID</th>
                        <th>Patient Name</th>
                        <th>Drug Name</th>
                        <th>Frequency</th>
                        <th>Quantity</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['prescriptionID']; ?></td>
                            <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                            <td><?php echo $row['drugName']; ?></td>
                            <td><?php echo $row['frequency']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['startDate']; ?></td>
                            <td><?php echo $row['endDate']; ?></td>
                            <td>
                                <form method="post" action="dispense_drug.php">
                                    <input type="hidden" name="dispensePrescriptionID" value="<?php echo $row['prescriptionID']; ?>">
                                    <input type="submit" value="Dispense" class="btn">
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No prescriptions found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
