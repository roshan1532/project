<?php
session_start();
include('connection.php');
if ($_SESSION['alogged']!=1)
{
	echo"<script>alert('Invalid access! Please login.')</script>";
	echo"<script>window.open('index.php','_self')</script>";
}
include('trainval.php');
?>
<!DOCTYPE html>

<html>

	<head>
		<link rel="icon" type="image/png" href="Images\Logo1.png">
		<title>Wasteland Tracks</title>
		<?php include "Includes/link.html"?>

	</head>
	
	
	

	<body>
	<div class="container-fluid">


		<!--NAVIGATION BAR-->
		<div class="row topnav">

		<div class = "col-xs-3">
		<div class ="row">
			<div class="col-xs-3">
				<a href="admin.php"><img src="Images\Logo.png" class="img-responsive" alt="Wasteland Tracks" width="100px" style="margin-top:-20px;"></a>
			</div>
		</div>
		</div>

		<div class="col-xs-9">
		<div class="row">
			<div class="col-xs-2">
				<a href="addtrain.php">Add Train</a>
			</div>

			<div class="col-xs-2">
				<a href="remtrain.php">Remove Train</a>
			</div>

			<div class="col-xs-2">
				<a href="addstat.php">Add Station</a>
			</div>
			
			<div class="col-xs-2">
			<a href="updtfare.php">Update Fare</a>
			</div>

			<div class="col-xs-2">
				<a href="userprofiles.php">User Profiles</a>
			</div>
			
			<div class="col-xs-2">
				<a href="logout.php" title="Log Out"><i class="fa fa-sign-out" style="color:#1DA1F2; font-size:30px;"></i></a>
			</div>
			
			
		</div>
		</div>

		</div>
		
		<!--END OF NAVIGATION-->
		
		
		
		<div class="row admin-main">
		<div class="col-xs-12">
		
			
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		</div>	
		</div>
	
	</div>
	</body>
</html>