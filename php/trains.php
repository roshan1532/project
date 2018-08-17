<?php
session_start();
$_SESSION['flag']=1;
if ($_SESSION['logged']!=1)
{
	echo"<script>alert('Invalid access! Please login.')</script>";
	echo"<script>window.open('index.php','_self')</script>";
}
?>

<!DOCTYPE html>

<html>

	<head>
		<link rel="icon" type="image/png" href="Images\Logo1.png">
		<title>Wasteland Tracks</title>
		<?php include "Includes/link.html"?>
	</head>

	<body >
	
	
	
	<div class="container-fluid">
		<!--NAVIGATION BAR-->
		
		<div class="row topnav">

		<div class = "col-xs-3">
		<div class ="row">
			<div class="col-xs-3">
				<a href="index.php"><img src="Images\Logo.png" class="img-responsive" alt="Wasteland Tracks" width="100px" style="margin-top:-20px;"></a>
			</div>

			<div class="col-xs-9">
				<h3>wasteland tracks</h3>
			</div>
		</div>
		</div>

		<div class="col-xs-9">
		<div class="row">
			<div class="col-xs-3">
				<a href="facilities.php">Facilities</a>
			</div>

			<div class="col-xs-3">
				<a href="support.php">Support</a>
			</div>

			<div class="col-xs-3">
				<a href="developers.php">Developers</a>
			</div>
			
			<div class="col-xs-3">
			<div class="dropdown">
			  <a href="user.php" title = "Home" ><i class="fa fa-home" style="color:#1DA1F2; font-size:30px;"></i></a>
			</div>
			</div>
		</div>
		</div>

		</div>
		<!--END OF NAVIGATION BAR-->
		
		<div class="row">
		
		<?php

		require "connection.php";

		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
		  $src = test_input($_POST['src']);
		  $dest = test_input($_POST['dest']);
		  $doj = $_POST['doj'];
		  $_SESSION['src']=$src;
		  $_SESSION['dest']=$dest;
		  $_SESSION['doj']=$doj;
		  
		if($src==$dest){
			echo"<script>alert('Source and Destination can not be the same. Try our cab services for intra-city journey')</script>";
			echo"<script>window.open('user.php','_self')</script>";
			$_SESSION['flag']=2;
		}
		$today = date("Y-m-d");
		$diff = date_diff(date_create($doj), date_create($today));
		if($doj<=$today or ($diff->format('%d'))>183)
		{
			echo"<script>alert('Please select a valid date for your journey.')</script>";
			echo"<script>window.open('user.php','_self')</script>";
			$_SESSION['flag']=2;
		}
		
		$weekday = date('l', strtotime($doj)); // note: first arg to date() is lower-case L
		$_SESSION['wday']=$weekday;

		$query2="select * from t_status where Date='$doj';";
		$res2=mysqli_query($db,$query2);
		if (mysqli_num_rows($res2) == 0)
		{
			$query="select r1.t_id ,t.t_name,t.t_type,(tc.sic1) as avail_seat_c1,(tc.sic2) as avail_seat_c2,(tc.sic3) as avail_seat_c3,
			0 as wait_seat_c1, 0 as wait_seat_c2, 0 as wait_seat_c3,
			(tc.fare1*(r2.source_distance-r1.source_distance)) as Fare1,(tc.fare2*(r2.source_distance-r1.source_distance)) as Fare2,
			(tc.fare3*(r2.source_distance-r1.source_distance)) as Fare3, (r2.source_distance-r1.source_distance) as dist
			from route r1,route r2,train t, train_class tc where r1.station_id='$src' and r2.station_id='$dest' and r1.t_id=r2.t_id and r1.t_id=t.t_id
			and t.t_id=tc.t_id and r1.avail_day='$weekday'and r1.stop_number<r2.stop_number";
		}
		else
		{
			$query="select r1.t_id ,t.t_name,t.t_type,ts.avail_seat_c1,ts.avail_seat_c2,ts.avail_seat_c3,ts.wait_seat_c1,ts.wait_seat_c2,ts.wait_seat_c3,
			(tc.fare1*(r2.source_distance-r1.source_distance)) as Fare1,(tc.fare2*(r2.source_distance-r1.source_distance)) as Fare2,
			(tc.fare3*(r2.source_distance-r1.source_distance)) as Fare3, (r2.source_distance-r1.source_distance) as dist
			from route r1,route r2,train t,t_status ts,train_class tc where r1.station_id='$src' and r2.station_id='$dest' and r1.t_id=r2.t_id and r1.t_id=t.t_id AND
			t.t_id=ts.t_id and t.t_id=tc.t_id and r1.avail_day='$weekday'and r1.stop_number<r2.stop_number and ts.Date='$doj'
			union all
			select r1.t_id ,t.t_name,t.t_type,(tc.sic1) as avail_seat_c1,(tc.sic2) as avail_seat_c2,(tc.sic3) as avail_seat_c3,NULL as wait_seat_c1, NULL as wait_seat_c2, NULL as wait_seat_c3,
			(tc.fare1*(r2.source_distance-r1.source_distance)) as Fare1,(tc.fare2*(r2.source_distance-r1.source_distance)) as Fare2,
			(tc.fare3*(r2.source_distance-r1.source_distance)) as Fare3, (r2.source_distance-r1.source_distance) as dist
			from route r1,route r2,train t, train_class tc where r1.station_id='$src' and r2.station_id='$dest' and r1.t_id=r2.t_id and r1.t_id=t.t_id
			and t.t_id=tc.t_id and r1.avail_day='$weekday'and r1.stop_number<r2.stop_number and r1.t_id not in(select t_id from t_status where Date='$doj');";
			
		}
		
		

		$query_run=mysqli_query($db,$query);
		if(!$query_run)
		  die("query_error" .mysqli_error($db));
		if (mysqli_num_rows($query_run) == 0)
		{
			echo"<script>alert('No direct train found ')</script>";
			echo"<script>window.open('user.php','_self')</script>";
			$_SESSION['flag']=2;
		}
		else
		{
		echo "
		
		<div class='table-responsive' style='text-align:center;'>
		<table class='table table-bordered table-striped text-centered' >
		 <thead>
		 <tr>
		 <th colspan='9' style='background:#3B5998; color:#fff; font-size:20px;'>AVAILABLE TRAINS</th>
		 </tr>
		 <tr>
				 <th colspan='3' style='text-align:center;' class='btn-info'>TRAIN</th>
				 <th colspan='2' style='text-align:center;' class='btn-primary'>SLEEPER</th>
				 <th colspan='2' style='text-align:center;' class='btn-warning'>AC-TIER1</th>
				 <th colspan='2' style='text-align:center;' class='btn-danger'>AC-TIER2</th>
			  </tr>
			  <tr class='btn-success'>
				 <th style='text-align:center;'>NUMBER</th>
				 <th style='text-align:center;'>NAME</th>
				 <th style='text-align:center;'>TYPE</th>
				 <th style='text-align:center;'>STATUS</th>
				 <th style='text-align:center;'>FARE(INR)</th>
				 <th style='text-align:center;'>STATUS</th>
				 <th style='text-align:center;'>FARE(INR)</th>
				 <th style='text-align:center;'>STATUS</th>
				 <th style='text-align:center;'>FARE(INR)</th>
			  </tr>
			</thead>";
		 echo "<tbody>";
		while($row = mysqli_fetch_assoc($query_run))
		  {
		  echo "<tr>";
		  echo "<td><a href='#'>". $row['t_id'] ."</a></td>";
		  echo "<td>" . $row['t_name'] . "</td>";
		  echo "<td>" . $row['t_type'] . "</td>";
		  
		  if($row['Fare1']) 
		  {
			  if($row['avail_seat_c1']!=0 and $row['wait_seat_c1']==0)
			  {
				  echo "<td>AVAILABLE " .$row['avail_seat_c1'] . "</td>";
				  echo "<td><form action='booking.php' method='POST'><input type='hidden' name='tid' value='".$row['t_id']."'/><input type='hidden' name='dist' value='".$row['dist']."'/><input class='btn btn-primary' type='submit' name='fare1' value='". $row['Fare1'] ."' style='width:100%' /></form></td>";
			  }
			  else 
			  {
				  if($row['wait_seat_c1']<10)
				  {
					  echo "<td> WAITING " . $row['wait_seat_c1'] . "</td>";
					  echo "<td><form action='booking.php' method='POST'><input type='hidden' name='tid' value='".$row['t_id']."'/><input type='hidden' name='dist' value='".$row['dist']."'/><input class='btn btn-primary' type='submit' name='fare1' value='". $row['Fare1'] ."' style='width:100%' /></form></td>";
				  }
				  else
				  {
					  echo "<td>UNAVAILABLE</td>";
					  echo "<td><input class='btn btn-primary' type='submit' value='". $row['Fare1'] ."' style='width:100%' disabled /></td>";
				  }
			  }
		  }
		  else 
		  {
			  echo "<td>---</td>";
			  echo "<td><input class='btn btn-primary' type='submit' value='' style='width:100%' disabled /></td>";
		  }

		  
		  if($row['Fare2'])
		  {
			   if($row['avail_seat_c2']!=0 and $row['wait_seat_c2']==0) 
			   {
				   echo "<td> AVAILABLE " . $row['avail_seat_c2'] . "</td>";
				   echo "<td><form action='booking.php' method='POST'><input type='hidden' name='tid' value='".$row['t_id']."'/><input type='hidden' name='dist' value='".$row['dist']."'/><input class='btn btn-warning' type='submit' name='fare2' value='". $row['Fare2'] ."' style='width:100%' /></form></td>";
			   }
			   else 
			  {
				  if($row['wait_seat_c2']<5)
				  {
					  echo "<td> WAITING " . $row['wait_seat_c2'] . "</td>";
					  echo "<td><form action='booking.php' method='POST'><input type='hidden' name='dist' value='".$row['dist']."'/><input type='hidden' name='tid' value='".$row['t_id']."'/><input class='btn btn-warning' type='submit' name='fare2' value='". $row['Fare2'] ."' style='width:100%' /></form></td>";
				  }
				  
				  else
				  {
					  echo "<td>UNAVAILABLE</td>";
					  echo "<td><input class='btn btn-warning' type='submit' value='". $row['Fare2'] ."' style='width:100%' disabled /></td>";
				  }
			  }
		  }
		  else 
		  {
			  echo "<td>---</td>";
			  echo "<td><input class='btn btn-warning' type='submit' value='' style='width:100%' disabled /></td>";
		  }

		  
		  if($row['Fare3'])
		  {
			  if($row['avail_seat_c3']!=0  and $row['wait_seat_c3']==0)
			  {
				   echo "<td> AVAILABLE " . $row['avail_seat_c3'] . "</td>";
				   echo "<td><form action='booking.php' method='POST'><input type='hidden' name='tid' value='".$row['t_id']."'/><input type='hidden' name='dist' value='".$row['dist']."'/><input class='btn btn-danger' type='submit' name='fare3' value='". $row['Fare3'] ."' style='width:100%' /></form></td>";
			  }
			  else 
			  {
				  if($row['wait_seat_c3']<5)
				  {
					  echo "<td> WAITING " . $row['wait_seat_c3'] . "</td>";
					  echo "<td><form action='booking.php' method='POST'><input type='hidden' name='tid' value='".$row['t_id']."'/><input type='hidden' name='dist' value='".$row['dist']."'/><input class='btn btn-danger' type='submit' name='fare3' value='". $row['Fare3'] ."' style='width:100%' /></form></td>";
					  }
				  else
				  {
					  echo "<td>UNAVAILABLE</td>";
					  echo "<td><input class='btn btn-danger' type='submit' value='". $row['Fare3'] ."' style='width:100%' disabled /></td>";
				  }
			  }
		  }
		  else 
		  {
			  echo "<td>---</td>";
			  echo "<td><input class='btn btn-danger' type='submit' value='' style='width:100%' disabled /></td>";
		  }

		  echo "</tr>";
		  }
		  echo"</tbody>";
		  echo "</table> 
		  </div>";
		 }
		}
		
		else
		  {
			  echo"<script>window.open('user.php','_self')</script>";
		  }
		 
		 
		 function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
		
		?>
					 
		</div>
		
		
		
	
	
	
	</div>	
	</body>
</html>