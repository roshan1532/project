<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['uname']);
unset($_SESSION['umail']);
unset($_SESSION['aname']);
unset($_SESSION['amail']);
$_SESSION['logged']=0;
$_SESSION['alogged']=0;

header('location:index.php');
?>