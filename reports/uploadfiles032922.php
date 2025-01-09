<?php 
include('../template/header.php'); 
include('../includes/connection.php'); 
include('../template/navbar.php'); 
include('../includes/functions.php');
$today=date("Y-m-d");
if(isset($_GET['id'])){
    $id = str_replace('"', '', $_GET['id']);
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
        sketch = document.getElementById('sketch');
        essay = document.getElementById('essay_file');
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

        if(ctr==1){
           cert = document.getElementById('p_cert1');
           filecert = cert.files[0];
           if(typeof filecert !== 'undefined'){
             if(filecert.size > 50000000){
              document.getElementById("certBox1").innerHTML="Error: Certificate file size is too big. Max file size is 50mb.";
              counter_error++;
              }
           }
        } else if(ctr>=2){
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

      
        if(ctr1 == 1){
           eval = document.getElementById('p_eval1');
            fileseval = eval.files[0];
            if(typeof fileseval !== 'undefined'){
              if(fileseval.size > 50000000){
                document.getElementById("evalBox1").innerHTML="Error: Evaluation file size is too big. Max file size is 50mb.";
                counter_error++;
              }
            }
        } else if(ctr1>=2){
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
        if(ctr2 == 1){
           other = document.getElementById('p_ot1');
            filesother = other.files[0];
            if(typeof filesother !== 'undefined'){
              if(filesother.size > 50000000){
                document.getElementById("otherBox1").innerHTML="Error: Evaluation file size is too big. Max file size is 50mb.";
                counter_error++;
              }
            }
        } 

        else if(ctr2>=2){
          for(z=1;z<=ctr2;z++){
            other = document.getElementById('p_ot'+z);
            filesother = other.files[0];
            if(typeof filesother !== 'undefined'){
             if(filesother.size > 50000000){
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

          if(ctr==1){
           cert = document.getElementById('p_cert1');
           certname1 = document.getElementById('name_cert1').value;
           frm.append('cert_file1', cert.files[0]);
           frm.append('cert_name1', certname1);
          } else if(ctr>=2){
            for(x=1;x<=ctr;x++){
              cert = document.getElementById('p_cert'+x);
              certname = document.getElementById('name_cert'+x).value;
              frm.append('cert_file'+x, cert.files[0]);
              frm.append('cert_name'+x, certname);
            }
          }

          if(ctr1==1){
           eval = document.getElementById('p_eval1');
           evalname1 = document.getElementById('p_name1').value;
           frm.append('eval_file1', eval.files[0]);
           frm.append('eval_period1', evalname1);
          } else if(ctr1>=2){
            for(x=1;x<=ctr1;x++){
              eval = document.getElementById('p_eval'+x);
              evalname = document.getElementById('p_name'+x).value;
              frm.append('eval_file'+x, eval.files[0]);
              frm.append('eval_period'+x, evalname);
            }
          }

          if(ctr2==1){ 
           other = document.getElementById('p_ot1');
           othername = document.getElementById('other_n1').value;
           frm.append('other_file1', other.files[0]);
           frm.append('other_name1', othername);
          } else if(ctr2>=2){
            for(z=1;z<=ctr2;z++){
              other = document.getElementById('p_ot'+z);
              other_name = document.getElementById('other_n'+z).value;
              frm.append('other_file'+z, other.files[0]);
              frm.append('other_name'+z, other_name);
            }
          }

             $.ajax({
              method: 'POST',
              url: "upload.php",
              data: frm,
              contentType: false,
              processData: false,
              cache: false,
               success: function(output){
                  alert('Files successfully saved!');
                  window.location = 'app_emp.php';
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
</script>
<script>
$(function() {
      var certificateDiv = $('#p_certificate');
      var mm = $('#p_certificate div').size() + 1;
      var cer = mm - 4;
      var ii = cer-1;

      
      $('#addCertificate').live('click', function() {
          $('<div class = "cert'+ii+'"><div class="row"><div for="p_certs" class="col-lg-3"></div><div class="col-lg-3"><input type="file" name="cert_file'+ii+'" id="p_cert'+ii+'" class="btn btn-sm btn-normal " style="width:100%" ><div id="certBox'+ii+'" class="cert"></div></div><div for = "name_certs" class="col-lg-3"><input type="name" name="cert_name'+ii+'" id="name_cert'+ii+'" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Name of Certificate"></div><div class="col-lg-3"><a href="#" class="btn btn-primary btn-sm btn-fill" id="addCertificate">+</a> || <a href="#" class="btn btn-danger btn-sm btn-fill" id="remCertificate">x</a></div></div></div>').appendTo(certificateDiv);
            ii++;
              var count = ii - 1;
              document.getElementById("counterX").value = count;
              /*$('<input type="text" id="counterX" name="counterX" value="'+ count +'" />').appendTo(certificateDiv);*/
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
          var evaluationDiv = $('#p_evaluation');
          var pp = $('#p_evaluation div').size() + 1;
          var eva = pp - 4;
          var oo = eva-1;
          
          $('#addEvaluation').live('click', function() {
              $('<div class = "evalu'+oo+'"><div class="row"><div for="p_eval" class="col-lg-3"></div><div class="col-lg-3"><input type="file" name="eval_file'+oo+'" id="p_eval'+oo+'" class="btn btn-sm btn-normal " style="width:100%" ><div id="evalBox'+oo+'" class="eval"></div></div><div for = "name_certs" class="col-lg-3"><input type="name" name="eval_period'+oo+'" id="p_name'+oo+'" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Evaluation Notes"></div><div class="col-lg-3"><a href="#" class="btn btn-primary btn-sm btn-fill" id="addEvaluation">+</a> || <a href="#" class="btn btn-danger btn-sm btn-fill" id="remEvaluation">x</a></div></div></div>').appendTo(evaluationDiv);
                oo++;
                  var count1 = oo-1;
                 /* $('<input type="text" id="counterX1" name="counterX1" value="'+ count1 +'" />').appendTo(evaluationDiv);*/
                 document.getElementById("counterX1").value = count1;
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
            var otherDiv = $('#p_other');
            var o = $('#p_other div').size() + 1;
            var oth = o - 4;
            var c = oth-1;
            
            $('#addOther').live('click', function() {
                $('<div class = "ou'+c+'"><div class="row"><div for="p_ot" class="col-lg-3"></div><div class="col-lg-3"><input type="file" name="other_file'+c+'" id="p_ot'+c+'" class="btn btn-sm btn-normal " style="width:100%" ><div id="otherBox'+c+'" class="ot"></div></div><div for = "other_name" class="col-lg-3"><input type="name" name="other_name'+c+'" id="other_n'+c+'" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Others"></div><div class="col-lg-3"><a href="#" class="btn btn-primary btn-sm btn-fill" id="addOther">+</a> || <a href="#" class="btn btn-danger btn-sm btn-fill" id="remOther">x</a></div></div></div>').appendTo(otherDiv);
                  c++;
                    var count2 = c-1;
                   /* $('<input type="text" id="counterX1" name="counterX1" value="'+ count1 +'" />').appendTo(evaluationDiv);*/
                   document.getElementById("counterX2").value = count2;
                    return false;
            });

            $('#remOther').live('click', function() { 
                if( c >= 2 ) {
                  c--;
                        $("div").remove(".ou" + c);
                } 
                return false;
            });
        });

    function skipUpload(){
        alert('Information has been saved successfully!');
        window.location = 'app_emp.php';
    }
</script>
<style type="text/css">
    .pull-right{
        float: right;
    }
</style>
<section class="content">
    <div class="content__inner">
        <div class="card" >
          <div class="card-header">
                <h5 class="m-b-0">UPLOAD FILES</h5>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST">
                    <div style="margin-top:10px"> 
                        <div class="col-lg-12"></div>
                        <div>
                        <div class="row">
                            <div for="resume" class="col-lg-3 "><h5 class="pull-right">Resume:</h5></div>
                            <div class="col-lg-6">
                                <input type="file" name="resume_file" id="resume_file" class="btn btn-sm btn-normal" style="width:100%">
                                <div id='resumeBox'></div>
                            </div>                                
                            <div class="col-lg-3"></div>
                        </div>
                        
                        <div class="row">
                            <div for="sketch" class="col-lg-3 "><h5 class="pull-right">Map Sketch:</h5></div>
                            <div class="col-lg-6">
                                <input type="file" name="map_file" id="sketch" class="btn btn-sm btn-normal " style="width:100%">
                                <div id='mapBox'></div>
                            </div>                                    
                            <div class="col-lg-3"></div>
                        </div>   
                         <div class="row">
                            <div for="essay" class="col-lg-3 "><h5 class="pull-right">Essay File:</h5></div>
                            <div class="col-lg-6">
                                <input type="file" name="essay_file" id="essay_file" class="btn btn-sm btn-normal " style="width:100%">
                                <div id='essayBox'></div>
                            </div>                                    
                            <div class="col-lg-3"></div>
                        </div>   
                         <div class="row">
                            <div for="photo" class="col-lg-3 "><h5 class="pull-right">Photo Upload:</h5></div>
                            <div class="col-lg-6">
                                <input type="file" name="photo_upload" id="photo_upload" class="btn btn-sm btn-normal " style="width:100%">
                                <div id='photoBox'></div>
                            </div>                                    
                            <div class="col-lg-3"></div>
                        </div>
                         
                        </div>                     
                        <div id = "p_certificate">
                            <div class="row" >
                                <div for="p_cert" class="col-lg-3 "><h5 class="pull-right">Certificate:</h5></div>
                                <div class="col-lg-3">
                                    <input type="file" name="cert_file1" id="p_cert1" class="btn btn-sm btn-normal " style="width:100%" >
                                     <div id='certBox1' class='cert'></div>
                                </div>
                                <div class="col-lg-3">
                                    <input type="name" name="cert_name1" id="name_cert1" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Name of Certificate" > 
                                    <input type = "hidden" value = "1" id = "counter" name = "counter">
                                </div>                                
                                <div class="col-lg-3">
                                    <a href="#" class="btn btn-primary btn-sm btn-fill" id="addCertificate">+</a> || 
                                    <a href="#" class="btn btn-danger btn-sm btn-fill" id="remCertificate">x</a>
                                </div>
                            </div >
                        </div>
                        <div id = "p_evaluation">
                            <div class="row" >
                                <div for="p_evals" class="col-lg-3 "><h5 class="pull-right">Evaluation:</h5></div>
                                <div class="col-lg-3">
                                    <input type="file" name="eval_file1" id="p_eval1" class="btn btn-sm btn-normal " style="width:100%" >
                                     <div id='evalBox1' class='eval'></div>
                                </div>
                                <div class="col-lg-3">
                                    <!-- <input type="name" name="eval_period1" id="p_name1" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Name of Evaluation" > -->
                                    <input type="name" name="eval_period1" id="p_name1" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Evaluation Notes" > 
                                    <input type = "hidden" value = "1" id = "counter1" name = "counter1">
                                </div>                                
                                <div class="col-lg-3">
                                    <a href="#" class="btn btn-primary btn-sm btn-fill" id="addEvaluation">+</a> || 
                                    <a href="#" class="btn btn-danger btn-sm btn-fill" id="remEvaluation">x</a>
                                </div>
                            </div>
                        </div>
                        <div id = "p_other">
                            <div class="row" >
                                <div for="p_ot" class="col-lg-3 "><h5 class="pull-right">Others:</h5></div>
                                <div class="col-lg-3">
                                    <input type="file" name="other_file1" id="p_ot1" class="btn btn-sm btn-normal " style="width:100%" >
                                     <div id='otherBox1' class='ot'></div>
                                </div>
                                <div class="col-lg-3">
                                    <input type="name" name="other_name1" id="other_n1" class="form-control" style="width:100%;height:35px;margin-bottom:5px;" placeholder="Others" > 
                                    <input type = "hidden" value = "1" id = "counter2" name = "counter2">
                                </div>                                
                                <div class="col-lg-3">
                                    <a href="#" class="btn btn-primary btn-sm btn-fill" id="addOther">+</a> || 
                                    <a href="#" class="btn btn-danger btn-sm btn-fill" id="remOther">x</a>
                                </div>
                            </div >
                        </div>
                        <input type = "hidden" name = "id" id='id' value = "<?php echo $id; ?>">
                         <input type = "hidden" name = "counterX" id='counterX'>
                        <input type = "hidden" name = "counterX1" id='counterX1'>
                        <input type = "hidden" name = "counterX2" id='counterX2'>
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                              <br>
                                <center>
                                    <a onclick= "skipUpload();" value="Skip Upload" name="skip" class=" btn btn-warning btn-fill">Skip Upload</a>
                                    <input type="button" value="Upload Image" name="submit" onclick='showFileSize();' class=" btn btn-success btn-fill">   
                                </center>                                    
                            </div>                             
                            <div class="col-lg-3"></div>                             
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php 
include('../template/footer_uploads.php'); 
?> 