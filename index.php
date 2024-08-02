<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">       
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Records</title>     
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Library Records</h2>
        <a class="btn btn-primary" href="/library/create.php" role="button">New Student</a>
        <br>
        <table class="table">
        <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Matriculation Number</th>
                    <th>Department</th>
                    <th>Book</th>
                    <th>Check Out</th>
                </tr>
            </thead> 
            <tbody>
                <?php 
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "s_m_s";

                //Create connection
                $connection = new mysqli($servername, $username, $password, $database);

                //Check connection
                if ($connection->connect_error) {
                    die("Connection failed: ". $connection->connect_error);
                }

                //read all row from database table
                $sql = "SELECT * FROM library";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[matric]</td>
                        <td>$row[department]</td>
                        <td>$row[book]</td>
                        <td>$row[check_out]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/library/edit.php?id=$row[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='/library/delete.php?id=$row[id]'>Delete</a>
                        </td>
                </tr>
                    ";
                }

                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>
