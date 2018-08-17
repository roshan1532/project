<?php
session_start();
if(empty($_SESSION)) $_SESSION['logged']=0;

if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$mail = test_input($_POST["mail"]);
		$name = test_input($_POST["name"]);
		$subject=test_input($_POST["subject"]);
		$message = test_input($_POST["message"]);
		$to="wastelandtracks@gmail.com";
		$subject=$subject.' - '.$name;
		$from='From : '.$to;
		$message = $message.' - '.$mail;
$ack="We have recieved your request. Our customer officer will be contacting you soon.
In case of urgency, feel free to contact us on 011-39340000(24x7).
Thank you for contacting us.

--
_________________________________________

Wasteland Tracks
1st Floor, Internet Ticketing Centre
IRCA Building, State Entry Road,
New Delhi – 110055
Customer-Care: 011-39340000 (24x7)
_________________________________________";
		
		if(mail($to,$subject,$message,$from))
		{
			mail($mail,'ACKNOWLEDGEMENT',$ack,$from);
			echo"<script>alert('We have recieved your request. We will get back to you on this very soon')</script>";
			echo"<script>window.open('support.php','_self')</script>";
		}
		else 
		{
			echo"<script>alert('Can not process the request at the moment. Please try again later.')</script>";
			echo"<script>window.open('support.php','_self')</script>";
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
		<title>Support - Wasteland Tracks</title>
		<?php include "Includes/link.html"?>
	</head>
	





	<body style='background:#41f4d6; background-attachment:fixed;'>
	<div class="container-fluid">
	<?php include "Includes/navigation.html"?>  <!--Navigation bar-->
	<div class="row support">
	
	<div class="col-xs-6">
	
	<div class='table-responsive'>
		<table class='table' style="margin-top:20px;">
			<thead>
				<tr>
				<th colspan="1" style="background: #111; color:#eee; font-size:40px; text-align:center;">Contact Us</th>
				</tr>
			</thead>
			<tbody style="text-align:center;">
			
			<tr><td><a href="https://www.facebook.com/" target="_blank" title="Contact us on Facebook" style="color:#3B5998;"><i class="fa fa-facebook" ></i></a></td></tr>
			<tr><td><a href="https://twitter.com/" target="_blank" title="Contact us on Twitter" style="color:#1DA1F2;"><i class="fa fa-twitter" ></i></a></td></tr>
			<tr><td><a href="https://gmail.com/" target="_blank" title="Mail us on wastelandtracks@gmail" style="color:#db3236;"><i class="fa fa-google"></td></tr>
			
			</tbody>
			
			
		</table>
	</div>
	</div>
	
	<div class=" col-xs-6">
	
	<div class='table-responsive'>
		<table class='table' style="margin-top:20px;">
			<thead>
				<tr>
				<th colspan="1" style="background: #111; color:#eee; font-size:40px; text-align:center;">Send message</th>
				</tr>
			</thead>
		</table>
	</div>
	
	
	<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
							<div class="form-group">
							<label for="mail" class="control-label">Your Email<span style="color:red"> *</span></label>
							<input type="email" class="form-control" placeholder="Email" name="mail" required />
							</div>

							<div class="form-group ">
							<label for="name" class="control-label">Your Name<span style="color:red"> *</span></label>
							<input type="text" class="form-control" placeholder="Name" name="name" required />
							</div>
							
							<div class="form-group">
							<label for="subject" class="control-label">Your Issue<span style="color:red"> *</span></label>
							<select  name="subject" tabindex="5" class="form-control" required >
								<option value="">Select</option>
								<option value="Customer Services">Customer Services</option> 
								<option value="Complaints">Complaints</option> 
								<option value="Suggestions">Suggestions</option> 
								<option value="Others">Others</option>
							</select>
							</div>
							
							<div class="form-group ">
							<label for="message" class="control-label">Your message<span style="color:red"> *</span></label>
							<textarea class="form-control" name="message" rows="8"></textarea>
							</div>
							
							<div class="form-group">
							<button class= "btn btn-primary" type ="submit" name="send" style="margin-bottom:25px;">Send Mail</button>
							</div>
	</form>
	
	</div>

			
	</div>
	
	<h4 style="margin:15px 0px; text-align:center;">Contact us on : 24*7 Hrs. Customer Support at : <i class="fa fa-phone"></i> 011-39340000</h4>
	<?php include "Includes/footer.html"?> 
	
	</div>
	</body>

</html>