<?php
$pagetitle = "Category";
include( 'header.php' );
 include('pagesidebar.php'); ?>
		
			
<div class="rightbtn mb-3">
	<div class="d-flex float-left">
		<label class="mrg-tp10">Search:</label>
		<input type="text" id="tbsearch" class="form-control m-l-5 w200">
	</div>
	<button type="button" class="btn float-right btn-primary" data-toggle="modal" data-target="#categorydetailmodal" id="btnaddprdmod"><i class="fa fa-plus"></i>Add Category</button>
</div>

<div class="container-fluid">
	<table id="categorydetaildata" class="table table-bordered table-striped">
	</table>
</div>
<div id="categorydetailmodal" class="modal fade modalscroll" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog w400">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add New Category</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>				
				<button type="button" class="btn btn-success float-right m-r-25" id="btnaddcategory">Add</button>
			</div>
			<div class="modal-body">
				<form action="#" method="post" onSubmit="return false" id="categorydetailform" class="col-12">
					<div class="form-group">
						<label>Category Name<i class="fa fa-star"></i>:</label>
						<input type="text" class="form-control text-uppercase" id="tbcategoryname" name="tbcategoryname">
					</div>
					<div class="form-group">
						<label>Status<i class="fa fa-star"></i>:</label>
						<select class="form-control" id="ddstatus" name="ddstatus">
							<option selected value="1">Active</option>
							<option value="0">InActive</option>
						</select>
					</div>
					<input type="hidden" id="tbaction" name="tbaction">
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