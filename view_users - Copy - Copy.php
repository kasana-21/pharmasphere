<?php
require_once('connect.php');

// Constants for pagination
$recordsPerPage = 10; // Number of records to display per page

// Get the current page number from the query string
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the starting record for the current page
$startFrom = ($currentPage - 1) * $recordsPerPage;

// Retrieve user data from the database with pagination
$query = "SELECT * FROM user LIMIT ?, ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ii', $startFrom, $recordsPerPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if the query was successful
if ($result) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <div class="container">
                <img src="images\group.png" alt="Users image" height="75" width="75"><br><br>
                <table class="viewdata">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Usertype</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Iterate over the user data and generate table rows
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['password']); ?></td>
                                <td><?php echo htmlspecialchars($row['usertype']); ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['userID']; ?>">Edit</a> |
                                    <a href="#" onclick="confirmDelete(<?php echo $row['userID']; ?>)">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <script>
                function confirmDelete(userID) {
                    if (confirm("Are you sure you want to delete this user?")) {
                        // Send an AJAX request to delete.php
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'delete.php', true);
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                var response = xhr.responseText;
                                if (response === 'success') {
                                    alert('User deleted successfully.');
                                    // Reload the page to update the table
                                    location.reload();
                                } else {
                                    alert('Error: ' + response);
                                }
                            }
                        };
                        xhr.send('userID=' + userID);
                    }
                }
            </script>
        </body>
    </html>
    <?php

    // Pagination links
    $query = "SELECT COUNT(*) AS total FROM user";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalRecords = $row['total'];
    $totalPages = ceil($totalRecords / $recordsPerPage);

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
    <?php
} else {
    echo 'Error: ' . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
