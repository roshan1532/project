<?php
	$ques=$ans=$pwd=$cnfmpwd=$mail='';
	$quesErr=$ansErr=$pwdErr=$cnfmpwdErr= $otpERR='';
	$flag=0;
	include("connection.php");
	session_start();
	if(isset($_SESSION['OTP'])) $OTP=$_SESSION['OTP'];
	else $OTP='';
	if(isset($_SESSION['otpmail'])) $otpmail=$_SESSION['otpmail'];
	else $otpmail='';
	
if ($_SERVER["REQUEST_METHOD"] == "POST")
{	
	
	if(isset($_POST['next']))
	{
		$mail = test_input($_POST["mail"]);
		$ques = test_input ($_POST["ques"]);
	    $ans = test_input ($_POST["ans"]);
		$newpwd = test_input($_POST["newpwd"]);
		$cnfmpwd = test_input($_POST["cnfmpwd"]);
		$otp = test_input($_POST['otp']);
		$query="select * from user where Email='$mail';";
		$res=mysqli_query($db,$query);
		  if (mysqli_num_rows($res) < 1)
		  {
			  echo"<script>alert('Invalid Email')</script>";
		  }
		  
		  else
		  {
			  $ans=md5($ans);
			  $row = mysqli_fetch_assoc($res);
			  if($ques!=$row['Question'] or $ans!=$row['Answer'])
			  {
				  $quesErr = "*Invalid credentials";
				  $flag=1;
			  }
			  if(strlen($newpwd)<8)
			  {
				  $pwdErr = "*Password must be atleast 8 characters long!";
				  $flag=1;
			  }
			  if($cnfmpwd!=$newpwd)
			  {
				  $cnfmpwdErr = "*Password doesn't match!";
				  $flag=1;
			  }
			  if($OTP!=$otp or $otpmail!=$mail)
			  {
					$otpErr="*Invalid OTP";
					$flag=1;
			  }
			  if($flag==0)
			  {
				  $pwd=md5($newpwd);
				  $q1="update user set Password='$pwd' where Email='$mail'";
					$r=mysqli_query($db,$q1);
					 if ($r) 
					   {
						   
						   echo"<script>alert('Password set successfully. Please Login.')</script>";
						   unset($_SESSION['OTP']);
						   unset($_SESSION['otpmail']);
						   $_SESSION['logged']=0;
						   echo"<script>window.close()</script>";
						} 
						else 
						{
						   echo"<script>alert('Could not set password at the moment. Please try again later')</script>";
						   echo"<script>window.close()</script>";
						}
			  }
			  
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
		<title>Forgot Password</title>
		<?php include "Includes/link.html"?>
	</head>


	<body style='background:url("Images/020.png"); background-attachment:fixed;'>
	<div class="container-fluid">
			<div class="row">
			<div class="col-xs-offset-2 col-xs-8">
			
			<div class="new-user">
			<h1 style="text-decoration:none">Change Password</h1>
			<form class = "form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
			

			<div class="form-group">
			<label for="mail" class="control-label col-xs-4">Email<span style="color:red"> *</span></label>
			<div class="col-xs-8">
			<input type="email" class="form-control" placeholder="Email" name="mail" required value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : '' ?>"/>
			</div>
			</div>
			
			<div class="form-group">
			<label for="ques" class="control-label col-xs-4">Security Question<span style="color:red"> *</span></label>
			<div class="col-xs-8">
			<select  name="ques" tabindex="8" class="form-control" required > 
				<option value="">Select One</option>
				<option value="0">Mother's maiden name.</option> 
				<option value="1">Name of town where you were born.</option> 
				<option value="2">Name of first pet.</option> 
				<option value="3">Name of your first school.</option>
			</select>
			</div>
			</div>
							
							
			<div class="form-group">
			<label for="ans" class="control-label col-xs-4">Security Answer<span style="color:red"> *</span></label>
			<div class="col-xs-8">
			<input type="text" class="form-control" placeholder="Answer" name="ans" required value="<?php echo isset($_POST['ans']) ? $_POST['ans'] : '' ?>">
			<span class="error" style="color:red;"><?php echo $quesErr;?></span>
			</div>
			</div>
			
			<div class="form-group">
			<label for="newpwd" class="control-label col-xs-4">New Password<span style="color:red"> *</span></label>
			<div class="col-xs-8">
			<input type="password" class="form-control" placeholder="Minimum 8 characters" name="newpwd" required value="<?php echo isset($_POST['newpwd']) ? $_POST['newpwd'] : '' ?>"/>
			<span class="error" style="color:red;"><?php echo $pwdErr;?></span>
			</div>	
			</div>

			<div class="form-group">
			<label for="cnfmpwd" class="control-label col-xs-4">Confirm Password<span style="color:red"> *</span></label>
			<div class="col-xs-8">
			<input type="password" class="form-control" placeholder="Minimum 8 characters" name="cnfmpwd" required value="<?php echo isset($_POST['cnfmpwd']) ? $_POST['cnfmpwd'] : '' ?>" />
			<span class="error" style="color:red;"><?php echo $cnfmpwdErr;?></span>
			</div>
			</div>
			
			<div class="form-group">
			<label for="otp" class="control-label col-xs-4">OTP<span style="color:red"> *</span></label>
			<div class="col-xs-8">
			<input type="num" class="form-control" placeholder="One Time Password" name="otp" required maxlength="6" size="3"/>
			<a href="otpgen.php" style="text-decoration:none;" target="_blank">Generate OTP</a>
			</div>
			</div>
			
			<div class="form-group">
				<button class= "btn btn-primary btn-block" type ="submit" name="next">Next</button>
			</div>
			
			
			

			</form>
			</div>
			
			
			
			
			</div>
			</div>
	</div>
	</body>
</html>
		