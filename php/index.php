<?php
session_start();
include "connection.php";
if(empty($_SESSION)){ $_SESSION['logged']=0; $_SESSION['alogged']=0;}

$today=date("Y-m-d");


$query="select User, Fare from p_ticket where journey_date<'$today' and res_status='WAITING'";
$result=mysqli_query($db,$query);
while($row = mysqli_fetch_assoc($result))
{
	$q1="select Balance from user where User='{$row['User']}'";
	$res1=mysqli_query($db,$q1);
	if(!$res1) echo "hello";
	$row1=mysqli_fetch_array($res1);
	$row1['Balance']+=$row['Fare'];
	$q1="UPDATE user set Balance={$row1['Balance']} where User='{$row['User']}'";
	$res1=mysqli_query($db,$q1);
}
$query="delete from p_ticket where journey_date<'$today'";
$result=mysqli_query($db,$query);

$query="delete from t_status where Date<'$today'";
$result=mysqli_query($db,$query);

?>

<!DOCTYPE html>

<html>

	<head>
		<link rel="icon" type="image/png" href="Images\Logo1.png">
		<title>Wasteland Tracks</title>
		<?php include "Includes/link.html"?>
	</head>
	
	
	<body>
	<div class="container-fluid">
		
			<?php include "Includes/navigation.html"?>  <!--Navigation bar-->
			
			<!--Body-->

			<div class="row main1">
			
				<div class="col-xs-offset-3 col-xs-6">
				<h1 style="font-size:70px;">Welcome<br/>to<br/>Wasteland Tracks</h1>
				</div>
				<div class="col-xs-3">
				</div>
				
			</div>
			
			<div class="row main2">
			<div class="col-xs-offset-3 col-xs-6">
			<h3>Why you should choose WASTELAND TRACKS ?</h3>
			<p>With over 10 years of experience, we'll provide you with the highest quality services.</p>
			
			<div class="well1">
			<img src="Images\Logo2.png" width="60px">
			<h2>Quality</h2>
			<p>Each and every train is designed in a manner to provide you a quality service.</p>
			</div>
			
			<div class="well1">
			<img src="Images\Logo2.png" width="60px">
			<h2>Comfort</h2>
			<p>We prefer our customer's comfort over anything.Your comfort will be our utmost priority.</p>
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
