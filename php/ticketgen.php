<?php
include('connection.php');
if ($_SESSION['logged']!=1)
{
	echo"<script>alert('Invalid access! Please login.')</script>";
	echo"<script>window.open('index.php','_self')</script>";
}



//if ($_SERVER["REQUEST_METHOD"] == "POST")
//{
	$flag=0;
	$today = date("Y-m-d");
	// passenger details collection
	
	$name1 = $_SESSION['passdet'][0];
	$age1 = $_SESSION['passdet'][1];
	$gender1 = $_SESSION['passdet'][2];
	$name2 = $_SESSION['passdet'][3];
	$age2 = $_SESSION['passdet'][4];
	$gender2 =$_SESSION['passdet'][5];
	$name3 = $_SESSION['passdet'][6];
	$age3 = $_SESSION['passdet'][7];
	$gender3 = $_SESSION['passdet'][8];
	$adult=$_SESSION['adult'];
	$child=$_SESSION['child'];
	
	$sno1 =$sno2 =$sno3 =$ber1 =$ber2= $ber3 = $status=NULL;
	
	$berth = array("SIDE-UPPER","LOWER", "MIDDLE","UPPER","LOWER", "MIDDLE","UPPER","SIDE-LOWER");
	
	
	$tid = $_SESSION['tid'];
	$train =$_SESSION['train'];
	$class = $_SESSION['class'];
	$source = $_SESSION['source'];
	$destination = $_SESSION['destination'];
	$type = $_SESSION['type'];
	$src = $_SESSION['src'];
	$dest = $_SESSION['dest'];
	$doj = $_SESSION['doj'];
	$day=$_SESSION['wday'];
	$dist=$_SESSION['dist'];
	$fare=$_SESSION['fare'];
	$user=$_SESSION['uname'];
	$onefare=$fare;
	$_SESSION['success']=0;
	
	
	$query1="select *from train_class where t_id='$tid';";
	$res1=mysqli_query($db,$query1);
	$row1=mysqli_fetch_array($res1);
	
	$query2="select * from t_status where t_id='$tid' and Date='$doj';";
	$res2=mysqli_query($db,$query2);
	$row2=mysqli_fetch_array($res2);
	
	// checking if the date and tid is already existing
	
	if (mysqli_num_rows($res2) == 0)
	{	
		if($class=='SLEEPER')
		{
			if($adult==1)
			{
				$sno1=1;
				$avl=$row1['sic1']-1;
				$bkd=1;
				$ber1=$berth[$sno1%8];
			}
			elseif($adult==2)
			{
				$sno1=1;
				$sno2=2;
				$avl=$row1['sic1']-2;
				$bkd=2;
				$fare*=2;
				$ber1=$berth[$sno1%8];
				$ber2=$berth[$sno2%8];
			}
			elseif($adult==3)
			{
				$sno1=1;
				$sno2=2;
				$sno3=3;
				$avl=$row1['sic1']-3;
				$bkd=3;
				$fare*=3;
				$ber1=$berth[$sno1%8];
				$ber2=$berth[$sno2%8];
				$ber3=$berth[$sno3%8];
			}
			$avl2=$row1['sic2'];
			$avl3=$row1['sic3'];
			$in="INSERT INTO t_status VALUES('$tid','$doj','$avl',0,'$bkd','$avl2',0,0,'$avl3',0,0)";
			if(!mysqli_query($db,$in)) $flag=1;
			
		}
		
		elseif($class=='AC-TIER1')
		{
			if($adult==1)
			{
				$sno1=1;
				$avl=$row1['sic2']-1;
				$bkd=1;
				$ber1=$berth[$sno1%8];
			}
			elseif($adult==2)
			{
				$sno1=1;
				$sno2=2;
				$avl=$row1['sic2']-2;
				$bkd=2;
				$fare*=2;
				$ber1=$berth[$sno1%8];
				$ber2=$berth[$sno2%8];
			}
			elseif($adult==3)
			{
				$sno1=1;
				$sno2=2;
				$sno3=3;
				$avl=$row1['sic2']-3;
				$bkd=3;
				$fare*=3;
				$ber1=$berth[$sno1%8];
				$ber2=$berth[$sno2%8];
				$ber3=$berth[$sno3%8];
			}
			
			$avl1=$row1['sic1'];
			$avl3=$row1['sic3'];
			$in="INSERT INTO t_status VALUES('$tid','$doj','$avl1',0,0,'$avl',0,'$bkd','$avl3',0,0)";
			if(!mysqli_query($db,$in)) $flag=1;
		}
		
		elseif($class=='AC-TIER2')
		{
			
			if($adult==1)
			{
				$sno1=1;
				$avl=$row1['sic3']-1;
				$bkd=1;
				$ber1=$berth[$sno1%8];
			}
			elseif($adult==2)
			{
				$sno1=1;
				$sno2=2;
				$avl=$row1['sic3']-2;
				$bkd=2;
				$fare*=2;
				$ber1=$berth[$sno1%8];
				$ber2=$berth[$sno2%8];
			}
			elseif($adult==3)
			{
				$sno1=1;
				$sno2=2;
				$sno3=3;
				$avl=$row1['sic3']-3;
				$bkd=3;
				$fare*=3;
				$ber1=$berth[$sno1%8];
				$ber2=$berth[$sno2%8];
				$ber3=$berth[$sno3%8];
			}
			
			$avl1=$row1['sic1'];
			$avl2=$row1['sic2'];
			$in="INSERT INTO t_status VALUES('$tid','$doj','$avl1',0,0,'$avl2',0,0,'$avl',0,'$bkd')";
			if(!mysqli_query($db,$in)) $flag=1;
			
		}
		
		$result=mysqli_query($db,"select Balance from user where User='$user';");
		$row=mysqli_fetch_array($result);
		if($row['Balance']<$fare)
		{
			echo"<script>alert('You do not have enough money in you wallet. Please add some money before booking.')</script>";
			//echo"<script>window.open('money.php','_self')</script>";
		}
		if(!$flag)
		{			
		$status="CONFIRMED";
		$query="INSERT INTO p_ticket(t_id,src_id,dest_id,class,res_status,Adult,Child,journey_date,Distance,Fare,User, DoBk) values('$tid','$src','$dest','$class','$status',$adult, $child,'$doj',$dist,$fare,'$user','$today')";
		if(!mysqli_query($db,$query)) $flag=1;
		$pnr=mysqli_insert_id($db);
		$_SESSION['pnr']= $pnr;
		
		if($adult==1)
			$query=" insert into passenger values($pnr,$sno1,'$ber1','$name1',$age1,'$gender1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$user')";
		
		elseif($adult==2)
			$query=" insert into passenger values($pnr,$sno1,'$ber1','$name1',$age1,'$gender1',$sno2,'$ber2','$name2',$age2,'$gender2',NULL,NULL,NULL,NULL,NULL,'$user')";
			
		elseif($adult==3)
		$query=" insert into passenger values($pnr,$sno1,'$ber1','$name1',$age1,'$gender1',$sno2,'$ber2','$name2',$age2,'$gender2',$sno3,'$ber3','$name3',$age3,'$gender3','$user')";
		if(!$flag)
		{
			if(!mysqli_query($db,$query)) $flag=1;
			if(!$flag)
			{
				
				$result=mysqli_query($db,"select Balance from user where User='$user';");
				$row=mysqli_fetch_array($result);
				$bal=$row['Balance']-$fare;
				mysqli_query($db,"update user set Balance=$bal where User='$user';");
			}
		}
		}
		
	}
	
	// if already existing
	
	else
	{
		
		if($class=='SLEEPER')
		{
			if($adult==1)
			{
				$avl=$row2['avail_seat_c1'];
				if($avl>0)
				{
					$sno1=$row2['booked_seat_c1']+1;
					$bkd=$row2['booked_seat_c1']+1;
					$ber1=$berth[$sno1%8];
					$status="CONFIRMED";
					$avl-=1;
					$wait=$row2['wait_seat_c1'];
				}
				else
				{
					$wait=$row2['wait_seat_c1']+1;
					$status="WAITING";
					$bkd=$row2['booked_seat_c1'];
				}
			}
			elseif($adult==2)
			{
				$avl=$row2['avail_seat_c1'];
				if($avl>1)
				{
					$sno1=$row2['booked_seat_c1']+1;
					$sno2=$row2['booked_seat_c1']+2;
					$bkd=$row2['booked_seat_c1']+2;
					$ber1=$berth[$sno1%8];
					$ber2=$berth[$sno2%8];
					$status="CONFIRMED";
					$avl-=2;
					$wait=$row2['wait_seat_c1'];
				}
				else
				{
					$wait=$row2['wait_seat_c1']+2;
					$status="WAITING";
					$bkd=$row2['booked_seat_c1'];	
				}
				$fare*=2;
			}
			elseif($adult==3)
			{
				$avl=$row2['avail_seat_c1'];
				if($avl>2)
				{
					
					$sno1=$row2['booked_seat_c1']+1;
					$sno2=$row2['booked_seat_c1']+2;
					$sno3=$row2['booked_seat_c1']+3;
					$bkd=$row2['booked_seat_c1']+3;
					$ber1=$berth[$sno1%8];
					$ber2=$berth[$sno2%8];
					$ber3=$berth[$sno3%8];
					$status="CONFIRMED";
					$avl-=3;
					$wait=$row2['wait_seat_c1'];
				}
				else
				{
					$wait=$row2['wait_seat_c1']+3;
					$status="WAITING";
					$bkd=$row2['booked_seat_c1'];
				}
				$fare*=3;
			}
			$up="UPDATE t_status SET avail_seat_c1=$avl, booked_seat_c1=$bkd, wait_seat_c1=$wait where t_id='$tid' and Date='$doj'";
			if(!mysqli_query($db,$up)) $flag=1;
			
		}
		
		elseif($class=='AC-TIER1')
		{
			if($adult==1)
			{
				$avl=$row2['avail_seat_c2'];
				if($avl>0)
				{
					$sno1=$row2['booked_seat_c2']+1;
					$bkd=$row2['booked_seat_c2']+1;
					$ber1=$berth[$sno1%8];
					$status="CONFIRMED";
					$avl-=1;
					$wait=$row2['wait_seat_c2'];
				}
				else
				{
					$wait=$row2['wait_seat_c2']+1;
					$status="WAITING";
					$bkd=$row2['booked_seat_c2'];
				}
			}
			elseif($adult==2)
			{
				$avl=$row2['avail_seat_c2'];
				if($avl>1)
				{
					$sno1=$row2['booked_seat_c2']+1;
					$sno2=$row2['booked_seat_c2']+2;
					$bkd=$row2['booked_seat_c2']+2;
					$ber1=$berth[$sno1%8];
					$ber2=$berth[$sno2%8];
					$fare*=2;
					$status="CONFIRMED";
					$avl-=2;
					$wait=$row2['wait_seat_c2'];
				}
				else
				{
					$wait=$row2['wait_seat_c2']+2;
					$status="WAITING";
					$fare*=2;
					$bkd=$row2['booked_seat_c2'];
				}
			}
			elseif($adult==3)
			{
				$fare*=3;
				$avl=$row2['avail_seat_c2'];
				if($avl>2)
				{
					$sno1=$row2['booked_seat_c2']+1;
					$sno2=$row2['booked_seat_c2']+2;
					$sno3=$row2['booked_seat_c2']+3;
					$bkd=$row2['booked_seat_c2']+3;
					$ber1=$berth[$sno1%8];
					$ber2=$berth[$sno2%8];
					$ber3=$berth[$sno3%8];
					$status="CONFIRMED";
					$avl-=3;
					$wait=$row2['wait_seat_c2'];
				}
				else
				{
					$wait=$row2['wait_seat_c2']+3;
					$status="WAITING";
					$bkd=$row2['booked_seat_c2'];
				}
			}
			
			$up="UPDATE t_status SET avail_seat_c2=$avl, booked_seat_c2=$bkd, wait_seat_c2=$wait where t_id='$tid' and Date='$doj'";
			if(!mysqli_query($db,$up)) $flag=1;
		}
		
		elseif($class=='AC-TIER2')
		{
			
			if($adult==1)
			{
				$avl=$row2['avail_seat_c3'];
				if($avl>0)
				{
					$sno1=$row2['booked_seat_c3']+1;
					$bkd=$row2['booked_seat_c3']+1;
					$ber1=$berth[$sno1%8];
					$status="CONFIRMED";
					$avl-=1;
					$wait=$row2['wait_seat_c3'];
				}
				else
				{
					$wait=$row2['wait_seat_c3']+1;
					$status="WAITING";
					$bkd=$row2['booked_seat_c3'];
				}
			}
			elseif($adult==2)
			{
				$fare*=2;
				$avl=$row2['avail_seat_c3'];
				if($avl>1)
				{
					$sno1=$row2['booked_seat_c3']+1;
					$sno2=$row2['booked_seat_c3']+2;
					$bkd=$row2['booked_seat_c3']+2;
					$ber1=$berth[$sno1%8];
					$ber2=$berth[$sno2%8];
					$status="CONFIRMED";
					$avl-=2;
					$wait=$row2['wait_seat_c3'];
				}
				else
				{
					$wait=$row2['wait_seat_c3']+2;
					$status="WAITING";
					$bkd=$row2['booked_seat_c3'];
				}
			}
			elseif($adult==3)
			{
				$fare*=3;
				$avl=$row2['avail_seat_c3'];
				if($avl>2)
				{
					
					$sno1=$row2['booked_seat_c3']+1;
					$sno2=$row2['booked_seat_c3']+2;
					$sno3=$row2['booked_seat_c3']+3;
					$bkd=$row2['booked_seat_c3']+3;
					$ber1=$berth[$sno1%8];
					$ber2=$berth[$sno2%8];
					$ber3=$berth[$sno3%8];
					$status="CONFIRMED";
					$avl-=3;
					$wait=$row2['wait_seat_c3'];
				}
				else
				{
					$wait=$row2['wait_seat_c3']+3;
					$status="WAITING";
					$bkd=$row2['booked_seat_c3'];
				}
			}
			
			$up="UPDATE t_status SET avail_seat_c3=$avl, booked_seat_c3=$bkd, wait_seat_c3=$wait where t_id='$tid' and Date='$doj'";
			if(!mysqli_query($db,$up)) $flag=1;
			
		}
		$result=mysqli_query($db,"select Balance from user where User='$user';");
		$row=mysqli_fetch_array($result);
		if($row['Balance']<$fare)
		{
			echo"<script>alert('You do not have enough money in you wallet. Please add some money before booking.')</script>";
			echo"<script>window.open('money.php','_self')</script>";
		}
		if(!$flag)
		{
			$today = date("Y-m-d");
			$query="INSERT INTO p_ticket(t_id,src_id,dest_id,class,res_status,Adult, Child,journey_date,Distance,Fare,User, DoBk) values('$tid','$src','$dest','$class','$status',$adult, $child,'$doj',$dist,$fare,'$user','$today')";
			if(!mysqli_query($db,$query)) $flag=1;
			$pnr=mysqli_insert_id($db);
			$_SESSION['pnr']= $pnr;
			
			if(!$wait or $sno1 or $sno2 or $sno3)
			{
			if($adult==1)
				$query=" insert into passenger values($pnr,$sno1,'$ber1','$name1',$age1,'$gender1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$user')";
			
			elseif($adult==2)
				$query=" insert into passenger values($pnr,$sno1,'$ber1','$name1',$age1,'$gender1',$sno2,'$ber2','$name2',$age2,'$gender2',NULL,NULL,NULL,NULL,NULL,'$user')";
				
			elseif($adult==3)
			$query=" insert into passenger values($pnr,$sno1,'$ber1','$name1',$age1,'$gender1',$sno2,'$ber2','$name2',$age2,'$gender2',$sno3,'$ber3','$name3',$age3,'$gender3','$user')";
			}
			else
			{
			if($adult==1)
				$query=" insert into passenger values($pnr,NULL,NULL,'$name1',$age1,'$gender1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$user')";
			
			elseif($adult==2)
				$query=" insert into passenger values($pnr,NULL,NULL,'$name1',$age1,'$gender1',NULL,NULL,'$name2',$age2,'$gender2',NULL,NULL,NULL,NULL,NULL,'$user')";
				
			elseif($adult==3)
			$query=" insert into passenger values($pnr,NULL,NULL,'$name1',$age1,'$gender1',NULL,NULL,'$name2',$age2,'$gender2',NULL,NULL,'$name3',$age3,'$gender3','$user')";
			}
			
			if(!$flag)
			{
				if(!mysqli_query($db,$query)) $flag=1;
			if(!$flag)
			{
				
				$result=mysqli_query($db,"select Balance from user where User='$user';");
				$row=mysqli_fetch_array($result);
				$bal=$row['Balance']-$fare;
				mysqli_query($db,"update user set Balance=$bal where User='$user';");
			}
			}
		}
		
		
		
		
	}
	
	if($flag)
	{
	echo"<script>alert('We are facing some internal issues. We regret the inconvenience caused. Please try again later.')</script>";
	echo"<script>window.open('user.php','_self')</script>";
	}
	else $_SESSION['success']=1;
		
//}


function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	
?>