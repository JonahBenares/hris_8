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
            <h1>Business Unit</h1>
            <small>Welcome to the New HRIS web app experience!</small>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-default" class="m-t-10 btn btn-secondary btn-md">Add New Business Unit</a>
        </header>

        <div class="modal fade" id="modal-default" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title pull-left">Add New Business Unit</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "add_bus.php">
                            <div class="form-group">
                                <label>Business Unit</label>
                                <input type="text" name='bu_name' class='form-control' placeholder="Type Here">
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="form-group">
                                <input type='submit' name='bus_unit' value='Save' class="btn btn-primary btn-block">
                            </div>      
                        </form>    
                    </div>
                </div>
            </div>
        </div>    

        <div class="modal fade" id="updateBusunit" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title pull-left">Update Business Unit</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "update_bus.php">
                            <div class="form-group">
                                <label>Business Unit</label>
                                <input type="text" name='bu_name' id="bu_name" class='form-control' placeholder="Type Here">
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="form-group">
                                <input type='hidden' name='id' id="bu_id" >
                                <input type='submit' name='bus_unit' value='Save' class="btn btn-primary btn-block">
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
                                    <th hidden=""> Id</th>
                                    <td hidden=""></td>
                                    <th ><center>Business Unit</center></th>
                                    <th width="10%" ><center>Action</center></th>
                                </thead>
                                <tbody>
                                    <?php                                   
                                        $sql = mysqli_query($con,"SELECT * FROM business_unit ORDER BY bu_name DESC")or die(mysqli_error($con));
                                        while ($row=mysqli_fetch_array($sql)){
                                        $bu_id = $row['bu_id'];
                                    ?> 
                                    <tr>
                                        <td  hidden> <?php echo $row[ 'bu_id'];?></td>
                                        <td hidden=""></td>
                                        <td ><?php echo $row['bu_name'];?></td>
                                        <td >
                                            <center >
                                                <span data-toggle="modal" data-target="#updateBusunit">
                                                    <a  class="btn btn-primary item btn-sm" data-toggle="tooltip" data-id = " <?php echo $row[ 'bu_id'];?>" data-buname = "<?php echo $row['bu_name'];?>" id = "updateDept_button" data-placement="top" title="Update" >
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                </span>
                                                <a onclick="confirmationDelete(this);return false;" href='delete_bus.php?id=<?php echo $row['bu_id']; ?>' class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" alt='Delete Business Unit'><span class="zmdi zmdi-delete"></span></a>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php }?>                                        
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

<script type="text/javascript">
 $(document).on("click", "#updateDept_button", function() {
     var bu_id = $(this).attr("data-id");
     var bu_name = $(this).attr("data-buname");
     $("#bu_id").val(bu_id);
     $("#bu_name").val(bu_name);
    });
</script> 