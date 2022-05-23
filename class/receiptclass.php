<?php
include( 'connection.php' );

if ( isset( $_POST[ "recptno" ] ) ) {
	$statement = $connect->prepare( "select * from invoice order by id desc limit 1" );
	$statement->execute();
	$count = $statement->rowCount();
	if ( $count > 0 ) {
		$data = $statement->fetch();
		$id = $data[ 'id' ];
		echo $id + 1;
	} else {
		echo '1';
	}
}

if ( isset( $_POST[ "getproductname" ] ) ) {
	$statement = $connect->prepare( "select * from product where stock > 0" );
	$statement->execute();
	$count = $statement->rowCount();
	if ( $count > 0 ) {
		echo '<option disabled selected>Select Product</option>';
		$data = $statement->fetchAll();
		foreach ( $data as $row ) {
			echo '<option value="' . $row[ 'id' ] . '">' . $row[ 'productname' ] . '</option>';
		}
	} else {
		echo "<option>No Product available</option>";
	}
	$connect = null;
}

if ( isset( $_POST[ "getproddetail" ] ) ) {
	$prodid = $_POST[ 'prodid' ];
	$statement = $connect->prepare( "select * from product where stock > 0 and id = ?" );
	$statement->execute( array( $prodid ) );
	$count = $statement->rowCount();
	if ( $count > 0 ) {
		$data = $statement->fetch();
		$data[ 'category' ] = $data[ 'catname' ];
		$data[ 'categoryid' ] = $data[ 'catid' ];
		$data[ 'brand' ] = $data[ 'brandname' ];
		$data[ 'brandid' ] = $data[ 'brandid' ];
		$data[ 'description' ] = $data[ 'productdescrpt' ];
		$data[ 'units' ] = $data[ 'units' ];
		$data[ 'selling' ] = $data[ 'selling' ];
		$data[ 'stock' ] = $data[ 'stock' ];
	}
	echo json_encode( $data );
	$connect = null;
}

if ( isset( $_POST[ "savereceipt" ] ) ) {
	$item_receiptproductid = $_POST[ "recproductlist" ];
	$item_receiptproductname = $_POST[ "recproductlisttext" ];
	$item_receiptcategoryid = $_POST[ "reccategorylist" ];
	$item_receiptbrandid = $_POST[ "recbrandlist" ];
	$item_recproductdetails = $_POST[ "recproductdetails" ];
	$item_recproductdescrip = $_POST[ "recproductdescrip" ];
	$item_recproductstock = $_POST[ "recproductstock" ];
	$item_receiptquantity = $_POST[ "recproductquantity" ];
	$item_recproductunit = $_POST[ "recunits" ];
	$item_recproductprice = $_POST[ "recprice" ];
	$item_recproductfinalprice = $_POST[ "recfinalprice" ];
	$item_receipttotalprice = $_POST[ "rectotalprice" ];
	$invoiceid = $_POST[ 'invoiceid' ];
	$totalamount = $_POST[ 'totalamount' ];
	$discount = $_POST[ 'discount' ];
	$payableamount = $_POST[ 'payableamount' ];
	$remainingamount = $_POST[ 'remainingamount' ];
	$invoiceinsert = "0";
	try {
		$length = count( $item_receiptproductname );
		for ( $i = 0; $i < $length; $i++ ) {
			if ( !empty( $item_receiptproductname[ $i ] ) ) {
				$statement = $connect->prepare( "select * from product where id = ?" );
				$statement->execute( array( $item_receiptproductid[ $i ] ) );
				$count = $statement->rowCount();
				if ( $count > 0 ) {
					$data = $statement->fetch();
					$stock = $data[ "stock" ];
					$newstock = $stock - $item_receiptquantity[ $i ];
					$connect->beginTransaction();
					if ( $invoiceinsert == "0" ) {
						$connect->exec( "INSERT INTO invoice(id, totalamount, discount, payableamount, datetime) VALUES ('$invoiceid', '$totalamount', '$discount', '$payableamount', '$datetime')" );
						$invoiceinsert = "1";
					}	
					$connect->exec( "INSERT INTO invoicedetail(invoiceid, productname, productid, categoryid, brandid, productdetail, description, stock, quantity, units, rate, finalrate, totalprice, datetime) VALUES ('$invoiceid','$item_receiptproductname[$i]', '$item_receiptproductid[$i]', '$item_receiptcategoryid[$i]', '$item_receiptbrandid[$i]', '$item_recproductdetails[$i]',  '$item_recproductdescrip[$i]', '$item_recproductstock[$i]', '$item_receiptquantity[$i]', '$item_recproductunit[$i]', '$item_recproductprice[$i]', '$item_recproductfinalprice[$i]', '$item_receipttotalprice[$i]', '$datetime')" );
					$connect->exec( "update product set stock=$newstock WHERE id=$item_receiptproductid[$i]" );
				}
				$connect->commit();
				echo "done";
			} else {
				echo "required";
			}
		}
	} catch ( PDOException $ex ) {
		$error = $ex->getCode();
		if ( $error == "23000" ) {
			echo "Duplicate";
		} else {
			echo $error;
		}
	}
	$connect = null;
}

if ( isset( $_POST[ "receiptrecord" ] ) ) {
	if ( $_POST[ "defaultrecord" ] ) {
		$query = 'select * from invoice where datetime > (DATE(NOW()) - INTERVAL 10 DAY) order by id desc';
	} 
	else if ( $_POST[ 'customrecord' ] ) {
		$todate = $_POST[ 'todate' ];
		$fromdate = $_POST[ 'fromdate' ];
		$fromdate = date( "Y-m-d", strtotime( "$fromdate +1 day" ) );
		$query = "select * from invoice where datetime between '$todate' and '$fromdate'";
	}
	$statement = $connect->prepare( $query );
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