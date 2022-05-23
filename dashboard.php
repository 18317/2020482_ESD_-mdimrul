<?php 
$pagetitle = "Dashboard";
include('header.php');
?>
      
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
               
				<h3>Welcome <u><strong><?php echo $_SESSION["store_username" ] ?></strong></u></h3>
				<div class="row">
                    <div class="col-md-4">
                        <div class="card p-30">
							<div class="text-center">
								<i class="fa fa-money-bill-alt f-s-40 color-primary"></i>
                                    <h2><span id="todaysale">0</span></h2>
                                    <p class="m-b-0">Today Sales</p>
                            </div>
                            </div> 
                        </div>
                        
                        
					
                    <div class="col-md-4">
                        <div class="card p-30">
							<div class="text-center">
                                    <i class="ti-dropbox-alt f-s-40 color-info"></i>
                                    <p class="m-b-0"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productdetailmodal">View Product Details</button></p>
                            </div>
                        </div>
                    </div>
					<div class="col-md-4">
                        <div class="card p-30">
							<div class="text-center">
                                    <i class="fa fa-truck-loading f-s-40 color-warning"></i>
                                   <h2></h2>
                                    <p class="m-b-0"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#stockdetailmodal">View Stock Details</button></p>
                        </div>
                    </div>
                </div>
            </div>
           <div id="productdetailmodal" class="modal fade modalscroll mod80p" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Product Detail</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>			
			<div class="modal-body">
				<table id="productdetaildata" class="table table-bordered table-striped"></table>
			</div>
		</div>
	</div>
</div>
           
           <div id="stockdetailmodal" class="modal fade modalscroll mod80p" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Stock Detail</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>			
			<div class="modal-body">
				<table id="stockdetaildata" class="table table-bordered table-striped"></table>
			</div>
		</div>
	</div>
</div>
            
            <!-- End Container fluid  -->
            <!-- footer -->
           
   <?php include('footer.php'); ?>