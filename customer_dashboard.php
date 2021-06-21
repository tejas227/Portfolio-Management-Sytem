<?php  
	include('connection.php');
	session_start();
	$username=$_SESSION['username']; 
	/*echo $username;
	$sql = "select * from customer where username ='$username'";
	$result = mysqli_query($link, $sql);  
    $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $cust_id= $row1['cust_Id'];
    echo $cust_id;*/
    $sql= "SELECT * FROM customer WHERE username= '$username' ";
	$result=mysqli_query($link,$sql);
	$cust_id="";
	echo "<center><h2>My Details</h2></center>";
	if(mysqli_num_rows($result) > 0)
	{
		echo '<table border=3  cellspacing=1px cellpading=0px width=60% align=center  class="table-light">';
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>D.O.B</th>";
        echo "<th>Address</th>";
        echo "<th>Plan Type</th>";
        echo "<th>Salary</th>";
       
        echo "</tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['DOB']."</td>";
            echo "<td>".$row['address']."</td>";
            echo "<td>".$row['plan_type']."</td>";
            echo "<td>".$row['salary']."</td>";
            echo "</tr>";
            $cust_id=$row['cust_Id'];
        }

        echo "</table>";
       // mysqli_free_res($result);
    }
    echo "<h4>Customer ID ".$cust_id."</h4>";
    $sql1= "SELECT * FROM record WHERE cust_id= '$cust_id' ";
	$result1=mysqli_query($link,$sql1);
    
    echo "<center><h2>My Plan Details</h2></center>";
    if(mysqli_num_rows($result1) > 0)
	{
		echo '<table border=3  cellspacing=1px cellpading=0px width=60% align=center  class="table table-light">';
        echo "<tr>";
        echo "<th>Plan ID</th>";
        echo "<th>Start Date</th>";
        echo "<th>End Date</th>";
        echo "<th>Plant Type</th>";
        echo "<th>Insured</th>";
        echo "<th>Per month amount</th>";
       echo "<th>Remaining amount</th>";
       echo "<th>Total Covering Amount</th>";
        echo "</tr>";
    
    while ($row1 = mysqli_fetch_array($result1)) {
            echo "<tr>";
            echo "<td>".$row1['plan_id']."</td>";
            echo "<td>".$row1['start_date']."</td>";
            echo "<td>".$row1['end_date']."</td>";
            echo "<td>".$row1['plan_type']."</td>";
            echo "<td>".$row1['insured']."</td>";
            echo "<td>".$row1['per_month']."</td>";
            echo "<td>".$row1['remaining_amount']."</td>";
            echo "<td>".$row1['covered_amount']."</td>";
            echo "</tr>";
            //$cust_id=$row['cust_Id'];
            echo "</table>";
        }
    }
    else
    {
    	echo "<h4>No plans are present.<h4>";
    }
    //echo "<center><h2>My Transaction</h2></center>";
    $sql2 = "SELECT * from transaction where plan_id=(SELECT plan_id from record where cust_id='$cust_id')";
    $result2=mysqli_query($link,$sql2);
    echo "<center><h2>My Transaction</h2></center>";
    if(mysqli_num_rows($result2) > 0)
	{
		echo '<table border=3  cellspacing=1px cellpading=0px width=60% align=center class="table table-light">';
        echo "<tr>";
        echo "<th>Transaction ID</th>";
        echo "<th>Plan ID</th>";
        echo "<th>Amount</th>";
        echo "<th>Date of Transaction</th>";
        echo "<th>Month</th>";
        echo "<th>Client ID</th>";
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
            echo "<td>".$row2['client_id']."</td>";
            //echo "<td>".$row1['remaining_amount']."</td>";
            //echo "<td>".$row1['covered_amount']."</td>";
            echo "</tr>";
            //$cust_id=$row['cust_Id'];
        }
    }
    else
    {
    	echo "<h4>No transaction are present.</h4>";
    }

    echo "<a href='logout.php'>Logout</a>";
?>
<!DOCTYPE html>
<html>
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
th,td{
    color:black;
}
h2,h4{
    color:white;
}
</style>
	<title>CUSTOMER DASHBOARD</title>
</head>
<body>

</body>
</html>