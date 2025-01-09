<?php 

    include('../template/header.php'); 
    include('../includes/connection.php');
    include('../includes/functions.php');
    if(isset($_GET['amend_id'])){
        $id = $_GET['amend_id'];
    }else { 
        $id =''; 
    }

?>
<style type="text/css">
    body {
        background: rgb(204,204,204); 
        color: #000;
        font-family: sans-serif, Arial;
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
        table{border:1px solid #000!important;}
        .backback{background:#d2cdc9}
        td{
            padding: 3px
        }

    }
    /*.table-bordered, td {
        border: 1px solid #000!important;
    } */
    .bor-btm{
        border-bottom:1px solid #000;
    }
    .bor-right{
        border-right:1px solid #000;
    }
    .nobor-right{
        border-right:0px solid #000!important;
    }
    .bor-left{
        border-left:1px solid #000;
    }
    .bor-top{
        border-top:1px solid #000;
    }
    .nobor-top{
        border-top:0px solid #fff!important;
    }
    .bor-all{
        border: 1px solid #000;
    }
    .nobor-all{
        border: 0px solid #fff!important;
    }
    table td{
        font-size: 12px;
    }
    td{
        padding: 3px
    }
    .font-12{
        font-size: 12px!important;
    }
    table{border:1px solid #000!important;}
    .btn-w100{
        width: 100px
    }
    .btn-round{
        border-radius: 20px
    }
    .backback{background:#d2cdc9}
</style>

<div class="animated fadeInDown p-t-20" id="printbutton">
    <center>
        <a href="report_employees.php" class="btn btn-warning text-white btn-w100 btn-round">Back</a>
        <!-- <a href='update_emp.php?id=<?php echo $id; ?>' class="btn btn-primary btn-w100 btn-round">Update</a>  -->
        <a href="" class="btn btn-success btn-w100 btn-round" onclick="window.print()">Print</a>
        <!-- <button class="btn btn-danger btn-fill"onclick="printDiv('printableArea')" style="margin-bottom:5px;width:80px;"></span> Print</button><br> -->
    </center>
    <br>
</div>
<page size="A4">
    <div class="p-t-20 m-l-20 m-r-20">
    <?php 
        $sql = mysqli_query($con,"SELECT * FROM amendment WHERE amendment_id = '$id'");
        while($row=mysqli_fetch_array($sql)){
            $sss = getInfo($con, 'sss', 'additional_info', 'personal_id', $row['personal_id']);
            $philhealth = getInfo($con, 'philhealth', 'additional_info', 'personal_id', $row['personal_id']);
            $pagibig = getInfo($con, 'pagibig', 'additional_info', 'personal_id', $row['personal_id']);
            $tin = getInfo($con, 'tin', 'additional_info', 'personal_id', $row['personal_id']);
            $designation = getPosition($con,$row['personal_id']);
            $end_contract = getInfo($con, 'end_date', 'job_history', 'personal_id', $row['personal_id']);
            $date_reg=getDateReg($con,$row['personal_id']);
            $salary_current = getInfo($con, 'salary', 'job_history', 'personal_id', $row['personal_id']);
            $salary=getCurrentSalary($con,$row['personal_id'],$salary_current);
            $allowance = getInfo($con, 'amount', 'allowance', 'personal_id', $row['personal_id']);

            $sqli=mysqli_query($con,"SELECT * FROM personal_data WHERE personal_id = '$row[personal_id]'");
            $rows=mysqli_fetch_array($sqli);
            $fullname = sanitize(utf8_encode($rows['lname'].' ,'.$rows['fname'].' '.$rows['name_ext'].' ,'.$rows['mname']));
            $corporate_name = getInfo($con, 'bu_name', 'business_unit', 'bu_id', $rows['applied_company']);
            $department = getInfo($con, 'dept_name', 'department', 'dept_id', $rows['current_dept']);
            //$fname=getInfo($con, 'fname', 'personal_data', 'personal_id', $rows['current_supervisor']);
            //$lname=getInfo($con, 'lname', 'personal_data', 'personal_id', $rows['current_supervisor']);
            $current_supervisor=$row['dept_head'];
    ?>
    <?php include('../forms/logo_header.php') ?>
    <table width="100%" class="nobor-top">
        <tr>
            <td colspan="4" align="center" class="backback bor-btm"> 
                <h4 class="m-t-10 m-b-10"><b>EMPLOYMENT AMENDMENT FORM</b></h4>
            </td>
        </tr>
        <tr>
            <td class="bor-btm bor-right" width="20%">NAME</td>
            <td class="bor-btm bor-right" width="38%"><b><?php echo $fullname; ?></b></td>
            <td class="bor-btm bor-right" width="25%">DATE PREPARED</td>
            <td class="bor-btm bor-right" width="17%"><b><?php echo (!empty($row['date_prepared'])) ? date("F d, Y",strtotime($row['date_prepared'])) : ''; ?></b></td>
        </tr>
        <tr>
            <td class="bor-btm bor-right" >DESIGNATION</td>
            <td class="bor-btm bor-right"><b><?php echo $designation; ?></b></td>
            <td class="bor-btm bor-right" >CORPORATE NAME</td>
            <td class="bor-btm bor-right"><b><?php echo $corporate_name; ?></b></td>
        </tr>
        <tr>
            <td class="bor-btm bor-right" >BIRTHDATE</td>
            <td class="bor-btm bor-right"><b><?php echo date("F d, Y",strtotime($rows['bdate'])); ?></b></td>
            <td class="bor-btm bor-right" >DATE HIRED</td>
            <td class="bor-btm bor-right"><b><?php echo date("F d, Y",strtotime($rows['date_hired'])); ?></b></td>
        </tr>
        <tr>
            <td class="bor-btm bor-right" >MARITRAL STATUS</td>
            <td class="bor-btm bor-right"><b><?php echo $rows['civil_status'];?></b></td>
            <td class="bor-btm bor-right" >END OF CONTRACT</td>
            <td class="bor-btm bor-right"><b><?php echo $end_contract; ?></b></td>
        </tr>
        <tr>
            <td class="bor-btm bor-right" >SSS NUMBER</td>
            <td class="bor-btm bor-right"><b><?php echo $sss; ?></b></td>
            <td class="bor-btm bor-right" >DATE OF REGULARIZATION</td>
            <td class="bor-btm bor-right"><b><?php echo  date("F d, Y",strtotime($date_reg)); ?></b></td>
        </tr>
        <tr>
            <td class="bor-btm bor-right" >T.I.N.</td>
            <td class="bor-btm bor-right"><b><?php echo $tin; ?></b></td>
            <td class="bor-btm bor-right" >PHILHEALTH NUMBER</td>
            <td class="bor-btm bor-right"><b><?php echo $philhealth; ?></b></td>
        </tr>
        <tr>
            <td class="bor-btm bor-right" >PAG-IBIG NUMBER</td>
            <td class="bor-btm bor-right"><b><?php echo $pagibig; ?></b></td>
            <td class="bor-btm bor-right" >DATE OF EFFECTIVITY</td>
            <td class="bor-btm bor-right" ><b><?php echo (!empty($row['date_prepared'])) ? date("F d, Y",strtotime($row['date_effectivity'])) : ''; ?></b></td>
        </tr>
    </table>
    <table width="100%" class="nobor-top">
        <tr>
            <td class="bor-btm bor-right" width="32%" align="center"><b>CHANGES</b></td>
            <td class="bor-btm bor-right" width="34%" align="center"><b>FROM</b></td>
            <td class="bor-btm bor-right" width="34%" align="center"><b>TO</b></td>
        </tr>
        <?php 
            $mysql = mysqli_query($con,"SELECT * FROM amendment_details WHERE amendment_id = '$row[amendment_id]'"); 
            while($fetch=mysqli_fetch_array($mysql)){
        ?>
        <tr>
            <td class="bor-btm bor-right"><?php echo $fetch['change_name']; ?></td>
            <td class="bor-btm bor-right">
                <?php echo $fetch['change_from']; ?>
            </td>
            <td class="bor-btm bor-right">
                <?php echo $fetch['change_to']; ?>
            </td>
        </tr>
        </tr>
        <?php } ?>
    </table>
    <table width="100%" class="nobor-top">
        <tr>
            <td colspan="7"><b>REASONS FOR CHANGES</b></td>
        </tr>

        <tr>
            <td class="nobor" width="3%">
                <input type="checkbox" name="reason[]" value="NEWLY HIRED" <?php echo ((strpos($row['change_reason'], "NEWLY HIRED") !== false) ? ' checked' : '');?>>
            </td>
            <td class="nobor" width="20%">NEWLY HIRED</td>
            <td class="nobor" width="3%">
                <input type="checkbox" name="reason[]" value="TRANSFER" <?php echo ((strpos($row['change_reason'], "TRANSFER") !== false) ? ' checked' : '');?>>
            </td>
            <td class="nobor" width="20%">TRANSFER</td>
            <td class="nobor" width="3%">
                <input type="checkbox" name="reason[]" value="PROMOTION" <?php echo ((strpos($row['change_reason'], "PROMOTION") !== false) ? ' checked' : '');?>>
            </td>
            <td class="nobor" width="20%">PROMOTION</td>
            <td class="nobor"></td>
        </tr>
        <tr>
            <td class="nobor" width="3%">
                <input type="checkbox" name="reason[]" value="MERIT INCREASE" <?php echo ((strpos($row['change_reason'], "MERIT INCREASE") !== false) ? ' checked' : '');?>>
            </td>
            <td class="nobor">MERIT INCREASE</td>
            <td class="nobor" width="3%">
                <input type="checkbox" name="reason[]" value="REGULARIZATION" <?php echo ((strpos($row['change_reason'], "REGULARIZATION") !== false) ? ' checked' : '');?>>
            </td>
            <td class="nobor">REGULARIZATION</td>
            <td class="nobor" width="3%">
                <input type="checkbox" name="reason[]" value="OTHERS" <?php echo ((strpos($row['change_reason'], "OTHERS") !== false) ? ' checked' : '');?>>
            </td>
            <td class="nobor">OTHERS</td>
            <td class="nobor"></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td class="nobor" width="10%">
                REMARKS
            </td>
            <td class="nobor" style="padding: 0px">
               : <?php echo $row['remarks'];?>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td class="nobor">
                <div class="m-b-40">
                <b>REVIEWED AND APPROVED BY:</b>
                </div>
                <table width="100%" class="nobor-all">
                    <tr>
                        <td class="nobor" align="center"style="padding: 0px"  width="28%">
                            <?php echo $current_supervisor; ?>
                        </td>
                        <td class="nobor" width="10%"></td>
                        <td class="nobor" align="center"style="padding: 0px">
                            MA. MILAGROS B. ARANA 
                            <input type="hidden" class="form-control" id="genman_id" name="genman_id">
                        </td>
                        <td class="nobor" width="10%"></td>
                        <td class="nobor" align="center"style="padding: 0px">
                            DAVID C. TAN
                            <input type="hidden" class="form-control" id="exec_id" name="exec_id">
                        </td>
                    </tr>
                    <tr>
                        <td class="bor-top" align="center">IMMEDIATE/DEPT. HEAD</td>
                        <td class="nobor" width="10%"></td>
                        <td class="bor-top" align="center">GENERAL MANAGER</td>
                        <td class="nobor" width="10%"></td>
                        <td class="bor-top" align="center">EXECUTIVE DIRECTOR</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="nobor">
                <div class="m-b-40">
                <b>ACKNOWLEDGE BY:</b>
                </div>
                <table width="100%" class="nobor-all">
                    <tr>
                        <td class="nobor" width="28%" align="center" style="padding: 0px"></td>
                        <td class="nobor" width="10%"></td>
                        <td class="nobor" align="center" style="padding: 0px"></td>
                        <td class="nobor" width="10%"></td>
                        <td class="nobor" align="center" style="padding: 0px"></td>
                    </tr>
                    <tr>
                        <td class="bor-top" align="center"><i><b>Signature of Employee</b></i></td>
                        <td class="nobor" width="10%"></td>
                        <td class="nobor"  align="center"></td>
                        <td class="nobor" width="10%"></td>
                        <td class="nobor" align="center"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="nobor">
                <br>
                <br>
                cc: 201 file<br>
                Finance/Accounting<br>
                Employee
            </td>
        </tr>
    </table>
    <?php } ?>
    </div>
</page>

<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script src="assets/js/demo.js"></script> 
    

</html>
