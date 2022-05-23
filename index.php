<?php 
session_start();
 if(!isset($_SESSION["store_userid"]))  
 {   
      header("location:login.php");  
 } 
else
{
	header("location:receipt.php");
}


?>