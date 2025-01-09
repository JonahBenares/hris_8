<?php 
    include('../template/header.php'); 
    include('../includes/connection.php'); 
    include('../template/navbar_other.php'); 
    include('../includes/functions.php');
     $today=date("Y-m-d");
    if(isset($_GET['id'])) $id = $_GET['id'];
    else $id ='';

    if(isset($_POST['save_job'])){
    foreach($_POST as $var=>$value)
        $$var = mysqli_real_escape_string($con,$value);

    $supid=getSupID($con,$supervisor);
    $insert= $con->query("INSERT INTO job_history_tmp (personal_id, effective_date, emp_status, j_position, department_id, bu_id, location_id, salary, per_day, supervisor, end_date) VALUES ('$id', '$effective_date', '$emp_status','$j_position', '$department','$business_unit', '$location','$salary', '$perday','$supid','$end_date')"); 

    $con->query("UPDATE personal_data SET current_supervisor = '$supid' WHERE personal_id = '$id'");
    if($insert){
        $fname=getInfo($con, 'fname', 'personal_data', 'personal_id', $id);
        $lname=getInfo($con, 'lname', 'personal_data', 'personal_id', $id);
        $mname=getInfo($con, 'mname', 'personal_data', 'personal_id', $id);
        $fullname = sanitize(utf8_encode($fname . " " . $mname . " " . $lname));
        $get = $con->query("SELECT emp_status FROM job_history WHERE personal_id = '$id' ORDER BY effective_date ASC LIMIT 1");
        $count_trainee = $get->num_rows;
        $row = $get->fetch_array();
        if($count_trainee==0){
            if($emp_status=='Trainee'){
                $due=getDateEval($con, $effective_date, '70');
                $due2=getDateEval($con, $effective_date, '160');
                $due3=getDateEval($con, $effective_date, '250');
                $notes1=$fullname . " for 3rd Month Evaluation";
                $notes2=$fullname . " for 3rd Month Probationary";
                $notes3=$fullname . " for Pre-regularization Evaluation";
                $con->query("INSERT INTO `reminders_tmp` (personal_id,reminder_date,notes) VALUES ('$id','$due','$notes1'),('$id','$due2','$notes2'),('$id','$due3','$notes3')");
            } 
        }

        if($count_trainee==0 || $row['emp_status']!='Trainee'){
            if($emp_status=='Probationary'){
                $due=getDateEval($con, $effective_date, '90');
                $due2=getDateEval($con, $effective_date, '160');
                $notes1=$fullname . " for 3rd Month Probationary";
                $notes2=$fullname . " for Pre-regularization Evaluation";
                $con->query("INSERT INTO `reminders_tmp` (personal_id,reminder_date,notes) VALUES ('$id','$due','$notes1'),('$id','$due2','$notes2')");
            }
        }
        echo "<script>window.close();</script>";
    }
}
?>
<style type="text/css">
    .header , .sidebar{
        display: none;
    }
    section.content.content--full{
        padding-top: 30px;
    }
    .frmSearch {border: 1px solid #a8d4b1;margin: 2px 0px;padding:40px;border-radius:4px;}
    #name-list{float:left;list-style:none;margin-top:-3px;padding:0;width:70%;position: absolute; z-index:100;width: 60%;}
    #name-list li:hover {
        background: #28422c;
        cursor: pointer;
        font-weight: bold;
        color: white;
    }
    #name-list li {
        padding: 10px;
        background-color: #b5e8bb;
        border-bottom: #bbb9b9 1px solid;
        border-radius: 10px;
        color: black;
    }
    /*#search-supervisor{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;
    }*/
    .add{
        width: 100%;
    }
    .width{
        width:100%;
        box-shadow: 0 1px 10px rgba(0, 0, 0, 0.45), 0 0 0 1px rgba(115, 115, 115, 0.1)!important;
    }
     .card{
        box-shadow: 0 1px 10px rgba(0, 0, 0, 0.45), 0 0 0 1px rgba(115, 115, 115, 0.1)!important;
        min-height: 560px;
        max-height: 5000px;
        margin-bottom: 0px
    }
    .content{
    
    }
    .head{
        background-color:#4a6a4e;
        color:white;
        height: 50px;
        padding: 10px;
    }
