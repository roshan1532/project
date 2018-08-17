<?php
 session_start();
 include("connection.php");
 if ($_SESSION['logged']!=1)
{
	echo"<script>alert('Invalid access! Please login.')</script>";
	echo"<script>window.open('index.php','_self')</script>";
}
 $dobErr=$mobErr=$zipErr="";
 $flag=0;
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	  
	  
	  $name = test_input($_POST["name"]);
	  $dob = test_input ($_POST["dob"]);
	  $mob = test_input ($_POST["mob"]);
	  $state = test_input ($_POST["state"]);
	  $zip = test_input ($_POST["zip"]);
	  $usr=$_SESSION['uname'];
	  
	  $today = date("Y-m-d");
	  $diff = date_diff(date_create($dob), date_create($today));
	  if($dob>$today){
		  $dobErr="*Invalid Date of birth!";
		  $flag=1;
	  }
	  else{
	  if(($diff->format('%y')) <18 )
	  {
		  $dobErr="*You must be atleast 18 years old!";
		  $flag=1;
	  }
	  }
	  
	  if(strlen($mob)<10)
	  {
		  $mobErr = "*Invalid Mobile No.!";
		  $flag=1;
	  }
	  if(strlen($zip)<6)
	  {
		  $zipErr = "*Invalid Zip Code!";
		  $flag=1;
	  }
	  $query="select *from user where Mobile='$mob' and User!='$usr';";
	  $res=mysqli_query($db,$query);
	  if (mysqli_num_rows($res) > 0)
	  {
		  $mobErr = "*$mob : Already taken!";
		  $flag=1;
	  }
	  if($flag==0)
	  {
	  $query="UPDATE user SET Name = '$name',DoB='$dob',Mobile='$mob',State = '$state', ZIP = '$zip' WHERE  User = '$usr';";
	  $res=mysqli_query($db,$query);
	 if($res)
	  {
		  echo"<script>alert('Profile updated successfully.')</script>";
		  echo"<script>window.open('profile.php','_self')</script>";
	  }
	  else
	  {
		  echo"<script>alert('Can not update profile at the moment. Please try again later.')</script>";
		  echo"<script>window.open('profile.php','_self')</script>";
	  } 
	  }
	}
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
?>



<!DOCTYPE html>


