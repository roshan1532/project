<?php
session_start();
include('connection.php');
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
	

	<body class='ticket-main'>
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
		<!--END OF NAVIGATION-->
		
		<div class="row">
		
		<div class=" col-xs-offset-1 col-xs-10">
		<div class='table-responsive'>
		<table class='table table-striped' style="margin-top:20px; text-align:center;">
			<thead>
				<tr>
				<th colspan="7" style="background: #000; color:#eee; font-size:30px; text-align:center;">MY BOOKINGS</th>
				</tr>
				<tr style='background:#3B5998; color:#fff; font-size:20px;'>
				<th style="text-align:center;">PNR</th>
				<th style="text-align:center;">Train No.</th>
				<th style="text-align:center;">Class</th>
				<th style="text-align:center;">Status</th>
				<th style="text-align:center;">Journey Date</th>
				<th style="text-align:center;">Booking Date</th>
				<th style="text-align:center;"> </th>
				</tr>
				
			</thead>
			
			<tbody>
			<?php
		      $usr=$_SESSION['uname'];
			  $query="select *from p_ticket where User='$usr';";
			  $res=mysqli_query($db,$query);
			  $n=mysqli_num_rows($res);
			  if($n==0)
			  {
				  echo "<tr><td colspan='7'> You haven't made any booking yet.</td></tr>";
			  }
			  else
			  {
				  while($row = mysqli_fetch_assoc($res))
				  {
					  echo "<tr><td>".$row['PNR']."</td><td>".$row['t_id']."</td><td>".$row['class']."</td><td>".$row['res_status']."</td><td>".$row['journey_date']."</td><td>".$row['DoBk']."</td>";
					  echo "<td><form action='mytickets.php' method='POST'><input type='hidden' name='pnr' value='".$row['PNR']."'/><button class='btn btn-success' type='submit' name='go'style='width:100%;' ><i class='fa fa-arrow-circle-right' style='font-size:20px;'></i></button></form></td></tr>";
				  }
			  }
			  
			  
			  ?>
				
				
			</tbody>
		</table>
		</div>
		</div>
		
		</div>
		
		
		

		
	</div>
	</body>
	</html>