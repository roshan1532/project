<?php
session_start();
include "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		
		$mail = $_POST["mail"];
				$otp = rand(100000,999999);
				$from='From : wastelandtracks@gmail.com';
				$message ='Your One Time Password is : '.$otp.'. Please do not share this with anyone. It will expire in 3HRs.
Thank you!

--
________________________________________

Wasteland Tracks
1st Floor, Internet Ticketing Centre
IRCA Building, State Entry Road,
New Delhi – 110055
Customer-Care: 011-39340000 (24x7)
________________________________________';
				if(mail($mail,'One Time Password',$message,$from))
				{
					$_SESSION['OTP']=$otp;
					$_SESSION['otpmail']=$mail;
					echo"<script>alert('A 6 digit code has been sent to your Email.')</script>";
					echo "<script>window.close()</script>";
				}
				else 
				{	
							
					echo"<script>alert('Can not process the request at the moment.Please check if the entered email is valid or try again later.')</script>";
					echo"<script>window.open('otpgen.php','_self')</script>";
				}
	}



?>
<html>

	<head>
		<link rel="icon" type="image/png" href="Images\Logo1.png">
		<title>Wasteland Tracks : OTP Generator</title>
		<?php include "Includes/link.html"?>
	</head>
	
	<body>
	
		
		<div class="row">
		<div class="col-xs-offset-2 col-xs-8">
		
		<div style="margin:50px; padding:80px; border:2px solid black;">
		<form class = "form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">


		<div class="form-group">
		<label for="mail" class="control-label col-xs-4">Email<span style="color:red"> *</span></label>
		<div class="col-xs-8">
		<input type="email" class="form-control" placeholder="Email" name="mail" required />
		</div>
		</div>
		<div class="form-group">
		<div class="col-xs-offset-4 col-xs-8">
		<button class= "btn btn-primary" type ="submit" name="sub">Generate OTP</button>
		</div>
		</div>

		</form>
		</div>
		
		
		</div>
		</div>
		
		
		
	</body>
</html>
