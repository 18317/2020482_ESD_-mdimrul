<?php
$pagetitle = "Receipt";
include( 'header.php' );
?>
<div class="row page-titles">
	<div class="col-md-12">
		<div class="float-right"><button type="button" id="btnviewreceipt" class="btn btn-primary">View Old Receipt</button>
		</div>
	</div>
</div>

<div class="container-fluid pb-8" id="receiptmaincontent">
	
	<div class="tablescroll1">
		<table id="receiptdata" class="table table-bordered table-striped tableFixHead">
			<thead>
				<tr>
					<th>Product Code</th>
					<th>Product Details</th>
					<th>Product Description</th>
					<th class="w50">Stock</th>
					<th class="w100">Quantity</th>
					<th class="w80">Units</th>
					<th class="w80">Rate</th>
					<th class="w100">Final Rate</th>
					<th class="w120">Total Price</th>
					<th class="w80"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><select class="recproductlist form-control"></select><span class="recproductlisttext d-none"></span></td>
					<td class="recproductdetails"></td>
					<td class="recproductdescrip"></td>
					<td class="recproductstock"></td>
					<td><input type="number" class="form-control recproductquantity" min="1" maxlength="5"></td>
					<td class="recunits" id="recproductunit"></td>
					<td class="recprice" id="recproductprice"></td>
					<td><input type="text" class="form-control recfinalprice numeric" maxlength="4"></td>
					<td><input type="text" class="form-control rectotalprice" readonly tabindex="-1"></td>
					<td class="recdelete text-center p-0 m-0"></td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<div class="receiptcreatediv m-t-10" id="receiptdata2">
		<ul class="float-left">
			<li>Invoice #: <span id="invoiceno" class="m-r-5"></span>Total Item: <span id="invoicetotalitem">0</span></li>
		</ul>
		<ul class="float-right" id="receiptamountdiv2">
			<li><span>Total Amount:</span><input type="text" id="tbtotalamount" name="tbtotalamount" readonly tabindex="-1"></li>
			<li><span class="text-danger">Discount:</span><input type="text" id="tbdiscount" name="tbdiscount" class="numeric" maxlength="5" value="0"></li>
			<li><span>Payable Amount:</span><input type="text" id="tbpayableamount" readonly tabindex="-1"></li>
			<li id="btbtnreceipt" class="float-right">
				<button type="button" id="btncreatereceipt" class="btn btn-success">Create Receipt</button>
			</li>
		</ul>
	</div>
</div>

<div id="invoicehistorymodal" class="modal fade invoicemodalheader modalscroll" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-theme p2p">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h2 class="text-center">Invoice History</h2>
			</div>
			<div class="modal-body" id="invoiceprintdiv">
				<div class="container-fluid">
					<div class="d-flex m-b-10">
						<label class="mrg-tp10">Search by Date:</label>
						<input type="date" id="tbsearchtodate" class="form-control m-l-5 m-r-5 w200">
						<label class="mrg-tp10">-</label>
						<input type="date" id="tbsearchfromdate" class="form-control m-l-5 m-r-10 w200">
						<button type="button" id="btnsearchstock" class="btn btn-primary"><i class="fa fa-search"></i>Search</button>
					</div>
					<hr>
					<div class="d-flex m-b-10">
						<label class="mrg-tp10">Search From Table:</label>
						<input type="text" id="tbsearchreceiptdata" class="form-control m-l-5 w200">
					</div>
					<table id="receiptdetaildata" class="table table-bordered table-striped">
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

<div id="receiptdetaildata" class="modal fade bg-white" role="dialog" data-keyboard="false" data-backdrop="static">
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
	
<?php include('footer.php'); ?>
	<script src="assets/select/select2.min.js"></script>
<script>
$(".recproductlist").select2( {
	placeholder: "Select Product"
	} );
</script>