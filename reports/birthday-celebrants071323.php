<?php 
include('../template/header.php'); 
include('../includes/connection.php'); 
include('../template/navbar.php'); 
include('../includes/functions.php');

 $today=date("Y-m-d");
?>  

<style type="text/css">
    .hala {
        font-size: 45px;
        background: #e9e3dd;
        background-image: url("img/aria1.png");
        background-repeat: no-repeat;
        background-size: 200% 200%;
        background-position: 100% 100%;
        -webkit-animation: square 1s linear infinite;
        -ms-animation: square 3s linear infinite;
        animation: square 3s linear infinite;
        -webkit-background-clip: text;
        color: transparent;
        margin-top:0px;
        margin-bottom:0px;       
    }
 
    .title-green{
        background-color:#4a6a4e; text-align:center; color: white;
    }
    .box{
        border: solid 1px;
        padding:5px;
       
    }
    .jan
    .container{
        margin: 20px!important;
        width: 100px!important   
    }
    .jan{
        background-color: #f66c83;
        color: white;
        text-shadow: 2px 2px 4px #656565;
        
    }
    .feb{
        background-color: #fe8371;
        color: white;
        text-shadow: 2px 2px 4px #656565; 
    }
    .mar{
        background-color: #feb849;
        color: white;
        text-shadow: 2px 2px 4px #656565; 
    }
    .apr{
        background-color: #35ba9b;
        color: white;
        text-shadow: 2px 2px 4px #656565; 
    }
    .may{
        background-color: #3aadd9;
        color: white;
        text-shadow: 2px 2px 4px #656565; 
    }
    .jun{
        background-color: #4a89d9;
        color: white;
        text-shadow: 2px 2px 4px #656565; 
    }
    .jul{
        background-color: #9479da;
        color: white;
        text-shadow: 2px 2px 4px #656565; 
    }
    .aug{
        background-color: #d46fab;
        color: white;
        text-shadow: 2px 2px 4px #656565; 
    }
    .sep{
        background-color: #e2b691;
        color: white;
        text-shadow: 2px 2px 4px #656565; 
    }
    .oct{
        background-color: #9ed36b;
        color: white;
        text-shadow: 2px 2px 4px #656565; 
    }
    .nov{
        background-color: #fb8372;
        color: white;
        text-shadow: 2px 2px 4px #656565; 
    }
    .dec{
        background-color: #f96c7f;
        color: white;
        text-shadow: 2px 2px 4px #656565; 
    }
    .shadow{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border: 0px;
    }
    .shadow:hover{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-width:5px;  
        /*border-style:dashed;*/
    }
    /*.btn-hover:hover{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }*/
    .hr{
        margin:20px 0 0 0;
        width: 100%;
        border-style: dashed ;
       /* border: 3px solid white;
       text-shadow: 2px 2px 4px #656565;*/
    }
    .well{
        padding: 20px;
        height: 100%;
    }
    h4{
        margin:0px;
    }
