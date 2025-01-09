<?php 
    include('../template/header.php'); 
    include('../includes/connection.php'); 
    include('../template/navbar_other.php'); 
    include('../includes/functions.php');
    $today=date("Y-m-d");
    if(isset($_GET['id'])) $id = $_GET['id'];
    else $id ='';

    if(isset($_POST['save_eval'])){
        foreach($_POST as $var=>$value)
            $$var = mysqli_real_escape_string($con,$value);
        $eval_date =  $eval_year . "-".$eval_month;
        $insert= $con->query("INSERT INTO evaluation_history_tmp (personal_id, eval_date, score, eval_type, adjustment, per_day, effective_date) VALUES ('$id', '$eval_date', '$eval_score', '$eval_type', '$adjustment', '$perday', '$effective_date')"); 
        if($insert){
            echo "<script>window.close();</script>";
        }
    }
?>
<style type="text/css">
    body{
        overflow: hidden;
    }
    .header , .sidebar{
        display: none;
    }
    section.content.content--full{
        padding-top: 30px;
    }
    .frmSearch {border: 1px solid #a8d4b1;margin: 2px 0px;padding:40px;border-radius:4px;}
    #name-list{float:left;list-style:none;margin-top:-3px;padding:0;width:70%;position: absolute; z-index:100;width: 77%;}
    #name-list li:hover {
        background: #28422c;
        cursor: pointer;
        font-weight: bold;
        color: white;
    }
    #name-list li {
        padding: 10px;
        background-color: #b5e8bb;
        border-bottom: #bbb9b9 1px solid;
        border-radius: 10px;
    }
    #search-supervisor{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;
    }
    .add{
        width: 100%;
    }
    .width{
        width:100%;
        box-shadow: 0 1px 10px rgba(0, 0, 0, 0.45), 0 0 0 1px rgba(115, 115, 115, 0.1)!important;
    }
     .card{
        box-shadow: 0 1px 10px rgba(0, 0, 0, 0.45), 0 0 0 1px rgba(115, 115, 115, 0.1)!important;
        min-height: 560px;
        max-height: 5000px;
        margin-bottom: 0px
    }
    .content{
    
    }
    .head{
        background-color:#4a6a4e;
        color:white;
        height: 50px;
        padding: 10px;
    }
</style>
<script>
    $(document).ready(function(){
        $("#search-supervisor").keyup(function(){
        // alert($(this).val());
            $.ajax({
                type: "POST",
                url: "search_supervisor.php",
                data:'keyword='+$(this).val(),
                beforeSend: function(){
                  $("#search-supervisor").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function(data){
                  $("#suggestion-supervisor").show();
                  $("#suggestion-supervisor").html(data);
                  $("#search-supervisor").css("background","#FFF");
                }
            });
        });
    });
     function selectSupervisor(val) {
        $("#search-supervisor").val(val);
        $("#suggestion-supervisor").hide();
    }
    function isNumberKey(evt, obj) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        var value = obj.value;
        var dotcontains = value.indexOf(".") != -1;
        if (dotcontains)
            if (charCode == 46) return false;
        if (charCode == 46) return true;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }    
</script>

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<section class="content content--full" >
    <div class="content__inner">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="m-b-0">Add Evaluation</h3>
                <br>
                <div class="card" >
                    <div class="card-body" style="height: 400px">
                        <form method = "POST">
                            <table width="100%">
                                <tr>
                                    <td width="5%"></td>
                                    <td width="25%"></td>
                                    <td width="55%"></td>
                                    <td width="5%"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Evaluation Date:</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <select name='eval_month' class="form-control" >
                                                    <option value=''>-Select Month-</option>
                                                    <option value='01'>January</option>
                                                    <option value='02'>Febuary</option>
                                                    <option value='03'>March</option>
                                                    <option value='04'>April</option>
                                                    <option value='05'>May</option>
                                                    <option value='06'>June</option>
                                                    <option value='07'>July</option>
                                                    <option value='08'>August</option>
                                                    <option value='09'>September</option>
                                                    <option value='10'>October</option>
                                                    <option value='11'>November</option>
                                                    <option value='12'>December</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <select name='eval_year' class="form-control" >
                                                    <option value=''>-Select Year-</option>
                                                    <?php 
                                                    $curr_year =date('Y');
                                                    for($x=2013; $x<=$curr_year; $x++) { ?>
                                                    <option value='<?php echo $x; ?>'><?php echo $x; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Score:</td>
                                    <td>
                                        <input type = "text" onkeypress="return isNumberKey(event,this)" name = "eval_score" id="eval_score" class = "form-control" placeholder="Score">
                                    </td>  
                                    <td></td>                       
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Evaluation Type:</td>
                                    <td><input type = "text" name = "eval_type" id="eval_type" class = "form-control" placeholder="Evaluation Type"></td>
                                    <td></td>                       
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Adjustment:</td>
                                    <td>
                                        <input type = "text" onkeypress="return isNumberKey(event,this)" name = "adjustment" id="adjustment" class = "form-control" placeholder="Salary Adjustment">
                                    </td> 
                                    <td></td>                          
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Per Day:</td>
                                    <td>
                                        <input type = "text" name = "perday" id="perday" class = "form-control" placeholder="Salary Adjustment">
                                    </td>   
                                    <td></td>                        
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Effective Date:</td>
                                    <td>
                                        <input type = "date" name = "effective_date" id="effective_date" class = "form-control">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <br>
                                        <input class="btn btn-lg btn-primary btn-block" type="submit" name="save_eval" value='Submit'>
                                    </td>
                                </tr>
                            </table>
                            <input type='hidden' name='id' value='<?php echo $id; ?>'>
                        </form>                      
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>
<?php 
include('../template/footer.php'); 
?> 
