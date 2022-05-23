<?php
session_start();

 if(isset($_SESSION["store_userid"]))  
 {   
     header("location:index.php"); 
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Food Processing Inventory Management System</title>
	<link href="assets/images/user.png" rel="icon">
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/fontawesome-all.min.css" rel="stylesheet">
<link href="assets/css/spinners.css" rel="stylesheet">
<link href="assets/css/login.css" rel="stylesheet">
<style>
	.bgimg
	{
		min-height: 100%;
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
	}
	</style>
</head>
<body>
<img src="assets/images/loginbg.png" alt="img" class="bgimg">
<div class="preloader">
  <svg class="circular" viewBox="25 25 50 50">
    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
  </svg>
</div>
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-lg-4 col-md-6 col-sm-8 col-10">
      <div class="login-content card">
        <div class="login-form" id="logindiv">
			<img src="assets/images/user.png" alt="logo" class="logoimg">
          <form action="#" method="post" onSubmit="return false" id="loginform" class="col-12">
            <div class="form-group">
              <label>UserName<i class="fa fa-star"></i>:</label>
              <input type="text" class="form-control" placeholder="Username" id="signinusername" name="signinusername">
            </div>
            <div class="form-group">
              <label>Password<i class="fa fa-star"></i>:</label>
              <input type="password" class="form-control" placeholder="Password" id="signinpassword" name="signinpassword">
            </div>
            <button type="button" class="btn btn-success" id="btnsignin">Sign in</button>
          </form>
		  </div>
      </div>
    </div>
  </div>
</div>
	
	<div id="notificationmodal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<p id="notifymessage"></p>
			</div>
			 <div id="progressbar"></div>
		</div>
	</div>
</div>
	
<script src="assets/js/jquery.js"></script> 
<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/theme.js"></script>
<script src="assets/js/login.js"></script>
</body>
</html>