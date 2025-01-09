<?php 
    include('../template/header.php'); 
    include('../includes/connection.php'); 
    include('../template/navbar.php'); 
    include('../includes/functions.php');
    $today=date("Y-m-d");
    if(isset($_GET['id'])){
      $id = $_GET['id'];
    }
    else{
      $id = $_GET['id'];
    }
?>
<style type="text/css">
    .form-conemp{
        border:2px solid #fff9;
        border-top:0px;
        border-left:0px;
        border-right:0px;
    }
    .form-100{width: 100%}
    .form-70{width: 70%}
    .form-50{width: 50%}
    input, select{
        font-size: 13px!important;
        font-weight: 900px!important;
    }
    input, select{
        font-weight: 600
    }
</style>
<script src="../assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    function updateEmp(){
        var data = $("#update-employee").serialize();
        var id=document.getElementById('id').value;
        $.ajax({
            data: data,
            type: "post",
            url: "../reports/update_employee.php",
            success: function(output){
                //alert(output);
                document.location = "../reports/form.php?id="+id;              
            }
        });
    }
</script>
<script type="text/javascript">
    var ii = 1;
    $("body").on("click", ".addSibling", function() {
        ii++;
        var $appendsib = $(this).parents('.appendsib');
        var nextSib = $appendsib.clone().find("input").val("").end();
        nextSib.attr('id', 'appendsib' + ii);
        var sibRmBtn = $('.remSiblings', nextSib).length > 0;
        if (!sibRmBtn) {
            var rm = "<a class='btn-danger btn-sm btn-fill remSiblings'>x</a>"
            $('.addmoreappend', nextSib).append(rm);
        }
        $appendsib.after(nextSib); 

    });

    $("body").on("click", ".remSiblings", function() {
        $(this).parents('.appendsib').remove();
    });

    var oo = 1;
    $("body").on("click", ".addChildren", function() {
        oo++;
        var $appendchild = $(this).parents('.appendchild');
        var nextChild = $appendchild.clone().find("input").val("").end();
        nextChild.attr('id', 'appendchild' + oo);
        var chiRmBtn = $('.remChildren', nextChild).length > 0;
        if (!chiRmBtn) {
            var rm = "<a class='btn-danger btn-sm btn-fill remChildren'>x</a>"
            $('.addmoreappendchild', nextChild).append(rm);
        }
        $appendchild.after(nextChild); 

    });

    $("body").on("click", ".remChildren", function() {
        $(this).parents('.appendchild').remove();
    });

    var uu = 1;
    $("body").on("click", ".addScnt", function() {
        uu++;
        var $appendemploy = $(this).parents('.appendemploy');
        var nextEmploy = $appendemploy.clone().find("input").val("").end();
        nextEmploy.attr('id', 'appendemploy' + uu);
        var empRmBtn = $('.remScnt', nextEmploy).length > 0;
        if (!empRmBtn) {
            var rm = "<a class='btn-danger btn-sm btn-fill remScnt'>x</a>"
            $('.addmoreappendemploy', nextEmploy).append(rm);
        }
        $appendemploy.after(nextEmploy); 

    });

    $("body").on("click", ".remScnt", function() {
        $(this).parents('.appendemploy').remove();
    });

    var pp = 1;
    $("body").on("click", ".addChar", function() {
        pp++;
        var $appendchar = $(this).parents('.appendchar');
        var nextChar = $appendchar.clone().find("input").val("").end();
        nextChar.attr('id', 'appendchar' + pp);
        var chrRmBtn = $('.remChar', nextChar).length > 0;
        if (!chrRmBtn) {
            var rm = "<a class='btn-danger btn-sm btn-fill remChar'>x</a>"
            $('.addmoreappendchar', nextChar).append(rm);
        }
        $appendchar.after(nextChar); 

    });

    $("body").on("click", ".remChar", function() {
        $(this).parents('.appendchar').remove();
    });

    var ss = 1;
    $("body").on("click", ".addTrain", function() {
        ss++;
        var $appendtraining = $(this).parents('.appendtraining');
        var nextTraining = $appendtraining.clone().find("input").val("").end();
        nextTraining.attr('id', 'appendtraining' + ss);
        var trainRmBtn = $('.remTrain', nextTraining).length > 0;
        if (!trainRmBtn) {
            var rm = "<a class='btn-danger btn-sm btn-fill remTrain'>x</a>"
            $('.addmoreappendtraining', nextTraining).append(rm);
        }
        $appendtraining.after(nextTraining); 

    });

    $("body").on("click", ".remTrain", function() {
        $(this).parents('.appendtraining').remove();
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#college").keyup(function(){
        $.ajax({
        type: "POST",
        url: "search-school.php",
        data:'college='+$(this).val(),
        beforeSend: function(){
          $("#college").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
          $("#suggestion-college").show();
          $("#suggestion-college").html(data);
          $("#college").css("background","#FFF");
        }
        });
      });
  

    $("#highschool").keyup(function(){
        $.ajax({
        type: "POST",
        url: "search-school.php",
        data:'highschool='+$(this).val(),
        beforeSend: function(){
          $("#highschool").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
          $("#suggestion-highschool").show();
          $("#suggestion-highschool").html(data);
          $("#highschool").css("background","#FFF");
        }
        });
      });

    $("#elementary").keyup(function(){
        $.ajax({
        type: "POST",
        url: "search-school.php",
        data:'elementary='+$(this).val(),
        beforeSend: function(){
          $("#elementary").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
          $("#suggestion-elementary").show();
          $("#suggestion-elementary").html(data);
          $("#elementary").css("background","#FFF");
        }
        });
      });
    

    $("#postgrad").keyup(function(){
        $.ajax({
        type: "POST",
        url: "search-school.php",
        data:'postgrad='+$(this).val(),
        beforeSend: function(){
          $("#postgrad").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
          $("#suggestion-postgrad").show();
          $("#suggestion-postgrad").html(data);
          $("#postgrad").css("background","#FFF");
        }
        });
      });
    });

    function selectCollege(val) {
        $("#college").val(val);
        $("#suggestion-college").hide();
    }

    function selectHS(val) {
        $("#highschool").val(val);
        $("#suggestion-highschool").hide();
    }

     function selectElem(val) {
        $("#elementary").val(val);
        $("#suggestion-elementary").hide();
    }

    function selectPostgrad(val) {
        $("#postgrad").val(val);
        $("#suggestion-postgrad").hide();
    }
   
