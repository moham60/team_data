<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "team_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
if($conn->connect_error)
{
   die("connection failed: ".$conn->connect_error);
}
$name="";
$age="";
$id="";
$cgpa="";
$errormsg="";
$successmsg="";
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $name=$_POST["name"];
    $age=$_POST["age"];
    $id=$_POST["id"];
    $cgpa=$_POST["cgpa"];
    if(empty($name) || empty($id) || empty($age) || empty($cgpa))
    {
        $errormsg="ALL fields are required";
    }
    else
    {
        $sql="INSERT INTO team (name, id, age, cgpa) VALUES ('$name', '$id', '$age', '$cgpa')";
        $result=$conn->query($sql);
        if(!$result)
        {
            $errormsg="Invalid query: ".$conn->error;
        }
        else
        {
            $successmsg="Student added correctly";
            $name="";
            $age="";
            $id="";
            $cgpa="";
            header("location:/Team/team.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Create New Student</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Student</h2>
        <?php
        if(!empty($errormsg))
        {
            echo
            "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errormsg</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        if(!empty($successmsg))
        {
            echo
            "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successmsg</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id" value="<?php echo $id ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Age</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="age" value="<?php echo $age ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">CGPA</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="cgpa" value="<?php echo $cgpa ?>">
                </div>
            </div>
            <div class="row mb-3 mt-3">
                <div class="offset-sm-3 col-sm-3 d-grid"><button type="submit" class="btn btn-primary">Submit</button></div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/Team/team.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
