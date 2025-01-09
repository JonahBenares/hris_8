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
            <h1>Location</h1>
            <small>Welcome to the New HRIS web app experience!</small>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-default" class="m-t-10 btn btn-secondary btn-md">Add New Location</a>
        </header>

        <div class="modal fade" id="modal-default" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title pull-left">Add New Location</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "add_location.php">
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" name='location_name' class='form-control' placeholder="Type Here">
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="form-group">
                                <input type='submit' name='location' value='Save' class="btn btn-primary btn-block">
                            </div>      
                        </form>    
                    </div>
                </div>
            </div>
        </div>           

        <div class="modal fade" id="updateLocation" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title pull-left">Update Location</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "update_location.php">
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" name='location_name' id="location_name" class='form-control'>
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="form-group">
                                <input type='hidden' name='id' id="location_id">
                                <input type='submit' name='location' value='Save' class="btn btn-primary btn-block">
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
                                    <th ><center>Location</center></th>
                                    <th ><center>Action</center></th>
                                </thead>
                                <tbody>
                                    <?php                                   
                                        $sql = mysqli_query($con,"SELECT * FROM location ORDER BY location_name DESC")or die(mysqli_error($con));
                                        while ($row=mysqli_fetch_array($sql)){
                                        $location_id = $row['location_id'];
                                    ?> 
                                    <tr>
                                        <td hidden> <?php echo $row[ 'location_id'];?></td>
                                        <td hidden=""></td>
                                        <td><?php echo $row['location_name'];?></td>
                                        <td width="10%">
                                            <center >
                                                <span data-toggle="modal" data-target="#updateLocation">
                                                    <a  class="btn btn-primary btn-sm" data-toggle="tooltip" data-id = " <?php echo $row[ 'location_id'];?>" data-location = "<?php echo $row['location_name'];?>" id = "updateDept_button" data-placement="top" title="Update" >
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                </span>

                                                <a onclick="confirmationDelete(this);return false;" href='delete_location.php?id=<?php echo $row['location_id']; ?>' class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" alt='Delete Location'><span class="zmdi zmdi-delete"></span></a>
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
     var location_id = $(this).attr("data-id");
     var location_name = $(this).attr("data-location");
     $("#location_id").val(location_id);
     $("#location_name").val(location_name);
    });
</script> 