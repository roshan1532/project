<?php
session_start();
if(empty($_SESSION)) $_SESSION['logged']=0;
?>

<!DOCTYPE html>

<html>

	<head>
		<link rel="icon" type="image/png" href="Images\Logo1.png">
		<title>Developers - Wasteland Tracks</title>
		<?php include "Includes/link.html"?>
		<script> 
		$(document).ready(function() {
		$("#me").addClass("animated zoomIn");
		$("#aquib").addClass("animated slideInRight");
		$("#roshan").addClass("animated slideInLeft");
		});
		</script> 
		
	</head>
	






	<body>
	<div class="container-fluid">
	
		<?php include "Includes/navigation.html"?>  <!--Navigation bar-->
		
		<div class="row">
		<div class="pawan">
			<div class="col-xs-2" id="aquib">
			<a href="aquib.php"><img src="Images\aquib.jpg" class="img-responsive center-block" width="500px" style="border-radius:50%;"/></a>
			<h3>AQUIB</h3>
			</div>
		
			<div class="col-xs-8" id="me">
			<img src="Images\me.jpg" class="img-responsive center-block" width="400px"  style="border-radius:50%;"/>
			<h1 style="padding-bottom:20px;">PAWAN KUMAR</h1>
			</div>
			
			<div class="col-xs-2" id="roshan">
			<a href="roshan.php"><img src="Images\roshan.jpg" class="img-responsive center-block" width="500px" style="border-radius:50%;"/></a>
			<h3>ROSHAN</h3>
			</div>
		</div>		
		</div>
		<div class="row">
		<div class="col-xs-offset-2 col-xs-8">
		<div class="pawan-body">
		<table class='table table-responsive' style="margin-top:20px; text-align:center;">
			<thead>
				<tr>
				<th  style="background: #41454c; color:#eee; font-size:30px; text-align:center;">The man behind the scene</th>
				</tr>
			</thead>
			<tbody>
			<tr><td>PURSUING BACHELOR'S DEGREE IN COMPUTER SCIENCE & TECHNOLOGY</td></tr>
			<tr><td>MALAVIYA NATIONAL INSTITUTE OF TECHNOLOGY, JAIPUR</td></tr>
			<tr><td>I enjoy turning complex problems into simple, beautiful and intuitive interface designs.</td></tr>
			<tr><td>I ADORE BATMAN.</td></tr>
			<tr><td>I LOVE MUSIC & PHOTOGRAPHY.</td></tr>
			<tr><td>ROASTED CHICKEN, CHOCOLATE & COFFEE ARE <i class="fa fa-heart" style="color:#db3236; font-size:20px;"></td></tr>
			<tr><td>DEVELOPED THE FRONT-END & CONTRIBUTED IN BACK-END </td></tr>
			</tbody>
		</table>
		</div>
		</div>
		</div>
		
		<div class="row topnav" style="margin-top:100px;">

			<div class = "col-xs-offset-2 col-xs-8">
			<div class="sociallink">
			<div class="row">
			
			
			<div class="col-xs-offset-1 col-xs-2"><a href="https://www.facebook.com/im.kp07" target="_blank" title="Connect on Facebook"><i class="fa fa-facebook" style="color:#3B5998; font-size:30px;"></i></a></div>
			<div class="col-xs-2"><a href="https://twitter.com/iam_kp07" target="_blank" title="Follow me on Twitter"><i class="fa fa-twitter" style="color:#1DA1F2; font-size:30px;"></i></a></div>
			<div class="col-xs-2"><a href="https://instagram.com/iam_kp07" target="_blank" title="Follow me on Instagram"><i class="fa fa-instagram" style="color:RGB(76,76,76); font-size:30px;"></i></a></div>
			<div class="col-xs-2"><a href="https://www.linkedin.com/in/pawan-kumar-41aa81108" target="_blank" title="Connect on LinkedIn"><i class="fa fa-linkedin" style="color:#0077B5; font-size:30px;"></i></a></div>
			<div class="col-xs-2"><a href="https://gmail.com/" target="_blank" title="Mail me on pawankmzp97@gmail.com"><i class="fa fa-google" style="color:#db3236; font-size:30px;"></i></a></div>
			</div>
			</div>
			</div>

		</div>
		
		
					
	</div>
	</body>
</html>