<?php
require_once('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the pharmacist details from the form submission
    $SSN = $_POST['SSN'];
    $fname = $_POST['pha_fname'];
    $lname = $_POST['pha_lname'];
    $email = $_POST['pha_email'];
    $phone = $_POST['pha_phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve the userID from the session variable
    session_start();
    if (!isset($_SESSION['userID'])) {
        // Redirect to an error page or perform some other action if userID is not set in the session
        exit("Error: User ID not found in the session.");
    }
    $userID = $_SESSION['userID'];

    // Use prepared statement to fetch the pharmacyID based on the userID
    $pharmacyQuery = "SELECT pharmacyID FROM pharmacy WHERE userID = ?";
    $pharmacyStmt = mysqli_prepare($conn, $pharmacyQuery);
    mysqli_stmt_bind_param($pharmacyStmt, 'i', $userID);
    mysqli_stmt_execute($pharmacyStmt);
    $pharmacyResult = mysqli_stmt_get_result($pharmacyStmt);

    if (mysqli_num_rows($pharmacyResult) === 1) {
        $pharmacyData = mysqli_fetch_assoc($pharmacyResult);
        $pharmacyID = $pharmacyData['pharmacyID'];
    } else {
        // Handle the case when pharmacyID is not found (optional)
        // Redirect to an error page or perform some other action
        exit("Error: Pharmacy ID not found in the database.");
    }

    // Use prepared statement for INSERT query to add a user
    $userQuery = "INSERT INTO user (username, password, usertype) VALUES (?, ?, 'Pharmacist')";
    $userStmt = mysqli_prepare($conn, $userQuery);
    mysqli_stmt_bind_param($userStmt, 'ss', $username, $password);

    if (mysqli_stmt_execute($userStmt)) {
        echo "User data inserted successfully!<br>";

        // Get the inserted user's ID
        $userID = mysqli_insert_id($conn);

        // Use prepared statement for INSERT query to add a pharmacist
        $pharmacistQuery = "INSERT INTO pharmacist (userID, pharmacyID, SSN, fname, lname, email, phone) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $pharmacistStmt = mysqli_prepare($conn, $pharmacistQuery);
        mysqli_stmt_bind_param($pharmacistStmt, 'iiissss', $userID, $pharmacyID, $SSN, $fname, $lname, $email, $phone);

        if (mysqli_stmt_execute($pharmacistStmt)) {
            echo "Pharmacist data inserted successfully!";
        } else {
            echo "Error inserting pharmacist data: " . mysqli_error($conn) . "<br>";
        }
    } else {
        echo "Error inserting user data: " . mysqli_error($conn);
    }

    // Close the prepared statements
    mysqli_stmt_close($userStmt);
    mysqli_stmt_close($pharmacistStmt);
    mysqli_stmt_close($pharmacyStmt);
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Pharmacist</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-box">
        <h2>Add Pharmacist</h2>
        <form method="post" action="add_pharmacist.php">
                <label for="SSN">SSN:</label><br>
                <input type="text" id="SSN" name="SSN" required><br><br>

                <label for="pha_fname">First Name:</label><br>
                <input type="text" id="pha_fname" name="pha_fname" required><br><br>

                <label for="pha_lname">Last Name:</label><br>
                <input type="text" id="pha_lname" name="pha_lname" required><br><br>

                <label for="pha_email">Email Address:</label><br>
                <input type="email" id="pha_email" name="pha_email" required><br><br>

                <label for="pha_phone">Phone Number:</label><br>
                <input type="tel" id="pha_phone" name="pha_phone" required><br><br>

                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br><br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <input type="submit" value="Add Pharmacist" class="btn">
                <input type="reset" value="Clear" class="btn"> 
        </form>
    </div>
</body>
</html>
