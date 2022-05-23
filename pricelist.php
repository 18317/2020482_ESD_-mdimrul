<?php
$pagetitle = "Price List";
include( 'header.php' );
include( 'pagesidebar.php' );
?>

<div class="rightbtn mb-3">
	<div class="d-flex float-left">
		<label class="mrg-tp10">Search:</label>
		<input type="text" id="tbsearch" class="form-control m-l-5 w200">
	</div>
	<button type="button" class="btn float-right btn-success" id="btnupdatepricelist"><i class="fa fa-edit"></i>Update Price List</button>
</div>
<div class="container-fluid">
	<table id="productpricedata" class="table table-bordered table-striped">
	</table>
</div>
</div>
</div>
</div>

<?php include('footer.php'); ?>