</script>
<script>
 function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
    return true;
}
</script>   
<section class="content">
    <div class="content__inner">
        <header class="content__title m-b-5 p-t-0" style="display:flex">
            <a onclick="goBack()" class="actions__item" title="Back" data-toggle="tooltip" data-placement="bottom">
                <b>
                    <span class="zmdi zmdi-caret-left-circle"></span>
                </b>
            </a>
            <h5 class="m-b-0 m-t-10 m-l-10 ">Update Employee</h5>           
        </header>
        <div class="card" >
            <div class="card-body">
                <form id ="update-employee" name = "updateemployee" method='POST'>
                    <?php 
                        include'../includes/connection.php';
                        $query = mysqli_query($con, "SELECT * FROM personal_data pd LEFT JOIN family_background fb ON fb.personal_id = pd.personal_id LEFT JOIN educational_background eb ON eb.personal_id = pd.personal_id LEFT JOIN additional_info ai ON ai.personal_id = pd.personal_id LEFT JOIN person_to_contact pc ON pc.personal_id = pd.personal_id LEFT JOIN position ps ON ps.personal_id = pd.personal_id WHERE pd.personal_id = '$id'")or die(mysqli_error($con));
                        $row = mysqli_fetch_array($query);
                    ?>
                    <table width="100%">
                        <tr>
                            <td colspan="5">
                                <br>
                                <h3 style="text-align: center"><strong>CENTRAL NEGROS POWER RELIABILITY, INC.,</strong></h3>
                                <h4 style = "text-align:center;margin-top:0px;"><strong>APPLICATION FOR EMPLOYMENT</strong></h4>
                                <br>
                                <br>
                                <div id="errorBox5" style = "margin-left:15px;margin-top:-17px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">POSITION APPLIED FOR:</td>
                            <td width="30%">
                                <input id="posapp" type="text" name="position_applied" value="<?php echo $row['position_applied']?>" class="form-conemp form-100">
                            </td>
                            <td width="5%"></td>
                            <td width="15%">DATE APPLIED:</td>
                            <td width="30%">
                                <input id="dtapp" value = "<?php echo $row['date_applied']?>" type="date" name="date_applied"  class="form-conemp form-100">
                            </td>
                        </tr>
                        <tr>
                            <td>EXPECTED SALARY:</td>
                            <td>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <input id="exsal" onkeypress="return isNumberKey(event)" value = "<?php echo $row['sal_from'];?>" type="text" name="sal_from"  class="form-conemp form-50" placeholder="From" >               
                                        <input id="salto" onkeypress="return isNumberKey(event)" value = "<?php echo $row['sal_to'];?>" type="text" name="sal_to"  class="form-conemp form-50" placeholder="To">
                                    </div>
                                </div>
                            </td>
                            <td></td>
                            <td>DATE AVAILABLE:</td>
                            <td>
                                <input id="dtapp" value = "<?php echo $row['date_available']?>" type="date" name="date_available"  class="form-conemp form-100">
                            </td>
                        </tr>
                        <tr>
                            <td>COMPANY:</td>
                            <td>
                                <select id="company" name="company" class="form-conemp form-100">
                                    <option value = ''>--SELECT COMPANY--</option> 
                                    <?php 
                                        $sqls = mysqli_query($con,"SELECT * FROM business_unit ORDER BY bu_name ASC");
                                        while($rows=mysqli_fetch_array($sqls)){
                                    ?>
                                    <option value="<?php echo $rows['bu_id']; ?>" <?php echo ($row['applied_company'] == $rows['bu_id']) ? 'selected' : '' ;?>><?php echo $rows['bu_name']; ?></option>
                                    <?php } ?>                                   
                                </select>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                    </table>

                    <table width="100%">
                        <tr>
                            <td colspan="7">
                                <hr>
                                <b>PERSONAL DATA:</b>
                                <div id="errorBox" style = "margin-left:115px;margin-top:-17px;"></div>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td width="21%">
                                <input  value = "<?php echo $row['lname']; ?>" type="text" id="lname" name="lname" class="form-conemp form-100">
                            </td>
                            <td width="21%">
                                <input value = "<?php echo $row['fname']?>" type="text" id="fname" name="fname" class="form-conemp form-100">
                            </td>
                            <td width="20%">
                                <input value = "<?php echo $row['mname']?>" type="text" id="mname" name="mname" class="form-conemp form-100">
                            </td>
                            <td width="10%">
                                <input value = "<?php echo $row['name_ext']?>" type="text" id="name_ext" name="name_ext"  class="form-conemp form-100">
                            </td>
                            <td width="5%">
                                <input type="text" value = "<?php echo $row['age']?>" onkeypress="return isNumberKey(event)" class="form-conemp form-100" maxlength="3" id="age" name="age" disabled="disabled" style="color:#fff;text-align: center;">
                            </td>
                            <td width="10%">
                                <select id="sex" name="sex" class="form-conemp form-100">
                                    <option value = "Male" <?php echo (($row['sex'] == 'Male') ? ' selected' : ''); ?>>Male</option>
                                    <option value = "Female" <?php echo (($row['sex'] == 'Female') ? ' selected' : ''); ?>>Female</option>
                                </select>
                            </td>
                            <td  width="13%">
                                <select id="civil_status" name ="civil_status" class="form-conemp form-100">
                                    <option value = "Single" <?php echo (($row['civil_status'] == 'Single') ? ' selected' : ''); ?>>Single</option>
                                    <option value = "Married" <?php echo (($row['civil_status'] == 'Married') ? ' selected' : ''); ?>>Married</option>
                                    <option value = "Widow/Widower" <?php echo (($row['civil_status'] == 'Widow/Widower') ? ' selected' : ''); ?>>Widow/Widower</option>
                                    <option value = "Annulled" <?php echo (($row['civil_status'] == 'Annulled') ? ' selected' : ''); ?>>Annulled</option>
                                    <option value = "Divorced" <?php echo (($row['civil_status'] == 'Divorced') ? ' selected' : ''); ?>>Divorced</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>LASTNAME</td>
                            <td>FIRSTNAME</td>
                            <td>MIDDLENAME</td>
                            <td>NAME EXT.</td>
                            <td>AGE</td>
                            <td>SEX</td>
                            <td>CIVIL STATUS</td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                    require_once('../includes/connection.php');
                                    $province_result = $con->query('select * from provinces order by name');
                                    $cities_result = $con->query('select * from cities order by name');
                                ?>
                                <select name="pre_prov" id="province-list" class="form-conemp form-100 m-t-10">
                                    <option value="">Select Province</option>
                                    <?php
                                        if ($province_result->num_rows > 0) {
                                            while($row1 = $province_result->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row1["id"]; ?>" <?php echo (($row1['id'] == $row['pre_prov']) ? ' selected' : ''); ?>><?php echo $row1["name"]; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td> 
                            <td>
                                <select name="pre_city" id="city-list" class="form-conemp form-100 m-t-10">
                                    <option value=''>Select City</option>
                                    <?php
                                        if ($cities_result->num_rows > 0) {
                                            while($rows = $cities_result->fetch_assoc()) {
                                    ?>
                                    <option value='<?php echo $rows['id']; ?>' <?php echo (($rows['id'] == $row['pre_city']) ? ' selected' : ''); ?>><?php echo $rows['name']; ?></option>
                                    <?php } } ?>
                                </select>
                            </td>
                            <td colspan="5">
                                <input type="text" value = "<?php echo $row['permanent_address']?>" id="permanent_address" name="permanent_address" placeholder="PRESENT ADDRESS" class="form-conemp form-100 m-t-10">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                    require_once('../includes/connection.php');
                                    $provincial_result = $con->query('select * from provinces order by name');
                                    $city_result = $con->query('select * from cities order by name');
                                ?>
                                <select name="perm_prov" id="provincial-list" class="form-100 form-conemp">
                                    <option value="">Select Province</option>
                                    <?php
                                        if ($provincial_result->num_rows > 0) {
                                        while($row2 = $provincial_result->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row2["id"];?>" <?php echo (($row2['id'] == $row['perm_prov']) ? ' selected' : ''); ?>><?php echo $row2["name"]; ?></option>
                                    <?php
                                      }
                                    }
                                    ?>
                                </select>
                            </td> 
                            <td>
                                <select name="perm_city" id="cityh-list" class="form-100 form-conemp">
                                    <option value=''>Select City</option>
                                    <?php
                                        if ($city_result->num_rows > 0) {
                                        // output data of each row
                                        while($rows1 = $city_result->fetch_assoc()) {
                                    ?>
                                    <option value='<?php echo $rows1['id']; ?>' <?php echo (($rows1['id'] == $row['perm_city']) ? ' selected' : ''); ?>><?php echo $rows1['name']; ?></option>
                                    <?php } } ?>
                                </select>
                            </td>
                            <td colspan="5">
                                <input type = "text" value = "<?php echo $row['provincial_address']?>" id = "provincial_address" name = "provincial_address"  class="form-100 form-conemp" placeholder="PERMANENT/HOME ADDRESS">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input value = "<?php echo $row['bdate']?>" type = "date" name = "bdate" id = "bdate"  class="form-100 form-conemp m-t-10">
                                <br>DATE OF BIRTH
                            </td> 
                            <td>
                                <input value = "<?php echo $row['place_birth']?>" type = "text" id = "place_birth" name = "place_birth" class="form-100 form-conemp m-t-10">
                                <br>PLACE OF BIRTH
                            </td> 
                            <td>
                                <input value = "<?php echo $row['contact_no']?>" type = "text" id = "contact_no" maxlength = "11" name = "contact_no"  class="form-100 form-conemp m-t-10">
                                <br>CONTACT NUMBER
                            </td> 
                            <td colspan="2">
                                <input value = "<?php echo $row['nationality']?>" type = "text" name = "nationality" id = "nationality"  class="form-100 form-conemp m-t-10">
                                <br>NATIONALITY
                            </td> 
                            <td colspan="2">
                                <input value = "<?php echo $row['religion']?>" type = "text" name = "religion" id = "religion"  class="form-100 form-conemp m-t-10">
                                <br>RELIGION
                            </td> 
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                        </tr>
                        <tr>
                            <td colspan="20">
                                <br>
                                <hr>
                                <b>FAMILY BACKGROUND</b>
                                <div id="errorBox1" style = "margin-left:150px;margin-top:-13px;"></div>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <input value = "<?php echo $row['father_name']?>" type = "text" id = "father_name" name = "father_name"  class="form-100 form-conemp m-t-10">
                                <br>FATHER'S NAME
                            </td>
                            <td>
                                <input value = "<?php echo $row['fa_bday']?>" type="date" id="fa_bday" name="fa_bday" class="form-100 form-conemp m-t-10">
                                <br>BIRTHDATE
                            </td> 
                            <td colspan="4">
                                <input value = "<?php echo $row['occupation']?>" type="text" id="occupation" name="occupation" class="form-100 form-conemp m-t-10">
                                <br>OCCUPATION
                            </td> 
                            <td colspan="5">
                                <input value = "<?php echo $row['mother_name']?>" type = "text" id="mother_name" name="mother_name" class="form-100 form-conemp m-t-10">
                                <br>MOTHER'S NAME
                            </td> 
                            <td>
                                <input value = "<?php echo $row['m_bday']?>" type = "date" id="m_bday" name="m_bday"  class="form-100 form-conemp m-t-10">
                                <br>BIRTHDATE
                            </td> 
                            <td colspan="4">
                                <input value = "<?php echo $row['m_occupation']?>" type = "text" id="m_occupation" name="m_occupation" class="form-100 form-conemp m-t-10">
                                <br>OCCUPATION
                            </td> 
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                        </tr>
                        <tr>
                            <td colspan="20">
                                <div class="m-t-15"></div>
                                NAME OF SIBLING/S(With Age & Occupation)
                            </td>
                        </tr>
                        <?php 
                            $a=1;
                            $selectsibs=$con->query("SELECT * FROM siblings WHERE personal_id = '$id'");
                            $rows=$selectsibs->num_rows;
                            if($rows>0){
                            while($fetchsibs = $selectsibs->fetch_array()){ ?>
                            <tr id ="appendsib0" class="appendsib">
                                <td colspan="6">
                                    <input type="text" id="p_sib"  class="form-100 form-conemp " name="siblings_name[]" value="<?php echo $fetchsibs['siblings_name']; ?>" placeholder="Name"/>
                                </td>
                                <td colspan="1">
                                    <input type="date" id="bday" class="form-100 form-conemp " name="siblings_bday[]" value="<?php echo $fetchsibs['siblings_bday']; ?>" placeholder = "Birthdate"/>
                                </td>
                                <td colspan="5">
                                    <input type="text" id="occupation" class="form-100 form-conemp " name="siblings_occupation[]" value="<?php echo $fetchsibs['siblings_occupation']; ?>" placeholder = "Occupation"/>
                                </td>
                                <td colspan="6">
                                    <input type="text" id="emp_na_add" class="form-100 form-conemp " name="emp_na_add[]" value="<?php echo $fetchsibs['emp_na_add']; ?>" placeholder = "Name and Address of Employer"/>
                                </td>
                                <td colspan="2" align="center" class="addmoreappend">
                                    <a class="btn-primary btn-sm addSibling" id="addSibling"><span class="zmdi zmdi-plus"></span></a>
                                    <input type='hidden' name='siblings_id[]' value="<?php echo $fetchsibs['siblings_id']; ?>">
                                </td>
                            </tr>
                            <?php $a++; } } else { ?>
                            <tr id ="appendsib0" class="appendsib">
                                <td colspan="6">
                                    <input type="text" id="p_sib"  class="form-100 form-conemp " name="siblings_name[]" placeholder="Name"/>
                                </td>
                                <td colspan="1">
                                    <input type="date" id="bday" class="form-100 form-conemp " name="siblings_bday[]" placeholder = "Birthdate"/>
                                </td>
                                <td colspan="5">
                                    <input type="text" id="occupation" class="form-100 form-conemp " name="siblings_occupation[]" placeholder = "Occupation"/>
                                </td>
                                <td colspan="6">
                                    <input type="text" id="emp_na_add" class="form-100 form-conemp " name="emp_na_add[]" placeholder = "Name and Address of Employer"/>
                                </td>
                                <td colspan="2" align="center" class="addmoreappend">
                                    <a class="btn-primary btn-sm addSibling" id="addSibling"><span class="zmdi zmdi-plus"></span></a>
                                </td>
                                <input type='hidden' name='siblings_id[]' value="0">
                            </tr>
                            <?php } ?>
                    </table>
                    <table width="100%">
                        <tr>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <input value = "<?php echo $row['name_spouse']?>" type="text" id="name_spouse" name="name_spouse"  class="form-100 form-conemp m-t-15"><br>NAME OF SPOUSE(if Married)
                            </td> 
                            <td colspan="1">
                                <input value = "<?php echo $row['n_bday']?>" type="date" id="n_bday" name="n_bday"  class="form-100 form-conemp m-t-15"><br>BIRTHDATE
                            </td> 
                            <td colspan="5">
                                <input value = "<?php echo $row['n_occupation']?>" type="text" id="n_occupation" name="n_occupation"  class="form-100 form-conemp m-t-15"><br>OCCUPATION
                            </td> 
                            <td colspan="7">
                                <input value = "<?php echo $row['employers_name_address']?>" type="text" id="employers_name_address" name="employers_name_address"  class="form-100 form-conemp m-t-15"><br>EMPLOYER'S NAME & ADDRESS
                            </td> 
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <td colspan="10">
                                <div class="m-t-15"></div>
                                NAME OF CHILDREN(with Birthdate)
                            </td>
                            <td colspan="5"></td>
                        </tr>
                        <?php 
                            $b=1;
                            $selectchild=$con->query("SELECT * FROM children WHERE personal_id = '$id'");
                            $rowschild=$selectchild->num_rows;
                            if($rowschild>0){
                                while($fetchchild = $selectchild->fetch_array()){ 
                        ?>
                        <tr id="appendchild0" class="appendchild">
                            <td colspan="5"></td>
                            <td colspan="7">
                                <input type="text" id="name_child" class="form-100 form-conemp" name="child_name[]" value="<?php echo $fetchchild['child_name']; ?>" placeholder="Name" />
                            </td>
                            <td colspan="1">
                                <input type="date" id="bday_child" class="form-100 form-conemp" name="child_bday[]" value="<?php echo $fetchchild['child_bday']; ?>" placeholder = "Birthdate" />
                            </td>
                            <td colspan="2" align="center" class="addmoreappendchild">
                                <a class="btn-primary btn-sm btn-fill addChildren" id="addChildren"><span class="zmdi zmdi-plus"></span></a>
                                <input type='hidden' name='children_id[]' value="<?php echo $fetchchild['children_id']; ?>">
                            </td>
                            <td colspan="5"></td>
                        </tr>
                        <?php $b++; } } else { ?>
                        <tr id="appendchild0" class="appendchild">
                            <td colspan="5"></td>
                            <td colspan="7">
                                <input type="text" id="name_child"  class="form-100 form-conemp" name="child_name[]" placeholder="Name" />
                            </td>
                            <td colspan="1">
                                <input type="date" id="bday_child" class="form-100 form-conemp" name="child_bday[]" placeholder = "Birthdate" />
                            </td>
                            <td colspan="2" align="center" class="addmoreappendchild">
                                <a class="btn-primary btn-sm btn-fill addChildren" id="addChildren"><span class="zmdi zmdi-plus"></span></a>
                            </td>
                            <td colspan="5"></td>
                            <input type='hidden' name='children_id[]' value="0">
                        </tr>
                        <?php } ?>
                    </table>
                    <table width="100%">
                        <tr>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                        </tr>
                        <tr>
                            <td colspan="20">
                                <br>
                                <hr>
                                <b>EDUCATIONAL BACKGROUND</b>
                                <div id="errorBox1" style = "margin-left:150px;margin-top:-13px;"></div>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input list = "colleges" value = "<?php echo $row['college']?>" type = "text" name = "college" id='college' class="form-100 form-conemp" autocomplete="off" placeholder="NAME OF SCHOOL/ADDRESS">
                                <datalist id = "colleges">
                                    <?php 
                                        $querycol =$con->query("SELECT college FROM educational_background WHERE college!='' ORDER BY college ASC"); 
                                        $resultcol = $querycol->num_rows;
                                        if(!empty($resultcol)) {
                                            while($fetchcol = mysqli_fetch_array($querycol)){
                                    ?>
                                        <option data-customvalue="<?php echo $fetchcol['college']; ?>" value = "<?php echo $fetchcol['college']; ?>"></option>
                                    <?php } } ?>
                                </datalist>
                                <!-- <span id="suggestion-college"></span> --><br>COLLEGE: 
                            </td> 
                            <td colspan="7">
                                <input value = "<?php echo $row['course']?>" type = "text" name = "course" class="form-100 form-conemp">
                                <br>COURSE
                            </td>
                            <td colspan="1">
                                <input value = "<?php echo $row['ed_from']?>" type = "text" name = "ed_from" class="form-conemp">
                                <br>FROM
                            </td>
                            <td colspan="1">
                                <input value = "<?php echo $row['ed_to']?>" type = "text" name = "ed_to" class="form-conemp">
                                <br>TO
                            </td>
                            <td colspan="1">
                                <input value = "<?php echo $row['date_graduated']?>" type = "text" name = "date_graduated" class="form-conemp">
                                <br>DATE GRADUATED
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input list = "highschools" value = "<?php echo $row['highschool']?>"  type = "text" name = "highschool" id='highschool' class="form-100 form-conemp" placeholder="NAME OF SCHOOL/ADDRESS" autocomplete="off">
                                <datalist id = "highschools">
                                    <?php 
                                        $queryhigh =$con->query("SELECT highschool FROM educational_background WHERE highschool!='' ORDER BY highschool ASC"); 
                                        $resulthigh = $queryhigh->num_rows;
                                        if(!empty($resulthigh)) {
                                            while($fetchhigh = mysqli_fetch_array($queryhigh)){
                                    ?>
                                        <option data-customvalue="<?php echo $fetchhigh['highschool']; ?>" value = "<?php echo $fetchhigh['highschool']; ?>"></option>
                                    <?php } } ?>
                                </datalist>
                                <!-- <span id="suggestion-highschool"></span> --><br>HIGHSCHOOL:
                            </td>
                            <td colspan="7">
                                <input value = "<?php echo $row['h_course']?>" type = "text" name = "h_course" class="form-100 form-conemp">
                                <br>COURSE
                            </td>
                            <td colspan="1">
                                <input value = "<?php echo $row['h_from']?>" type = "text" name = "h_from" class="form-100 form-conemp">
                                <br>FROM
                            </td>
                            <td colspan="1">
                                <input value = "<?php echo $row['h_to']?>" type = "text" name = "h_to" class="form-100 form-conemp">
                                <br>TO
                            </td>
                            <td colspan="1">
                                <input value = "<?php echo $row['h_date_graduated']?>" type = "text" name = "h_date_graduated" class="form-100 form-conemp">
                                <br>DATE GRADUATED
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input list="elementarys" value = "<?php echo $row['elementary']?>" type = "text" name = "elementary" id='elementary' class="form-100 form-conemp" placeholder="NAME OF SCHOOL/ADDRESS" autocomplete="off">
                                <datalist id = "elementarys">
                                    <?php 
                                        $queryelem =$con->query("SELECT elementary FROM educational_background WHERE elementary!='' ORDER BY elementary ASC"); 
                                        $resultelem = $queryelem->num_rows;
                                        if(!empty($resultelem)) {
                                            while($fetchelem = mysqli_fetch_array($queryelem)){
                                    ?>
                                        <option data-customvalue="<?php echo $fetchelem['elementary']; ?>" value = "<?php echo $fetchelem['elementary']; ?>"></option>
                                    <?php } } ?>
                                </datalist>
                                <!-- <span id="suggestion-elementary"></span> --><br>ELEMENTARY:
                            </td>
                            <td colspan="7">
                                <input value = "<?php echo $row['e_course']?>" type = "text" name = "e_course" class="form-100 form-conemp">
                                <br>COURSE
                            </td>
                            <td colspan="1">
                                <input value = "<?php echo $row['e_from']?>" type = "text" name = "e_from" class="form-100 form-conemp">
                                <br>FROM</td>
                            <td colspan="1">
                                <input value = "<?php echo $row['e_to']?>" type = "text" name = "e_to" class="form-100 form-conemp">
                                <br>TO
                            </td>
                            <td colspan="1">
                                <input value = "<?php echo $row['e_date_graduated']?>" type = "text" name = "e_date_graduated" class="form-100 form-conemp">
                                <br>DATE GRADUATED
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input list="postgrads"  value = "<?php echo $row['post_grad']?>"  type = "text" name = "post_grad" id='postgrad' class="form-100 form-conemp" placeholder="NAME OF SCHOOL/ADDRESS">
                                <datalist id = "postgrads">
                                    <?php 
                                        $querypost =$con->query("SELECT post_grad FROM educational_background WHERE post_grad!='' ORDER BY post_grad ASC"); 
                                        $resultpost = $querypost->num_rows;
                                        if(!empty($resultpost)) {
                                            while($fetchpost = mysqli_fetch_array($querypost)){
                                    ?>
                                        <option data-customvalue="<?php echo $fetchpost['post_grad']; ?>" value = "<?php echo $fetchpost['post_grad']; ?>"></option>
                                    <?php } } ?>
                                </datalist>
                                <!-- <span id="suggestion-postgrad"></span> --><br>POST GRAD/VOCATIONAL: 
                            </td>
                            <td colspan="7">
                                <input value = "<?php echo $row['p_course']?>" type = "text" name = "p_course"  class="form-100 form-conemp">
                                <br>COURSE
                            </td >
                            <td colspan="1">
                                <input value = "<?php echo $row['p_from']?>" type = "text" name = "p_from"  class="form-100 form-conemp">
                                <br>FROM
                            </td>
                            <td colspan="1">
                                <input value = "<?php echo $row['p_to']?>" type = "text" name = "p_to"  class="form-100 form-conemp">
                                <br>TO
                            </td>
                            <td colspan="1">
                                <input value = "<?php echo $row['p_date_graduated']?>" type = "text" name = "p_date_graduated" class="form-100 form-conemp">
                                <br>DATE GRADUATED
                            </td>
                        </tr>
                    </table>                    
                    <table width="100%" class="table-bordesred">
                        <tr>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                        </tr>
                        <tr>
                            <td colspan="20">
                                <br>
                                <hr>
                                <b>EMPLOYMENT HISTORY (From RECENT to PAST):</b>
                                <div id="errorBox1" style = "margin-left:150px;margin-top:-13px;"></div>
                                <br>
                            </td>
                        </tr>
                        <tr>                           
                            <td colspan="7">NAME/ADDRESS OF EMPLOYER </td>
                            <td colspan="4">POSITION</td>
                            <td colspan="1">FROM</td>
                            <td colspan="1">TO</td>
                            <td colspan="5">REMARKS</td>
                            <td colspan="2"></td>
                        </tr>
                        <?php 
                            $c=1;
                            $selectemp=$con->query("SELECT * FROM employment_history WHERE personal_id = '$id'");
                            $rowsemp=$selectemp->num_rows;
                            if($rowsemp > 0){
                            while($fetchemp = $selectemp->fetch_array()){ 
                        ?>
                        <tr id = "appendemploy0" class="appendemploy"> 
                            <td colspan="7" id ="p_scents">
                                <p class="m-0">
                                    <label class="m-0 form-100" for="p_scnts">
                                        <input type="text" id="name" class="form-100 form-conemp" name="name_address_employer[]" value="<?php echo $fetchemp['name_address_employer']; ?>" placeholder="Name/Address of Employer" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="4" id ="p_scents1">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_scnts1">
                                        <input type="text" id="position" class="form-100 form-conemp" name="em_position[]" value="<?php echo $fetchemp['em_position']; ?>" placeholder="Position" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="1" id ="p_scents2">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_scnts2">
                                        <input type="text" id="from" class="form-conemp" name="em_from[]" value="<?php echo $fetchemp['em_from']; ?>" placeholder="From (Date)" placeholder="From (Date)" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="1" id ="p_scents3">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_scnts3">
                                        <input type="text" id="to" class="form-conemp" name="em_to[]" value="<?php echo $fetchemp['em_to']; ?>" placeholder="To (Date)" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="5" id ="p_scents4">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_scnts4">
                                        <input type="text" id="remarks" name="em_remarks[]" value="<?php echo $fetchemp['em_remarks']; ?>" class="form-100 form-conemp" placeholder="Remarks" />
                                    </label>
                                </p>                                
                            </td>
                            <td colspan="2" align="center" class="addmoreappendemploy">
                                <a class="btn-primary btn-sm addScnt" id="addScnt"><span class="zmdi zmdi-plus"></span></a>
                                <input type='hidden' name='employment_id[]' value='<?php echo $fetchemp['employment_id']; ?>'>
                            </td>
                        </tr>                         
                        <?php $c++; }  } else { ?>
                        <tr id = "appendemploy0" class="appendemploy"> 
                            <td colspan="7" id ="p_scents">
                                <p class="m-0">
                                    <label class="m-0 form-100" for="p_scnts">
                                        <input type="text" id="name1" class="form-100 form-conemp" name="name_address_employer[]" placeholder="Name/Address of Employer" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="4" id ="p_scents1">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_scnts1">
                                        <input type="text" id="position1" class="form-100 form-conemp" name="em_position[]" value="" placeholder="Position" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="1" id ="p_scents2">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_scnts2">
                                        <input type="text" id="from1" class="form-conemp" name="em_from[]" value="" placeholder="From (Date)" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="1" id ="p_scents3">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_scnts3">
                                        <input type="text" id="to1" class="form-conemp" name="em_to[]" value="" placeholder="To (Date)" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="5" id ="p_scents4">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_scnts4">
                                        <input type="text" id="remarks1" name="em_remarks[]" class="form-100 form-conemp" placeholder="Remarks" />
                                    </label>
                                </p>                                
                            </td>
                            <td colspan="2" align="center" class="addmoreappendemploy">
                                <a class="btn-primary btn-sm addScnt" id="addScnt"><span class="zmdi zmdi-plus"></span></a>
                            </td>
                            <input type='hidden' name='employment_id[]' value='0'>
                        </tr>  
                        <?php } ?>
                    
                        <tr>
                            <td colspan="20">
                                <br>
                                <hr>
                                <b>TRAININGS AND SEMINAR ATTENDED:</b>
                                <div id="errorBox1" style = "margin-left:150px;margin-top:-13px;"></div>
                                <br>
                            </td>
                        </tr>
                        <tr>                           
                            <td colspan="7">TITLE </td>
                            <td colspan="5">VENUE</td>
                            <td colspan="3">ORGANIZER</td>
                            <td colspan="3">DATE</td>
                            <td colspan="2"></td>
                        </tr>
                        <?php 
                            $t=1;
                            $selecttrain=$con->query("SELECT * FROM training_seminars WHERE personal_id = '$id'");
                            $rowstrain=$selecttrain->num_rows;
                            if($rowstrain > 0){
                            while($fetchtrain = $selecttrain->fetch_array()){ 
                        ?>
                        <tr id = "appendtraining0" class="appendtraining"> 
                            <td colspan="7" id ="p_train">
                                <p class="m-0">
                                    <label class="m-0 form-100" for="p_train">
                                        <input type="text" id="title" class="form-100 form-conemp" name="title[]" value="<?php echo $fetchtrain['title']; ?>" placeholder="Title" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="5" id ="p_train1">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_train1">
                                        <input type="text" id="venue" class="form-100 form-conemp" name="venue[]" value="<?php echo $fetchtrain['venue']; ?>" placeholder="Venue" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="3" id ="p_train2">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_train2">
                                        <input type="text" id="organizer" class="form-100 form-conemp" name="organizer[]" value="<?php echo $fetchtrain['organizer']; ?>" placeholder="Organizer" />
                                    </label>
                                </p>
                            </td>
                              <td colspan="3" id ="p_train3">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_train3">
                                        <input type="text" id="training_date" class="form-100 form-conemp" name="training_date[]" value="<?php echo $fetchtrain['training_date']; ?>" placeholder="Date" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="2" align="center" class="addmoreappendtraining">
                                <a class="btn-primary btn-sm addTrain" id="addTrain"><span class="zmdi zmdi-plus"></span></a>
                                <input type='hidden' name='training_seminars_id[]' value='<?php echo $fetchtrain['training_seminars_id']; ?>'>
                            </td>
                        </tr>
                        <?php $t++; }  } else { ?>
                        <tr id = "appendtraining0" class="appendtraining"> 
                            <td colspan="7" id ="p_train">
                                <p class="m-0">
                                    <label class="m-0 form-100" for="p_train">
                                        <input type="text" id="title1" class="form-100 form-conemp" name="title[]" placeholder="Title" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="5" id ="p_train1">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_train1">
                                        <input type="text" id="venue1" class="form-100 form-conemp" name="venue[]" value="" placeholder="Venue" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="3" id ="p_train2">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_train2">
                                        <input type="text" id="organizer1" class="form-100 form-conemp" name="organizer[]" value="" placeholder="Organizer" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="3" id ="p_train3">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_train3">
                                        <input type="text" id="training_date1" class="form-100 form-conemp" name="training_date[]" value="" placeholder="Date" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="2" align="center" class="addmoreappendtraining">
                                <a class="btn-primary btn-sm addTrain" id="addTrain"><span class="zmdi zmdi-plus"></span></a>
                            </td>
                            <input type='hidden' name='training_seminars_id[]' value='0'>
                        </tr>  
                        <?php } ?>   
                    </table>
                    <table width="100%">
                        <tr>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                        </tr>
                        <tr>
                            <td colspan="20">
                                <br>
                                <hr>
                                <b>ADDITIONAL INFORMATION:</b>
                                <br>
                            </td>
                        </tr> 
                        <tr>
                            <td colspan="5">
                                <input value = "<?php echo $row['tin'];?>" type = "text" name = "tin"  class="form-100 form-conemp">
                                <br>TIN
                            </td>
                            <td colspan="5">
                                <input value = "<?php echo $row['sss'];?>" type = "text" name = "sss"  class="form-100 form-conemp">
                                <br>SSS
                            </td>
                            <td colspan="5">
                                <input value = "<?php echo $row['philhealth'];?>" type = "text" name = "philhealth"  class="form-100 form-conemp">
                                <br>PHILHEALTH
                            </td>
                            <td colspan="5">
                                <input value = "<?php echo $row['pagibig'];?>" type = "text" name = "pagibig"  class="form-100 form-conemp">
                                <br>PAGIBIG(HDMF)
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <input value = "<?php echo $row['height']?>" type = "text" name = "height"  class="form-100 form-conemp">
                                <br>HEIGHT
                            </td>
                            <td colspan="5">
                                <input value = "<?php echo $row['weight']?>" type = "text" name = "weight"  class="form-100 form-conemp">
                                <br>WEIGHT
                            </td>
                            <td colspan="10">
                                <input value = "<?php echo $row['dialect']?>" type = "text" name = "dialect"  class="form-100 form-conemp">
                                <br>TYPES OF DIALECT SPOKEN/CAN UNDERSTAND
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <input value = "<?php echo $row['drivers_license']?>" type = "text" name = "drivers_license"  class="form-100 form-conemp">
                                <br>DO YOU HAVE DRIVER'S LICENSE?
                            </td>
                            <td colspan="5">
                                <input value = "<?php echo $row['date_issued_licensed_number']?>" type = "text" name = "date_issued_licensed_number"  class="form-100 form-conemp">
                                <br>DATE ISSUED/LICENSE NUMBER
                            </td>
                            <td colspan="10">
                                <input value = "<?php echo $row['special_skills']?>" type = "text" name = "special_skills"  class="form-100 form-conemp">
                                <br>SPECIAL SKILLS
                            </td>
                        </tr>
                        <tr>
                            <td colspan="20">
                                <input value = "<?php echo $row['illness']?>" type = "text" name = "illness"  class="form-100 form-conemp">
                                <br>HAVE YOU EVER BEEN HOSPITALIZED? WHAT MAJOR ILLNESS?
                            </td> 
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input value = "<?php echo $row['own_bus']?>" type = "text" name = "own_bus"  class="form-100 form-conemp">
                                <br>DO YOU OWN A BUSINESS?
                            </td>
                            <td colspan="10">
                                <input value = "<?php echo $row['nature_bus']?>" type = "text" name = "nature_bus"  class="form-100 form-conemp">
                                <br>NATURE OF BUSINESS
                            </td> 
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input value = "<?php echo $row['profession']?>" type = "text" name = "profession"  class="form-100 form-conemp">
                                <br>PROFESSION
                            </td>
                            <td colspan="10">
                                <input value = "<?php echo $row['license_no']?>" type = "text" name = "license_no"  class="form-100 form-conemp">
                                <br>LICENSED NUMBER
                            </td> 
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                            <td width="5%"></td>
                        </tr>
                        <tr>
                            <td colspan="20">
                                <br>
                                <hr>
                                <b>CHARACTER REFERENCE:</b>
                                <br>
                            </td>
                        </tr> 
                        <tr>
                            <td colspan="4">NAME</td>
                            <td colspan="4">EMPLOYER</td>
                            <td colspan="3">POSITION</td>
                            <td colspan="4">RELATIONSHIP</td>
                            <td colspan="3">CONTACT NUMBER</td>
                            <td colspan="2"></td>
                        </tr>
                        <?php 
                            $d=1;
                            $selectref=$con->query("SELECT * FROM character_reference WHERE personal_id = '$id'");
                            $rowsref=$selectref->num_rows;
                            if($rowsref > 0){
                            while($fetchref = $selectref->fetch_array()){ 
                        ?>
                        <tr id="appendchar0" class="appendchar">
                            <td colspan="4" id ="p_char">
                                <p class="m-0">
                                    <label for="p_chas" class="form-100 m-0">
                                        <input type="text" id="a_name" class="form-100 form-conemp" name="c_name[]" value="<?php echo $fetchref['c_name']; ?>" placeholder="Name" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="4" id ="p_char1">
                                <p class="m-0">
                                    <label for="p_chas1" class="form-100 m-0">
                                        <input type="text" id="a_employer" class="form-100 form-conemp" name="c_employer[]" value="<?php echo $fetchref['c_employer']; ?>" placeholder="Employer" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="3" id ="p_char2">
                                <p class="m-0">
                                    <label for="p_chas2" class="form-100 m-0">
                                        <input type="text" id="a_position" class="form-100 form-conemp" name="c_position[]" value="<?php echo $fetchref['c_position']; ?>" placeholder="Position" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="4" id ="p_char3">
                                <p class="m-0">
                                    <label for="p_chas3" class="form-100 m-0">
                                        <input type="text" id="a_relationship" class="form-100 form-conemp" name="c_relationship[]" value="<?php echo $fetchref['c_relationship']; ?>" placeholder="Relationship" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="3" id ="p_char4">
                                <p class="m-0">
                                    <label for="p_chas4" class="form-100 m-0">
                                        <input type="text"  id="a_contact_no" class="form-100 form-conemp" name="c_contact_no[]" value="<?php echo $fetchref['c_contact_no']; ?>" placeholder="Contact Number" />
                                    </label> 
                                </p>
                            </td> 
                            <td colspan="2" align="center" class="addmoreappendchar">
                                <a class="btn-primary btn-sm btn-fill addChar" id="addChar"><span class="zmdi zmdi-plus"></span></a>
                            </td>
                            <input type='hidden' name='character_id[]' value="<?php echo $fetchref['character_id']; ?>">
                        </tr>
                        <?php $d++; } } else { ?>
                        <tr id="appendchar0" class="appendchar">
                            <td colspan="4" id ="p_char">
                                <p class="m-0">
                                  <label for="p_chas" class="form-100 m-0">
                                    <input type="text" id="a_name1" class="form-100 form-conemp"name="c_name[]" value="" placeholder="Name" />
                                  </label> 
                                </p>
                            </td>
                            <td colspan="4" id ="p_char1">
                                <p class="m-0">
                                  <label for="p_chas1" class="form-100 m-0"><input type="text" id="a_employer1" class="form-100 form-conemp"name="c_employer[]" value="" placeholder="Employer" /></label> 
                                </p>
                            </td>
                            <td colspan="3" id ="p_char2">
                                <p class="m-0">
                                  <label for="p_chas2" class="form-100 m-0"><input type="text" id="a_position1" class="form-100 form-conemp" name="c_position[]" value="" placeholder="Position" /></label> 
                                </p>
                            </td>
                            <td colspan="4" id ="p_char3">
                                <p class="m-0">
                                  <label for="p_chas3" class="form-100 m-0"><input type="text" id="a_relationship1" class="form-100 form-conemp"name="c_relationship[]" value="" placeholder="Relationship" /></label> 
                                </p>
                            </td>
                            <td colspan="3" id ="p_char4">
                                <p class="m-0">
                                  <label for="p_chas4" class="form-100 m-0"><input type="text" id="a_contact_no1" class="form-100 form-conemp"name="c_contact_no[]" value="" placeholder="Contact Number" /></label> 
                                </p>
                            </td> 
                            <td colspan="2" align="center" class="addmoreappendchar">
                                <a class="btn-primary btn-sm btn-fill addChar" id="addChar"><span class="zmdi zmdi-plus"></span></a>
                            </td>
                            <input type='hidden' name='character_id[]' value="0">
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="20" style = "font-weight:bold;">
                                <br>
                                PERSON TO CONTACT INCASE OF EMERGENCY: 
                                <div id="errorBox3" style = "margin-left: 288px;margin-top: -17px;"></div>
                                <br>
                            </td> 
                        </tr>
                        <tr>
                            <td colspan="5">
                                <input value = "<?php echo $row['p_name']?>" type = "text" id = "p_name" name = "p_name"  style = "padding-top:0px;width:100%;margin-top:-1px;">
                                <br>NAME
                            </td> 
                            <td colspan="5">
                                <input value = "<?php echo $row['p_relationship']?>" type = "text" id = "p_relationship" name = "p_relationship"  style = "padding-top:0px;width:100%;margin-top:-1px;">
                                <br>RELATIONSHIP
                            </td> 
                            <td colspan="5">
                                <input value = "<?php echo $row['p_contact_no']?>" type = "text" id = "p_contact_no" name = "p_contact_no"  style = "padding-top:0px;width:100%;margin-top:-1px;">
                                <br>CONTACT NUMBER
                            </td> 
                            <td colspan="5">
                                <input value = "<?php echo $row['address']?>" type = "text" id = "p_address" name = "address"  style = "padding-top:0px;width:100%;margin-top:-1px;">
                                <br>ADDRESS
                            </td> 
                        </tr>
                        <tr>
                            <td colspan="20"><br></td>
                        </tr>
                        <tr style="border:1px solid #fff">
                            <td colspan="3"></td>
                            <td colspan="14" style = "font-weight:bold;font-size:12px;padding-top:20px;">&nbsp I HERBY CERTIFY THAT THE INFORMATION GIVEN IS TRUE AND CORRECT AND THAT IT HAS BEEN MADE IN GOOD FAITH TO THE BEST OF MY KNOWLEDGE AND BELIEF.</td> 
                            <td colspan="3"></td>
                        </tr>
                        <tr style="border:1px solid #fff">
                            <td colspan="10" style = "font-weight:bold;padding-top:50px;border-right:1px solid #fff">PRINTED NAME & SIGNATURE</td> 
                            <td colspan="10" style = "font-weight:bold;padding-top:50px;">DATE </td> 
                        </tr>
                        <tr>
                            <td colspan="20"><br></td>
                        </tr>
                        <tr>
                            <td colspan = "15">
                                <select class =" btn  btn-sm btn-success btn-fill" style="color:black;height:100%" name="status" id="status">
                                    <option value = "" visit = "" selected="" style = "font-weight:bold;">-Select Status-</option>
                                    <option value = "Active" <?php echo (($row['status'] == 'Active') ? ' selected' : ''); ?>>Active</option>
                                    <option value = "Inactive" <?php echo (($row['status'] == 'Inactive') ? ' selected' : ''); ?>>Inactive / Applicant(Not Hired)</option>
                                    <option value = "Separated" <?php echo (($row['status'] == 'Separated') ? ' selected' : ''); ?>>Separated</option>
                                </select>
                                <span id="errorBox4" style = "margin-left:10px;margin-top:-17px;"></span>

                                <select class =" btn  btn-sm btn-warning btn-fill" style="color:black;height:100%" name="emp_status" id="emp_status">
                                    <option value = "" visit = "" selected="" style = "font-weight:bold;">-Select Employment Status-</option>
                                    <option value = "Regular" <?php echo (($row['emp_status'] == 'Regular') ? ' selected' : ''); ?>>Regular</option>
                                    <option value = "Probationary" <?php echo (($row['emp_status'] == 'Probationary') ? ' selected' : ''); ?>>Probationary</option>
                                    <option value = "Trainee" <?php echo (($row['emp_status'] == 'Trainee') ? ' selected' : ''); ?>>Trainee</option>
                                    <option value = "Project Based" <?php echo (($row['emp_status'] == 'Project Based') ? ' selected' : ''); ?>>Project Based</option>
                                    <option value = "Consultant" <?php echo (($row['emp_status'] == 'Consultant') ? ' selected' : ''); ?>>Consultant</option>
                                    <option value = "Pass" <?php echo (($row['emp_status'] == 'Pass') ? ' selected' : ''); ?>>Pass</option>
                                    <option value = "Fail" <?php echo (($row['emp_status'] == 'Fail') ? ' selected' : ''); ?>>Fail</option>
                                    <option value = "For Pooling" <?php echo (($row['emp_status'] == 'For Pooling') ? ' selected' : ''); ?>>For Pooling</option>
                                    <option value = "For Interview" <?php echo (($row['emp_status'] == 'For Interview') ? ' selected' : ''); ?>>For Interview</option>
                                    <option value = "For Exam" <?php echo (($row['emp_status'] == 'For Exam') ? ' selected' : ''); ?>>For Exam</option>
                                    <option value = "Part-Time" <?php echo (($row['emp_status'] == 'Part-Time') ? ' selected' : ''); ?>>Part-Time</option>
                                    <option value = "Retainer" <?php echo (($row['emp_status'] == 'Retainer') ? ' selected' : ''); ?>>Retainer</option>
                                    <option value = "OJT / Student Intern" <?php echo (($row['emp_status'] == 'OJT / Student Intern') ? ' selected' : ''); ?>>OJT / Student Intern</option>
                                    <option value = "Fixed-Term Worker" <?php echo (($row['emp_status'] == 'Fixed-Term Worker') ? ' selected' : ''); ?>>Fixed-Term Worker</option>
                                </select>
                                <span id="errorBox6" style = "margin-left:10px;margin-top:-17px;"></span>
                            </td>
                            <td colspan="5" align="right">
                                <button onClick="updateEmp()" type="button" class="btn btn-primary btn-fill pull-right">Save & Proceed 
                                    <i class="pe-7s-angle-right-circle"></i>
                                </button>  
                            </td>
                        </tr>   
                    </table>
                    <input type='hidden' name='id' id='id' value="<?php echo $id; ?>">
                </form>
            </div>
        </div>
    </div>
</section>
<script>
$('#province-list').on('change', function(){
    var id = this.value;
    $.ajax({
        type: "POST",
        url: "../reports/get_province.php",
        data:'id='+id,
        success: function(result){
            $("#city-list").html(result);
        }
    });
});

$('#provincial-list').on('change', function(){
    var id = this.value;
    $.ajax({
        type: "POST",
        url: "../reports/get_provincial.php",
        data:'id='+id,
        success: function(result){
            $("#cityh-list").html(result);
        }
    });
});
</script>
<?php 
include('../template/footer.php'); 
?>  