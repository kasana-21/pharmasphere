<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>View Patients</title>         
</head>
<body>
    <div class="container">
        <img src="images\patient.png" alt="Patient image" height="75" width="75"><br><br>
        <h1>View Patients</h1>
        <table class="viewdata">
            <thead>
                <tr>
                    <th>SSN</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Retrieve patient data from the database
                require_once('connect.php');
                $query = "SELECT * FROM patient";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['SSN']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['lname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['dob']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                ?>
            </tbody>
        </table>
        <?php
        // Pagination links
        $query = "SELECT COUNT(*) AS total FROM patient";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $totalRecords = $row['total'];
        $recordsPerPage = 10; // Number of records to display per page
        $totalPages = ceil($totalRecords / $recordsPerPage);
        mysqli_close($conn); // Close the database connection
        ?>
        <div class="pagination">
            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                ?>
                <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>
