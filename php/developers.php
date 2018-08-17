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
		$("#me").addClass("animated slideInUp");
		$("#aquib").addClass("animated slideInDown");
		$("#roshan").addClass("animated slideInDown");
		});
		</script> 
	</head>
	






	<body>
	<div class="container-fluid">
	
		<?php include "Includes/navigation.html"?>  <!--Navigation bar-->
		
		<div class="row dev">
			<div class="col-xs-4" id="aquib">
			<div class="left-well">
			<a href="aquib.php"><img src="Images\aquib.jpg" class="img-responsive center-block" alt="AQUIB" /></a>
			<h1>AQUIB</h1>
			</div>
			</div>
			<div class="col-xs-4" id="me">
			<div class="middle-well">
			<a href="pawan.php"><img src="Images\me.jpg" class="img-responsive center-block" alt="PAWAN"/></a>
			<h1>PAWAN</h1>
			</div>
			</div>
			<div class="col-xs-4" id="roshan">
			<div class="right-well">
			<a href="roshan.php"><img src="Images\roshan.jpg" class="img-responsive center-block" alt="ROSHAN"/></a>
			<h1>ROSHAN</h1>
			</div>
			</div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		</div>
	</div>
	</body>

</html>