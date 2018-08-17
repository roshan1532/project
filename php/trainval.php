<?php
	
	$tnumber=$tname=$ttype=$sid=$sname=$did=$dname="";
	$sic1=$sic2=$sic3=$fair1=$fair2=$fair3=0;
	$tnumbererr=$tnameerr="";
	$siderr=$sicerr1=$sicerr2=$sicerr3=$sicerr4=$snerror="";
	$flag=0;
	
	if (isset($_POST['nxt3'])) 
	{
	  
	  
	  $tnumber= test_input($_POST["tnumber"]);
	  $tname= test_input($_POST["tname"]);
	  $ttype= test_input($_POST["ttype"]);
	  $sid= test_input($_POST["sid"]);
	  $did = test_input($_POST["did"]);
	  $snumber=test_input($_POST['snumber']);
	 
	  $fair1= test_input ($_POST["fair1"]);
	  $fair2= test_input ($_POST["fair2"]);
	  $fair3= test_input ($_POST["fair3"]);
	  $sic1= test_input ($_POST["seat1"]);
	  $sic2= test_input ($_POST["seat2"]);
	  $sic3= test_input ($_POST["seat3"]);
	  
	  $query="select * from train where t_id='$tnumber'";
	  $res=mysqli_query($db,$query);
	  if (mysqli_num_rows($res) != 0)
	  {
		  $tnumbererr="* Already existing train no.";
		  $flag=1;
	  }
	  
	  if($snumber<2)
	  {
		  $snerror="* Number of stops must be atleast 2";
		  $flag=1;
	  }
	  
	  if($sid==$did)
	  { 
        $siderr="* Source and Destination station can not be same";
		$flag=1;
	  }
	  if(($sic1==null && $fair1!=NULL)||($sic1!=NULL && $fair1==NULL))
	  {
		  $sicerr1="* Please fill in the details";
		  $flag=1; 
	  }
	  if(($sic2==null &&$fair2!=NULL)||($sic2!=NULL&& $fair2==NULL))
	  {
		  $sicerr2="* Please fill in the details";
		  $flag=1; 
	  }
	  if(($sic3==null &&$fair3!=NULL)||($sic3!=NULL&& $fair3==NULL))
	  {
		  $sicerr3="* Please fill in the details";
		  $flag=1; 
	  }
	  if(($sic1==null && $fair1==NULL)&&($sic2==null && $fair2==NULL)&&($sic3==null && $fair3==NULL))
	  {
		$sicerr4="* Please fill atleast one field";
		$flag=1;   
	  }
	  if($flag!=1)
	  {
		  
		  $_SESSION['srstn']=$sid;
		  $_SESSION['dsstn']=$did;
		  $_SESSION['snumber']=$snumber;
		  $que = array($tnumber,$tname,$ttype,$sid,$did,$fair1,$fair2,$fair3,$sic1,$sic2,$sic3,$snumber);
		  $_SESSION['atrain'] = $que;
		  header('location:addroute.php');
	  }
	 
	}
	
	
	
	
	
	
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	
	

	
	
?>
