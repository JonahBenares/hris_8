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
<script src = "../assets/js/jquery.min.js" type="text/javascript"></script>
<script src = "../assets/js/jquery-migrate.min.js" type="text/javascript"></script>
<script type='text/javascript'>
function showFileSize() {
    var input, file;
    // (Can't use `typeof FileReader === "function"` because apparently
    // it comes back as "object" on some browsers. So just see if it's there
    // at all.)
    if (!window.FileReader) {
        bodyAppend("p", "The file API isn't supported on this browser yet.");
        return;
    }
    resume = document.getElementById('resume_file');
    essay = document.getElementById('essay_file');
    sketch = document.getElementById('sketch');
    photo = document.getElementById('photo_upload');
    counter = document.getElementById('counter').value;
    counter1 = document.getElementById('counter1').value;
    counter2 = document.getElementById('counter2').value;
    counterX = document.getElementById('counterX').value;
    counterX1 = document.getElementById('counterX1').value;
    counterX2 = document.getElementById('counterX2').value;
    var counter_error=0;
    if(counterX===''){
        ctr =  counter;
    } else{
        counterX_val = document.getElementById('counterX').value;
        ctr =  counterX_val;
    }
   
    if(counterX1===''){
        ctr1 =  counter1;
    } else{
        counterX1_val = document.getElementById('counterX1').value;
        ctr1 =  counterX1_val;
    }

    if(counterX2===''){
        ctr2 =  counter2;
    } else{
        counterX2_val = document.getElementById('counterX2').value;
        ctr2 =  counterX2_val;
    }
 
    fileresume = resume.files[0];
    if(typeof fileresume !== 'undefined'){
        fileresume = resume.files[0];
        if(fileresume.size > 50000000){
            document.getElementById("resumeBox").innerHTML="Error: Resume file size is too big. Max file size is 50mb.";
            counter_error++;
        }
    }

    filesketch = sketch.files[0];
    if(typeof filesketch !== 'undefined'){
        if(filesketch.size > 50000000){
            document.getElementById("mapBox").innerHTML="Error: Map file size is too big. Max file size is 50mb.";
            counter_error++;
        }
    }

    fileessay = essay.files[0];
    if(typeof fileessay !== 'undefined'){
        if(fileessay.size > 50000000){
            document.getElementById("essayBox").innerHTML="Error: Essay file size is too big. Max file size is 50mb.";
            counter_error++;
        }
    }

    filephoto = photo.files[0];
    if(typeof filephoto !== 'undefined'){
        if(filephoto.size > 50000000){
            document.getElementById("photoBox").innerHTML="Error: Photo size is too big. Max file size is 50mb.";
            counter_error++;
        }
    }


    if(ctr==0){
        cert = document.getElementById('p_cert1');
        filecert = cert.files[0];
        if(typeof filecert !== 'undefined'){
            if(filecert.size > 50000000){
                document.getElementById("certBox1").innerHTML="Error: Certificate file size is too big. Max file size is 50mb.";
                counter_error++;
            }
        }
    } else if(ctr>=1){
        for(x=1;x<=ctr;x++){
            cert = document.getElementById('p_cert'+x);
            filecert = cert.files[0];
            if(typeof filecert !== 'undefined'){
                if(filecert.size > 50000000){
                  document.getElementById('certBox'+x).innerHTML="Error: Certificate file size is too big. Max file size is 50mb.";
                  counter_error++;
                }
            }
        }
    }

    if(ctr1 == 0){
        eval = document.getElementById('p_eval1');
        fileseval = eval.files[0];
        if(typeof fileseval !== 'undefined'){
            if(fileseval.size > 50000000){
                document.getElementById("evalBox1").innerHTML="Error: Evaluation file size is too big. Max file size is 50mb.";
                counter_error++;
            }
        }
    } else if(ctr1>=1){
        for(y=1;y<=ctr1;y++){
            eval = document.getElementById('p_eval'+y);
            fileeval = eval.files[0];
            if(typeof fileeval !== 'undefined'){
                if(fileeval.size > 50000000){
                    document.getElementById('evalBox'+y).innerHTML="Error: Evaluation file size is too big. Max file size is 50mb.";
                    counter_error++;
                }
            }
        }
    }

    if(ctr2 == 0){
        other = document.getElementById('p_ot1');
        filesother = other.files[0];
        if(typeof filesother !== 'undefined'){
            if(filesother.size > 50000000){
                document.getElementById("otherBox1").innerHTML="Error: Evaluation file size is too big. Max file size is 50mb.";
                counter_error++;
            }
        }
    } else if(ctr2>=1){
        for(z=1;z<=ctr2;z++){
            other = document.getElementById('p_ot'+z);
            fileother = other.files[0];
            if(typeof fileother !== 'undefined'){
                if(fileother.size > 50000000){
                    document.getElementById('otherBox'+z).innerHTML="Error: Evaluation file size is too big. Max file size is 50mb.";
                    counter_error++;
                }
            }
        }
    }
   
    if(counter_error==0){
        var frm = new FormData();
        resume = document.getElementById('resume_file');
        sketch = document.getElementById('sketch');
        essay = document.getElementById('essay_file');
        photo = document.getElementById('photo_upload');
        id = document.getElementById('id').value;
        if(counterX===''){
            ctr =  counter;
        } else{
            counterX_val = document.getElementById('counterX').value;
            ctr =  counterX_val;     
        }
         
        if(counterX1===''){
            ctr1 =  counter1;
        } else{
            counterX1_val = document.getElementById('counterX1').value;
            ctr1 =  counterX1_val;
        }

        if(counterX2===''){
            ctr2 =  counter2;
        } else{
            counterX2_val = document.getElementById('counterX2').value;
            ctr2 =  counterX2_val;
        }      
        frm.append('resume_file', resume.files[0]);
        frm.append('map_file', sketch.files[0]);
        frm.append('essay_file', essay.files[0]);
        frm.append('photo_upload', photo.files[0]);
        frm.append('id', id);
        frm.append('counter', counter);
        frm.append('counter1', counter1);
        frm.append('counter2', counter2);
        frm.append('counterX', counterX);
        frm.append('counterX1', counterX1);
        frm.append('counterX2', counterX2);

        if(ctr==0){
            cert = document.getElementById('p_cert1');
            certname1 = document.getElementById('name_cert1').value;
            frm.append('cert_file1', cert.files[0]);
            frm.append('cert_name1', certname1);
        } else if(ctr>0){
            for(x=1;x<=ctr;x++){
                cert = document.getElementById('p_cert'+x);
                certname = document.getElementById('name_cert'+x).value;
                certid = document.getElementById('cert_id'+x).value;
                frm.append('cert_file'+x, cert.files[0]);
                frm.append('cert_name'+x, certname);
                frm.append('cert_id'+x, certid);
            }
        }
    
        if(ctr1==0){
            eval = document.getElementById('p_eval1');
            evalname1 = document.getElementById('p_name1').value;
            frm.append('eval_file1', eval.files[0]);
            frm.append('eval_period1', evalname1);
        } else if(ctr1>0){
            for(x=1;x<=ctr1;x++){
                eval = document.getElementById('p_eval'+x);
                evalname = document.getElementById('p_name'+x).value;
                evalid = document.getElementById('eval_id'+x).value;
                frm.append('eval_file'+x, eval.files[0]);
                frm.append('eval_period'+x, evalname);
                frm.append('eval_id'+x, evalid);
            }
        }

        if(ctr2==0){
            other = document.getElementById('p_ot1');
            othername1 = document.getElementById('other_n1').value;
            frm.append('other_file1', other.files[0]);
            frm.append('other_name1', othername1);
        } else if(ctr2>0){
            for(d=1;d<=ctr2;d++){
                other = document.getElementById('p_ot'+d);
                othername = document.getElementById('other_n'+d).value;
                otherid = document.getElementById('other_id'+d).value;
                frm.append('other_file'+d, other.files[0]);
                frm.append('other_name'+d, othername);
                frm.append('other_id'+d, otherid);
            }
        }

        var id = document.getElementById('id').value;
        $(".form_container").append("<div class='sub'><h4>Loading. Please wait...</h4></div>")
        $.ajax({
            method: 'POST',
            url: "../reports/updatefiles.php",
            data: frm,
            contentType: false,
            processData: false,
            cache: false,
            success: function(output){
                alert('File/s successfully updated!');
                window.location ='view_upload.php?id='+id;
            } 
        });
    }
}

