<?php include '../includes/connection.php'; 
include '../includes/functions.php';
$id=$_GET['id'];
?>
<div class="card">
    <div class="card-header">
        <h4 class=" m-b-0">Job History</h4>
    </div>
    <div class="card-body">
        <table width="100%" class="table-bordered table">
            <thead>
                <tr style="background: rgba(255,255,255,.125)">
                    <th>Effective Date</th>
                    <th>End Date</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Department</th>
                    <th>Business Unit</th>
                    <th>Location</th>
                    <th>Salary</th>
                    <th>Per Day</th>
                    <th>Supervisor</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php 
                if(checkTmp_job($con, $id) != 0){
                $select = $con->query("SELECT * FROM job_history WHERE personal_id ='$id' ORDER BY effective_date DESC");
                $selecttmp = $con->query("SELECT * FROM job_history_tmp WHERE personal_id ='$id'"); ?>
                <tbody><?php
                while($fetch = $select->fetch_array()){ ?>
                    
                        <tr>
                            <td><?php echo ($fetch['effective_date']!='') ? date('F j, Y', strtotime($fetch['effective_date'])) : ''; ?></td>
                            <td><?php echo ($fetch['end_date']!='') ? date('F j, Y', strtotime($fetch['end_date'])) : ''; ?></td>
                            <td><?php echo $fetch['j_position']; ?></td>
                            <td><?php echo $fetch['emp_status']; ?></td>
                            <td><?php echo getInfo($con, 'dept_name', 'department', 'dept_id', $fetch['department_id']); ?></td>
                            <td><?php echo getInfo($con, 'bu_name', 'business_unit', 'bu_id',$fetch['bu_id']); ?></td>
                            <td><?php echo getInfo($con, 'location_name', 'location', 'location_id', $fetch['location_id']); ?></td>
                            <td><?php echo number_format($fetch['salary'],2); ?></td>
                            <td><?php echo $fetch['per_day']; ?></td>
                            <td><?php echo getSupName($con, $fetch['supervisor']); ?></td>
                            <td align="center">
                                <a href='javascript:' class="btn btn-sm btn-primary" onclick="window.open('update_job.php?id='+<?php echo $fetch['history_id']; ?>, '_blank', 'width=650,height=300,top=100,left=350');"  id='add_eval'>
                                    <span class="zmdi zmdi-edit"></span>
                                </a>
                            </td>
                        </tr>
                    
                <?php } ?>
                
                 <?php while($fetchTmp = $selecttmp->fetch_array()){ ?>
                    
                        <tr>
                            <td><?php echo ($fetchTmp['effective_date']!='') ? date('F j, Y', strtotime($fetchTmp['effective_date'])) : ''; ?></td>
                            <td><?php echo ($fetchTmp['end_date']!='') ? date('F j, Y', strtotime($fetchTmp['end_date'])) : ''; ?></td>
                            <td><?php echo $fetchTmp['j_position']; ?></td>
                            <td><?php echo $fetchTmp['emp_status']; ?></td>
                            <td><?php echo getInfo($con, 'dept_name', 'department', 'dept_id', $fetchTmp['department_id']); ?></td>
                            <td><?php echo getInfo($con, 'bu_name', 'business_unit', 'bu_id',$fetchTmp['bu_id']); ?></td>
                            <td><?php echo getInfo($con, 'location_name', 'location', 'location_id', $fetchTmp['location_id']); ?></td>
                            <td><?php echo number_format($fetchTmp['salary'],2); ?></td>
                            <td><?php echo $fetchTmp['per_day']; ?></td>
                            <td><?php echo getSupName($con, $fetchTmp['supervisor']); ?></td>
                            <td align="center"><a href='javascript:' class="btn btn-sm btn-primary" onclick="window.open('update_job.php?id='+<?php echo $fetchTmp['history_id']; ?>, '_blank', 'width=650,height=300,top=100,left=350');"><span class="zmdi zmdi-edit"></span></a></td>
                        </tr>
                    
                <?php } ?>
                </tbody><?php
            } else {
                  $select = $con->query("SELECT * FROM job_history WHERE personal_id ='$id' ORDER BY effective_date DESC");
                    while($fetch = $select->fetch_array()){ ?>
                    <tbody>
                        <tr>
                            <td><?php echo ($fetch['effective_date']!='') ? date('F j, Y', strtotime($fetch['effective_date'])) : ''; ?></td>
                            <td><?php echo ($fetch['end_date']!='') ? date('F j, Y', strtotime($fetch['end_date'])) : ''; ?></td>
                            <td><?php echo $fetch['j_position']; ?></td>
                            <td><?php echo $fetch['emp_status']; ?></td>
                            <td><?php echo getInfo($con, 'dept_name', 'department', 'dept_id', $fetch['department_id']); ?></td>
                            <td><?php echo getInfo($con, 'bu_name', 'business_unit', 'bu_id',$fetch['bu_id']); ?></td>
                            <td><?php echo getInfo($con, 'location_name', 'location', 'location_id', $fetch['location_id']); ?></td>
                            <td><?php echo number_format($fetch['salary'],2); ?></td>
                            <td><?php echo $fetch['per_day']; ?></td>
                            <td><?php echo getSupName($con, $fetch['supervisor']); ?></td>
                            <td align="center"><a href='javascript:' class="btn btn-sm btn-primary" onclick="window.open('update_job.php?id='+<?php echo $fetch['history_id']; ?>, '_blank', 'width=650,height=300,top=100,left=350');"  id='add_eval'><span class="zmdi zmdi-edit"></span></td>
                        </tr>
                    </tbody>
                <?php } 
            } ?>
        </table>                        
    </div>
</div>