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
		<form class = "form-horizontal" action="routeval.php" method="POST">
		
		<div class='table-responsive'>
		<table class='table' style="margin-top:20px;">
			<thead>
				<tr>
				<th colspan="6" style="background: #111; color:#eee; font-size:30px; text-align:center;">ROUTE</th>
				</tr>
				<tr>
				<th style="background: #111; color:#eee; font-size:20px; text-align:center; ">STOP NO.</th>
				<th style="background: #111; color:#eee; font-size:20px; text-align:center;  ">STATION</th>
				<th style="background: #111; color:#eee; font-size:20px; text-align:center;  ">DAY</th>
				<th style="background: #111; color:#eee; font-size:20px; text-align:center; ">ARRIVAL</th>
				<th style="background: #111; color:#eee; font-size:20px; text-align:center; ">DEPARTURE</th>
				<th style="background: #111; color:#eee; font-size:20px; text-align:center; ">DIST.(in KMs)</th>
				</tr>
				
			</thead>
			
			<tbody style="background:#555; color:#000;">

			<tr>
			<td><label class="control-label">1. (SRC)</label></td>
			<td><fieldset disabled><input type="text" class="form-control"  name= "stn1" value='<?php echo $_SESSION['atrain'][3];?>' required /></fieldset></td>
			<td>
			<select  name= "day1" class="form-control">
				<option value="">Select</option>
                <option value="Sunday">Sunday</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
				<option value="Wednesday">Wednesday</option>
				<option value="Thursday">Thursday</option>
				<option value="Friday">Friday</option>
				<option value="Saturday">Saturday</option>								
			</select>
			</td>
			<td><fieldset disabled><input type="time" class="form-control"  name= "atime1" /></fieldset></td>
			<td><input type="time" class="form-control"  name= "dtime1" required /></td>
			<td><fieldset disabled><input type="number" step="any" class="form-control" name= "sdist1" value="0" required /></fieldset></td>
			</tr>
			
			<?php
			
			$snumber=$_SESSION['atrain'][11];
			for( $i = 2; $i<$snumber; $i++ )
			{
				$query="select * from station;";
			    $result=mysqli_query($db,$query);
				echo'<tr>';
				echo '<td><label class="control-label">'.$i.'.</label></td>';
				
				echo'<td><select name="stn'.$i.'" class="form-control"><option value="">Select</option>';
                while($row=mysqli_fetch_array($result)):;							
				echo'<option value='.$row['s_id'].'>'.$row['s_name']."(".$row['s_id'].")".'</option>';
                endwhile ;								
				echo '</select></td>';
				
				echo'<td><select  name= "day'.$i.'" class="form-control">
                                 <option value="">Select</option>
                                 <option value="Sunday">Sunday</option>
                                 <option value="Monday">Monday</option>
                                 <option value="Tuesday">Tuesday</option>
						         <option value="Wednesday">Wednesday</option>
						         <option value="Thursday">Thursday</option>
						         <option value="Friday">Friday</option>
						         <option value="Saturday">Saturday</option>								
					</select></td>';
				
				echo'<td><input type="time" class="form-control"  name= "atime'.$i.'" required /></td>';
				
				echo'<td><input type="time" class="form-control"  name= "dtime'.$i.'" required /></td>';
				
				echo'<td><input type="number" step="any" class="form-control" name= "sdist'.$i.'" placeholder="Distance(in KMs)" required /></td>';	
				echo'</tr>';
			}
			
			?>
			
			<tr>
			<td><label class="control-label"><?php echo $i;?>. (DEST)</label></td>
			<td><fieldset disabled><input type="text" class="form-control"  name= "stn<?php echo $i;?>" value='<?php echo $_SESSION['atrain'][4];?>' required /></fieldset></td>
			<td>
			<select  name= "day<?php echo $i;?>" class="form-control">
				<option value="">Select</option>
                <option value="Sunday">Sunday</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
				<option value="Wednesday">Wednesday</option>
				<option value="Thursday">Thursday</option>
				<option value="Friday">Friday</option>
				<option value="Saturday">Saturday</option>								
			</select>
			</td>
			<td><input type="time" class="form-control"  name= "atime<?php echo $i;?>" required /></td>
			<td><fieldset disabled><input type="time" class="form-control"  name= "dtime<?php echo $i;?>" /></fieldset></td>
			<td><input type="number" step="any" class="form-control" name= "sdist<?php echo $i;?>" placeholder="Distance(in KMs)" required /></td>
			</tr>
			
			</tbody>
			
		</table>
		</div>
		
		<button class= "btn btn-primary btn-block" type ="submit" name="add1" style="text-align:center; margin-bottom:20px;">SUBMIT</button>
		
		
		</form>
		</div>
		
		
		
		
		
		
		
		</div>	
		</div>
		
		
		
		
		
		
		
		
		
		
	</div>
	</body>
</html>