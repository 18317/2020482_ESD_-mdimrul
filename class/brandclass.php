<?php
session_start();
include( 'connection.php' );

if ( isset( $_POST[ "CategoryList" ] ) ) {
	$statement = $connect->prepare( "select * from attributes where type = 'category' and id > 0 and status = 1" );
	$statement->execute();	
	$count = $statement->rowCount();
	if ( $count > 0 ) {
		echo '<option disabled selected>Select Category</option>';
		$data = $statement->fetchAll();
		foreach ( $data as $row ) {
			?>
			<option value="<?php echo $row['id']?>"><?php echo $row['name']; ?></option>
<?php
		}
	}
	else {
		echo "<option>No Category available</option>";
	}
	$connect = null;
}

if ( isset( $_POST[ "addbranddetail" ] ) ) {
	$action = $_POST[ 'tbaction' ];
	$name = strtoupper($_POST[ 'tbbrandname' ]);
	$catid = strtoupper($_POST[ 'ddcategory' ]);
	$catname = strtoupper($_POST[ 'tbcategory' ]);
	$status = $_POST['ddstatus'];
	$type = "brand";
	$attunique = $type  . $name . $catid;
	if ( $action == "add" ) {
		try {
			$statement = $connect->prepare( "INSERT INTO  attributes(type, name, catid, catname, attunique, status)  VALUES (?,?,?,?,?,?)" );
			$statement->execute( array($type, $name, $catid, $catname, $attunique, $status ) );
			if ( $statement ) {
				echo "add";
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
	else if ( $action == "update" ) {
		try {
			if($status == '0') $mainstatus = '2'; else $mainstatus = '1';
			$rowid = $_POST['tbrowid'];
			$connect->beginTransaction();
			$connect->exec("update attributes set status='$status' where id='$rowid'");
			$connect->exec("update product set status='$mainstatus' WHERE brandid='$rowid'");
			$connect->commit();
				echo "update";
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

if ( isset( $_POST[ "brandrecord" ] ) ) {
	$statement = $connect->prepare( "select * from attributes where id > 0 and type = 'brand' order by status = '1' desc" );
	$statement->execute();
	$data = $statement->fetchAll();
	if ( $data ) {
		?>
		<thead>
			<tr>
				<th>Category</th>
				<th>Brand Name</th>
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
				<td class="nowrap"><?php echo $row['catname']?></td>
				<td class="nowrap"><?php echo $row['name']?></td>
				<td> <?php if($row['status']==1){echo '<span class="text-success">Active</span>';} elseif ($row['status']==2){echo "<span class='text-danger'>N/A</span>";} else{echo "<span class='text-danger'>InActive</span>";}?></td>
				<td class="text-center"><?php if($row['status']!=2){echo '<i class="fa fa-edit" data-toggle="modal" data-target="#branddetailmodal"></i>';} else {echo '<i class="text-danger fa fa-times"</i>';}?></td>
					
				</td>
			</tr>
			<?php
			}
			?>
		</tbody>
		<?php
	} else {
		echo "<h3 class='wrngtext bg-warning'>No Brand Exit..</h3>";
	}
	$connect = null;
}


?>