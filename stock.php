<?php
$pagetitle = "Stock Details";
include( 'header.php' );
 include('pagesidebar.php'); ?>
		
			
<div class="container-fluid">
                <div class="row">					
					<div class="col-md-6 col-6">
                        <div class="card bg-primary p-30">
                            <button type="button" class="btn btn80p" data-toggle="modal" data-target="#productdetailmodal" id="btnaddprdmod">Enter New Stock</button>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="card bg-dark p-30">
                            <button type="button" class="btn btn80p" data-toggle="modal" data-target="#prevproductdetailmodal" id="btnviewstock">View Current Stock</button>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="card bg-info p-30">
                            <button type="button" class="btn btn80p" data-toggle="modal" data-target="#prevproductdetailmodal" id="btntodaystock">View Today Stock</button>
                        </div>
                        </div>
                      <div class="col-md-6 col-6">
                             <div class="card bg-secondary p-30">
                            <button type="button" class="btn btn80p" data-toggle="modal" data-target="#prevproductdetailmodal" id="btnyeststock">View Yesterday Stock</button>
                        </div>
                    </div>
                </div>
            </div>

<div id="productdetailmodal" class="modal fade modalscroll mod80p" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Enter Stock Detail</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>			
			<div class="modal-body">
				<div class="d-flex m-b-10">
						<label class="mrg-tp10">Search:</label>
						<input type="text" id="tbsearch1" class="form-control m-l-5 w200">
					</div>
				<table id="productdetaildata" class="table table-bordered table-striped">
	</table>
			</div>
			<div class="modal-footer">
				<label class="totalamountlabel">Total Amount: <span id="tbtotalamount">0</span></label>
				<button type="button" class="btn bg-success" id="btnaddstock">Add Stock</button>
			</div>
		</div>
	</div>
</div>


<div id="prevproductdetailmodal" class="modal fade modalscroll mod80p" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Stock Detail (<span id="stockdate"></span>)</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="d-flex m-b-10">
						<label class="mrg-tp10">Search:</label>
						<input type="text" id="tbsearch2" class="form-control m-l-5 w200">
					</div>
				<table id="prevproductdetaildata" class="table table-bordered table-striped">
	</table>
			</div>
		</div>
	</div>
</div>
		</div>
		</div>
		</div>


<?php include('footer.php'); ?>