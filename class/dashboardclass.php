<?php
include( 'connection.php' );
$t1 = $date . ' 00:00:00';
$t2 = $date . ' 23:59:59';

if ( isset( $_POST[ "todaysale" ] ) ) {
	$statement = $connect->prepare( "SELECT sum(totalamount) as sum FROM invoice WHERE datetime BETWEEN '$t1' AND '$t2'" );
	$statement->execute();
	$count = $statement->rowCount();
	if ( $count > 0 ) {
		$data = $statement->fetch();
		$sum = $data['sum'];
		echo $sum;
	} 
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