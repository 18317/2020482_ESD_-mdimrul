<?php
include( 'connection.php' );

//get the product list from product table fro enter the price later on
if ( isset( $_POST[ "productpricerecord" ] ) ) {
	$statement = $connect->prepare( "select * from product where id > 0 and status =1 and stock > 0 order by id desc" );
	$statement->execute();
	$data = $statement->fetchAll();
	if ( $data ) {
		?>
		<thead>
			<tr>
				<th>Category</th>
				<th>Brand</th>
				<th>Product Name</th>				
				<th class="w80">In Stock</th>
				<th class="w120">Latest Price</th>
				<th class="w150">Sell Price</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $data as $row ) {
				?>
			<tr>				
				<td class="d-none productid"><?php echo $row['id']?></td>
				<td ><?php echo $row['catname']?></td>
				<td ><?php echo $row['brandname']?></td>
				<td class="productname"><?php echo $row['productname']; if($row['size']!= ""){echo " (". $row['size'] .")"; } else {echo " ";}?></td>							
				<td class="text-center"><?php echo $row['stock']?></td>
				<td class="text-center"><?php echo $row['buying']?></td>
				<td><input type="text" class="form-control numeric tbpriceselling" maxlength="6" value="<?php echo $row['selling']?>"></td>	
			</tr>
			<?php
			}
			?>
		</tbody>
		<?php
	} else {
		echo "<h3 class='wrngtext bg-warning'>No Price List available..</h3>";
	}
	$connect = null;
}

//update the product selling price 
if ( isset( $_POST[ "updatesellingprice" ] ) ) {
	$item_productid = $_POST[ "productid" ];
	$item_tbpriceselling = $_POST[ "tbpriceselling" ];
	$length = count( $item_tbpriceselling );
		for ( $i = 0; $i < $length; $i++ ) {
				try {
					$statement = $connect->prepare("update product set selling=? WHERE id=?");
					$statement->execute(array($item_tbpriceselling[$i], $item_productid[$i]));
					if ( $statement ) {
			echo "update". $item_tbpriceselling[$i];
		} else {
			echo "error";
		}
				}
					catch ( PDOException $ex ) {
		$error = $ex->getMessage();
		if ( $error == "23000" ) {
			echo "Duplicate";
		} else {
			echo 'error';
		}
		$connect = null;		 
	}
			
		}
}

?>