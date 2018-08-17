<?php
session_start();
include('connection.php');
if ($_SESSION['alogged']!=1)
{
	echo"<script>alert('Invalid access! Please login.')</script>";
	echo"<script>window.open('index.php','_self')</script>";
}
include('trainval.php');
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


		<!--NAVIGATION BAR-->
		<div class="row topnav">

		<div class = "col-xs-3">
		<div class ="row">
			<div class="col-xs-3">
				<a href="admin.php"><img src="Images\Logo.png" class="img-responsive" alt="Wasteland Tracks" width="100px" style="margin-top:-20px;"></a>
			</div>
		</div>
		</div>

		<div class="col-xs-9">
		<div class="row">
			<div class="col-xs-2">
				<a href="addtrain.php">Add Train</a>
			</div>

			<div class="col-xs-2">
				<a href="remtrain.php">Remove Train</a>
			</div>

			<div class="col-xs-2">
				<a href="addstat.php">Add Station</a>
			</div>
			
			<div class="col-xs-2">
			<a href="updtfare.php">Update Fare</a>
			</div>

			<div class="col-xs-2">
				<a href="userprofiles.php">User Profiles</a>
			</div>
			
			<div class="col-xs-2">
				<a href="logout.php" title="Log Out"><i class="fa fa-sign-out" style="color:#1DA1F2; font-size:30px;"></i></a>
			</div>
			
			
		</div>
		</div>

		</div>
		
		<!--END OF NAVIGATION-->
		
		
		<div class="row admin-main">
		<div class="col-xs-12">
		
		
		<div class=" col-xs-offset-1 col-xs-10">
		<form class = "form-horizontal" action="" method="POST">
		
		<div class='table-responsive'>
		<table class='table' style="margin-top:20px;">
			<thead>
				<tr>
				<th colspan="2" style="background: #111; color:#eee; font-size:30px; text-align:center;">TRAIN DETAILS</th>
				</tr>
				
			</thead>
			
			<tbody style="background:#555; color:#000;">
				
				<tr>
					<td><label for="tnumber" class="control-label">Train-Number<span style="color:red"> *</span></label></td>
					<td>
					<input type="text" class="form-control" placeholder="Train Number" name="tnumber" required value="<?php echo isset($_POST['tnumber']) ? $_POST['tnumber'] : '' ?>"/>
					<span class="error" style="color:red;"><?php echo $tnumbererr?></span>
					</td>
				</tr>
				<tr>
					<td><label for="tname" class="control-label">Train-Name<span style="color:red"> *</span></label></td>
					<td><input type="text" class="form-control" placeholder="Train Name" name="tname" required value="<?php echo isset($_POST['tname']) ? $_POST['tname'] : '' ?>"/></td>
				</tr>
				<tr>
					<td><label for="ttype" class="control-label">Train-type<span style="color:red"> *</span></label></td>
					<td>
					<select  name="ttype" tabindex="5" class="form-control" required >
								<option value="">Select</option>					
								<option value="EXPRESS">EXPRESS</option> 
								<option value="SUPERFAST">SUPERFAST</option> 
								<option value="LUXURY">LUXURY</option>
					</select>
					</td>
				</tr>
				
				<?php
				$query="select * from station;";
				$result=mysqli_query($db,$query);
				?>
				
				<tr>
					<td><label for="source" class="control-label">Source<span style="color:red"> *</span></label></td>
					<td>
					<select id="source" name="sid"  class="form-control" required>
								<option value="">Select</option>
                                 <?php while($row=mysqli_fetch_array($result)):;?>
								<option value="<?php echo $row['s_id'];?>"><?php echo $row['s_name']."(".$row['s_id'].")";?></option>
                                 <?php endwhile ;?>								
					</select>
					</td>
				</tr>
				
				<?php
				$query="select * from station;";
				$result=mysqli_query($db,$query);
				?>
				
				<tr>
					<td><label for="destination" class="control-label">Destination<span style="color:red"> *</span></label></td>
					<td>
					<select id="destination" name="did"  class="form-control" required>
								<option value="">Select</option>
                                 <?php while($row=mysqli_fetch_array($result)):;?>							
								<option value="<?php echo $row['s_id'];?>"><?php echo $row['s_name']."(".$row['s_id'].")";?></option>
                                 <?php endwhile ;?>								
					</select>
					<span class="error" style="color:red;"><?php echo $siderr?></span>
					</td>
				</tr>
				
				<tr>
					<td><label for="snumber" class="control-label">Number of stops<span style="color:red"> *</span></label></td>
					<td>
					<input type="number" class="form-control" placeholder="Number of Stops" name="snumber" required value="<?php echo isset($_POST['snumber']) ? $_POST['snumber'] : '' ?>"/>
					<span class="error" style="color:red;"><?php echo $snerror?></span>
					</td>
				
				</tr>
						
			</tbody>
		</table>
		</div>
		
		
		
		<div class='table-responsive'>
		<table class='table' style="margin-top:20px;">
			<thead>
				<tr>
				<th colspan="3" style="background: #111; color:#eee; font-size:30px; text-align:center;">SEATS & FARE DETAILS</th>
				</tr>
				<tr>
				<th style="background: #111; color:#eee; font-size:20px; ">CLASS</th>
				<th style="background: #111; color:#eee; font-size:20px; ">SEATS</th>
				<th style="background: #111; color:#eee; font-size:20px;">FARE(per KM)</th>
				</tr>
				
			</thead>
			
			<tbody style="background:#555; color:#000;">
				
				<tr>
					<td><label class="control-label">SLEEPER</label></td>
					<td><input type="number" class="form-control" placeholder="No. of seats" name="seat1"  value="<?php echo isset($_POST['seat1']) ? $_POST['seat1'] : '' ?>"/></td>
					<td><input type="number" step="any" class="form-control" placeholder="Fare" name="fair1"  value="<?php echo isset($_POST['fair1']) ? $_POST['fair1'] : '' ?>"/></td>
				
				</tr>
				<tr>
				<td> </td>
				<td colspan="2"><span class="error" style="color:red;"><?php echo $sicerr1?></span></td>
				</tr>
				
				<tr>
					<td><label class="control-label">AC-TIER1</label></td>
					<td><input type="number" class="form-control" placeholder="No. of seats" name="seat2" value="<?php echo isset($_POST['seat2']) ? $_POST['seat2'] : '' ?>"/></td>
					<td><input type="number" step="any" class="form-control" placeholder="Fare" name="fair2"  value="<?php echo isset($_POST['fair2']) ? $_POST['fair2'] : '' ?>"/></td>

				<tr>
				<td> </td>
				<td colspan="2"><span class="error" style="color:red;"><?php echo $sicerr2?></span></td>
				</tr>
				
				<tr>
					<td><label class="control-label">AC-TIER2</label></td>
					<td><input type="number" class="form-control" placeholder="No. of seats" name="seat3"  value="<?php echo isset($_POST['seat3']) ? $_POST['seat3'] : '' ?>"/></td>
					<td><input type="number" step="any"class="form-control" placeholder="Fare" name="fair3"  value="<?php echo isset($_POST['fair3']) ? $_POST['fair3'] : '' ?>"/></td>

				<tr>
				<td> </td>
				<td colspan="2"><span class="error" style="color:red;"><?php echo $sicerr3?></span></td>
				</tr>
				
				<tr>
				<td colspan="3"><span class="error" style="color:red;"><?php echo $sicerr4?></span></td>
				</tr>
								
			</tbody>
		</table>
		</div>
		
		
		<div class="col-xs-offset-1 col-xs-10" style="margin-top:10px;">
		<button class= "btn btn-primary btn-block" type ="submit" name="nxt3">NEXT</button>
		</div>
		<div class="col-xs-offset-1 col-xs-10" style="margin-top:10px;">
		<button class="btn btn-warning btn-block" type="reset">RESET</button>
		</div>
		<div class="col-xs-offset-1 col-xs-10" style="margin-top:10px;" >
		<button class= "btn btn-danger btn-block" type ="button" name="cancel" value="cancel" onClick="window.location='admin.php';">CANCEL</button>
		</div>
		
		
		</form>
		</div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		</div>	
		</div>
		
		
		
		
		
		
		
		
		
		
	</div>
	</body>
</html>