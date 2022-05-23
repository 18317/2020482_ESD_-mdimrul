<div class="container-fluid">
	<div class="pageinnercontent">
<div class="pagesidebar">
	<div id="inventorysidebar" class="d-none">
	<a href="category.php"><i class="fa fa-list"></i>Category</a>
	<a href="brand.php"><i class="fa fa-tag"></i>Brand</a>
	<a href="products.php"><i class="ti-dropbox-alt"></i>Products</a>
	<a href="stock.php"><i class="fa fa-truck-loading"></i>Stocks</a>
	<a href="pricelist.php"><i class="fa fa-money-check"></i>Price List</a>
</div>	
<div id="settingsidebar" class="d-none">
	<a href="setting.php"><i class="fas fa-cog"></i>Setting</a>
	<?php if($userrole == "admin"){ ?>
	<a href="userdetail.php"><i class="fa fa-user"></i>User Details</a>
	<?php } ?>
</div>
<div id="reportsidebar" class="d-none">
	<a href="stockreport.php"><i class="fas fa-truck-loading"></i>Stock Report</a>
	<a href="invoicereport.php"><i class="fa fa-receipt"></i>Invoice Report</a>
</div>
</div>
<div class="innerpagecontent">