<?php
include '../includes/connection.php';
if(!empty($_POST["keyword"])) {
$query =$con->query("SELECT position_applied FROM position WHERE position_applied LIKE '%".$_POST["keyword"]."%'");
$result = $query->num_rows;
if(!empty($result)) {
?>
<ul id="name-list">
<?php
while($fetch = mysqli_fetch_array($query)){
?>
<li onClick="selectPosition('<?php echo $fetch["position_applied"]; ?>');"><?php echo $fetch["position_applied"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>
