<?php 
include('../template/header.php'); 
include('../includes/connection.php'); 
include('../template/navbar.php'); 
include('../includes/functions.php');


?>  


<section class="content">
    <div class="content__inner">
        <header class="content__title">
            <h1>Things To Do</h1>
            <small>Welcome to the New HRIS web app experience!</small>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-default" class="m-t-10 btn btn-secondary btn-fill btn-md">Add New Things To Do</a>
        </header>

        <div class="modal fade" id="modal-default" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title pull-left">Add New Things To Do</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "add-reminder.php">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                <div class="form-group">
                                    <input type="date" class="form-control date-picker" name="reminder_date" placeholder="Pick a date">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" placeholder="Things to do/Notes:" name='notes'></textarea>
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="form-group">
                                <input type='submit' name='department' value='Save' class="btn btn-primary btn-block">
                            </div>      
                        </form>    
                    </div>
                </div>
            </div>
        </div>    

        <div class="modal fade" id="updateReminder" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title pull-left">Update Things To Do</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "update_reminder.php">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                <div class="form-group">
                                    <input type="date" class="form-control date-picker" name="rem_date" id="reminder_date">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" name='notes' id="notes"></textarea>
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="form-group">
                                <input type='hidden' name='id' id="reminder_id">
                                <input type='submit' name='department' value='Save' class="btn btn-primary btn-block">
                            </div>      
                        </form>    
                    </div>
                </div>
            </div>
        </div>              

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                         <div class="table-responsive">
                            <table id="data-table" class="table table-bordered">
                                <thead>
                                    <th hidden></th>
                                    <th  hidden></th>
                                    <th width="10%"><center>Date</center></th>
                                    <th ><center>Things to do</center></th>
                                    <th width="10%"><center>Created By</center></th>
                                    <th width="10%"><center>Date Created</center></th>
                                    <th width="15%"><center>Day/s Left</center></th>
                                    <th width="15%"><center>Action</center></th>
                                </thead>
                                <tbody>
                                    <?php                                   
                                        $sql = mysqli_query($con,"SELECT * FROM reminders")or die(mysqli_error($con));
                                        while ($row=mysqli_fetch_array($sql)){
                                        $rem_id = $row['reminder_id'];
                                        $today=date('Y-m-d');
                                        $days_left=dateDifference( $row['reminder_date'], $today);
                                        if($days_left>=0 && $row['done']==0){
                                    ?> 

                                    <tr style="background: #fff2">                                      
                                        <td hidden></td>
                                        <td hidden><?php echo date('Y.m.d ', strtotime($row['reminder_date']));?></td>
                                        <td><?php echo date('M j, Y', strtotime($row['reminder_date']));?></td>
                                        <td><?php echo $row['notes'];?></td>
                                        <td><?php echo getInfo($con, 'username', 'user', 'user_id', $row['created_by']); ?></td>
                                        <td><?php echo $row['date_created'];?></td>
                                        <td align="center" <?php echo (($days_left<=3) ? " style='color:red;font-weight:900'" : " "); ?>><?php echo $days_left . " day/s left"; ?></td>
                                        <td >
                                            <center>
                                                <span data-toggle="modal" data-target="#updateReminder">
                                                    <a  class="btn btn-primary item btn-sm" data-toggle="tooltip" data-id = " <?php echo $row[ 'reminder_id'];?>" data-date = "<?php echo $row['reminder_date'];?>" data-notes = "<?php echo $row['notes'];?>" id = "updateDept_button" data-placement="top" title="Update" >
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                </span>



                                                <a onclick="confirmationDelete(this);return false;" href='delete_reminders.php?id=<?php echo $row['reminder_id']; ?>' class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"  alt='Delete'><span class="zmdi zmdi-delete"></span></a> 
                                                <?php if($row['done']==0){ ?> 
                                                <a href = "tag_done.php?remid=<?php echo $row['reminder_id'];?>" class="btn btn-sm btn-success " data-toggle="tooltip" data-placement="top" title="Done"  onclick="confirmationDone(this);return false;"><span class="zmdi zmdi-thumb-up"></span></a>
                                                <!-- <?php } ?> -->
                                            </center>
                                        </td>
                                    </tr>
                                    <?php } else {  ?>
                                        <tr style='color:#adadad'>                                      
                                            <td hidden></td>
                                            <td hidden><?php echo date('Y.m.d ', strtotime($row['reminder_date']));?></td>
                                            <td><?php echo date('M j, Y', strtotime($row['reminder_date']));?></td>
                                            <td><?php echo $row['notes'];?></td>
                                            <td><?php echo getInfo($con, 'username', 'user', 'user_id', $row['created_by']); ?></td>
                                            <td align="center"><?php echo $row['date_created'];?></td>
                                            <td align="center"><?php echo $days_left . " day/s passed"; ?></td>
                                            <td>
                                                <center>
                                                    <?php if($row['done']==0){ ?>
                                                    <a href = "tag_done.php?remid=<?php echo $row['reminder_id'];?>" class="btn btn-sm btn-success" onclick="confirmationDone(this);return false;"><span class="zmdi zmdi-thumb-up"></span></a>
                                                    <?php } ?>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php  }
                                    }
                                    ?>                                        
                                </tbody>
                            </table>  
                        </div>
                    </div>
                </div>
            </div>

        </div>

    
    </div>
</section>
<script>
    function confirmationDelete(anchor){
        var conf = confirm('Are you sure you want to delete this record?');
        if(conf)
        window.location=anchor.attr("href");
    }

    function confirmationDone(anchor){
        var conf = confirm('Are you sure you want to tag as done this record?');
        if(conf)
        window.location=anchor.attr("href");
    }
</script>

<?php 
include('../template/footer.php'); 
?>  

<script type="text/javascript">
 $(document).on("click", "#updateDept_button", function() {
     var reminder_id = $(this).attr("data-id");
     var reminder_date = $(this).attr("data-date");
     var notes = $(this).attr("data-notes");
     $("#reminder_id").val(reminder_id);
     $("#reminder_date").val(reminder_date);
     $("#notes").val(notes);
    });
</script> 