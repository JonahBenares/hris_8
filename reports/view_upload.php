<?php 
include('../template/header.php'); 
include('../includes/connection.php'); 
include('../template/navbar.php'); 
include('../includes/functions.php');
$today=date("Y-m-d");
if(isset($_GET['id'])){
    $id =  $_GET['id'];
    $select = $con->query("SELECT personal_id, fname, lname, resume_file, map_file, essay_file, photo_upload FROM personal_data WHERE personal_id = '$id'");
    $fetch = $select->fetch_array();
}
else{
    $id = "";
}
?>  
<style type="text/css">


</style>
<link rel="stylesheet" href="../assets/vendors/bower_components/lightgallery/dist/css/lightgallery.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
 
    function fetch_cert_data(file_id,personal_id){
        $.ajax({
        url:"../reports/fetch_certimg.php",
        method:"POST",
        data:'file_id='+file_id+'&personal_id='+personal_id,
        success:function(data){
            $('#post_modal').modal('show');
            $('#post_detail').html(data);
        }
        });
    }

    $(document).on('click', '.view', function(){
        var file_id = $(this).attr("id");
        var personal_id = $(this).attr("data-personal");
        fetch_cert_data(file_id,personal_id);
    });

    $(document).on('click', '.previous', function(){
        var file_id = $(this).attr("id");
        var personal_id = $(this).attr("data-personal");
        fetch_cert_data(file_id,personal_id);
    });

    $(document).on('click', '.next', function(){
        var file_id = $(this).attr("id");
        var personal_id = $(this).attr("data-personal");
        fetch_cert_data(file_id,personal_id);
    });

    function fetch_eval_data(eval_id,personal_id){
        $.ajax({
        url:"../reports/fetch_evalimg.php",
        method:"POST",
        data:'eval_id='+eval_id+'&personal_id='+personal_id,
        success:function(data){
            $('#eval_modal').modal('show');
            $('#eval_detail').html(data);
        }
        });
    }

    $(document).on('click', '.vieweval', function(){
        var eval_id = $(this).attr("id");
        var personal_id = $(this).attr("data-personal");
        fetch_eval_data(eval_id,personal_id);
    });

    $(document).on('click', '.previouseval', function(){
        var eval_id = $(this).attr("id");
        var personal_id = $(this).attr("data-personal");
        fetch_eval_data(eval_id,personal_id);
    });

    $(document).on('click', '.nexteval', function(){
        var eval_id = $(this).attr("id");
        var personal_id = $(this).attr("data-personal");
        fetch_eval_data(eval_id,personal_id);
    });

    function fetch_other_data(other_id,personal_id){
        $.ajax({
        url:"../reports/fetch_otherimg.php",
        method:"POST",
        data:'other_id='+other_id+'&personal_id='+personal_id,
        success:function(data){
            $('#other_modal').modal('show');
            $('#other_detail').html(data);
        }
        });
    }

    $(document).on('click', '.viewothers', function(){
        var other_id = $(this).attr("id");
        var personal_id = $(this).attr("data-personal");
        fetch_other_data(other_id,personal_id);
    });

    $(document).on('click', '.previousother', function(){
        var other_id = $(this).attr("id");
        var personal_id = $(this).attr("data-personal");
        fetch_other_data(other_id,personal_id);
    });

    $(document).on('click', '.nextother', function(){
        var other_id = $(this).attr("id");
        var personal_id = $(this).attr("data-personal");
        fetch_other_data(other_id,personal_id);
    });
});
</script>
<section class="content">
    <div class="content__inner">
        <div class="row">
            <div class="col-lg-12">
                <!--Start MODAL -->
                <div id="post_modal" class="modal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content"> 
                            <div class="modal-header">
                                <h4 class="modal-title pull-left">CERTIFICATES</h4>
                            </div>
                            <div class="modal-body" id="post_detail"></div>
                        </div>
                    </div>
                </div>

                <div id="eval_modal" class="modal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content"> 
                            <div class="modal-header">
                                <h4 class="modal-title pull-left">EVALUATIONS</h4>
                            </div>
                            <div class="modal-body" id="eval_detail"></div>
                        </div>
                    </div>
                </div>

                <div id="other_modal" class="modal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content"> 
                            <div class="modal-header">
                                <h4 class="modal-title pull-left">OTHERS</h4>
                            </div>
                            <div class="modal-body" id="other_detail"></div>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="modal-default" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title pull-left">RESUME</h4>
                                <h5 class="m-b-0"><?php  echo($fetch['fname'] ." ".$fetch['lname'] ) ?></h5>
                            </div>
                            <div class="modal-body">
                                <?php                                         
                                    if(!empty($fetch['resume_file'])){
                                    $res = explode(".",$fetch['resume_file']);
                                    $ext_resume = $res[1]; 
                                    if($ext_resume == 'png' || $ext_resume == 'jpg' || $ext_resume == 'jpeg' || $ext_resume == 'PNG' || $ext_resume == 'JPG' || $ext_resume == 'JPEG' || $ext_resume == 'JPEG'){  
                                    ?>
                                    <a href="" id="modalbutton" data-id = "<?php echo $id ?>"> 
                                        <img src="../uploads/<?php echo sanitize(utf8_encode($fetch['resume_file'])); ?>" width="100%" height="" class="thumbnail" alt="<?php echo $fetch['resume_file']?>" >
                                    </a>                                    
                                <?php } } ?>
                            </div>
                            <input type='hidden' name='resume_count' id='id' value='<?php echo $id?>'>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="mapSketch" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title pull-left">MAP SKETCH</h4>
                                <h5 class="m-b-0"><?php  echo($fetch['fname'] ." ".$fetch['lname'] ) ?></h5>
                            </div>
                            <div class="modal-body">
                                <?php                                         
                                    if(!empty($fetch['map_file'])){
                                    $map = explode(".",$fetch['map_file']);
                                    $ext_map = $map[1]; 
                                    if($ext_map == 'png' || $ext_map == 'jpg' || $ext_map == 'jpeg' || $ext_map == 'PNG' || $ext_map == 'JPG' || $ext_map == 'JPEG'){  
                                ?>
                                    <a href="" id="modalbutton" data-id = "<?php echo $id ?>"> 
                                        <img src="../uploads/<?php echo sanitize(utf8_encode($fetch['map_file'])); ?>" width="100%" height="" class="thumbnail" alt="<?php echo $fetch['map_file']?>" >
                                    </a>                                    
                                <?php } } ?>
                            </div>
                            <input type='hidden' name='resume_count' id='id' value='<?php echo $id?>'>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="essayFile" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title pull-left">ESSAY FILE</h4>
                                <h5 class="m-b-0"><?php  echo($fetch['fname'] ." ".$fetch['lname'] ) ?></h5>
                            </div>
                            <div class="modal-body">
                                <?php
                                    if(!empty($fetch['essay_file'])){
                                    $essay = explode(".",$fetch['essay_file']);
                                    $ext_essay = $essay[1]; 
                                    if($ext_essay == 'png' || $ext_essay == 'jpg' || $ext_essay == 'jpeg' || $ext_essay == 'PNG' || $ext_essay == 'JPG' || $ext_essay == 'JPEG'){  
                                ?>
                                    <a href="" id="modalbutton" data-id = "<?php echo $id ?>"> 
                                        <img src="../uploads/<?php echo sanitize(utf8_encode($fetch['essay_file'])); ?>" width="100%" height="" class="thumbnail" alt="<?php echo $fetch['essay_file']?>" >
                                    </a>                                    
                                <?php } } ?>
                            </div>
                            <input type='hidden' name='resume_count' id='id' value='<?php echo $id?>'>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="photo" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title pull-left">Photo</h4>
                                <h5 class="m-b-0"><?php  echo($fetch['fname'] ." ".$fetch['lname'] ) ?></h5>
                            </div>
                            <div class="modal-body">
                                <?php
                                    if(!empty($fetch['photo_upload'])){
                                    $photo = explode(".",$fetch['photo_upload']);
                                    $ext_photo = $photo[1]; 
                                    if($ext_photo == 'png' || $ext_photo == 'jpg' || $ext_photo == 'jpeg' || $ext_photo == 'PNG' || $ext_photo == 'JPG' || $ext_photo == 'JPEG'){  
                                ?>
                                    <a href="" id="modalbutton" data-id = "<?php echo $id ?>"> 
                                        <img src="../uploads/<?php echo sanitize(utf8_encode($fetch['photo_upload'])); ?>" width="100%" height="" class="thumbnail" alt="<?php echo $fetch['photo_upload']?>" >
                                    </a>                                    
                                <?php } } ?>
                            </div>
                            <input type='hidden' name='resume_count' id='id' value='<?php echo $id?>'>
                        </div>
                    </div>
                </div>
                <!--END MODAL -->

                <header class="content__title">
                    <a onclick="goBack()" class="actions__item" title="Back" data-toggle="tooltip"data-placement="right"><b></b><span class="zmdi zmdi-caret-left-circle"></span></b></a>
                    <div class="actions">
                        <a href="update_upload.php?id=<?php echo $id; ?>" class="actions__item"  title='Update Files' alt='Update Files' data-toggle="tooltip" data-placement="bottom">
                            <span class="zmdi zmdi-edit"></span>
                        </a>
                        <a href="employee_profile.php?id=<?php echo $id; ?>" class="actions__item" title='View Employee Profile' alt='View Employee Profile'data-toggle="tooltip" data-placement="bottom">
                            <span class="zmdi zmdi-account"></span>
                        </a>
                        <a href="form.php?id=<?php echo $id; ?>" class="actions__item"  title='View Employee Application Form' alt='View Employee' data-toggle="tooltip" data-placement="bottom">
                            <span class="zmdi zmdi-copy"></span>
                        </a>
                    </div>   
                </header>
                
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <center>
                                    <h5 class="m-b-0">RESUME</h5>
                                </center>
                            </div>
                            <div class="card-body">
                                <?php                                         
                                    if(!empty($fetch['resume_file'])){
                                    $res = explode(".",$fetch['resume_file']);
                                    $ext_resume = $res[1]; 
                                    if($ext_resume == 'png' || $ext_resume == 'jpg' || $ext_resume == 'jpeg' || $ext_resume == 'PNG' || $ext_resume == 'JPG' || $ext_resume == 'JPEG' || $ext_resume == 'JPEG'){  
                                    ?>
                                    <center>
                                    <a href=""  data-toggle="modal" data-target="#modal-default"  id="modalbutton" data-id = "<?php echo $id ?>"> 
                                        <img src="../uploads/<?php echo sanitize(utf8_encode($fetch['resume_file'])); ?>" alt="<?php echo $fetch['resume_file']?>"  class="img-thum">
                                        <center>
                                            <p class="m-t-10 m-b-0"><?php echo $fetch['resume_file']; ?></p>
                                        </center> 
                                    </a>      
                                    </center>                              
                                    <input type='hidden' name='resume_count' id='resume_count' value='<?php echo $id ?>'>
                                    <?php } else { ?>
                                        <center>
                                            <a href='../uploads/<?php echo sanitize(utf8_encode($fetch['resume_file'])); ?>' target='_blank'>
                                                <img  src="../uploads/default/file1.png"   class="img-thum">
                                                <center>
                                                    <p class="m-t-10 m-b-0"><?php echo $fetch['resume_file']; ?></p>
                                                </center>                                        
                                            </a>
                                        </center>
                                    <?php } 
                                    } else { ?>
                                    <center>
                                        <img  src="../uploads/default/nofile1.png" class="img-thum">
                                    </center>
                                    <center>
                                        <p class="m-t-10 m-b-0">File not found</p>
                                        <br>
                                    </center>
                                <?php } ?>
                            </div> 
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <center>
                                    <h5 class="m-b-0">MAP SKETCH</h5>
                                </center>
                            </div>
                            <div class="card-body">
                                <?php                                         
                                    if(!empty($fetch['map_file'])){
                                        $map = explode(".",$fetch['map_file']);
                                        $ext_map = $map[1]; 
                                        if($ext_map == 'png' || $ext_map == 'jpg' || $ext_map == 'jpeg' || $ext_map == 'PNG' || $ext_map == 'JPG' || $ext_map == 'JPEG'){  
                                ?>
                                    <center>
                                    <a href=""  data-toggle="modal" data-target="#mapSketch"  id="modalbutton" data-id = "<?php echo $id ?>"> 
                                        <img src="../uploads/<?php echo sanitize(utf8_encode($fetch['map_file'])); ?>" alt="<?php echo $fetch['map_file']?>"  class="img-thum">
                                        <center>
                                            <p class="m-t-10 m-b-0"><?php echo $fetch['map_file']; ?></p>
                                        </center> 
                                    </a>      
                                    </center>                              
                                    <input type='hidden' name='resume_count' id='resume_count' value='<?php echo $id ?>'>
                                    <?php } else { ?>
                                        <center>
                                            <a href='../uploads/<?php echo sanitize(utf8_encode($fetch['map_file'])); ?>' target='_blank'>
                                                <img  src="../uploads/default/file1.png"   class="img-thum">
                                                <center>
                                                    <p class="m-t-10 m-b-0"><?php echo $fetch['map_file']; ?></p>
                                                </center>                                        
                                            </a>
                                        </center>
                                    <?php } 
                                    } else { ?>
                                    <center>
                                        <img  src="../uploads/default/nofile1.png" class="img-thum">
                                    </center>
                                    <center>
                                        <p class="m-t-10 m-b-0">File not found</p>
                                        <br>
                                    </center>
                                <?php } ?>
                            </div> 
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <center>
                                    <h5 class="m-b-0">ESSAY FILE</h5>
                                </center>
                            </div>
                            <div class="card-body">
                                <?php                                         
                                    if(!empty($fetch['essay_file'])){
                                        $essay = explode(".",$fetch['essay_file']);
                                        $ext_essay = $essay[1]; 
                                        if($ext_essay == 'png' || $ext_essay == 'jpg' || $ext_essay == 'jpeg' || $ext_essay == 'PNG' || $ext_essay == 'JPG' || $ext_essay == 'JPEG'){  
                                ?>
                                    <center>
                                    <a href=""  data-toggle="modal" data-target="#essayFile"  id="modalbutton" data-id = "<?php echo $id ?>"> 
                                        <img src="../uploads/<?php echo sanitize(utf8_encode($fetch['essay_file'])); ?>" alt="<?php echo $fetch['essay_file']?>"  class="img-thum">
                                        <center>
                                            <p class="m-t-10 m-b-0"><?php echo $fetch['essay_file']; ?></p>
                                        </center> 
                                    </a>      
                                    </center>                              
                                    <input type='hidden' name='resume_count' id='resume_count' value='<?php echo $id ?>'>
                                    <?php } else { ?>
                                        <center>
                                            <a href='../uploads/<?php echo sanitize(utf8_encode($fetch['essay_file'])); ?>' target='_blank'>
                                                <img  src="../uploads/default/file1.png"   class="img-thum">
                                                <center>
                                                    <p class="m-t-10 m-b-0"><?php echo $fetch['essay_file']; ?></p>
                                                </center>                                        
                                            </a>
                                        </center>
                                    <?php } 
                                    } else { ?>
                                    <center>
                                        <img  src="../uploads/default/nofile1.png" class="img-thum">
                                    </center>
                                    <center>
                                        <p class="m-t-10 m-b-0">File not found</p>
                                        <br>
                                    </center>
                                <?php } ?>
                            </div> 
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <center>
                                    <h5 class="m-b-0">PHOTO</h5>
                                </center>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(!empty($fetch['photo_upload'])){
                                    $photo = explode(".",$fetch['photo_upload']);
                                    $ext_photo = $photo[1]; 
                                    if($ext_photo == 'png' || $ext_photo == 'jpg' || $ext_photo == 'jpeg' || $ext_photo == 'PNG' || $ext_photo == 'JPG' || $ext_photo == 'JPEG'){  
                                ?>
                                    <center>
                                    <a href=""  data-toggle="modal" data-target="#photo"  id="modalbutton" data-id = "<?php echo $id ?>"> 
                                        <img src="../uploads/<?php echo sanitize(utf8_encode($fetch['photo_upload'])); ?>" alt="<?php echo $fetch['photo_upload']?>"  class="img-thum">
                                        <center>
                                            <p class="m-t-10 m-b-0"><?php echo $fetch['photo_upload']; ?></p>
                                        </center> 
                                    </a>      
                                    </center>                              
                                    <input type='hidden' name='resume_count' id='resume_count' value='<?php echo $id ?>'>
                                    <?php } else { ?>
                                        <center>
                                            <a href='../uploads/<?php echo sanitize(utf8_encode($fetch['photo_upload'])); ?>' target='_blank'>
                                                <img  src="../uploads/default/image.png"   class="img-thum">
                                                <center>
                                                    <p class="m-t-10 m-b-0"><?php echo $fetch['photo_upload']; ?></p>
                                                </center>                                        
                                            </a>
                                        </center>
                                    <?php } 
                                    } else { ?>
                                    <center>
                                        <img  src="../uploads/default/noimage.png" class="img-thum">
                                    </center>
                                    <center>
                                        <p class="m-t-10 m-b-0">File not found</p>
                                        <br>
                                    </center>
                                <?php } ?>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-b-0">CERTIFICATES</h5>
                    </div>
                    <div class="card-body">
                        <div class="gallery-wrapper">
                            <?php 
                                $sql = mysqli_query($con,"SELECT * FROM certificate WHERE personal_id = '$id'");  
                                $count_cert = mysqli_num_rows($sql); 
                                while ($row1 = mysqli_fetch_array($sql)){    
                                    $cert=explode(".",$row1['cert_file']);
                                    $cert_ext = $cert[1];
                                    if($cert_ext=='png' || $cert_ext=='jpg' || $cert_ext == 'jpeg' || $cert_ext == 'PNG' || $cert_ext == 'JPG' || $cert_ext == 'JPEG'){ 
                            ?> 
                            <div class="image-wrapper">
                                <a type="button" name="view" class="view" id="<?php echo $row1['file_id']; ?>" data-personal="<?php echo $row1['personal_id'];?>"><img src="<?php echo '../uploads/'.$row1['cert_file'];?>" alt="">
                                    <div class="image-title"><?php echo $row1['cert_name']?></div>
                                </a>
                            </div>
                            <?php }else{ ?>
                            <div class="image-wrapper">
                                <a href='../uploads/<?php echo sanitize(utf8_encode($row1['cert_file'])); ?>'>
                                    <img src="../uploads/default/file1.png" alt="">
                                    <div class="image-title"><?php echo $row1['cert_file']; ?></div>
                                </a>
                            </div>
                            <?php } } ?>
                        </div>
                        <?php if($count_cert==0){ ?>
                        <div style='border:1px solid #fff; padding: 20px'>
                            <center>
                               <span class="label label-danger">No Available File/s </span>
                            </center>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-b-0">EVALUATION</h5>
                    </div>
                    <div class="card-body">
                        <div class="gallery-wrapper">
                            <?php 
                                $sqleval = mysqli_query($con,"SELECT * FROM evaluation WHERE personal_id = '$id'");  
                                $count_eval = mysqli_num_rows($sqleval); 
                                while ($roweval = mysqli_fetch_array($sqleval)){    
                                    $eval=explode(".",$roweval['eval_file']);
                                    $eval_ext = $eval[1];
                                    if($eval_ext=='png' || $eval_ext=='jpg' || $eval_ext == 'jpeg' || $eval_ext == 'PNG' || $eval_ext == 'JPG' || $eval_ext == 'JPEG'){ 
                            ?> 
                            <div class="image-wrapper">
                                <a type="button" name="view" class="vieweval" id="<?php echo $roweval['eval_id']; ?>" data-personal="<?php echo $roweval['personal_id'];?>"><img src="<?php echo '../uploads/'.$roweval['eval_file'];?>" alt="">
                                    <div class="image-title"><?php echo $roweval['eval_period']?></div>
                                </a>
                            </div>
                            <?php }else{ ?>
                            <div class="image-wrapper">
                                <a href='../uploads/<?php echo sanitize(utf8_encode($roweval['eval_file'])); ?>'>
                                    <img src="../uploads/default/file1.png" alt="">
                                    <div class="image-title"><?php echo $roweval['eval_file']; ?></div>
                                </a>
                            </div>
                            <?php } } ?>
                        </div>
                        <?php if($count_eval==0){ ?>
                        <div style='border:1px solid #fff; padding: 20px'>
                            <center>
                               <span class="label label-danger">No Available File/s </span>
                            </center>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-b-0">OTHER DOCUMENTS</h5>
                    </div>
                    <div class="card-body">
                        <div class="gallery-wrapper">
                            <?php 
                                $sqlother = mysqli_query($con,"SELECT * FROM other_files WHERE personal_id = '$id'");  
                                $count_other = mysqli_num_rows($sqlother); 
                                while ($rowother = mysqli_fetch_array($sqlother)){    
                                    $other=explode(".",$rowother['other_file']);
                                    $other_ext = $other[1];
                                    if($other_ext=='png' || $other_ext=='jpg' || $other_ext == 'jpeg' || $other_ext == 'PNG' || $other_ext == 'JPG' || $other_ext == 'JPEG'){ 
                            ?> 
                            <div class="image-wrapper">
                                <a type="button" name="view" class="viewothers" id="<?php echo $rowother['other_id']; ?>" data-personal="<?php echo $rowother['personal_id'];?>"><img src="<?php echo '../uploads/'.$rowother['other_file'];?>" alt="">
                                    <div class="image-title"><?php echo $rowother['other_name']?></div>
                                </a>
                            </div>
                            <?php }else{ ?>
                            <div class="image-wrapper">
                                <a href='../uploads/<?php echo sanitize(utf8_encode($rowother['other_file'])); ?>'>
                                    <img src="../uploads/default/file1.png" alt="">
                                    <div class="image-title"><?php echo $rowother['other_file']; ?></div>
                                </a>
                            </div>
                            <?php } } ?>
                        </div>
                        <?php if($count_other==0){ ?>
                        <div style='border:1px solid #fff; padding: 20px'>
                            <center>
                               <span class="label label-danger">No Available File/s </span>
                            </center>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>



<?php 
include('../template/footer.php'); 
?> 
<script src="../assets/vendors/bower_components/lightgallery/dist/js/lightgallery-all.min.js"></script>
<script type="text/javascript">
    $(document).on("click", "#modalbutton", function() {
        var id = $(this).attr("data-id");
        $("#id").val(id);
    });
</script> 
    