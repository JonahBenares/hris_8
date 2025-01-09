<?php 
    include('../template/header.php'); 
    include('../includes/connection.php'); 
    include('../includes/functions.php');
    if(isset($_GET['id'])) $id = $_GET['id'];
    else $id ='';

    if(checkTmp($con,$id)==0){
        $status = getData($con, 'status', 'personal_data', $id);
        $emp_status = getData($con, 'emp_status','personal_data', $id);
        $email = getData($con, 'email', 'personal_data',$id);
        $empno = getData($con, 'emp_num','personal_data', $id);
        $dateseparated = getData($con, 'date_separated', 'personal_data',$id);
        $datehired = getData($con, 'date_hired', 'personal_data',$id);
        $bio_no = getData($con, 'bio_num', 'personal_data',$id);
    } else {
        $status = getData($con, 'status', 'tmp_table', $id);
        $emp_status = getData($con, 'emp_status','tmp_table', $id);
        $email = getData($con, 'email', 'tmp_table',$id);
        $dateseparated = getData($con, 'date_separated', 'tmp_table',$id);
        $empno = getData($con, 'emp_num','tmp_table', $id);
        $datehired = getData($con, 'date_hired', 'tmp_table',$id);
        $bio_no = getData($con, 'bio_num', 'tmp_table',$id);
    }
