<?php
$servename = "localhost";
$username = "root";
$password = "";
$database = "s_m_s";         

//Create Connection
$connection = new mysqli($servename, $username, $password, $database);      

$id = "";
$name = "";      
$matric = "";
$dep = "";
$book = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] =='GET') {
    //GET method: Shows Data of the client

    if (!isset($_GET["id"]) ) {
        header("location:/library/index.php");
        exit;
    }

    $id = $_GET["id"];

    //Read the row of the selected client from database table
    $sql = "SELECT * FROM library WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row) {
        header("location: /library/index.php");
        exit;
    }

    $name = $row["name"];
    $matric = $row["matric"];
    $dep = $row["department"];
    $book = $row["book"];
}
else {
    //POST method:Update the data of client

    $id = $_POST["id"];
    $name = $_POST["name"];
    $matric = $_POST["matric"];
    $dep = $_POST["department"];
    $book = $_POST["book"];

    do {
        if ( empty($id) ||empty($name) || empty($matric) || empty($dep) || empty($book) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE library " . 
                "SET name = '$name', matric ='$matric', department = '$dep', book = '$book' " .
                "WHERE id = $id";

        $result = $connection->query($sql);

        if(!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Student has been Updated";

        header("location: /library/index.php");
        exit;

    }while(True);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Records</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Edit Student</h2>

        <?php
        if ( !empty($errorMessage) ) {
            echo "
            <div class='alert alert-warning alert-dismissable fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <input type="hidden" name="id"value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Matriculation</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="matric" value="<?php echo $matric; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Department</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="department" value="<?php echo $dep; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Book</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="book" value="<?php echo $book; ?>">
                </div>
            </div>


            <?php
            if (!empty($successMessage) ) {
                echo"
                <div class='row mb-3'>
                    <div class='offset-sm=3 col-sm-6'>
                        <div class='alert alert-success alert-dismissable fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div>
                    <a class="btn btn-outline-primary" href="/library/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
