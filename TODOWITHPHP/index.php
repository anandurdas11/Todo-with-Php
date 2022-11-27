<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo</title>
    <link href="todolist.png" rel="icon">
</head>
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/bootstrap.bundle.js"></script>
<body class="align-items-center bg-dark text-light">
    <nav class="navbar navbar-expand-lg  text-center navbar-dark bg-primary">
        <div class="container-fluid">
            <div class="navbar-brand text-center">
                <h4 class="text-center text-light">TODO 📃</h4>
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
    
if(array_key_exists('submit',$_POST)){
    


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $todo = $_POST["todo"];
        $_time = $_POST["_time"];
        $_date =$_POST["_date"];
    }
    do{
        if(empty($todo)||empty($_time)||empty($_date)){
           $error_msg = "feild is empty";
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
            $sql = "INSERT INTO todolist(item,time,date)" . "VALUES('$todo','$_time','$_date')";
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
       
            sleep(10);
            header("Location: /TODOWITHPHP/index.php?success=$val");
            
           
            $todo="";
            $_time="";
            exit;
      
        
      
    }while(false);
}
?>
<br>
<?php if(isset($_GET['success'])&&$_GET['success']==1){

                  $sucess_msg="Task added sucessfully";
              echo "
            <div class='alert alert-success alert-dismissible fade show w-25 mx-4' role='alert'>
                <strong>$sucess_msg</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            }
?>

    <form method="post" class="col align-items-center justify-content-center">
            
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
                <input class="btn btn-primary" type="submit" name="submit" value="Add to List" > </div>
                <br>
                <a href="list.php" class="btn btn-primary">List of tasks</a>
    </form>


    <section id="List of item">
        <p>
            <form action="list.php">
                
            </form>
    </p>
    </section>
    
    
    
    
</body>
</html>