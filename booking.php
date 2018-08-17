<?php
session_start();
include('connection.php');
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
		<title>Wasteland Tracks</title>
		<?php include "Includes/link.html"?>
	</head>
	<script>
			function chcolf(chid1,chid2,chid3,chid4) 
				{
					document.getElementById(chid1).style.background='#111';
					document.getElementById(chid2).style.background='#444';
					document.getElementById(chid3).style.background='#444';
					document.getElementById(chid4).style.background='#444';
					return true;
			  }
			function chcolr(chid1,chid2,chid3,chid4) 
				{
					document.getElementById(chid1).style.background='#444';
					document.getElementById(chid2).style.background='#444';
					document.getElementById(chid3).style.background='#444';
					document.getElementById(chid4).style.background='#444';
					return true;
			  }
	</script>

	
	
	
	
	<body class="book-main">
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
			  <a href="user.php" title = "Home" ><i class="fa fa-home" style="color:#1DA1F2; font-size:30px;"></i></a>
			</div>
			</div>
		</div>
		</div>

		</div>
		<!--END OF NAVIGATION BAR-->
		<?php
		$err1=$err2=$err3=$err4='';
		$flag=0;
		$child=0;
		$adult=1;
		  if ($_SERVER["REQUEST_METHOD"] == "POST")
		  {
			  
			  if(isset($_POST['book']))
			  {
				  
				  $tid=$_SESSION['tid'];
				  $train=$_SESSION['train'];
				  $class=$_SESSION['class'];
				  $source=$_SESSION['source'];
				  $from=$_SESSION['from'];
				  $to=$_SESSION['to']; 
				  $destination=$_SESSION['destination'];
				  $type=$_SESSION['type'];
				  $fare=$_SESSION['fare'];
				  $dist=$_SESSION['dist'];
				  $doj=$_SESSION['doj'];
				  
				  $_SESSION['passdet']=array($_POST['name1'],$_POST['age1'],$_POST['gender1'],$_POST['name2'],$_POST['age2'],$_POST['gender2'],$_POST['name3'],$_POST['age3'],$_POST['gender3']);
				  
				  if($_POST['name2'] or $_POST['age2'] or $_POST['gender2'])
				  {
					  if(!($_POST['name2'] and $_POST['age2'] and $_POST['gender2']))
					  {
						  $err1="* Please fill in the details";
						  $flag=1;
					  }
					  else $adult+=1;
				  }
				  if($_POST['name3'] or $_POST['age3'] or $_POST['gender3'])
				  {
					  if(!($_POST['name3'] and $_POST['age3'] and $_POST['gender3']))
					  {
						  $err2="* Please fill in the details";
						  $flag=1;
					  }
					  else $adult+=1;
				  }
				  if($_POST['chname1'] or $_POST['chage1'] or $_POST['chgender1'])
				  {
					  if(!($_POST['chname1'] and $_POST['chage1'] and $_POST['chgender1']))
					  {
						  $err3="* Please fill in the details";
						  $flag=1;
					  }
					  else $child+=1;
				  }
				  if($_POST['chname2'] or $_POST['chage2'] or $_POST['chgender2'])
				  {
					  if(!($_POST['chname2'] and $_POST['chage2'] and $_POST['chgender2']))
					  {
						  $err4="* Please fill in the details";
						  $flag=1;
					  }
					  else $child+=1;
				  }
				  if($_POST['payment']!='Wallet')
					{
						echo "<script>alert('The payment mode, you have selected is unavailable for now ! We regret the inconvenience caused. Switching to Wallet Payment.')</script>";
					}
				  
				  if($flag==0)
				  {
					  $_SESSION['child']=$child;
					  $_SESSION['adult']=$adult;
						echo"<script>window.open('ticket.php','_self')</script>";					  
				  }
				  
				  
				  
			  }
			  if(isset($_POST['fare1']) or isset($_POST['fare2']) or isset($_POST['fare3']))
			  {
				  $class='';
				  $tid= $_POST['tid'];
				  $dist= $_POST['dist'];
				  if (isset($_POST['fare1'])) {$class='SLEEPER'; $fare=$_POST['fare1'];}
				  elseif (isset($_POST['fare2'])) {$class='AC-TIER1'; $fare=$_POST['fare2'];}
				  else {$class='AC-TIER2'; $fare=$_POST['fare3'];}
				  $src=$_SESSION['src'];
				  $dest=$_SESSION['dest'];
				  $doj=$_SESSION['doj'];
				  $query="SELECT * from train where t_id='$tid';";
				  $run=mysqli_query($db,$query);
				  $row = mysqli_fetch_assoc($run);
				  $train=$row['t_name'];
				  $source=$row['src_id'];
				  $destination=$row['dest_id'];
				  $type=$row['t_type'];
				  $query="SELECT * FROM station where s_id='$source' or s_id='$destination'";
				  $run=mysqli_query($db,$query);
				  while($row = mysqli_fetch_assoc($run))
				  {
					  if($row['s_id']==$source)
						  $source=$row['s_name'];
					  else
						  $destination=$row['s_name'];
				  }
				  $query="SELECT * FROM station where s_id='$src' or s_id='$dest'";
				  $run=mysqli_query($db,$query);
				  while($row = mysqli_fetch_assoc($run))
				  {
					  if($row['s_id']==$src)
						  $from=$row['s_name'];
					  else
						  $to=$row['s_name'];
				  }
				  
				  $_SESSION['tid']=$tid;
				  $_SESSION['train']=$train;
				  $_SESSION['class']=$class;
				  $_SESSION['source']=$source;
				  $_SESSION['from']=$from;
				  $_SESSION['to']=$to; 
				  $_SESSION['destination']=$destination;
				  $_SESSION['type']=$type;
				  $_SESSION['fare']=$fare;
				  $_SESSION['dist']=$dist;
				  }
		  }
		  else
		  {
			  echo"<script>window.open('user.php','_self')</script>";
		  }
		  
		?>
		
		<div class="row ">
		<div class="col-xs-12">
		
				<div class="row" id="Page1">
				<div class="col-xs-offset-1 col-xs-10">
					<!--NEW USER FORM-->
					<div class="user">
						<h1>New Booking</h1>
						<form class = "form-horizontal" action="booking.php" method="post">
						<div class='table-responsive'>
						<table class='table table-condensed' >
						<thead>
						 <tr>
							<th colspan='3' style="background: #3B5998; color:#000; font-size:20px;">JOURNEY DETAILS</th>
						 </tr>
						</thead>
						<tbody style="background:#555; color:#000;">
						<tr>
							<td><span style="font-weight: bold;">Train No. : </span><?php echo $tid;?></td>
							<td><span style="font-weight: bold;">Train Name : </span><?php echo $train;?></td>
							<td><span style="font-weight: bold;">Train Type : </span><?php echo $type;?></td>
						</tr>
						<tr>
							<td><span style="font-weight: bold;">From Station : </span><?php echo $source;?></td>
							<td><span style="font-weight: bold;">To Station : </span><?php echo $destination;?></td>
							<td><span style="font-weight: bold;">Journey Date : </span><?php echo $doj;?></td>
						</tr>
						<tr>
							<td><span style="font-weight: bold;">Boarding Station : </span><?php echo $from;?></td>
							<td><span style="font-weight: bold;">Reservation upto : </span><?php echo $to;?></td>
							<td><span style="font-weight: bold;">Class : </span><?php echo $class;?></td>
						</tr>
						</tbody>
						</table>
						</div>
						
						
						
						<div class='table-responsive'>
						<table class='table table-condensed table-bordered' >
						<thead>
						 <tr>
							<th colspan='3' style="background: #3B5998; color:#000; font-size:20px;">PASSENGER DETAILS</th>
						 </tr>
						 <tr style="background:#444; color:#000; font-size:20px; ">
							<th style="text-align:center;">NAME</th>
							<th style="text-align:center;">AGE</th>
							<th style="text-align:center;">GENDER</th>
						 </tr>
						</thead>
						<tbody  style="background:#555;">
						<tr>
							<td><input type="text" class="form-control" name="name1" placeholder="Name" value="<?php echo isset($_POST['name1']) ? $_POST['name1'] : '' ?>" required></td>
							<td><input type="number" class="form-control" name="age1" placeholder="Age" value="<?php echo isset($_POST['age1']) ? $_POST['age1'] : '' ?>" required></td>
							<td><select  name="gender1" tabindex="3" class="form-control" required > 
								<option value="">Select</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select></td>
							
						</tr>
						<tr><td colspan="3"><span class="error" style="color:red;"></span></td></tr>
						<tr>
							<td><input type="text" class="form-control" name="name2" placeholder="Name" value="<?php echo isset($_POST['name2']) ? $_POST['name2'] : '' ?>"  ></td>
							<td><input type="number" class="form-control" name="age2" placeholder="Age" value="<?php echo isset($_POST['age2']) ? $_POST['age2'] : '' ?>"  ></td>
							<td><select  name="gender2" tabindex="3" class="form-control"  > 
								<option value="">Select</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select></td>
							
						</tr>
						<tr><td colspan="3"><span class="error" style="color:red;"><?php echo $err1;?></span></td></tr>
						<tr>
							<td><input type="text" class="form-control" name="name3" placeholder="Name" value="<?php echo isset($_POST['name3']) ? $_POST['name3'] : '' ?>"  ></td>
							<td><input type="number" class="form-control" name="age3" placeholder="Age" value="<?php echo isset($_POST['age3']) ? $_POST['age3'] : '' ?>"  ></td>
							<td><select  name="gender3" tabindex="3" class="form-control"  > 
								<option value="">Select</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select></td>
							
						</tr>
						<tr><td colspan="3"><span class="error" style="color:red;"><?php echo $err2;?></span></td></tr>
			
						<tr>
							<td><input type="text" class="form-control" name="name4" placeholder="Name" disabled /></td>
							<td><input type="number" class="form-control" name="age4" placeholder="Age" disabled /></td>
							<td><select  name="gender4" tabindex="3" class="form-control"  disabled> 
								<option value="">Select</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select></td>
						</tr>
							<tr><td colspan="3"><span class="error" style="color:red;"></span></td></tr>
						<tr>
							<td><input type="text" class="form-control" name="name5" placeholder="Name" disabled ></td>
							<td><input type="number" class="form-control" name="age5" placeholder="Age" disabled ></td>
							<td><select  name="gender5" tabindex="3" class="form-control" disabled > 
								<option value="">Select</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select></td>
						</tr>
							<tr><td colspan="3"><span class="error" style="color:red;"></span></td></tr>
						<tr>
							<td><input type="text" class="form-control" name="name6" placeholder="Name" disabled></td>
							<td><input type="number" class="form-control" name="age6" placeholder="Age" disabled></td>
							<td><select  name="gender6" tabindex="3" class="form-control" disabled > 
								<option value="">Select</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select></td>
						</tr>
						</tbody>
						</table>
						</div>
						
						<div class='table-responsive'>
						<table class='table table-condensed table-bordered' style="margin: 25px 0px;" >
						<thead>
						 <tr>
							<th colspan='3' style="background: #3B5998; color:#000; font-size:20px;">CHILDREN BELOW FIVE YEARS <span style="color:#333;"> (Tickets not to be issued)</span></th>
						 </tr>
						 <tr style="background:#444; color:#000; font-size:20px;">
							<th style="text-align:center;">NAME</th>
							<th style="text-align:center;">AGE</th>
							<th style="text-align:center;">GENDER</th>
						 </tr>
						</thead>
						<tbody style="background:#555;">
						<tr>
							<td><input type="text" class="form-control" name="chname1" placeholder="Name" value="<?php echo isset($_POST['chname1']) ? $_POST['chname1'] : '' ?>" ></td>
							<td><select  name="chage1" tabindex="6" class="form-control"> 
								<option value="">Select</option>
								<option value="5">Below one year</option>
								<option value="1">One year</option>
								<option value="2">Two years</option>
								<option value="3">Three years</option>
								<option value="4">Four years</option>
							</select></td>
							<td><select  name="chgender1" tabindex="3" class="form-control"> 
								<option value="">Select</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select></td>
						</tr>
						<tr><td colspan="3"><span class="error" style="color:red;"><?php echo $err3?></span></td></tr>
						<tr>
							<td><input type="text" class="form-control" name="chname2" placeholder="Name" value="<?php echo isset($_POST['chname2']) ? $_POST['name2'] : '' ?>" ></td>
							<td><select  name="chage2" tabindex="6" class="form-control" > 
								<option value="">Select</option>
								<option value="5">Below one year</option>
								<option value="1">One year</option>
								<option value="2">Two years</option>
								<option value="3">Three years</option>
								<option value="4">Four years</option>
							</select></td>
							<td><select  name="chgender2" tabindex="3" class="form-control" > 
								<option value="">Select</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select></td>
						</tr>
						<tr><td colspan="3"><span class="error" style="color:red;"><?php echo $err4?></span></td></tr>
									
						</tbody>
						</table>
						</div>
							<div class="table table-condensed">
							<div class="form-group">
							<div id="DC" class="col-xs-3" style="color:#fff; background:#444; text-align:center; padding-bottom:6px;">
							<label class="radio-inline"  for="debit"><i class="fa fa-cc-visa" style="color:#a38d7a; font-size:30px;"></i> Debit Card</label>
							<input type="radio" name="payment" onclick ="return chcolf('DC','CC','NB','WW');" id="debit" style="visibility:hidden;" required value="Debit" />
							</div>
							<div id="CC" class="col-xs-3" style="color:#fff; background:#444; text-align:center; padding-bottom:6px;">
							<label class="radio-inline"  for="credit"><i class="fa fa-credit-card" style="color:#f4b942; font-size:30px;" ></i> Credit Card</label>
							<input type="radio" name="payment" onclick ="return chcolf('CC','DC','NB','WW');" id="credit" style="visibility:hidden;" required value="Credit" />
							</div>
							<div id="NB" class="col-xs-3" style="color:#fff; background:#444; text-align:center; padding-bottom:6px;">
							<label class="radio-inline"  for="net"><i class="fa fa-cloud" style="color:#64a0ef; font-size:30px;"></i> Net-Banking</label>
							<input type="radio" name="payment" onclick ="return chcolf('NB','CC','DC','WW');" id="net" style="visibility:hidden;" required value="Net" />
							</div>
							<div id="WW" class="col-xs-3" style="color:#fff; background:#444; text-align:center; padding-bottom:6px;">
							<label class="radio-inline"  for="wallet"><i class="fa fa-won" style="color:#11dd93; font-size:30px;"></i> e-Wallet</label>
							<input type="radio" name="payment" onclick ="return chcolf('WW','DC','CC','NB');" id="wallet" style="visibility:hidden;" required value="Wallet" />
							</div>
							<span style="color:red;">* Due to internal issues, only e-Wallet mode is available for payments ! We regret the inconvenience caused.</span>
							</div>
							</div>

							<div class="form-group">
							<div class="col-xs-offset-1 col-xs-10" style="margin-top: 50px;">
							<button class= "btn btn-primary btn-block" type ="submit" name="book">Book Now</button>
							<button class="btn btn-danger btn-block" type="reset" onclick ="return chcolr('WW','CC','DC','NB');">Reset</button>
							</div>
							</div>

						</form>
					</div>
				</div>
				</div>
				
				
				
				<div class="row" id="Page2" style="display:none;">
				<div class="col-xs-offset-2 col-xs-8">
					<div class="enquiry">
						<h1>PNR Enquiry</h1>
						<form class = "form-horizontal" action="#">

							<div class="form-group">
							<label for="pnrenq" class="control-label col-xs-4">Enter PNR</label>
							<div class="col-xs-8">
							<input type="text" class="form-control" placeholder="PNR No." id="pnrenq" required>
							</div>
							</div>
				
						</form>
					</div>
				</div>
				</div>
				
				
				
				<div class="row" id="Page3" style="display:none;">
				<div class="col-xs-offset-2 col-xs-8">
					<div class="enquiry">
						<h1>Cancellation</h1>
						<form class = "form-horizontal" action="#">

							<div class="form-group">
							<label for="cancel" class="control-label col-xs-4">Enter PNR</label>
							<div class="col-xs-8">
							<input type="text" class="form-control" placeholder="PNR No." id="cancel" required>
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