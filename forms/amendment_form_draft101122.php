<?php 
    include('../template/header.php'); 
    include('../includes/connection.php'); 
    include('../template/navbar.php'); 
    include('../includes/functions.php');
    if(isset($_GET['amend_id'])){
        $amendment_id = $_GET['amend_id'];
    }else { 
        $amendment_id =''; 
    }
?>  

<style>
        td{
            border: 1px solid #000;
            height: 30px !important;
            padding: 5px 5px;
            }
        .bord-noleft{
            border-left: 0px solid #fff!important;
        }
        .bord-noright{
            border-right: 0px solid #fff!important;
        }
        #name-school{float:left;list-style:none;margin-top:-3px;padding:0;width:335px;position: absolute; z-index:100;}
        #name-school li:hover {
            background: #28422c;
            cursor: pointer;
            font-weight: bold;
            color: white;
        }
        #name-school li {
            padding: 5px;
            background-color: #b5e8bb;
            border-bottom: #bbb9b9 1px solid;
            border-radius: 10px;
        }
        #search-school{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
        input[type=checkbox], input[type=radio]{
            height: 20px
        }
        .nobor{
            border:0px solid #fff;
        }
        .form-control{
            height: 35px
        }
        table, input, select{
            color: #000!important;
        }
    </style>
<script src="../assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    function addAmend(){
        var data = $("#add-amendment").serialize();
        var conf = confirm('Are you sure you want to save this record?');
        if(conf==true){
            var inserts = '../forms/insert_amendment.php';
        }else{
            var inserts = '';
        }
        $.ajax({
            data: data,
            type: "post",
            url: inserts,
            success: function(output){
                var op = output.trim();
                document.location = '../reports/amendment_form_print.php?amend_id='+op;
            }
        });
    }

    function addAmendDraft(){
        var data = $("#add-amendment").serialize();
        var conf = confirm('Are you sure you want to save this record?');
        if(conf==true){
            var inserts = '../forms/insert_amendment_draft.php';
        }else{
            var inserts = '';
        }
        $.ajax({
            data: data,
            type: "post",
            url: inserts,
            success: function(output){
                //alert(output);
                var op = output.trim();
                document.location = '../reports/amendment_form_print.php?amend_id='+op;
            }
        });
    }
</script>
<script type="text/javascript">
    var ii = 1;
    $("body").on("click", ".addChange", function() {
        ii++;
        var $append = $(this).parents('.append');
        var next = $append.clone().find("input").val("").end();
        next.attr('id', 'append' + ii);
        var RmBtn = $('.remAmend', next).length > 0;
        if (!RmBtn) {
            var rm = "<button type='button' class='btn btn-sm btn-danger remAmend'>x</button>"
            $('.addmoreappend', next).append(rm);
        }
        $append.after(next); 

    });

    $("body").on("click", ".remAmend", function() {
        $(this).parents('.append').remove();
    });
