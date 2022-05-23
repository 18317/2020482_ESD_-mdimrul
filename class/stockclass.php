<?php
include( 'connection.php' );
$date = date( "Y-m-d" );
			
if ( isset( $_POST[ "productrecord" ] ) ) {
	$statement = $connect->prepare( "select * from product where id > 0 and status =1 order by id desc" );
	$statement->execute();
	$data = $statement->fetchAll();
	if ( $data ) {
		?>
		<thead>
			<tr>
				<th>Category</th>
				<th>Brand</th>
				<th>Product Name</th>
				<th>Seller Name</th>
				<th class="w100">Quantity</th>
				<th class="w80">Units</th>
				<th class="w100">Unit Price</th>
				<th class="w150">Total Price</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $data as $row ) {
				?>
			<tr>				
				<td class="d-none productid"><?php echo $row['id']?></td>
				<td class="productcategory"><?php echo $row['catname']?></td>
				<td class="productbrand"><?php echo $row['brandname']?></td>
				<td class="productname"><?php echo $row['productname']?></td>
				<td><input type="text" class="form-control tbsellername"></td>
				<td><input type="text" class="form-control numeric tbquantity" maxlength="5"></td>
				<td class="productunit"><?php echo $row['units']?></td>
				<td><input type="text" class="form-control numeric tbunitprice" maxlength="6"></td>
				<td><input type="text" class="form-control tbtotalprice" readonly></td>
			</tr>
			<?php
			}
			?>
		</tbody>
		<?php
	} else {
		echo "<h3 class='wrngtext bg-warning'>No Product Details Exit..</h3>";
	}
	$connect = null;
}

if ( isset( $_POST[ "stockadd" ] ) ) {
	$item_productid = $_POST[ "productid" ];
	$item_productcategory = $_POST[ "productcategory" ];
	$item_productbrand = $_POST[ "productbrand" ];
	$item_productname = $_POST[ "productname" ];
	$item_tbquantity = $_POST[ "tbquantity" ];
	$item_tbunitprice = $_POST[ "tbunitprice" ];
	$item_tbtotalprice = $_POST[ "tbtotalprice" ];
	$item_tbsellername = $_POST[ "tbsellername" ];
	$length = count( $item_tbtotalprice );
		for ( $i = 0; $i < $length; $i++ ) {
			if(!empty($item_tbtotalprice[$i])){
				try {
					$statement = $connect->prepare("select * from product where id = ?");
					$statement->execute(array($item_productid[$i]));
					$count = $statement->rowCount();
					if ( $count > 0 ) {
						$data = $statement->fetch();
						$stock = $data[ "stock" ];
						$newstock = $stock + $item_tbquantity[$i];
						$connect->beginTransaction();
						$connect->exec("INSERT INTO stockdetails(productid, productname, quantity, unitprice, totalprice, date, sellername) VALUES ('$item_productid[$i]', '$item_productname[$i]', '$item_tbquantity[$i]', '$item_tbunitprice[$i]', '$item_tbtotalprice[$i]', '$date', '$item_tbsellername[$i]')");
						$connect->exec("update product set stock=$newstock, buying=$item_tbunitprice[$i] WHERE id=$item_productid[$i]");
					}					
						$connect->commit();
						echo "done";
				}
					catch ( PDOException $ex ) {
		$error = $ex->getMessage();
		if ( $error == "23000" ) {
			echo "Duplicate";
		} else {
			echo 'error';
		}	 
	}		
			}
			else{	echo "required";}
		}	
		$connect = null;
}

if ( isset( $_POST[ "stockrecord" ] ) ) {
	$currdate = $_POST['day'];
	$query = 'SELECT product.catname, product.brandname, stockdetails.productname, stockdetails.sellername, stockdetails.quantity, stockdetails.unitprice, stockdetails.totalprice, stockdetails.date FROM product INNER JOIN stockdetails ON product.id = stockdetails.productid where stockdetails.date = ? order by stockdetails.id desc';
	$statement = $connect->prepare($query);
	$statement->execute(array($currdate));
	$data = $statement->fetchAll();
	if ( $data ) {
		?>
		<thead>
			<tr>
				<th>Category</th>
				<th>Brand</th>
				<th>Product Name</th>
				<th>Seller Name</th>
				<th class="w100">Quantity</th>
				<th class="w150">Unit Price</th>
				<th class="w150">Total Price</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $data as $row ) {
				?>
			<tr>				
				<td><?php echo $row['catname']?></td>
				<td><?php echo $row['brandname']?></td>
				<td><?php echo $row['productname'];?></td>				
				<td><?php echo $row['sellername']?></td>
				<td><?php echo $row['quantity']?></td>
				<td><?php echo $row['unitprice']?></td>
				<td><?php echo $row['totalprice']?></td>
			</tr>
			<?php
			}
			?>
		</tbody>
		<?php
	} else {
		echo "<h3 class='wrngtext bg-warning'>No Product Details Exit..</h3>";
	}
	$connect = null;
}

if ( isset( $_POST[ "currentstockrecord" ] ) ) {
	$statement = $connect->prepare( "select * from product where id > 0 and status = '1' and stock > 0 order by id desc" );
	$statement->execute();
	$data = $statement->fetchAll();
	if ( $data ) {
		?>
		<thead>
			<tr>
				<th>Category</th>
				<th>Brand</th>
				<th>Product Name</th>
				<th class="w100">Quantity</th>
				<th class="w80">Units</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $data as $row ) {
				?>
			<tr>
				<td><?php echo $row['catname']?></td>
				<td><?php echo $row['brandname']?></td>
				<td><?php echo $row['productname'];?></td>
				<td><?php echo $row['stock']?></td>
				<td><?php echo $row['units']?></td>
			</tr>
			<?php
			}
			?>
		</tbody>
		<?php
	} else {
		echo "<h3 class='wrngtext bg-warning'>No Product Details Exit..</h3>";
	}
	$connect = null;
}

?>