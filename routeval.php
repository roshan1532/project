<?php
	session_start();
	include("connection.php");
	
	
	if (isset($_POST['add1'])) 
	{
		$flag=0;
		
		$n=$_SESSION['snumber'];
		$k=0;
		    $stnarray=array();
			$avlday=array();
			$artime=array();
			$detime=array();
			$srdist=array();
		for($i=1;$i<=$n;$i++,$k++){
		if($i==1)
		{
			$stnarray[$k]=$_SESSION['atrain'][3];
			$avlday[$k]=$_POST['day'.$i.''];
			$artime[$k]=NULL;
			$detime[$k]=$_POST['dtime'.$i.''];
			$srdist[$k]=0;
        		
		}
		else if($i==$n)
		{
			$stnarray[$k]=$_SESSION['atrain'][4];
			$avlday[$k]=$_POST['day'.$i.''];
			$artime[$k]=$_POST['atime'.$i.''];
			$detime[$k]=NULL;
			$srdist[$k]=$_POST['sdist'.$i.''];
			
		}
		else{
			$stnarray[$k]=$_POST['stn'.$i.''];
			$avlday[$k]=$_POST['day'.$i.''];
			$artime[$k]=$_POST['atime'.$i.''];
			$detime[$k]=$_POST['dtime'.$i.''];
			$srdist[$k]=$_POST['sdist'.$i.''];
		}
	  }
	 if(no_dupes($stnarray))
	 {
		  if(check_srcdist($srdist,$n))
		 {
			 $tno=$_SESSION['atrain'][0];
			 $tname=$_SESSION['atrain'][1];
			 $ttype=$_SESSION['atrain'][2];
			 $srid=$_SESSION['atrain'][3];
			 $drid=$_SESSION['atrain'][4];
			 $sic1=$_SESSION['atrain'][8];
			 $sic2=$_SESSION['atrain'][9];
			 $sic3=$_SESSION['atrain'][10];
			 $fair1=$_SESSION['atrain'][5];
			 $fair2=$_SESSION['atrain'][6];
			 $fair3=$_SESSION['atrain'][7];
			 
			 //
			  $sic1=!empty($sic1) ? "'$sic1'" : "NULL";
			 $sic2=!empty($sic2) ? "'$sic2'" : "NULL";
			 $sic3=!empty($sic3) ? "'$sic3'" : "NULL";
			 $fair1=!empty($fair1) ? "'$fair1'" : "NULL";
			 $fair2=!empty($fair2) ? "'$fair2'" : "NULL";
			 $fair3=!empty($fair3) ? "'$fair3'" : "NULL";
             

			 
			 $query = "insert into train values('$tno','$tname', '$ttype','$srid','$drid')";
			 $res=mysqli_query($db,$query);
			 if($res){
			  $flag=0;
		     }
			 else
			 {
				 $flag=1;
			 }
			 
			 $query="insert into train_class values('$tno',$sic1,$sic2,$sic3,$fair1,$fair2,$fair3)";
			 $res=mysqli_query($db,$query);
			 if($res){
			  $flag=0;
		     }
			 else
			 {
				 $flag=1;
			 }
			 for($i=1;$i<=$n;$i++){
				 $s=$stnarray[$i-1];
				 $d=$avlday[$i-1];
				 $at=$artime[$i-1];
			     $dt=$detime[$i-1];
			     $sd=$srdist[$i-1];
			 $query="insert into route values('$tno',$i,'$s','$d','$at','$dt',$sd)";
			 $res=mysqli_query($db,$query);
			 if($res){
			  $flag=0;
		     }
			 else
			 {
				$flag=1;
			 }
			 }
			 
			 if($flag==1)
			 {
				 
				 echo"<script>alert('Can not add train at the moment! Please try again later.')</script>";
				 echo"<script>window.open('admin.php','_self')</script>";
				 
			 }
			 else
			 {
				 echo"<script>alert('Train added succesfully.')</script>";
				 echo"<script>window.open('admin.php','_self')</script>";
			 }
			 
		 }
		 else{
		 echo"<script>alert('Oops! Seems like you have wrond distance')</script>";
		 echo"<script>window.open('addroute.php','_self')</script>";
		 }
	 }
	 else{
		 echo"<script>alert('Oops! Seems like you have entered some duplicate stations')</script>";
		echo"<script>window.open('addroute.php','_self')</script>"; 
	 }
		   
	}
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	function no_dupes(array $input_array) 
	{
    return count($input_array) === count(array_flip($input_array));
	}
	function check_srcdist(array $a , $n)
	{
	  	for($i=1;$i<$n;$i++)
			if($a[$i]<=$a[$i-1])
				return 0;
		return 1;
	}
	

?>
