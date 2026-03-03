<?php
include '../includes/connection.php';

if(!empty($_POST["id"])) {
    $id = $con->real_escape_string($_POST['id']); // sanitize

    // Start transaction
    $con->begin_transaction();

    try {
        // 1️⃣ Update personal_data from tmp_table (only non-empty columns)
        $gettmp_pd = $con->query("SELECT * FROM tmp_table WHERE personal_id = '$id'");
        if($gettmp_pd->num_rows > 0) {
            $fetch_pd = $gettmp_pd->fetch_assoc();
            $updateFields = [];

            if(!empty($fetch_pd['status'])) $updateFields[] = "status = '".$con->real_escape_string($fetch_pd['status'])."'";
            if(!empty($fetch_pd['emp_status'])) $updateFields[] = "emp_status = '".$con->real_escape_string($fetch_pd['emp_status'])."'";
            if(!empty($fetch_pd['email'])) $updateFields[] = "email = '".$con->real_escape_string($fetch_pd['email'])."'";
            if(!empty($fetch_pd['emp_num'])) $updateFields[] = "emp_num = '".$con->real_escape_string($fetch_pd['emp_num'])."'";
            if(!empty($fetch_pd['date_hired'])) $updateFields[] = "date_hired = '".$con->real_escape_string($fetch_pd['date_hired'])."'";
            if(!empty($fetch_pd['bio_num'])) $updateFields[] = "bio_num = '".$con->real_escape_string($fetch_pd['bio_num'])."'";
            if(!empty($fetch_pd['date_separated'])) $updateFields[] = "date_separated = '".$con->real_escape_string($fetch_pd['date_separated'])."'";

            if(!empty($updateFields)){
                $con->query("UPDATE personal_data SET ".implode(", ", $updateFields)." WHERE personal_id = '$id'");
            }
        }

        // 2️⃣ Insert job_history in bulk
        $con->query("
            INSERT INTO job_history (personal_id, effective_date, emp_status, j_position, department_id, bu_id, location_id, salary, per_day, supervisor, end_date)
            SELECT personal_id, effective_date, emp_status, j_position, department_id, bu_id, location_id, salary, per_day, supervisor, end_date
            FROM job_history_tmp
            WHERE personal_id = '$id'
        ");

        // Update latest job info in personal_data
        $getlatestjob = $con->query("
            SELECT department_id, bu_id, location_id, supervisor
            FROM job_history_tmp
            WHERE personal_id = '$id'
            ORDER BY effective_date DESC
            LIMIT 1
        ");
        if($getlatestjob->num_rows > 0){
            $fetchJob = $getlatestjob->fetch_assoc();
            $updateJobFields = [];
            if(!empty($fetchJob['department_id'])) $updateJobFields[] = "current_dept = '".$con->real_escape_string($fetchJob['department_id'])."'";
            if(!empty($fetchJob['bu_id'])) $updateJobFields[] = "current_bu = '".$con->real_escape_string($fetchJob['bu_id'])."'";
            if(!empty($fetchJob['location_id'])) $updateJobFields[] = "current_location = '".$con->real_escape_string($fetchJob['location_id'])."'";
            if(!empty($fetchJob['supervisor'])) $updateJobFields[] = "current_supervisor = '".$con->real_escape_string($fetchJob['supervisor'])."'";
            if(!empty($fetchJob['bu_id'])) $updateJobFields[] = "applied_company = '".$con->real_escape_string($fetchJob['bu_id'])."'";

            if(!empty($updateJobFields)){
                $con->query("UPDATE personal_data SET ".implode(", ", $updateJobFields)." WHERE personal_id = '$id'");
            }
        }

        // 3️⃣ Bulk insert evaluation_history
        $con->query("
            INSERT INTO evaluation_history (personal_id, eval_date, score, eval_type, adjustment, per_day, effective_date)
            SELECT personal_id, eval_date, score, eval_type, adjustment, per_day, effective_date
            FROM evaluation_history_tmp
            WHERE personal_id = '$id'
        ");

        // 4️⃣ Bulk insert allowance
        $con->query("
            INSERT INTO allowance (personal_id, description, amount)
            SELECT personal_id, description, amount
            FROM allowance_tmp
            WHERE personal_id = '$id'
        ");

        // 5️⃣ Bulk insert disciplinary_action
        $con->query("
            INSERT INTO disciplinary_action (personal_id, offense_date, offense_type, offense_no, offense_desc, disp_action)
            SELECT personal_id, offense_date, offense_type, offense_no, offense_desc, disp_action
            FROM disciplinary_action_tmp
            WHERE personal_id = '$id'
        ");

        // 6️⃣ Bulk insert reminders
        $con->query("
            INSERT INTO reminders (personal_id, reminder_date, notes)
            SELECT personal_id, reminder_date, notes
            FROM reminders_tmp
            WHERE personal_id = '$id'
        ");

        // 7️⃣ Delete tmp tables in bulk
        $tmpTables = ['tmp_table','job_history_tmp','evaluation_history_tmp','allowance_tmp','disciplinary_action_tmp','reminders_tmp'];
        foreach($tmpTables as $table){
            $con->query("DELETE FROM $table WHERE personal_id = '$id'");
        }

        // Commit transaction
        $con->commit();

        echo "success";

    } catch(Exception $e){
        $con->rollback();
        http_response_code(500);
        echo "Error: ".$e->getMessage();
    }
}
?>