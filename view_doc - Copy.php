<!DOCTYPE html>
<html>
<head>
    <title>View Doctors</title>     
    <link rel="stylesheet" href="style.css">      
</head>
<body>
    <div class="container">
        <img src="images\doctor.png" alt="Patient image" height="75" width="75"><br><br>
        <h1>View Doctors</h1>
        <table class="viewdata">
            <thead>
                <tr>
                    <th>SSN</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Specialization</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Retrieve doctor data from the database
                require_once('connect.php');
                $query = "SELECT * FROM doctor";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['SSN']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['lname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['specialty']) . "</td>";
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
    <!-- Back Button -->
    <button class="btn" onclick="goBack()">Back</button>

    <script>
        function goBack() {
            // Use the history.back() method to go back to the previous page
            history.back();
        }
    </script>
</body>
</html>