<html>

	<head>
		<link rel="icon" type="image/png" href="Images\Logo1.png">
		<title>Wasteland Tracks</title>
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
			
			<div class="col-xs-3">
			<div class="dropdown">
			  <a href="user.php" title = "Home" ><i class="fa fa-home" style="color:#1DA1F2; font-size:30px;"></i></a>
			</div>
			</div>
		</div>
		</div>

		</div>
		<!--END OF NAVIGATION BAR-->
		<?php
        $uname=$_SESSION['uname'];
        $query="select *from user where User='$uname';";
		$result=mysqli_query($db,$query);
		$row = mysqli_fetch_array($result);
		?>
	
	
	<div class="row">
				<div class="col-xs-offset-2 col-xs-8">
					<!--NEW USER FORM-->
					<div class="new-user">
						<h1>EDIT PROFILE</h1>
						
						<form class = "form-horizontal" action="editpro.php" method="post">
                            <fieldset disabled>
							<div class="form-group">
							<label for="new-mail" class="control-label col-xs-4">Email</label>
							<div class="col-xs-8">
							<?php echo'<input type="email" class="form-control" placeholder="Email" name="new-mail" required value="'.$row['Email'].'"/>' ?>
							</div>
							</div>
							</fieldset>
                             <fieldset disabled>
							<div class="form-group">
							<label for="usr" class="control-label col-xs-4">User Name</label>
							<div class="col-xs-8">
							<?php echo'<input type="text" class="form-control" placeholder="User Name" name="usr" required value="'.$row['User'].'"/>';?>
							</div>
							</div>
							</fieldset>

							<div class="form-group">
							<label for="fname" class="control-label col-xs-4">Full Name</label>
							<div class="col-xs-8">
							<?php echo'<input type="text" class="form-control" placeholder="Full Name" name="name" required value="'.$row['Name'].'"/>';?>							
							</div>
							</div>

							<div class="form-group">
							<label for="dob" class="control-label col-xs-4">Date of Birth</label>
							<div class="col-xs-8">
							<?php echo'<input type="date" class="form-control" name="dob" required value="'.$row['DoB'].'"/>';?>
							<span class="error" style="color:red;"><?php echo $dobErr;?></span>
							</div>
							</div>


							<div class="form-group">
							<label for="mob" class="control-label col-xs-4" >Mobile</label>
							<div class="col-xs-8">
							<?php echo'<input type="tel" class="form-control" placeholder="Mobile" name="mob" required maxlength="10" pattern= "[789][0-9]{9}" value="'.$row['Mobile'].'"/>';?>							
							<span class="error" style="color:red;"><?php echo $mobErr;?></span>
							</div>
							</div>
							
							
							<div class="form-group">
							<label for="state" class="control-label col-xs-4">State</label>
							<div class="col-xs-8">
							<select  name="state" tabindex="35" class="form-control" required >
								<option value="">Select</option>
								<option value="Andhra Pradesh" <?php if($row['State'] == 'Andhra Pradesh') echo 'selected';?>>Andhra Pradesh</option> 
								<option value="Arunachal Pradesh" <?php if($row['State'] == 'Arunachal Pradesh') echo 'selected';?> >Arunachal Pradesh</option> 
								<option value="Assam" <?php if($row['State'] == 'Assam') echo 'selected';?>>Assam</option> 
								<option value="Bihar" <?php if($row['State'] == 'Bihar') echo 'selected';?>>Bihar</option>
								<option value="Chattisgarh" <?php if($row['State'] == 'Chattisgarh') echo 'selected';?>>Chattisgarh</option>
								<option value="Goa" <?php if($row['State'] == 'Goa') echo 'selected';?>>Goa</option>
								<option value="Gujarat" <?php if($row['State'] == 'Gujarat') echo 'selected';?>>Gujarat</option>
								<option value="Harayana" <?php if($row['State'] == 'Harayana') echo 'selected';?>>Harayana</option>
								<option value="Himachal Pradesh" <?php if($row['State'] == 'Himachal Pradesh') echo 'selected';?>>Himachal Pradesh</option>
								<option value="Jammu Kashmir" <?php if($row['State'] == 'Jammu Kashmir') echo 'selected';?>>Jammu Kashmir</option>
								<option value="Jharkhand" <?php if($row['State'] == 'Jharkhand') echo 'selected';?>>Jharkhand</option>
								<option value="Karnataka" <?php if($row['State'] == 'Karnataka') echo 'selected';?>>Karnataka</option>
								<option value="Kerala" <?php if($row['State'] == 'Kerala') echo 'selected';?>>Kerala</option>
								<option value="Madhya Pradesh" <?php if($row['State'] == 'Madhya Pradesh') echo 'selected';?>>Madhya Pradesh</option>
								<option value="Maharashtra" <?php if($row['State'] == 'Maharashtra') echo 'selected';?>>Maharashtra</option>
								<option value="Manipur" <?php if($row['State'] == 'Manipur') echo 'selected';?>>Manipur</option>
								<option value="Meghalaya" <?php if($row['State'] == 'Meghalaya') echo 'selected';?>>Meghalaya</option>
								<option value="Mizoram" <?php if($row['State'] == 'Mizoram') echo 'selected';?>>Mizoram</option>
								<option value="Nagaland" <?php if($row['State'] == 'Nagaland') echo 'selected';?>>Nagaland</option>
								<option value="Odisha" <?php if($row['State'] == 'Odisha') echo 'selected';?>>Odisha</option>
								<option value="Punjab" <?php if($row['State'] == 'Punjab') echo 'selected';?>>Punjab</option>
								<option value="Rajasthan" <?php if($row['State'] == 'Rajasthan') echo 'selected';?>>Rajasthan</option>
								<option value="Sikkim" <?php if($row['State'] == 'Sikkim') echo 'selected';?>>Sikkim</option>
								<option value="Tamil Nadu" <?php if($row['State'] == 'Tamil Nadu') echo 'selected';?>>Tamil Nadu</option>
								<option value="Telangana" <?php if($row['State'] == 'Telangana') echo 'selected';?>>Telangana</option>
								<option value="Tripura" <?php if($row['State'] == 'Tripura') echo 'selected';?>>Tripura</option>
								<option value="Uttarakhand" <?php if($row['State'] == 'Uttarakhand') echo 'selected';?>>Uttarakhand</option>
								<option value="Uttar Pradesh" <?php if($row['State'] == 'Uttar Pradesh') echo 'selected';?>>Uttar Pradesh</option>
								<option value="West Bengal" <?php if($row['State'] == 'West Bengal') echo 'selected';?>>West Bengal</option>
								
							</select>
							</div>
							</div>
							
							
							<div class="form-group">
							<label for="zip" class="control-label col-xs-4">Zip-Code</label>
							<div class="col-xs-8">						    
							<?php echo'<input type="number" class="form-control" placeholder="Zip-Code" name="zip" required maxlength="6" pattern= "[0-9]{6}" size="3" value="'.$row['ZIP'].'"/>';?>
							<span class="error" style="color:red;"><?php echo $zipErr;?></span>
							</div>
							</div>
							

							<div class="form-group">
							<div class="col-xs-offset-1 col-xs-10">
							<button class= "btn btn-primary btn-block" type ="submit" name="editpro">Save Changes</button>
							</div>
							</div>

						</form>
					</div>
				</div>
				</div>
				
				
		
		</body>
		</body>
	</html>