<?php
session_start();
include('connection.php');
if ($_SESSION['alogged']!=1)
{
	echo"<script>alert('Invalid access! Please login.')</script>";
	echo"<script>window.open('index.php','_self')</script>";
}
$nameErr=$idErr='';
if (isset($_POST['addst'])) 
	{
		$sid=$_POST['sid'];
		$sname=$_POST['sname'];
		
		$flag=0;
		$query="select * from station where s_id='$sid' or s_name='$sname'";
		$res=mysqli_query($db,$query);
		if (mysqli_num_rows($res) > 0)
		  {
			 $row = mysqli_fetch_assoc($res);
			 if($row['s_id']==$sid) $idErr="* Already existing Station Id";
			 if($row['s_name']==$sname) $nameErr="* Already existing Station Name";
			 $flag=1;
		  }
		  else
		  {
			  $query="insert into station values('$sname','$sid')";
			  $res=mysqli_query($db,$query);
			  if(!$res)
			  {
				 echo"<script>alert('Can not add station at the moment. Please try again later.')</script>"; 
				 $flag=1;
			  }
		  }
		if ($flag==0)
		{
			echo"<script>alert('Station added successfully.')</script>";
			echo"<script>window.open('admin.php','_self')</script>";
		}
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
		
		<div class="row admin-body">
		<div class="col-xs-offset-2 col-xs-8">
		<h1 style="margin-top:30px; text-align: center;">ADD STATION</h1>
		
			<form class = "form-horizontal" action="addstat.php" method='POST' style="margin-top:100px;">

							<div class="form-group">
							<label for="sname" class="control-label col-xs-4">Station Name</label>
							<div class="col-xs-8">
							<input type="text" class="form-control" placeholder="Station Name" name="sname" required>
							<span class="error" style="color:red;"><?php echo $nameErr;?></span>
							</div>
							</div>
							
							<div class="form-group">
							<label for="sid" class="control-label col-xs-4">Station ID</label>
							<div class="col-xs-8">
							<input type="text" class="form-control" placeholder="Station ID" name="sid" required>
							<span class="error" style="color:red;"><?php echo $idErr;?></span>
							</div>
							</div>
							
							<div class="form-group">
							<div class="col-xs-offset-4 col-xs-8">
							<button class= "btn btn-primary btn-block" type ="submit" name="addst">Add</button>
							</div>
							</div>
				
			</form>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		</div>	
		</div>
	
	</div>
	</body>
</html>