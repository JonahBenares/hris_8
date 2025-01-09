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
            <h1>Pooling Applicants</h1>
            <small>Welcome to the New HRIS web app experience!</small>
        </header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-bordered">
                                <thead>
                                    <th width="30%" ><center>Full Name</center></th>
                                    <th width="10%" ><center>Date Applied</center></th>
                                    <th width="20%" ><center>Position Applied</center></th>
                                    <th width="20%" ><center>Remarks</center></th>
                                    <th width="10%" style="color:#fff"><center>Action</center></th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sqli=$con->query("SELECT * FROM personal_data pd LEFT JOIN position p ON pd.personal_id = p.personal_id WHERE status = 'Inactive' AND emp_status = 'For Pooling' AND retrieve = '0' ORDER BY date_applied DESC");
                                        while($mysql=$sqli->fetch_array()){
                                            $fullname = sanitize(utf8_encode($mysql['lname'].' ,'.$mysql['fname'].' '.$mysql['name_ext'].' ,'.$mysql['mname']));
                                    ?>
                                    <tr>
                                        <td><?php echo $fullname; ?></td>
                                        <td><?php echo $mysql['date_applied']; ?></td>
                                        <td><?php echo $mysql['position_applied']; ?></td>
                                        <td><?php echo $mysql['remarks']; ?></td>
                                        <td>
                                            <center >
                                                <a href='tag_retrieve.php?id=<?php echo $mysql['personal_id'];?>' class="btn btn-primary btn-sm" onclick="confirmationRetrieve(this);return false;">Retrieve</a>
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
    function confirmationRetrieve(anchor){
        var conf = confirm('Are you sure you want to retrieve this record?');
        if(conf)
        window.location=anchor.attr("href");
    }
</script>
