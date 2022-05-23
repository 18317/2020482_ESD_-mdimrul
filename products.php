<?php
$pagetitle = "Product Details";
include( 'header.php' );
include( 'pagesidebar.php' );
?>

<div class="rightbtn mb-3">
	<div class="d-flex float-left">
		<label class="mrg-tp10">Search:</label>
		<input type="text" id="tbsearch" class="form-control m-l-5 w200">
	</div>
	<button type="button" class="btn float-right btn-primary modalbutton" data-toggle="modal" data-target="#productdetailmodal" id="btnaddprdmod"><i class="fa fa-plus"></i>Add Product</button>
</div>

<div class="container-fluid">
	<table id="productdetaildata" class="table table-bordered table-striped">
	</table>
</div>

<div id="productdetailmodal" class="modal fade modalscroll" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog w500">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Product Detail</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<button type="button" class="btn btn-success float-right m-r-25" id="btnaddproductdetail">Add</button>
			</div>
			<div class="modal-body">
				<form action="#" method="post" onSubmit="return false" id="productdetailform" class="col-12">
							<div class="form-group">
								<label>Select Category<i class="fa fa-star"></i>:</label>
								<select id="ddcategory" name="ddcategory" class="form-control"></select>
							</div>
							<div class="form-group">
								<label>Select Brand<i class="fa fa-star"></i>:</label>
								<select id="ddbrand" name="ddbrand" class="form-control">
									<option disabled selected>Select Brand</option>
								</select>
							</div>
							<div class="form-group">
								<label>Enter Product Code<i class="fa fa-star"></i>:</label>
								<input type="text" class="form-control text-uppercase" id="tbproductcode" name="tbproductcode">
							</div>					
							<div class="form-group">
								<label>Units:<i class="fa fa-star"></i>:</label>
								<select id="tbproductunit" name="tbproductunit" class="form-control">
									<option disabled selected>Select Unit</option>
									<option value="Pounds">Pounds</option>
									<option value="Kg">Kg</option>
									<option value="Nos">Nos</option>
								</select>
							</div>							
							<div class="form-group">
								<label>Enter Product Description:</label>
								<textarea type="text" class="form-control" id="tbproductdescription" name="tbproductdescription"></textarea>
							</div>
					<div class="form-group">
								<label>Status<i class="fa fa-star"></i>:</label>
								<select class="form-control" id="ddstatus" name="ddstatus">
									<option selected value="1">Active</option>
									<option value="0">InActive</option>
								</select>
							</div>
						<input type="hidden" id="tbaction" name="tbaction">
						<input type="hidden" id="tbcategory" name="tbcategory">
						<input type="hidden" id="tbbrand" name="tbbrand">
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