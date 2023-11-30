<?php
require_once('connect.php');
session_start();

// Check if the user is logged in as a doctor
if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'Doctor') {
    header("Location: login.html"); // Redirect to the login page if not logged in as a doctor
    exit();
}

$userID = $_SESSION['userID']; // Retrieve the user ID from the session variable

// Retrieve all patients with their patID and SSN
$query = "SELECT patID, fname, lname, age, SSN FROM patient";

// Check if a search query is submitted
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query .= " WHERE fname LIKE '%$search%'";
}

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Patients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Patients</h1>
        <img src="images/patient.png" alt="Patient image" height="75" width="75"><br><br>
        <form action="" method="get">
            <label for="search">Search by First Name:</label>
            <input type="text" name="search" id="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" class="btn">Search</button>
        </form>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="viewdata">
                <thead>
                    <tr>
                        <th>SSN</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['SSN']; ?></td>
                            <td><?php echo $row['fname']; ?></td>
                            <td><?php echo $row['lname']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><a href="assign_prescription.php?patID=<?php echo $row['patID']; ?>">Assign Prescription</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No patients found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
