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
			$flag=0;
			$pnr = test_input($_POST["cancelpnr"]);
			$user=$_SESSION['uname'];
			$berth = array("SIDE-UPPER","LOWER", "MIDDLE","UPPER","LOWER", "MIDDLE","UPPER","SIDE-LOWER");

			$query="select *from p_ticket where PNR=$pnr and User='$user';";
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
			$today = date("Y-m-d");
			$day = date('l', strtotime($doj));
			$dobk= $row['DoBk'];
			$dist=$row['Distance'];
			$fare=$row['Fare'];
			
			
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
			
			
			$today = date("Y-m-d");
			$diff = date_diff(date_create($dobk), date_create($today));
			$fee= 20+10*($diff->format('%d'));
			$leftamt=$fare-$fee;
			
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

			$query="select * from user where User = '$user'";
			$result=mysqli_query($db,$query);
			$row = mysqli_fetch_array($result);

			$uname=$row['Name'];
			$umail=$row['Email'];
			$umob =$row['Mobile'];
			
			
			$query="SELECT * from t_status where t_id='$tid' and Date='$doj'";
			$result=mysqli_query($db,$query);
			$row = mysqli_fetch_array($result);
			if($class=='SLEEPER') 
			{
				$wait=$row['wait_seat_c1'];
				$avail=$row['avail_seat_c1'];
				$booked=$row['booked_seat_c1'];
			}
			elseif($class=='AC-TIER1') 
			{
				$wait=$row['wait_seat_c2'];
				$avail=$row['avail_seat_c2'];
				$booked=$row['booked_seat_c2'];
			}
			elseif($class=='AC-TIER2') 
			{
				$wait=$row['wait_seat_c3'];
				$avail=$row['avail_seat_c3'];
				$booked=$row['booked_seat_c3'];
			}
			if($status=='CONFIRMED')
			{
			$query="SELECT * from passenger where PNR in (SELECT PNR from p_ticket where t_id='$tid' and journey_date='$doj' and res_status='CONFIRMED' and class='$class');";
			$result=mysqli_query($db,$query);
			$change=$sno1+$adult-1;
			while($row = mysqli_fetch_assoc($result))
			{
				if($row['Seat1']>$change)
				{
					$temp=$row['Seat1'];
					$temp-=$adult;
					$ber1=$berth[$temp%8];
					$up = "UPDATE passenger SET Seat1=$temp, Berth1='$ber1' where PNR = {$row['PNR']}";
					mysqli_query($db,$up);
				}
				if($row['Seat2']>$change)
				{
					$temp=$row['Seat2'];
					$temp-=$adult;
					$ber1=$berth[$temp%8];
					$up="UPDATE passenger SET Seat2=$temp, Berth2='$ber1' where PNR={$row['PNR']}";
					mysqli_query($db,$up);
				}
				if($row['Seat3']>$change)
				{
					$temp=$row['Seat3'];
					$temp-=$adult;
					$ber1=$berth[$temp%8];
					$up="UPDATE passenger SET Seat3=$temp, Berth3='$ber1' where PNR={$row['PNR']}";
					mysqli_query($db,$up);
				}
			}
			$total=$booked+$avail;
			$avail+=$adult;
			$booked-=$adult;
			
			if($class=='SLEEPER') $up="UPDATE t_status SET avail_seat_c1=$avail, booked_seat_c1=$booked where t_id='$tid' and Date='$doj'";
			elseif($class=='AC-TIER1') $up="UPDATE t_status SET avail_seat_c2=$avail, booked_seat_c2=$booked where t_id='$tid' and Date='$doj'";
			elseif($class=='AC-TIER2') $up="UPDATE t_status SET avail_seat_c3=$avail, booked_seat_c3=$booked where t_id='$tid' and Date='$doj'";
			if(!mysqli_query($db,$up)) $flag=1;

			
			if($wait)
			{
				
				$query="SELECT * from passenger where PNR in (SELECT PNR from p_ticket where t_id='$tid' and journey_date='$doj' and res_status='WAITING' and class='$class' and Adult<=$avail)";
				$result=mysqli_query($db,$query);
				while($row = mysqli_fetch_assoc($result))
				{
					$query1="SELECT Adult from p_ticket where PNR={$row['PNR']}";
					$result1=mysqli_query($db,$query1);
					$row1=mysqli_fetch_array($result1);
					
					
					if($avail>=$row1['Adult'])
					{
						if($row1['Adult']==1)
						{
								$sno1=$booked+1;							
								$ber1=$berth[$sno1%8];
								$up="UPDATE passenger SET Seat1=$sno1, Berth1='$ber1' where PNR={$row['PNR']}";

						}
						elseif($row1['Adult']==2)
						{
								$sno1=$booked+1;
								$sno2=$booked+2;
								$ber1=$berth[$sno1%8];
								$ber2=$berth[$sno2%8];
								$up="UPDATE passenger SET Seat1=$sno1, Berth1='$ber1', Seat2=$sno2, Berth2='$ber2' where PNR={$row['PNR']}";
								
								
						}
						elseif($adult==3)
						{
								$sno1=$booked+1;
								$sno2=$booked+2;
								$sno3=$booked+3;
								$ber1=$berth[$sno1%8];
								$ber2=$berth[$sno2%8];
								$ber3=$berth[$sno3%8];
								$up="UPDATE passenger SET Seat1=$sno1, Berth1='$ber1',Seat2=$sno2, Berth2='$ber2',Seat3=$sno3, Berth3='$ber3' where PNR={$row['PNR']}";
								
						}
						
						if(!mysqli_query($db,$up)) $flag=1;
						
						$booked+=$row1['Adult'];
						$avail-=$row1['Adult'];
						$wait-=$row1['Adult'];
						if($class=='SLEEPER') $up="UPDATE t_status SET avail_seat_c1=$avail, wait_seat_c1=$wait, booked_seat_c1=$booked where t_id='$tid' and Date='$doj'";
						elseif($class=='AC-TIER1') $up="UPDATE t_status SET avail_seat_c2=$avail, wait_seat_c2=$wait, booked_seat_c2=$booked where t_id='$tid' and Date='$doj'";
						elseif($class=='AC-TIER2') $up="UPDATE t_status SET avail_seat_c3=$avail, wait_seat_c3=$wait, booked_seat_c3=$booked where t_id='$tid' and Date='$doj'";
						if(!mysqli_query($db,$up)) $flag=1;
						
						
						$up="UPDATE p_ticket SET res_status='CONFIRMED' where PNR={$row['PNR']}";
						if(!mysqli_query($db,$up)) echo mysqli_error($db);
						
					}
					
					
				}
				
			}
			}
			else
			{
				$wait-=$adult;
				if($class=='SLEEPER') $up="UPDATE t_status SET wait_seat_c1=$wait where t_id='$tid' and Date='$doj'";
				elseif($class=='AC-TIER1') $up="UPDATE t_status SET wait_seat_c2=$wait where t_id='$tid' and Date='$doj'";
				elseif($class=='AC-TIER2') $up="UPDATE t_status SET wait_seat_c3=$wait where t_id='$tid' and Date='$doj'";
				if(!mysqli_query($db,$up)) $flag=1;
			}
			
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
			
			
			$query="DELETE from p_ticket where PNR = $pnr";
			if(!mysqli_query($db,$query)) echo mysqli_error($db);
			
			$result=mysqli_query($db,"select Balance from user where User='$user';");
			$row=mysqli_fetch_array($result);
			$bal=$row['Balance']+$leftamt;
			mysqli_query($db,"update user set Balance=$bal where User='$user';");
			$status='CANCELLED';
			
			

					
				
				
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
		<td ><span style="font-weight: bold;">Booking Date : </span><?php echo $dobk;?></td>
		<td ><span style="font-weight: bold;">Cancellation Date : </span><?php echo $today;?></td>
		</tr>
	</tbody>
</table>
</div>


<div class='table-responsive'>
<table class='table' >
	<thead>
		<tr>
		<th colspan='3' style="background: #3B5998; color:#000; font-size:20px;">FARE DETAILS</th>
		</tr>
	</thead>
	<tbody style="background:#555; color:#000;">
		<tr><td><span style="font-weight: bold;">Total Collected Fare : </span><?php echo $fare;?> (INR)</td></tr>
		<tr><td ><span style="font-weight: bold;">Cancellation Fee : </span><?php echo $fee;?> (INR) </td></tr>
		<tr><td colspan='2'><span style="font-weight: bold;">Total Refund Amount : </span><?php echo $leftamt;?> (INR)</td></tr>
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
<button class="btn btn-primary " title="print" onclick="window.print();"target="_blank" style="cursor:pointer;">Print</button>
<button class="btn btn-danger " onclick="window.open('user.php','_self')" >Back</button>

</div>

</div>
</div>
</div>

</body>
</html>
