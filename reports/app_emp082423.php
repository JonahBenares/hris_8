<?php 
include('../template/header.php'); 
include('../includes/connection.php'); 
include('../template/navbar.php'); 
include('../includes/functions.php');
$today=date("Y-m-d");
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
    function addVendor(){
        var  status = document.getElementById("status").value;
        var  emp_status = document.getElementById("emp_status").value;
        if(status == "" ){
            document.getElementById("status").focus();
            document.getElementById("errorBox4").innerHTML="Error: Select Status";
            return false;
        }else {
            var data = $("#add-vendor").serialize();
            var conf = confirm('Are you sure you want to save this record?');
            if(conf){
                var inserts = '../reports/insert.php';
            }else{
                var inserts = '';
            }
            $.ajax({
                data: data,
                type: "post",
                url: inserts,
                success: function(output){
                    var op = output.trim();
                    //alert(op);
                    if(op!=''){
                        document.location='../reports/uploadfiles.php?id='+output;
                    }else if(inserts==''){
                        document.location = '../reports/app_emp.php';
                    }else {
                        alert('Error: Duplicate Entry!');
                        document.location = '../reports/app_emp.php';
                    }
                }
            });
        }
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
        <div class="card" >
            <div class="card-body">
                <form id ="add-vendor" name = "addvendor" method='POST'>
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
                                <input id="posapp" type = "text" name = "position_applied" class="form-conemp form-100">
                            </td>
                            <td width="5%"></td>
                            <td width="15%">DATE APPLIED:</td>
                            <td width="30%">
                                <input id="dtapp" type = "date" name = "date_applied"  class="form-conemp form-100">
                            </td>
                        </tr>
                        <tr>
                            <td>EXPECTED SALARY:</td>
                            <td>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <input id="exsal" onkeypress="return isNumberKey(event)" type = "text" name = "sal_from"  class="form-conemp form-50" placeholder="From" >               
                                        <input id="salto" onkeypress="return isNumberKey(event)" type = "text" name = "sal_to"  class="form-conemp form-50" placeholder="To">
                                    </div>
                                </div>
                            </td>
                            <td></td>
                            <td>DATE AVAILABLE:</td>
                            <td>
                                <input id="dtapp" type = "date" name = "date_available"  class="form-conemp form-100">
                            </td>
                        </tr>
                        <tr>
                            <td>COMPANY:</td>
                            <td>
                                <select id="company" name = "company" class="form-conemp form-100">
                                    <option value = ''>--SELECT COMPANY--</option>
                                    <?php 
                                        $sql = mysqli_query($con,"SELECT * FROM business_unit ORDER BY bu_name ASC");
                                        while($row=mysqli_fetch_array($sql)){
                                    ?>
                                    <option value="<?php echo $row['bu_id']; ?>"><?php echo $row['bu_name']; ?></option>
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
                            <td width="21%"><input type="text" id="lname" name="lname" class="form-conemp form-100"></td>
                            <td width="21%"><input type="text" id="fname" name="fname" class="form-conemp form-100"></td>
                            <td width="20%"><input type="text" id="mname" name="mname" class="form-conemp form-100"></td>
                            <td width="10%"><input type="text" id="name_ext" name="name_ext"  class="form-conemp form-100"></td>
                            <td width="5%">
                                <input type="text" onkeypress="return isNumberKey(event)" class="form-conemp form-100" maxlength="3" id="age" name="age" disabled="disabled">
                            </td>
                            <td width="10%">
                                <select id="sex" name="sex" class="form-conemp form-100">
                                    <option value = "">Select Sex</option>
                                    <option value = "Male">Male</option>
                                    <option value = "Female">Female</option>
                                </select>
                            </td>
                            <td  width="13%">
                                <select id="civil_status" name ="civil_status" class="form-conemp form-100">
                                    <option value = "">Select Civil Status</option>
                                    <option value = "Single">Single</option>
                                    <option value = "Married">Married</option>
                                    <option value = "Widow/Widower">Widow/Widower</option>
                                    <option value = "Annulled">Annulled</option>
                                    <option value = "Divorced">Divorced</option>
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
                                ?>
                                <select name="pre_prov" id="province-list" class="form-conemp form-100 m-t-10">
                                    <option value="">Select Province</option>
                                    <?php
                                        if ($province_result->num_rows > 0) {
                                            while($row = $province_result->fetch_assoc()) { 
                                    ?>
                                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </td> 
                            <td>
                                <select name="pre_city" id="city-list" class="form-conemp form-100 m-t-10">
                                    <option value=''>Select City</option>
                                </select>
                            </td>
                            <td colspan="5">
                                <input type="text" id="permanent_address" name="permanent_address" placeholder="PRESENT ADDRESS" class="form-conemp form-100 m-t-10">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                  require_once('../includes/connection.php');
                                  $provincial_result = $con->query('select * from provinces order by name');
                                ?>
                                <select name="perm_prov" id="provincial-list" class="form-100 form-conemp">
                                    <option value="">Select Province</option>
                                    <?php
                                        if ($provincial_result->num_rows > 0) {
                                            while($row = $provincial_result->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </td> 
                            <td>
                                <select name="perm_city" id="cityh-list" class="form-100 form-conemp">
                                    <option value=''>Select City</option>
                                </select>
                            </td>
                            <td colspan="5">
                                <input type = "text" id = "provincial_address" name = "provincial_address"  class="form-100 form-conemp" placeholder="PERMANENT/HOME ADDRESS">
                            </td>
                        </tr>
                        <tr>
                            <td><input type = "date" name = "bdate" id = "bdate"  class="form-100 form-conemp m-t-10"><br>DATE OF BIRTH</td> 
                            <td><input type = "text" id = "place_birth" name = "place_birth" class="form-100 form-conemp m-t-10"><br>PLACE OF BIRTH</td> 
                            <td><input type = "text" id = "contact_no" maxlength = "11" name = "contact_no"  class="form-100 form-conemp m-t-10"><br>CONTACT NUMBER</td> 
                            <td colspan="2"><input type = "text" name = "nationality" id = "nationality"  class="form-100 form-conemp m-t-10"><br>NATIONALITY</td> 
                            <td colspan="2"><input type = "text" name = "religion" id = "religion"  class="form-100 form-conemp m-t-10"><br>RELIGION</td> 
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
                            <td colspan="5"><input type = "text" id = "father_name" name = "father_name"  class="form-100 form-conemp m-t-10"><br>FATHER'S NAME</td>
                            <td><input type="date" id="fa_bday" name="fa_bday" class="form-100 form-conemp m-t-10"><br>BIRTHDATE</td> 
                            <td colspan="4"><input type="text" id="occupation" name="occupation" class="form-100 form-conemp m-t-10"><br>OCCUPATION</td> 
                            <td colspan="5"><input type = "text" id="mother_name" name="mother_name" class="form-100 form-conemp m-t-10"><br>MOTHER'S NAME</td> 
                            <td><input type = "date" id="m_bday" name="m_bday"  class="form-100 form-conemp m-t-10"><br>BIRTHDATE</td> 
                            <td colspan="4"><input type = "text" id="m_occupation" name="m_occupation" class="form-100 form-conemp m-t-10"><br>OCCUPATION</td> 
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
                        <tr id ="appendsib0" class="appendsib">
                            <td colspan="6"><input type="text" id="p_sib1"  class="form-100 form-conemp " name="siblings_name[]" value="" placeholder="Name" /></td>
                            <td colspan="1">
                                <input type="date" id="bday1" class="form-100 form-conemp "  name="siblings_bday[]" placeholder = "Birthdate"/>
                            </td>
                            <td colspan="5">
                                <input type="text" id="occupation1" class="form-100 form-conemp "  name="siblings_occupation[]" placeholder = "Occupation"/>
                            </td>
                            <td colspan="6">
                                <input type="text" id="employer1" class="form-100 form-conemp " name="siblings_employer[]" placeholder = "Name and Address of Employer"/>
                            </td>
                            <td colspan="2" align="center" class="addmoreappend">
                                <a class="btn-primary btn-sm addSibling" id="addSibling">+</a>
                                <!-- <a href="#" class="btn-danger btn-sm" id="remSiblings">x</a> -->
                                <input type = "hidden" value = "1" id = "counter1" name = "counter1"> 
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
                            <td colspan="7">
                                <input type="text" id="name_spouse" name="name_spouse"  class="form-100 form-conemp m-t-15"><br>NAME OF SPOUSE(if Married)
                            </td> 
                            <td colspan="1">
                                <input type="date" id="n_bday" name="n_bday"  class="form-100 form-conemp m-t-15"><br>BIRTHDATE
                            </td> 
                            <td colspan="5">
                                <input type="text" id="n_occupation" name="n_occupation"  class="form-100 form-conemp m-t-15"><br>OCCUPATION
                            </td> 
                            <td colspan="7">
                                <input type="text" id="employers_name_address" name="employers_name_address"  class="form-100 form-conemp m-t-15"><br>EMPLOYER'S NAME & ADDRESS
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
                        <tr id="appendchild0" class="appendchild">
                            <td colspan="5"></td>
                            <td colspan="7">
                                <input type="text" id="name_child1" class="form-100 form-conemp" name="child_name[]" placeholder="Name" />
                            </td>
                            <td colspan="1">
                                <input type="date" id="bday_child1" class="form-100 form-conemp" name="child_bday[]" placeholder = "Birthdate" />
                            </td>
                            <td colspan="2" align="center" class="addmoreappendchild">
                                <a class="btn-primary btn-sm btn-fill addChildren" id="addChildren">+</a>
                                <input type = "hidden" value = "1" id = "counter3" name = "counter3"> 
                            </td>
                            <td colspan="5"></td>
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
                                <b>EDUCATIONAL BACKGROUND</b>
                                <div id="errorBox1" style = "margin-left:150px;margin-top:-13px;"></div>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input list = "colleges" type = "text" name = "college" id='college' class="form-100 form-conemp" autocomplete="off" placeholder="NAME OF SCHOOL/ADDRESS">
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
                            <td colspan="7"><input type = "text" name = "course" class="form-100 form-conemp"><br>COURSE</td>
                            <td colspan="1"><input type = "text" name = "ed_from" class="form-conemp"><br>FROM</td>
                            <td colspan="1"><input type = "text" name = "ed_to" class="form-conemp"><br>TO</td>
                            <td colspan="1"><input type = "text" name = "date_graduated" class="form-conemp"><br>DATE GRADUATED</td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input list = "highschools" type = "text" name = "highschool" id='highschool' class="form-100 form-conemp" placeholder="NAME OF SCHOOL/ADDRESS" autocomplete="off">
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
                            <td colspan="7"><input type = "text" name = "h_course" class="form-100 form-conemp"><br>COURSE</td>
                            <td colspan="1"><input type = "text" name = "h_from" class="form-100 form-conemp"><br>FROM</td>
                            <td colspan="1"><input type = "text" name = "h_to" class="form-100 form-conemp"><br>TO</td>
                            <td colspan="1"><input type = "text" name = "h_date_graduated" class="form-100 form-conemp"><br>DATE GRADUATED</td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input list="elementarys" type = "text" name = "elementary" id='elementary' class="form-100 form-conemp" placeholder="NAME OF SCHOOL/ADDRESS" autocomplete="off">
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
                            <td colspan="7"><input type = "text" name = "e_course" class="form-100 form-conemp"><br>COURSE</td>
                            <td colspan="1"><input type = "text" name = "e_from" class="form-100 form-conemp"><br>FROM</td>
                            <td colspan="1"><input type = "text" name = "e_to" class="form-100 form-conemp"><br>TO</td>
                            <td colspan="1"><input type = "text" name = "e_date_graduated" class="form-100 form-conemp"><br>DATE GRADUATED</td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input list="postgrads" type = "text" name = "post_grad" id='postgrad' class="form-100 form-conemp" placeholder="NAME OF SCHOOL/ADDRESS">
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
                            <td colspan="7"><input type = "text" name = "p_course"  class="form-100 form-conemp"><br>COURSE</td >
                            <td colspan="1"><input type = "text" name = "p_from"  class="form-100 form-conemp"><br>FROM</td>
                            <td colspan="1"><input type = "text" name = "p_to"  class="form-100 form-conemp"><br>TO</td>
                            <td colspan="1"><input type = "text" name = "p_date_graduated" class="form-100 form-conemp"><br>DATE GRADUATED</td>
                        </tr>
                    </table>                    
                    <table width="100%" class="table-bordsered">
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
                                <a class="btn-primary btn-sm addScnt" id="addScnt">+</a>
                                <input type = "hidden" value = "1" id = "counter" name  = "counter">
                            </td>
                        </tr> 
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
                            <input type = "hidden" value = "1" id = "counter4" name  = "counter4">
                            <td colspan="2" align="center" class="addmoreappendtraining">
                                <a class="btn-primary btn-sm addTrain" id="addTrain">+</a>
                            </td>
                        </tr>   
                    </table>
                   <!--  <table width="100%" >
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
                                <b>TRAINING AND SEMINARS ATTENDED:</b>
                                <div id="errorBox1" style = "margin-left:150px;margin-top:-13px;"></div>
                                <br>
                            </td>
                        </tr>
                        <tr>                           
                            <td colspan="7">TITLE </td>
                            <td colspan="4">VENUE</td>
                            <td colspan="1">ORGANIZER</td>
                            <td colspan="1">DATE</td>
                        </tr>
                        <tr id = "appendtraining0" class="appendtraining"> 
                            <td colspan="7" id ="p_train">
                                <p class="m-0">
                                    <label class="m-0 form-100" for="p_train">
                                        <input type="text" id="title1" class="form-100 form-conemp" name="title[]" placeholder="Title" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="4" id ="p_train1">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_train1">
                                        <input type="text" id="venue1" class="form-100 form-conemp" name="venue[]" value="" placeholder="Venue" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="1" id ="p_train2">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_train2">
                                        <input type="text" id="organizer1" class="form-conemp" name="organizer[]" value="" placeholder="Organizer" />
                                    </label> 
                                </p>
                            </td>
                            <td colspan="1" id ="p_train3">
                                <p class="m-0">
                                    <label class="m-0  form-100" for="p_train3">
                                        <input type="text" id="training_date1" class="form-conemp" name="training_date[]" value="" placeholder="Date" />
                                    </label> 
                                </p>
                            </td>
                            <input type = "hidden" value = "1" id = "counter4" name  = "counter4">
                            <td colspan="2" align="center" class="addmoreappendtraining">
                                <a class="btn-primary btn-sm addTrain" id="addTrain">+</a>
                            </td>
                        </tr> 
                    </table> -->
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
                            <td colspan="5"><input type = "text" name = "tin"  class="form-100 form-conemp"><br>TIN</td>
                            <td colspan="5"><input type = "text" name = "sss"  class="form-100 form-conemp"><br>SSS</td>
                            <td colspan="5"><input type = "text" name = "philhealth"  class="form-100 form-conemp"><br>PHILHEALTH</td>
                            <td colspan="5"><input type = "text" name = "pagibig"  class="form-100 form-conemp"><br>PAGIBIG(HDMF)</td>
                        </tr>
                        <tr>
                            <td colspan="5"><input type = "text" name = "height"  class="form-100 form-conemp"><br>HEIGHT</td>
                            <td colspan="5"><input type = "text" name = "weight"  class="form-100 form-conemp"><br>WEIGHT</td>
                            <td colspan="10"><input type = "text" name = "dialect"  class="form-100 form-conemp"><br>TYPES OF DIALECT SPOKEN/CAN UNDERSTAND</td>
                        </tr>
                        <tr>
                            <td colspan="5"><input type = "text" name = "drivers_license"  class="form-100 form-conemp"><br>DO YOU HAVE DRIVER'S LICENSE?</td>
                            <td colspan="5"><input type = "text" name = "date_issued_licensed_number"  class="form-100 form-conemp"><br>DATE ISSUED/LICENSE NUMBER</td>
                            <td colspan="10"><input type = "text" name = "special_skills"  class="form-100 form-conemp"><br>SPECIAL SKILLS</td>
                        </tr>
                        <tr>
                            <td colspan="20"><input type = "text" name = "illness"  class="form-100 form-conemp"><br>HAVE YOU EVER BEEN HOSPITALIZED? WHAT MAJOR ILLNESS?</td> 
                        </tr>
                        <tr>
                            <td colspan="10"><input type = "text" name = "own_bus"  class="form-100 form-conemp"><br>DO YOU OWN A BUSINESS?</td>
                            <td colspan="10"><input type = "text" name = "nature_bus"  class="form-100 form-conemp"><br>NATURE OF BUSINESS</td> 
                        </tr>
                        <tr>
                            <td colspan="10"><input type = "text" name = "profession"  class="form-100 form-conemp"><br>PROFESSION</td>
                            <td colspan="10"><input type = "text" name = "license_no"  class="form-100 form-conemp"><br>LICENSED NUMBER</td> 
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
                                <input type = "hidden" value = "1" id = "counter2" name = "counter2"> 
                            </td> 
                            <td colspan="2" align="center" class="addmoreappendchar">
                                <a class="btn-primary btn-sm btn-fill addChar" id="addChar">+</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="20" style = "font-weight:bold;">
                                <br>
                                PERSON TO CONTACT INCASE OF EMERGENCY: 
                                <div id="errorBox3" style = "margin-left: 288px;margin-top: -17px;"></div>
                                <br>
                            </td> 
                        </tr>
                        <tr>
                            <td colspan="5"><input type = "text" id = "p_name" name = "p_name"  style = "padding-top:0px;width:100%;margin-top:-1px;"><br>NAME</td> 
                            <td colspan="5"><input type = "text" id = "p_relationship" name = "p_relationship"  style = "padding-top:0px;width:100%;margin-top:-1px;"><br>RELATIONSHIP</td> 
                            <td colspan="5"><input type = "text" id = "p_contact_no" name = "p_contact_no"  style = "padding-top:0px;width:100%;margin-top:-1px;"><br>CONTACT NUMBER</td> 
                            <td colspan="5"><input type = "text" id = "p_address" name = "address"  style = "padding-top:0px;width:100%;margin-top:-1px;"><br>ADDRESS</td> 
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
                                    <option value = "Active">Active</option>
                                    <option value = "Inactive">Inactive / Applicant(Not Hired)</option>
                                    <option value = "Separated">Separated</option>
                                </select>
                                <span id="errorBox4" style = "margin-left:10px;margin-top:-17px;"></span>

                                <select class =" btn  btn-sm btn-warning btn-fill" style="color:black;height:100%" name="emp_status" id="emp_status">
                                    <option value = "" visit = "" selected="" style = "font-weight:bold;">-Select Employment Status-</option>
                                    <option value = "Regular">Regular</option>
                                    <option value = "Probationary">Probationary</option>
                                    <option value = "Trainee">Trainee</option>
                                    <option value = "Project Based">Project Based</option>
                                    <option value = "Consultant">Consultant</option>
                                    <option value = "Pass">Pass</option>
                                    <option value = "Fail">Fail</option>
                                    <option value = "For Pooling">For Pooling</option>
                                    <option value = "For Interview">For Interview</option>
                                    <option value = "For Exam">For Exam</option>
                                    <option value = "Part-Time">Part-Time</option>
                                    <option value = "Retainer">Retainer</option>
                                    <option value = "OJT / Student Intern">OJT / Student Intern</option>
                                </select>
                                <span id="errorBox6" style = "margin-left:10px;margin-top:-17px;"></span>
                            </td>
                            <td colspan="5" align="right">
                                <button onClick="addVendor();" type="button" class="btn btn-primary btn-fill pull-right">Save & Proceed 
                                    <i class="pe-7s-angle-right-circle"></i>
                                </button>  
                            </td>
                        </tr>   
                    </table>
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
        url: "get_province.php",
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
        url: "get_provincial.php",
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