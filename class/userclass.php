<?php
session_start();
include( 'connection.php' );

if ( isset( $_POST[ "adduser" ] ) ) {
	$action = $_POST[ 'tbaction' ];
	$fullname = $_POST[ 'tbfullname' ];
	$username = $_POST[ 'tbusername' ];	
	$password = $_POST[ 'tbpassword' ];
	$password = $_POST[ 'tbpassword' ];
	$usertype = $_POST[ 'ddusertype' ];
	$status = $_POST[ 'ddstatus' ];
	if ( $action == "add" ) {	
	try {
			$statement = $connect->prepare( "INSERT INTO user (fullname, username, password, role, status)  VALUES ('$fullname', '$username', '$password', '$usertype')" );
			$result = $statement->execute();
			echo "insert";
		} catch ( PDOException $ex ) {
			$error = $ex->getCode();
			if ( $error == "23000" ) {
				echo "Duplicate";
			} else {
				echo "Error";
			}
		}
	}	
	if ( $action == "update" ) {
		$rowid = $_POST['tbrowid'];
		try {
			$statement = $connect->prepare( "update user set fullname = '$fullname', password = '$password', role = '$usertype', status = '$status' where id = '$rowid'" );
			$result = $statement->execute();
			echo "update";
		} catch ( PDOException $ex ) {
			$error = $ex->getCode();
			if ( $error == "23000" ) {
				echo "Duplicate";
			} else {
				echo "Error";
			}		 
		}
	}	
	$connect = null;
}

if ( isset( $_POST[ "deleteitem" ] ) ) {
	$rowid = $_POST[ 'rowid' ];
	try {
		$statement = $connect->prepare("delete from tbluser where id = '$rowid'");
		$statement->execute();
		echo "delete";
	} catch ( PDOException $ex ) {
		echo "Error";
	}
	$connect = null;		 
}

if ( isset( $_POST[ "userrecord" ] ) ) {
	$statement = $connect->prepare( "SELECT * from user order by id desc" );
	$statement->execute();
	$data = $statement->fetchAll();
	if ( $data ) {
		?>
		<thead>
			<tr>
				<th>Name</th>
				<th>UserName</th>
				<th>Password</th>
				<th>Role</th>
				<th>Status</th>
				<th class="w80">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $data as $row ) {?>
			<tr>
			<td class="d-none"><?php echo $row['id']?></td>			
				<td><?php echo $row['fullname'] ?></td>
				<td><?php echo $row['username'] ?></td>
				<td><?php echo $row['password'] ?></td>
				<td><?php echo $row['role'] ?></td>
				<td> <?php if($row['status']==1){echo '<span class="text-success">Active</span>';} else{echo "<span class='text-danger'>InActive</span>";}?></td>
				<td class="text-center"> <?php if($row['id']!="-1"){ ?><i class="fa fa-edit" data-toggle="modal" data-target="#userdetailmodal" id="<?php echo $row['id']?>"></i><i class="fa fa-trash text-danger" data-toggle="modal" data-target="#deletemodal" id="<?php echo $row['id']?>"></i><?php } ?></td>
			</tr>
			<?php
			}
			?>
		</tbody> <?php
	} else {
		echo "<h3 class='wrngtext bg-warning'>No Data available..</h3>";
	}
	$connect = null;
}

if ( isset( $_POST[ "updatesetting" ] ) ) {
	$fullname = $_POST[ 'tbsettinguserfullname' ];
	$userid = $_SESSION["store_userid" ];
	$password = $_POST[ 'tbsettinguserpassword' ];
	if(empty($password))
	{
		$query = "update user set fullname = '$fullname' where id = '$userid'";
	}
	else
	{
		$query = "update user set fullname = '$fullname', password = '$password' where id = '$userid'";
	}
		try {
			$statement = $connect->prepare($query);
			$result = $statement->execute();
			session_start();
			$_SESSION["store_fullname" ] = $fullname;
			echo "update";
		} catch ( PDOException $ex ) {
				echo "Error";
			}		 	
	$connect = null;
}

if ( isset( $_POST[ "delete" ] ) ) {
	try {
		$statement = $connect->prepare( "delete from user where id=?" );
		$result = $statement->execute( array( $_POST[ "deleteid" ] ) );
		echo "delete";
	} catch ( PDOException $ex ) {
		echo "Error";
	}
	$connect = null;
}

?>