function bodyAppend(tagName, innerHTML) {
    var elm;
    elm = document.createElement(tagName);
    elm.innerHTML = innerHTML;
    document.body.appendChild(elm);
}

$(function() {
    var ctrx = document.getElementById('counter').value
    if(ctrx == 0){
        var certificateDiv = $('#p_certificate');
    } else {
        var certificateDiv = $('#p_certificate1');
    }
    var ii = document.getElementById('counter').value;
    $('#addCertificate').live('click', function() {
        ii++;
        $('<div class = "cert'+ii+'"><div class="row"><div for="p_certs" class="col-lg-3"></div><div class="col-lg-3"><input type="file" name="cert_file'+ii+'" id="p_cert'+ii+'" class="btn btn-sm btn-normal " style="width:100%" ><div id="certBox'+ii+'" class="cert"></div></div><div for = "name_certs" class="col-lg-3"><input type="name" name="cert_name'+ii+'" id="name_cert'+ii+'" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Name of Certificate"></div><div class="col-lg-3"><a href="#" class="btn btn-primary btn-sm btn-fill" id="addCertificate">+</a> <a href="#" class="btn btn-danger btn-sm btn-fill" id="remCertificate">x</a></div></div></div>').appendTo(certificateDiv);  
        document.getElementById("counterX").value = ii;
        $('<input type="hidden" id="cert_id'+ii+'" name="cert_id'+ii+'" value="" />').appendTo(certificateDiv);
        return false;
    });


    $('#remCertificate').live('click', function() { 
        if( ii >= 2 ) {
            ii--;
            $("div").remove(".cert" + ii);
        } 
        return false;
    });
});
$(function() {
    var ctrx1 = document.getElementById('counter1').value
    if(ctrx1 == 0){
        var evaluationDiv = $('#p_evaluation');
    } else {
        var evaluationDiv = $('#p_evaluation1');
    }
    var oo = document.getElementById('counter1').value;
    $('#addEvaluation').live('click', function() {
        oo++;
        $('<div class = "evalu'+oo+'"><div class="row"><div for="p_eval" class="col-lg-3"></div><div class="col-lg-3"><input type="file" name="eval_file'+oo+'" id="p_eval'+oo+'" class="btn btn-sm btn-normal " style="width:100%" ><div id="evalBox'+oo+'" class="eval"></div></div><div for = "name_certs" class="col-lg-3"><input type="name" name="eval_period'+oo+'" id="p_name'+oo+'" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Evaluation Notes"></div><div class="col-lg-3"><a href="#" class="btn btn-primary btn-sm btn-fill" id="addEvaluation">+</a> <a href="#" class="btn btn-danger btn-sm btn-fill" id="remEvaluation">x</a></div></div></div>').appendTo(evaluationDiv);
        $('<input type="hidden" id="eval_id'+oo+'" name="eval_id'+oo+'" value="" />').appendTo(evaluationDiv);
        document.getElementById("counterX1").value = oo;
        return false;
    });

    $('#remEvaluation').live('click', function() { 
        if( oo >= 2 ) {
            oo--;
            $("div").remove(".evalu" + oo);
        } 
        return false;
    });
});

