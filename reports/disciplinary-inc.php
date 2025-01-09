<?php include '../includes/connection.php'; 
include '../includes/functions.php';
$id=$_GET['id'];
?>
<div class="card">
    <div class="card-header">
        <h4 class=" m-b-0">Disciplinary Action</h4>
    </div>
    <div class="card-body">
        <table width="100%" class="table table-bordered" id="Pos_Table">
            <thead>
                <tr style="background: rgba(255,255,255,.125)">
                    <th>Offense Date</th>
                    <th>Type of Offense</th>
                    <th>No. of times offense was commited</th>
                    <th>Offense Description</th>
                    <th>Disciplinary Action</th>
                </tr>
            </thead>
            <tbody id='tbody'>
            <?php
                if(checkTmp_discipline($con, $id) != 0){
                    $select = $con->query("SELECT * FROM disciplinary_action WHERE personal_id ='$id' ORDER BY discipline_id DESC");
                    $select_tmp = $con->query("SELECT * FROM disciplinary_action_tmp WHERE personal_id ='$id'");
                    while($fetch = $select->fetch_array()){ ?>
                        <tr>
                            <td><?php echo $fetch['offense_date']; ?></td>
                            <td><?php echo $fetch['offense_type']; ?></td>
                            <td><?php echo $fetch['offense_no']; ?></td>
                            <td><?php echo $fetch['offense_desc']; ?></td>
                            <td><?php echo $fetch['disp_action']; ?></td>
                        </tr>
            <?php } while($fetch_tmp = $select_tmp->fetch_array()){ ?>
                <tr>
                    <td><?php echo $fetch_tmp['offense_date']; ?></td>
                    <td><?php echo $fetch_tmp['offense_type']; ?></td>
                    <td><?php echo $fetch_tmp['offense_no']; ?></td>
                    <td><?php echo $fetch_tmp['offense_desc']; ?></td>
                    <td><?php echo $fetch_tmp['disp_action']; ?></td>
                </tr>
            <?php  } } else {
                $select = $con->query("SELECT * FROM disciplinary_action WHERE personal_id ='$id' ORDER BY discipline_id DESC");
                while($fetch = $select->fetch_array()){ ?>
                <tr>
                    <td><?php echo $fetch['offense_date']; ?></td>
                    <td><?php echo $fetch['offense_type']; ?></td>
                    <td><?php echo $fetch['offense_no']; ?></td>
                    <td><?php echo $fetch['offense_desc']; ?></td>
                    <td><?php echo $fetch['disp_action']; ?></td>
                </tr>
              <?php } } ?>        
            </tbody>
        </table>                    
    </div>
</div>

<input class="btn btn-lg btn-primary btn-block " style="width:100%;margin-bottom:10px"  type="button" name="save-changes" id='savechanges' onClick='saveChanges();' value="Save Changes">