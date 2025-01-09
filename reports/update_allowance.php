<?php 
    include('../template/header.php'); 
    include('../includes/connection.php'); 
    include('../template/navbar_other.php'); 
    include('../includes/functions.php');
    $today=date("Y-m-d");
    if(isset($_GET['id'])) $id = $_GET['id'];
    else $id ='';

    if(isset($_POST['update_allowance'])){
        foreach($_POST as $var=>$value)
            $$var = mysqli_real_escape_string($con,$value);

        $update = $con->query("UPDATE allowance SET amount = '$amount' WHERE allowance_id = '$id'");

        if($update){
            echo "<script>window.close();</script>";
        }
    }
?>
<style type="text/css">
    .header , .sidebar{
        display: none;
    }
    section.content.content--full{
        padding-top: 30px;
    }
    .frmSearch {border: 1px solid #a8d4b1;margin: 2px 0px;padding:40px;border-radius:4px;}
    #name-list{float:left;list-style:none;margin-top:-3px;padding:0;width:70%;position: absolute; z-index:100;width: 60%;}
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
        color: black;
    }
    /*#search-supervisor{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;
    }*/
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
<script type="text/javascript">
    function isNumberKey(txt, evt){
       var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 46) {
            //Check if the text already contains the . character
            if (txt.value.indexOf('.') === -1) {
                return true;
            } else {
                return false;
            }
        } else {
            if (charCode > 31
                 && (charCode < 48 || charCode > 57))
                return false;
        }
        return true;
    }
</script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<section class="content content--full" >
    <div class="content__inner">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="m-b-0">Update Allowance</h3>
                <br>
                <div class="card">
                    <div class="card-body">
                        <form method = "POST">
                            <table width="100%">
                                <?php 
                                    $sql = mysqli_query($con, "SELECT * FROM allowance WHERE allowance_id = '$id'");
                                    $row = mysqli_fetch_array($sql);
                                ?>
                                <tr>
                                    <td></td>
                                    <td>Amount:</td>
                                    <td>
                                        <input type = "number" name = "amount" onkeypress="return isNumberKey(this, event)" class = "form-control" placeholder="Amount" value = "<?php echo $row['amount']; ?>">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <br>
                                        <input class="btn btn-primary btn-block" type="submit" name="update_allowance" value='Submit'>                                
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