</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#search-supervisor").keyup(function(){
        // alert($(this).val());
            $.ajax({
                type: "POST",
                url: "../reports/search_supervisor.php",
                data:'keyword='+$(this).val(),
                beforeSend: function(){
                  $("#search-supervisor").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function(data){
                  $("#suggestion-supervisor").show();
                  $("#suggestion-supervisor").html(data);
                  $("#search-supervisor").css("background","");
                }
            });
        });
    });
     function selectSupervisor(val) {
        $("#search-supervisor").val(val);
        $("#suggestion-supervisor").hide();
    }
    function isNumberKey(evt, obj) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        var value = obj.value;
        var dotcontains = value.indexOf(".") != -1;
        if (dotcontains)
            if (charCode == 46) return false;
        if (charCode == 46) return true;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }    
</script>


<section class="content content--full" >
    <div class="content__inner">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="m-b-0">Add Job</h3>
                <br>
                <div class="card">
                    <div class="card-body">
                        <form method = "POST">
                            <table width="100%">
                                <tr>
                                    <td width="5%"></td>
                                    <td width="25%">Effective Date:</td>
                                    <td width="55%">
                                        <input type = "date" name = "effective_date" class = "form-control">
                                    </td>
                                    <td width="5%"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>End Date:</td>
                                    <td>
                                        <input type = "date" name = "end_date" id="end_date" class = "form-control">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Position:</td>
                                    <td>
                                        <input type = "text" name = "j_position" class = "form-control" placeholder="Position">
                                    </td> 
                                    <td></td>                          
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Employment Status:</td>
                                    <td>
                                        <select class="form-control" id="emp_status" name = "emp_status" required="">
                                            <option selected value ="">Select Employment Status</option>
                                            <option value = "Regular">Regular</option>
                                            <option value = "Probationary">Probationary</option>
                                            <option value = "Trainee">Trainee</option>
                                            <option value = "Project Based">Project Based</option>
                                            <option value = "Consultant">Consultant</option>
                                        </select>
                                    </td>
                                    <td></td>                           
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Department:</td>
                                    <td>
                                        <select class="form-control" id="department" name = "department" required="">
                                            <option disabled visited selected ="">Select Your Department</option>
                                            <?php                                                   
                                                $query=mysqli_query($con,"SELECT * FROM department ORDER BY dept_name")or die(mysqli_error());
                                                 while($row=mysqli_fetch_array($query)){
                                                    ?>
                                                <option value='<?php echo $row['dept_id'] ; ?>'><?php echo $row['dept_name'];?></option>
                                            <?php }?>
                                        </select>
                                    </td> 
                                    <td></td>                          
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Business Unit</td>
                                    <td>
                                        <select class="form-control" id="business_unit" name = "business_unit" required="">
                                            <option disabled visited selected ="">Select Your Business Unit</option>
                                            <?php                                                   
                                                $query1=mysqli_query($con,"SELECT * FROM business_unit ORDER BY bu_name")or die(mysqli_error());
                                                 while($row1=mysqli_fetch_array($query1)){
                                                    ?>
                                                <option value='<?php echo $row1['bu_id'] ; ?>'><?php echo $row1['bu_name'];?></option>
                                            <?php }?>
                                        </select>
                                    </td>  
                                    <td></td>                         
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Location:</td>
                                    <td>
                                        <select class="form-control" id="location" name = "location" required="">
                                            <option disabled visited selected ="">Select Your Location</option>
                                            <?php                                                   
                                                $query2=mysqli_query($con,"SELECT * FROM location ORDER BY location_name")or die(mysqli_error());
                                                 while($row2=mysqli_fetch_array($query2)){
                                                    ?>
                                                <option value='<?php echo $row2['location_id'] ; ?>'><?php echo $row2['location_name'];?></option>
                                            <?php }?>
                                        </select>
                                    </td>    
                                    <td></td>                       
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Salary:</td>
                                    <td><input type = "text" onkeypress="return isNumberKey(event,this)" name = "salary" class = "form-control" placeholder="Salary"></td> 
                                    <td></td>                        
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Per Day:</td>
                                    <td><input type = "text" name = "perday" class = "form-control" placeholder="Per Day"></td> 
                                    <td></td>                           
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Supervisor</td>
                                    <td>
                                        <input type = "text" id = "search-supervisor" name = "supervisor" class = "form-control" placeholder="Supervisor" autocomplete="off">
                                        <div id="suggestion-supervisor"></div>
                                    </td>    
                                    <td></td>                       
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <br>
                                        <input class="btn btn-primary btn-block" type="submit" name="save_job" value='Submit'>                                
                                    </td>
                                </tr>
                            </table>
                            <input type='hidden' name='id' value='<?php echo $id; ?>'>
                        </form>                      
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>
<?php 
include('../template/footer.php'); 
?> 
