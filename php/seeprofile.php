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
		
		
		<?php
		if(isset($_POST['go']))
		{
			$uname=$_POST['usr'];
			$query="select * from user where User='$uname';";
			$result=mysqli_query($db,$query);
			$row = mysqli_fetch_array($result);			   
		
		
		  
		$userImage = 'Users/' . $uname . '.jpg';
		$defaultImage = 'Users/default.jpg';
		$image = (file_exists($userImage)) ? $userImage : $defaultImage;
		}
		
		?>
		
				
		<div class="row admin-main">
		
		<div class=" col-xs-offset-1 col-xs-10">
		<div class='table-responsive'>
		<table class='table' style="margin-top:20px;">
			<thead>
				<tr>
				<th colspan="2" style="background: #000; color:#eee; font-size:30px; text-align:center;">USER PROFILE</th>
				</tr>
				
			</thead>
			
			<tbody style="background:#555; color:#000;">
			
			<tr>
			<td rowspan="10">
			<img src="<?php echo $image; ?>" alt="Profile Image" width="300" height="300" class="center-block" style="border:15px solid #667072; border-radius:5%;" /></br>
			</td>
			</tr>
				
				<tr><td><span style="font-weight: bold;">User Name : </span><?php echo $row['User'];?></td></tr>
				<tr><td><span style="font-weight: bold;">Email-Id : </span><?php echo $row['Email'];?></td></tr>
				<tr><td><span style="font-weight: bold;">Name : </span><?php echo $row['Name'];?></td></tr>
				<tr><td><span style="font-weight: bold;">Date of Birth : </span><?php echo $row['DoB'];?></td></tr>
				<tr><td><span style="font-weight: bold;">Gender : </span><?php echo $row['Gender'];?></td></tr>
				<tr><td><span style="font-weight: bold;">Contact : </span><?php echo $row['Mobile'];?></td></tr>
				<tr><td><span style="font-weight: bold;">State : </span><?php echo $row['State'];?></td></tr>
				<tr><td><span style="font-weight: bold;">ZIP Code : </span><?php echo $row['ZIP'];?></td></tr>
				<tr>
				<td><span style="font-weight: bold;">WALLET Balance : </span><?php echo $row['Balance'];?> (INR)</td> 
				</tr>
				
			</tbody>
		</table>
		</div>
		</div>
		
		</div>
		
		
		
		
	</div>	
	</body>
</html>
