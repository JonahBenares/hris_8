<?php 
include('../template/header.php'); 
include('../includes/connection.php'); 
include('../template/navbar.php'); 
include('../includes/functions.php');

 $today=date("Y-m-d");
 if(isset($_GET['mo'])){ 
        $month = $_GET['mo'];
    }
    else{
        $month = '';
    }
?>  


<section class="content">
    <div class="content__inner">
        <header class="content__title">
            <h1>Salary Adjustment</h1>
            <small>Welcome to the New HRIS web app experience!</small>
        </header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method='GET' action='export-salary-adj.php'>
                            <table width="100%">
                                <tr>
                                    <td width="20%"></td>
                                    <td>Month of:</td>
                                    <td><input type="month" id="date_created"  name='date_created' class='form-control' required="" /></td>
                                    <td width="10%"></td>
                                    <td> per </td>
                                    <td>
                                        <select name='filter_by' class='form-control'>
                                            <option value=''>Select Filter</option>
                                            <option value='Department'>Department</option>
                                            <option value='Business Unit'>Business Unit</option>
                                            <option value='Location'>Location</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" class="btn btn-fill btn-info " value='Generate Report'>
                                    </td>
                                    <td width="20%"></td>
                                </tr>
                            </table>
                        </form>
                        <?php  if(isset($_GET['mo'])){ ?>
                        <table style="width: 100%" style = "border-collapse: collapse;">
                            <tr>
                                <td colspan="16">
                                    <label class="btn btn-lg btn-info btn-fill" readonly style="text-align: center;width:100%" value=""><strong>SALARY ADJUSTMENT SUMMARY</strong></label>
                                </td>  
                            </tr>
                            <?php $getMax= getMaxEval($con); 
                            ?>
                            <tr>
                                <td colspan="1" style = "font-weight:bold;"><center>Name of Employee</center> 
                                </td>
                                <td colspan="1" style = "font-weight:bold;"><center>Position</center> 
                                    <div id="errorBox" style = ></div>
                                </td>
                                <td colspan="1" style = "font-weight:bold;"><center>Date of Employment</center> 
                                    <div id="errorBox" style = ></div>
                                </td>
                                <td colspan="1" style = "font-weight:bold;"><center>Tenure</center> 
                                    <div id="errorBox" style = ></div>
                                </td>
                                <td colspan="1" style = "font-weight:bold;"><center>Status </center>
                                    <div id="errorBox" style = ></div>
                                </td>
                                <td colspan="1" style = "font-weight:bold;"><center>Date of Regularization</center>
                                    <div id="errorBox" style = ></div>
                                </td>
                                <td colspan="1" style = "font-weight:bold;"><center> Entry Salary </center> </td>
                                    <div id="errorBox" style = ></div>
                                </td>
                               <?php for($x=0;$x<$getMax;$x++){ ?>
                                <td colspan="1" style = "font-weight:bold;"><center>PE Result</center> 
                                    <div id="errorBox" style = ></div>
                                </td>
                                <td colspan="1" style = "font-weight:bold;"><center>Date of PE</center> 
                                    <div id="errorBox" style = ></div>
                                </td>
                                <td colspan="1" style = "font-weight:bold;"><center>Salary Adjustment </center>
                                    <div id="errorBox" style = ></div>
                                </td>
                                <td colspan="1" style = "font-weight:bold;"><center>Effective Date</center> 
                                    <div id="errorBox" style = ></div>
                                </td>
                                <?php } ?>
                            </tr>
                            <?php
                            
                             
                                $sql=mysqli_query($con,"SELECT personal_id, lname, fname, mname, name_ext, date_hired, emp_status FROM personal_data ORDER BY lname ASC");
                                while($row = mysqli_fetch_array($sql)){ 
                                $name = $row['lname'].', '.$row['fname'].', '.$row['mname'].', '.$row['name_ext'];
                                
                            ?>
                            <tr>
                                <td><?php echo $name;?></td>
                                <td><?php echo getPosition($con,$row['personal_id']);?></td>
                                <td><?php echo $row['date_hired'];?></td>
                                <td><?php echo getTenure($con,$row['personal_id'],$month); ?></td>
                                <td><?php echo $row['emp_status'];?></td>
                                <td><?php echo getDateReg($con,$row['personal_id']); ?></td>
                                <td><?php echo getEntrySal($con,$row['personal_id']); ?></td>
                                <?php for($x=0;$x<$getMax;$x++){ 
                                  
                                 
                                    $score = getEvalData($con,$row['personal_id'],'score');
                                    if(empty($score[$x])) $score ="";
                                    else $score=$score[$x];


                                    $eval_date = getEvalData($con,$row['personal_id'],'eval_date');
                                    if(empty($eval_date[$x])) $eval_date ="";
                                    else $eval_date=$eval_date[$x];

                                     $adjustment = getEvalData($con,$row['personal_id'],'adjustment');
                                    if(empty($adjustment[$x])) $adjustment ="";
                                    else $adjustment=$adjustment[$x];

                                      $effective_date = getEvalData($con,$row['personal_id'],'effective_date');
                                    if(empty($effective_date[$x])) $effective_date ="";
                                    else $effective_date=$effective_date[$x];


                                    ?>
                                    <td><?php echo $score; ?></td>
                                    <td><?php echo $eval_date; ?></td>
                                    <td><?php echo $adjustment; ?></td>
                                    <td><?php echo $effective_date; ?></td>
                                <?php 

                            } ?>
                              
                            </tr>
                            <?php } 
                            ?>
                        </table>
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
