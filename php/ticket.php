<?php
session_start();
include('connection.php');
if(!$_SESSION['success'])
include('ticketgen.php');


$train=$_SESSION['train'];
$source = $_SESSION['source'];
$destination = $_SESSION['destination'];
$type = $_SESSION['type'];
$from =$_SESSION['from'];
$to =$_SESSION['to'];
$day=$_SESSION['wday'];
$pnr=$_SESSION['pnr'];

$query="select *from p_ticket where PNR=$pnr;";
$result=mysqli_query($db,$query);
$row = mysqli_fetch_array($result);
$pnr=$row['PNR'];
$tid=$row['t_id'];
$class=$row['class'];
$src=$row['src_id'];
$dist=$row['Distance'];
$dest=$row['dest_id'];
$adult=$row['Adult'];
$child=$row['Child'];
$fare=$row['Fare'];
$doj=$row['journey_date'];
$status=$row['res_status'];
$dobk=$row['DoBk'];

$query="select r1.depart_time, r2.arrive_time, r1.avail_day as deptday, r2.avail_day as arrday from route r1,route r2 where r1.station_id='$src' and r2.station_id='$dest' and r1.t_id=r2.t_id and r1.t_id='$tid'
			and r1.avail_day='$day'and r1.stop_number<r2.stop_number";
$result=mysqli_query($db,$query);
$row = mysqli_fetch_array($result);
$deptday=$row['deptday'];
$arrday=$row['arrday'];
$departure=$row['depart_time'];
$arrival=$row['arrive_time'];

$query="select * from passenger where PNR = '$pnr'";
$result=mysqli_query($db,$query);
$row = mysqli_fetch_array($result);

$sno1=$row['Seat1'];
$ber1=$row['Berth1'];
$name1=$row['Name1'];
$age1=$row['Age1'];
$gender1=$row['Gender1'];
$sno2=$row['Seat2'];
$ber2=$row['Berth2'];
$name2=$row['Name2'];
$age2=$row['Age2'];
$gender2=$row['Gender2'];
$sno3=$row['Seat3'];
$ber3=$row['Berth3'];
$name3=$row['Name3'];
$age3=$row['Age3'];
$gender3=$row['Gender3'];
$user=$row['User'];

$query="select * from user where User = '$user'";
$result=mysqli_query($db,$query);
$row = mysqli_fetch_array($result);

$uname=$row['Name'];
$umail=$row['Email'];
$umob =$row['Mobile'];


unset($_SESSION['tid']);
unset($_SESSION['class']);
unset($_SESSION['src']);
unset($_SESSION['dest']);
unset($_SESSION['doj']);
unset($_SESSION['dist']);
unset($_SESSION['passdet']);
unset($_SESSION['adult']);
unset($_SESSION['child']);




?>



<!DOCTYPE html>

<html>

	<head>
		<link rel="icon" type="image/png" href="Images\Logo1.png">
		<title>Wasteland Tracks</title>
		<?php include "Includes/link.html"?>
	</head>

	
<body class="ticket-main">

<div class="container-fluid">
<div class="row">
<div class=" col-xs-12">
<div class="ticket-body">

<div class='row'>
<div class="col-xs-3"><img src="Images\Logo2.png" class="img-responsive center-block" alt="Wasteland Tracks" width="100px" style="margin-top:-20px;"></div>
<div class="col-xs-6"><h1>WASTLELAND TRACKS</h1></div>
<div class="col-xs-3"><img src="Images\Side.png" class="img-responsive center-block" alt="Wasteland Tracks" width="100px" style="margin-top:-20px;"></div>
</div>

