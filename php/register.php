<?php
session_start();
if ($_SESSION['logged']==1)
{
	echo"<script>alert('Can not register while you are logged in with another account. Please Logout')</script>";
	echo"<script>window.open('user.php','_self')</script>";
}
?>
<!DOCTYPE html>

<html>

	<head>
		<link rel="icon" type="image/png" href="Images\Logo1.png">
		<title>Register - Wasteland Tracks</title>
		<?php include "Includes/link.html"?>
		<script>
			function chcolm(chid1,chid2) 
				{
					document.getElementById(chid1).style.background='#333';
					document.getElementById(chid2).style.background='#f4415c';
					return true;
			  }
			function chcolf(chid1,chid2) 
				{
					document.getElementById(chid1).style.background='#333';
					document.getElementById(chid2).style.background='#7941f4';
					return true;
			  }
			function chcolr(chid1,chid2) 
				{
					document.getElementById(chid1).style.background='#f4415c';
					document.getElementById(chid2).style.background='#7941f4';
					return true;
			  }
		</script>
	</head>
	



	<body>
	<div class="container-fluid">


		<?php include "Includes/navigation.html"?>  <!--Navigation bar-->

		<div class="row">
				<div class="col-xs-offset-2 col-xs-8">
					<!--NEW USER FORM-->
					<?php include "validation.php"; ?>					
					<span class="error" style="font-size:20px;"><?php echo $fatErr;?></span>
					<div class="new-user">
						<h1>Registration Form</h1>
						<form class = "form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
							<div class="form-group">
							<label for="newmail" class="control-label col-xs-4">Email<span style="color:red"> *</span></label>
							<div class="col-xs-8">
							<input type="email" class="form-control" placeholder="Email" name="newmail" required value="<?php echo isset($_POST['newmail']) ? $_POST['newmail'] : '' ?>"/>
							<span class="error" style="color:red;"><?php echo $emailErr;?></span>
							</div>
							</div>

							<div class="form-group">
							<label for="usr" class="control-label col-xs-4">User Name<span style="color:red"> *</span></label>
							<div class="col-xs-8">
							<input type="text" class="form-control" placeholder="User Name" name="usr" required value="<?php echo isset($_POST['usr']) ? $_POST['usr'] : '' ?>"/>
							<span class="error" style="color:red;"><?php echo $usrErr;?></span>
							</div>
							</div>

							<div class="form-group">
							<label for="newpwd" class="control-label col-xs-4">Password<span style="color:red"> *</span></label>
							<div class="col-xs-8">
							<input type="password" class="form-control" placeholder="Minimum 8 characters" name="newpwd" required />
							<span class="error" style="color:red;"><?php echo $newpwdErr;?></span>
							</div>	
							</div>

							<div class="form-group">
							<label for="cnfmpwd" class="control-label col-xs-4">Confirm Password<span style="color:red"> *</span></label>
							<div class="col-xs-8">
							<input type="password" class="form-control" placeholder="Minimum 8 characters" name="cnfmpwd" required />
							<span class="error" style="color:red;"><?php echo $cnfmpwdErr;?></span>
							</div>
							</div>

							<div class="form-group">
							<label for="name" class="control-label col-xs-4">Full Name<span style="color:red"> *</span></label>
							<div class="col-xs-8">
							<input type="text" class="form-control" placeholder="Full Name" name="name" required value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>"/>
							</div>
							</div>


							<div class="form-group">
							<label for="dob" class="control-label col-xs-4">Date of Birth<span style="color:red"> *</span></label>
							<div class="col-xs-8">
							<input type="date" class="form-control" name="dob" required value="<?php echo isset($_POST['dob']) ? $_POST['dob'] : '' ?>"/>
							<span class="error" style="color:red;"><?php echo $dobErr;?></span>

							</div>
							</div>


							<div class="form-group">
							<label for="mob" class="control-label col-xs-4">Mobile<span style="color:red"> *</span></label>
							<div class="col-xs-8">
							<input type="tel" class="form-control" placeholder="Contact No." name="mob" pattern= "[6789][0-9]{9}" required maxlength="10" value="<?php echo isset($_POST['mob']) ? $_POST['mob'] : '' ?>"/>
							<span class="error" style="color:red;"><?php echo $mobErr;?></span>
							</div>
							</div>

							<div class="form-group">
							<label for="gender" class="control-label col-xs-4">Gender<span style="color:red"> *</span></label>
							<div class="col-xs-8">
							
							<div class="row">
							<div class="col-xs-6" >
							<div id="m" style="color:#fff; background:#7941f4; text-align:center; font-size:25px; margin:0px -15px 10px 0px;">
							<label class="radio-inline"  for="male" ><i class="fa fa-male"></i></label>
							<input type="radio" name="gender" onclick ="return chcolm('m','f');"  id="male" style="visibility:hidden;" required value="Male" />
							</div>
							</div>
							<div class="col-xs-6">
							<div id="f" style="color:#fff; background:#f4415c; text-align:center; font-size:25px; margin:0px 0px 10px -15px;">
							<label class="radio-inline"  for="female"><i class="fa fa-female"></i></label>
							<input type="radio" name="gender" onclick ="return chcolf('f','m');" id="female" style="visibility:hidden;" required value="Female" />
							</div>
							</div>
							
							</div>
							</div>
							
							
							<div class="form-group">
							<label for="state" class="control-label col-xs-4">State<span style="color:red"> *</span></label>
							<div class="col-xs-8">
							<select  name="state" tabindex="35" class="form-control" required >
								<option value="">Select</option>
								<option value="Andhra Pradesh">Andhra Pradesh</option> 
								<option value="Arunachal Pradesh">Arunachal Pradesh</option> 
								<option value="Assam">Assam</option> 
								<option value="Bihar">Bihar</option>
								<option value="Chattisgarh">Chattisgarh</option>
								<option value="Goa">Goa</option>
								<option value="Gujarat">Gujarat</option>
								<option value="Harayana">Harayana</option>
								<option value="Himachal Pradesh">Himachal Pradesh</option>
								<option value="Jammu Kashmir">Jammu Kashmir</option>
								<option value="Jharkhand">Jharkhand</option>
								<option value="Karnataka">Karnataka</option>
								<option value="Kerala">Kerala</option>
								<option value="Madhya Pradesh">Madhya Pradesh</option>
								<option value="Maharashtra">Maharashtra</option>
								<option value="Manipur">Manipur</option>
								<option value="Meghalaya">Meghalaya</option>
								<option value="Mizoram">Mizoram</option>
								<option value="Nagaland">Nagaland</option>
								<option value="Odisha">Odisha</option>
								<option value="Punjab">Punjab</option>
								<option value="Rajasthan">Rajasthan</option>
								<option value="Sikkim">Sikkim</option>
								<option value="Tamil Nadu">Tamil Nadu</option>
								<option value="Telangana">Telangana</option>
								<option value="Tripura">Tripura</option>
								<option value="Uttarakhand">Uttarakhand</option>
								<option value="Uttar Pradesh">Uttar Pradesh</option>
								<option value="West Bengal">West Bengal</option>
								
							</select>
							</div>
							</div>
							
							<div class="form-group">
							<label for="zip" class="control-label col-xs-4">Zip-Code<span style="color:red"> *</span></label>
							<div class="col-xs-8">
							<input type="num" class="form-control" placeholder="Zip-Code" name="zip" pattern= "[0-9]{6}" required maxlength="6" size="3" value="<?php echo isset($_POST['zip']) ? $_POST['zip'] : '' ?>"/>
							<span class="error" style="color:red;"><?php echo $zipErr;?></span>
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
							<input type="text" class="form-control" placeholder="Answer" name="ans" required>
							</div>
							</div>
							
							<!--<div class="form-group">
							<label for="otp" class="control-label col-xs-4">OTP<span style="color:red"> *</span></label>
							<div class="col-xs-8">
							<div class="row">
							<div class="col-xs-6">
							<input type="number" class="form-control" placeholder="One Time Password" name="otp" required maxlength="6" size="3"/>
							<span class="error" style="color:red;"><?php //echo$otpErr;?></span>
							</div>
							<div class="col-xs-6">
							<a href="otpgen.php" style="text-decoration:none;" target="_blank">Generate OTP</a>
							</div> 
							</div>
							</div>
							</div>-->
							
							<div class="form-group">
							<label for="pic" class="control-label col-xs-4">Profile Photo</label>
							<div class="col-xs-8">
							<input type='file' name='pic'/>
							<span style="color:blue">* only .jpg format are supported !</span>
							</div>
							</div>
							
							
							
							
							<div class="form-group">
							<div class="col-xs-offset-1 col-xs-10">
							<label><input type="checkbox" required /> I accept all the Terms and Conditions</label>
							</div>
							</div>
							
							<div class="form-group">
							<div class="col-xs-offset-1 col-xs-10">
							<a href="Includes/TnC.pdf" style="text-decoration:none;" download >Read all the Terms and Conditions</a>
							</div>
							</div>

							<div class="form-group">
							<div class="col-xs-offset-1 col-xs-10">
							<button class= "btn btn-primary btn-block" type ="submit" name="sub">Register</button>
							<button class="btn btn-danger btn-block" type="reset" onclick="return chcolr('f','m');">Reset</button>
							</div>
							</div>

						</form>
					</div>
				</div>
				</div>
				
	</div>
	</body>
</html>