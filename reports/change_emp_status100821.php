<?php 
    include('../template/header.php'); 
    include('../includes/connection.php'); 
    include('../template/navbar_other.php'); 
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
    .header , .sidebar{
        display: none;
    }
    section.content.content--full{
        padding-top: 30px;
    }
</style>
<script>
    window.onbeforeunload = deleteTmp;
    function deleteTmp() {
        var id = document.getElementById('id').value;
        $.ajax({
            type: "POST",
            url: "../reports/delete-tmp.php",
            data: "id="+id
        });
    }
    function refresh(){
        var id = document.getElementById('id').value;
        var change_status = document.getElementById('change_status').value;
            setInterval(function() {
            $("#responsecontainer").load('eval-inc.php?id='+id);
        }, 1000);
           setInterval(function() {
            $("#responsecontainer_jh").load('job-inc.php?id='+id);
        }, 1000);
           setInterval(function() {
            $("#responsecontainer_allow").load('allow-inc.php?id='+id);
        }, 1000);
            setInterval(function() {
          $("#responsecontainer_discipline").load('disciplinary-inc.php?id='+id);
        }, 1000);

        if(change_status=='Active'){
            $('#bor1').hide();
            $('#bor2').hide();
            document.getElementById("bordersep").classList.remove('brd-btm');
        }else if(change_status=='Inactive'){
            $('#bor1').hide();
            $('#bor2').hide();
            document.getElementById("borderemp").classList.remove("brd-btm");
            document.getElementById("borderemail").classList.remove('brd-btm');
            document.getElementById("borderempnum").classList.remove('brd-btm');
            document.getElementById("borderhired").classList.remove('brd-btm');
            document.getElementById("borderbio").classList.remove('brd-btm');
            document.getElementById("bordersep").classList.remove('brd-btm');
        }else if(change_status=='Separated'){
            $('#bor1').show();
            $('#bor2').show();
            document.getElementById("borderemp").classList.remove("brd-btm");
            document.getElementById("borderemail").classList.remove('brd-btm');
            document.getElementById("borderempnum").classList.remove('brd-btm');
            document.getElementById("borderhired").classList.remove('brd-btm');
            document.getElementById("borderbio").classList.remove('brd-btm');
            document.getElementById("bordersep").classList.add('brd-btm');
        }
    }
    function saveChanges(){     
        var id = document.getElementById('id').value;
        $.ajax({
            type: "POST",
            url: "migrate-tmp.php",
            data: "id="+id,
            success: function(output){
              
              alert('Changes successfully saved!');
              window.close();
           }
        });
    }
</script>

