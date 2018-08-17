<?php
session_start();
?>
<!DOCTYPE html>

<html>

	<head>
		<link rel="icon" type="image/png" href="Images\Logo1.png">
		<title>Login - Wasteland Tracks</title>
		<?php include "Includes/link.html"?>
		<script> 
		$(document).ready(function() {
		$("#existing").addClass("animated slideInUp");
		$("#admin").addClass("animated slideInUp");
		});
		</script> 
	</head>
	



	<body>
	<?php include("logs.php"); ?>


	<div class="container-fluid">
	
		<?php include "Includes/navigation.html"?>  <!--Navigation bar-->
		<!--CONTENT-->
		<div class="row account" id="Login">

			<!--LEFT WELL-->
			<div class="col-xs-offset-2 col-xs-8">
			<div class="row">
			<marquee style="margin:20px; color:#000; font-size:20px; ">PROMOTIONS : Register now to get a deposit of 10,000 INR right into your Wasteland's WALLET</marquee>
			<div class="col-xs-6">
				<!--EXISTING USER FORM-->
					<div class="existing" id="existing">
						<h3>Users:</h3>
						<form class = "form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

							<div class="form-group">
							<label for="umail" class="control-label col-xs-4">Email</label>
							<div class="col-xs-8">
							<input type="email" class="form-control" placeholder="Email" name="umail" required />
							</div>
							</div>

							<div class="form-group">
							<label for="upwd" class="control-label col-xs-4">Password</label>
							<div class="col-xs-8">
							<input type="password" class="form-control" placeholder="Passkey" name="upwd" required />
							<span class="error" style="color:red;"><?php echo $uErr;?></span>
							<span class="error" style="color:grey;"><?php echo $ulol;?></span>
							</div>
							</div>

							<div class="form-group">
							<div class="col-xs-offset-4 col-xs-8">
							<label><input type="checkbox"  name="urem"/> Remember Me</label>
							</div>
							</div>

							<div class="form-group">
							<div class="col-xs-offset-4 col-xs-8">
							<button class= "btn btn-primary" type ="submit" name="ulogin">Log In</button>
							</div>
							</div>

						</form>
						<div class="col-xs-offset-4 col-xs-8">
						<a href="forgotpwd.php" target="_blank">Forgot Password?</a>
						<p></p>
						<a href="register.php">New User?</a>
						</div>
					</div>
					<!--END OF EXISTING USER FORM-->
			</div>
			
			<!--END OF LEFT WELL-->


			<!--RIGHT WELL-->
			<div class="col-xs-6">
					
					<!--ADMIN FORM-->
					<div class="admin" id="admin">
						<h3>Admin:</h3>
						<form class = "form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

							<div class="form-group">
							<label for="amail" class="control-label col-xs-4">Email</label>
							<div class="col-xs-8">
							<input type="email" class="form-control" placeholder="Email" name="amail" required />
							</div>
							</div>

							<div class="form-group">
							<label for="apwd" class="control-label col-xs-4">Password</label>
							<div class="col-xs-8">
							<input type="password" class="form-control" placeholder="Passkey" name="apwd" required />
							<span class="error" style="color:red;"><?php echo $aErr;?></span>
							<span class="error" style="color:grey;"><?php echo $alol;?></span>
							</div>
							</div>

							<div class="form-group">
							<div class="col-xs-offset-4 col-xs-8">
							<label><input type="checkbox" name="arem" /> Remember Me</label>
							</div>
							</div>

							<div class="form-group">
							<div class="col-xs-offset-4 col-xs-8">
							<button class= "btn btn-primary" type ="submit" name="alogin">Log In</button>
							</div>
							</div>

						</form>
						<div class="col-xs-offset-4 col-xs-8">
						<a onclick="alert('You are the admin. You have responsibilities! You are not supposed to forget your password. Shame!');" target="_blank" style="padding-bottom:10px;">Forgot Password?</a>
						</div>
					
					</div>

					<!--END OF ADMIN FORM-->
			</div>

			<!--END OF RIGHT WELL-->
			</div>
			</div>

		</div>
		
		
		
		<!--END OF CONTENT-->
	</div>
	</body>

</html>