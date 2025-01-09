<?php 
include('../template/header.php'); 
include('../includes/connection.php'); 
include('../template/navbar.php'); 
include('../includes/functions.php');

 $today=date("Y-m-d");
?>  
<style type="text/css">
    .scroll-dash{
       height: 300px; 
       overflow-y: hidden;   
    }
    .scroll-dash:hover{
        overflow-y: scroll; 
    }
    .bday-con{
      width:100%;
      height:300px;
      overflow:hidden;
    }
    ul{
      list-style:none;
      position:relative;
    }
    li{
   
    }
</style>
<section class="content">
    <div class="content__inner">
        <header class="content__title">
            <h1>Dashboard</h1>
            <small>Welcome to the HRIS Dashboard!</small>
        </header>
        <div class="modal fade" id="myModal_remove" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title pull-left">Add Remarks</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "add_remarks.php">                         
                            <div class="form-group">
                                Remarks:   
                                <!-- <select name = 'remarks' class = "form-control">
                                    <option value = ''>--Select Remarks--</option>
                                    <option value = "Pass">Pass</option>
                                    <option value = "Fail">Fail</option>
                                    <option value = "For Pooling">For Pooling</option>
                                    <option value = "For Interview">For Interview</option>
                                    <option value = "For Exam">For Exam</option>
                                </select> -->                                 
                                <textarea class="form-control" name = "remarks" id = "remarks"></textarea>       
                            </div>
                            <div class="form-group">
                                <div class = "row">
                                    <div class = "col-md-3">
                                        Hired<br>
                                        <input type="radio" name="status" value = "Hired">
                                    </div>
                                    <div class = "col-md-3">
                                        For Pooling<br>
                                        <input type="radio" name="status" value = "For Pooling">
                                    </div>
                                    <div class = "col-md-3">
                                        Pass<br>
                                        <input type="radio" name="status" value = "Pass">
                                    </div>
                                    <div class = "col-md-3">
                                        Fail<br>
                                        <input type="radio" name="status" value = "Fail">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <input type="hidden" name = "personal_id" id = "personal_id">
                            <td colspan='4'><center><input type='submit' name='save_reminder' value='Save' class="btn btn-primary btn-fill" style="width:100%;"></center></td>
                            </tr>  
                        </form>    
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thing-to-do</h4>
                        <h6 class="card-subtitle">Check out your daily schedule</h6>

                        <?php       
                        $month=date("m");
                        $get=$con->query("SELECT * FROM reminders WHERE done = '0'"); 
                    ?>
                    <div class="scroll-dash scroll-bar">
                        <table style='width:100%' class="table-bordered">
                            <tr>
                                <th width="20%" class="th">&nbsp;Date</th>
                                <th width="%" class="th">&nbsp;Thingss-To-Do</th>
                                <th width="15%" class="th">&nbsp;Day/s Left</th>
                                <th width="1%" class="th" width="1%">
                                    <center>
                                        <h3 class="m-0"><i class="zmdi zmdi-view-headline"></i></h3>
                                    </center>
                                </th>
                            </tr>
                            <?php 
                                while($fetch=$get->fetch_array()) {
                                    $days_left=dateDifference($fetch['reminder_date'], $today); 
                                    if($days_left==0){
                                        $days_left= "Today";
                                        $notes="REMINDERS TODAY: " .$fetch['notes'];
                                        echo "<script>alert('$notes');</script>";
                                    } else {
                                        $days_left= $days_left . " day/s"; 
                                    } 

                                    $reminders[] = array(
                                        'reminder_id'=>$fetch['reminder_id'],
                                        'personal_id'=>$fetch['personal_id'],
                                        'reminder_date'=>$fetch['reminder_date'],
                                        'notes'=>$fetch['notes'],
                                        'days_left'=>$days_left
                                    );
                                }
                            ?>

                            <?php
                            //print_r($reminders);
                            if(!empty($reminders)){
                                $columns = array_column($reminders, 'reminder_date');
                                $a = array_multisort($columns, SORT_DESC, $reminders);
                                foreach($reminders AS $r){ 
                                    //$done=getInfo($con, 'done', 'personal_data', 'personal_id', $r['personal_id']);
                                    //if($done==0){
                                ?>
                                    <tr class="stats">
                                        <td class="p-1"><?php echo date('M j, Y', strtotime($r['reminder_date'])); ?> </td>
                                        <td class="p-1"><?php echo $r['notes']; ?></td>
                                        <td class="p-1"><?php echo $r['days_left']; ?></td>
                                        <td style="padding: 5px">
                                            <a href = "tag_done.php?remid=<?php echo $r['reminder_id'];?>" class="btn  btn-success btn-fill btn-sm" onclick="confirmationDone(this);return false;">Done</a>
                                        </td>
                                    </tr>
                            <?php } } //} ?>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo date('F'); ?> Celebrants</h4>
                        <h6 class="card-subtitle">Happy Birthday! Happy Birthday! Happy Birthday!</h6>
                        <?php 
                        $curmonth= date('m'); 
                        $getBdays = $con->query("SELECT lname, fname, name_ext, day(bdate) AS bday FROM personal_data WHERE MONTH(bdate) = '$curmonth' AND status = 'Active' ORDER BY bday ASC"); 
                        $rows=$getBdays->num_rows; ?>

                        <div class="bday-con">
                            <ul style="padding: 0px">
                                 <?php 
                                if($rows != 0){
                                while($fetchbday = $getBdays->fetch_array()){ 
                                $fullname = $fetchbday['fname'] . " " . $fetchbday['lname'] . " ". $fetchbday['name_ext']; 
                                $day = $fetchbday['bday']; 
                                $new_bday = str_pad($day,2,"0",STR_PAD_LEFT);
                                ?>
                                <li>
                                    <div class="card m-b-10" style="border-radius: 50px">
                                        <table width="100%">
                                            <tr>
                                                <td style="padding: 20px;background: #fff5;border-radius: 100%" width="15%">
                                                    <h3 class="m-b-0" style="color:#fff!important">
                                                        <b><?php echo $new_bday; ?></b>
                                                    </h3>
                                                </td>
                                                <td style="padding: 20px" width="80%">
                                                    <h6 class="m-b-0" style="text-transform: uppercase;">
                                                        <?php echo sanitize(utf8_encode(ucfirst($fullname)));?>
                                                    </h6>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </li>
                                <?php }
                                } else { ?>
                                <li>
                                    <div class="card m-b-10 m-t-100" style="border-radius: 50px">
                                        <center>
                                            <p class="m-t-10">There are no celebrants this month.</p>
                                        </center>
                                    </div>
                                </li>
                                <?php  } ?>
                            </ul>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Talent Acquisition</h4>
                        <h6 class="card-subtitle">Commodo luctus nisi erat porttitor ligula eget lacinia odio semnec</h6>

                        <div class="scroll-dash scroll-bar">
                            <table class="table-bordered" style='width:100%'>
                                <tr>
                                    <!-- <th class="th" width="20%">&nbsp;Date</th>
                                    <th class="th" width="20%">&nbsp;Reminder</th>
                                    <th class="th" width="20%">&nbsp;Day/s Left</th> -->
                                    <th class="th" width="15%" style="padding: 5px">Date Applied</th>
                                    <th class="th" width="20%" style="padding: 5px">Name of Applicant</th>
                                    <th class="th" width="10%" style="padding: 5px">Position Applied</th>
                                    <th class="th" width="10%" style="padding: 5px">Employee Status</th>
                                    <th class="th" width="10%" style="padding: 5px">Remarks</th>
                                    <th class="th" width="1%">
                                        <center>
                                            <h3 class="m-0"><i class="zmdi zmdi-view-headline"></i></h3>
                                        </center>
                                    </th>
                                </tr>
                                <?php 
                                    /*$sqli=$con->query("SELECT * FROM reminders_new WHERE cancel = '0' ORDER BY todo_date ASC");
                                    while($mysql=$sqli->fetch_array()){
                                    $day_left=dateDifference($mysql['todo_date'], $today); 
                                    if($day_left==0){
                                        $day_left= "Today";
                                    } else {
                                        $day_left= $day_left . " day/s"; 
                                    }*/ 
                                    $sqli=$con->query("SELECT * FROM personal_data pd LEFT JOIN position p ON pd.personal_id = p.personal_id WHERE status = 'Inactive' ORDER BY date_applied ASC");
                                    while($mysql=$sqli->fetch_array()){
                                    //&& $mysql['emp_status']!='Hired'
                                    if($mysql['emp_status']!='For Pooling' && $mysql['emp_status']!='Hired' && $mysql['emp_status']!='Pass' && $mysql['emp_status']!='Fail' || $mysql['retrieve']==1){
                                ?>
                                <tr class="stats">
                                    <td class="td" style="vertical-align: top;padding: 5px"><?php echo date('M j, Y', strtotime($mysql['date_applied'])); ?> </td>
                                    <td class="td" style="vertical-align: top;padding: 5px"><?php echo sanitize(utf8_encode($mysql['lname']))." ,".sanitize(utf8_encode($mysql['fname']))." ,".sanitize(utf8_encode($mysql['mname']))." ,".sanitize(utf8_encode($mysql['name_ext'])); ?> </td>
                                    <td class="td" style="vertical-align: top;padding: 5px"><?php echo $mysql['position_applied']; ?></td>
                                    <td class="td" style="vertical-align: top;padding: 5px"><?php echo $mysql['emp_status']; ?></td>
                                    <td class="td" style="vertical-align: top;padding: 5px"><?php echo $mysql['remarks']; ?></td>
                                    <td class="td" align="center" style="vertical-align: top;padding: 5px">
                                        <a class="btn btn-info btn-fill btn-sm" href="javascript:void(0)" data-toggle="modal" data-id = '<?php echo $mysql['personal_id']; ?>' data-rem = '<?php echo $mysql['remarks']; ?>' id ="updateReminder_button" data-target="#myModal_remove" class="" style="margin:1px">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        </td>
                                </tr>
                                <?php } } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <center>
                            <div class="col-lg-3">
                                <select name='type' id='change-type' class='form-control'>
                                    <option value=''>Select</option>
                                    <option value='Company Division'>Company Division</option>
                                    <option value='Department'>Department</option>
                                    <option value='Location'>Location</option>
                                </select>
                            </div>
                        </center>
                    </div>
                    <div class="card-body p-t-20 p-b-20">
                        <div class="row">
                            <div class="col-lg-12 p-b-20 p-t-20 p-l-20 p-r-20" style="background: #fff">
                                <div id="barchart_material" style="width: 100%; height: 600px;"></div>
                            </div>
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
<script type="text/javascript" src="../assets/js/graph.js"></script>
<script type="text/javascript">
    $(document).on("click", "#updateReminder_button", function () {
        var personal_id = $(this).attr("data-id");
        var remarks = $(this).attr("data-rem");
        $("#personal_id").val(personal_id);
        $("#remarks").val(remarks);
    });