</script>
<section class="content">
    <div class="content__inner">
        <header class="content__title">
            <h1>Amendment Form</h1>
            <small>Welcome to the New HRIS web app experience!</small>
        </header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12" style="background: #fff">
                            <div style="padding: 20px 20px">
                                <div class='form_container' style="padding-top: 20px">
                                    <form id ="add-amendment" name = "add-amendment" method='POST'>
                                        <?php include('logo_header.php') ?>
                                        <br>
                                        <table style="width: 100%" style = "border-collapse: collapse;">
                                            <tr>
                                                <td colspan="4" align="center" style="background:#d2cdc9">
                                                    <h4 style="margin-top: 15px;color:#000"><b>EMPLOYMENT AMENDMENT FORM</b></h4>
                                                </td>
                                            </tr>
                                            <?php 
                                                $sqli=mysqli_query($con, "SELECT * FROM amendment WHERE amendment_id = '$amendment_id'"); 
                                                $fetch=mysqli_fetch_array($sqli);
                                                    $sss = getInfo($con, 'sss', 'additional_info', 'personal_id', $fetch['personal_id']);
                                                    $philhealth = getInfo($con, 'philhealth', 'additional_info', 'personal_id', $fetch['personal_id']);
                                                    $pagibig = getInfo($con, 'pagibig', 'additional_info', 'personal_id', $fetch['personal_id']);
                                                    $tin = getInfo($con, 'tin', 'additional_info', 'personal_id', $fetch['personal_id']);
                                                    $job_history = getInfo($con, 'j_position', 'job_history', 'personal_id',$fetch['personal_id']);
                                                    $designation = getCurrentJob($con, $fetch['personal_id'], $job_history);
                                                    $end_contract = getCurrentEnddate($con, $fetch['personal_id'], $job_history);
                                                    $emp_status = getInfo($con, 'emp_status', 'personal_data', 'personal_id', $fetch['personal_id']);
                                                    if($emp_status=='Regular'){
                                                        $date_reg=date("F d, Y",strtotime(getDateReg($con,$fetch['personal_id'])));
                                                    }else{
                                                        $date_reg='';
                                                    }
                                                    $salary_current = getInfo($con, 'salary', 'job_history', 'personal_id', $fetch['personal_id']);
                                                    $salary=getCurrentSalary($con,$fetch['personal_id'],$salary_current);
                                                    $allowance = getInfo($con, 'amount', 'allowance', 'personal_id', $fetch['personal_id']);

                                                    $fetch_data=mysqli_query($con,"SELECT * FROM personal_data WHERE personal_id = '$fetch[personal_id]'");
                                                    $fetch_personal=mysqli_fetch_array($fetch_data);
                                                    $fullname = sanitize(utf8_encode($fetch_personal['lname'].' ,'.$fetch_personal['fname'].' '.$fetch_personal['name_ext'].' ,'.$fetch_personal['mname']));
                                                    $corporate_name = getInfo($con, 'bu_name', 'business_unit', 'bu_id', $fetch_personal['applied_company']);
                                                    $department = getInfo($con, 'dept_name', 'department', 'dept_id', $fetch_personal['current_dept']);
                                                    $current_supervisor=$fetch['dept_head'];
                                            ?>
                                            <tr>
                                                <td class="bord-noright" style=""  width="20%">NAME</td>
                                                <td width="25%" class="bord-noleft" style="padding: 0px">
                                                    <select class="form-control" name="employee_name" id="employee_name" onchange="chooseEmployee()">
                                                        <option value="">--Select Employee Name--</option>
                                                        <?php 
                                                            $sql=mysqli_query($con,"SELECT * FROM personal_data ORDER BY lname ASC");
                                                            while($rows=mysqli_fetch_array($sql)){
                                                            $fullname = sanitize(utf8_encode($rows['lname'].' ,'.$rows['fname'].' '.$rows['name_ext'].' ,'.$rows['mname']));
                                                        ?>
                                                        <option value="<?php echo $rows['personal_id'];?>" <?php echo ($rows['personal_id'] == $fetch['personal_id']) ? 'selected' : '' ;?>><?php echo $fullname; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td class="bord-noright"  width="25%">DATE PREPARED</td>
                                                <td width="30%" class="bord-noleft"  style="padding: 0px"><input type="date" class="form-control" name="date_prepared" value = "<?php echo $fetch['date_prepared'];?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="bord-noright" >DESIGNATION</td>
                                                <td class="bord-noleft">: <span id='designation'><?php echo $designation; ?></span></td>
                                                <td class="bord-noright" >CORPORATE NAME</td>
                                                <td class="bord-noleft">: <span id='corporate_name'><?php echo $corporate_name; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td class="bord-noright" >BIRTHDATE</td>
                                                <td class="bord-noleft">: <span id='bday'><?php echo (!empty($fetch_personal['bdate'])) ? date("F d, Y",strtotime($fetch_personal['bdate'])) : ''; ?></span></td>
                                                <td class="bord-noright" >DATE HIRED</td>
                                                <td class="bord-noleft">: <span id='date_hired'><?php echo (!empty($fetch_personal['date_hired'])) ? date("F d, Y",strtotime($fetch_personal['date_hired'])) : ''; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td class="bord-noright" >MARITRAL STATUS</td>
                                                <td class="bord-noleft">: <span id='status'><?php echo $fetch_personal['civil_status'];?></span></td>
                                                <td class="bord-noright" >END OF CONTRACT</td>
                                                <td class="bord-noleft">: <span id='end_contract'><?php echo (!empty($end_contract)) ? date("F d, Y",strtotime($end_contract)) : ''; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td class="bord-noright" >SSS NUMBER</td>
                                                <td class="bord-noleft">: <span id='sss'><?php echo $sss; ?></span></td>
                                                <td class="bord-noright" >DATE OF REGULARIZATION</td>
                                                <td class="bord-noleft">: <span id='date_reg'><?php echo (!empty($date_reg)) ? date("F d, Y",strtotime($date_reg)) : ''; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td class="bord-noright" >T.I.N.</td>
                                                <td class="bord-noleft">: <span id='tin'><?php echo $tin; ?></span></td>
                                                <td class="bord-noright" >PHILHEALTH NUMBER</td>
                                                <td class="bord-noleft">: <span id='philhealth'><?php echo $philhealth; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td class="bord-noright" >PAG-IBIG NUMBER</td>
                                                <td class="bord-noleft">: <span id='pagibig'><?php echo $pagibig; ?></span></td>
                                                <td class="bord-noright" >DATE OF EFFECTIVITY</td>
                                                <td class="bord-noleft" style="padding: 0px"><input type="date" class="form-control" name="date_effectivity" value = "<?php echo $fetch['date_effectivity'];?>"></td>
                                            </tr>
                                        </table>
                                        <table id="tb" style="width: 100%" style = "border-collapse: collapse;">
                                            <tr>
                                                <td style="border-top: 0px solid #fff;padding: 15px" width="30%" align="center"><b>CHANGES</b></td>
                                                <td style="border-top: 0px solid #fff;padding: 15px" width="30%" align="center"><b>FROM</b></td>
                                                <td style="border-top: 0px solid #fff;padding: 15px" width="30%" align="center"><b>TO</b></td>
                                            </tr>
                                            <?php 
                                                $mysql = mysqli_query($con,"SELECT * FROM amendment_details WHERE amendment_id = '$fetch[amendment_id]'"); 
                                                while($fetcher=mysqli_fetch_array($mysql)){
                                                if($fetcher['change_name']=='BUSINESS UNIT'){
                                                    $input_id = 'business_unit';
                                                    $delete_id = 'bu';
                                                }

                                                if($fetcher['change_name']=='DEPARTMENT'){
                                                    $input_id = 'department';
                                                    $delete_id = 'dept';
                                                }

                                                if($fetcher['change_name']=='POSITION'){
                                                    $input_id = 'position';
                                                    $delete_id = 'posit';
                                                }

                                                if($fetcher['change_name']=='SALARY'){
                                                    $input_id = 'salary';
                                                    $delete_id = 'sal';
                                                }

                                                if($fetcher['change_name']=='ALLOWANCE/S'){
                                                    $input_id = 'allowance';
                                                    $delete_id = 'allow';
                                                }

                                                if($fetcher['change_name']=='EMPLOYMENT STATUS'){
                                                    $input_id = 'emp_status';
                                                    $delete_id = 'empstat';
                                                }

                                                if($fetcher['change_name']=='OTHER ALLOWANCE/S'){
                                                    $input_id = 'other_allowance';
                                                    $delete_id = 'other_allow';
                                                }

                                                if($fetcher['change_name']!='BUSINESS UNIT' && $fetcher['change_name']!='DEPARTMENT' && $fetcher['change_name']!='POSITION' && $fetcher['change_name']!='SALARY' && $fetcher['change_name']!='ALLOWANCE/S' && $fetcher['change_name']!='EMPLOYMENT STATUS' && $fetcher['change_name']!='OTHER ALLOWANCE/S'){
                                                    $input_id = 'other';
                                                    $delete_id = 'ot';
                                                }
                                            ?>
                                            <tr>
                                                <td style="padding: 0px">
                                                    <input type="hidden" name="amendment_details_id[]" value="<?php echo $fetcher['amend_det_id'];?>">
                                                    <input type="text" class="form-control" name="change_name[]" style="pointer-events: none;" value="<?php echo $fetcher['change_name'];?>">
                                                </td>
                                                <td style="padding: 0px">
                                                    <input type="text" name="change_from[]" id="<?php echo $input_id; ?>" value="<?php echo $fetcher['change_from'];?>" style="width: 85%">
                                                    <button type="button" class="btn btn-sm btn-danger" id="<?php echo $delete_id; ?>">x</button>
                                                </td>
                                                <td style="padding: 0px"><input type="text" class="form-control" name="change_to[]" value="<?php echo $fetcher['change_to'];?>"></td>
                                            </tr>
                                            <?php } ?>
                                            <tr class="append" id="append0">
                                                <td style="padding: 0px" class="addmoreappend">
                                                    <input type="text"  name="change_namer[]" style="width: 80%">
                                                    <button type="button" class="btn btn-sm btn-primary addChange" id="addChange">+</button>
                                                </td>
                                                <td style="padding: 0px">
                                                    <input type="text" name="change_frome[]" id="change_frome1" style="width: 85%">
                                                    <button type="button" class="btn btn-sm btn-danger" id="chfrom1">x</button>
                                                    <!-- <input type="button" class="btn btn-sm btn-danger" id="chfrom1" value="x"> -->
                                                </td>
                                                <td style="padding: 0px"><input type="text" class="form-control" name="change_toe[]"></td>
                                                <input type = "hidden" value = "1" id = "counter1" name = "counter1">
                                            </tr>
                                        </table>
                                        <table style="width: 100%;border-collapse: collapse;border:1px solid #000;border-top: 0px solid">
                                            <tr>
                                                <td class="nobor" colspan="7" style="padding: 15px 5px"><b>REASONS FOR CHANGES</b></td>
                                            </tr>
                                            <tr>
                                                <td class="nobor" width="3%"><input type="checkbox" name="reason[]" value="NEWLY HIRED" <?php echo ((strpos($fetch['change_reason'], "NEWLY HIRED") !== false) ? ' checked' : '');?>></td>
                                                <td class="nobor" width="20%">NEWLY HIRED</td>
                                                <td class="nobor" width="3%"><input type="checkbox" name="reason[]" value="TRANSFER" <?php echo ((strpos($fetch['change_reason'], "TRANSFER") !== false) ? ' checked' : '');?>></td>
                                                <td class="nobor" width="20%">TRANSFER</td>
                                                <td class="nobor" width="3%"><input type="checkbox" name="reason[]" value="PROMOTION" <?php echo ((strpos($fetch['change_reason'], "PROMOTION") !== false) ? ' checked' : '');?>></td>
                                                <td class="nobor" width="20%">PROMOTION</td>
                                                <td class="nobor"></td>
                                            </tr>
                                            <tr>
                                                <td class="nobor" width="3%"><input type="checkbox" name="reason[]" value="MERIT INCREASE" <?php echo ((strpos($fetch['change_reason'], "MERIT INCREASE") !== false) ? ' checked' : '');?>></td>
                                                <td class="nobor">MERIT INCREASE</td>
                                                <td class="nobor" width="3%"><input type="checkbox" name="reason[]" value="REGULARIZATION" <?php echo ((strpos($fetch['change_reason'], "REGULARIZATION") !== false) ? ' checked' : '');?>></td>
                                                <td class="nobor">REGULARIZATION</td>
                                                <td class="nobor" width="3%"><input type="checkbox" name="reason[]" value="OTHERS" <?php echo ((strpos($fetch['change_reason'], "OTHERS") !== false) ? ' checked' : '');?>></td>
                                                <td class="nobor">OTHERS</td>
                                                <td class="nobor"></td>
                                            </tr>
                                        </table>
                                        <table style="width: 100%;border-collapse: collapse;border:1px solid #000;border-top: 0px solid">
                                            <tr>
                                                <td class="nobor" width="10%">
                                                    REMARKS
                                                </td>
                                                <td class="nobor" style="padding: 0px">
                                                    <textarea class="form-control" name="remarks" id="remarks" rows="2" style="color:#000"><?php echo $fetch['remarks']; ?></textarea>
                                                </td>
                                            </tr>
                                        </table>
                                        <table style="width: 100%;border-collapse: collapse;border:1px solid #000;border-top: 0px solid">
                                            <tr>
                                                <td class="nobor">
                                                    <div style="margin-bottom: 40px">
                                                    <b>REVIEWED AND APPROVED BY:</b>
                                                    </div>
                                                    <table style="width: 100% ">
                                                        <tr>
                                                            <td class="nobor" align="center"style="padding: 0px"  width="28%">
                                                                <!-- <span id="current_supervisor"></span> -->
                                                                <input type="text" class="form-control" id="current_supid" name="current_supid" value=" <?php echo $current_supervisor; ?>">
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
                                                            <td class="nobor" style="border-top: 1px solid #000" align="center">IMMEDIATE/DEPT. HEAD</td>
                                                            <td class="nobor" width="10%"></td>
                                                            <td class="nobor" style="border-top: 1px solid #000" align="center">GENERAL MANAGER</td>
                                                            <td class="nobor" width="10%"></td>
                                                            <td class="nobor" style="border-top: 1px solid #000" align="center">EXECUTIVE DIRECTOR</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="nobor">
                                                    <div style="margin-bottom: 40px">
                                                    <b>ACKNOWLEDGE BY:</b>
                                                    </div>
                                                    <table style="width: 100% ">
                                                        <tr>
                                                            <td class="nobor" width="28%" align="center"style="padding: 0px"></td>
                                                            <td class="nobor" width="10%"></td>
                                                            <td class="nobor" align="center"style="padding: 0px"></select></td>
                                                            <td class="nobor" width="10%"></td>
                                                            <td class="nobor" align="center"style="padding: 0px"></select></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="nobor" style="border-top: 1px solid #000" align="center"><i><b>Signature of Employee</b></i></td>
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
                                        <br>
                                        <center>
                                            <!-- <input type="submit" class="btn btn-primary" name="submit" value="Save & Print" onClick="addAmend();"> -->
                                            <input type="hidden" name="amendment_id" value="<?php echo $amendment_id; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['userid'];?>">
                                            <button onClick="addAmend();" type="button" class="btn btn-primary">Save & Print <i class="pe-7s-angle-right-circle"></i></button>
                                            <button onClick="addAmendDraft();" type="button" class="btn btn-fill btn-warning">Save as Draft <i class="pe-7s-angle-right-circle"></i></button>
                                        </center>
                                    </form>                        
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    
    </div>
</section>
<script type="text/javascript">
    function chooseEmployee(){
        var employee_name = document.getElementById("employee_name").value;
        $.ajax({
            type: 'POST',
            url: "get_info.php",
            data: 'employee_name='+employee_name,
            dataType: 'json',
            success: function(response){
                document.getElementById("designation").innerHTML  = response.designation;
                document.getElementById("bday").innerHTML  = response.bday;
                document.getElementById("status").innerHTML  = response.civil_status;
                document.getElementById("sss").innerHTML  = response.sss;
                document.getElementById("tin").innerHTML  = response.tin;
                document.getElementById("pagibig").innerHTML  = response.pagibig;
                document.getElementById("corporate_name").innerHTML  = response.corporate_name;
                document.getElementById("date_hired").innerHTML  = response.date_hired;
                document.getElementById("date_reg").innerHTML  = response.date_reg;
                document.getElementById("end_contract").innerHTML  = response.end_contract;
                document.getElementById("philhealth").innerHTML  = response.philhealth;
                //document.getElementById("current_supervisor").innerHTML = response.current_supervisor;
                $("#business_unit").val(response.corporate_name);
                $("#department").val(response.department);
                $("#position").val(response.designation);
                $("#salary").val(response.salary);
                $("#allowance").val(response.allowance);
                $("#emp_status").val(response.emp_status);
                //$("#current_supid").val(response.current_supid);
                //$("#genman_id").val(response.gen_man);
                //$("#exec_id").val(response.exec_dir);
            }
        }); 
    }

    $("#bu").click(function () {
        document.getElementById("business_unit").value='';
    });

    $("#ot").click(function () {
        document.getElementById("other").value='';
    });

    $("#dept").click(function () {
        document.getElementById("department").value='';
    });

    $("#posit").click(function () {
        document.getElementById("position").value='';
    });

    $("#sal").click(function () {
        document.getElementById("salary").value='';
    });

    $("#allow").click(function () {
        document.getElementById("allowance").value='';
    });

    $("#other_allow").click(function () {
        document.getElementById("other_allowance").value='';
    });

    $("#empstat").click(function () {
        document.getElementById("emp_status").value='';
    });

    $("#chfrom1").click(function () {
        document.getElementById("change_frome1").value='';
    });
</script>  
<?php 
include('../template/footer.php'); 
?>