$(function() {
    var ctrx2 = document.getElementById('counter2').value
    if(ctrx2 == 0){
        var otherDiv = $('#p_other');
    } else {
        var otherDiv = $('#p_other1');
    }
    var pp = document.getElementById('counter2').value;
  
    $('#addOther').live('click', function() {
        pp++;
        $('<div class = "ot'+pp+'"><div class="row"><div for="p_ot" class="col-lg-3"></div><div class="col-lg-3"><input type="file" name="other_file'+pp+'" id="p_ot'+pp+'" class="btn btn-sm btn-normal " style="width:100%" ><div id="otherBox'+pp+'" class="eval"></div></div><div for = "other_name" class="col-lg-3"><input type="name" name="other_name'+pp+'" id="other_n'+pp+'" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Other Document Name"></div><div class="col-lg-3"><a href="#" class="btn btn-primary btn-sm btn-fill" id="addOther">+</a> <a href="#" class="btn btn-danger btn-sm btn-fill" id="remOther">x</a></div></div></div>').appendTo(otherDiv);
        $('<input type="hidden" id="other_id'+pp+'" name="other_id'+pp+'" value="" />').appendTo(otherDiv);
        document.getElementById("counterX2").value = pp;
        return false;
    });

    $('#remOther').live('click', function() { 
        if( pp >= 2 ) {
            pp--;
            $("div").remove(".ot" + pp);
        } 
        return false;
    });
});

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
<style type="text/css">
    .pull-right{
        float: right;
    }
