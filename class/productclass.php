<?php
include( 'connection.php' );

if ( isset( $_POST[ "addproductdetail" ] ) ) {
	$action = $_POST[ 'tbaction' ];
	$catid = $_POST['ddcategory'];
	$brandid = $_POST['ddbrand'];
	$prdname = strtoupper($_POST[ 'tbproductcode' ]);
	$prddesc = $_POST[ 'tbproductdescription' ];
	$prdunit = $_POST[ 'tbproductunit' ];
	$prdcat = $_POST[ 'tbcategory' ];
	$prdbrand = $_POST[ 'tbbrand' ];
	$status = $_POST[ 'ddstatus' ];
	if ( $action == "add" ) {
		try {
			$statement = $connect->prepare( "INSERT INTO  product(catname, catid, brandname, brandid, productname, productdescrpt, units, status)  VALUES ('$prdcat', '$catid', '$prdbrand', '$brandid', '$prdname', '$prddesc', '$prdunit', '$status')" );
			$statement->execute();
			if ( $statement ) {
				echo "add";
			}
		} catch ( PDOException $ex ) {
			$error = $ex->getMessage();
			if ( $error == "23000" ) {
				echo "duplicate";
			} else {
				echo $error.'error';
			}		 
		}
	} 	
	else if ( $action == "update" ) {
		try {
			$rowid = $_POST['tbrowid'];
			$statement = $connect->prepare( "update product set productname = '$prdname', productdescrpt = '$prddesc', units = '$prdunit', status= '$status' where id= '$rowid'");
			$statement->execute();
			if ( $statement ) {
				echo "update";
			}
		} catch ( PDOException $ex ) {
			$error = $ex->getCode();
			if ( $error == "23000" ) {
				echo "duplicate";
			} else {
				echo 'error';
			}		 
		}
	} 	
			$connect = null;
}

if ( isset( $_POST[ "productrecord" ] ) ) {
	$statement = $connect->prepare( "select * from product where id > 0 order by status = '1' desc" );
	$statement->execute();
	$data = $statement->fetchAll();
	if ( $data ) {
		?>
		<thead>
			<tr>
				<th>Category</th>
				<th>Brand</th>
				<th>Product Code</th>
				<th class="w100">Units</th>
				<th class="w80">Status</th>
				<th class="w80">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $data as $row ) {
				?>
			<tr>
				<td class="d-none"><?php echo $row['id']?></td>
				<td ><?php echo $row['catname']?></td>
				<td ><?php echo $row['brandname']?></td>
				<td ><?php echo $row['productname']?></td>
				<td class="d-none"><?php echo $row['productdescrpt']?></td>
				<td ><?php echo $row['units']?></td>
				<td> <?php if($row['status']==1){echo '<span class="text-success">Active</span>';} elseif ($row['status']==2){echo "<span class='text-danger'>N/A</span>";} else{echo "<span class='text-danger'>InActive</span>";}?></td>
				<td class="text-center" id="<?php echo $row['id']?>"><?php if($row['status']!=2){echo '<i class="fa fa-edit" data-toggle="modal" data-target="#productdetailmodal"></i><i class="fa fa-trash text-danger" data-toggle="modal" data-target="#deletemodal"></i>';} else {echo '<i class="text-danger fa fa-times"</i>';}?></td>
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

if ( isset( $_POST[ "getbrand" ] ) ) {
	$catid = $_POST['categoryid'];
	$statement = $connect->prepare( "select * from attributes where catid = ? and type = 'brand'" );
	$statement->execute(array($catid));	
	$count = $statement->rowCount();
	if ( $count > 0 ) {
		echo '<option disabled selected>Select Brand</option>';
		$data = $statement->fetchAll();
		foreach ( $data as $row ) {
			?>
			<option value="<?php echo $row['id']?>"><?php echo $row['name']; ?></option>
<?php
		}
	}
	else {
		echo "<option>No Brand available</option>";
	}
	$connect = null;
}

if ( isset( $_POST[ "delete" ] ) ) {
	try {
		$statement = $connect->prepare( "delete from product where id=?" );
		$result = $statement->execute( array( $_POST[ "deleteid" ] ) );
		echo "delete";
	} catch ( PDOException $ex ) {
		echo "Error";
	}
	$connect = null;
}


?>