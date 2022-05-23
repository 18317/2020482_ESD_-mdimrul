<?php
$pagetitle = "Invoice Reports";
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
	<table id="invoicedetaildata" class="table table-bordered table-striped">
	</table>
	
	
	<div id="receiptdetailmodal" class="modal fade bg-white" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog w90p">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Receipt Detail</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<label>Date &amp; Time: <span id="invoicedetaildatetime"></label>
				<table id="singleinvoicedetails" class="table table-bordered table-striped tableFixHead"></table>
			</div>
			<div class="modal-footer" id="invoicedetailfooter">
				<ul class="float-left">
					<li>Invoice #:<span id="invoicedetailinvoiceno"></span></li>
					<li>Total Item: <span id="invoicedetailtotalitem">0</span></li>
				</ul>
				<ul class="float-right" id="receiptamountdiv2">
					<li>Total Amount:<span id="invoicedetailtbtotalamount"></span></li>
					<li>Discount:<span id="invoicedetailtbdiscount"></span></li>
					<li>Payable Amount:<span id="invoicedetailtbpayableamount"></span></li>
				</ul>
			</div>
		</div>
	</div>
</div>
</div>


<?php include('footer.php'); ?>