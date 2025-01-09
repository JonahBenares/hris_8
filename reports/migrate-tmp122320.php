<?php
include '../includes/connection.php';
if(!empty($_POST["id"])) {
		$id = $_POST['id'];
		$gettmp_pd = $con->query("SELECT * FROM tmp_table WHERE personal_id = '$id'");
		$rows_tmp = $gettmp_pd->num_rows;
		//echo json_encode($rows_tmp);
		if($rows_tmp!=0){
			
			$fetch_pd = $gettmp_pd->fetch_array();
			$query="UPDATE personal_data SET ";
				if(!empty($fetch_pd['status'])) $query .= "status = '$fetch_pd[status]', ";
				if(!empty($fetch_pd['emp_status'])) $query .= "emp_status = '$fetch_pd[emp_status]', ";
				if(!empty($fetch_pd['email']))  $query .= "email = '$fetch_pd[email]', ";
				if(!empty($fetch_pd['emp_num'])) $query .= "emp_num = '$fetch_pd[emp_num]', ";
				if(!empty($fetch_pd['date_hired'])) $query .= "date_hired = '$fetch_pd[date_hired]', ";
				if(!empty($fetch_pd['bio_num'])) $query .= "bio_num = '$fetch_pd[bio_num]', ";
				if(!empty($fetch_pd['date_separated'])) $query .= "date_separated = '$fetch_pd[date_separated]', ";
				$query=substr($query, 0, -2);
				$query .= " WHERE personal_id = '$id'";
				
				$update=$con->query($query);
			
		}

		$gettmp_jh = $con->query("SELECT * FROM job_history_tmp WHERE personal_id = '$id'");
		$rows_jh = $gettmp_jh->num_rows;
		if($rows_jh!=0){
			while($fetch_jh = $gettmp_jh->fetch_array()){
				$insertjh = $con->query("INSERT INTO job_history (personal_id, effective_date, emp_status, j_position, department_id, bu_id, location_id, salary, per_day, supervisor, end_date) VALUES ('$fetch_jh[personal_id]', '$fetch_jh[effective_date]', '$fetch_jh[emp_status]','$fetch_jh[j_position]', '$fetch_jh[department_id]', '$fetch_jh[bu_id]', '$fetch_jh[location_id]', '$fetch_jh[salary]', '$fetch_jh[per_day]', '$fetch_jh[supervisor]', '$fetch_jh[end_date]')");

				/*$update = $con->query("UPDATE personal_data SET current_dept = '$fetch_jh[department_id]', current_bu = '$fetch_jh[bu_id]', currenct_location = '$fetch_jh[location_id]', current_supervisor = '$fetch_jh[supervisor]' WHERE personal_id = '$fetch_jh[personal_id]'");*/
			}

		}

		$getlatestjob=$con->query("SELECT department_id, bu_id, location_id, supervisor FROM job_history_tmp WHERE personal_id = '$id' ORDER BY effective_date DESC LIMIT 1");
		$fetchJob = $getlatestjob->fetch_array();
		$update = "UPDATE personal_data SET ";
			if(!empty($fetchJob['department_id'])) $update .= "current_dept = '$fetchJob[department_id]', ";
			if(!empty($fetchJob['bu_id'])) $update .= "current_bu = '$fetchJob[bu_id]', ";
			if(!empty($fetchJob['location_id']))  $update .= "current_location = '$fetchJob[location_id]', ";
			if(!empty($fetchJob['supervisor']))  $update .= "current_supervisor = '$fetchJob[supervisor]', ";
			$update=substr($update, 0, -2);
			$update .= "  WHERE personal_id = '$id'";

			//echo $update;
			$runupdate=$con->query($update);
				


		$gettmp_eh = $con->query("SELECT * FROM evaluation_history_tmp WHERE personal_id = '$id'");
		$rows_eh = $gettmp_eh->num_rows;
		if($rows_eh!=0){
			while($fetch_eh = $gettmp_eh->fetch_array()){
				$inserteh = $con->query("INSERT INTO evaluation_history (personal_id, eval_date, score, eval_type, adjustment, per_day, effective_date) VALUES ('$fetch_eh[personal_id]', '$fetch_eh[eval_date]', '$fetch_eh[score]', '$fetch_eh[eval_type]', '$fetch_eh[adjustment]', '$fetch_eh[per_day]', '$fetch_eh[effective_date]')");
			}

		}

		$gettmp_al = $con->query("SELECT * FROM allowance_tmp WHERE personal_id = '$id'");
		$rows_al = $gettmp_al->num_rows;
		if($rows_al!=0){
			while($fetch_al = $gettmp_al->fetch_array()){
				$insertal = $con->query("INSERT INTO allowance (personal_id, description, amount) VALUES ('$fetch_al[personal_id]', '$fetch_al[description]', '$fetch_al[amount]')");
			}

		}

		$gettmp_dp = $con->query("SELECT * FROM disciplinary_action_tmp WHERE personal_id = '$id'");
		$rows_dp = $gettmp_dp->num_rows;
		if($rows_dp!=0){
			while($fetch_dp = $gettmp_dp->fetch_array()){
				$insertal = $con->query("INSERT INTO disciplinary_action (personal_id, offense_date, offense_type, offense_no, offense_desc, disp_action) VALUES ('$fetch_dp[personal_id]', '$fetch_dp[offense_date]', '$fetch_dp[offense_type]', '$fetch_dp[offense_no]', '$fetch_dp[offense_desc]', '$fetch_dp[disp_action]')");
			}

		}

		$gettmp_rem = $con->query("SELECT * FROM reminders_tmp WHERE personal_id = '$id'");
		$rows_rem = $gettmp_rem->num_rows;
		if($rows_rem!=0){
			while($fetch_rem = $gettmp_rem->fetch_array()){
				$insertrem = $con->query("INSERT INTO reminders (personal_id, reminder_date, notes) VALUES ('$fetch_rem[personal_id]', '$fetch_rem[reminder_date]', '$fetch_rem[notes]')");
			}

		}


		$deletePD = $con->query("DELETE FROM tmp_table WHERE personal_id = '$id'");
		$deleteJH = $con->query("DELETE FROM job_history_tmp WHERE personal_id = '$id'");
		$deleteEH = $con->query("DELETE FROM evaluation_history_tmp WHERE personal_id = '$id'");
		$deleteAL = $con->query("DELETE FROM allowance_tmp WHERE personal_id = '$id'");
		$deleteDA = $con->query("DELETE FROM disciplinary_action_tmp WHERE personal_id = '$id'");
		$deleteREM = $con->query("DELETE FROM reminders_tmp WHERE personal_id = '$id'");
	}

?>