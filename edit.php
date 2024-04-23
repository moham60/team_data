<?php
// Check if ID is provided in the URL
if (!isset($_GET['id'])) {
    header("location: /Team/team.php");
    exit;
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "team_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve student data based on ID
$id = $_GET['id'];
$sql = "SELECT * FROM team WHERE id = $id";
$result = $conn->query($sql);

// Check if student with given ID exists
if ($result->num_rows == 0) {
    header("location: /Team/team.php");
    exit;
}

// Fetch student data
$row = $result->fetch_assoc();
$name = $row['name'];
$age = $row['age'];
$cgpa = $row['cgpa'];

// Handle form submission for updating student data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve updated data from the form
    $updatedName = $_POST['name'];
    $updatedAge = $_POST['age'];
    $updatedCgpa = $_POST['cgpa'];

    // Update student record in the database
    $updateSql = "UPDATE team SET name = '$updatedName', age = '$updatedAge', cgpa = '$updatedCgpa' WHERE id = $id";
    if ($conn->query($updateSql) === TRUE) {
        // Redirect back to the team page after successful update
        header("location: /Team/team.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Edit Student</title>
</head>
<body>
    <div class="container my-5">
        <h1>Edit Student</h1>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>">
            </div>
            <div class="mb-3">
                <label for="cgpa" class="form-label">CGPA</label>
                <input type="text" class="form-control" id="cgpa" name="cgpa" value="<?php echo $cgpa; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/Team/team.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
