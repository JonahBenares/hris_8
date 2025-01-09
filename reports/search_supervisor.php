<?php
include '../includes/connection.php';
include '../includes/functions.php';
if(!empty($_POST["keyword"])) {
$query =$con->query("SELECT lname, fname, mname, name_ext FROM personal_data WHERE (lname LIKE '%".$_POST["keyword"]."%' OR fname LIKE '%".$_POST["keyword"]."%' OR mname LIKE '%".$_POST["keyword"]."%' OR name_ext LIKE '%".$_POST["keyword"]."%') AND status = 'Active'");
$result = $query->num_rows;
if(!empty($result)) {
?>
<ul id="name-list">
<?php
while($fetch = mysqli_fetch_array($query)){
	$fullname = sanitize(utf8_encode($fetch["fname"] . " " . $fetch["mname"] . " " . $fetch["lname"] . " " . $fetch["name_ext"]));
?>
<li onClick="selectSupervisor('<?php echo $fullname; ?>');"><?php echo $fullname; ?></li>
<?php } ?>
</ul>
<?php } } ?>
