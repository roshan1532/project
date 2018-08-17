<?php
  $uErr = $aErr = $alol = $ulol = "";
  include("connection.php");
  $_SESSION['name']="";
  $_SESSION['uname']="";
  $_SESSION['aname']="";
  $_SESSION['umail']="";
  $_SESSION['amail']="";
  $_SESSION['logged']=0;
  $_SESSION['alogged']=0;
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		  if (isset($_POST['ulogin'])){
			   
				$email = test_input($_POST["umail"]);
				$password = test_input($_POST["upwd"]);
				
					$password = md5($password);
					$query = "SELECT * FROM user WHERE Email='$email' AND Password='$password'";
					$results = mysqli_query($db, $query);
					if (mysqli_num_rows($results) == 1) {
						 $row = mysqli_fetch_array($results);
						 $_SESSION['uname']= $row['User']; 
						 $_SESSION['umail']= $row['Email'];
						 $_SESSION['name']=$row['Name'];
						 $_SESSION['logged']=1;
						 header('location:user.php'); 
					}
						else 
						{
							$uErr="*Invalid credentials!";
							$alol="--";
						}
			}
			else if (isset($_POST['alogin'])){
			   
				$email = test_input($_POST["amail"]);
				$password = test_input($_POST["apwd"]);
				
					$password = md5($password);
					$query = "SELECT * FROM admin WHERE Email='$email' AND Password='$password'";
					$results = mysqli_query($db, $query);
					if (mysqli_num_rows($results) == 1) {
						 $row = mysqli_fetch_array($results);
						 $_SESSION['aname']= $row['Admin']; 
						 $_SESSION['amail']= $row['Email'];
						 $_SESSION['alogged']=1;
						 header('location:admin.php'); 
					}
						else 
						{
							$aErr="*Invalid credentials!";
							$ulol="--";
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