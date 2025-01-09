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
            <h1>Department</h1>
            <small>Welcome to the New HRIS web app experience!</small>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-default" class="m-t-10 btn btn-secondary btn-fill btn-md">Add New Department</a>
        </header>
        <div class="modal fade" id="modal-default" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title pull-left">Add New Department</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "add_department.php">
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" name='dept_name' class="form-control " placeholder="Type Here">
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
        
        <div class="modal fade" id="updateDept" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title pull-left">Update Department</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "update_department.php">
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" name='dept_name' id="dept_name" class="form-control ">
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="form-group">
                                <input type='hidden' name='id' id="dept_id" >
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
                                    <th hidden=""> Id</th>
                                    <td hidden=""></td>
                                    <th ><center>Department Name</center></th>
                                    <th width="10%"><center>Action</center></th>
                                </thead>
                                <tbody>
                                    <?php                                   
                                        $sql = mysqli_query($con,"SELECT * FROM department ORDER BY dept_name ASC")or die(mysqli_error($con));
                                        while ($row=mysqli_fetch_array($sql)){
                                        $dept_id = $row['dept_id'];
                                    ?> 
                                    <tr>
                                        <td  hidden> <?php echo $row[ 'dept_id'];?></td>
                                        <td hidden=""></td>
                                        <td><?php echo $row['dept_name'];?></td>
                                        <td >
                                            <center >
                                                <span data-toggle="modal" data-target="#updateDept">
                                                    <a  class="btn btn-primary item btn-sm" data-toggle="tooltip" data-id = " <?php echo $row[ 'dept_id'];?>" data-deptname = "<?php echo $row['dept_name'];?>" id = "updateDept_button" data-placement="top" title="Update" >
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                </span>
                                                <a onclick="confirmationDelete(this);return false;" href='delete_dept.php?id=<?php echo $row['dept_id']; ?>' class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" alt='Delete Department'><span class="zmdi zmdi-delete"></a>
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
     var dept_id = $(this).attr("data-id");
     var dept_name = $(this).attr("data-deptname");
     $("#dept_id").val(dept_id);
     $("#dept_name").val(dept_name);
    });
</script> 