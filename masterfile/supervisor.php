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
            <h1>Supervisor</h1>
            <small>Welcome to the New HRIS web app experience!</small>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-default" class="m-t-10 btn btn-secondary btn-md">Add New Supervisor</a>
        </header>
        <div class="modal fade" id="modal-default" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title pull-left">Add New Supervisor</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "add_supervisor.php"> 
                            <table width="100%"  style="margin-bottom:0px;">
                                <tr>
                                    <td width="30%">First Name:</td>
                                    <td colspan='3'>
                                        <input type='text' name='fname' class='form-control m-b-10' placeholder='Type here'>
                                    </td>                                    
                                </tr>
                                <tr>
                                    <td>Last Name:</td>
                                    <td colspan='3'>
                                        <input type='text' name='lname' class='form-control m-b-10' placeholder='Type here'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Middle Name:</td>
                                    <td colspan='3'>
                                        <input type='text' name='mname' class='form-control m-b-10' placeholder='Type here'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name Extension:</td>
                                    <td colspan='3'>
                                        <input type='text' name='next' class='form-control m-b-10' placeholder='Type here'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Business Unit:</td>
                                    <td colspan='3'>
                                        <select name = "buname" id = "" class = "form-control">
                                            <option style="color:#000" value = "">--Select Business Unit--</option>
                                            <?php 
                                                $sql1 = mysqli_query($con,"SELECT * FROM business_unit ORDER BY bu_name ASC");
                                                while($rows = mysqli_fetch_array($sql1)){
                                            ?>
                                            <option style="color:#000" value = "<?php echo $rows['bu_id'];?>"><?php echo $rows['bu_name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>  
                            <br>
                            <input type='submit' name='supervisor' value='Save' class="btn btn-primary btn-block" >
                        </form>  
                    </div>
                </div>
            </div>
        </div>        
        <div class="modal fade" id="updateCompany" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title pull-left">Update Supervisor</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "update_supervisor.php"> 
                            <table width="100%"  style="margin-bottom:0px;">
                                <tr>
                                    <td width="30%">First Name: </td>
                                    <td colspan='3'>
                                        <input type='text' name='fname' class='form-control m-b-10' id="fname">
                                    </td>                                    
                                </tr>
                                <tr>
                                    <td>Last Name:</td>
                                    <td colspan='3'>
                                        <input type='text' name='lname' class='form-control m-b-10' id="lname">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Middle Name:</td>
                                    <td colspan='3'>
                                        <input type='text' name='mname' class='form-control m-b-10' id="mname">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name Extension:</td>
                                    <td colspan='3'>
                                        <input type='text' name='next' class='form-control m-b-10' id="name_ext">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Business Unit:</td>
                                    <td colspan='3'>
                                        <select name = "buname" class = "form-control" id="bus_unit">
                                            <option style="color:#000"   value="" >--  Select Business Unit --</option>
                                            <?php 
                                                $sql1 = mysqli_query($con,"SELECT * FROM business_unit ORDER BY bu_name ASC");
                                                while($rows = mysqli_fetch_array($sql1)){
                                            ?>
                                            <option style="color:#000" value = "<?php echo $rows['bu_id'];?>"><?php echo $rows['bu_name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>  
                            <br>
                            <input type="hidden" name="id" id = "personal_id" class="form-control">
                            <input type='submit' name='supervisor' value='Save' class="btn btn-primary btn-block" >
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
                                    <th hidden=""></th>
                                    <th ><center>Supervisor Name</center></th>
                                    <th ><center>Business Unit</center></th>
                                    <th ><center>Action</center></th>
                                </thead>
                                <tbody>
                                    <?php                                   
                                        $sql = mysqli_query($con,"SELECT * FROM personal_data WHERE supervisor = '1' ORDER BY lname ASC")or die(mysqli_error($con));
                                        while ($row=mysqli_fetch_array($sql)){
                                        $personal_id = $row['personal_id'];
                                    ?> 
                                    <tr>
                                        <td  hidden> <?php echo $row[ 'personal_id'];?></td>
                                        <td  hidden></td>
                                        <td><?php echo $row['lname'].", ".$row['fname'].", ".$row['mname']." ".$row['name_ext'];?></td>
                                        <td><?php echo getInfo($con, 'bu_name', 'business_unit', 'bu_id', $row['current_bu']); ?></td>
                                        <td width="10%">
                                            <center >                                               
                                                <span data-toggle="modal" data-target="#updateCompany">
                                                    <a  class="btn btn-primary item btn-sm" data-toggle="tooltip" data-id = " <?php echo $row[ 'personal_id'];?>" data-fname = "<?php echo $row['fname'];?>" data-lname="<?php echo $row['lname'];?>" data-mname="<?php echo $row['mname'];?>" data-ext="<?php echo $row['name_ext'];?>" data-bus="<?php echo $row['current_bu'];?>" id = "updateDept_button" data-placement="top" title="Update" >
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                </span>
                                                <a onclick="confirmationDelete(this);return false;" href='delete_supervisor.php?id=<?php echo $row['personal_id']; ?>' class="btn btn-sm btn-danger" alt='Delete Department' data-toggle="tooltip" data-placement="top" title="Delete"><span class="zmdi zmdi-delete"></span></a>
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
     var personal_id = $(this).attr("data-id");
     var fname = $(this).attr("data-fname");
     var lname = $(this).attr("data-lname");
     var mname = $(this).attr("data-mname");
     var name_ext = $(this).attr("data-ext");
     var bus_unit = $(this).attr("data-bus");
     $("#personal_id").val(personal_id);
     $("#fname").val(fname);
     $("#lname").val(lname);
     $("#mname").val(mname);
     $("#name_ext").val(name_ext);
     $("#bus_unit").val(bus_unit);
     // alert(personal_id);
     // var department = $(this).attr("data-name");

     // $("#department").val(department);
    });
</script> 