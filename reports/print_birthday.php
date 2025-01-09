<?php 

    include('../template/header.php'); 
    include('../includes/connection.php');
    include('../includes/functions.php');
    if(isset($_GET['birthday'])){
        $birthday = $_GET["birthday"];
    } else{
        $birthday = '';
    }

?>
<style type="text/css">
    body {
        background: rgb(204,204,204); 
        color: #000;
/*        font-family: sans-serif, Arial;*/
    }
    h1,h2,h3,h4,h5,h6{color: #000}
    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }
    page[size="A4"] {  
        width: 21cm;
        height: 29.7cm; 
    }
    page[size="A4"][layout="landscape"] {
        width: 29.7cm;
        height: 20.95cm;  
    }
    page[size="A3"] {
        width: 29.7cm;
        height: 42cm;
    }
    page[size="A3"][layout="landscape"] {
        width: 42cm;
        height: 29.7cm;  
    }
    page[size="A5"] {
        width: 14.8cm;
        height: 21cm;
    }
    page[size="A5"][layout="landscape"] {
        width: 21cm;
        height: 14.8cm;  
    }
    @media print {
        body, page {
            margin: 0;
            box-shadow: 0;
/*            display: block;*/
        }
        .celebrants{
            box-shadow: 1px 4px 5px 0px #1212125c!important;
        }
        .emp-image{
            box-shadow: 0px 0px 4px 0px #bebebe!important;
        }
        .calendar{
            box-shadow: -2px 3px 4px 0px #12121263!important;
        }
        /*table td{ border:1px solid #fff!important; }*/
        .bor-btm{border-bottom:1px solid #000!important;}
        .bor-all{
            border: 1px solid #000;
        }
        #printbutton, #br, #br1{display: none}
        table{border:1px solid #000!important;}
    }
    .btn-w100{
        width: 100px
    }
    .btn-round{
        border-radius: 20px
    }
    
</style>
<script>
    function goBack() {
      window.history.back();
    }
</script>
<div class="animated fadeInDown p-t-20" id="printbutton">
    <center>
        <a onclick="goBack()" class="btn btn-warning text-white btn-w100 btn-round">Back</a>
        <a href="" class="btn btn-success btn-w100 btn-round" onclick="window.print()">Print</a>
    </center>
    <br>
</div>
<?php 
    $mysql=mysqli_query($con,"SELECT personal_id,photo_upload,lname, fname, name_ext, bdate, day(bdate) AS bday FROM personal_data WHERE MONTH(bdate) = '$birthday' AND status = 'Active' ORDER BY bday ASC");
    $num_rows_compare=mysqli_num_rows($mysql);
?>
<page size="A4" layout="landscape">
    <div style="background-image: url('../assets/img/bg-birthday.png');height: 100%;background-position: center; background-repeat: no-repeat;background-size: cover;padding: 180px 0px 0px 0px;">
        <center>
            <span class="celebrants" style="font-size:40px;font-weight:900;font-family:arial;color:#fc4f4f;text-align:center;text-transform: uppercase;background: #fff;padding: 5px 15px;border-radius: 20px;box-shadow: 1px 4px 5px 0px #1212125c;">
                <?php 
                    $month_name = (!empty($birthday)) ? date("F", mktime(0, 0, 0, $birthday, 10)).' CELEBRANTS' : ''; 
                    echo $month_name;
                ?> 
            </span>
        </center>
        <div style="display:flex;justify-content: center;align-content: center;flex-flow: row wrap;padding:0px 30px 50px 30px;"> 
            <?php 
                $x=1;
                $page=1;
                $per_page=8;
                $offset = ($page-1) * $per_page;
                $mysql=mysqli_query($con,"SELECT personal_id,photo_upload,lname, fname, name_ext, bdate, day(bdate) AS bday FROM personal_data WHERE MONTH(bdate) = '$birthday' AND status = 'Active' ORDER BY bday ASC LIMIT $offset, $per_page");
                $num_rows=mysqli_num_rows($mysql);
                while($fetch=$mysql->fetch_array()){
                    $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                    if($x<=8){
            ?>
            <div class="m-4 mb-10">
                <img class="emp-image" src=" 
                    <?php 
                        $file_pointer = '../uploads/'.sanitize(utf8_encode($fetch['photo_upload'])); 
                        $file_default = '../uploads/default/user.png'; 
                        if (file_exists($file_pointer) && !empty($fetch['photo_upload'])) {
                            echo $file_pointer;
                        }else{
                            echo $file_default;
                        }
                    ?>" 
                    style="width:175px;height:175px;border-radius: 20px;box-shadow: 0px 0px 4px 0px #bebebe">
                <div class="text-white calendar" style="background-image:linear-gradient(red 40%, white 40%);position:absolute;width: 50px;border-radius: 10px;margin-top:-75px;margin-left:-15px;text-align: center;box-shadow: -2px 3px 4px 0px #12121263">
                    <div style="padding:5px 9px 7px 9px;text-align: center;"> 
                        <div style="margin-bottom:7px;text-transform: uppercase;font-weight: 900"><?php echo date('M',strtotime($fetch['bdate']));?></div>
                        <div style="font-size: 30px;line-height: 25px;color: #000;margin-top: 5px;"><?php echo date('d',strtotime($fetch['bdate']));?></div>
                    </div>  
                </div>
                <div style="position:relative;margin-top: 5px;text-align: center;">
                    <div style="font-size:12px;font-weight:900;line-height: normal;text-transform:uppercase;word-wrap: break-word; width: 100%"><?php echo $fullname;?></div>
                    <div style="line-height: 12px;word-wrap: break-word; position: absolute;width: 100%;">
                        <?php
                            $sql = mysqli_query($con, "SELECT * FROM job_history WHERE personal_id = '$fetch[personal_id]'");
                            $fecthjob = mysqli_fetch_array($sql);
                            if(!empty($fetch['position_applied']) && empty($fecthjob['j_position'])){  
                                echo getCurrentApplied($con, $fetch['personal_id'], $fetch['position_applied']); 
                            } else {  
                                echo getCurrentJob($con, $fetch['personal_id'], $fecthjob['j_position']);  
                            } 
                        ?>
                    </div>
                </div>
            </div>
            <?php } $x++;  }?>
        </div>
    </div>
</page>

<?php $num_rowss=0; $page=1; if($num_rows_compare>$num_rows){ ?>
<page size="A4" layout="landscape">
    <div style="background-image: url('../assets/img/bg-birthday.png');height: 100%;background-position: center; background-repeat: no-repeat;background-size: cover;padding: 180px 0px 0px 0px;">
        <center>
            <span class="celebrants" style="font-size:40px;font-weight:900;font-family:arial;color:#fc4f4f;text-align:center;text-transform: uppercase;background: #fff;padding: 5px 15px;border-radius: 20px;box-shadow: 1px 4px 5px 0px #1212125c;">
                <?php 
                    $month_name = (!empty($birthday)) ? date("F", mktime(0, 0, 0, $birthday, 10)).' CELEBRANTS' : ''; 
                    echo $month_name;
                ?> 
            </span> 
        </center>   
        <div style="display:flex;justify-content: center;align-content: center;flex-flow: row wrap;padding:0px 30px 50px 30px;"> 
            <?php 
                $x=1;
                $per_page=8;
                $offset = ($page+1) * $per_page;
                $mysql=mysqli_query($con,"SELECT personal_id,photo_upload,lname, fname, name_ext, bdate, day(bdate) AS bday FROM personal_data WHERE MONTH(bdate) = '$birthday' AND status = 'Active' ORDER BY bday ASC LIMIT $per_page,$offset");
                $num_rowss=mysqli_num_rows($mysql);
                while($fetch=$mysql->fetch_array()){
                    $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                    if($x<=8){
            ?>
            <div class="m-4 mb-10">
                <img class="emp-image" src=" 
                    <?php 
                        $file_pointer = '../uploads/'.sanitize(utf8_encode($fetch['photo_upload'])); 
                        $file_default = '../uploads/default/user.png'; 
                        if (file_exists($file_pointer) && !empty($fetch['photo_upload'])) {
                            echo $file_pointer;
                        }else{
                            echo $file_default;
                        }
                    ?>" 
                    style="width:175px;height:175px;border-radius: 20px;box-shadow: 0px 0px 4px 0px #bebebe">
                <div class="text-white calendar" style="background-image:linear-gradient(red 40%, white 40%);position:absolute;width: 50px;border-radius: 10px;margin-top:-75px;margin-left:-15px;text-align: center;box-shadow: -2px 3px 4px 0px #12121263">
                    <div style="padding:5px 9px 7px 9px;text-align: center;"> 
                        <div style="margin-bottom:7px;text-transform: uppercase;font-weight: 900"><?php echo date('M',strtotime($fetch['bdate']));?></div>
                        <div style="font-size: 30px;line-height: 25px;color: #000;margin-top: 5px;"><?php echo date('d',strtotime($fetch['bdate']));?></div>
                    </div>  
                </div>
                <div style="position:relative;margin-top: 5px;text-align: center;">
                    <div style="font-size:12px;font-weight:900;line-height: normal;text-transform:uppercase;word-wrap: break-word; width: 100%"><?php echo $fullname;?></div>
                    <div style="line-height: 12px;word-wrap: break-word; position: absolute;width: 100%;">
                        <?php
                            $sql = mysqli_query($con, "SELECT * FROM job_history WHERE personal_id = '$fetch[personal_id]'");
                            $fecthjob = mysqli_fetch_array($sql);
                            if(!empty($fetch['position_applied']) && empty($fecthjob['j_position'])){  
                                echo getCurrentApplied($con, $fetch['personal_id'], $fetch['position_applied']); 
                            } else {  
                                echo getCurrentJob($con, $fetch['personal_id'], $fecthjob['j_position']);  
                            } 
                        ?>
                    </div>
                </div>
            </div>
            <?php } $x++; }?>
        </div>
    </div>
</page>
<?php } ?>

<?php $page=1;  if($num_rowss>8){ ?>
<page size="A4" layout="landscape">
    <div style="background-image: url('../assets/img/bg-birthday.png');height: 100%;background-position: center; background-repeat: no-repeat;background-size: cover;padding: 180px 0px 0px 0px;">
        <center>
            <span class="celebrants" style="font-size:40px;font-weight:900;font-family:arial;color:#fc4f4f;text-align:center;text-transform: uppercase;background: #fff;padding: 5px 15px;border-radius: 20px;box-shadow: 1px 4px 5px 0px #1212125c;">
            <?php 
                $month_name = (!empty($birthday)) ? date("F", mktime(0, 0, 0, $birthday, 10)).' CELEBRANTS' : ''; 
                echo $month_name;
            ?> 
            </span> 
        </center>   
        <div style="display:flex;justify-content: center;align-content: center;flex-flow: row wrap;padding:0px 30px 50px 30px;"> 
            <?php 
                $x=1;
                $per_page=8;
                $offset = ($page+1) * $per_page;
                $mysql=mysqli_query($con,"SELECT personal_id,photo_upload,lname, fname, name_ext, bdate, day(bdate) AS bday FROM personal_data WHERE MONTH(bdate) = '$birthday' AND status = 'Active' ORDER BY bday ASC LIMIT $offset,$per_page");
                while($fetch=$mysql->fetch_array()){
                    $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                    if($x<9){
            ?>
            <div class="m-4 mb-10">
                <img class="emp-image" src=" 
                    <?php 
                        $file_pointer = '../uploads/'.sanitize(utf8_encode($fetch['photo_upload'])); 
                        $file_default = '../uploads/default/user.png'; 
                        if (file_exists($file_pointer) && !empty($fetch['photo_upload'])) {
                            echo $file_pointer;
                        }else{
                            echo $file_default;
                        }
                    ?>" 
                    style="width:175px;height:175px;border-radius: 20px;box-shadow: 0px 0px 4px 0px #bebebe">
                <div class="text-white calendar" style="background-image:linear-gradient(red 40%, white 40%);position:absolute;width: 50px;border-radius: 10px;margin-top:-75px;margin-left:-15px;text-align: center;box-shadow: -2px 3px 4px 0px #12121263">
                    <div style="padding:5px 9px 7px 9px;text-align: center;"> 
                        <div style="margin-bottom:7px;text-transform: uppercase;font-weight: 900"><?php echo date('M',strtotime($fetch['bdate']));?></div>
                        <div style="font-size: 30px;line-height: 25px;color: #000;margin-top: 5px;"><?php echo date('d',strtotime($fetch['bdate']));?></div>
                    </div>  
                </div>
                <div style="position:relative;margin-top: 5px;text-align: center;">
                    <div style="font-size:12px;font-weight:900;line-height: normal;text-transform:uppercase;word-wrap: break-word; width: 100%"><?php echo $fullname;?></div>
                    <div style="line-height: 12px;word-wrap: break-word; position: absolute;width: 100%;">
                        <?php
                            $sql = mysqli_query($con, "SELECT * FROM job_history WHERE personal_id = '$fetch[personal_id]'");
                            $fecthjob = mysqli_fetch_array($sql);
                            if(!empty($fetch['position_applied']) && empty($fecthjob['j_position'])){  
                                echo getCurrentApplied($con, $fetch['personal_id'], $fetch['position_applied']); 
                            } else {  
                                echo getCurrentJob($con, $fetch['personal_id'], $fecthjob['j_position']);  
                            } 
                        ?>
                    </div>
                </div>
            </div>
            <?php } $x++; }?>
        </div>
    </div>
</page>
<?php } ?>

<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script src="assets/js/demo.js"></script> 
   

</html>
 