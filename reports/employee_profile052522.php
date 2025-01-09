<?php 
include('../template/header.php'); 
include('../includes/connection.php'); 
include('../template/navbar.php'); 
include('../includes/functions.php');
if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
}
else{
    $id = $_POST['id'];
}
?>  
<?php 
    $sql  = mysqli_query($con,"SELECT * FROM personal_data pd LEFT JOIN family_background fb ON pd.personal_id = fb.personal_id LEFT JOIN employment_history eh ON pd.personal_id = eh.personal_id LEFT JOIN educational_background eb ON pd.personal_id = eb.personal_id LEFT JOIN character_reference cr ON pd.personal_id = cr.personal_id LEFT JOIN person_to_contact pt ON pd.personal_id = pt.personal_id LEFT JOIN additional_info ai ON pd.personal_id = ai.personal_id LEFT JOIN position p ON pd.personal_id = p.personal_id WHERE pd.personal_id = '$id'")or die(mysqli_error($con));
    $row = mysqli_fetch_array($sql);
    $fullname = $row['fname'].' '.$row['mname'].' '.$row['lname'].' '.$row['name_ext'];
    $ed_from =  date("M. j, Y",strtotime($row['ed_from']));
    $ed_to = date("M. j, Y",strtotime($row['ed_to']));

    $ed_from_high =  date("M. j, Y",strtotime($row['h_from']));
    $ed_to_high = date("M. j, Y",strtotime($row['h_to']));

    $ed_from_elem =  date("M. j, Y",strtotime($row['e_from']));
    $ed_to_elem = date("M. j, Y",strtotime($row['e_to']));

    $ed_from_post =  date("M. j, Y",strtotime($row['p_from']));
    $ed_to_post = date("M. j, Y",strtotime($row['p_to']));
?>
<style type="">
    small{
        margin-top: 0px!important;
    }
    body{
        overflow-x: hidden
    }
    .pull-right {
        float: none !important;
    }
