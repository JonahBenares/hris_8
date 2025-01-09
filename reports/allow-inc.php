<?php include '../includes/connection.php'; 
include '../includes/functions.php';
$id=$_GET['id'];
?>
<div class="card">
    <div class="card-header">
        <h4 class=" m-b-0">Allowance</h4>
    </div>
    <div class="card-body">
        <table width="100%" class="table table-bordered" id="Pos_Table">
            <thead>
                <tr style="background: rgba(255,255,255,.125)">
                    <th>Description</th>
                    <th>Amount</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody id='tbody'>
                <?php
                if(checkTmp_allowance($con, $id) != 0){
                $select = $con->query("SELECT * FROM allowance WHERE personal_id ='$id' ORDER BY allowance_id DESC");
                $select_tmp = $con->query("SELECT * FROM allowance_tmp WHERE personal_id ='$id'");
                while($fetch = $select->fetch_array()){ ?>
                    <tr>
                        <td><?php echo $fetch['description']; ?></td>
                        <td><?php echo number_format($fetch['amount'],2); ?></td>
                        <td align="center">
                            <a href='javascript:' class="btn btn-sm btn-primary  btn-fill edf" onclick="window.open('update_allowance.php?id='+<?php echo $fetch['allowance_id']; ?>, '_blank', 'width=650,height=300,top=50,left=350');"  id='add_eval'>
                                <span class="zmdi zmdi-edit"></span>
                            </a>
                        </td>
                    </tr>
                <?php } while($fetch_tmp = $select_tmp->fetch_array()){ ?>
                <tr>
                    <td><?php echo $fetch_tmp['description']; ?></td>
                    <td><?php echo number_format($fetch_tmp['amount'],2); ?></td>
                    <td align="center">
                        <a href='javascript:' class="btn btn-sm btn-primary  btn-fill edf" onclick="window.open('update_allowance.php?id='+<?php echo $fetchTmp['allowance_id']; ?>, '_blank', 'width=650,height=300,top=50,left=350');"  id='add_eval'>
                            <span class="zmdi zmdi-edit"></span>
                        </a>
                    </td>
                </tr>
                <?php  } } else {
                $select = $con->query("SELECT * FROM allowance WHERE personal_id ='$id' ORDER BY allowance_id DESC");
                while($fetch = $select->fetch_array()){ ?>
                <tr>
                    <td><?php echo $fetch['description']; ?></td>
                    <td><?php echo number_format($fetch['amount'],2); ?></td>
                    <td align="center">
                        <a href='javascript:' class="btn btn-sm btn-primary  btn-fill edf" onclick="window.open('update_allowance.php?id='+<?php echo $fetch['allowance_id']; ?>, '_blank', 'width=650,height=300,top=100,left=350');"  id='add_eval'>
                            <span class="zmdi zmdi-edit"></span>
                        </a>
                    </td>
                </tr>
                <?php } } ?>        
            </tbody>
        </table>                    
    </div>
</div>