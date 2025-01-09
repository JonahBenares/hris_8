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
            <h1>Age Statistics</h1>
            <small>Welcome to the New HRIS web app experience!</small>
        </header> 
        <div class="row quick-stats">
            <div class="col-sm-6 col-md-6 col-lg-6">
                <a href="age-statistics-graph.php">
                    <div class="quick-stats__item">
                        <div class="quick-stats__info">
                            <h2 class="">View Graph</h2>
                        </div>

                        <div class="quick-stats__chart peity-bar">6,4,8,6,5,6,7,8,3,5,9</div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="quick-stats__item">
                    <div class="quick-stats__info">
                        <h2><?php echo employeeCount($con); ?></h2>
                        <small>Total Employee Count</small>
                    </div>

                    <div class="quick-stats__chart peity-bar">4,7,6,2,5,3,8,6,6,4,8</div>
                </div>
            </div>           
        </div>  
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <center><h4>DEPARTMENT</h4></center>
                            <table class='table table-hover table-bordered'>
                                <thead>
                                    <tr style="background: #fff2">
                                        <th>DEPARTMENT</th>
                                        <th><center>Under 18</center></th>
                                        <th><center>18 - 25</center></th>
                                        <th><center>26 - 34</center></th>
                                        <th><center>35 - 44</center></th>
                                        <th><center>45 - 54</center></th>
                                        <th><center>55 - 64</center></th>
                                        <th><center>65+</center></th>
                                        <th><center>Total</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $getDept = $con->query("SELECT * FROM department ORDER BY dept_name ASC");
                                    while($fetchDept = $getDept->fetch_array()){ 

                                        $under18= getAgeCount($con, $fetchDept['dept_id'], 'current_dept', '1', '17');
                                        $under25=getAgeCount($con,$fetchDept['dept_id'],'current_dept', '18','25'); 
                                        $under34=getAgeCount($con,$fetchDept['dept_id'],'current_dept', '26','34'); 
                                        $under44=getAgeCount($con,$fetchDept['dept_id'],'current_dept', '35','44'); 
                                        $under54=getAgeCount($con,$fetchDept['dept_id'],'current_dept', '45','54'); 
                                        $under64=getAgeCount($con,$fetchDept['dept_id'],'current_dept', '55','64'); 
                                        $over65=getAgeCount($con,$fetchDept['dept_id'],'current_dept', '65','100');
                                        $total = $under18+$under25+$under34+$under44+$under54+$under64+$over65; 
                                        $ttl[]=$total; ?>
                                        <tr>
                                            <td><?php echo $fetchDept['dept_name']; ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under18!=0) ? $under18 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under25!=0) ? $under25 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under34!=0) ? $under34 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under44!=0) ? $under44 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under54!=0) ? $under54 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under64!=0) ? $under64 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($over65!=0) ? $over65 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center; text-align:center'><?php echo (($total!=0) ? $total : ''); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="background: #fff2">
                                        <td colspan='8' style='font-weight:bold; text-align:right; border-top:2px solid'>Total Count:</td>
                                        <td style='font-weight:bold; text-align:center; border-top:2px solid'><?php echo array_sum($ttl); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <center><h4>COMPANY DIVISION</h4></center>
                            <table class='table table-hover table-bordered'>
                                <thead>
                                    <tr style="background: #fff2">
                                        <th>COMPANY DIVISION</th>
                                        <th><center>Under 18</center></th>
                                        <th><center>18 - 25</center></th>
                                        <th><center>26 - 34</center></th>
                                        <th><center>35 - 44</center></th>
                                        <th><center>45 - 54</center></th>
                                        <th><center>55 - 64</center></th>
                                        <th><center>65+</center></th>
                                        <th><center>Total</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $getBU = $con->query("SELECT * FROM business_unit ORDER BY bu_name ASC");
                                    while($fetchBU = $getBU->fetch_array()){ 

                                        $under18= getAgeCount($con, $fetchBU['bu_id'], 'current_bu', '1', '17');
                                        $under25=getAgeCount($con,$fetchBU['bu_id'],'current_bu', '18','25'); 
                                        $under34=getAgeCount($con,$fetchBU['bu_id'],'current_bu', '26','34'); 
                                        $under44=getAgeCount($con,$fetchBU['bu_id'],'current_bu', '35','44'); 
                                        $under54=getAgeCount($con,$fetchBU['bu_id'],'current_bu', '45','54'); 
                                        $under64=getAgeCount($con,$fetchBU['bu_id'],'current_bu', '55','64'); 
                                        $over65=getAgeCount($con,$fetchBU['bu_id'],'current_bu', '65','100');
                                        $total = $under18+$under25+$under34+$under44+$under54+$under64+$over65; 
                                        $ttl1[]=$total; ?>
                                        <tr>
                                            <td><?php echo $fetchBU['bu_name']; ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under18!=0) ? $under18 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under25!=0) ? $under25 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under34!=0) ? $under34 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under44!=0) ? $under44 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under54!=0) ? $under54 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under64!=0) ? $under64 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($over65!=0) ? $over65 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center; text-align:center'><?php echo (($total!=0) ? $total : ''); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="background: #fff2">
                                        <td colspan='8' style='font-weight:bold; text-align:right; border-top:2px solid'>Total Count:</td>
                                        <td style='font-weight:bold; text-align:center; border-top:2px solid'><?php echo array_sum($ttl1); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <center><h4>LOCATION</h4></center>
                            <table class='table table-hover table-bordered'>
                                <thead>
                                    <tr style="background: #fff2">
                                        <th>LOCATION</th>
                                        <th><center>Under 18</center></th>
                                        <th><center>18 - 25</center></th>
                                        <th><center>26 - 34</center></th>
                                        <th><center>35 - 44</center></th>
                                        <th><center>45 - 54</center></th>
                                        <th><center>55 - 64</center></th>
                                        <th><center>65+</center></th>
                                        <th><center>Total</center></th>
                                    </tr>
                                    </thead>
                                <tbody>
                                <?php $getLoc = $con->query("SELECT * FROM location ORDER BY location_name ASC");
                                    while($fetchLoc= $getLoc->fetch_array()){ 

                                        $under18= getAgeCount($con, $fetchLoc['location_id'], 'current_location', '1', '17');
                                        $under25=getAgeCount($con,$fetchLoc['location_id'],'current_location', '18','25'); 
                                        $under34=getAgeCount($con,$fetchLoc['location_id'],'current_location', '26','34'); 
                                        $under44=getAgeCount($con,$fetchLoc['location_id'],'current_location', '35','44'); 
                                        $under54=getAgeCount($con,$fetchLoc['location_id'],'current_location', '45','54'); 
                                        $under64=getAgeCount($con,$fetchLoc['location_id'],'current_location', '55','64'); 
                                        $over65=getAgeCount($con,$fetchLoc['location_id'],'current_location', '65','100');
                                        $total = $under18+$under25+$under34+$under44+$under54+$under64+$over65;  
                                        $ttl2[]=$total; ?>
                                        <tr>
                                            <td><?php echo $fetchLoc['location_name']; ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under18!=0) ? $under18 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under25!=0) ? $under25 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under34!=0) ? $under34 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under44!=0) ? $under44 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under54!=0) ? $under54 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($under64!=0) ? $under64 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($over65!=0) ? $over65 : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center; text-align:center'><?php echo (($total!=0) ? $total : ''); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="background: #fff2">
                                        <td colspan='8' style='font-weight:bold; text-align:right; border-top:2px solid'>Total Count:</td>
                                        <td style='font-weight:bold; text-align:center; border-top:2px solid'><?php echo array_sum($ttl2); ?></td>
                                    </tr>
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