<?php 
include('../template/header.php'); 
include('../includes/connection.php'); 
include('../template/navbar.php'); 
include('../includes/functions.php');

 $today=date("Y-m-d");
?>  


<section class="content">
    <div class="content__inner">
        <header class="content__title">
            <h1>Custom Report</h1>
            <small>Welcome to the New HRIS web app experience!</small>
        </header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form method='POST' action='export-custom.php'>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-4">
                                    Department: 
                                    <select class="form-control" name='dept'>
                                        <option value=''>--Select Department--</option>
                                        <?php 
                                            $sql1 = mysqli_query($con,"SELECT * FROM department ORDER BY dept_name ASC");
                                            while($row1 = mysqli_fetch_array($sql1)){
                                        ?>
                                        <option value='<?php echo $row1['dept_id']; ?>'><?php echo $row1['dept_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    Location: 
                                    <select class="form-control" name='location'>
                                        <option value=''>--Select Location--</option>
                                        <?php 
                                            $sql2 = mysqli_query($con,"SELECT * FROM location ORDER BY location_name ASC");
                                            while($row2 = mysqli_fetch_array($sql2)){
                                        ?>
                                        <option value='<?php echo $row2['location_id']; ?>'><?php echo $row2['location_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    Business Unit: 
                                    <select class="form-control" name='bu_unit'>
                                        <option value=''>--Select Business Unit--</option>
                                        <?php 
                                            $sql3 = mysqli_query($con,"SELECT * FROM business_unit ORDER BY bu_name ASC");
                                            while($row3 = mysqli_fetch_array($sql3)){
                                        ?>
                                        <option value='<?php echo $row3['bu_id']; ?>'><?php echo $row3['bu_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row m-t-20">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-3">
                                    Status: 
                                    <select class="form-control" name='empstatus'>
                                       <option value=''>--Select Status--</option>
                                       <option value='Active'>Active</option>
                                       <option value='Inactive'>Inactive</option>
                                       <option value='Separated'>Separated</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    Position Applied: 
                                    <select class="form-control" name='pos_app'>
                                        <option value=''>--Select Position Applied--</option>
                                        <?php 
                                            $sql4 = mysqli_query($con,"SELECT position_applied FROM position WHERE position_applied != '' GROUP BY position_applied ORDER BY position_applied ASC");
                                            while($row4 = mysqli_fetch_array($sql4)){
                                        ?>
                                        <option value='<?php echo $row4['position_applied']; ?>'><?php echo $row4['position_applied']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>                        
                        </div>
                        <div class="card-body">
                            <table class='table'>
                                <thead>
                                <th colspan='2' class="title-green"><span><strong>Personal Data</strong></span>
                                </th>
                                <th colspan="10">
                                     <input type="checkbox" onClick="toggle_pd(this)"/> <span >Check All</span> 
                                </th>
                                </thead>
                                <tr>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='fullname'></td>
                                    <td>Full Name</td>
                                    <td class='checkbox_cont'><input type='checkbox'  class='pd' name='pd[]' value='position_applied'></td>
                                    <td>Position Applied</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='expected_salary'></td>
                                    <td>Expected Salary</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='date_applied'></td>
                                    <td>Date Applied</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='date_available'></td>
                                    <td>Date Available</td>
                                </tr>
                                <tr>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='age'></td>
                                    <td>Age</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='sex'></td>
                                    <td>Sex</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='civil_status'></td>
                                    <td>Civil Status</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='present_add'></td>
                                    <td>Present Address</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='permanent_add'></td>
                                    <td>Permanent Address</td>
                                </tr>
                                <tr>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='birthday'></td>
                                    <td>Birthday</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='birthplace'></td>
                                    <td>Place of Birth</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='contact_number'></td>
                                    <td>Contact Number</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='nationality'></td>
                                    <td>Nationality</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='religion'></td>
                                    <td>Religion</td>
                                </tr>
                                <tr>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='email'></td>
                                    <td>Corporate Email</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='status'></td>
                                    <td>Status</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='emp_status'></td>
                                    <td>Employment Status</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='bio_no'></td>
                                    <td>Biometric Number</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='emp_no'></td>
                                    <td>Employee Number</td>
                                </tr>
                                <tr>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='date_hired'></td>
                                    <td>Date Hired</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='date_separated'></td>
                                    <td>Date Separated</td>
                                    <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='salary'></td>
                                    <td>Salary</td>
                                    <!-- <td class='checkbox_cont'><input type='checkbox' class='pd' name='pd[]' value='remarks'></td>
                                    <td>Talent Acquisition Remarks</td> -->
                                    <td colspan='4'></td>
                                </tr>
                                <thead>
                                <th colspan='2' class="title-green"><span>Family Background </span></th>
                                <th colspan="10"  ><input type="checkbox" onClick="toggle_fb(this)"/> <span >Check All</span> </th>
                                </thead>
                                <tr>
                                    <td class='checkbox_cont'><input type='checkbox' class = "fb" name='fb[]' value='father_info'></td>
                                    <td>Father's Info</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "fb" name='fb[]' value='mother_info'></td>
                                    <td>Mother's Info</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "fb" name='fb[]' value='spouse_info'></td>
                                    <td>Spouse's Info</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "fb" name='fb[]' value='sibling_info'></td>
                                    <td>Sibling's Info</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "fb" name='fb[]' value='child_info'></td>
                                    <td>Children's Info</td>
                                </tr>
                                <thead>
                                <th colspan='2' class="title-green"><span> Additional Information </span></th>
                                <th colspan='10'><input type="checkbox" onClick="toggle_ai(this)"/> <span >Check All</span> </th>
                                </thead>
                                <tr>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ai" class = "ai" name='ai[]' value='tin'></td>
                                    <td>TIN</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ai" name='ai[]' value='sss'></td>
                                    <td>SSS</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ai" name='ai[]' value='philhealth'></td>
                                    <td>Philhealth</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ai" name='ai[]' value='pagibig'></td>
                                    <td>Pag-ibig (HDMF)</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ai" name='ai[]' value='drivers_license'></td>
                                    <td>Date Issued/License No.</td>
                                </tr>
                                <tr>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ai" name='ai[]' value='height'></td>
                                    <td>Height</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ai" name='ai[]' value='weight'></td>
                                    <td>Weight</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ai" name='ai[]' value='special_skills'></td>
                                    <td>Special Skills</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ai" name='ai[]' value='nature_bus'></td>
                                    <td>Nature of Business</td>
                                        <td class='checkbox_cont'><input type='checkbox' class = "ai" name='ai[]' value='illness'></td>
                                    <td>Major Illness</td>
                                </tr>
                                <tr>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ai" name='ai[]' value='dialect'></td>
                                    <td>Dialect Spoken</td>
                                    <td colspan='8'></td>
                                </tr>
                                <thead>
                                <th colspan='2' class="title-green"><span>Others<span></th>
                                <th colspan='10'> <input type="checkbox" onClick="toggle_ot(this)"/> <span >Check All</span></th>
                                </thead>
                                <tr>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ot" name='ot[]' value='educ_bg'></td>
                                    <td>Education Background</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ot" name='ot[]' value='emp_hist'></td>
                                    <td>Employment History</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ot" name='ot[]' value='char_ref'></td>
                                    <td>Character Reference</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ot" name='ot[]' value='emer_contact'></td>
                                    <td>Emergency Contact</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ot" name='ot[]' value='job_hist'></td>
                                    <td>Job History</td>
                                </tr>
                                <tr>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ot" name='ot[]' value='eval_hist'></td>
                                    <td>Evaluation History</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ot" name='pd[]' value='business_unit'></td>
                                    <td>Business Unit</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ot" name='pd[]' value='department'></td>
                                    <td>Department</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ot" name='pd[]' value='location'></td>
                                    <td>Location</td>
                                    <td class='checkbox_cont'><input type='checkbox' class = "ot" name='pd[]' value='position'></td>
                                    <td>Position</td>
                                    <!-- <td colspan='8'></td> -->
                                </tr>
                                <tr>
                                    <td colspan='10'>
                                        <center>
                                            <input class="btn btn-primary btn-fill btn-md btn-block" type='submit' name='custom_report' value='Export to Excel'>
                                        </center>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    
    </div>
</section>

<?php 
include('../template/footer.php'); 
?>  
<script type="text/javascript">
    function toggle_pd(source) {
      checkboxes_pd = document.getElementsByClassName('pd');
      for(var i=0, n=checkboxes_pd.length;i<n;i++) {
        checkboxes_pd[i].checked = source.checked;
      }
     
    }
    function toggle_fb(source) {
      checkboxes_fb = document.getElementsByClassName('fb');
      for(var i=0, n=checkboxes_fb.length;i<n;i++) {
        checkboxes_fb[i].checked = source.checked;
      }
    }
    function toggle_ai(source) {
      checkboxes_ai = document.getElementsByClassName('ai');
      for(var i=0, n=checkboxes_ai.length;i<n;i++) {
        checkboxes_ai[i].checked = source.checked;
      }
    }
    function toggle_ot(source) {
      checkboxes_ot = document.getElementsByClassName('ot');
      for(var i=0, n=checkboxes_ot.length;i<n;i++) {
        checkboxes_ot[i].checked = source.checked;
      }
    }
</script>