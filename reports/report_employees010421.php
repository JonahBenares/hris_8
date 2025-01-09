<?php 
include('../template/header.php'); 
include('../includes/connection.php'); 
include('../template/navbar_other.php'); 
include('../includes/functions.php');

$today=date("Y-m-d");

$getDept = $con->query("SELECT * FROM department ORDER BY dept_name ASC");
$getBU = $con->query("SELECT * FROM business_unit ORDER BY bu_name ASC");
$getLocation = $con->query("SELECT * FROM location ORDER BY location_name ASC");
?>
<!-- <style type="text/css">
    .sidebar:after, .sidebar:before {
        display: block!important;
        content: ""!important;
        position: absolute!important;
        width: 100%!important;
        height: 100%!important;
        top: 0!important;
        left: 0!important;
        z-index: 2!important;
        background-color: #00942e!important;
        
    } #errorBox{
        color:red;
        font-size:12px;
        font-style:italic;
     }
     #errorBox1{
        color:red;
        font-size:12px;
        font-style:italic;
     }
      #errorBox2{
        color:red;
        font-size:12px;
        font-style:italic;
     }
      #errorBox3{
        color:red;
        font-size:12px;
        font-style:italic;
     }
     #errorBox4{
        color:red;
        font-size:12px;
        font-style:italic;
     }
     #errorBox5{
        color:red;
        font-size:12px;
        font-style:italic;
     }
    th{
       font-size:12px!important;
    }
    td{
       font-size:12px;
    }
    @media screen and (max-width: 300px) {
        table {
            width: 67%;
            font-size: 15px;
        }
    }
    input {
        text-transform: capitalize;
    }
   
     .coll{
        border: 1px solid #000 !important;
        height: 30px !important;
        text-transform:capitalize;
    }
</style> -->
<script>
    $(document).ready(function(){
      $("#search-name").keyup(function(){
        $.ajax({
        type: "POST",
        url: "search-name.php",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
          $("#search-name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
          $("#suggestion-name").show();
          $("#suggestion-name").html(data);
          $("#search-name").css("background","#FFF");
        }
        });
      });

       $("#search-position").keyup(function(){
        $.ajax({
        type: "POST",
        url: "search-position.php",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
          $("#search-position").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
          $("#suggestion-position").show();
          $("#suggestion-position").html(data);
          $("#search-position").css("background","#FFF");
        }
        });
      });
    });

    function selectName(val) {
        $("#search-name").val(val);
        $("#suggestion-name").hide();
    }
    function selectPosition(val) {
        $("#search-position").val(val);
        $("#suggestion-position").hide();
    }

    function isNumberKey(evt)
          {
             var charCode = (evt.which) ? evt.which : event.keyCode
             if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

             return true;
          }
</script>
<script>
    function check(id){
        window.open('change_emp_status.php?id='+id, '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=10,width=1320,height=700'); 
        
    }
