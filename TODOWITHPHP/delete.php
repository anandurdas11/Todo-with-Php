<?php
 if(isset($_GET["Id"])){
    $id = $_GET["Id"];
     $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "todos";
            $connection = new mysqli($servername,$username,$password,$database);
            $sql = "DELETE FROM todolist WHERE Id='$id'";
            $connection->query($sql);
 }
 header("location: /TODOWITHPHP/list.php");
            exit;
?>