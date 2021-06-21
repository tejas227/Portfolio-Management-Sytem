<?php
session_start();

//include_once 'connection.php';
include('connection.php');
$client_id=$_SESSION['client_id'];
if(isset($_POST['save']))
{	 
	
	 $name = $_POST['name'];

	 $date = $_POST['date'];
	 $newdate = date("Y-m-d", strtotime($date));

	 $addr = $_POST['addr'];
	 $salary = $_POST['salary'];
	 $username=$_POST['username'];
	 $type=$_POST['type'];
	 //$client_id=$_SESSION['log_id'];
	 echo $client_id;

	 
	 $sql = "INSERT INTO customer (name,DOB,address,plan_type,salary,username,client_id)
	 VALUES ('$name','$newdate','$addr','$type','$salary','$username','$client_id') ";

	 if (mysqli_query($link, $sql)) {
		header("location: admin_dashboard.php");
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($link);
	 }
	 mysqli_close($link);
}




?>


<!DOCTYPE html>
<html>
<head>
	<title>insert</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px; 
                background: url(bg.jpg) no-repeat center center fixed;
                background-size: cover;
               color: white;
            }
            label{
            	color:white;
            }
        .wrapper{ width: 350px; padding: 20px; }

        .center {
           margin: auto;
           margin-top: 10%;
          border: 1px solid #73AD21;
          padding: 10px;
			}

			input{
				padding: 8px;
				width: 300px;

			}
			.st{
				width: 70px;
			}
			

			
    </style>
</head>
  <body>
  	<div class="wrapper center">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<form method="post" action="add_customer.php" >
		<div class="form-group">
		<label>Name:</label> <br>
		<input type="text" name="name">
		</div>
		<br>

		<div class="form-group">
		<label>D.O.B:</label> <br>
		<input type="date"  name="date">
		</div>
		<br>
		<div class="form-group">
		<label>Address:</label> <br>
		<input type="text" name="addr">
		</div>
		<br>
		<div class="form-group">
		<label>Salary:</label> <br>
		<input type="text" name="salary">
		</div>
		<br>
		<div class="form-group">
		<label>Username:</label> <br>
		<input type="text" name="username">
		
		</div>
		<br>
		<div class="form-group">
			<label>Type</label>
             <select name = "type">
               <option value = "long_term">Long Term</option>
               <option value = "short_term">Short Term</option>
               <option value = "education_plan">Educational</option>
               <option value = "health_plan">Health</option>              
             </select>
		</div>
		
		<br>
		<input type="submit" name="save" value="submit" class="btn btn-primary ">
		
	</form>

	</div>
  </body>
</html>