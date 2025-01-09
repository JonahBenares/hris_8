<?php
include '../includes/connection.php';
if(!empty($_POST["college"])) {
	$query =$con->query("SELECT college FROM educational_background WHERE college LIKE '%".$_POST["college"]."%'");
	$result = $query->num_rows;
	if(!empty($result)) {
	?>
	<ul id="name-school">
	<?php
	while($fetch = mysqli_fetch_array($query)){
		$school = $fetch["college"];
	?>
	<li onClick="selectCollege('<?php echo $school; ?>');"><?php echo $school; ?></li>
	<?php } ?>
	</ul>
<?php } } 

if(!empty($_POST["highschool"])) {
	$query =$con->query("SELECT highschool FROM educational_background WHERE highschool LIKE '%".$_POST["highschool"]."%'");
	$result = $query->num_rows;
	if(!empty($result)) {
	?>
	<ul id="name-school">
	<?php
	while($fetch = mysqli_fetch_array($query)){
		$school = $fetch["highschool"];
	?>
	<li onClick="selectHS('<?php echo $school; ?>');"><?php echo $school; ?></li>
	<?php } ?>
	</ul>
<?php } } 

if(!empty($_POST["elementary"])) {
	$query =$con->query("SELECT elementary FROM educational_background WHERE elementary LIKE '%".$_POST["elementary"]."%'");
	$result = $query->num_rows;
	if(!empty($result)) {
	?>
	<ul id="name-school">
	<?php
	while($fetch = mysqli_fetch_array($query)){
		$school = $fetch["elementary"];
	?>
	<li onClick="selectElem('<?php echo $school; ?>');"><?php echo $school; ?></li>
	<?php } ?>
	</ul>
<?php } } 

if(!empty($_POST["postgrad"])) {
	$query =$con->query("SELECT post_grad FROM educational_background WHERE post_grad LIKE '%".$_POST["postgrad"]."%'");
	$result = $query->num_rows;
	if(!empty($result)) {
	?>
	<ul id="name-school">
	<?php
	while($fetch = mysqli_fetch_array($query)){
		$school = $fetch["post_grad"];
	?>
	<li onClick="selectPostgrad('<?php echo $school; ?>');"><?php echo $school; ?></li>
	<?php } ?>
	</ul>
<?php } } ?>
