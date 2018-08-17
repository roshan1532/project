<?php
session_start();
include('connection.php');
if ($_SESSION['alogged']!=1)
{
	echo"<script>alert('Invalid access! Please login.')</script>";
	echo"<script>window.open('index.php','_self')</script>";
}
?>
<!DOCTYPE html>

<html>

	<head>
		<link rel="icon" type="image/png" href="Images\Logo1.png">
		<title><?php echo $_SESSION['aname'];?> - Wasteland Tracks</title>
		<?php include "Includes/link.html"?>

	</head>
	
	
	

	<body class="admin-main">
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

		<!--END OF NAVIGATION BAR-->
		
		
		<div class="row admin-main">
		
		<div class=" col-xs-offset-1 col-xs-10">
		<div class='table-responsive'>
		<table class='table' style="margin-top:20px; text-align:center;">
			<thead>
				<tr>
				<th colspan="5" style="background: #111; color:#eee; font-size:30px; text-align:center;">USER PROFILES</th>
				</tr>
				<tr style='background:#3B5998; color:#fff; font-size:20px;'>
				<th style="text-align:center;">USER ID</th>
				<th style="text-align:center;">EMAIL</th>
				<th style="text-align:center;">NAME</th>
				<th style="text-align:center;">MOBILE</th>
				<th style="text-align:center;"> </th>
				</tr>
				
			</thead>
			
			<tbody>
			<?php
			  $query="select * from user";
			  $res=mysqli_query($db,$query);
			  $n=mysqli_num_rows($res);
			  if($n==0)
			  {
				  echo "<tr><td colspan='5'>No registered user.</td></tr>";
			  }
			  else
			  {
				  while($row = mysqli_fetch_assoc($res))
				  {
					  echo "<tr><td>".$row['User']."</td><td>".$row['Email']."</td><td>".$row['Name']."</td><td>".$row['Mobile']."</td>";
					  echo "<td><form action='seeprofile.php' method='POST'><input type='hidden' name='usr' value='".$row['User']."'/><button class='btn btn-success' type='submit' name='go'style='width:100%;' ><i class='fa fa-arrow-circle-right' style='font-size:20px;'></i></button></form></td></tr>";
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