</script>
<script type="text/javascript">
$(function(){

  var tickerHeight = $('.bday-con ul li').outerHeight();
  function moveTop(){
    $('.bday-con ul').animate({
      top : -tickerHeight
    },600, function(){
     $('.bday-con ul li:first-child').appendTo('.bday-con ul');
      $('.bday-con ul').css('top','');
    });
   }
  setInterval( function(){
    moveTop();
  }, 1500);
  });
$('#change-type').on('change',function(){
    
     if(this.value=='Company Division'){       
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['Company Division', 'Male', 'Female'],
                     <?php
                      $get = $con->query("SELECT * FROM business_unit");
                      while($fetch = $get->fetch_array()){
                        echo "['".$fetch['bu_name']."',".getGenderCount($con, $fetch['bu_id'], 'current_bu', 'Male').",".getGenderCount($con, $fetch['bu_id'],'current_bu', 'Female')."],";
                      } ?>
            
                    ]);
               
            var options = {
              chart: {
                title: 'Gender Statistics Report',
                subtitle: 'Gender Statistics per Company Division',
              },
              bars: 'horizontal' // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
          } 
      }
      if(this.value=='Department'){       
        google.charts.load('current', {'packages':['bar']});
         google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['Department', 'Male', 'Female'],
                     <?php
                      $get = $con->query("SELECT * FROM department");
                      while($fetch = $get->fetch_array()){
                        echo "['".$fetch['dept_name']."',".getGenderCount($con, $fetch['dept_id'], 'current_dept', 'Male').",".getGenderCount($con, $fetch['dept_id'],'current_dept', 'Female')."],";
                      } ?>
            
                    ]);
               
            var options = {
              chart: {
                title: 'Gender Statistics Report',
                subtitle: 'Gender Statistics per Department',
              },
              bars: 'horizontal' // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
          } 
      }
      if(this.value=='Location'){       
        google.charts.load('current', {'packages':['bar']});
         google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['Location', 'Male', 'Female'],
                     <?php
                      $get = $con->query("SELECT * FROM location");
                      while($fetch = $get->fetch_array()){
                        echo "['".$fetch['location_name']."',".getGenderCount($con, $fetch['location_id'], 'current_location', 'Male').",".getGenderCount($con, $fetch['location_id'],'current_location', 'Female')."],";
                      } ?>
            
                    ]);
               
            var options = {
              chart: {
               title: 'Gender Statistics Report',
                subtitle: 'Gender Statistics per Location',
              },
              bars: 'horizontal' // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
          } 
      }
      
    });
google.charts.load('current', {'packages':['bar']});
         google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['Company Division', 'Male', 'Female'],
                     <?php
                      $get = $con->query("SELECT * FROM business_unit");
                      while($fetch = $get->fetch_array()){
                        echo "['".$fetch['bu_name']."',".getGenderCount($con, $fetch['bu_id'], 'current_bu', 'Male').",".getGenderCount($con, $fetch['bu_id'],'current_bu', 'Female')."],";
                      } ?>
            
                    ]);
               
            var options = {
              chart: {
                title: 'Gender Statistics Report',
                subtitle: 'Gender Statistics per Company Division',
              },
              bars: 'horizontal' // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
          } 
   
</script>