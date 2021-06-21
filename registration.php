<?php

session_start();
include('connection.php');
$_username = $_email = $_password_1 = $_password_2 = $_type="";
//$client_id=$_SESSION['client_id'];
if(isset($_POST['register']))
{
    $_email = $_POST['email'];
    $_username = $_POST['username'];
    $_password_1 = $_POST['password_1'];
    $_password_2 = $_POST['password_2'];
    $_type = $_POST['type'];

$sql = "INSERT INTO login (username,email,password,type)
VALUES ('$_username','$_email','$_password_1', '$_type')";

if (mysqli_query($link, $sql)) {
  header("Location:login.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($link);
}
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
  background-image: url('bg.jpg');
  background-repeat: no-repeat;
  background-size: cover;
}
label,h2,p{
              color:white;
            }
        .wrapper{ width: 350px; padding: 20px; }

         .center {
         margin: auto;
         margin-top: 10%;
        border: 5px solid white;
        padding: 10px;
}
    </style>
</head>
<title>register</title>
<body>
    <div class="wrapper center">
        <h2>Register Here</h2>

        <form action="registration.php" method="POST">

            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" >
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
            </div>    

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password_1" class="form-control">
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_2" class="form-control">
            </div>
            <br>

            <div>
                
             <label>Type</label>
             <select name = "type">
               <option name = "client">client</option>
               <option name = "customer">customer</option>              
             </select>
            </div>
            
            <br>

            <div class="form-group">
                <button type="submit" name="register">Register</button>
            </div>


            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>