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
			
			<div class="col-xs-3">
			  <a href="user.php" title = "Home" ><i class="fa fa-home" style="color:#1DA1F2; font-size:30px;"></i></a>
			</div>
		</div>
		</div>

		</div>
		<!--END OF NAVIGATION BAR-->
		<div class="user-profile">
		
		<?php
		
			$opwdErr = $amountErr = $cnamountErr = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{
				
				$opwd = test_input($_POST["opwd"]);
				$amount = test_input ($_POST["amount"]);
				$cnamount = test_input ($_POST["cnamount"]);
				
				$usr= $_SESSION['uname'];
				$mail= $_SESSION['umail'];
				$query="select * from user where Email='$mail' and User='$usr';";
				$res=mysqli_query($db,$query);
				$row=mysqli_fetch_array($res);
				$rpwd=$row['Password'];
				$bal=$row['Balance'];
				$opwd=md5($opwd);
				if($opwd==$rpwd)
				{
					if($bal >= 5000)
					{
						echo"<script>alert('You have enough money in your wallet.')</script>";
						echo"<script>window.open('profile.php','_self')</script>";
					}
					else
					{
						if($amount!=$cnamount)
						   {
							   $cnamountErr = "*Amount not confirmed";
						   }
						else if($amount>20000)
						{
						   $amountErr = "*You can't add more than Rs. 20000";
						}
						else
						{
							$amount+=$bal;
						   $q1="update user set Balance='$amount' where Email='$mail' and User='$usr'";
						   $r=mysqli_query($db,$q1);
						   if ($r) 
						   {
							   echo"<script>alert('Money added successfully')</script>";
							   echo"<script>window.open('profile.php','_self')</script>";
							}
							else 
							{
							   echo"<script>alert('Could not add money at the moment. Please try again later')</script>";
							   echo"<script>window.open('profile.php','_self')</script>";
							}
						}
					}
				}
				   else
				   {
					  $opwdErr = "* Wrong Password";
				   }
				   
				   
				
			}
			function test_input($data) {
			  $data = trim($data);
			  $data = stripslashes($data);
			  $data = htmlspecialchars($data);
			  return $data;
			}

			?>
			
		  <div class="col-xs-offset-2 col-xs-8">
					<!--NEW USER FORM-->
					<div class="new-user">
						<h1>Add Money</h1>
						
						<form class = "form-horizontal" action="money.php" method="post">
							
							
							<div class="form-group">
							<label for="amount" class="control-label col-xs-4">Enter Amount</label>
							<div class="col-xs-8">
						    <input type="number" placeholder="Enter Amount" name="amount" class="form-control" required>
							<span class="error" style="color:red;"><?php echo $amountErr;?></span>
							</div>
							</div>
							
							<div class="form-group">
							<label for="cnamount" class="control-label col-xs-4">Confirm Amount</label>
							<div class="col-xs-8">
						    <input type="number" placeholder="Confirm Amount" name="cnamount" class="form-control" required>
							<span class="error" style="color:red;"><?php echo $cnamountErr;?></span>
							</div>
							</div>
							
							
							<div class="form-group">
							<label for="opwd" class="control-label col-xs-4">Password</label>
							<div class="col-xs-8">
						    <input type="password" id="password" placeholder="Password" name="opwd" class="form-control" required>
							<span class="error" style="color:red;"><?php echo $opwdErr;?></span>
							</div>
							</div>
							
							

							<div class="form-group">
							<div class="col-xs-offset-1 col-xs-10">
							<button class= "btn btn-primary btn-block" type ="submit" name="addmoney">Add Money</button>
							<button class="btn btn-danger btn-block" type="reset">Reset</button>
							</div>
							</div>

						</form>
						<div class="col-xs-offset-1 col-xs-10">
							<a href="forgotpwd.php" target="_blank" style="color:#222; text-decoration:none;">Forgot Password?</a>
						</div>
					</div>
				</div>
			</div>
			
			
		</div>
		</body>
	</html>
		