</style>
<section class="content">
    <div class="content__inner content__inner--sm">
        <header class="content__title">
            <a onclick="goBack()" class="actions__item" title="Back" data-toggle="tooltip"data-placement="right"><b></b><span class="zmdi zmdi-caret-left-circle"></span></b></a>
            <div class="actions">
                <a href="update_emp.php?id=<?php echo $row[ 'personal_id']; ?>" class="actions__item"  title='Update Employee' alt='Update Employee' data-toggle="tooltip" data-placement="bottom">
                    <span class="zmdi zmdi-edit"></span>
                </a>
                <a href="view_upload.php?id=<?php echo $row['personal_id']; ?>" class="actions__item" title='View Files' alt='Upload Files'data-toggle="tooltip" data-placement="bottom">
                    <span class="zmdi zmdi-collection-image-o"></span>
                </a>
                <a href="form.php?id=<?php echo $row[ 'personal_id']; ?>" class="actions__item"  title='View Employee Application Form' alt='View Employee' data-toggle="tooltip" data-placement="bottom">
                    <span class="zmdi zmdi-copy"></span>
                </a>
            </div>   
        </header>
        
        <div class="card profile">
            <div class="profile__img">
                <img src="../uploads/<?php 
                    if (empty($row['photo_upload'])){
                        echo "user.png";
                    }
                    else{
                        echo $row['photo_upload']; 
                    }
                ?>" alt="Avatar" >
            </div>
            
            <div class="profile__info"> 
                <h1 style="font-size: 20px" class="m-t-20"><b><?php echo sanitize(utf8_encode($fullname)); ?></b></h1>
                <div style="display: inline-flex;">
                <?php if($row['status'] == 'Active'){  ?>
                <span class="lbl lbl-active m-r-5 round-corn">Active</span>
                <?php if($row['emp_status'] == 'Regular'){ ?>
                    <span class="lbl lbl-reg round-corn">Regular</span>
                <?php } else if($row['emp_status'] == 'Probationary'){ ?>
                    <span class="lbl lbl-prob round-corn">Probationary</span>
                <?php } else if($row['emp_status'] == 'Trainee'){ ?>
                    <span class="lbl lbl-tran round-corn">Trainee</span>
                <?php } else if($row['emp_status'] == 'Project Based'){ ?>
                    <span class="lbl lbl-proj round-corn">Project Based</span>
                <?php } else if($row['emp_status'] == 'Consultant') { ?>  
                    <span class="lbl lbl-con round-corn">Consultant</span>
                <?php } else{ ?>
                <?php } ?>
                <?php } else if($row['status'] == 'Separated') { ?>
                    <span class="lbl lbl-se round-cornp">Separated</span> 
                    <label style = "color:#f59a9a">Date Separated: <?php echo $row['date_separated'];?></label> 
                <?php } else { ?>
                    <span  class="lbl lbl-inactive round-corn">Inactive</span>
                <?php } ?> 
                </div>     
                <ul class="icon-list m-t-20">
                    <li><i class="zmdi zmdi-phone"></i>
                        <?php echo (!empty($row['contact_no'])) ? $row['contact_no'] : "Contact number not found" ?>
                    </li>
                    <li><i class="zmdi zmdi-email"></i> 
                        <?php 
                            if (empty($row['email'])) {
                                echo "Email not found";
                            }else{
                                echo $row['email']; 
                            }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="toolbar">
            <div class="btn-group">
                <a class="btn btn-light" style="background: #fff0" onclick="about()">ABOUT</a>
                <a class="btn btn-light" style="background: #fff0" onclick="fambtn()">FAMILY BACKGROUND</a>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-light dropdown-toggle" style="background: #fff0" data-toggle="dropdown">
                        HISTORY
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" onclick="empbtn()">Employment History</a>
                        <a class="dropdown-item" onclick="jobbtn()">Job History</a>
                        <a class="dropdown-item" onclick="evalbtn()">Evaluation History</a>
                        <a class="dropdown-item" onclick="allowbtn()">Allowance</a>
                        <a class="dropdown-item" onclick="disbtn()">Disciplinary Action</a>
                    </div>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-light dropdown-toggle" style="background: #fff0" data-toggle="dropdown">
                        OTHERS
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" onclick="educbtn()">Educational Background</a>
                        <a class="dropdown-item" onclick="addbtn()">Additional Background</a>
                        <a class="dropdown-item" onclick="charbtn()">Character Reference</a>
                        <a class="dropdown-item" onclick="emebtn()">Emergency Contact</a>
                    </div>
                </div>
            </div> 
            <div class="actions">
                <i class="actions__item zmdi zmdi-search" data-sa-action="toolbar-search-open"></i>
            </div>
            <div class="toolbar__search">
                <input type="text" placeholder="Search...">
                <i class="toolbar__search__close zmdi zmdi-long-arrow-left" data-sa-action="toolbar-search-close"></i>
            </div>
        </div>
        <!-- about -->
        <div class="card animated fadeIn" id="aboutCard">
            <div class="card-header">
                <h4 class=" m-b-0">About <?php echo sanitize(utf8_encode($fullname)); ?></h4>
            </div>
            <div class="card-body">                
                <table width="100%">
                    <tr>
                        <td width="15%"></td>
                        <td width="85%"></td>
                    </tr>
                    <tr>
                        <td><p class="m-b-0">Age:</p></td>
                        <td><p class="m-b-0"><?php echo computeAge($row['bdate']); ?></p></td>
                    </tr>
                    <tr>
                        <td><p class="m-b-0">Sex:</p></td>
                        <td><p class="m-b-0"><?php echo $row['sex']; ?></p></td>
                    </tr>
                    <tr>
                        <td><p class="m-b-0">Civil Status:</p></td>
                        <td><p class="m-b-0"></i><?php echo $row['civil_status']; ?></p></td>
                    </tr>
                    <tr>
                        <td><h5 class="card-body__title m-t-20 m-b-5">ADDRESS</h5></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><p class="m-b-0"><b>Permanent:</b></p></td>
                        <td>
                            <p class="m-b-0">
                                <?php echo $row['permanent_address'] .', '. getInfo($con, 'name', 'cities', 'id', $row['pre_city']).', '.getInfo($con, 'name', 'provinces', 'id', $row['pre_prov']);?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td><p class="m-b-0"><b>Present:</b></p></td>
                        <td>
                            <p class="m-b-0">
                                <?php echo $row['provincial_address'].', '. getInfo($con, 'name', 'cities', 'id', $row['perm_city']).', '.getInfo($con, 'name', 'provinces', 'id', $row['perm_prov']); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td><p class="m-t-20 m-b-0">Date of Birth:</p></td>
                        <td><p class="m-t-20 m-b-0"></i><?php echo date("M d, Y", strtotime($row['bdate'])); ?></p></td>
                    </tr>
                    <tr>
                        <td><p class="m-b-0">Place of Birth:</p></td>
                        <td><p class="m-b-0"></i><?php echo $row['place_birth']; ?></p></td>
                    </tr>
                    <tr>
                        <td><p class="m-b-0">Nationality:</p></td>
                        <td><p class="m-b-0"></i><?php echo $row['nationality']; ?></p></td>
                    </tr>
                    <tr>
                        <td><p class="m-b-0">Religion:</p></td>
                        <td><p class="m-b-0"></i><?php echo $row['religion']; ?></p></td>
                    </tr>
                    <tr>
                        <td><p class="m-b-0">Weight:</p></td>
                        <td><p class="m-b-0"></i><?php echo $row['weight']; ?></p></td>
                    </tr>
                    <tr>
                        <td><p class="m-b-0">Height:</p></td>
                        <td><p class="m-b-0"></i><?php echo $row['height']; ?></p></td>
                    </tr>
                </table>                
            </div>
        </div>

        <!-- Family -->
        <div class="card animated fadeIn" id="famCard">
            <div class="card-header">
                <h4 class=" m-b-0">Family Background</h4>
            </div>
            <div class="card-body">
                <div class="contacts row">
                    <div class="col-xl-4 col-4 col-sm-4 col-lg-4">
                        <div class="contacts__item">
                            <a href="#" class="contacts__img">
                                <img src="../assets/img/users/male1.png" alt="">
                            </a>
                            <div class="contacts__info">
                                <b>FATHER</b>
                                <hr class="m-t-0">
                                <p style="text-transform: uppercase;" class="m-b-0">
                                    <strong >
                                        <?php echo (!empty($row['father_name'])) ? sanitize(utf8_encode($row['father_name'])):  "N/A" ?>
                                    </strong>
                                </p>
                                <small>
                                    <?php echo (!empty($row['fa_bday'])) ? $row['fa_bday'] :  "Update Birthday" ?>
                                </small>
                                <small><?php echo (!empty($row['fa_bday'])) ? computeAge($row['fa_bday']) : $row['fa_age']; ?> years old</small>
                                <br>
                                <p><?php echo (!empty($row['occupation'])) ? sanitize(utf8_encode($row['occupation'])):  "N/A" ?></p>
                                <br>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-4 col-sm-4 col-lg-4">
                        <div class="contacts__item">
                            <a href="#" class="contacts__img">
                                <img src="../assets/img/users/female1.png" alt="">
                            </a>
                            <div class="contacts__info">
                                <b>MOTHER</b>
                                <hr class="m-t-0">
                                <p style="text-transform: uppercase;" class="m-b-0">
                                    <strong >
                                        <?php echo (!empty($row['mother_name'])) ? sanitize(utf8_encode($row['mother_name'])):  "N/A" ?>
                                    </strong>
                                </p>
                                <small>
                                    <?php echo (!empty($row['m_bday'])) ? $row['m_bday'] :  "Update Birthday" ?>
                                </small>
                                <small><?php echo (!empty($row['m_bday'])) ? computeAge($row['m_bday']) : $row['m_age']; ?> years old</small>
                                <br>
                                <p><?php echo (!empty($row['m_occupation'])) ? sanitize(utf8_encode($row['m_occupation'])):  "N/A" ?></p>
                                <br>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-4 col-sm-4 col-lg-4">
                        <div class="contacts__item">
                            <a href="#" class="contacts__img">
                                <img src="../assets/img/users/spouse.png" alt="">
                            </a>
                            <div class="contacts__info">
                                <b>SPOUSE</b>
                                <hr class="m-t-0">

                                <p style="text-transform: uppercase;" class="m-b-0">
                                    <strong >
                                        <?php echo (!empty($row['name_spouse'])) ? sanitize(utf8_encode($row['name_spouse'])):  "N/A" ?>
                                    </strong>
                                </p>
                                <small>
                                    <?php echo (!empty($row['n_bday'])) ? $row['n_bday'] :  "Update Birthday" ?>
                                </small>
                                <small><?php echo (!empty($row['n_bday'])) ? computeAge($row['n_bday']) : $row['n_age']; ?> years old</small>
                                <br>
                                <p class="m-b-0"><?php echo (!empty($row['n_occupation'])) ? sanitize(utf8_encode($row['n_occupation'])):  "N/A" ?></p>
                                <p ><?php echo (!empty($row['employers_name_address'])) ? sanitize(utf8_encode($row['employers_name_address'])):  "N/A" ?></p>
                            </div>
                        </div>
                    </div>      
                </div>
                <hr class="m-b-0">
                <p class="m-b-5 m-t-5">SIBLING/S</p>    
                <hr class="m-b-0 m-t-0">
                <?php
                $query1 = mysqli_query($con, "SELECT * FROM siblings WHERE personal_id = '$id'")or die(mysqli_error($con));
                $rows10 = $query1->num_rows;
                if($rows10 != 0 ){ ?>
                <div class="listview listview--bordered">
                    <?php while ($row1 = mysqli_fetch_array($query1)) { ?>                        
                    <div class="listview__item p-t-10 p-b-10">
                        <label class="custom-control custom-control--char todo__item">
                            <span style="position: absolute;font-style: normal;width: 3rem;height: 3rem;border-radius: 50%;left: 0;top: 0;">
                                <a href="#" class="contacts__img">
                                    <img src="../assets/img/users/user1.png" alt="">
                                </a>
                            </span>
                            <div class="todo__info" style="width:300px">
                                <p style="text-transform: uppercase;" class="m-b-0">
                                    <strong ><?php echo sanitize(utf8_encode($row1['siblings_name'])); ?></strong>
                                </p>
                                <small ><?php echo (!empty($row1['siblings_bday'])) ? computeAge($row1['siblings_bday']) : $row1['siblings_age']; ?> years old</small>
                                <small ><span class="zmdi zmdi-cake m-r-10"></span><?php echo (!empty($row['siblings_bday'])) ? $row['siblings_bday'] :  "Update Birthday"?></small>
                            </div>
                        </label>
                        <label class="custom-control custom-control--char todo__item p-l-20"  >
                            <div class="todo__info">
                                <br>
                                <small ><?php echo $row1['siblings_occupation']; ?> at</small>
                                <small ><?php echo (!empty($row['emp_na_add'])) ? $row['emp_na_add'] :  "N/A" ?></small>                                
                            </div>
                        </label>
                    </div>
                    <?php }  ?>                    
                </div>                 
                <?php } else { ?>
                    <div style='border:1px solid #fff; padding: 20px'>
                        <center>
                           <span class="label label-danger">No Available Data </span>
                        </center>
                    </div>
                <?php } ?>
                <hr class="m-b-0">
                <p class="m-b-5 m-t-5">CHILDREN</p>    
                <hr class="m-b-0 m-t-0">
                <?php
                $query2 = mysqli_query($con, "SELECT * FROM children WHERE personal_id = '$id'")or die(mysqli_error($con));
                $rows11 = $query2->num_rows;
                if($rows11 != 0 ){ ?>
                    <div class="listview listview--bordered">
                        <?php 
                            while ($row2 = mysqli_fetch_array($query2)) {
                            $date = date('M. j, Y',strtotime($row2['child_bday'])); 
                        ?>                 
                        <div class="listview__item p-t-10 p-b-10">
                            <label class="custom-control custom-control--char todo__item">
                                <span style="    position: absolute;font-style: normal;width: 3rem;height: 3rem;border-radius: 50%;left: 0;top: 0;">
                                    <a href="#" class="contacts__img">
                                        <img src="../assets/img/users/user1.png" alt="">
                                    </a>
                                </span>
                                <div class="todo__info" style="width:300px">
                                    <p style="text-transform: uppercase;" class="m-b-0">
                                        <strong ><?php echo sanitize(utf8_encode($row2['child_name'])); ?></strong>
                                    </p>
                                    <small ><?php echo (!empty($row1['child_bday'])) ? computeAge($row1['child_bday']) : "0" ?> years old</small>
                                    <small >
                                        <span class="zmdi zmdi-cake m-r-10"></span>
                                        <?php echo $date; ?>
                                    </small>
                                </div>
                            </label>                        
                        </div>
                        <?php } ?>
                    </div>
                    <?php } else { ?>
                    <div style='border:1px solid #fff; padding: 20px'>
                        <center>
                           <span class="label label-danger">No Available Data </span>
                        </center>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- employment_history -->
        <div class="card animated fadeIn" id="empCard">
            <div class="card-header">
                <h4 class=" mb-0    ">Employment History</h4>
            </div>
            <div class="card-body">                
                <div class="listview listview--bordered">
                    <?php
                        $query3 = mysqli_query($con,"SELECT * FROM employment_history WHERE personal_id = '$id'")or die(mysqli_error($con));
                        $rows1 = $query3->num_rows;
                        if($rows1 != 0 ){ 
                        while ($row3 = mysqli_fetch_array($query3)) {
                        if(!empty($row3['em_from'])) $emfrom1 = date("F Y",strtotime($row3['em_from']));
                        else $emfrom1='';

                        if(!empty($row3['em_to'])) $emto1 = date("F Y",strtotime($row3['em_to'])); 
                        else $emto1='';
                    ?>            
                    <div class="listview__item p-t-10">
                        <label class="custom-control custom-control--char todo__item">
                            <span style="  position: absolute;font-style: normal;width: 3rem;height: 3rem;border-radius: 50%;left: 0;top: 0;">
                                <a href="#" class="contacts__img">
                                    <h1><span class="zmdi zmdi-accounts-list"></span></h1>
                                </a>
                            </span>
                            <div class="todo__info">
                                <p class="m-b-0">
                                    <strong ><?php echo $row3['em_position']; ?></strong> at <strong><?php echo $row3['name_address_employer']; ?></strong>
                                </p>
                                <small><?php echo $emfrom1. ' - ' .$emto1 ?></small>
                                <small >Remarks: <?php echo $row3['em_remarks']; ?></small>
                            </div>
                        </label>                        
                    </div>  
                    <?php } }
                        else{
                    ?>
                    <div style='border:1px solid #fff; padding: 20px'>
                        <center>
                           <span class="label label-danger">No Available Data </span>
                        </center>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- job_history -->
        <div class="card animated fadeIn" id="jobCard">
            <div class="card-header">
                <h4 class=" m-b-0">Job History</h4>
            </div>
            <div class="card-body">                
                <div class="listview listview--bordered">
                    <div class="p-b-20 p-t-20 p-l-20 p-r-20"  style="border: 1px solid #fff">
                        <table width="100%">
                            <tbody>
                                <tr width="200">
                                    <td><p class="m-b-0"><b>Position Applied:</b> <?php echo $row['position_applied'];?> </p></td>
                                    <td><p class="m-b-0"><b>Expected Salary:</b> ₱ <?php echo number_format($row['sal_from'],2).' - ₱ '.number_format($row['sal_to'],2);?></p></td>
                                </tr>
                                <tr>
                                    <td><p class="m-b-0"><b>Date Applied:</b> <?php echo (!empty($row['date_applied']) ? date('M. d, Y', strtotime($row['date_applied'])) : ''); ?> </p></td>
                                    <td>
                                        <p class="m-b-0"><b>Date Available:</b> 
                                            <?php
                                            if(empty($row['date_available'])){
                                                $date_available = "";
                                            }
                                            else {
                                                $date_available = date("M. j, Y",strtotime($row["date_available"]));
                                                echo $date_available;
                                            }                                           
                                            ?>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <hr class="m-t-0" style="border:3px solid rgba(255,255,255,.125)">
                    <?php
                        $query4 = mysqli_query($con,"SELECT * FROM job_history WHERE personal_id = '$id' ORDER BY history_id DESC")or die(mysqli_error($con));
                        $rows = $query4->num_rows;
                        if($rows != 0 ){                    
                            while($row4 = mysqli_fetch_array($query4)){
                    ?>
                    <div style="padding-left: 6.7rem;right:0" class="pull-right">
                        <p class="m-b-0">Effective Date: <?php echo date('M. d, Y', strtotime($row4['effective_date'])); ?></p>
                    </div>
                    <hr class="m-b-0 m-t-0">                        
                    <div class="listview__item p-t-10">
                        <label class="custom-control custom-control--char todo__item " style="width:300px">
                            <span style="  position: absolute;font-style: normal;width: 3rem;height: 3rem;border-radius: 50%;left: 0;top: 0;">
                                <a href="#" class="contacts__img">
                                    <h1><span class="zmdi zmdi-format-indent-increase"></span></h1>
                                </a>
                            </span>
                            <div class="todo__info">
                                <p class="m-b-0">
                                    <strong >
                                        <?php echo (!empty($row4['j_position'])) ? $row4['j_position'] : "N/A"; ?>                                      
                                    </strong>
                                </p>
                                <small>Job Position</small>
                                <br>
                                <p class="m-b-0">
                                    <?php $dept = getInfo($con, 'dept_name', 'department', 'dept_id',  $row4['department_id']); ?>
                                    <strong >
                                    <?php echo (!empty($dept)) ? $dept : "N/A";?>                                        
                                    </strong>
                                </p>
                                <small>Department</small>
                                <br>
                                    <?php $sup =  getSupName($con, $row4['supervisor']); ?>
                                <p class="m-b-0"><strong ><?php echo (!empty($sup)) ? $sup : "N/A"?></strong></p>
                                <small>Supervisor</small>
                            </div>
                        </label>      
                        <label class="custom-control custom-control--char todo__item ">
                            <div class="todo__info">
                                <p class="m-b-0"><strong ><?php echo getInfo($con, 'location_name', 'location', 'location_id',  $row4['location_id']); ?></strong></p>
                                <small>Location</small>
                                <br>
                                <p class="m-b-0"><strong ><?php echo getInfo($con, 'bu_name', 'business_unit', 'bu_id',  $row4['bu_id']); ?></strong></p>
                                <small>Business Unit</small>
                                <br>
                                <p class="m-b-0"><strong >₱ <?php echo number_format($row4['salary'],2)?></strong></p>
                                <small>Salary</small>
                            </div>
                        </label>                  
                    </div>                      
                    <hr class="m-t-0" style="border:3px solid rgba(255,255,255,.125)">
                    <?php } }
                        else{
                    ?>
                    <div style='border:1px solid #fff; padding: 20px'>
                        <center>
                           <span class="label label-danger">No Available Data </span>
                        </center>
                    </div>
                    <?php } ?>
                    <span id="job"></span>
                </div>
            </div>
        </div>
        
        <!-- evaluation_history -->
        <div class="card animated fadeIn" id="evalCard">
            <div class="card-header">
                <h4 class=" mb-0">Evaluation History</h4>
            </div>
            <div class="card-body">
                <?php
                $query5 = mysqli_query($con,"SELECT * FROM evaluation_history WHERE personal_id = '$id' ORDER BY effective_date DESC")or die(mysqli_error($con));           
                $rows4 = $query5->num_rows;   
                if($rows4 != 0 ){   ?>
                <table class="table" style="border-right: 1px solid grey;border-left: 1px solid grey;border-bottom: 1px solid grey;border-top: 1px solid grey;" >
                    <thead> 
                        <tr style="background: rgba(255,255,255,.125)">
                            <th>Evaluation Date</th>
                            <th>Score</th>
                            <th>Evaluation Type</th>
                            <th>Adjustment</th>
                            <th>Effective Date</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php                           
                            while($fetch4 = mysqli_fetch_array($query5)){
                        ?>
                        <tr>                                    
                            <td><?php echo date('F Y', strtotime($fetch4['eval_date']));?></td>
                            <td><?php echo $fetch4['score'];?></td>
                            <td><?php echo $fetch4['eval_type'];?></td> 
                            <td><?php echo number_format($fetch4['adjustment'],2);?></td>   
                            <td><?php echo date('M. d, Y', strtotime($fetch4['effective_date']));?></td>                                    
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <?php } else { ?>
                <div style='border:1px solid #fff; padding: 20px'>
                    <center>
                       <span class="label label-danger">No Available Data </span>
                    </center>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- allowance -->
        <div class="card animated fadeIn" id="allowCard">
            <div class="card-header">
                <h4 class=" mb-0">Allowances</h4>
            </div>
            <div class="card-body">
                <?php
                $query6 = mysqli_query($con,"SELECT * FROM allowance WHERE personal_id = '$id'")or die(mysqli_error($con));         
                $rows5 = $query6->num_rows;   
                if($rows5 != 0 ){   ?>
                    <table class="table" style="border-right: 1px solid grey;border-left: 1px solid grey;border-bottom: 1px solid grey;border-top: 1px solid grey;" >
                        <thead> 
                            <th>Description</th>
                            <th>Amount</th>
                        </thead>
                        <tbody>
                            <?php                           
                                    while($fetch5 = mysqli_fetch_array($query6)){
                            ?>
                            <tr>                                    
                                <td><?php echo $fetch5['description'];?></td>
                                <td><?php echo number_format($fetch5['amount'],2);?></td>                           
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <?php } else { ?>
                <div style='border:1px solid #fff; padding: 20px'>
                    <center>
                       <span class="label label-danger">No Available Data </span>
                    </center>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- disciplinary_action -->
        <div class="card animated fadeIn" id="disCard">
            <div class="card-header">
                <h4 class=" mb-0">Disciplinary Actions</h4>
            </div>
            <div class="card-body">
                <?php
                $query7 = mysqli_query($con,"SELECT * FROM disciplinary_action WHERE personal_id = '$id' ORDER BY offense_date ASC")or die(mysqli_error($con));         
                $rows6 = $query7->num_rows;
                if($rows6 != 0 ){   ?>
                    <table class="table" style="border-right: 1px solid grey;border-left: 1px solid grey;border-bottom: 1px solid grey;border-top: 1px solid grey;" >
                        <thead> 
                            <tr>
                                <th>Offense Date</th>
                                <th>Offense Type</th>
                                <th>No. of Times Offense was Committed</th>
                                <th>Description</th>
                                <th>Disciplinary Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                           
                                    while($fetch6 = mysqli_fetch_array($query7)){
                            ?>
                            <tr>                                    
                                <td><?php echo date('M j, Y', strtotime($fetch6['offense_date']));?></td>
                                <td><?php echo $fetch6['offense_type'];?></td>
                                <td><?php echo $fetch6['offense_no'];?></td>
                                <td><?php echo $fetch6['offense_desc'];?></td>
                                <td><?php echo $fetch6['disp_action'];?></td>   
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <?php } else { ?>
                <div style='border:1px solid #fff; padding: 20px'>
                    <center>
                       <span class="label label-danger">No Available Data </span>
                    </center>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- educational_background -->
        <div class="card animated fadeIn" id="educCard">
            <div class="card-header">
                <h4 class=" mb-0">Educational Background</h4>
            </div>
            <div class="card-body">
                <table class="table" width="100%">
                    <tr>
                        <td width="20%">College</td>
                        <td width="80%">
                            <h5><?php echo sanitize(utf8_encode($row['college']))?></h5>
                            <p class="m-b-0"><?php echo $row['course']?></p>
                            <p class="m-b-0">
                                <?php
                                    if((empty($row['ed_from'])) && (empty($row['ed_to']))){
                                        $edfrom = ""; 
                                        $ed_to = "";
                                    }
                                    else {
                                        $edfrom = date("M. j, Y",strtotime($row["ed_from"]));
                                        $ed_to = date("M. j, Y",strtotime($row["ed_to"]));
                                        echo "$edfrom - $ed_to";
                                    }                                                                                      
                                ?>                                  
                            </p>
                            <br>
                            <small>
                                <?php
                                    if(empty($row['date_graduated'])){
                                        $date_graduated = "";
                                    }
                                    else {
                                        $date_graduated = date("M. j, Y",strtotime($row["date_graduated"]));
                                        echo "Date Graduated: $date_graduated";
                                    }
                                    
                                ?>
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <td>High School</td>
                        <td>
                            <h5><?php echo sanitize(utf8_encode($row['highschool']))?></h5>
                            <p class="m-b-0"><?php echo $row['h_course']?></p>
                            <p class="m-b-0">
                                <?php
                                    if((empty($row['h_from'])) && (empty($row['h_to']))){
                                        $hfrom = ""; 
                                        $h_to = "";
                                    }
                                    else {
                                        $hfrom = date("M. j, Y",strtotime($row["h_from"]));
                                        $h_to = date("M. j, Y",strtotime($row["h_to"]));
                                        echo "$hfrom - $h_to";
                                    }                                                                                      
                                ?>                               
                            </p>
                            <br>
                            <small>                                
                                <?php
                                    if(empty($row['h_date_graduated'])){
                                        $h_date_graduated = "";
                                    }
                                    else {
                                        $h_date_graduated = date("M. j, Y",strtotime($row["h_date_graduated"]));
                                        echo "Date Graduated: $h_date_graduated";
                                    }                                    
                                ?>
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <td>Elementary</td>
                        <td>
                            <h5><?php echo sanitize(utf8_encode($row['elementary']))?></h5>
                            <p class="m-b-0"><?php echo $row['e_course']?></p>
                            <p class="m-b-0">
                                <?php
                                    if((empty($row['e_from'])) && (empty($row['e_to']))){
                                        $efrom = ""; 
                                        $e_to = "";
                                    }
                                    else {
                                        $efrom = date("M. j, Y",strtotime($row["e_from"]));
                                        $e_to = date("M. j, Y",strtotime($row["e_to"]));
                                        echo "$efrom - $e_to";
                                    }                                       
                                ?>                              
                            </p>
                            <br>
                            <small>
                                <?php
                                    if(empty($row['e_date_graduated'])){
                                        $e_date_graduated = "";
                                    }
                                    else {
                                        $e_date_graduated = date("M. j, Y",strtotime($row["e_date_graduated"]));
                                        echo " Date Graduated: $e_date_graduated";
                                    }                                    
                                ?>  
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <td>Post Grad/Vocational:</td>
                        <td>
                            <h5><?php echo sanitize(utf8_encode($row['post_grad']))?></h5>
                            <p class="m-b-0"><?php echo $row['p_course']?></p>
                            <p class="m-b-0">
                                <?php
                                    if((empty($row['p_from'])) && (empty($row['p_to']))){
                                        $pfrom = ""; 
                                        $p_to = "";
                                    }
                                    else {
                                        $pfrom = date("M. j, Y",strtotime($row["p_from"]));
                                        $p_to = date("M. j, Y",strtotime($row["p_to"]));
                                        echo "$pfrom - $p_to";
                                    }
                                                                               
                                ?>                             
                            </p>
                            <br>
                            <small>                                 
                                <?php
                                    if(empty($row['p_date_graduated'])){
                                        $p_date_graduated = "";
                                    }
                                    else {
                                        $p_date_graduated = date("M. j, Y",strtotime($row["p_date_graduated"]));
                                        echo "Date Graduated: $p_date_graduated";
                                    }                                   
                                ?>   
                            </small>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- character_reference -->
        <div class="card animated fadeIn" id="charCard">
            <div class="card-header">
                <h4 class=" mb-0">Character Reference</h4>
            </div>
            <div class="card-body">
                <?php
                $query85 = mysqli_query($con,"SELECT * FROM character_reference WHERE personal_id = '$id'")or die(mysqli_error($con));          
                $rows13 = $query85->num_rows;   
                if($rows13 != 0 ){      ?>      <!--LOOP-->
                <table class="table"  style="border: 1px solid grey;">
                    <thead> 
                        <tr style="background: rgba(255,255,255,.125)">
                            <th>Name</th>
                            <th>Employer</th>
                            <th>Position</th>
                            <th>Relationship</th>
                            <th>Contact Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row56 = mysqli_fetch_array($query85)){ ?>                              
                        <tr>
                            <td><?php echo sanitize(utf8_encode($row56['c_name']))?></td>
                            <td><?php echo sanitize(utf8_encode($row56['c_employer']))?></td>
                            <td><?php echo $row56['c_position']?></td>
                            <td><?php echo $row56['c_relationship']?></td>
                            <td><?php echo $row56['c_contact_no']?></td>
                        </tr>
                        <?php  } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                <div style='border:1px solid #fff; padding: 20px'>
                    <center>
                       <span class="label label-danger">No Available Data </span>
                    </center>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- Emergency -->
        <div class="card animated fadeIn" id="emeCard">
            <div class="card-header">
                <h4 class=" mb-0">Emergency Contact</h4>
            </div>
            <div class="card-body">
                <table class="table" style="border: 1px solid grey;">
                    <thead> 
                        <tr style="background: rgba(255,255,255,.125)">
                            <th>Name</th>                               
                            <th>Relationship</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query34 = mysqli_query($con,"SELECT * FROM person_to_contact WHERE personal_id = '$id'")or die(mysqli_error($con));
                            $rows19 = $query34->num_rows;   
                            if($rows19 != 0 ){                              
                                while($row45 = mysqli_fetch_array($query34)){
                        ?>      
                        <tr>
                            <td><?php echo sanitize(utf8_encode($row45['p_name']))?></td>
                            <td><?php echo $row45['p_relationship']?></td>
                            <td><?php echo $row45['p_contact_no']?></td>
                            <td><?php echo $row45['address']?></td>
                        </tr>
                        <?php  } } else {  ?>
                        <tr>                                    
                            <td colspan='4'>No Available Data</td>                              
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- additional info -->
        <div class="card animated fadeIn" id="addCard">
            <div class="card-header">
                <h4 class=" mb-0">Additional Information</h4>
            </div>
            <div class="card-body">
                <table width="100%">
                    <tr>
                        <td width="25%">TIN:</td>
                        <td width="75%"><?php echo $row['tin']; ?></td>
                    </tr>
                    <tr>
                        <td>SSS:</td>
                        <td><?php echo $row['sss']; ?></td>
                    </tr>
                    <tr>
                        <td>PHILHEALTH:</td>
                        <td><?php echo $row['philhealth']; ?></td>
                    </tr>
                    <tr>
                        <td>PAGIBIG(HDMF):</td>
                        <td><?php echo $row['pagibig']; ?></td>
                    </tr>
                    <tr>
                        <td>Date Issued/ License Number:</td>
                        <td><?php echo $row['date_issued_licensed_number']; ?></td>
                    </tr>
                    <tr>
                        <td>Nature Of Business:</td>
                        <td><?php echo $row['nature_bus']; ?></td>
                    </tr>                    
                    <tr>
                        <td>Special Skills:</td>
                        <td><?php echo $row['special_skills']; ?></td>
                    </tr>
                    <tr>
                        <td>Major Illness:</td>
                        <td><?php echo $row['illness']; ?></td>
                    </tr>
                    <tr>
                        <td>Profession:</td>
                        <td><?php echo $row['profession']; ?></td>
                    </tr>
                    <tr>
                        <td>License Number:</td>
                        <td><?php echo $row['license_no']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <br>
                            Types Of Dialect Spoken/Can Understand:
                            <br>
                            <p><?php echo $row['dialect']; ?></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>

<?php 
include('../template/footer.php'); 
?>  

<script type="text/javascript">
    $("#famCard").hide();
    $("#empCard").hide();
    $("#jobCard").hide();
    $("#evalCard").hide();
    $("#allowCard").hide();
    $("#disCard").hide();
    $("#educCard").hide();
    $("#charCard").hide();
    $("#emeCard").hide();
    $("#addCard").hide();
    function about() {
        $("#aboutCard").show();
        $("#famCard").hide();
        $("#empCard").hide();
        $("#jobCard").hide();
        $("#evalCard").hide();
        $("#allowCard").hide();
        $("#disCard").hide();
        $("#educCard").hide();
        $("#charCard").hide();
        $("#emeCard").hide();
        $("#addCard").hide();
    }
    function fambtn() {
        $("#aboutCard").hide();
        $("#famCard").show();
        $("#empCard").hide();
        $("#jobCard").hide();
        $("#evalCard").hide();
        $("#allowCard").hide();
        $("#disCard").hide();
        $("#educCard").hide();
        $("#charCard").hide();
        $("#emeCard").hide();
        $("#addCard").hide();
    }
    function empbtn() {
        $("#aboutCard").hide();
        $("#famCard").hide();
        $("#empCard").show();
        $("#jobCard").hide();
        $("#evalCard").hide();
        $("#allowCard").hide();
        $("#disCard").hide();
        $("#educCard").hide();
        $("#charCard").hide();
        $("#emeCard").hide();
        $("#addCard").hide();
    }
    function jobbtn() {
        $("#aboutCard").hide();
        $("#famCard").hide();
        $("#empCard").hide();
        $("#jobCard").show();
        $("#evalCard").hide();
        $("#allowCard").hide();
        $("#disCard").hide();
        $("#educCard").hide();
        $("#charCard").hide();
        $("#emeCard").hide();
        $("#addCard").hide();
    }
    function evalbtn() {
        $("#aboutCard").hide();
        $("#famCard").hide();
        $("#empCard").hide();
        $("#jobCard").hide();
        $("#evalCard").show();
        $("#allowCard").hide();
        $("#disCard").hide();
        $("#educCard").hide();
        $("#charCard").hide();
        $("#emeCard").hide();
        $("#addCard").hide();
    }
    function allowbtn() {
        $("#aboutCard").hide();
        $("#famCard").hide();
        $("#empCard").hide();
        $("#jobCard").hide();
        $("#evalCard").hide();
        $("#allowCard").show();
        $("#disCard").hide();
        $("#educCard").hide();
        $("#charCard").hide();
        $("#emeCard").hide();
        $("#addCard").hide();
    }
    function disbtn() {
        $("#aboutCard").hide();
        $("#famCard").hide();
        $("#empCard").hide();
        $("#jobCard").hide();
        $("#evalCard").hide();
        $("#allowCard").hide();
        $("#disCard").show();
        $("#educCard").hide();
        $("#charCard").hide();
        $("#emeCard").hide();
        $("#addCard").hide();
    }
    function educbtn() {
        $("#aboutCard").hide();
        $("#famCard").hide();
        $("#empCard").hide();
        $("#jobCard").hide();
        $("#evalCard").hide();
        $("#allowCard").hide();
        $("#disCard").hide();
        $("#educCard").show();
        $("#charCard").hide();
        $("#emeCard").hide();
        $("#addCard").hide();
    }
    function charbtn() {
        $("#aboutCard").hide();
        $("#famCard").hide();
        $("#empCard").hide();
        $("#jobCard").hide();
        $("#evalCard").hide();
        $("#allowCard").hide();
        $("#disCard").hide();
        $("#educCard").hide();
        $("#charCard").show();
        $("#emeCard").hide();
        $("#addCard").hide();
    }
    function emebtn() {
        $("#aboutCard").hide();
        $("#famCard").hide();
        $("#empCard").hide();
        $("#jobCard").hide();
        $("#evalCard").hide();
        $("#allowCard").hide();
        $("#disCard").hide();
        $("#educCard").hide();
        $("#charCard").hide();
        $("#emeCard").show();
        $("#addCard").hide();
    }
    function addbtn() {
        $("#aboutCard").hide();
        $("#famCard").hide();
        $("#empCard").hide();
        $("#jobCard").hide();
        $("#evalCard").hide();
        $("#allowCard").hide();
        $("#disCard").hide();
        $("#educCard").hide();
        $("#charCard").hide();
        $("#emeCard").hide();
        $("#addCard").show();
    }
</script>
