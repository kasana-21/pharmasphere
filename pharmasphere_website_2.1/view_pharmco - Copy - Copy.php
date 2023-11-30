<!DOCTYPE html>
<html>
<head>
    <title>View Pharmaceutical Companies</title>        
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <img src="images/pharmaceutical.png" alt="Pharmco image" height="75" width="75"><br><br>
        <h1>View Pharmaceutical Companies</h1>
        <table class="viewdata">
            <thead>
                <tr>
                    <th>Company ID</th>
                    <th>Name</th>
                    <th>Contact Email</th>
                    <th>Contact Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Retrieve pharmaceutical company data from the database
                require_once('connect.php');
                $query = "SELECT * FROM pharmco";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['pharmcoID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                // Close the database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