</script>
<section class="content content--full">
    <div class="content__inner">
        <header class="content__title">
            <h1>Employee List</h1>
            <small>Welcome to the New HRIS web app experience!</small>
            <a href="app_emp.php"  class="m-t-10 btn btn-secondary btn-md">Add New Employee</a>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-fade btn-sm m-t-10">Filter Employee</a>
        </header>
        <?php
            $getDept = $con->query("SELECT * FROM department ORDER BY dept_name ASC");
            $getBU = $con->query("SELECT * FROM business_unit ORDER BY bu_name ASC");
            $getLocation = $con->query("SELECT * FROM location ORDER BY location_name ASC");
        ?>
        <?php 
            if(isset($_POST['keyword'])){
                $filter = $_POST['keyword'];
            }
            if(isset($_POST['fullname'])){
                $fullname = sanitize(utf8_encode($_POST['fullname']));
            }
            if(isset($_POST['position'])){
                $position = $_POST['position'];
            }
            if(isset($_POST['gender'])){
                $gender = $_POST['gender'];
            }else{
                $gender = '';
            }
            if(isset($_POST['department'])){
                $department = $_POST['department'];
            }
            if(isset($_POST['business_unit'])){
                $business_unit = $_POST['business_unit'];
            }
            if(isset($_POST['location'])){
                $location = $_POST['location'];
            }
            if(isset($_POST['age_from']) && isset($_POST['age_to'])){
                $age = $_POST['age_from']."&to=".$_POST['age_to'];
            }
            if(isset($_POST['salary_from']) && isset($_POST['salary_to'])){
                $salary = $_POST['salary_from']."&to=".$_POST['salary_to'];
            }
            if(isset($_POST['bday_from']) && isset($_POST['bday_to'])){
                $bday = $_POST['bday_from']."&to=".$_POST['bday_to'];
            }
            if(isset($_POST['applied_from']) && isset($_POST['applied_to'])){
                $applied = $_POST['applied_from']."&to=".$_POST['applied_to'];
            }
            if(isset($_POST['available_from']) && isset($_POST['available_to'])){
                $available = $_POST['available_from']."&to=".$_POST['available_to'];
            }
            if(isset($_POST['status'])){
                $status = $_POST['status'];
            }
            if(isset($_POST['emp_status'])){
                $emp_status = $_POST['emp_status'];
            }        
        ?>
        <!-- MODAL FOR SEARCHING/FILTERS-->  
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title pull-left">Filter Employees</h5>
                    </div>
                    <div class="modal-body">
                        <div id="errorBox" ></div>   
                        <form method="post"> 
                            <table width="100%" style="margin-bottom:0px;">
                                <tr>
                                    <td width="30%">Full Name:</td>
                                    <td colspan='3'>
                                        <input type='text' name='fullname' id='search-name' class='form-control' placeholder='Last Name, First Name, Middle Name, Name Extension' autocomplete="off">
                                        <div id="suggestion-name"></div>
                                    </td>                                    
                                </tr>
                                <tr>
                                    <td>Position Applied:</td>
                                    <td colspan='3'>
                                        <input type='text' name='position' id='search-position' class='form-control' autocomplete="off">
                                        <div id="suggestion-position"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><br>Gender:<br></td>
                                    <td colspan='3'>
                                        <br>
                                        <input type='radio' name='gender' id='gender' value='Male'> Male &nbsp;&nbsp;
                                        <input type='radio' name='gender' id='gender' value='Female'> Female
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Department:</td>
                                    <td colspan='3'>
                                        <select name='department' class='form-control'>
                                            <option value='' selected>Select Department</option>
                                            <?php while($fetchDept= $getDept->fetch_array()){ ?>
                                            <option value='<?php echo $fetchDept['dept_id']; ?>'><?php echo $fetchDept['dept_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Business Unit:</td>
                                    <td colspan='3'>
                                        <select name='business_unit' class='form-control'>
                                           <option value='' selected>Select Business Unit</option>
                                           <?php while($fetchBU= $getBU->fetch_array()){ ?>
                                            <option value='<?php echo $fetchBU['bu_id']; ?>'><?php echo $fetchBU['bu_name']; ?></option>
                                           <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Location:</td>
                                    <td colspan='3'>
                                       <select name='location' class='form-control'>
                                       <option value='' selected>Select Location</option>
                                       <?php while($fetchLocation= $getLocation->fetch_array()){ ?>
                                        <option value='<?php echo $fetchLocation['location_id']; ?>'><?php echo $fetchLocation['location_name']; ?></option>
                                       <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Age:</td>
                                    <td>
                                        <input type='text' name='age_from' id='age_from' onkeypress="return isNumberKey(event)" class='form-control'>
                                    </td>
                                    <td>to</td>
                                    <td>
                                        <input type='text' name='age_to' id='age_to' onkeypress="return isNumberKey(event)" class='form-control p-l-5'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Expected Salary:</td>
                                    <td>
                                        <input type='text' name='salary_from' id='salary_from' onkeypress="return isNumberKey(event)" class='form-control'>
                                    </td>
                                    <td>to</td>
                                    <td>
                                        <input type='text' name='salary_to' id='salary_to' onkeypress="return isNumberKey(event)" class='form-control p-l-5'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Birthday:</td>
                                    <td>
                                        <input type='date' name='bday_from' id='bday_from' class='form-control'>
                                    </td>
                                    <td>to</td>
                                    <td>
                                        <input type='date' name='bday_to' id='bday_to' class='form-control p-l-5'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date Applied:</td>
                                    <td>
                                        <input type='date' name='applied_from' id='applied_from' class='form-control'>
                                    </td>
                                    <td>to</td>
                                    <td>
                                        <input type='date' name='applied_to' id='applied_to' class='form-control p-l-5'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date Available:</td>
                                    <td>
                                        <input type='date' name='available_from' id='available_from' class='form-control'>
                                    </td>
                                    <td>to</td>
                                    <td>
                                        <input type='date' name='available_to' id='available_to' class='form-control p-l-5'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td colspan='3'>
                                        <select name='status' id='status' class='form-control'>
                                            <option value='' selected>Select Status</option>
                                            <option value='Active'>Active</option>
                                            <option value='Inactive'>Inactive</option>
                                            <option value='Separated'>Separated</option>
                                        </select>
                                    </td>
                                </tr>                               
                                <tr>
                                    <td>Employment Status:</td>
                                    <td colspan='3'>
                                        <select name='emp_status' id='emp_status' class='form-control'>
                                            <option value='' selected>Select Emp Status</option>
                                            <option value = "Regular">Regular</option>
                                            <option value = "Probationary">Probationary</option>
                                            <option value = "Trainee">Trainee</option>
                                            <option value = "Project Based">Project Based</option>
                                            <option value = "Consultant">Consultant</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>  
                            <br>
                            <input type='submit' name='filter_employee' value='Filter Employee' class="btn btn-primary btn-block" ></center>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="amendment" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="border-bottom: 1px solid #fff">
                        <h5 class="modal-title pull-left m-b-5">Amendment Forms</h5>
                    </div>
                    <div class="modal-body">
                        <div id = 'amends'></div> 
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-fill btn-sm" data-dismiss="modal">Close</button>
                    </div> -->
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-11 p-r-0"> 
                                <?php 
                                    if(isset($_POST['filter_employee'])){
                                         $query= filterEmployee($con,$_POST);
                                         $query1=mysqli_query($con, $query) or die(mysqli_error($con));
                                          echo "<div class='alert alert-info alert-dismissible fade show' role='alert'><a href='report_employees.php' class='close'aria-label='Close'><span aria-hidden='true' style='text-align:center'>&times;</span></a><p class='mb-0'> <b>Filters Applied: </b>". filtersApplied($con, $_POST) . "</p></div>";
                                    }if(!isset($_POST['filter_employee'])) {
                                        $query1=mysqli_query($con,"SELECT pd.personal_id, pd.lname, pd.fname, pd.mname, pd.name_ext, pd.contact_no,pd.email, pd.status, pd.emp_status, p.position_applied, p.date_applied, pd.supervisor, pd.status, pd.current_location,pd.date_hired FROM personal_data pd LEFT JOIN position p ON p.personal_id = pd.personal_id WHERE pd.supervisor='0' AND pd.status='Active' ORDER BY pd.date_hired DESC")or die(mysqli_error($con));
                                    }if(isset($_POST['searchengine'])){
                                        echo "<div class='alert alert-info alert-dismissible fade show' role='alert'><a href='report_employees.php' class='close'aria-label='Close'><span aria-hidden='true' style='text-align:center'>&times;</span></a><p class='mb-0'> <b>Filters Applied: </b>" . $_POST['keyword'] . "</p></div>";
                                    }
                                ?>                                  
                            </div>
                            <div class="col-lg-1 p-l-0">
                                <?php if(isset($_POST['keyword'])){ ?>
                                    <a href="export_employees.php?keyword=word&filter=<?php echo $filter; ?>" class="btn btn-warning btn-sm btn-block alert-export text-white"><b>EXPORT</b></a>
                                <?php } else if(isset($_POST['filter_employee'])){ ?>
                                    <a href="export_employees.php?keyword=filt&fullname=<?php echo $fullname; ?>&position=<?php echo $position; ?>&gender=<?php echo $gender; ?>&department=<?php echo $department; ?>&business_unit=<?php echo $business_unit; ?>&location=<?php echo $location; ?>&age=<?php echo $age; ?>&salary=<?php echo $salary; ?>&bday=<?php echo $bday; ?>&applied=<?php echo $applied; ?>&available=<?php echo $available; ?>&status=<?php echo $status; ?>&emp_status=<?php echo $emp_status; ?>" class="btn btn-warning btn-sm btn-block alert-export text-white"><b>EXPORT</b></a>
                                <?php } ?> 
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTables-example" class="table table-bordered table-hover">
                                <thead>
                                    <tr style="background: #fff1">
                                        <th hidden="">Id</th>
                                        <th hidden=""></th>
                                        <th width="25%" ><center>FullName</center></th>
                                        <th width="10%" ><center>Date hired</center></th>
                                        <th width="20%" ><center>Applied/Current Position</center></th>
                                        <th width="5%" ><center>Profession</center></th>
                                        <th width="10%" ><center>Contact Number</center></th>
                                        <th width="10%" ><center>Corporate Email</center></th>
                                        <th width="5%" ><center>Status</center></th>
                                        <th width="10%" ><center>Action</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php      
                                        if(!isset($_POST['searchengine'])){
                                        while ($row=mysqli_fetch_array($query1)){
                                        $data[] = $row;
                                        $columns = array_column($data, 'date_hired');
                                        $a = array_multisort($columns, SORT_DESC, $data);
                                        $personal_id = $row['personal_id'];
                                        $profession = getInfo($con, 'profession', 'additional_info', 'personal_id', $row['personal_id']);
                                        $fullname = sanitize(utf8_encode($row['lname'].', '.$row['fname'].' '.$row['name_ext'].', '.$row['mname']));
                                    ?> 
                                    <tr>
                                        <td hidden> <?php echo $row[ 'personal_id'];?></td>
                                        <td hidden=""></td>
                                        <td class="emp-td" >
                                            <a class="btn btn-block emp-btn" href="employee_profile.php?id=<?php echo $row['personal_id']?>">
                                                <?php echo $fullname;?>                                                    
                                            </a>
                                        </td>
                                        <td align="center">
                                            <?php echo (!empty($row['date_hired'])) ? date("M j, Y",strtotime($row['date_hired'])) : '';?>
                                        </td>
                                        <?php
                                            $sqlii = mysqli_query($con, "SELECT * FROM job_history WHERE personal_id = '$row[personal_id]'");
                                            $rowww = mysqli_fetch_array($sqlii);
                                            if(!empty($row['position_applied']) && empty($rowww['j_position'])){
                                        ?>
                                        <td style="text-transform:capitalize;">
                                            <?php  echo getCurrentApplied($con, $row['personal_id'], $row['position_applied']); ?>
                                        </td>
                                        <?php } else { ?>
                                        <td style="text-transform:capitalize;">
                                            <?php  echo getCurrentJob($con, $row['personal_id'], $rowww['j_position']); ?>
                                        </td>
                                        <?php } ?>
                                        <td><?php echo $profession; ?></td>
                                        <td align="center"><?php echo $row['contact_no'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td>
                                            <?php if($row['status'] == 'Active'){ ?>
                                            <center>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-active" data-toggle="modal">Active</a>
                                                <?php if($row['emp_status'] == 'Regular'){ ?>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-reg" data-toggle="modal">Regular</a>
                                                <?php } else if($row['emp_status'] == 'Probationary'){ ?>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-prob" data-toggle="modal">Probationary</a>
                                                <?php } else if($row['emp_status'] == 'Trainee'){ ?>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-tran" data-toggle="modal">Trainee</a>
                                                <?php } else if($row['emp_status'] == 'Project Based'){ ?>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-proj" data-toggle="modal">Project Based</a>
                                                <?php } else if($row['emp_status'] == 'Consultant') { ?>  
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-con" data-toggle="modal">Consultant</a>
                                                <?php } else{ ?>
                                                <?php } ?>                                                
                                            </center>
                                            <?php } else if($row['status'] == 'Separated') { ?>
                                            <center>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-sep" data-toggle="modal">Separated</a>
                                            </center>
                                            <?php } else { ?>
                                            <center>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)'  class="lbl lbl-inactive" data-toggle="modal" >Inactive</a>
                                            </center>
                                            <?php } ?>                                                
                                        </td>
                                        <td>
                                            <center >
                                                <a href='view_upload.php?id=<?php echo $row['personal_id']; ?>' class="btn btn-sm btn-primary" title='View Files' alt='Upload Files'data-toggle="tooltip"data-placement="top">
                                                    <span class="zmdi zmdi-collection-image-o" ></span>
                                                </a>
                                                <a href='form.php?id=<?php echo $row[ 'personal_id']; ?>' class="btn btn-sm btn-danger " title='View Employee Application Form' alt='View Employee Application Form' data-toggle="tooltip" data-placement="top">
                                                    <span class="zmdi zmdi-copy"></span>
                                                </a>
                                                <span  data-toggle="modal" data-target="#amendment">
                                                <a class="btn btn-sm btn-success " data-toggle="tooltip" data-placement="top" title='Amendment Form' alt='Amendment Form' id = "amend" data-id="<?php echo $row['personal_id']; ?>" >
                                                    <span class="zmdi zmdi-file-text"></span>
                                                </a>
                                                </span>
                                            </center>
                                        </td>
                                    </tr> 
                                    <?php } 
                                    } else {
                                        foreach(searchEngine($con,$_POST['keyword']) AS $id){
                                            $query1=mysqli_query($con,"SELECT pd.personal_id, pd.lname, pd.fname, pd.mname, pd.name_ext, pd.contact_no,pd.email, pd.status, pd.emp_status, p.position_applied, p.date_applied, pd.supervisor, pd.status, pd.current_location,pd.date_hired FROM personal_data pd LEFT JOIN position p ON p.personal_id = pd.personal_id WHERE pd.personal_id = '$id'")or die(mysqli_error($con));
                                            $row=mysqli_fetch_array($query1); 
                                            $personal_id = $row['personal_id'];
                                            $profession = getInfo($con, 'profession', 'additional_info', 'personal_id', $row['personal_id']);
                                            $fullname = sanitize(utf8_encode($row['lname'].' ,'.$row['fname'].' '.$row['name_ext'].' ,'.$row['mname']));
                                        if($row['supervisor']=='0'){
                                    ?> 
                                    <tr>
                                        <td hidden> <?php echo $row[ 'personal_id'];?></td>
                                        <td hidden=""></td>
                                        <td class="emp-td" >
                                            <a class="btn btn-block emp-btn" href="employee_profile.php?id=<?php echo $row['personal_id']?>">
                                                <?php echo $fullname;?>                                                    
                                            </a>
                                        </td>
                                        <td align="center"><?php echo (!empty($row['date_hired'])) ? date("M j, Y",strtotime($row['date_hired'])) : '';?></td>
                                        <td style="text-transform:capitalize;"><?php echo $row['position_applied'];?></td>
                                        <td><?php echo $profession; ?></td>
                                        <td><?php echo $row['contact_no'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td>
                                            <?php if($row['status'] == 'Active'){ ?>
                                            <center>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-active" data-toggle="modal">Active</a>
                                                <?php if($row['emp_status'] == 'Regular'){ ?>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-reg" data-toggle="modal">Regular</a>
                                                <?php } else if($row['emp_status'] == 'Probationary'){ ?>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-prob" data-toggle="modal">Probationary</a>
                                                <?php } else if($row['emp_status'] == 'Trainee'){ ?>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-tran" data-toggle="modal">Trainee</a>
                                                <?php } else if($row['emp_status'] == 'Project Based'){ ?>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-proj" data-toggle="modal">Project Based</a>
                                                <?php } else if($row['emp_status'] == 'Consultant') { ?>  
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-con" data-toggle="modal">Consultant</a>
                                                <?php } else{ ?>
                                                <?php } ?>                                                
                                            </center>
                                            <?php } else if($row['status'] == 'Separated') { ?>
                                            <center>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)' class="lbl lbl-sep" data-toggle="modal">Separated</a>
                                            </center>
                                            <?php } else { ?>
                                            <center>
                                                <a onclick='check(<?php echo $row[ 'personal_id']; ?>)'  class="lbl lbl-inactive" data-toggle="modal" >Inactive</a>
                                            </center>
                                            <?php } ?>                                                
                                        </td>
                                        <td >
                                            <center >
                                                <a href='view_upload.php?id=<?php echo $row['personal_id']; ?>' class="btn btn-sm btn-primary" title='View Files' alt='Upload Files'data-toggle="tooltip"data-placement="top">
                                                    <span class="zmdi zmdi-collection-image-o" ></span>
                                                </a>
                                                <a href='form.php?id=<?php echo $row[ 'personal_id']; ?>' class="btn btn-sm btn-danger " title='View Employee Application Form' alt='View Employee Application Form' data-toggle="tooltip" data-placement="top">
                                                    <span class="zmdi zmdi-copy"></span>
                                                </a>
                                                <a class="btn btn-sm btn-success " data-toggle="tooltip"data-placement="top" title='Amendment Form' alt='Amendment Form' data-toggle="modal" id = "amend" data-id="<?php echo $row['personal_id']; ?>" data-target="#amendment">
                                                    <span class="zmdi zmdi-file-text"></span>
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php } } } ?>                                        
                                </tbody>
                            </table>  
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>

<?php 
include('../template/footer.php'); 
?>  
<script>
    /*$(document).ready(function() {
        $('#dataTables-example').DataTable({
            "bLengthChange":true,
            "bInfo":true,
            "bSort":true,
            "bFilter":true,
            "order": [[ 2, 'desc' ]]
        });

    
    });*/
    $(document).ready(function(){
        $('#dataTables-example').DataTable({
            "order": [[ 1, "asc" ]],
            lengthMenu:[[15,30,45,-1],["15 Rows","30 Rows","45 Rows","Everything"]],
            language:{searchPlaceholder:"Search for records..."},
        });
    });
    $(document).ready(function(){
        $(document).on('click', '#amend', function(e){
            e.preventDefault();
            var uid = $(this).data('id');    
            $.ajax({
                  url: 'fetch_amendment.php',
                  type: 'POST',
                  data: 'id='+uid,
                beforeSend:function(){
                    $("#amends").html('Please wait ..');
                },
                success:function(data){
                   $("#amends").html(data);
                },
            })
        });
    });
    $(document).on("click", "#amend", function () {
         var personal_id = $(this).data('id');
         $("#personal_id").val(personal_id);
    });
</script>
<script type="text/javascript">
 $(document).on("click", "#updateDept_button", function() {
     var bu_id = $(this).attr("data-id");
     var bu_name = $(this).attr("data-buname");
     $("#bu_id").val(bu_id);
     $("#bu_name").val(bu_name);
    });
</script> 