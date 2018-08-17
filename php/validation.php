<?php
	
	$newmail = $usr = $newpwd = $cnfmpwd = $name = $dob = $mob = $gender = $state = $city = $zip = $ques = $ans =$otp="";
	$newpwdErr = $cnfmpwdErr = $mobErr = $zipErr = $dobErr = $emailErr = $usrErr = $fatErr = $otpErr= "";
	$flag=0;
	
	if(isset($_SESSION['OTP'])) $OTP=$_SESSION['OTP'];
	else $OTP='';
	if(isset($_SESSION['otpmail'])) $otpmail=$_SESSION['otpmail'];
	else $otpmail='';
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	  include("connection.php");
	  
	  $newmail = test_input($_POST["newmail"]);
	  $usr = test_input($_POST["usr"]);
	  $newpwd = test_input($_POST["newpwd"]);
	  $cnfmpwd = test_input($_POST["cnfmpwd"]);
	  $name = test_input($_POST["name"]);
	  $dob = test_input ($_POST["dob"]);
	  $mob = test_input ($_POST["mob"]);
	  $gender = test_input ($_POST["gender"]);
	  $state = test_input ($_POST["state"]);
	  $zip = test_input ($_POST["zip"]);
	  $ques = test_input ($_POST["ques"]);
	  $ans = test_input ($_POST["ans"]);
	  $otp = test_input ($_POST["otp"]);
	  
	  
	  if(strlen($newpwd)<8)
	  {
		  $newpwdErr = "*Password must be atleast 8 characters long!";
		  $flag=1;
	  }
	  if($cnfmpwd!=$newpwd)
	  {
		  $cnfmpwdErr = "*Password doesn't match!";
		  $flag=1;
	  }
	  $today = date("Y-m-d");
	  $diff = date_diff(date_create($dob), date_create($today));
	  if($dob>$today){
		  $dobErr="*Invalid Date of Birth!";
		  $flag=1;
	  }
	  else
	  {
	  if(($diff->format('%y')) <18 )
	  {
		  $dobErr="*You must be atleast 18 years old to register!";
		  $flag=1;
	  }
	  }
	  if(strlen($mob)<10)
	  {
		  $mobErr = "*Invalid Mobile No.!";
		  $flag=1;
	  }
	  if(strlen($zip)<6)
	  {
		  $zipErr = "*Invalid Zip Code!";
		  $flag=1;
	  }
	  
	  $query="select *from user where Email='$newmail';";
	  $res=mysqli_query($db,$query);
	  if (mysqli_num_rows($res) > 0)
	  {
		  $emailErr = "*$newmail : Already in use!";
		  $flag=1;
	  }
	  if($OTP!=$otp or $otpmail!=$newmail )
	{
		$otpErr="*Invalid OTP";
		$flag=1;
	}
	  
	  $query="select *from user where User='$usr';";
	  $res=mysqli_query($db,$query);
	  if (mysqli_num_rows($res) > 0)
	  {
		  $usrErr = "*$usr : Already taken!";
		  $flag=1;
	  }
	  
	  $query="select *from user where Mobile='$mob';";
	  $res=mysqli_query($db,$query);
	  if (mysqli_num_rows($res) > 0)
	  {
		  $mobErr = "*$mob : Already taken!";
		  $flag=1;
	  }
	  
	  if(isset($_FILES['pic']))
	  {
		  if($_FILES['pic']['error'] != UPLOAD_ERR_NO_FILE)
			{
			  $info = pathinfo($_FILES['pic']['name']);
			  $ext = $info['extension'];
			  $newname = $usr.".".$ext;
			  $target = 'Users/'.$newname;
			  move_uploaded_file( $_FILES['pic']['tmp_name'], $target);
			}
	  }
	  
	  if($flag==0)
	  {
		$password = md5($newpwd);
		$ans=md5($ans);
    	$query = "INSERT INTO user VALUES('$newmail','$usr','$password','$name','$dob','$mob','$gender','$state','$zip','$ques','$ans',10000)";
		if(mysqli_query($db,$query))
		{
			mysqli_close($db);
			unset($_SESSION['OTP']);
			unset($_SESSION['otpmail']);
			$from='From : wastelandtracks@gmail.com';
			$message ='Congratulations for starting a new relation with WASTELAND TRACKS. 10000(INR) has been credited to your Wasteland WALLET. We look forward to provide the best services to you.
Thanks & Regards!
--
_________________________________________

Wasteland Tracks
1st Floor, Internet Ticketing Centre
IRCA Building, State Entry Road,
New Delhi – 110055
Customer-Care: 011-39340000 (24x7)
_________________________________________"';
			mail($newmail,'CONGRATULATIONS',$message,$from);
			header('location:success.php');
		}
		else
		{
			$fatErr = "Unable to process the request at the moment! :( <br/>Apologies for the inconvenience caused. _/\_ <br/> Please try again later.";
		}
	  }
		  
	}
	
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	
	

	
	
?>
