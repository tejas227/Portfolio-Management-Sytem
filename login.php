<?php
session_start();
    include('connection.php');
    
    if(isset($_POST['login']))
    { 
        $username = $_POST['username'];  
        $password = $_POST['password'];  
        
        $username = stripcslashes($username);  
        $password = stripcslashes($password); 
        $_SESSION['username']= $username;
        

        $sql = "select * from login where username = '$username' and password = '$password'";  
        $result = mysqli_query($link, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        $sql1 = "select * from client where name = '$username' ";
        $result1 =mysqli_query($link, $sql1);  
        $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
        $_SESSION['client_id']= $row1['client_id'];
        if($count == 1){
            if($row['type'] == 'client'){
                header("Location:admin_dashboard.php");    
            }  
            else{
                header("Location:customer_dashboard.php");
            }
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
            echo '<a href="login.php"><b>Login Again</b></a>';
        }     
    }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
  background-image: url('bg.jpg');
  background-repeat: no-repeat;
  background-size: cover;
}
label,h2,p,h1{
                color:black;
            }
        .wrapper{ width: 350px; padding: 20px; }

        .center {
         margin: auto;
         margin-top: 10%;
        border: 5px solid black;
        padding: 10px;
}
    </style>
</head>
<body>
    <marquee behavior="alternate"><h1><center>PORTFOLIO MANAGEMENT SYSTEM</center></h1></marquee>
    <div class="wrapper center">
        <center><h2> Login Form </h2></center>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" name="username">
            </div>    

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" name="login">Login</button>
                
            </div>
             <p>Don't have an account? <a href="registration.php">Sign up</a>.</p>
            
        </form>
    </div>    
</body>
</html>