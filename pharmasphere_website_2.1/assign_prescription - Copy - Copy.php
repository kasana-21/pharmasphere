<?php
require_once('connect.php');
session_start();

// Check if the user is logged in as a doctor
if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'Doctor') {
    header("Location: login.html"); // Redirect to the login page if not logged in as a doctor
    exit();
}

$userID = $_SESSION['userID']; // Retrieve the user ID from the session variable

// Check if the patID is provided in the URL
if (!isset($_GET['patID'])) {
    echo 'Invalid request.';
    exit();
}

$patID = $_GET['patID']; // Retrieve the patID from the URL

// Retrieve the available drugs from the orderpharmacy table
$query = "SELECT o.orderID, o.drugID, d.drugName
          FROM orderpharmacy AS o
          INNER JOIN drug AS d ON o.drugID = d.drugID";
$result = mysqli_query($conn, $query);

// Check if any drugs are available
if (mysqli_num_rows($result) === 0) {
    echo "No drugs available.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Prescription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Assign Prescription</h1>
    </header>

    <div class="form-box">
        <form method="post" action="process_prescription.php">
            <input type="hidden" name="patID" value="<?php echo $patID; ?>">

            <label for="drugID">Select Drug:</label>
            <select name="drugID" id="drugID" required>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <option value="<?php echo $row['drugID']; ?>"><?php echo $row['drugName']; ?></option>
                <?php endwhile; ?>
            </select><br>

            <label for="frequency">Frequency:</label>
            <input type="text" name="frequency" id="frequency" required><br>

            <label for="quantity">Quantity:</label>
            <input type="text" name="quantity" id="quantity" required><br>

            <label for="startDate">Start Date:</label>
            <input type="date" name="startDate" id="startDate" required><br>

            <label for="endDate">End Date:</label>
            <input type="date" name="endDate" id="endDate" required><br>

            <input type="submit" value="Assign Prescription" class="btn">
            <input type="reset" value="Clear" class="btn">
            <br><br>
            <button class="back-button" onclick="goBack()">Back</button>
            <script>
                function goBack() {
                    history.back();
                }
            </script>
        </form>
    </div>
</body>
</html>
