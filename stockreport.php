<?php
$pagetitle = "Stock Reports";
include( 'header.php' );
include( 'pagesidebar.php' );
?>

<div class="container-fluid">

<div class="d-flex m-b-10">
						<label class="mrg-tp10">Search by Date:</label>
						<input type="date" id="tbsearchtodate" class="form-control m-l-5 m-r-5 w200">
						<label class="mrg-tp10">-</label>
						<input type="date" id="tbsearchfromdate" class="form-control m-l-5 m-r-10 w200">
						<button type="button" id="btnsearchinvoice" class="btn btn-primary"><i class="fa fa-search"></i>Search</button>
					</div>
					
	<table id="stockdetaildata" class="table table-bordered table-striped">
	</table>
</div>


<?php include('footer.php'); ?>