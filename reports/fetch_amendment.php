<?php 
	include('../includes/connection.php'); 
    include('../includes/functions.php');
	foreach($_POST as $var=>$value)
	$$var = mysqli_real_escape_string($con, $value);
	$personal_id=$id;
	$sql=mysqli_query($con,"SELECT * FROM amendment WHERE personal_id = '$personal_id' ORDER BY date_effectivity ASC");
	$num_count = mysqli_num_rows($sql);
	while($row=mysqli_fetch_array($sql)){
		$fname=getInfo($con, 'fname', 'personal_data', 'personal_id', $row['personal_id']);
		$lname=getInfo($con, 'lname', 'personal_data', 'personal_id', $row['personal_id']);
		$fullname=sanitize(utf8_encode($fname." ".$lname));
?>
	<?php if($num_count!=0){ ?>
		<a href="amendment_form_print.php?amend_id=<?php echo $row['amendment_id']; ?>" target="_blank" class="btn btn-sm btn-primary btn-block " style="text-align: left">
			<p style="margin:0px;font-size: 14px"><b><?php echo $fullname; ?></b> (Amendment Form <b><?php echo $row['date_effectivity']; ?><b>)</p>
		</a>
	<?php } else { ?>
	<center>
		No Available Data
	</center>
<?php } } ?>