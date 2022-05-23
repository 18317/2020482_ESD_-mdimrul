</div>
</div>
<!--<footer class="footer">&copy; All rights reserved.</footer>-->
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

<div id="deletemodal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<form method="post" id="deleteform">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Delete</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="text-danger">Are you want to Delete <span id="modaltext"></span>? Sure.</label>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="deleteid" id="deleteid"/>
					<button type="button" class="btn btn-danger" name="btnmodaldelete" id="btnmodaldelete">Delete</button>
					<button type="button" class="btn btn-success" class="close" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/sidebarmenu.js"></script>
<script src="assets/js/theme.js"></script>
 <?php
if ($pagetitle == "Dashboard"){ echo '<script src="assets/js/dashboard.js"></script>';}
elseif ($pagetitle == "Product Details"){ echo '<script src="assets/js/product.js"></script>';}
elseif ($pagetitle == "Stock Details"){ echo '<script src="assets/js/stock.js"></script>';}
elseif ($pagetitle == "Price List"){ echo '<script src="assets/js/pricelist.js"></script>';}
elseif ($pagetitle == "Receipt"){ echo '<script src="assets/js/receipt.js"></script>';}
elseif ($pagetitle == "Brand"){ echo '<script src="assets/js/brand.js"></script>';}
elseif ($pagetitle == "Category"){ echo '<script src="assets/js/category.js"></script>';}
elseif ($pagetitle == "Invoice Reports" || $pagetitle == "Stock Reports"){ echo '<script src="assets/js/report.js"></script>';}
elseif ($pagetitle == "Receipt Details"){ echo '<script src="assets/js/receiptdetails.js"></script>';}
elseif ($pagetitle == "user"){ echo '<script src="assets/js/user.js"></script>';}
 ?>
</body>
</html>