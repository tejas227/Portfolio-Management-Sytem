<?php  
	session_start();
	include('connection.php');
	$client_id=$_SESSION['client_id'];
	if(isset($_POST['claim']))
	{
		$plan_id = $_POST['plan_id'];
		$claim_reason = $_POST['claim_reason'];
		$no_months = "select * from record where plan_id='$plan_id'";  
        $result = mysqli_query($link, $no_months);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $date1= new DateTime($row['start_date']);  
		//$date2= new DateTime($row['end_date']);
		$date2 =new DateTime($_POST['claim_date']);
		$interval = $date1->diff($date2);
		$diff = $interval->format('%a');
		$check =0;
		if ($row['plan_type'] == 'health_plan') {
			$claimed_amount=$row['covered_amount'];
			$check =1;
		}
		elseif ($row['plan_type'] == 'education_plan') {
			$claimed_amount=($row['covered_amount'] -5*$row['remaining_amount']);
			$check=1;
		} 
		if(($diff/30) >= 5)
		{
			if ($row['plan_type'] == 'short_term') {
			$claimed_amount=($row['covered_amount'] -3* $row['remaining_amount']);
			$check=1;
			}
		elseif ($row['plan_type'] == 'long_term') {
			$claimed_amount=($row['covered_amount'] - 4*$row['remaining_amount']);
			$check=1;
			}
		}

		if($check == 1)
		{
			$sql = "insert into claim (plan_id,claimed_amount,reason) values ('$plan_id','$claimed_amount','claim_reason')";
			$sql_delete = "delete from record where plan_id = '$plan_id'";
			$result = mysqli_query($link,$sql_delete);
			if (mysqli_query($link, $sql)){
				echo "<h4>Claimed succesfully....</h4> ";
				echo "<h4>Claimed amount is '$claimed_amount'</h4>";
			}
		}
		if(($diff/30) < 5)
		{
			echo "<h4>You cant claim this plan</h4>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<style type="text/css">
		
		body{ font: 14px; 
                background: url(bg.jpg) no-repeat center center fixed;
                background-size: cover;
              
            }
            label,h2,h4{
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
<div>
	<form method="POST" action="claim.php">
		<div>
			<label>PLAN ID</label>
			<input type="number" name="plan_id">
		</div>
		<div>
			<label>Claim Date</label>
			<input type="date" name="claim_date">
		</div>
		<div>
			<label>CLAIM REASON</label>
			<input type="text" name="claim_reason">
		</div><br>
		<button type="submit" name="claim" class="btn btn-primary">CLAIM</button>
	</form>
</div>
<a href="admin_dashboard.php">ADMIN DASHBOARD</a>
	
</body>
</html>