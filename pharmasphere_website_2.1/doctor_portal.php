<!DOCTYPE html>
<html>
<head>
    <title>Doctor Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
session_start();

// Check if the user is logged in as a doctor
if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'Doctor') {
    header("Location: login.html"); // Redirect to the login page if not logged in as a doctor
    exit();
}


// Retrieve the docID from the database based on the logged-in doctor's userID
require_once('connect.php');
$userID = $_SESSION['userID'];
$query = "SELECT docID FROM doctor WHERE userID = $userID";
$result = mysqli_query($conn, $query);

// Check if the query was executed successfully
if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}

// Fetch the docID
$row = mysqli_fetch_assoc($result);
$docID = $row['docID'];
// Free the result set
mysqli_free_result($result);
mysqli_close($conn);

$username = $_SESSION['username']; // Retrieve the username from the session variable

?>
<body>
    <header class="username-header">
        Welcome, <?php echo $username; ?>!
    </header>
    <br>
    <div class="link-container">
        <h1>Doctor Portal</h1>
        <img src="images\doctor.png" alt="Login image" height="75" width="75"><br><br>
        <a href="doc_view_pat.php?>" class="link">View patients</a>
    </div>
</body>
</html>