<div class='table-responsive'>
<table class='table' >
	<thead>
		<tr>
		<th colspan='3' style="background: #3B5998; color:#000; font-size:20px;">JOURNEY DETAILS</th>
		</tr>
	</thead>
	<tbody style="background:#555; color:#000;">
		<tr>
		<td><span style="font-weight: bold;">PNR : </span><?php echo $pnr;?></td>
		<td><span style="font-weight: bold;">Class : </span><?php echo $class;?></td>
		<td><span style="font-weight: bold;">Journey Date : </span><?php echo $doj;?> (<?php echo $day;?>)</td>
		</tr>
		<tr>
		<td><span style="font-weight: bold;">Train No. : </span><?php echo $tid;?></td>
		<td><span style="font-weight: bold;">Train Name : </span><?php echo $train;?></td>
		<td><span style="font-weight: bold;">Train Type : </span><?php echo $type;?></td>
		</tr>
		<tr>
		<td><span style="font-weight: bold;">From Station : </span><?php echo $source;?></td>
		<td><span style="font-weight: bold;">To Station : </span><?php echo $destination;?></td>
		<td><span style="font-weight: bold;">Adult :</span><?php echo $adult;?> <span style="font-weight: bold;">/ Child :</span><?php echo $child;?></td>
		</tr>
		<tr>
		<td><span style="font-weight: bold;">Boarding Station : </span><?php echo $from;?></td>
		<td><span style="font-weight: bold;">Reservation upto : </span><?php echo $to;?></td>
		<td><span style="font-weight: bold;">Distance : </span><?php echo $dist;?> KMs</td>
		</tr>
		<tr>
		<td><span style="font-weight: bold;">Scheduled Departure : </span><?php echo $departure;?> (<?php echo $deptday;?>)</td>
		<td><span style="font-weight: bold;">Scheduled Arrival : </span><?php echo $arrival;?> (<?php echo $arrday;?>)</td>
		<td><span style="font-weight: bold;">Total Fare : </span><?php echo $fare;?> (INR)</td>
		</tr>
		<tr>
		<td><span style="font-weight: bold;">Status : </span><?php echo $status;?></td>
		<td colspan='2'><span style="font-weight: bold;">Booking Date : </span><?php echo $dobk;?></td>
		</tr>
	</tbody>
</table>
</div>

<div class='table-responsive'>
<table class='table' >
	<thead style="background: #3B5998; color:#000;">
		<tr>
		<th colspan='5' style="font-size:20px;">PASSENGERS DETAILS</th>
		</tr>
		<tr>
		<th style="text-align:center">NAME</th>
		<th style="text-align:center">AGE</th>
		<th style="text-align:center">GENDER</th>
		<th style="text-align:center">SEAT</th>
		<th style="text-align:center">BERTH</th>
		</tr>
	</thead>
	<tbody style="background:#555; color:#000; text-align:center;">
		<tr>
		<td><?php echo $name1;?></td>
		<td><?php echo $age1;?></td>
		<td><?php echo $gender1;?></td>
		<td><?php echo $sno1;?></td>
		<td><?php echo $ber1;?></td>
		</tr>
		<tr>
		<td><?php echo $name2;?></td>
		<td><?php echo $age2;?></td>
		<td><?php echo $gender2;?></td>
		<td><?php echo $sno2;?></td>
		<td><?php echo $ber2;?></td>
		</tr>
		<tr>
		<td><?php echo $name3;?></td>
		<td><?php echo $age3;?></td>
		<td><?php echo $gender3;?></td>
		<td><?php echo $sno3;?></td>
		<td><?php echo $ber3;?></td>
		</tr>
	</tbody>
</table>
</div>

<div class='table-responsive'>
<table class='table' >
	<thead>
		<tr>
		<th colspan='4' style="background: #3B5998; color:#000; font-size:20px;">AGENT DETAILS</th>
		</tr>
	</thead>
	<tbody style="background:#555; color:#000;">
		<tr>
		<td><span style="font-weight: bold;">User ID : </span><?php echo $user;?></td>
		<td><span style="font-weight: bold;">Name : </span><?php echo $uname;?></td>
		<td><span style="font-weight: bold;">Email : </span><?php echo $umail;?></td>
		<td><span style="font-weight: bold;">Mobile : </span><?php echo $umob;?></td>
		</tr>
	</tbody>
</table>
</div>

</div>
<div style="text-align:center; margin-bottom:50px;">
<h4>Contact us on : 24*7 Hrs. Customer Support at : 011-39340000 or Mail us at : <a href="www.gmail.com" target="_blank">wastelandtracks@gmail.com</a></h4>
<h4>We wish you a very happy journey.</br> Thanks for using Wasteland Services</h4>
<button class="btn btn-primary " title="print" onclick="window.print();"target="_blank" style="cursor:pointer;"><i class="fa fa-print"> Print ERS</i></button>
<button class="btn btn-danger " onclick="window.open('user.php','_self')" >Back</button>

</div>

</div>
</div>
</div>

</body>
</html>