<body onload="refresh()">
<section class="content content--full" >
    <div class="content__inner">
        <div class="row">
            <div class="col-lg-12">
                <p class="m-b-0">Change Status</p>
                <h1 style="font-size: 20px" class=""><b><?php echo getSupName($con,$id); ?></b></h1>
                <br>
                <div class="card">
                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td width="27%" class="brd-btm">
                                    <select required class ="form-control brd-none" name="change_status" id="change_status">
                                        <option value = "Active" <?php echo (($status=='Active') ? ' selected' : ''); ?>>Active</option>
                                        <option value = "Inactive" <?php echo (($status=='Inactive') ? ' selected' : ''); ?>>Inactive(Not Hired)</option>
                                        <option value = "Separated" <?php echo (($status=='Separated') ? ' selected' : ''); ?>>Separated</option>
                                    </select> 
                                </td>
                                <td width="5%" id="bor1"></td>
                                <td width="6%" class="brd-btm" id="bordersep">
                                    <input type='date' name="datesepar" id = 'datesepar' class="form-control  brd-none" placeholder="Date Separated" value="<?php echo $dateseparated; ?>" <?php echo ($status!='Separated') ? 'style= "display:none!important;"' : ''; ?>>
                                </td>
                                <td width="27%" class="brd-btm" id = "borderemp">
                                    <select class ="form-control brd-none"  name="emp_status" id="emp_status" <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?>>
                                        <option value=''>-Employee Status-</option>
                                        <option value = "Regular" <?php echo (($emp_status=='Regular') ? ' selected' : ''); ?>>Regular</option>
                                        <option value = "Probationary" <?php echo (($emp_status=='Probationary') ? ' selected' : ''); ?>>Probationary</option>
                                        <option value = "Trainee" <?php echo (($emp_status=='Trainee') ? ' selected' : ''); ?>>Trainee</option>
                                        <option value = "Project Based" <?php echo (($emp_status=='Project Based') ? ' selected' : ''); ?>>Project Based</option>
                                        <option value = "Consultant" <?php echo (($emp_status=='Consultant') ? ' selected' : ''); ?>>Consultant</option>
                                    </select> 
                                </td>
                                <td width="5%"></td>
                                <td width="35%" rowspan="6">
                                    <a href='javascript:' class="btn btn-success btn-block m-b-1" onclick="window.open('add_job.php?id='+<?php echo $id; ?>, '_blank', 'toolbar=yes,scrollbars=no,resizable=no,top=30,left=400,width=600,height=660');" id='add_job'  <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?>>Add Job</a>
                                    <a href='javascript:' class="btn btn-success btn-block m-b-1" onclick="window.open('add_eval.php?id='+<?php echo $id; ?>, '_blank', 'toolbar=yes,scrollbars=yes,resizable=no,top=30,left=400,width=600,height=450');"  id='add_eval'  <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?>>Add Evaluation</a>
                                    <a href='javascript:' class="btn btn-success btn-block m-b-1" onclick="window.open('add_allow.php?id='+<?php echo $id; ?>, '_blank', 'toolbar=yes,scrollbars=yes,resizable=no,top=30,left=400,width=600,height=400');"  id='add_allow'  <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?>>Add Allowance</a>
                                     <a href='javascript:' class="btn btn-success btn-block m-b-1" onclick="window.open('add_discp.php?id='+<?php echo $id; ?>, '_blank', 'toolbar=yes,scrollbars=yes,resizable=no,top=30,left=400,width=600,height=500');"  id='add_discp'  <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?>>Add Disciplinary Action</a>
                                    <input type='hidden' id="id" name="id" value="<?php echo $id; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td align="center">STATUS <br><br></td>
                                <td width="5%" id="bor2"></td>
                                <td align="center"><span <?php echo ($status!='Separated') ? 'style= "display:none!important;"' : ''; ?> id="labelsep">DATE SEPARATED<br><br></span></td>
                                <td align="center"><span <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?> id="labelemp">EMPLOYMENT STATUS <br><br></span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="brd-btm" id="borderemail">
                                    <input type='email' name="email" id="email" class="form-control brd-none " placeholder="Enter Corporate Email Address" <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?> value="<?php echo $email; ?>">
                                </td>
                                <td></td>
                                <td class="brd-btm" id="borderempnum">
                                    <input type='text'  name="emp_num" id="emp_num" class="form-control brd-none " placeholder="Enter Employee Number" <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?> value="<?php echo $empno; ?>">
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td align="center"><span <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?> id="labelemail">EMAIL ADDRESS <br><br></span></td>
                                <td></td>
                                <td align="center"><span <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?> id="labelempnum">EMPLOYEE NUMBER <br><br></span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="brd-btm" id="borderhired">
                                    <input type='date'  name="date_hired"  id="date_hired" class="form-control brd-none " placeholder="Enter Date Hired" <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?> value="<?php echo $datehired; ?>" style="color:#fff">
                                </td>
                                <td></td>
                                <td class="brd-btm" id="borderbio">
                                    <input type='text'   name="bio_num" id="bio_num" class="form-control brd-none" placeholder="Enter Biometric Number" <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?> value="<?php echo $bio_no; ?>">
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td align="center"><span <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?> id="labelhired">DATE HIRED <br><br></span></td>
                                <td></td>
                                <td align="center"><span <?php echo (($status != 'Active') ? ' style= "display:none;"' : ''); ?> id="labelbio">BIOMETRIC NUMBER <br><br></span></td>
                                <td></td>
                            </tr>
                        </table>                        
                    </div>
                </div>
                <div id='responsecontainer_jh'></div>                    
                <div id='responsecontainer'></div>
                <div id='responsecontainer_allow'></div>
                <div id='responsecontainer_discipline'></div>
            </div>
        </div>    
    </div>
</section></body>

<?php 
include('../template/footer.php'); 
?> 

