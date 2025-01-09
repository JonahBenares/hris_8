<?php
    include('../includes/connection.php'); 
    if(isset($_POST["eval_id"])){
        $output = '';
        $query = "SELECT * FROM evaluation WHERE personal_id = '".$_POST["personal_id"]."' AND eval_id = '".$_POST["eval_id"]."'";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_array($result)){
            $output .= '<div>'.$row['eval_period'].'</div>
                <img src="../uploads/'.$row["eval_file"].'" style="width:100%" alt="">';
            $query_1 = "SELECT eval_id,personal_id FROM evaluation WHERE personal_id = '".$_POST["personal_id"]."' AND eval_id < '".$_POST['eval_id']."' ORDER BY eval_id DESC LIMIT 1";
            $result_1 = mysqli_query($con, $query_1);
            $data_1 = mysqli_fetch_assoc($result_1);
            $query_2 = "SELECT eval_id,personal_id FROM evaluation WHERE personal_id = '".$_POST["personal_id"]."' AND eval_id > '".$_POST['eval_id']."' ORDER BY eval_id ASC LIMIT 1";
            $result_2 = mysqli_query($con, $query_2);
            $data_2 = mysqli_fetch_assoc($result_2);
            $if_previous_disable = '';
            $if_next_disable = '';
            if($data_1["eval_id"] == ""){
                $if_previous_disable = 'disabled';
            }
            if($data_2["eval_id"] == ""){
                $if_next_disable = 'disabled';
            }
            $output .= '
            <br /><br />
            <div align="center">
            <button type="button" name="previous" class="btn btn-warning btn-sm previouseval" id="'.$data_1["eval_id"].'" data-personal = "'.$data_1["personal_id"].'" '.$if_previous_disable.'>Previous</button>
            <button type="button" name="next" class="btn btn-warning btn-sm nexteval" id="'.$data_2["eval_id"].'" data-personal = "'.$data_2["personal_id"].'" '.$if_next_disable.'>Next</button>
            </div>
            <br /><br />
            ';
        }
        echo $output;
    }
?>