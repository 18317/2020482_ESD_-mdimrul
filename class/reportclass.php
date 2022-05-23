<?php
session_start();
include( 'connection.php' );


//Get Stock report from table where id > 0 and status = 1
if ( isset( $_POST[ "stockrecord" ] ) ) {
	$todate = $_POST['todate'];
	$fromdate = $_POST['fromdate'];
	$statement = $connect->prepare( "select * from stockdetails where date between '$todate' and '$fromdate';" );
	$statement->execute();
	$data = $statement->fetchAll();
	if ( $data ) {
		?>
		<thead>
			<tr>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Total Price</th>				
				<th>Seller Name</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $data as $row ) {
				?>
			<tr>
				<td><?php echo $row['productname']?></td>
				<td><?php echo $row['quantity']?></td>
				<td><?php echo $row['unitprice']?></td>
				<td><?php echo $row['totalprice']?></td>
				<td><?php echo $row['sellername']?></td>
				<td><?php echo $row['date']?></td>
			</tr>
			<?php
			}
			?>
		</tbody>
		<?php
	} else {
		echo "<h3 class='wrngtext bg-warning'>No Details Exit..</h3>";
	}
	$connect = null;
}


//Get Receipt report from 2 table by inner join
//invoice tabe & invoicedetail table both these 2 table are used as inner join

if ( isset( $_POST[ "receiptrecord" ] ) ) {
		$todate = $_POST[ 'todate' ];
		$fromdate = $_POST[ 'fromdate' ];
	$fromdate = date( "Y-m-d", strtotime( "$fromdate +1 day" ) );
	$statement = $connect->prepare("select * from invoice where datetime between '$todate' and '$fromdate'");
	$statement->execute();
	$data = $statement->fetchAll();
	if ( $data ) {
		?>
		<thead>
			<tr>				
				<th>Invoice #</th>
				<th>Total Amount</th>
				<th>Discount</th>
				<th>Paid Amount</th>
				<th>Date & Time</th>
				<th class="w80">Details</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $data as $row ) {
				?>
			<tr>
				<td><?php echo $row['id']?></td>
				<td><?php echo $row['totalamount']?></td>
				<td><?php echo $row['discount']?></td>
				<td><?php echo $row['payableamount']?></td>
				<td><?php echo $row['datetime']?></td>
				<td class="text-center"><?php echo '<i class="fa fa-eye" data-toggle="modal" data-target="#receiptdetailmodal"></i>' ?></td>
			</tr>
			<?php
			}
			?>
		</tbody>
		<?php
	} else {
		echo "<h3 class='wrngtext bg-warning'>No Details Exit..</h3>";
	}
	$connect = null;
}

if ( isset( $_POST[ "receiptsinglerecord" ] ) ) {
	$invoiceid = $_POST[ 'invoiceid' ];
	$statement = $connect->prepare( "select * from invoicedetail where invoiceid=? order by id desc" );
	$statement->execute( array( $invoiceid ) );
	$data = $statement->fetchAll();
	if ( $data ) {
		?>
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
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $data as $row ) {
				?>
			<tr>
				<td class="d-none"><?php echo $row['id']?></td>
				<td><?php echo $row['productname']?></td>
				<td><?php echo $row['productdetail']?></td>
				<td><?php echo $row['description']?></td>
				<td><?php echo $row['stock']?></td>
				<td><?php echo $row['quantity']?></td>
				<td><?php echo $row['units']?></td>
				<td><?php echo $row['rate']?></td>
				<td><?php echo $row['finalrate']?></td>
				<td><?php echo $row['totalprice']?></td>
			</tr>
			<?php
			}
			?>
		</tbody>
		<?php
	} else {
		echo "<h3 class='wrngtext bg-warning'>No Details Exit..</h3>";
	}
	$connect = null;
}
	
	
?>