?>
<style type="text/css">
    body {
        background: rgb(204,204,204); 
        color: #000;
        font-family: Nunito,sans-serif;
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
        height: 21cm;  
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
        }
        /*table td{ border:1px solid #fff!important; }*/
        .bor-btm{border-bottom:1px solid #000!important;}
        .bor-all{
            border: 1px solid #000;
        }
        #printbutton, #br, #br1{display: none}
/*        table{border:1px solid #000!important;}*/
    }
    table.tabler tr td, table.tabler, hr{
        border:1px solid #000!important;
        font-size: 12px;
        font-family: Nunito,sans-serif;
    }
    .btn-w100{
        width: 100px
    }
    .btn-round{
        border-radius: 20px
    }
    .bor-btm{
        border-bottom:1px solid #000;
    }
    .bor-right{
        border-right:1px solid #000;
    }
    .bor-left{
        border-left:1px solid #000;
    }
    .bor-top{
        border-top:1px solid #000;
    }
    .bor-all{
        border: 1px solid #000;
    }
    .nomarg{
        margin: 0px;
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
        <a href='update_emp.php?id=<?php echo $id; ?>' class="btn btn-primary btn-w100 btn-round">Update</a> 
        <a href="" class="btn btn-success btn-w100 btn-round" onclick="window.print()">Print</a>
        <!-- <button class="btn btn-danger btn-fill"onclick="printDiv('printableArea')" style="margin-bottom:5px;width:80px;"></span> Print</button><br> -->
    </center>
    <br>
</div>
<page size="A4">
    <div class=" m-l-20 m-r-20">
        <?php include('../forms/header_new.php') ?>
        <table width="100%">
            <tr>
                <td class="bor-btm" width="50%"><h5 class="nomarg"><b><?php echo getSupName($con,$id); ?></b></h5></td>
                <td width="5%"></td>
                <td class="bor-btm" width="20%"><h6 class="nomarg"><?php echo $empno; ?></h6></td>
                <td width="5%"></td>
                <td class="bor-btm" width="15%"><h6 class="nomarg"><?php echo $datehired ?></h6></td>
            </tr>
            <tr>
                <td class="">Employee Name</td>
                <td></td>
                <td class="">Employee Number</td>
                <td></td>
                <td class="">Date Hired</td>
            </tr>
            <tr>
                <td colspan="4"><div style="margin:5px"></div></td>
            </tr>
            <tr>
                <td class="bor-btm" width="50%"><h6 class="nomarg"><?php echo $email ?></h6></td>
                <td width="5%"></td>
                <td class="bor-btm" width="20%"><h6 class="nomarg"><?php echo $emp_status ?></h6></td>
                <td width="5%"></td>
                <td class="bor-btm" width="15%"><h6 class="nomarg"><?php echo $status ?></h6></td>
            </tr>
            <tr>
                <td class="">Email Address</td>
                <td></td>
                <td class="">Employment Status</td>
                <td></td>
                <td class="">Status</td>
            </tr>
        </table>
        <br>
        <table class="tabler" width="100%">
            <tr style="background:#c8c8c8">
                <td colspan="10" class="p-2"><h5 class="nomarg"><b>Job History</b></h5></td>
            </tr>
            <tr style="background:#ebebeb;">  
                <td class="pl-1 pr-1">Effective Date</td>
                <td class="pl-1 pr-1">End Date</td>
                <td class="pl-1 pr-1">Position</td>
                <td class="pl-1 pr-1">Status</td>
                <td class="pl-1 pr-1">Department</td>
                <td class="pl-1 pr-1">Business Unit</td>
                <td class="pl-1 pr-1">Location</td>
                <td class="pl-1 pr-1">Salary</td>
                <td class="pl-1 pr-1">Per Day</td>
                <td class="pl-1 pr-1">Supervisor</td>
            </tr>
            <?php 
                if(checkTmp_job($con, $id) != 0){
                $select = $con->query("SELECT * FROM job_history WHERE personal_id ='$id' ORDER BY effective_date DESC");
                $selecttmp = $con->query("SELECT * FROM job_history_tmp WHERE personal_id ='$id'"); ?>
                <tbody>
                <?php while($fetch = $select->fetch_array()){ ?>
                    <tr>
                        <td class="pl-1 pr-1"><?php echo ($fetch['effective_date']!='') ? date('F j, Y', strtotime($fetch['effective_date'])) : ''; ?></td>
                        <td class="pl-1 pr-1"><?php echo ($fetch['end_date']!='') ? date('F j, Y', strtotime($fetch['end_date'])) : ''; ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetch['j_position']; ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetch['emp_status']; ?></td>
                        <td class="pl-1 pr-1"><?php echo getInfo($con, 'dept_name', 'department', 'dept_id', $fetch['department_id']); ?></td>
                        <td class="pl-1 pr-1"><?php echo getInfo($con, 'bu_name', 'business_unit', 'bu_id',$fetch['bu_id']); ?></td>
                        <td class="pl-1 pr-1"><?php echo getInfo($con, 'location_name', 'location', 'location_id', $fetch['location_id']); ?></td>
                        <td class="pl-1 pr-1"><?php echo number_format($fetch['salary'],2); ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetch['per_day']; ?></td>
                        <td class="pl-1 pr-1"><?php echo getSupName($con, $fetch['supervisor']); ?></td>
                    </tr>
                <?php } ?>
                <?php while($fetchTmp = $selecttmp->fetch_array()){ ?>
                    <tr>
                        <td class="pl-1 pr-1"><?php echo ($fetchTmp['effective_date']!='') ? date('F j, Y', strtotime($fetchTmp['effective_date'])) : ''; ?></td>
                        <td class="pl-1 pr-1"><?php echo ($fetchTmp['end_date']!='') ? date('F j, Y', strtotime($fetchTmp['end_date'])) : ''; ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetchTmp['j_position']; ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetchTmp['emp_status']; ?></td>
                        <td class="pl-1 pr-1"><?php echo getInfo($con, 'dept_name', 'department', 'dept_id', $fetchTmp['department_id']); ?></td>
                        <td class="pl-1 pr-1"><?php echo getInfo($con, 'bu_name', 'business_unit', 'bu_id',$fetchTmp['bu_id']); ?></td>
                        <td class="pl-1 pr-1"><?php echo getInfo($con, 'location_name', 'location', 'location_id', $fetchTmp['location_id']); ?></td>
                        <td class="pl-1 pr-1"><?php echo number_format($fetchTmp['salary'],2); ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetchTmp['per_day']; ?></td>
                        <td class="pl-1 pr-1"><?php echo getSupName($con, $fetchTmp['supervisor']); ?></td>
                    </tr>
                <?php } ?>
                </tbody><?php
                    } else {
                    $select = $con->query("SELECT * FROM job_history WHERE personal_id ='$id' ORDER BY effective_date DESC");
                    while($fetch = $select->fetch_array()){ ?>
                    <tbody>
                        <tr>
                            <td class="pl-1 pr-1"><?php echo ($fetch['effective_date']!='') ? date('F j, Y', strtotime($fetch['effective_date'])) : ''; ?></td>
                            <td class="pl-1 pr-1"><?php echo ($fetch['end_date']!='') ? date('F j, Y', strtotime($fetch['end_date'])) : ''; ?></td>
                            <td class="pl-1 pr-1"><?php echo $fetch['j_position']; ?></td>
                            <td class="pl-1 pr-1"><?php echo $fetch['emp_status']; ?></td>
                            <td class="pl-1 pr-1"><?php echo getInfo($con, 'dept_name', 'department', 'dept_id', $fetch['department_id']); ?></td>
                            <td class="pl-1 pr-1"><?php echo getInfo($con, 'bu_name', 'business_unit', 'bu_id',$fetch['bu_id']); ?></td>
                            <td class="pl-1 pr-1"><?php echo getInfo($con, 'location_name', 'location', 'location_id', $fetch['location_id']); ?></td>
                            <td class="pl-1 pr-1"><?php echo number_format($fetch['salary'],2); ?></td>
                            <td class="pl-1 pr-1"><?php echo $fetch['per_day']; ?></td>
                            <td class="pl-1 pr-1"><?php echo getSupName($con, $fetch['supervisor']); ?></td>
                        </tr>
                    </tbody>
                <?php } 
            } ?>
        </table>
        <br>
        <table class="tabler" width="100%">
            <tr style="background:#c8c8c8">
                <td colspan="10" class="p-2"><h5 class="nomarg"><b>Evaluation History</b></h5></td>
            </tr>
            <tr style="background:#ebebeb;"> 
                <td class="pl-1 pr-1">Evaluation Date</td>
                <td class="pl-1 pr-1">Score</td>
                <td class="pl-1 pr-1">Evaluation Type</td>
                <td class="pl-1 pr-1">Adjustment</td>
                <td class="pl-1 pr-1">Per Day</td>
                <td class="pl-1 pr-1">Effective Date</td>
            </tr>
            <?php
                if(checkTmp_eval($con, $id) != 0){
                $select = $con->query("SELECT * FROM evaluation_history WHERE personal_id ='$id' ORDER BY effective_date DESC");
                $select_tmp = $con->query("SELECT * FROM evaluation_history_tmp WHERE personal_id ='$id'");
                while($fetch = $select->fetch_array()){ ?>           
                    <tr>
                        <td class="pl-1 pr-1"><?php echo ($fetch['eval_date']!='' && $fetch['eval_date']!='-') ? date('F Y', strtotime($fetch['eval_date'])) : ''; ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetch['score']; ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetch['eval_type']; ?></td>
                        <td class="pl-1 pr-1"><?php echo number_format($fetch['adjustment'],2); ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetch['per_day']; ?></td>
                        <td class="pl-1 pr-1"><?php if(!empty($fetch['effective_date'])){ echo date('F j, Y', strtotime($fetch['effective_date'])); } else { echo ''; } ?></td>
                    </tr>           
                <?php } 
                while($fetch_tmp = $select_tmp->fetch_array()){ ?>           
                    <tr>
                        <td class="pl-1 pr-1"><?php echo ($fetch_tmp['eval_date']!='' && $fetch_tmp['eval_date']!='-') ? date('F Y', strtotime($fetch_tmp['eval_date'])) : ''; ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetch_tmp['score']; ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetch_tmp['eval_type']; ?></td>
                        <td class="pl-1 pr-1"><?php echo number_format($fetch_tmp['adjustment'],2); ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetch_tmp['per_day']; ?></td>
                        <td class="pl-1 pr-1"><?php if(!empty($fetch_tmp['effective_date'])){ echo date('F j, Y', strtotime($fetch_tmp['effective_date']));} else { echo ''; } ?></td>
                    </tr>           
                <?php } ?>           
                <?php } else {
                $select = $con->query("SELECT * FROM evaluation_history WHERE personal_id ='$id' ORDER BY effective_date DESC");
                while($fetch = $select->fetch_array()){ ?>            
                    <tr>
                        <td class="pl-1 pr-1"><?php echo ($fetch['eval_date']!='' && $fetch['eval_date']!='-') ? date('F Y', strtotime($fetch['eval_date'])) : ''; ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetch['score']; ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetch['eval_type']; ?></td>
                        <td class="pl-1 pr-1"><?php echo number_format($fetch['adjustment'],2); ?></td>
                        <td class="pl-1 pr-1"><?php echo $fetch['per_day']; ?></td>
                        <td class="pl-1 pr-1"><?php if(!empty($fetch['effective_date'])){ echo date('F j, Y', strtotime($fetch['effective_date'])); } else { echo ''; } ?></td>
                    </tr>            
            <?php } } ?>
        </table>
    </div>
</page>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script src="assets/js/demo.js"></script> 
   

</html>
