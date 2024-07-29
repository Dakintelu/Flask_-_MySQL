<?php
$servename = "localhost";
$username = "root";
$password = "";
$database = "s_m_s";

// Create Connection
$connection = new mysqli($servename, $username, $password, $database);


$name = "";
$matric = "";
$dep = "";
$book = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $matric = $_POST["matric"];
    $dep = $_POST["department"];
    $book = $_POST["book"];

    do {
        if ( empty($name) || empty($matric) || empty($dep) || empty($book) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        // add new client t0 database
        $sql = "INSERT INTO library (name, matric, department, book)" .
                "VALUES ('$name', '$matric', '$dep', '$book')";
        $result = $connection->query($sql);

        if(!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $name = "";
        $matric = "";
        $dep = "";
        $book = "";

        $successMessage = "Student Added Successfully";

        header("location: /library/index.php ");
        exit;

    } while (false);
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
        <h2>New Student</h2>

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