<?php
require_once("../includes/connection.php");
$id = $_POST['id'];
if($id!='')
{
$city_result = $con->query('select * from cities where province_id='.$id.'');
$options = "<option value=''>Select City</option>";
while($row = $city_result->fetch_assoc()) {
$options .= "<option value='".$row['id']."'>".$row['name']."</option>";
}
echo $options;
}?>


