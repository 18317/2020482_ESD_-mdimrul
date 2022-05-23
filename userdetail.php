<?php
$pagetitle = "user";
include( 'header.php' );
 include('pagesidebar.php'); ?>
		
			
<div class="rightbtn mb-3">
	<div class="d-flex float-left">
		<label class="mrg-tp10">Search:</label>
		<input type="text" id="tbsearch" class="form-control m-l-5 w200">
	</div>
	<button type="button" class="btn float-right btn-primary" data-toggle="modal" data-target="#userdetailmodal" id="btnadd"><i class="fa fa-plus"></i>Add Users</button>
</div>

<div class="container-fluid">
	<table id="userdetaildata" class="table table-bordered table-striped">
	</table>
</div>
<div id="userdetailmodal" class="modal fade modalscroll" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog w400">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add New user</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>				
				<button type="button" class="btn btn-success float-right m-r-25" id="btnadduser">Add</button>
			</div>
			<div class="modal-body">
				<form action="#" method="post" onSubmit="return false" id="userdetailform" class="col-12">
					<div class="form-group">
						<label>Full Name<i class="fa fa-star"></i>:</label>
						<input type="text" class="form-control text-uppercase" id="tbfullname" name="tbfullname">
					</div>
					<div class="form-group">
						<label>UserName<i class="fa fa-star"></i>:</label>
						<input type="text" class="form-control" id="tbusername" name="tbusername">
					</div>
					<div class="form-group">
						<label>Password<i class="fa fa-star"></i>:</label>
						<input type="text" class="form-control" id="tbpassword" name="tbpassword">
					</div>
					<div class="form-group">
						<label>User Type<i class="fa fa-star"></i>:</label>
						<select id="ddusertype" name="ddusertype" class="form-control">
						<option value="Cashier">Cashier</option>
						<option value="Staff">Staff</option>
					</select>
					</div>
					<div class="form-group">
						<label>Status<i class="fa fa-star"></i>:</label>
						<select class="form-control" id="ddstatus" name="ddstatus">
							<option selected value="1">Active</option>
							<option value="0">InActive</option>
						</select>
					</div>
					<input type="hidden" id="tbaction" name="tbaction" value="add">
					<input type="hidden" id="tbrowid" name="tbrowid">					
				</form>
			</div>
		</div>
	</div>
</div>
			
			</div>
</div>
</div>

			

<?php include('footer.php'); ?>