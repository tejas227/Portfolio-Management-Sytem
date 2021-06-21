<?php
	
	session_start();
	include('connection.php');
	$client_id=$_SESSION['client_id'];
	//echo $client_id;
	if(isset($_POST['submit_plan']))
	{
		$cust_id=$_POST['cust_id'];
		$start_date=$_POST['start_date'];
		$end_date=$_POST['end_date'];

		//calculating no days
		$date1 = new DateTime($_POST['start_date']);
		$date2 = new DateTime($_POST['end_date']);
		$interval = $date1->diff($date2);
		$diff=$interval->format('%a');

		$plan_type=$_POST['plan_type'];
		$insured=$_POST['insured'];

		//calculating covered amount
		$amount_per_month = $_POST['amount_per_month'];
		$covered_amount;
		if ($_POST['plan_type'] == 'short_term') {
			$covered_amount=2*$amount_per_month*($diff/30);
		}
		elseif ($_POST['plan_type'] == 'long_term') {
			$covered_amount=3*$amount_per_month*($diff/30);
		}
		elseif ($_POST['plan_type'] == 'health_plan') {
			$covered_amount=10*$amount_per_month*($diff/30);
		}
		elseif ($_POST['plan_type'] == 'education_plan') {
			$covered_amount=5*$amount_per_month*($diff/30);
		}
		$remaining_amount = $amount_per_month*($diff/30);
		$sql = "INSERT INTO record (client_id,cust_id,start_date,end_date,plan_type,insured,per_month,covered_amount,remaining_amount) values ('$client_id','$cust_id','$start_date','$end_date','$plan_type','$insured','$amount_per_month','$covered_amount','$remaining_amount')";
		if (mysqli_query($link, $sql)) {
			//echo '<script>alert("Welcome to Geeks for Geeks")</script>';
  			header("Location:admin_dashboard.php");
			} else {
  				echo "Error: " . $sql . "<br>" . mysqli_error($link);
	  }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PLAN</title>
	<link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="jquery.js"></script> 
	<style type="text/css">
		body{ font: 14px; 
                background: url(bg.jpg) no-repeat center center fixed;
                background-size: cover;
              
            }
        .wrapper{ width: 350px; padding: 20px; }

        label{
        	color:white;
        }
        .center {
           margin: auto;
           margin-top: 4%;
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

    
    	<form method="POST" action="plan_registration.php">
	<div class="form-group">
	<label>Customer ID</label>
	<input type="number" name="cust_id">
	</div>
	<br>
	<div class="form-group">
	<label>Start Date of Plan</label>
	<input type="Date" name="start_date">
	</div><br>
	<div class="form-group">
	<label>End Date of Plan</label>
	<input type="Date" name="end_date">
	</div><br><br>
	<div>
		<label>Plan Type</label>
		<select name="plan_type">
			<option value="short_term">Short Term</option>
			<option value="long_term">Long Term</option>
			<option value="health_plan">Health Plan</option>
			<option value="education_plan">Education Plan</option>
		</select>
	</div><br>
	<div>
		<label>Insured Name</label>
		<input type="text" name="insured">
	</div><br>
	<div>
		<label>Amount to be paid per month</label>
		<input type="number" name="amount_per_month">
	</div>
	<button type="submit" name="submit_plan" class="btn btn-primary">SUBMIT</button>
</form>
</div>
<a href="admin_dashboard.php">ADMIN DASHBOARD</a>
    

	
</body>
</html>
