<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link href="todolist.png" rel="icon">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.bundle.js"></script>
</head>
<body class="align-items-center bg-dark">
    <nav class="navbar navbar-expand-lg nav-dark bg-primary text-center">
        <div class="container-fluid">
            <div class="navbar-brand text-center">
                <h4 class="text-center text-light">Scheduled Tasks 📃</h4>
            </div>
        </div>
    </nav>
    <br>
    <br>
     <div class="container my-4 mx-4">
         <a href="index.php"> <input class="btn btn-primary" type="submit" name="submit" value="Add a New Task" ></a>
    </div>
    <table class="table table-responsive  table-borderless table-dark caption-top mx-4 my-4 m-auto text-center" >
        <caption class="text-light text-secondary">List of tasks</caption>
        <thead>
            <th class='text-start'>Task</th>
            <th>Date</th>
            <th>Time</th>
           
        </thead>

        <?php
    $servername="localhost";
    $username = "root";
    $password = "";
    $database = "todos";
    $connection = new mysqli($servername,$username,$password,$database);
    if($connection->connect_error){
        die("Connection Failed:" . $connection->connect_error );
    }
    $sql="SELECT * FROM todolist";
    $result = $connection->query($sql);
    if(!$result){
        die("Invalid query" . $connection->error);
    }
    while($row = $result->fetch_assoc()){
        echo "<tr>
        <td class='text-start'>$row[Item]</td>
        <td>$row[date]</td>
        <td>$row[Time]</td>
        <td>
                    <a class='btn btn-primary btn-sm' href='/TODOWITHPHP/edit.php?Id=$row[Id]'>✏</a>
                    <a class='btn btn-danger btn-sm' href='/TODOWITHPHP/delete.php?Id=$row[Id]'>✖</a>
                </td>";
       
    }
    ?>

    </table>
    
   
   
</body>
</html>