<?php
if ( isset($_GET["id"]) ) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "s_m_s";

    //Create Connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM library WHERE id=$id";
    $connection->query($sql);

}

header("location: /library/index.php");
exit;
?>

