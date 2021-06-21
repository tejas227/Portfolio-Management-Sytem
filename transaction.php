<?php
	session_start();
	include('connection.php');
	$client_id=$_SESSION['client_id'];
	$plan_id=$amount=$date=$month=$client_name="";
	if(isset($_POST['make_transaction']))
	{
		$plan_id=$_POST['plan_id'];
		//$amount=$_POST['amount'];
		$month = $_POST['month'];
		//$client_name = $_POST['client_name'];
		$_date= $_POST['date_t'];

		$sql_update = "select * from record where plan_id='$plan_id'";  
        $result = mysqli_query($link, $sql_update);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $temp= $row['remaining_amount'];  
        $amount=$row['per_month'];
        $temp= $temp - $amount;
		$sql = "INSERT INTO transaction (plan_id,amount,date,month,client_id) 
		values ('$plan_id','$amount','$_date','$month','$client_id')";
		
        $sql_update_final = "update record set remaining_amount ='$temp' where plan_id='$plan_id' ";
        $result = mysqli_query($link, $sql_update_final); 
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (mysqli_query($link, $sql)) {
  			header("Location:admin_dashboard.php");
  			//echo $temp;
			} else {
  				echo "Error: " . $sql . "<br>" . mysqli_error($link);
	  }
	}
	$sql2 = "SELECT * from transaction_view where client_id = $client_id";
    $result2=mysqli_query($link,$sql2);
    echo "<center><h2>My Transactions</h2></center>";
   //echo '<center>Make Transactions</center>'

    if(mysqli_num_rows($result2) > 0)
	{
		//echo '<div id="demo" class="collapse">';
		echo '<table border=3  cellspacing=1px cellpading=0px width=60% align=center class="table table-light">';
        echo "<tr>";
        echo "<th>Transaction ID</th>";
        echo "<th>Plan ID</th>";
        echo "<th>Amount</th>";
        echo "<th>Date of Transaction</th>";
        echo "<th>Month</th>";
        //echo "<th>Client ID</th>";
       //echo "<th>Remaining amount</th>";
       //echo "<th>Total Covering Amount</th>";
        echo "</tr>";
    
    while ($row2 = mysqli_fetch_array($result2)) {
            echo "<tr>";
            echo "<td>".$row2['transaction_id']."</td>";
            echo "<td>".$row2['plan_id']."</td>";
            echo "<td>".$row2['amount']."</td>";
            echo "<td>".$row2['date']."</td>";
            echo "<td>".$row2['month']."</td>";
            //echo "<td>".$row2['client_id']."</td>";
            //echo "<td>".$row1['remaining_amount']."</td>";
            //echo "<td>".$row1['covered_amount']."</td>";
            echo "</tr>";
            //$cust_id=$row['cust_Id'];
        }
    
    }
    else
    {
    	echo "No transaction are present.";
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>TRANSACTION</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<style type="text/css">
		
		body{ font: 14px; 
                background: url(bg.jpg) no-repeat center center fixed;
                background-size: cover;
              
            }
            label,h2,td,th,h1{
            	color:white;
            }
        .wrapper{ width: 350px; padding: 20px; height: 400px; }

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
<body class="wrapper center">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
<div>
	<form method="POST" action="transaction.php">
		<div class="form-group">
			<label>Plan ID</label>
			<input type="number" name="plan_id">
		</div>
		<div class="form-group">
			<label>Date of Transaction</label>
			<input type="date" name="date_t">
		</div>
		<div class="form-group">
			<label>Month</label><br>
			<select name="month">
				<option name="january">January</option>
				<option name="february">February</option>
				<option name="march">March</option>
				<option name="april">April</option>
				<option name="may">May</option>
				<option name="june">June</option>
				<option name="july">July</option>
				<option name="august">August</option>
				<option name="september">September</option>
				<option name="october">October</option>
				<option name="november">November</option>
				<option name="december">December</option>
			</select>
		</div><br><br>
		<button type="submit" name="make_transaction" class="btn btn-primary">Make Transaction</button>
	</form>
</div>
<a href="admin_dashboard.php">ADMIN DASHBOARD</a>
</body>
	
</body>
</html>