</style>
<section class="content">
    <div class="content__inner">
        <header class="content__title">
            <h1>Birthday Celebrants</h1>
            <small>Welcome to the New HRIS web app experience!</small>
        </header> 
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <center>
                        <?php $getDept=$con->query("SELECT * FROM department ORDER BY dept_name ASC"); ?>
                        <form method='POST'>
                            <table>
                                <tr>
                                <td><select name='filter_by' class='form-control btn-hover' required>
                                    <option value=''>Select Department</option>
                                    <?php while($fetchDept=$getDept->fetch_array()){ ?>
                                        <option value="<?php echo $fetchDept['dept_id']; ?>"><?php echo $fetchDept['dept_name']; ?></option>
                                    <?php } ?>
                                    </select>
                                </td>
                                <td><input type="submit" name='filter' class="btn btn-fill btn-secondary  " value='Submit'></td>
                                </tr>
                            </table><br>
                        </form>
                        </center>
                    </div>
                    <div class="card-body">
                        <?php if(isset($_POST['filter'])){
                            $where_clause = " AND current_dept = '$_POST[filter_by]'";

                            ?>
                            <div class='row'>
                            <div class='btn btn-fill btn-warning'>Department: <?php echo getInfo($con, 'dept_name', 'department', 'dept_id', $_POST['filter_by']); ?></div></div><a href="<?php $_SERVER['PHP_SELF']; ?>" style='color:red; font-style: italic'>Remove Filter</a><br><br><?php
                        } else {
                            $where_clause ="";
                        } ?>              
                        <div class="row">                 
                            <div class="col-lg-12">
                                <div class="row m-b-50">
                                    <div class="col-lg-4">
                                        <div class="well shadow jan">
                                            <h4 >JANUARY</h4>
                                            <hr class="hr">
                                            <?php 
                                            $get=$con->query("SELECT lname, fname, name_ext, bdate, day(bdate) as bday FROM personal_data WHERE MONTH(bdate) = '01' AND status = 'Active' $where_clause order by bday asc");
                                            
                                            while($fetch=$get->fetch_array()){
                                                $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                                                $bday = $fetch['bday'];

                                                echo sanitize(utf8_encode(ucfirst($fullname))) . " - " . $bday . "<br>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="well shadow feb ">
                                            <h4>FEBRUARY</h4>
                                            <hr class="hr">
                                              <?php 
                                            $get=$con->query("SELECT lname, fname, name_ext, bdate, day(bdate) as bday FROM personal_data WHERE MONTH(bdate) = '02' AND status = 'Active' $where_clause order by bday asc");
                                            while($fetch=$get->fetch_array()){
                                                $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                                                $bday = $fetch['bday'];

                                                echo sanitize(utf8_encode(ucfirst($fullname))) . " - " . $bday . "<br>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="well shadow mar">
                                            <h4>MARCH</h4>
                                            <hr class="hr">
                                              <?php 
                                            $get=$con->query("SELECT lname, fname, name_ext, bdate, day(bdate) as bday FROM personal_data WHERE MONTH(bdate) = '03' AND status = 'Active' $where_clause order by bday asc");
                                            while($fetch=$get->fetch_array()){
                                                $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                                                $bday = $fetch['bday'];

                                                echo sanitize(utf8_encode(ucfirst($fullname))) . " - " . $bday . "<br>";
                                            }
                                            ?>                                                    
                                        </div>
                                    </div>                                                    
                                </div>
                                <div class="row m-b-50">
                                    <div class="col-lg-4">
                                        <div class="well shadow apr" >
                                            <h4>APRIL</h4>
                                            <hr class="hr">
                                              <?php 
                                            $get=$con->query("SELECT lname, fname, name_ext, bdate, day(bdate) as bday FROM personal_data WHERE MONTH(bdate) = '04' AND status = 'Active' $where_clause order by bday asc");
                                            while($fetch=$get->fetch_array()){
                                                $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                                                $bday = $fetch['bday'];

                                                echo sanitize(utf8_encode(ucfirst($fullname))) . " - " . $bday . "<br>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="well shadow may">
                                            <h4> MAY</h4>
                                            <hr class="hr">
                                             <?php 
                                            $get=$con->query("SELECT lname, fname, name_ext, bdate, day(bdate) as bday FROM personal_data WHERE MONTH(bdate) = '05' AND status = 'Active' $where_clause order by bday asc");
                                            while($fetch=$get->fetch_array()){
                                                $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                                                $bday = $fetch['bday'];

                                                echo sanitize(utf8_encode(ucfirst($fullname))) . " - " . $bday . "<br>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="well shadow jun">
                                            <h4>JUNE</h4>
                                            <hr class="hr">
                                              <?php 
                                            $get=$con->query("SELECT lname, fname, name_ext, bdate, day(bdate) as bday FROM personal_data WHERE MONTH(bdate) = '06' AND status = 'Active' $where_clause order by bday asc");
                                            while($fetch=$get->fetch_array()){
                                                $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                                                $bday = $fetch['bday'];

                                                echo sanitize(utf8_encode(ucfirst($fullname))) . " - " . $bday . "<br>";
                                            }
                                            ?>
                                        </div>
                                    </div>                                                    
                                </div>
                                <div class="row m-b-50">
                                    <div class="col-lg-4">
                                        <div class="well shadow jul">
                                            <h4>JULY</h4>
                                            <hr class="hr">
                                              <?php 
                                            $get=$con->query("SELECT lname, fname, name_ext, bdate, day(bdate) as bday FROM personal_data WHERE MONTH(bdate) = '07' AND status = 'Active' $where_clause order by bday asc");
                                            while($fetch=$get->fetch_array()){
                                                $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                                                $bday = $fetch['bday'];

                                                echo sanitize(utf8_encode(ucfirst($fullname))) . " - " . $bday . "<br>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="well shadow aug">
                                            <h4>AUGUST</h4>
                                            <hr class="hr">
                                              <?php 
                                            $get=$con->query("SELECT lname, fname, name_ext, bdate, day(bdate) as bday FROM personal_data WHERE MONTH(bdate) = '08' AND status = 'Active' $where_clause order by bday asc");
                                            while($fetch=$get->fetch_array()){
                                                $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                                                $bday = $fetch['bday'];

                                                echo sanitize(utf8_encode(ucfirst($fullname))) . " - " . $bday . "<br>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="well shadow sep">
                                            <h4>SEPTEMBER</h4>
                                            <hr class="hr">
                                              <?php 
                                            $get=$con->query("SELECT lname, fname, name_ext, bdate, day(bdate) as bday FROM personal_data WHERE MONTH(bdate) = '09' AND status = 'Active' $where_clause order by bday asc");
                                            while($fetch=$get->fetch_array()){
                                                $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                                                $bday = $fetch['bday'];

                                                echo sanitize(utf8_encode(ucfirst($fullname))) . " - " . $bday . "<br>";
                                            }
                                            ?>
                                        </div>
                                    </div>                                                    
                                </div>
                                <div class="row m-b-50">
                                    <div class="col-lg-4">
                                        <div class="well shadow  oct">
                                            <h4>OCTOBER</h4>
                                            <hr class="hr">
                                              <?php 
                                            $get=$con->query("SELECT lname, fname, name_ext, bdate, day(bdate) as bday FROM personal_data WHERE MONTH(bdate) = '10' AND status = 'Active' $where_clause order by bday asc");
                                            while($fetch=$get->fetch_array()){
                                                $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                                                $bday = $fetch['bday'];

                                                echo sanitize(utf8_encode(ucfirst($fullname))) . " - " . $bday . "<br>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="well shadow nov">
                                            <h4>NOVEMBER</h4>
                                            <hr class="hr">
                                              <?php 
                                            $get=$con->query("SELECT lname, fname, name_ext, bdate, day(bdate) as bday FROM personal_data WHERE MONTH(bdate) = '11' AND status = 'Active' $where_clause order by bday asc");
                                            while($fetch=$get->fetch_array()){
                                                $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                                                $bday = $fetch['bday'];

                                                echo sanitize(utf8_encode(ucfirst($fullname))) . " - " . $bday . "<br>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="well shadow dec">
                                            <h4>DECEMBER</h4>
                                            <hr class="hr">
                                             <?php 
                                            $get=$con->query("SELECT lname, fname, name_ext, bdate, day(bdate) as bday FROM personal_data WHERE MONTH(bdate) = '12' AND status = 'Active' $where_clause order by bday asc");
                                            while($fetch=$get->fetch_array()){
                                                $fullname = sanitize(utf8_encode($fetch['fname'] . " " . $fetch['lname'] . " " . $fetch['name_ext']));
                                                $bday = $fetch['bday'];

                                                echo sanitize(utf8_encode(ucfirst($fullname))) . " - " . $bday . "<br>";
                                            }
                                            ?>
                                        </div>
                                    </div>                                                    
                                </div>
                            </div>
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