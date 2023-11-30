<?php
require_once('connect.php');

session_start();

// Check if the user is logged in as a pharmacist
if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'Pharmacist') {
    header("Location: login.html"); // Redirect to the login page if not logged in as a pharmacist
    exit();
}

$userID = $_SESSION['userID']; // Retrieve the user ID from the session variable
$username = $_SESSION['username']; // Retrieve the username from the session variable

// Function to check if the drug is available in the selected pharmaceutical company
function isDrugAvailable($conn, $pharmcoID, $drugID)
{
    $query = "SELECT COUNT(*) AS count FROM drug WHERE pharmcoID = ? AND drugID = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $pharmcoID, $drugID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $data['count'] > 0;
}



// Retrieve the list of pharmaceutical companies for the pharmacist to select from
$query = "SELECT pharmcoID, name FROM pharmco";
$result = mysqli_query($conn, $query);
$pharmcos = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Retrieve all drugs available for each pharmaceutical company
$query = "SELECT pharmcoID, drugID, drugName FROM drug";
$result = mysqli_query($conn, $query);
$drugs = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Create an associative array to store drugs by pharmaceutical company
$drugsByPharmco = array();
foreach ($drugs as $drug) {
    $pharmcoID = $drug['pharmcoID'];
    $drugID = $drug['drugID'];
    $drugName = $drug['drugName'];
    if (!isset($drugsByPharmco[$pharmcoID])) {
        $drugsByPharmco[$pharmcoID] = array();
    }
    $drugsByPharmco[$pharmcoID][$drugID] = $drugName;
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pharmacist portal</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Function to update the drug options based on the selected pharmaceutical company
        function updateDrugOptions() {
            var pharmcoSelect = document.getElementById("pharmcoID");
            var drugSelect = document.getElementById("drugName");
            var pharmcoID = pharmcoSelect.value;
            var drugs = <?php echo json_encode($drugsByPharmco); ?>;

            // Clear the current drug options
            drugSelect.innerHTML = "";

            // Populate the drug options based on the selected pharmaceutical company
            for (var drugID in drugs[pharmcoID]) {
                var option = document.createElement("option");
                option.value = drugID;
                option.text = drugs[pharmcoID][drugID];
                drugSelect.appendChild(option);
            }
        }
    </script>
</head>
<body>
    <header class="username-header">
        <?php echo $username; ?>
    </header>
    <br>
    <div class="form-box">
        <img src="images\pills.png" alt="Pills image" height="75" width="75"><br><br>
        <form method="post" action="process_order.php">
            <label for="pharmcoID">Pharmaceutical Company:</label><br>
            <select id="pharmcoID" name="pharmcoID" required onchange="updateDrugOptions()">
                <?php foreach ($pharmcos as $pharmco): ?>
                    <option value="<?php echo $pharmco['pharmcoID']; ?>"><?php echo $pharmco['name']; ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="drugName">Drug Name:</label><br>
            <select id="drugName" name="drugName" required></select><br>

            <label for="quantity">Quantity:</label><br>
            <input type="number" id="quantity" name="quantity" required><br>
            
            <label for="drugWeight">Drug Weight (mg):</label><br>
            <input type="number" id="drugWeight" name="drugWeight" required><br>
            
            <label for="drugPrice">Drug Price:</label><br>
            <input type="number" id="drugPrice" name="drugPrice" required><br>

            <input type="submit" value="Place Order" class="btn">
            <input type="reset" value="Clear Order" class="btn">
        </form>
    </div>
    <br>
    <script>
        // Initialize the drug options when the page loads
        window.addEventListener("DOMContentLoaded", function() {
            updateDrugOptions();
        });
    </script>
</body>
</html>