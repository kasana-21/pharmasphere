<?php
require_once('connect.php');

session_start();

// Check if the user is logged in as a pharmaceutical company
if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'Pharmaceutical Company') {
    header("Location: login.html"); // Redirect to the login page if not logged in as a pharmaceutical company
    exit();
}

$userID = $_SESSION['userID']; // Retrieve the user ID from the session variable
$username = $_SESSION['username']; // Retrieve the username from the session variable

// Retrieve the pharmaceutical company ID based on the logged-in user's ID
$query = "SELECT pharmcoID FROM pharmco WHERE userID = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $pharmcoID = $row['pharmcoID'];
    $_SESSION['pharmcoid'] = $pharmcoID; // Store the pharmaceutical company ID in the session variable
} else {
    // Handle the case where pharmaceutical company ID is not found
    echo "Error: Pharmaceutical Company ID not found.";
    exit();
}

// Retrieve the drugs sold by the pharmaceutical company to pharmacies
$query = "SELECT d.drugID, d.drugName, d.drugPrice, s.quantitySold, s.totalRevenue 
          FROM drug AS d
          INNER JOIN sales AS s ON d.drugID = s.drugID
          WHERE d.pharmcoID = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $pharmcoID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Initialize total revenue
$totalRevenue = 0;

// Check if drugs are available
if (mysqli_num_rows($result) > 0) {
    echo "<h3>Drug Sales:</h3>";
    echo "<table>";
    echo "<tr><th>Drug ID</th><th>Drug Name</th><th>Drug Price</th><th>Quantity Sold</th><th>Total Revenue</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        $drugID = $row['drugID'];
        $drugName = $row['drugName'];
        $drugPrice = $row['drugPrice'];
        $quantitySold = $row['quantitySold'];
        $totalRevenuePerDrug = $row['totalRevenue'];

        // Accumulate the total revenue
        $totalRevenue += $totalRevenuePerDrug;

        echo "<tr>";
        echo "<td>" . $drugID . "</td>";
        echo "<td>" . $drugName . "</td>";
        echo "<td>" . $drugPrice . "</td>";
        echo "<td>" . $quantitySold . "</td>";
        echo "<td>" . $totalRevenuePerDrug . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<h3>No drugs found.</h3>";
}

echo "<h3>Total Revenue: " . $totalRevenue . "</h3>";

// Close the database connection
mysqli_close($conn);
?>
