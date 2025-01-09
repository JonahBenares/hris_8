<?php 

    include('../template/header.php'); 
    include('../includes/connection.php');
    include('../includes/functions.php');
    if(isset($GET['id'])){
        $id = $GET["id"];
    } 
    else{
        $id = $_GET["id"];
       
    }

?>
<style type="text/css">
    body {
        background: rgb(204,204,204); 
        color: #000;
        font-family: sans-serif, Arial;
    }
    h1,h2,h3,h4,h5,h6{color: #000}
    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }
    page[size="A4"] {  
        width: 21cm;
        height: 29.7cm; 
    }
    page[size="A4"][layout="landscape"] {
        width: 29.7cm;
        height: 21cm;  
    }
    page[size="A3"] {
        width: 29.7cm;
        height: 42cm;
    }
    page[size="A3"][layout="landscape"] {
        width: 42cm;
        height: 29.7cm;  
    }
    page[size="A5"] {
        width: 14.8cm;
        height: 21cm;
    }
    page[size="A5"][layout="landscape"] {
        width: 21cm;
        height: 14.8cm;  
    }
    @media print {
        body, page {
            margin: 0;
            box-shadow: 0;
        }
        /*table td{ border:1px solid #fff!important; }*/
        .bor-btm{border-bottom:1px solid #000!important;}
        .bor-all{
            border: 1px solid #000;
        }
        #printbutton, #br, #br1{display: none}
        table{border:1px solid #000!important;}
    }
    /*.table-bordered, td {
        border: 1px solid #000!important;
    } */
    .bor-btm{
        border-bottom:1px solid #000;
    }
    .bor-right{
        border-right:1px solid #000;
    }
    .bor-left{
        border-left:1px solid #000;
    }
    .bor-top{
        border-top:1px solid #000;
    }
    .bor-all{
        border: 1px solid #000;
    }
    table td{
        font-size: 11px;
    }
    .font-12{
        font-size: 12px!important;
    }
    table{border:1px solid #000!important;}
    .btn-w100{
        width: 100px
    }
    .btn-round{
        border-radius: 20px
    }
</style>

<div class="animated fadeInDown" id="printbutton">
    <center>
        <a href="report_employees.php" class="btn btn-warning text-white btn-w100 btn-round">Back</a>
        <a href='update_emp.php?id=<?php echo $id; ?>' class="btn btn-primary btn-w100 btn-round">Update</a> 
        <a href="" class="btn btn-success btn-w100 btn-round">Print</a>
        <!-- <button class="btn btn-danger btn-fill"onclick="printDiv('printableArea')" style="margin-bottom:5px;width:80px;"></span> Print</button><br> -->
    </center>
</div>
<page size="A4">
    <?php                           
        $query = mysqli_query($con, "SELECT * FROM personal_data pd LEFT JOIN family_background fb ON fb.personal_id = pd.personal_id LEFT JOIN educational_background eb ON eb.personal_id = pd.personal_id LEFT JOIN additional_info ai ON ai.personal_id = pd.personal_id LEFT JOIN person_to_contact pc ON pc.personal_id = pd.personal_id LEFT JOIN position ps ON ps.personal_id = pd.personal_id WHERE pd.personal_id = '$id'")or die(mysqli_error($con));
        $row = mysqli_fetch_array($query);
    ?>
    <div class="m-t-20 m-b-20 m-l-20 m-r-20">
        <br id="br">
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
                    <center>
                        <h5 style="color:green"><b>CENTRAL NEGROS POWER RELIABILITY, INC.</b></h5>
                        <div style="border:1px solid #999;width: 500px;margin-bottom: 15px">
                            <h6 class="m-b-0"><b>APPLICATION FOR EMPLOYMENT</b></h6>
                        </div>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="4"><b>POSITION APPLIED FOR:</b></td>
                <td colspan="6" class="bor-btm font-12">
                    <b>
                    <?php if(empty($row['position_applied'])){
                        echo "<br>";
                    }else{
                        echo $row['position_applied'];
                    }                            
                    ?>                    
                    </b>
                </td>
                <td colspan="3"><b class="m-l-5"> DATE APPLIED:</b></td>
                <td colspan="7" class="bor-btm font-12"></td>
            </tr>
            <tr>
                <td colspan="4"><b>EXPECTED SALARY:</b></td>
                <td colspan="6" class="bor-btm font-12"></td>
                <td colspan="3"><b class="m-l-5"> DATE AVAILABLE:</b></td>
                <td colspan="7" class="bor-btm font-12"></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="20" class="bor-all"><strong>PERSONAL DATA:</strong></td>
            </tr>
            <tr>
                <td class="font-12" colspan="4"><b></b></td>
                <td class="font-12" colspan="4"><b></b></td>
                <td class="font-12" colspan="4"><b></b></td>
                <td class="bor-right font-12" colspan="2"><b></b></td>
                <td class="bor-right font-12" colspan="1" align="center"><b>99</b></td>
                <td class="bor-right font-12" colspan="2" align="center"><b>Female<br></b></td>
                <td class="font-12" colspan="3" align="center"><b>Widow/Widower</b></td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="4">LAST NAME</td>
                <td class="bor-btm" colspan="4">FIRST NAME</td>
                <td class="bor-btm" colspan="4">MIDDLE NAME</td>
                <td class="bor-btm bor-right" colspan="2">NAME EXT </td>
                <td class="bor-btm bor-right" colspan="1" align="center">AGE</td>
                <td class="bor-btm bor-right" colspan="2" align="center">SEX</td>
                <td class="bor-btm" colspan="3" align="center">CIVIL STATUS</td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20">PRESENT ADDRESS:<b><span class="font-12"> asdsda</span></b></td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20">PERMANENT/HOME ADDRESS:<b><span class="font-12"> asdsda</span></b></td>
            </tr>
            <tr>
                <td class="bor-right font-12" colspan="4" align="center"><b>September 09,2020</b></td>
                <td class="bor-right font-12" colspan="4" align="center"><b></b></td>
                <td class="bor-right font-12" colspan="4" align="center"><b></b></td>
                <td class="bor-right font-12" colspan="4" align="center"><b></b></td>
                <td class="font-12" colspan="4" align="center"><b></b></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="4" align="center">DATE OF BIRTH</td>
                <td class="bor-right" colspan="4" align="center">PLACE OF BIRTH</td>
                <td class="bor-right" colspan="4" align="center">CONTACT NUMBER</td>
                <td class="bor-right" colspan="4" align="center">NATIONALITY</td>
                <td class="" colspan="4" align="center">RELIGION</td>
            </tr>
            <tr>
                <td colspan="20" class="bor-all"><strong>FAMILY BACKGROUND:</strong></td>
            </tr>
            <tr>
                <td class="bor-right font-12" colspan="8"><b><?php echo sanitize(utf8_encode($row['father_name']));?></b></td>
                <td class="bor-right font-12" colspan="3"><b><?php echo (!empty($row['fa_bday'])) ? $row['fa_bday'] : '';?></b></td>
                <td class="bor-right font-12" colspan="1"><b></b></td>
                <td class="font-12" colspan="8"><b></b></td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="8">FATHER'S NAME</td>
                <td class="bor-btm bor-right" colspan="3">BIRTHDATE</td>
                <td class="bor-btm bor-right" colspan="1">AGE</td>
                <td class="bor-btm " colspan="8">OCCUPATION</td>
            </tr>
            <tr>
                <td class="font-12 bor-right" colspan="8"><b><br></b></td>
                <td class="font-12 bor-right" colspan="3"><b></b></td>
                <td class="bor-right" colspan="1"><b></b></td>
                <td class="font-12 " colspan="8"><b></b></td>
            </tr>        
            <tr>
                <td class="bor-btm bor-right" colspan="8">MOTHER'S NAME</td>
                <td class="bor-btm bor-right" colspan="3">BIRTHDATE</td>            
                <td class="bor-btm bor-right" colspan="1">AGE</td>
                <td class="bor-btm " colspan="8">OCCUPATION</td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20" align="center">NAME OF SIBLING/S (with Age & Occupation)</td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="6" align="center">NAME</td>
                <td class="bor-right bor-btm" colspan="3" align="center">BIRTHDATE</td>
                <td class="bor-right bor-btm" colspan="1" align="center">AGE</td>
                <td class="bor-right bor-btm" colspan="5" align="center">OCCUPATION</td>
                <td class="bor-right bor-btm" colspan="5" align="center">EMPLOYER</td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center">asd</td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center">asd</td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center">asd</td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center">asd</td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center">asd</td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center">asd</td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="font-12 bor-right" colspan="7"><b>as</b></td>
                <td class="font-12 bor-right" colspan="1"><b>as</b></td>
                <td class="font-12 bor-right" colspan="6"><b>as</b></td> 
                <td class="font-12 bor-right" colspan="6"><b>as</b></td>            
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="7">NAME OF SPOUSE(If married)</td>
                <td class="bor-btm bor-right" colspan="1">AGE</td>
                <td class="bor-btm bor-right" colspan="6">OCCUPATION</td> 
                <td class="bor-btm bor-right" colspan="6">EMPLOYER'S NAME & ADDRESS</td>            
            </tr>
            <tr>
                <td class="bor-btm" colspan="20" align="center">NAME OF CHILDREN (with Birthdate)</td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="6" align="center">NAME</td>
                <td class="bor-right bor-btm" colspan="3" align="center">BIRTHDATE</td>
                <td class="bor-right bor-btm" colspan="1" align="center">AGE</td>
                <td class="bor-right bor-btm" colspan="5" align="center">OCCUPATION</td>
                <td class="bor-right bor-btm" colspan="5" align="center">EMPLOYER</td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center">asd</td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center">asd</td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center">asd</td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center">asd</td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center">asd</td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center">asd</td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td colspan="20" class="bor-all"><strong>EDUCATIONAL BACKGROUND:</strong></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="12">COLLEGE: <b>as</b></td>
                <td class="bor-btm bor-right" colspan="4">FROM: <b>as</b></td>
                <td class="bor-btm bor-right" colspan="4">TO: <b>as</b></td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="12">COURSE: <b>as</b></td>
                <td class="bor-btm bor-right" colspan="8">DATE GRADUATED: <b>as</b></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="12">HIGH SCHOOL: <b>as</b></td>
                <td class="bor-btm bor-right" colspan="4">FROM: <b>as</b></td>
                <td class="bor-btm bor-right" colspan="4">TO: <b>as</b></td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="12">COURSE: <b>as</b></td>
                <td class="bor-btm bor-right" colspan="8">DATE GRADUATED: <b>as</b></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="12">ELEMENTARY: <b>as</b></td>
                <td class="bor-btm bor-right" colspan="4">FROM: <b>as</b></td>
                <td class="bor-btm bor-right" colspan="4">TO: <b>as</b></td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="12">COURSE: <b>as</b></td>
                <td class="bor-btm bor-right" colspan="8">DATE GRADUATED: <b>as</b></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="12">POST GRAD/ VOCATIONAL: <b>as</b></td>
                <td class="bor-btm bor-right" colspan="4">FROM: <b>as</b></td>
                <td class="bor-btm bor-right" colspan="4">TO: <b>as</b></td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="12">COURSE: <b>as</b></td>
                <td class="bor-btm bor-right" colspan="8">DATE GRADUATED: <b>as</b></td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20" align="center">EMPLOYMENT HISTORY (FROM RECENT TO PAST)</td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center">NAME/ADDRESS OF EMPLOYER</td>
                <td class="bor-right bor-btm" colspan="5" align="center">POSITION</td>
                <td class="bor-right bor-btm" colspan="2" align="center">FROM</td>
                <td class="bor-right bor-btm" colspan="2" align="center">TO</td>
                <td class="bor-right bor-btm" colspan="3" align="center">REAMARKS</td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center"></td>
                <td class="bor-right bor-btm" colspan="5" align="center"></td>
                <td class="bor-right bor-btm" colspan="2" align="center">Sept 2020</td>
                <td class="bor-right bor-btm" colspan="2" align="center"></td>
                <td class="bor-right bor-btm" colspan="3" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center"></td>
                <td class="bor-right bor-btm" colspan="5" align="center"></td>
                <td class="bor-right bor-btm" colspan="2" align="center">Sept 2020</td>
                <td class="bor-right bor-btm" colspan="2" align="center"></td>
                <td class="bor-right bor-btm" colspan="3" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center"></td>
                <td class="bor-right bor-btm" colspan="5" align="center"></td>
                <td class="bor-right bor-btm" colspan="2" align="center">Sept 2020</td>
                <td class="bor-right bor-btm" colspan="2" align="center"></td>
                <td class="bor-right bor-btm" colspan="3" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center"></td>
                <td class="bor-right bor-btm" colspan="5" align="center"></td>
                <td class="bor-right bor-btm" colspan="2" align="center">Sept 2020</td>
                <td class="bor-right bor-btm" colspan="2" align="center"></td>
                <td class="bor-right bor-btm" colspan="3" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center"></td>
                <td class="bor-right bor-btm" colspan="5" align="center"></td>
                <td class="bor-right bor-btm" colspan="2" align="center">Sept 2020</td>
                <td class="bor-right bor-btm" colspan="2" align="center"></td>
                <td class="bor-right bor-btm" colspan="3" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center"></td>
                <td class="bor-right bor-btm" colspan="5" align="center"></td>
                <td class="bor-right bor-btm" colspan="2" align="center">Sept 2020</td>
                <td class="bor-right bor-btm" colspan="2" align="center"></td>
                <td class="bor-right bor-btm" colspan="3" align="center"></td>
            </tr>  
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center"></td>
                <td class="bor-right bor-btm" colspan="5" align="center"></td>
                <td class="bor-right bor-btm" colspan="2" align="center">Sept 2020</td>
                <td class="bor-right bor-btm" colspan="2" align="center"></td>
                <td class="bor-right bor-btm" colspan="3" align="center"></td>
            </tr>          
        </table>
    </div>
</page>
<page size="A4">
    <div class="m-t-20 m-b-20 m-l-20 m-r-20">
        <br id="br1">
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
                <td colspan="20" class="bor-btm"><strong>ADDITIONAL INFORMATION DATA:</strong></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="5"><b>s</b></td>
                <td class="bor-right" colspan="5"><b></b></td>
                <td class="bor-right" colspan="5"><b></b></td>
                <td class="bor-right" colspan="5"><b></b></td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="5">TIN</td>
                <td class="bor-btm bor-right" colspan="5">SSS</td>
                <td class="bor-btm bor-right" colspan="5">PHILHEALTH</td>
                <td class="bor-btm bor-right" colspan="5">PAG-IBIG (HDMF)</td>
            </tr>
            <tr>
                <td class="bor-right" colspan="5"><b>s</b></td>
                <td class="bor-right" colspan="5"><b></b></td>
                <td class="bor-right" colspan="10"><b></b></td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="5">HEIGHT</td>
                <td class="bor-btm bor-right" colspan="5">WEIGHT</td>
                <td class="bor-btm bor-right" colspan="10">TYPES OF DIALECT SPOKEN/ CAN UNDERSTAND</td>
            </tr>
            <tr>
                <td class="bor-right" colspan="7"><b>s</b></td>
                <td class="bor-right" colspan="7"><b></b></td>
                <td class="bor-right" colspan="6"><b></b></td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="7">DO YOU HAVE DRIVER'S LICENSE</td>
                <td class="bor-btm bor-right" colspan="7">DATE ISSUED/ LICENSE NUMBER</td>
                <td class="bor-btm bor-right" colspan="6">SPECIAL SKILLS</td>
            </tr>
            <tr>
                <td class="" colspan="20">HAVE YOU EVER BEEN HOSPITALIZED? WHAT MAJOR ILLNESS?<br></td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20"><b><br></b></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="5"><b></b></td>
                <td class="bor-right" colspan="15"><b></b></td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="7">DO YOU OWN A BUSINESS?: <b></b></td>
                <td class="bor-btm bor-right" colspan="13">NATURE OF BUSINESS: <b></b></td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20"><b>CHARACTER REFERENCE:</b></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="5" align="center">NAME </td>
                <td class="bor-right bor-btm" colspan="5" align="center">EMPLOYER</td>
                <td class="bor-right bor-btm" colspan="4" align="center">POSITION</td>
                <td class="bor-right bor-btm" colspan="3" align="center">RELATIONSHIP</td>
                <td class="bor-right bor-btm" colspan="3" align="center">09668664192</td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b><br></td>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="4" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
            </tr> 
            <tr>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b><br></td>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="4" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
            </tr>        
            <tr>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b><br></td>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="4" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
            </tr> 
            <tr>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b><br></td>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="4" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
            </tr> 
            <tr>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b><br></td>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="4" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
            </tr> 
            <tr>
                <td class="bor-btm" colspan="20"><b>SKETCH LOCATION OF RESIDENCE GOING TO OFFICE</b></td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20">
                    <div style="height: 350px"></div>
                </td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20"><b>PERSON TO CONTACT INCASE OF EMERGENCY:</b></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="6"><b><br></b></td>
                <td class="bor-right" colspan="5"><b></b></td>
                <td class="bor-right" colspan="3"><b></b></td>
                <td class="bor-right" colspan="6"><b></b></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="6">NAME</td>
                <td class="bor-right bor-btm" colspan="5">RELATIONSHIP</td>
                <td class="bor-right bor-btm" colspan="3">CONTACT NUMBER</td>
                <td class="bor-right bor-btm" colspan="6">ADDRESS</td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="3"></td>
                <td class="bor-btm" colspan="14" align="center">
                    <br>I HERBY CERTIFY THAT THE INFORMATION GIVEN IS TRUE AND CORRECT AND THAT IT HAS BEEN AMDE IN GOOD FAITH TO THE BEST OF MY KNOWLEDGE AND BELIEF.
                    <br>
                    <br>
                </td> 
                <td class="bor-btm" colspan="3"></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="10"><br></td> 
                <td class="bor-right" colspan="10"></td> 
            </tr>
            <tr>
                <td class="bor-right" colspan="10">PRINTED NAME & SIGNATURE</td> 
                <td class="bor-right" colspan="10">DATE </td> 
            </tr>
        </table>
        <div style="text-align: right;width: 100%"><small>HRFORMS061713</small></div>
    </div>
</page>

<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script src="assets/js/demo.js"></script> 
    

</html>
