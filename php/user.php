<?php
session_start();
include('connection.php');
$_SESSION['success']=0;
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
		<script type="text/javascript">
			function show(shown, hid1, hid2, hid3) 
				{
					document.getElementById(shown).style.display='block';
					document.getElementById(hid1).style.display='none';
					document.getElementById(hid2).style.display='none';
					document.getElementById(hid3).style.display='none';
					return false;
			  }
			  
		</script>
	</head>
	
	
	
	

	<body class="user-main">
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
			<div class="dropdown">
			  <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" style="color:#1DA1F2; font-size:30px;"></i></a>
			  <ul class="dropdown-menu">
				<li><a href="profile.php">My Profile</a></li>
				<li><a href="#" onclick="return show('Page2','Page1','Page3','Page4');">Book Now</a></li>
				<li><a href="mybookings.php">My bookings</a></li>
				<li><a href="#" onclick="return show('Page3','Page1','Page2','Page4');">PNR enquiry</a></li>
				<li><a href="#" onclick="return show('Page4','Page1','Page2','Page3');">Cancel Ticket</a></li>
				<li><a href="logout.php">Sign Out</a></li>
			  </ul>
			</div>
			</div>
		</div>
		</div>

		</div>
		<!--END OF NAVIGATION BAR-->
		
		<div class="row">
		<div class="col-xs-12">
				<div class="row" id="Page1">
				<div class="col-xs-offset-3 col-xs-6">
				<h1 style="font-size:70px; color:#000; text-align:center; margin: 250px 0px;">Welcome<br/><?php echo $_SESSION['uname'];?>!</h1>
				</div>
				</div>
				<div class="row" id="Page2" style="display:none;">
				<div class="col-xs-offset-2 col-xs-8">
					<!--NEW USER FORM-->
					<div class="user">
						<h1>New Booking</h1>
						<form class = "form-horizontal" action="trains.php" method="post">
							<?php
							   $query="select * from station;";
							   $result=mysqli_query($db,$query);
							?>
							<div class="form-group">
							<label for="source" class="control-label col-xs-4">Source</label>
							<div class="col-xs-8">
							<select id="source" name="src"  class="form-control" required>
								<option value="">Select</option>
                                 <?php while($row=mysqli_fetch_array($result)):;?>							
								<option value="<?php echo $row['s_id'];?>"><?php echo $row['s_name'];?></option>
                                 <?php endwhile ;?>							
							</select>
							</div>
							</div>
							<?php
							   $query="select * from station;";
							   $result=mysqli_query($db,$query);
							?>

							<div class="form-group">
							<label for="destination" class="control-label col-xs-4">Destination</label>
							<div class="col-xs-8">
							<select id="destination" name="dest"  class="form-control" required>
								<option value="">Select</option>
                                 <?php while($row=mysqli_fetch_array($result)):;?>							
								<option value="<?php echo $row['s_id'];?>"><?php echo $row['s_name'];?></option>
                                 <?php endwhile ;?>								
							</select>
							</div>
							</div>


							<div class="form-group">
							<label for="doj" class="control-label col-xs-4">Journey Date</label>
							<div class="col-xs-8">
							<input type="date" class="form-control" name="doj" required>
							</div>
							</div>
							
							
							<div class="form-group">
							<div class="col-xs-offset-4 col-xs-8">
							<label><input type="checkbox" name="flex" /> Flexible with date</label>
							</div>
							</div>

							<div class="form-group">
							<div class="col-xs-offset-1 col-xs-10">
							<button class= "btn btn-primary btn-block" type ="submit" name="next">Next</button>
							<button class="btn btn-danger btn-block" type="reset">Reset</button>
							</div>
							</div>

						</form>
					</div>
				</div>
				</div>
				
				
				
				<div class="row" id="Page3" style="display:none;">
				<div class="col-xs-offset-2 col-xs-8">
					<div class="enquiry">
						<h1>PNR Enquiry</h1>
						<form class = "form-horizontal" action="mytickets.php" method='POST'>

							<div class="form-group">
							<label for="pnr" class="control-label col-xs-4">Enter PNR</label>
							<div class="col-xs-8">
							<input type="number" class="form-control" placeholder="PNR No." name="pnr" required>
							</div>
							</div>
							
							<div class="form-group">
							<div class="col-xs-offset-4 col-xs-8">
							<button class= "btn btn-primary " type ="submit" name="next">Get PNR Status</button>
							</div>
							</div>
				
						</form>
					</div>
				</div>
				</div>
				
				
				
				<div class="row" id="Page4" style="display:none;">
				<div class="col-xs-offset-2 col-xs-8">
					<div class="enquiry">
						<h1>Cancellation</h1>
						<form class = "form-horizontal" action="cancel.php" method="post">

							<div class="form-group">
							<label for="cancelpnr" class="control-label col-xs-4">Enter PNR</label>
							<div class="col-xs-8">
							<input type="number" class="form-control" placeholder="PNR No." name="cancelpnr" required>
							</div>
							</div>
							<div class="form-group">
							<div class="col-xs-offset-4 col-xs-8">
							<button class= "btn btn-primary" type ="submit" name="next">Submit</button>
							</div>
							</div>
				
						</form>
					</div>
				</div>
				</div>
	
	
	
		</div>
		</div>
	
	
	
	
	
	
	
	</div>
	</body>
</html>