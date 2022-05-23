<?php
session_start();
 if(!isset($_SESSION["store_userid"]))  
 {   
      header("location:login.php");  
 } 
$userid = $_SESSION["store_userid" ];
$username = $_SESSION["store_username" ];
$userrole = $_SESSION["store_role" ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link href="assets/images/user.png" rel="icon">
 <title>Food Processing Inventory Management System</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/theme.css" rel="stylesheet">
<link href="assets/css/spinners.css" rel="stylesheet">	
<link href="assets/css/helper.css" rel="stylesheet">
<link href="assets/css/animate.css" rel="stylesheet">	
<?php if($pagetitle == "Receipt") echo '<link href="assets/select/select2.min.css" rel="stylesheet">'?>
<link href="assets/css/custom.css" rel="stylesheet">
	
	
</head>

<body>

	<nav class="navbar navbar-light">
		<div class="header">
			<span><img src="assets/images/user.png" alt="homepage" class="dark-logo" /><b>Store</b></span>
			<span class="float-right"><img src="assets/images/user.png" alt="user" class="profile-pic" />Login As: <u><?php echo $username ?></u>
		<a class="ml-1" href="logout.php"><i class="fa fa-power-off"></i> Logout</a></span>
		</div>
	</nav>

	<div id="menubar" class="container-fluid">

		<ul class="menulist d-flex">
			<li class="bg-primary"><a href="dashboard.php"><i class="ti-dashboard"></i><span>Dashboard</span></a></li>
			<li class="bg-secondary"><a href="receipt.php"><i class="fa fa-receipt"></i><span>Receipt</span></a></li>
			<?php if($userrole != "Cashier"){ ?>
			<li class="bg-theme" id="inventorymenu"><a href="category.php"><i class="fas fa-warehouse"></i><span>Inventory</span></a></li>
			<li class="bg-success" id="reportmenu"><a href="stockreport.php"><i class="fas fa-chart-bar"></i><span>Reports</span></a></li><?php } ?>
			<li class="bg-info" id="settingmenu"><a href="setting.php"><i class="fa fa-cog"></i><span>Setting</span></a></li>
		</ul>

	</div>

<div class="content-area">
	