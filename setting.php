<?php
session_start();
$pagetitle = "user";
include( 'header.php' );
include( 'pagesidebar.php' );
?>

<div class="container-fluid">
<form action="#" method="post" onSubmit="return false" id="settingform" class="col-12">
	<div class="d-flex m-b-10">
		<label class="mrg-tp10">Full Name:</label>
		<input type="text" id="tbsettinguserfullname" name="tbsettinguserfullname" class="form-control m-l-5 w200" value="<?php echo $_SESSION["store_fullname" ] ?>">
	</div>
	<div class="d-flex m-b-10">
		<label class="mrg-tp10">Password:</label>
		<input type="text" id="tbsettinguserpassword" name="tbsettinguserpassword" class="form-control m-l-5 w200">
	</div>
	<button type="button" class="btn btn-primary" id="btnsettingupdate"><i class="fa fa-plus"></i>Update Setting</button>
	</form>
</div>
</div>
</div>
</div>

<?php include('footer.php'); ?>