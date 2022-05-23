<?php
session_start();
include( 'connection.php' );

if ( isset( $_POST[ "addcategorydetail" ] ) ) {
	$action = $_POST[ 'tbaction' ];
	$name = strtoupper($_POST[ 'tbcategoryname' ]);
	$type = "category";
	$status = $_POST['ddstatus'];		
	$attunique = $type  . $name;
	if ( $action == "add" ) {
		try {
			$statement = $connect->prepare( "INSERT INTO  attributes(type, name, attunique,status)  VALUES (?,?,?,?)" );
			$statement->execute( array($type, $name, $attunique, $status ) );
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
	} elseif ( $action == "update" ) {
		try {
			if($status == '0') $mainstatus = '2'; else $mainstatus = '1';
			$rowid = $_POST['tbrowid'];
			$connect->beginTransaction();
			$connect->exec("update attributes set status='$status' where id='$rowid'");
			$connect->exec("update attributes set status='$mainstatus' WHERE catid='$rowid'");
			$connect->exec("update product set status='$mainstatus' WHERE catid='$rowid'");
			$connect->commit();
				echo "update";
		} catch ( PDOException $ex ) {
			//echo  $ex->getMessage();
			$error = $ex->getCode();
			if ( $error == "23000" ) {
				echo "duplicate";
			} else {
				echo 'error'.$ex->getMessage();
			}
			//echo $ex->errorInfo();		 
		}
	}	
			$connect = null;
}

if ( isset( $_POST[ "categoryrecord" ] ) ) {
	$statement = $connect->prepare( "select * from attributes where id > 0 and type = 'category' order by status = '1' desc");
	$statement->execute();
	$data = $statement->fetchAll();
	if ( $data ) {
		?>
		<thead>
			<tr>
				<th>Category Name</th>
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
				<td class="nowrap"><?php echo $row['name']?></td>
				<td> <?php if($row['status']==1){echo '<span class="text-success">Active</span>';} elseif($row['status']==0){echo "<span class='text-danger'>InActive</span>";};?></td>
				<td class="text-center"><i class="fa fa-edit" data-toggle="modal" data-target="#categorydetailmodal"></i>
				</td>
			</tr>
			<?php
			}
			?>
		</tbody>
		<?php
	} else {
		echo "<h3 class='wrngtext bg-warning'>No Category Exit..</h3>";
	}
	$connect = null;
}

?>