</style>
<section class="content">
    <div class="content__inner">
        <div class="row">
            <div class="col-lg-12">
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
                <div class="modal fade" id="modal-resume" tabindex="-1">
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
                                    <img src="../uploads/<?php echo sanitize(utf8_encode($fetch['resume_file'])); ?>" width="100%" height="" class="thumbnail" alt="<?php echo $fetch['resume_file']?>" >                                    
                                <?php } } ?>
                            </div>
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
                                    <img src="../uploads/<?php echo sanitize(utf8_encode($fetch['map_file'])); ?>" width="100%" height="" class="thumbnail" alt="<?php echo $fetch['map_file']?>" >                             
                                <?php } } ?>
                            </div>
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
                                    <img src="../uploads/<?php echo sanitize(utf8_encode($fetch['essay_file'])); ?>" width="100%" height="" class="thumbnail" alt="<?php echo $fetch['essay_file']?>" >                                 
                                <?php } } ?>
                            </div>
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
                                    <img src="../uploads/<?php echo sanitize(utf8_encode($fetch['photo_upload'])); ?>" width="100%" height="" class="thumbnail" alt="<?php echo $fetch['photo_upload']?>" >                                   
                                <?php } } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-b-0">UPDATE UPLOADED FILES</h5>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="POST">                       
                                <div style="margin-top:10px">

                                    <!-- --RESUME-- -->
                                    <div class="row">
                                        <div for="resume" class="col-lg-3 "><h5 class="pull-right">Resume:</h5></div>
                                        <div class="col-lg-6">
                                            <input type="file" name="resume_file" id="resume_file" class="btn btn-sm btn-normal" style="width:100%">
                                            <?php if(!empty($fetch['resume_file'])){
                                                $res = explode(".",$fetch['resume_file']);
                                                $ext_resume = $res[1]; 
                                                if($ext_resume == 'png' || $ext_resume == 'jpg' || $ext_resume == 'jpeg' || $ext_resume == 'PNG' || $ext_resume == 'JPG' || $ext_resume == 'JPEG' || $ext_resume == 'JPEG'){   ?>
                                                    <a data-toggle="modal" data-target="#modal-resume" style = "cursor:pointer;" class='display'>
                                                      <?php echo (empty($id) ? '' : $fetch['resume_file']); ?>
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="../uploads/<?php echo $fetch['resume_file']; ?>"  class='display'>
                                                        <?php echo (empty($id) ? '' : $fetch['resume_file']); ?>
                                                    </a>
                                            <?php } } ?>
                                            <div id='resumeBox'></div>
                                            <input type='hidden' name='res_ext' id = 'res_ext' value="<?php echo $ext_resume; ?>">
                                        </div>                                
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <!-- --RESUME-- -->



                                    <!-- --MAP SKETCH-- -->
                                    <div class="row">
                                        <div for="sketch" class="col-lg-3 "><h5 class="pull-right">Map Sketch:</h5></div>
                                        <div class="col-lg-6">
                                            <input type="file" name="map_file" id="sketch" class="btn btn-sm btn-normal " style="width:100%">
                                            <?php
                                            if(!empty($fetch['map_file'])){
                                                $map = explode(".",$fetch['map_file']);
                                                $ext_map = $map[1]; 
                                                if($ext_map == 'png' || $ext_map == 'jpg' || $ext_map == 'jpeg' || $ext_map == 'PNG' || $ext_map == 'JPG' || $ext_map == 'JPEG' || $ext_map == 'JPEG'){   
                                            ?>
                                            <a data-toggle="modal" data-target="#mapSketch" style = "cursor:pointer;" class='display'><?php echo (empty($id) ? '' : $fetch['map_file']); ?></a>
                                            <?php } else { ?>
                                            <a href='../uploads/<?php echo $fetch['map_file']; ?>' class='display' ><?php echo $fetch['map_file']; ?></a>      
                                            <?php } } ?>
                                            <div id='mapBox'></div>
                                            <input type='hidden' name='map_ext' id = 'map_ext' value="<?php echo $ext_map; ?>">                      
                                        </div>   
                                        <div class="col-lg-3"></div>  
                                    </div>  
                                    <!-- --MAP SKETCH-- -->   


                                    <!-- --ESSAY FILE-- -->
                                    <div class="row">
                                        <div for="sketch" class="col-lg-3 "><h5 class="pull-right">Essay File:</h5></div>
                                        <div class="col-lg-6">
                                            <input type="file" name="essay_file" id="essay_file" class="btn btn-sm btn-normal " style="width:100%">
                                            <?php if(!empty($fetch['essay_file'])){
                                                $map = explode(".",$fetch['essay_file']);
                                                $ext_essay = $map[1]; 
                                                if($ext_essay == 'png' || $ext_essay == 'jpg' || $ext_essay == 'jpeg' || $ext_essay == 'PNG' || $ext_essay == 'JPG' || $ext_essay == 'JPEG' || $ext_essay == 'JPEG'){ 
                                            ?>
                                            <a data-toggle="modal" data-target="#essayFile" style = "cursor:pointer;" class='display'><?php echo (empty($id) ? '' : $fetch['essay_file']); ?></a>  
                                            <?php } else { ?>
                                                <a href='../uploads/<?php echo $fetch['essay_file']; ?>' class='display' ><?php echo $fetch['essay_file']; ?></a> 
                                            <?php } } ?>
                                            <div id='essayBox'></div>
                                            <input type='hidden' name='essay_ext' id = 'essay_ext' value="<?php echo $ext_essay; ?>">
                                        </div>  
                                        <div class="col-lg-3"></div>
                                    </div>  
                                    <!-- --ESSAY FILE-- -->


                                    <!-- --UPLOAD FILE-- -->
                                    <div class="row">
                                        <div for="sketch" class="col-lg-1 "></div>
                                        <div for="sketch" class="col-lg-2 "><h5 class="pull-right">Photo Upload:</h5></div>
                                        <div class="col-lg-6">
                                            <input type="file" name="photo_upload" id="photo_upload" class="btn btn-sm btn-normal " style="width:100%">
                                            <?php if(!empty($fetch['photo_upload'])){
                                                $photo = explode(".",$fetch['photo_upload']);
                                                $ext_photo = $photo[1]; 
                                                if($ext_photo == 'png' || $ext_photo == 'jpg' || $ext_photo == 'jpeg' || $ext_photo == 'PNG' || $ext_photo == 'JPG' || $ext_photo == 'JPEG' || $ext_photo == 'JPEG'){  
                                            ?>
                                            <a data-toggle="modal" data-target="#photo" style = "cursor:pointer;" class='display'><?php echo (empty($id) ? '' : $fetch['photo_upload']); ?></a>  
                                           <?php } else { ?>
                                            <a href='../uploads/<?php echo $fetch['photo_upload']; ?>' class='display' ><?php echo $fetch['photo_upload']; ?></a>  
                                            <?php } } ?>
                                            <div id='photoBox'></div>
                                        </div>       
                                        <input type='hidden' name='photo_ext' id = 'photo_ext' value="<?php echo $ext_photo; ?>">
                                        <div class="col-lg-3"></div>
                                    </div>   
                                    <!-- --UPLOAD FILE-- -->

                                </div> 
                                 <?php 
                                $getcert = $con->query("SELECT file_id, cert_file, cert_name, personal_id FROM certificate WHERE personal_id ='$id'");
                                $rows_cert = $getcert->num_rows;
                                if($rows_cert==0){ ?>
                                                         
                                <div id = "p_certificate">
                                    <div class="row" >
                                        <div for="p_cert" class="col-lg-3 "><h5 class="pull-right">Certificate:</h5></div>
                                        <div class="col-lg-3">
                                            <input type="file" name="cert_file1" id="p_cert1" class="btn btn-sm btn-normal " style="width:100%" >
                                             <div id='certBox1' class='cert'></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="name" name="cert_name1" id="name_cert1" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Name of Certificate" > 
                                            <input type = "hidden" value = "0" id = "counter" name = "counter">
                                        </div>                                
                                        <div class="col-lg-3">
                                            <a href="#" class="btn btn-primary btn-sm btn-fill" id="addCertificate">+</a> 
                                            <a href="#" class="btn btn-danger btn-sm btn-fill" id="remCertificate">x</a>
                                        </div>
                                    </div >
                                </div>
                                <?php } else { 
                                  $a=1;
                                  while($fetch_cert = $getcert->fetch_array()){ ?>
                                   <div id = "p_certificate">
                                    <div class="row">
                                        <div for="p_cert" class="col-lg-3 "><h5 class="pull-right">Certificate <?php echo $a; ?>: </h5></div>
                                        <div class="col-lg-3">
                                            <input type="file" name="cert_file<?php echo $a; ?>" id="p_cert<?php echo $a; ?>" class="btn btn-sm btn-normal" style="width:100%">
                                            <?php if(!empty($fetch_cert['cert_file'])){
                                                  $cert = explode(".",$fetch_cert['cert_file']);
                                                  $ext_cert = $cert[1]; 
                                                if($ext_cert=='png' || $ext_cert=='jpg' || $ext_cert == 'jpeg' || $ext_cert == 'PNG' || $ext_cert == 'JPG' || $ext_cert == 'JPEG'){ 
                                            ?>
                                            <a type="button" name="view" class="view" id="<?php echo $fetch_cert['file_id']; ?>" data-personal="<?php echo $fetch_cert['personal_id'];?>"><?php echo (empty($id) ? '' : $fetch_cert['cert_file']); ?></a> 
                                            <?php } else { ?>
                                            <a href='../uploads/<?php echo $fetch_cert['cert_file']; ?>' class='display' ><?php echo $fetch_cert['cert_file']; ?></a>
                                            <?php } ?>
                                            <input type='hidden' name='cert_ext<?php echo $a; ?>' id = 'cert_ext<?php echo $a; ?>' value="<?php echo $ext_cert; ?>">
                                        <?php } ?>
                                        </div>

                                       
                                        <div class="col-lg-3">
                                            <input type="name" name="cert_name<?php echo $a; ?>" id="name_cert<?php echo $a; ?>" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Name of Certificate" value="<?php echo (empty($id) ? '' : $fetch_cert['cert_name']); ?>"> 
                                           
                                        </div>                                
                                        <div class="col-lg-3">
                                            <a href="#" class="btn btn-primary btn-sm btn-fill" id="addCertificate">+</a>  
                                            <a href="#" class="btn btn-danger btn-sm btn-fill" id="remCertificate">x</a>
                                        </div>
                                    </div>
                                     <div id='certBox<?php echo $a; ?>' class='cert'></div>
                                </div>
                                  <input type="hidden" name="cert_id<?php echo $a; ?>" id="cert_id<?php echo $a; ?>"  value=" <?php echo $fetch_cert['file_id'];?>"> 

                                <?php
                                   $a++;
                                 }
                                   ?>
                                    <div id = "p_certificate1">
                                  
                                   </div>
                                   <?php
                                  } ?>
                                     <input type = "hidden" value = "<?php echo $rows_cert; ?>" id = "counter" name = "counter">
                               
                                <?php 
                                $today = date('Y');
                                $geteval = $con->query("SELECT eval_id, eval_file, eval_period,personal_id FROM evaluation WHERE personal_id ='$id'");
                                $rows_eval = $geteval->num_rows;
                                if($rows_eval==0){ ?>
                                <div id = "p_evaluation">
                                    <div class="row" >
                                        <div for="p_evals" class="col-lg-3 "><h5 class="pull-right">Evaluation:</h5></div>
                                        <div class="col-lg-3">
                                            <input type="file" name="eval_file1" id="p_eval1" class="btn btn-sm btn-normal " style="width:100%" >
                                             <div id='evalBox1' class='eval'></div>
                                        </div>
                                        <div class="col-lg-3">
                                             <input type="name" name="eval_period1" id="p_name1" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Evaluation Notes" >
                                          
                                            <input type = "hidden" value = "0" id = "counter1" name = "counter1">
                                        </div>                                
                                        <div class="col-lg-3">
                                            <a href="#" class="btn btn-primary btn-sm btn-fill" id="addEvaluation">+</a> 
                                            <a href="#" class="btn btn-danger btn-sm btn-fill" id="remEvaluation">x</a>
                                        </div>
                                        
                                    </div >
                                    
                                </div>
                                <?php } 
                                 else { 
                                  $b=1;
                                  while($fetch_eval = $geteval->fetch_array()){ 
                                   // echo $fetch_eval['eval_period'];
                                   ?>
                                     <div id = "p_evaluation">
                                    <div class="row" >
                                        <div for="p_evals" class="col-lg-3 "><h5 class="pull-right">Evaluation <?php echo $b; ?>:</h5></div>
                                        <div class="col-lg-3">
                                            <input type="file" name="eval_file<?php echo $b; ?>" id="p_eval<?php echo $b; ?>" class="btn btn-sm btn-normal " style="width:100%" > 
                                            <?php if(!empty($fetch_eval['eval_file'])){
                                                $eval = explode(".",$fetch_eval['eval_file']);
                                                $ext_eval = $eval[1]; 
                                                if($ext_eval=='png' || $ext_eval=='jpg' || $ext_eval == 'jpeg' || $ext_eval == 'PNG' || $ext_eval == 'JPG' || $ext_eval == 'JPEG'){
                                            ?>
                                            <a type="button" name="view" class="vieweval" id="<?php echo $fetch_eval['eval_id']; ?>" data-personal="<?php echo $fetch_eval['personal_id'];?>"><?php echo (empty($id) ? '' : $fetch_eval['eval_file']); ?></a>   
                                            <?php } else { ?>
                                            <a href='../uploads/<?php echo $fetch_eval['eval_file']; ?>' class='display' ><?php echo $fetch_eval['eval_file']; ?></a>
                                            <?php } ?>
                                             <input type='hidden' name='eval_ext<?php echo $b; ?>' id = 'eval_ext<?php echo $b; ?>' value="<?php echo $ext_eval; ?>">
                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-3">
                                             <input type="name" name="eval_period<?php echo $b; ?>" id="p_name<?php echo $b; ?>" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" value="<?php echo (!empty($fetch_eval['eval_period']) ? $fetch_eval['eval_period'] : ''); ?>" >
                                        </div>                                
                                        <div class="col-lg-3">
                                            <a href="#" class="btn btn-primary btn-sm btn-fill" id="addEvaluation">+</a> 
                                            <a href="#" class="btn btn-danger btn-sm btn-fill" id="remEvaluation">x</a>
                                        </div>
                                        <div id='evalBox<?php echo $b; ?>' class='eval'></div>
                                    </div >
                                    <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
                                </div>
                                   <input type="hidden" name="eval_id<?php echo $b; ?>" id="eval_id<?php echo $b; ?>" value=" <?php echo $fetch_eval['eval_id'];?>">
                                <?php 
                                    $b++;
                                    } ?>
                                     <div id = "p_evaluation1">
                                  
                                   </div>
                                     <input type = "hidden" value = "<?php echo $rows_eval; ?>" id = "counter1" name = "counter1">
                                <?php } ?>
                                  

                                  <?php 
                                $getother = $con->query("SELECT other_id, other_file, other_name, personal_id FROM other_files WHERE personal_id ='$id'");
                                $row_other = $getother->num_rows;
                                if($row_other==0){ ?>
                                                         
                                <div id = "p_other">
                                    <div class="row" >
                                        <div for="p_ot" class="col-lg-3 "><h5 class="pull-right">Other:</h5></div>
                                        <div class="col-lg-3">
                                            <input type="file" name="other_file1" id="p_ot1" class="btn btn-sm btn-normal " style="width:100%" >
                                             <div id='otherBox1' class='cert'></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="name" name="other_name1" id="other_n1" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Other Document Name" > 
                                            <input type = "hidden" value = "0" id = "counter2" name = "counter2">
                                        </div>                                
                                        <div class="col-lg-3">
                                            <a href="#" class="btn btn-primary btn-sm btn-fill" id="addOther">+</a> 
                                            <a href="#" class="btn btn-danger btn-sm btn-fill" id="remOther">x</a>
                                        </div>
                                       
                                    </div >
                                </div>
                                <?php } else { 
                                  $r=1;
                                  while($fetch_other = $getother->fetch_array()){ ?>
                                    <div id = "p_other">
                                    <div class="row">
                                        <div for="p_ot" class="col-lg-3 "><h5 class="pull-right">Other <?php echo $r; ?>: </h5></div>
                                        <div class="col-lg-3">
                                            <input type="file" name="other_file<?php echo $r; ?>" id="p_ot<?php echo $r; ?>" class="btn btn-sm btn-normal" style="width:100%">
                                            <?php if(!empty($fetch_other['other_file'])){
                                                $other = explode(".",$fetch_other['other_file']);
                                                $ext_other = $other[1]; 
                                                if($ext_other=='png' || $ext_other=='jpg' || $ext_other == 'jpeg' || $ext_other == 'PNG' || $ext_other == 'JPG' || $ext_other == 'JPEG'){  
                                            ?>
                                            <a type="button" name="view" class="viewothers" id="<?php echo $fetch_other['other_id']; ?>" data-personal="<?php echo $fetch_other['personal_id'];?>"><?php echo (empty($id) ? '' : $fetch_other['other_file']); ?></a> 
                                            <?php } else { ?>
                                            <a href='../uploads/<?php echo $fetch_other['other_file']; ?>' class='display' ><?php echo $fetch_other['other_file']; ?></a>
                                            <?php 
                                            } ?>
                                             <input type='hidden' name='other_ext<?php echo $r; ?>' id = 'other_ext<?php echo $r; ?>' value="<?php echo $ext_other; ?>">
                                        <?php } ?>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="name" name="other_name<?php echo $r; ?>" id="other_n<?php echo $r; ?>" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Other Document Name" value="<?php echo (empty($id) ? '' : $fetch_other['other_name']); ?>"> 
                                        </div>                                
                                        <div class="col-lg-3">
                                            <a href="#" class="btn btn-primary btn-sm btn-fill" id="addOther">+</a> 
                                            <a href="#" class="btn btn-danger btn-sm btn-fill" id="remOther">x</a>
                                        </div>
                                    </div>
                                    <div id='otherBox<?php echo $r; ?>' class='cert'></div>
                                </div>
                                <input type="hidden" name="other_id<?php echo $r; ?>" id="other_id<?php echo $r; ?>"  value=" <?php echo $fetch_other['other_id'];?>"> 

                                <?php
                                   $r++;
                                 }
                                ?>
                                    <div id = "p_other1"></div>
                                <?php } ?>

                                <input type = "hidden" value = "<?php echo $row_other; ?>" id = "counter2" name = "counter2">
                                <input type = "hidden" name = "id" id='id' value = "<?php echo $id; ?>">
                                <input type = "hidden" name = "counterX" id='counterX'>
                                <input type = "hidden" name = "counterX1" id='counterX1'>
                                <input type = "hidden" name = "counterX2" id='counterX2'>
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6">
                                        <center>
                                            <br>
                                            <input type="button" value="Upload Image" name="submit" onclick='showFileSize();' class=" btn btn-success btn-block">   
                                        </center>                                    
                                    </div>                             
                                    <div class="col-lg-3"></div>                             
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>



<?php 
include('../template/footer_uploads.php');  
?> 
<script src="../assets/vendors/bower_components/lightgallery/dist/js/lightgallery-all.min.js"></script>
<script type="text/javascript">
    $(document).on("click", "#modalbutton", function() {
        var id = $(this).attr("data-id");
        $("#id").val(id);
    });
</script> 
    