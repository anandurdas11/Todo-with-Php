<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link href="todolist.png" rel="icon">
</head>
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/bootstrap.bundle.js"></script>
<body class="align-items-center bg-dark text-light">
    <nav class="navbar navbar-expand-lg  text-center navbar-dark bg-primary">
        <div class="container-fluid">
            <div class="navbar-brand text-center">
                <h4 class="text-center text-light">EDIT TASK 📃</h4>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <br>

   <?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "todos";
    $connection = new mysqli($servername,$username,$password,$database);
    if($connection->connect_error){
                die("Connection failed:". $connection->connect_error);
            }
    $todo = "";
    $_time ="";
    $_date ="";
    $error_msg="";
    $sucess_msg="";
    $val = 1;
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(!isset($_GET["Id"])){
            header("location: /TODOWITHPHP/index.php");
            exit;
        }
        $id = $_GET["Id"];
        $sql = "SELECT * FROM todolist WHERE Id=$id";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        if(!$row){
            header("location: /TODOWITHPHP/index.php");
            exit;
        }
        $todo = $row["Item"];
        $_time = $row["Time"];
        $_date =$row["date"];
        
    }
    
else{
    
    if(array_key_exists('submit',$_POST)){
        $id=$_POST["Id"];
        $todo = $_POST["todo"];
        $_time = $_POST["_time"];
        $_date =$_POST["_date"];
        echo "<script>cosole.log('$id')</script>";
    }
    do{
        if(empty($todo)||empty($_time)||empty($_date)){
           $error_msg = "feild is empty";
           echo"<script>alert('$id')</script>";
           echo "
            <div class='alert alert-warning alert-dismissible fade show w-25 mx-4 ' role='alert'>
                <strong>$error_msg</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            $val=0;
           break;
           
        }
       
            if(!preg_match('/^[A-Za-z\s]*$/',$todo)){
                $error_msg = "invalid input";
                echo "
            <div class='alert alert-warning alert-dismissible fade show w-25 mx-4' role='alert'>
                <strong>$error_msg</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            $val=0;
            break;
            
        
            }
        else{
            
           $sql = "UPDATE todolist  
            SET Item = '$todo',Time = '$_time',date = '$_date' WHERE Id = '$id'";
            $result = $connection->query($sql);
            echo "<script>cosole.log('$result')</script>";
        
        if(!$result){
            $error_msg="Ivalid query";
            echo "
            <div class='alert alert-warning alert-dismissible fade show w-25 mx-4' role='alert'>
                <strong>$error_msg</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        
           
            

        
        }
       
            sleep(2);
            header("Location: /TODOWITHPHP/list.php");
            exit;
            
      
        
      
    }while(false);}


?>
<br>
<?php if(isset($_GET['Update'])&&$_GET['Update']==1){

                  $sucess_msg="Updated sucessfully";
              echo "
            <div class='alert alert-success alert-dismissible fade show w-25 mx-4' role='alert'>
                <strong>$sucess_msg </strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            }
?>

    <form method="post" class="col align-items-center justify-content-center">
            <input  type="hidden" name="Id" value="<?php echo $id; ?>">
            <div class="row-cols-sm-auto mx-4 align-items-center" >
                <label class="col-sm-2 col-form-label ">Task</label>
                <div class="col-sm-6"><input type="text" class='form-control' name="todo" value="<?php echo $todo ?>">
                <br> 
                <label class="col-sm-2 col-form-label ">Time</label>
                <div class="col-sm-6"><input type="time" class='form-control' name="_time" value="<?php echo $_time ?>">
                <br> 
                <label class="col-sm-2 col-form-label ">Date</label>
                <div class="col-sm-6"><input type="date" class='form-control' name="_date" value="<?php echo $_date ?>">
                <br> 
                <input class="btn btn-primary" type="submit" name="submit" value="Update" > </div>
                <br>
                <a href="list.php" class="btn btn-primary">List of tasks</a>
    </form>

    
    
    
    
</body>
</html>