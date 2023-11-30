<!DOCTYPE html>
<html>
<head>
    <title>View Pharmacists</title>       
    <link rel="stylesheet" href="style.css">    
</head>
<body>
    <div class="container">
        <img src="images\pharmacist.png" alt="Pharmacist image" height="75" width="75"><br><br>
        <h1>View Pharmacists</h1>
        <table class="viewdata">
            <thead>
                <tr>
                    <th>SSN</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Retrieve pharmacist data from the database
                require_once('connect.php');
                $query = "SELECT * FROM pharmacist";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['SSN']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['lname']) . "</td>";
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
