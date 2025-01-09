<?php 
include('../template/header.php'); 
include('../includes/connection.php'); 
include('../template/navbar_other.php'); 
include('../includes/functions.php');
?>
<section class="content content--full">
    <div class="content__inner">
        <header class="content__title">
            <h1>AMENDMENT DRAFT</h1>
            <small>Welcome to the New HRIS web app experience!</small>
            <a href="../forms/amendment_form.php"  class="m-t-10 btn btn-secondary btn-md">Add New</a>
        </header> 
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row m-t-25">
                            <div class="col-lg-11 p-r-0"></div>
                            <div class="col-lg-1 p-l-0"></div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr style="background: #fff1">
                                        <th width="10%" ><center>Draft Date</center></th>
                                        <th width="25%" ><center>Employee Name</center></th>
                                        <th width="10%" ><center>Action</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php                                   
                                        $sql = mysqli_query($con,"SELECT * FROM amendment WHERE draft='1'")or die(mysqli_error($con));
                                        while ($row=mysqli_fetch_array($sql)){
                                            $fname = getInfo($con, 'fname', 'personal_data', 'personal_id', $row['personal_id']);
                                            $lname = getInfo($con, 'lname', 'personal_data', 'personal_id', $row['personal_id']);
                                            $mname = getInfo($con, 'mname', 'personal_data', 'personal_id', $row['personal_id']);
                                            $name_ext = getInfo($con, 'name_ext', 'personal_data', 'personal_id', $row['personal_id']);
                                            $fullname = $lname.", ".$fname.", ".$mname." ".$name_ext;
                                    ?> 
                                    <tr>
                                        <td align="center" style="text-transform:uppercase;font-weight:700;"><?php echo $row['draft_date'];?></td>
                                        <td align="center" class="emp-td"  style="text-transform:uppercase;font-weight:700;"><?php echo $fullname;?></td>
                                        <td >
                                            <center >
                                                <a href='../forms/amendment_form_draft.php?amend_id=<?php echo $row['amendment_id']; ?>' class="btn btn-sm btn-primary" title='Update Amendment' alt='Update Amendment' data-toggle="tooltip"data-placement="top">
                                                    <span class="zmdi zmdi-edit" ></span>
                                                </a>
                                            </center>
                                        </td>
                                    </tr>   
                                    <?php } ?>                                  
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
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            "bLengthChange":true,
            "bInfo":true,
            "bSort":true,
            "bFilter":true,
            "order": [[ 2, 'desc' ]]
        });
    });
</script>
