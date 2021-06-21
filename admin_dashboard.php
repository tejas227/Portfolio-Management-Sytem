<?php
	session_start();
	$client_id=$_SESSION['client_id'];

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  	<style>
  	body{
  	 background-image: url("bg.jpg");
  	 background-repeat: no-repeat; 
  background-size: cover; 
  
  }
  a{
  color: white;
}
  .dashboard{
  text-align: center;
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  height: 500px;
  width: 500px;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  border: 5px solid white;
  }
  </style>
  </head>
  <title>ADMIN DASHBOARD</title>
  <body>
  	<div class="dashboard">
  	<h1>
  	<a class="btn btn-primary" href="add_customer.php">Add customer</a><br>
  	<a class="btn btn-primary" href="plan_registration.php">Add plan</a><br>
  	<a class="btn btn-primary" href="transaction.php">Make payment</a><br>
  	<a class="btn btn-primary" href="claim.php">Claim the plan</a><br>
    <a class="btn btn-secondary" href="logout.php">Logout</a><br>
	</h1>
</div>
  </body>
</html>

