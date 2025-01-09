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
            <h1>EMPLOYMENT STATUS STATISTICS</h1>
            <small>Welcome to the New HRIS web app experience!</small>
        </header> 
        <div class="row quick-stats">
            <div class="col-sm-6 col-md-6 col-lg-6">
                <a href="emp-statistics-graph.php">
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
                                        <th>Regular</th>
                                        <th>Probationary</th>
                                        <th>Trainee</th>
                                        <th>Project-Based</th>
                                        <th>Consultant</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $getDept = $con->query("SELECT * FROM department ORDER BY dept_name ASC");
                                    while($fetchDept = $getDept->fetch_array()){ 

                                        $regular= getEmpStatusCount($con,$fetchDept['dept_id'],'current_dept', 'Regular');
                                       $probi= getEmpStatusCount($con,$fetchDept['dept_id'],'current_dept', 'Probationary');
                                       $trainee= getEmpStatusCount($con,$fetchDept['dept_id'],'current_dept', 'Trainee');
                                        $project= getEmpStatusCount($con,$fetchDept['dept_id'],'current_dept', 'Project Based');
                                        $consultant= getEmpStatusCount($con,$fetchDept['dept_id'],'current_dept', 'Consultant');
                                        
                                        $total = $regular+$probi+$trainee+$project+$consultant;
                                        $ttl[]=$total; ?>
                                        <tr>
                                            <td><?php echo $fetchDept['dept_name']; ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($regular!=0) ? $regular : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($probi!=0) ? $probi : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($trainee!=0) ? $trainee : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($project!=0) ? $project : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($consultant!=0) ? $consultant : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center; text-align:center'><?php echo (($total!=0) ? $total : ''); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="background: #fff2">
                                        <td colspan='6' style='font-weight:bold; text-align:right; border-top:2px solid'>Total Count:</td>
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
                                        <th>Regular</th>
                                        <th>Probationary</th>
                                        <th>Trainee</th>
                                        <th>Project-Based</th>
                                        <th>Consultant</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $getBU = $con->query("SELECT * FROM business_unit ORDER BY bu_name ASC");
                                    while($fetchBU = $getBU->fetch_array()){ 

                                        $regular= getEmpStatusCount($con,$fetchBU['bu_id'],'current_bu', 'Regular');
                                       $probi= getEmpStatusCount($con,$fetchBU['bu_id'],'current_bu', 'Probationary');
                                       $trainee= getEmpStatusCount($con,$fetchBU['bu_id'],'current_bu', 'Trainee');
                                        $project= getEmpStatusCount($con,$fetchBU['bu_id'],'current_bu', 'Project Based');
                                        $consultant= getEmpStatusCount($con,$fetchBU['bu_id'],'current_bu', 'Consultant');
                                        $total = $regular+$probi+$trainee+$project+$consultant;
                                        $ttl1[]=$total; ?>
                                        <tr>
                                            <td><?php echo $fetchBU['bu_name']; ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($regular!=0) ? $regular : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($probi!=0) ? $probi : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($trainee!=0) ? $trainee : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($project!=0) ? $project : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($consultant!=0) ? $consultant : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center; text-align:center'><?php echo (($total!=0) ? $total : ''); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="background: #fff2">
                                        <td colspan='6' style='font-weight:bold; text-align:right; border-top:2px solid'>Total Count:</td>
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
                                        <th>Regular</th>
                                        <th>Probationary</th>
                                        <th>Trainee</th>
                                        <th>Project-Based</th>
                                        <th>Consultant</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                    <?php $getLoc = $con->query("SELECT * FROM location ORDER BY location_name ASC");
                                    while($fetchLoc= $getLoc->fetch_array()){ 

                                        $regular= getEmpStatusCount($con,$fetchLoc['location_id'],'current_location', 'Regular');
                                       $probi= getEmpStatusCount($con,$fetchLoc['location_id'],'current_location', 'Probationary');
                                       $trainee= getEmpStatusCount($con,$fetchLoc['location_id'],'current_location', 'Trainee');
                                        $project= getEmpStatusCount($con,$fetchLoc['location_id'],'current_location', 'Project Based');
                                        $consultant= getEmpStatusCount($con,$fetchLoc['location_id'],'current_location', 'Consultant');
                                        $total = $regular+$probi+$trainee+$project+$consultant;
                                        $ttl2[]=$total;  ?>
                                        <tr>
                                            <td><?php echo $fetchLoc['location_name']; ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($regular!=0) ? $regular : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($probi!=0) ? $probi : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($trainee!=0) ? $trainee : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($project!=0) ? $project : ''); ?></td>
                                            <td style='font-weight:bold;text-align:center'><?php echo (($consultant!=0) ? $consultant : ''); ?>
                                            <td style='font-weight:bold;text-align:center; text-align:center'><?php echo (($total!=0) ? $total : ''); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="background: #fff2">
                                        <td colspan='6' style='font-weight:bold; text-align:right; border-top:2px solid'>Total Count:</td>
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