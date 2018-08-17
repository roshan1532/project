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
		<title><?php echo $_SESSION['name'];?> - Wasteland Tracks</title>
		<?php include "Includes/link.html"?>
	</head>
	
	<body class='user-profile'>
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
			<div class="col-xs-1">
			  <a href="user.php" title="Home"><i class="fa fa-home" style="color:#1DA1F2; font-size:30px;"></i></a>
			</div>
			<div class="col-xs-1">
			  <a href="editpro.php" title="Edit Profile"><i class="fa fa-pencil-square-o" style="color:#1DA1F2; font-size:30px;"></i></a>
			</div>
			<div class="col-xs-1">
			  <a href="editpass.php" title="Change Password"><i class="fa fa-key" style="color:#1DA1F2; font-size:30px;"></i></a>
			</div>
		</div>
		</div>
		
		</div>
		
		
		<!--END OF NAVIGATION BAR-->
		<?php
			$fileErr="";
			$uname=$_SESSION['uname'];
			$query="select * from user where User='$uname';";
			$result=mysqli_query($db,$query);
			$row = mysqli_fetch_array($result);			   
		
		if(isset($_FILES['change']))
		{
			if($_FILES['change']['error'] != UPLOAD_ERR_NO_FILE)
			{
			  $info = pathinfo($_FILES['change']['name']);
			  $ext = $info['extension'];
			  $newname = $uname.".".$ext;
			  $target = 'Users/'.$newname;
			  move_uploaded_file( $_FILES['change']['tmp_name'], $target);
			}
			  else
			{
				$fileErr="* Please select a file";
			}
		  
		}
		
		  
		$userImage = 'Users/' . $uname . '.jpg';
		$defaultImage = 'Users/default.jpg';
		$image = (file_exists($userImage)) ? $userImage : $defaultImage;
		
		?>
		
				
		<div class="row">
		
		<div class=" col-xs-offset-1 col-xs-10">
		<div class='table-responsive'>
		<table class='table' style="margin-top:20px;">
			<thead>
				<tr>
				<th colspan="2" style="background: #000; color:#eee; font-size:30px; text-align:center;">MY PROFILE</th>
				</tr>
				
			</thead>
			
			<tbody style="background:#555; color:#000;">
			
			<tr>
			<td rowspan="10">
			<img src="<?php echo $image; ?>" alt="Profile Image" width="300" height="300" class="center-block" style="border:15px solid #667072; border-radius:5%;" /></br>
			
			
			<form action="profile.php" method="POST" enctype="multipart/form-data" >
			
			<label for="change">Change Photograph</label>
			<input type='file' name='change' />
			
			<button class= "btn btn-primary" type ="submit" name="upload" style="margin-top:10px;">Upload</button>
			</form>
			<span class="error" style="color:red;"><?php echo $fileErr;?></span>
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
				<td><span style="font-weight: bold;">WALLET Balance : </span><?php echo $row['Balance'];?> (INR) 
				<button class= "btn" type ="submit" name="addbal" onclick="window.open('money.php','_self')">Add Money</button></td> 
				</tr>
				
			</tbody>
		</table>
		</div>
		</div>
		
		</div>
		
		
		
		
	</div>	
	</body>
</html>
