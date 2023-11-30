<!DOCTYPE html>
<html>
<head>
    <title>Drugs Sold by Pharmaceutical Company</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Drugs Sold by Pharmaceutical Company</h1>
    <div class="container">
        <?php
        require_once('connect.php');

        // Check if the pharmcoID is provided in the query parameter
        if (isset($_GET['pharmcoID'])) {
            $pharmcoID = $_GET['pharmcoID'];

            // Retrieve the pharmaceutical company name
            $query = "SELECT name FROM pharmco WHERE pharmcoID = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'i', $pharmcoID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Check if the query was executed successfully and fetch the company name
            if ($result && mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                $pharmcoName = $row['name'];
                ?>
                <h2>Pharmaceutical Company: <?php echo htmlspecialchars($pharmcoName); ?></h2>
                <table class="drug-table">
                    <thead>
                        <tr>
                            <th>Drug Name</th>
                            <th>Quantity Sold</th>
                            <th>Sale Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Retrieve the drugs sold by the pharmaceutical company
                        $query = "SELECT d.name AS drugName, s.quantity_sold, s.sale_date
                                  FROM drugs AS d
                                  INNER JOIN sales AS s ON d.drugID = s.drugID
                                  WHERE d.pharmcoID = ?";

                        $stmt = mysqli_prepare($conn, $query);
                        mysqli_stmt_bind_param($stmt, 'i', $pharmcoID);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['drugName']); ?></td>
                                    <td><?php echo htmlspecialchars($row['quantity_sold']); ?></td>
                                    <td><?php echo htmlspecialchars($row['sale_date']); ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='3'>No data available.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo "<p>Pharmaceutical company not found.</p>";
            }

            // Close the database statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<p>Pharmaceutical company ID not provided.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
