<?php
session_start();
include( 'connection.php' );

//login in to system by entering credentials like username and password
if ( isset( $_POST[ "login" ] ) ) {
	try {
		$result = $connect->prepare("SELECT * FROM user WHERE username = ? AND password = ? and status = '1'");
		$result->execute( array( $_POST[ "signinusername" ], $_POST[ "signinpassword" ])  );
		$count = $result->rowCount();
		if ( $count > 0 ) {
			$row = $result->fetch();
			$_SESSION["store_userid" ] = $row[ "id" ];
			$_SESSION["store_username" ] = $row[ "username" ];
			$_SESSION["store_fullname" ] = $row[ "fullname" ];
			$_SESSION["store_role" ] = $row[ "role" ];
			echo "login";
		} else {
			echo "incorrect";
		}
	} catch ( PDOException $error ) {
		echo 'Error';
	}
}

?>