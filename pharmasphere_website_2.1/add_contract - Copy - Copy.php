<!DOCTYPE html>
<html>
<head>
    <title>Add Contract</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-box">
        <img src="images\contract.png" alt="Users image" height="75" width="75"><br><br>
        <form action="process_contract.php" method="post">
            <!-- Hidden input for supervisorID and pharmacyID -->
            <?php
            session_start();
            if (isset($_SESSION['userID'])) {
                $userID = $_SESSION['userID'];

                require_once('connect.php');

                // Query to retrieve supervisorID and pharmacyID
                $query = "SELECT supervisorID, pharmacyID FROM supervisor WHERE userID = ?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, 'i', $userID);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                // Check if the query was successful and fetch the results
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $supervisorID = $row['supervisorID'];
                    $pharmacyID = $row['pharmacyID'];
                } else {
                    // Handle the case when supervisorID or pharmacyID is not found (optional)
                    // Redirect to an error page or perform some other action
                    exit("Error: Supervisor ID or Pharmacy ID not found in the database.");
                }

                // Close the database statement
                mysqli_stmt_close($stmt);
                // No need to close the database connection yet, as we'll fetch pharmaceutical company data next

                echo '<input type="hidden" name="supervisorID" value="' . $supervisorID . '">';
                echo '<input type="hidden" name="pharmacyID" value="' . $pharmacyID . '">';
            }
    
            ?>

            <label for="pharmcoID">Pharmaceutical Company:</label>
            <select name="pharmcoID" required>
                <?php
                // Code to retrieve pharmaceutical company data remains unchanged
                $query = "SELECT * FROM pharmco";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . htmlspecialchars($row['pharmcoID']) . '">' . htmlspecialchars($row['name']) . '</option>';
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                // Close the database connection after fetching pharmaceutical company data
                mysqli_close($conn);
                ?>
            </select><br>

            <label for="startDate">Start Date:</label>
            <input type="date" name="startDate" required><br>

            <label for="endDate">End Date:</label>
            <input type="date" name="endDate" required><br>

            <label for="contractText">Contract Text:</label>
            <textarea name="contractText" rows="4" required></textarea><br>

            <input type="submit" class="btn" value="Add Contract">
            <input type="reset" class="btn" value="Clear"><br><br>
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
