<?php
    include('../includes/connection.php'); 
    if(isset($_POST["other_id"])){
        $output = '';
        $query = "SELECT * FROM other_files WHERE personal_id = '".$_POST["personal_id"]."' AND other_id = '".$_POST["other_id"]."'";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_array($result)){
            $output .= '<div>'.$row['other_name'].'</div>
                <img src="../uploads/'.$row["other_file"].'" style="width:100%" alt="">';
            $query_1 = "SELECT other_id,personal_id FROM other_files WHERE personal_id = '".$_POST["personal_id"]."' AND other_id < '".$_POST['other_id']."' ORDER BY other_id DESC LIMIT 1";
            $result_1 = mysqli_query($con, $query_1);
            $data_1 = mysqli_fetch_assoc($result_1);
            $query_2 = "SELECT other_id,personal_id FROM other_files WHERE personal_id = '".$_POST["personal_id"]."' AND other_id > '".$_POST['other_id']."' ORDER BY other_id ASC LIMIT 1";
            $result_2 = mysqli_query($con, $query_2);
            $data_2 = mysqli_fetch_assoc($result_2);
            $if_previous_disable = '';
            $if_next_disable = '';
            if($data_1["other_id"] == ""){
                $if_previous_disable = 'disabled';
            }
            if($data_2["other_id"] == ""){
                $if_next_disable = 'disabled';
            }
            $output .= '
            <br /><br />
            <div align="center">
            <button type="button" name="previous" class="btn btn-warning btn-sm previousother" id="'.$data_1["other_id"].'" data-personal = "'.$data_1["personal_id"].'" '.$if_previous_disable.'>Previous</button>
            <button type="button" name="next" class="btn btn-warning btn-sm nextother" id="'.$data_2["other_id"].'" data-personal = "'.$data_2["personal_id"].'" '.$if_next_disable.'>Next</button>
            </div>
            <br /><br />
            ';
        }
        echo $output;
    }
?>