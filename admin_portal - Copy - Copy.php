<?php
session_start();

// Check if the user is logged in as a patient
if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.html"); // Redirect to the login page if not logged in as a patient
    exit();
}

$username = $_SESSION['username']; // Retrieve the username from the session variable
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="username-header">
        Welcome, <?php echo $username; ?>!
    </header>
    <br>
    <div class="link-container">
        <img src="images\admin.png" alt="Login image" height="75" width="75"><br><br>
        <a href="view_users.php" class="link">Edit user information</a>
        <a href="admin_reg.html" class="link">Register new admin</a>
        <a href="view_pat.php" class="link">View patients</a>
        <a href="view_doc.php" class="link">View doctors</a>
        <a href="view_supervisor.php" class="link">View supervisors</a>
        <a href="view_pharmacist.php" class="link">View pharmacists</a>
        <a href="view_pharmacy.php" class="link">View pharmacies</a>
        <a href="view_pharmco.php" class="link">View pharmaceutical companies</a><br><br><br>
        <button class="back-button" onclick="goBack()">Back to Log in</button>
        <script>
            function goBack() {
                history.back();
            }
        </script>
    </div>
</body>
</html>
