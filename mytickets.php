<?php
session_start();
include('connection.php');
if ($_SESSION['logged']!=1)
{
	echo"<script>alert('Invalid access! Please login.')</script>";
	echo"<script>window.open('index.php','_self')</script>";
}

?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{

			$pnr = $name = test_input($_POST["pnr"]);
			

			$query="select *from p_ticket where PNR=$pnr;";
			$result=mysqli_query($db,$query);
			$row = mysqli_fetch_array($result);
			
			if (mysqli_num_rows($result)==0)
			{
				echo"<script>alert('Invalid PNR')</script>";
				echo"<script>window.open('user.php','_self')</script>";
			}
			
			else
			{
			$tid=$row['t_id'];
			$src=$row['src_id'];
			$dest=$row['dest_id'];
			$class=$row['class'];
			$doj=$row['journey_date'];
			$adult=$row['Adult'];
			$child=$row['Child'];
			$status=$row['res_status'];
			$day = date('l', strtotime($doj));
			$dobk=$row['DoBk'];
			$fare=$row['Fare'];
			$dist=$row['Distance'];
			
			$query="select * from train where t_id=$tid;";
			$result=mysqli_query($db,$query);
			$row = mysqli_fetch_array($result);
			
			$train=$row['t_name'];
			$source = $row['src_id'];
			$destination = $row['dest_id'];
			$type = $row['t_type'];
		
		
			$query="select r1.depart_time ,r2.arrive_time,r1.avail_day as deptday, r2.avail_day as arrday
			from route r1,route r2 where r1.station_id='$src' and r2.station_id='$dest' and r1.t_id=r2.t_id and r1.t_id='$tid'
			and r1.avail_day='$day'and r1.stop_number<r2.stop_number;";
			
			$result=mysqli_query($db,$query);
			$row = mysqli_fetch_array($result);
			$deptday=$row['deptday'];
			$arrday=$row['arrday'];
			$departure=$row['depart_time'];
			$arrival=$row['arrive_time'];
			
			
			$query="select s_name from station where s_id = '$src'";
			$result=mysqli_query($db,$query);
			$row = mysqli_fetch_array($result);
			$from=$row['s_name'];
			
			$query="select s_name from station where s_id = '$dest'";
			$result=mysqli_query($db,$query);
			$row = mysqli_fetch_array($result);
			$to=$row['s_name'];
			
			$query="select s_name from station where s_id = '$source'";
			$result=mysqli_query($db,$query);
			$row = mysqli_fetch_array($result);
			$source=$row['s_name'];
			
			$query="select s_name from station where s_id = '$destination'";
			$result=mysqli_query($db,$query);
			$row = mysqli_fetch_array($result);
			$destination=$row['s_name'];
			
			
			

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
		<td ><span style="font-weight: bold;">Status : </span><?php echo $status;?></td>
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
<h4>Contact us on : 24*7 Hrs. Customer Support at : 8824914416 or Mail us at : <a href="www.gmail.com" target="_blank">wastelandtracks@gmail.com</a></h4>
<h4>We wish you a very happy journey.</br> Thanks for using Wasteland Services</h4>
<button class="btn btn-primary " title="print" onclick="window.print();"target="_blank" style="cursor:pointer;"><i class="fa fa-print"> Print ERS</i></button>
<button class="btn btn-danger " onclick="window.open('user.php','_self')" >Back</button>

</div>

</div>
</div>
</div>

</body>
</html>