<script>
    $(document).ready(function() {
        $('#Pos_Table').DataTable({
            "bLengthChange":true,
            "bInfo":true,
            "bSort":true,
            "bFilter":true,
            "order": [[ 0, 'desc' ]]
        });
    });
    var id = document.getElementById('id').value;
    $('#change_status').on('change',function(){
        $.ajax({
            type: "POST",
            url: "save-temp.php",
            data:'stat='+$(this).val()+'='+id
        });
    });
    $('#emp_status').on('change',function(){
        $.ajax({
            type: "POST",
            url: "save-temp.php",
            data:'emp_stat='+$(this).val()+'='+id
        });
    });
    $('#email').on('blur',function(){
        $.ajax({
            type: "POST",
            url: "save-temp.php",
            data:'email='+$(this).val()+'='+id
        });
    });
    $('#emp_num').on('blur',function(){
        $.ajax({
            type: "POST",
            url: "save-temp.php",
            data:'emp_num='+$(this).val()+'='+id
        });
    });
    $('#date_hired').on('blur',function(){
        $.ajax({
            type: "POST",
            url: "save-temp.php",
            data:'date_hired='+$(this).val()+'='+id
        });
    });

    $('#bio_num').on('blur',function(){
        $.ajax({
            type: "POST",
            url: "save-temp.php",
            data:'bio_num='+$(this).val()+'='+id
        });
    });
    $('#datesepar').on('blur',function(){
        $.ajax({
            type: "POST",
            url: "save-temp.php",
            data:'separated='+$(this).val()+'='+id
        });
    });         

    $('#change_status').on('change',function(){
        var id = document.getElementById('id').value;
        if(this.value == 'Active'){
            document.getElementById("borderemp").classList.add('brd-btm');
            document.getElementById("borderemail").classList.add('brd-btm');
            document.getElementById("borderempnum").classList.add('brd-btm');
            document.getElementById("borderhired").classList.add('brd-btm');
            document.getElementById("borderbio").classList.add('brd-btm');
            document.getElementById("bordersep").classList.remove('brd-btm');
            $('#bor1').hide();
            $('#bor2').hide();
            $('#datesepar').hide();
            $('#labelsep').hide();
            $('#add_allow').show();
            $('#add_discp').show();
            $('#labelemp').show();
            $('#labelemail').show();
            $('#labelempnum').show();
            $('#labelhired').show();
            $('#labelbio').show();
            $('#emp_status').show();
            $('#lbl_emp_stat').show();
            $('#email').show();
            $('#lbl_email').show();
            $('#emp_num').show();
            $('#lbl_emp_num').show();
            $('#date_hired').show();
            $('#bio_num').show();           
            $('#add_job').show();
            $('#lbl_date').show();
            $('#add_eval').show();
            $('#lbl_bio').show();
           
            $('#emp_status').on('change',function(){
                $.ajax({
                    type: "POST",
                    url: "save-temp.php",
                    data:'emp_stat='+$(this).val()+'='+id
                });
            });

            $('#email').on('blur',function(){
                $.ajax({
                    type: "POST",
                    url: "save-temp.php",
                    data:'email='+$(this).val()+'='+id
                });
             });
            $('#emp_num').on('blur',function(){
                $.ajax({
                    type: "POST",
                    url: "save-temp.php",
                    data:'emp_num='+$(this).val()+'='+id                     
                });
            });
            $('#date_hired').on('blur',function(){
                $.ajax({
                    type: "POST",
                    url: "save-temp.php",
                    data:'date_hired='+$(this).val()+'='+id                     
                });
            });
            $('#bio_num').on('blur',function(){
                $.ajax({
                    type: "POST",
                    url: "save-temp.php",
                    data:'bio_num='+$(this).val()+'='+id                     
                });
             });
        } else {
            document.getElementById("borderemp").classList.remove("brd-btm");
            document.getElementById("borderemail").classList.remove('brd-btm');
            document.getElementById("borderempnum").classList.remove('brd-btm');
            document.getElementById("borderhired").classList.remove('brd-btm');
            document.getElementById("borderbio").classList.remove('brd-btm');
            document.getElementById("bordersep").classList.remove('brd-btm');
            $('#bor1').hide();
            $('#bor2').hide();
            $('#add_allow').hide();
            $('#add_discp').hide();
            $('#labelsep').hide();
            $('#labelemp').hide();
            $('#labelemail').hide();
            $('#labelempnum').hide();
            $('#labelhired').hide();
            $('#labelbio').hide();
            $('#emp_status').hide();
            $('#email').hide();
            $('#emp_num').hide();
            $('#lbl_emp_stat').hide();
            $('#lbl_email').hide();
            $('#lbl_emp_num').hide();
            $('#date_hired').hide();
            $('#bio_num').hide();
            $('#add_job').hide();
            $('#add_eval').hide();
            $('#lbl_date').hide();
            $('#lbl_bio').hide();
        }

        if(this.value == 'Separated'){
            document.getElementById("bordersep").classList.add('brd-btm');
            $('#bor1').show();
            $('#bor2').show();
            $('#add_allow').hide();
            $('#add_discp').hide();
            $('#labelsep').show();
            $('#datesep').show();
            $('#datesepar').show();
            $('#dateseparated').show();
            $('#datesepar').on('blur',function(){
                $.ajax({
                    type: "POST",
                    url: "save-temp.php",
                    data:'separated='+$(this).val()+'='+id                     
                });
            });
        }else {
            $('#datesepar').hide();
            $('#dateseparated').hide();
        }
   
});
  </script>