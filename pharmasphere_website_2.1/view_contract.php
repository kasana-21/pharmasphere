<?php
require_once('connect.php');
session_start();

// Check if the user is logged in as a supervisor
if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'Supervisor') {
    header("Location: login.html");
    exit();
}

// Get the supervisorID from the query parameter
if (isset($_GET['supervisorID'])) {
    $supervisorID = $_GET['supervisorID'];

    // Retrieve contract data with pharmaceutical company name for the specific supervisorID
    $query = "SELECT c.contractID, c.pharmcoID, p.name AS pharmcoName, c.startDate, c.endDate, c.contractText
              FROM contract AS c
              INNER JOIN pharmco AS p ON c.pharmcoID = p.pharmcoID
              WHERE c.supervisorID = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $supervisorID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>View Contracts</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <div class="container">
                <img src="images\contract.png" alt="Users image" height="75" width="75"><br><br>
                <h2>Contracts Details</h2>
                <table class="viewdata">
                    <thead>
                        <tr>
                            <th>Contract ID</th>
                            <th>Pharmaceutical Company</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Contract Text</th>
                            <th>Duration</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Iterate over the contract data and generate table rows
                        while ($row = mysqli_fetch_assoc($result)) {
                            $startDate = strtotime($row['startDate']);
                            $endDate = strtotime($row['endDate']);
                            $currentDate = time();

                            $isActive = ($currentDate >= $startDate && $currentDate <= $endDate);

                            // Calculate the duration in years, months, and days
                            $durationSeconds = $endDate - $startDate;
                            $years = floor($durationSeconds / (365 * 24 * 60 * 60));
                            $months = floor(($durationSeconds % (365 * 24 * 60 * 60)) / (30 * 24 * 60 * 60));
                            $days = floor((($durationSeconds % (365 * 24 * 60 * 60)) % (30 * 24 * 60 * 60)) / (24 * 60 * 60));
                            $duration = "$years years, $months months, $days days";

                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['contractID']); ?></td>
                                <td><?php echo htmlspecialchars($row['pharmcoName']); ?></td>
                                <td><?php echo htmlspecialchars($row['startDate']); ?></td>
                                <td><?php echo htmlspecialchars($row['endDate']); ?></td>
                                <td><?php echo htmlspecialchars($row['contractText']); ?></td>
                                <td><?php echo $duration; ?></td>
                                <td><?php echo $isActive ? 'Active' : 'Inactive'; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
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
        <?php
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database statement
    mysqli_stmt_close($stmt);
} else {
    // Handle the case when supervisorID is not provided (optional)
    // Redirect to an error page or perform some other action
    exit("Error: Supervisor ID not provided in the URL.");
}

// Close the database connection
mysqli_close($conn);
?>
