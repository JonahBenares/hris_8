<?php 
include('../template/header.php'); 
include('../includes/connection.php'); 
include('../template/navbar.php'); 
include('../includes/functions.php');

 $today=date("Y-m-d");
?>  

<style type="text/css">
    rect{
        background: #fff2!important;
    }
</style>
<section class="content">
    <div class="content__inner">
        <header class="content__title">
            <h1>Age Statistics GRAPH</h1>
            <small>Welcome to the New HRIS web app experience!</small>
        </header> 
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <select name='type' id='change-type' class='form-control'>
                                    <option value=''>Select</option>
                                    <option value='Company Division'>Company Division</option>
                                    <option value='Department'>Department</option>
                                    <option value='Location'>Location</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 p-t-20 p-b-20" style="background: #fff">
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
$('#change-type').on('change',function(){
    
     if(this.value=='Company Division'){       
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['Company Division', 'Under 18', '18 - 25', '26 - 34', '35 - 44', '45 - 54', '55 - 64', '65+'],
                     <?php
                      $get = $con->query("SELECT * FROM business_unit");
                      while($fetch = $get->fetch_array()){
                        echo "['".$fetch['bu_name']."',".getAgeCount($con, $fetch['bu_id'], 'current_bu', '1', '17').",".getAgeCount($con,$fetch['bu_id'],'current_bu', '18','25').",".getAgeCount($con,$fetch['bu_id'],'current_bu', '26','34').",".getAgeCount($con,$fetch['bu_id'],'current_bu', '35','44').",".getAgeCount($con,$fetch['bu_id'],'current_bu', '45','54').",".getAgeCount($con,$fetch['bu_id'],'current_bu', '55','64').",".getAgeCount($con,$fetch['bu_id'],'current_bu', '65','100')."],";
                      } ?>
            
                    ]);
               
            var options = {
              chart: {
                title: 'Age Statistics Report',
                subtitle: 'Age Statistics per Company Division',
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
                      ['Department', 'Under 18', '18 - 25', '26 - 34', '35 - 44', '45 - 54', '55 - 64', '65+'],
                     <?php
                      $get = $con->query("SELECT * FROM department");
                      while($fetch = $get->fetch_array()){
                        echo "['".$fetch['dept_name']."',".getAgeCount($con, $fetch['dept_id'], 'current_dept', '1', '17').",".getAgeCount($con, $fetch['dept_id'], 'current_dept', '18', '25').",".getAgeCount($con, $fetch['dept_id'], 'current_dept', '26', '34').",".getAgeCount($con, $fetch['dept_id'], 'current_dept', '35', '44').",".getAgeCount($con, $fetch['dept_id'], 'current_dept', '45', '54').",".getAgeCount($con, $fetch['dept_id'], 'current_dept', '55', '64').",".getAgeCount($con, $fetch['dept_id'], 'current_dept', '65', '100')."],";
                      } ?>
            
                    ]);
               
            var options = {
              chart: {
                title: 'Age Statistics Report',
                subtitle: 'Age Statistics per Department',
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
                      ['Location', 'Under 18', '18 - 25', '26 - 34', '35 - 44', '45 - 54', '55 - 64', '65+'],
                     <?php
                      $get = $con->query("SELECT * FROM location");
                      while($fetch = $get->fetch_array()){
                        echo "['".$fetch['location_name']."',".getAgeCount($con, $fetch['location_id'], 'current_location', '1', '17').",".getAgeCount($con, $fetch['location_id'], 'current_location', '18', '25').",".getAgeCount($con, $fetch['location_id'], 'current_location', '26', '34').",".getAgeCount($con, $fetch['location_id'], 'current_location', '35', '44').",".getAgeCount($con, $fetch['location_id'], 'current_location', '45', '54').",".getAgeCount($con, $fetch['location_id'], 'current_location', '55', '64').",".getAgeCount($con, $fetch['location_id'], 'current_location', '65', '100')."],";
                      } ?>
            
                    ]);
               
            var options = {
              chart: {
               title: 'Age Statistics Report',
                subtitle: 'Age Statistics per Location',
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
                      ['Company Division',  'Under 18', '18 - 25', '26 - 34', '35 - 44', '45 - 54', '55 - 64', '65+'],
                     <?php
                      $get = $con->query("SELECT * FROM business_unit");
                      while($fetch = $get->fetch_array()){
                        echo "['".$fetch['bu_name']."',".getAgeCount($con, $fetch['bu_id'], 'current_bu', '1', '17').",".getAgeCount($con,$fetch['bu_id'],'current_bu', '18','25').",".getAgeCount($con,$fetch['bu_id'],'current_bu', '26','34').",".getAgeCount($con,$fetch['bu_id'],'current_bu', '35','44').",".getAgeCount($con,$fetch['bu_id'],'current_bu', '45','54').",".getAgeCount($con,$fetch['bu_id'],'current_bu', '55','64').",".getAgeCount($con,$fetch['bu_id'],'current_bu', '65','100')."],";
                      } ?>
            
                    ]);
               
            var options = {
              chart: {
                title: 'Age Statistics Report',
                subtitle: 'Age Statistics per Company Division',
              },
              bars: 'horizontal' // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
          } 
   
</script>