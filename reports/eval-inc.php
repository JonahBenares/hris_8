<?php include '../includes/connection.php'; 
include '../includes/functions.php';
$id=$_GET['id'];
?>
<div class="card">
    <div class="card-header">
        <h4 class=" m-b-0">Evaluation History</h4>
    </div>
    <div class="card-body">
        <table width="100%" class="table table-bordered" id="Pos_Table">
            <thead>
                <tr style="background: rgba(255,255,255,.125)">
                    <th>Evaluation Date</th>
                    <th>Score</th>
                    <th>Evaluation Type</th>
                    <th>Adjustment</th>
                    <th>Per Day</th>
                    <th>Effective Date</th>
                </tr>
            </thead>
            <tbody id='tbody'>
                <?php
                if(checkTmp_eval($con, $id) != 0){
                $select = $con->query("SELECT * FROM evaluation_history WHERE personal_id ='$id' ORDER BY effective_date DESC");
                $select_tmp = $con->query("SELECT * FROM evaluation_history_tmp WHERE personal_id ='$id'");
                while($fetch = $select->fetch_array()){ ?>           
                    <tr>
                        <td><?php echo ($fetch['eval_date']!='' && $fetch['eval_date']!='-') ? date('F Y', strtotime($fetch['eval_date'])) : ''; ?></td>
                        <td><?php echo $fetch['score']; ?></td>
                        <td><?php echo $fetch['eval_type']; ?></td>
                        <td><?php echo number_format($fetch['adjustment'],2); ?></td>
                        <td><?php echo $fetch['per_day']; ?></td>
                        <td><?php if(!empty($fetch['effective_date'])){ echo date('F j, Y', strtotime($fetch['effective_date'])); } else { echo ''; } ?></td>
                    </tr>           
                <?php } 
                while($fetch_tmp = $select_tmp->fetch_array()){ ?>           
                    <tr>
                        <td><?php echo ($fetch_tmp['eval_date']!='' && $fetch_tmp['eval_date']!='-') ? date('F Y', strtotime($fetch_tmp['eval_date'])) : ''; ?></td>
                        <td><?php echo $fetch_tmp['score']; ?></td>
                        <td><?php echo $fetch_tmp['eval_type']; ?></td>
                        <td><?php echo number_format($fetch_tmp['adjustment'],2); ?></td>
                        <td><?php echo $fetch_tmp['per_day']; ?></td>
                        <td><?php if(!empty($fetch_tmp['effective_date'])){ echo date('F j, Y', strtotime($fetch_tmp['effective_date']));} else { echo ''; } ?></td>
                    </tr>           
                <?php } ?>           
                <?php } else {
                $select = $con->query("SELECT * FROM evaluation_history WHERE personal_id ='$id' ORDER BY effective_date DESC");
                while($fetch = $select->fetch_array()){ ?>            
                    <tr>
                        <td><?php echo ($fetch['eval_date']!='' && $fetch['eval_date']!='-') ? date('F Y', strtotime($fetch['eval_date'])) : ''; ?></td>
                        <td><?php echo $fetch['score']; ?></td>
                        <td><?php echo $fetch['eval_type']; ?></td>
                        <td><?php echo number_format($fetch['adjustment'],2); ?></td>
                        <td><?php echo $fetch['per_day']; ?></td>
                        <td><?php if(!empty($fetch['effective_date'])){ echo date('F j, Y', strtotime($fetch['effective_date'])); } else { echo ''; } ?></td>
                    </tr>            
                <?php } } ?>
            </tbody>
        </table>                    
    </div>
</div>