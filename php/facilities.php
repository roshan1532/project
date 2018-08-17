<?php
session_start();
if(empty($_SESSION)) $_SESSION['logged']=0;
?>

<!DOCTYPE html>

<html>

	<head>
		<link rel="icon" type="image/png" href="Images\Logo1.png">
		<title>Facilities - Wasteland Tracks</title>
		<?php include "Includes/link.html"?>
	</head>
	






	<body>
	<div class="container-fluid">
	<?php include "Includes/navigation.html"?>  <!--Navigation bar-->

	<div class="row main2">
			<div class="col-xs-offset-3 col-xs-6">
			<div class="well1">
			<img src="Images\Logo2.png" width="60px">
			<h2>Unique</h2>
			<p>We'll come up with the services, no one else can provide you.</p>
			</div>
			
			<div class="well1">
			<img src="Images\Logo2.png" width="60px">
			<h2>Options</h2>
			<p>We'll provide you numerous options to plan a perfect gateway for your journey.</p>
			</div>
			
			<div class="well1">
			<img src="Images\Logo2.png" width="60px">
			<h2>Innovation</h2>
			<p>Bored of same repetitive journey! Try our new luxury trains. We come up with innovative ideas to give you an unforgettable memory.</p>
			</div>

			<div class="well1">
			<img src="Images\Logo2.png" width="60px">
			<h2>Quality</h2>
			<p>Each and every train is designed in a manner to provide you a quality service.</p>
			</div>
			
			<div class="well1">
			<img src="Images\Logo2.png" width="60px">
			<h2>Comfort</h2>
			<p>We prefer our customer's comfort over anything. Your comfort will be our utmost priority.</p>
			</div>
			
			<div class="well1">
			<img src="Images\Logo2.png" width="60px">
			<h2>Experience</h2>
			<p>Our decade of experience in providing a gateway for your journey combines local knowledge with international taste. You'll be amazed at what we can provide!</p>
			</div>

			</div>
	</div>













	<?php include "Includes/footer.html"?> 

	</div>
	</body>

</html>