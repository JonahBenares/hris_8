<?php
include '../includes/connection.php';

foreach ($_POST as $var => $value) {
    $$var = $value;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

$height_esc = isset($_POST['height']) ? mysqli_real_escape_string($con, $_POST['height']) : '';
$weight_esc = isset($_POST['weight']) ? mysqli_real_escape_string($con, $_POST['weight']) : '';

$permanent_address_esc = mysqli_real_escape_string($con, isset($_POST['permanent_address']) ? $_POST['permanent_address'] : '');
$provincial_address_esc = mysqli_real_escape_string($con, isset($_POST['provincial_address']) ? $_POST['provincial_address'] : '');
$place_birth_esc = mysqli_real_escape_string($con, isset($_POST['place_birth']) ? $_POST['place_birth'] : '');
$religion_esc = mysqli_real_escape_string($con, isset($_POST['religion']) ? $_POST['religion'] : '');
$occupation_esc = mysqli_real_escape_string($con, isset($_POST['occupation']) ? $_POST['occupation'] : '');
$m_occupation_esc = mysqli_real_escape_string($con, isset($_POST['m_occupation']) ? $_POST['m_occupation'] : '');
$n_occupation_esc = mysqli_real_escape_string($con, isset($_POST['n_occupation']) ? $_POST['n_occupation'] : '');
$employers_name_address_esc = mysqli_real_escape_string($con, isset($_POST['employers_name_address']) ? $_POST['employers_name_address'] : '');
$college_esc = mysqli_real_escape_string($con, isset($_POST['college']) ? $_POST['college'] : '');
$highschool_esc = mysqli_real_escape_string($con, isset($_POST['highschool']) ? $_POST['highschool'] : '');
$elementary_esc = mysqli_real_escape_string($con, isset($_POST['elementary']) ? $_POST['elementary'] : '');
$post_grad_esc = mysqli_real_escape_string($con, isset($_POST['post_grad']) ? $_POST['post_grad'] : '');


/* =========================================================
   POSITION
   ========================================================= */

mysqli_query($con, "
    UPDATE position
    SET
        position_applied = '$position_applied',
        sal_from = '$sal_from',
        sal_to = '$sal_to',
        date_applied = '$date_applied',
        date_available = '$date_available'
    WHERE personal_id = '$id'
") or die(mysqli_error($con));


/* =========================================================
   PERSONAL DATA
   ========================================================= */

mysqli_query($con, "
    UPDATE personal_data
    SET
        lname = '$lname',
        fname = '$fname',
        mname = '$mname',
        name_ext = '$name_ext',
        sex = '$sex',
        civil_status = '$civil_status',
        permanent_address = '$permanent_address_esc',
        provincial_address = '$provincial_address_esc',
        pre_city = '$pre_city',
        pre_prov = '$pre_prov',
        perm_city = '$perm_city',
        perm_prov = '$perm_prov',
        bdate = '$bdate',
        place_birth = '$place_birth_esc',
        contact_no = '$contact_no',
        nationality = '$nationality',
        religion = '$religion_esc',
        applied_company = '$company',
        emp_status = '$emp_status',
        status = '$status'
    WHERE personal_id = '$id'
") or die(mysqli_error($con));


/* =========================================================
   FAMILY BACKGROUND
   ========================================================= */

mysqli_query($con, "
    UPDATE family_background
    SET
        father_name = '$father_name',
        fa_bday = '$fa_bday',
        occupation = '$occupation_esc',
        mother_name = '$mother_name',
        m_bday = '$m_bday',
        m_occupation = '$m_occupation_esc',
        name_spouse = '$name_spouse',
        n_bday = '$n_bday',
        n_occupation = '$n_occupation_esc',
        employers_name_address = '$employers_name_address_esc'
    WHERE personal_id = '$id'
") or die(mysqli_error($con));


/* =========================================================
   SIBLINGS
   ========================================================= */

$sql = mysqli_query($con, "
    SELECT * FROM siblings
    WHERE personal_id = '$id'
") or die(mysqli_error($con));

$row = mysqli_num_rows($sql);
$siblings_name = isset($_POST['siblings_name']) ? $_POST['siblings_name'] : array();
$siblings_bday = isset($_POST['siblings_bday']) ? $_POST['siblings_bday'] : array();
$siblings_occupation = isset($_POST['siblings_occupation']) ? $_POST['siblings_occupation'] : array();
$emp_na_add = isset($_POST['emp_na_add']) ? $_POST['emp_na_add'] : array();
$siblings_id = isset($_POST['siblings_id']) ? $_POST['siblings_id'] : array();

$ctrx1 = count($siblings_name);

if ($row == $ctrx1) {
    for ($x = 0; $x < $ctrx1; $x++) {
        $siboccupation_esc = mysqli_real_escape_string($con, isset($siblings_occupation[$x]) ? $siblings_occupation[$x] : '');
        $emp_na_add_esc = mysqli_real_escape_string($con, isset($emp_na_add[$x]) ? $emp_na_add[$x] : '');

        $sibname = mysqli_real_escape_string($con, isset($siblings_name[$x]) ? $siblings_name[$x] : '');
        $sibday = mysqli_real_escape_string($con, isset($siblings_bday[$x]) ? $siblings_bday[$x] : '');
        $sibids = isset($siblings_id[$x]) ? (int)$siblings_id[$x] : 0;

        if (trim($sibname) != '') {
            mysqli_query($con, "
                UPDATE siblings
                SET
                    siblings_name = '$sibname',
                    siblings_bday = '$sibday',
                    siblings_occupation = '$siboccupation_esc',
                    emp_na_add = '$emp_na_add_esc'
                WHERE personal_id = '$id'
                AND siblings_id = '$sibids'
            ") or die(mysqli_error($con));
        }
    }
} else {
    for ($x = 0; $x < $ctrx1; $x++) {
        $sibname = mysqli_real_escape_string($con, isset($siblings_name[$x]) ? $siblings_name[$x] : '');
        $sibday = mysqli_real_escape_string($con, isset($siblings_bday[$x]) ? $siblings_bday[$x] : '');
        $siboccupation_esc = mysqli_real_escape_string($con, isset($siblings_occupation[$x]) ? $siblings_occupation[$x] : '');
        $emp_na_add_esc = mysqli_real_escape_string($con, isset($emp_na_add[$x]) ? $emp_na_add[$x] : '');
        $sibids = isset($siblings_id[$x]) ? (int)$siblings_id[$x] : 0;

        if (trim($sibname) != '') {
            $select = mysqli_query($con, "
                SELECT siblings_id FROM siblings
                WHERE siblings_id = '$sibids'
                AND personal_id = '$id'
            ") or die(mysqli_error($con));

            if (mysqli_num_rows($select) > 0) {
                mysqli_query($con, "
                    UPDATE siblings
                    SET
                        siblings_name = '$sibname',
                        siblings_bday = '$sibday',
                        siblings_occupation = '$siboccupation_esc',
                        emp_na_add = '$emp_na_add_esc'
                    WHERE personal_id = '$id'
                    AND siblings_id = '$sibids'
                ") or die(mysqli_error($con));
            } else {
                mysqli_query($con, "
                    INSERT INTO siblings
                        (personal_id, siblings_name, siblings_bday, siblings_occupation, emp_na_add)
                    VALUES
                        ('$id', '$sibname', '$sibday', '$siboccupation_esc', '$emp_na_add_esc')
                ") or die(mysqli_error($con));
            }
        }
    }
}


/* =========================================================
   CHILDREN
   ========================================================= */

$sql1 = mysqli_query($con, "
    SELECT * FROM children
    WHERE personal_id = '$id'
") or die(mysqli_error($con));

$row2 = mysqli_num_rows($sql1);
$child_name = isset($_POST['child_name']) ? $_POST['child_name'] : array();
$child_bday = isset($_POST['child_bday']) ? $_POST['child_bday'] : array();
$children_id = isset($_POST['children_id']) ? $_POST['children_id'] : array();

$ctrx2 = count($child_name);

if ($row2 == $ctrx2) {
    for ($x1 = 0; $x1 < $ctrx2; $x1++) {
        $chiname = mysqli_real_escape_string($con, isset($child_name[$x1]) ? $child_name[$x1] : '');
        $chibday = mysqli_real_escape_string($con, isset($child_bday[$x1]) ? $child_bday[$x1] : '');
        $chiids = isset($children_id[$x1]) ? (int)$children_id[$x1] : 0;

        if (trim($chiname) != '') {
            mysqli_query($con, "
                UPDATE children
                SET child_name = '$chiname', child_bday = '$chibday'
                WHERE personal_id = '$id'
                AND children_id = '$chiids'
            ") or die(mysqli_error($con));
        }
    }
} else {
    for ($x1 = 0; $x1 < $ctrx2; $x1++) {
        $chiname = mysqli_real_escape_string($con, isset($child_name[$x1]) ? $child_name[$x1] : '');
        $chibday = mysqli_real_escape_string($con, isset($child_bday[$x1]) ? $child_bday[$x1] : '');
        $chiids = isset($children_id[$x1]) ? (int)$children_id[$x1] : 0;

        if (trim($chiname) != '') {
            $select1 = mysqli_query($con, "
                SELECT children_id FROM children
                WHERE children_id = '$chiids'
                AND personal_id = '$id'
            ") or die(mysqli_error($con));

            if (mysqli_num_rows($select1) > 0) {
                mysqli_query($con, "
                    UPDATE children
                    SET child_name = '$chiname', child_bday = '$chibday'
                    WHERE personal_id = '$id'
                    AND children_id = '$chiids'
                ") or die(mysqli_error($con));
            } else {
                mysqli_query($con, "
                    INSERT INTO children (personal_id, child_name, child_bday)
                    VALUES ('$id', '$chiname', '$chibday')
                ") or die(mysqli_error($con));
            }
        }
    }
}


/* =========================================================
   EDUCATIONAL BACKGROUND
   ========================================================= */

mysqli_query($con, "
    UPDATE educational_background
    SET
        college = '$college_esc',
        course = '$course',
        ed_from = '$ed_from',
        ed_to = '$ed_to',
        date_graduated = '$date_graduated',
        highschool = '$highschool_esc',
        h_course = '$h_course',
        h_from = '$h_from',
        h_to = '$h_to',
        h_date_graduated = '$h_date_graduated',
        elementary = '$elementary_esc',
        e_course = '$e_course',
        e_from = '$e_from',
        e_to = '$e_to',
        e_date_graduated = '$e_date_graduated',
        post_grad = '$post_grad_esc',
        p_course = '$p_course',
        p_from = '$p_from',
        p_to = '$p_to',
        p_date_graduated = '$p_date_graduated'
    WHERE personal_id = '$id'
") or die(mysqli_error($con));


/* =========================================================
   EMPLOYMENT HISTORY
   ========================================================= */

$sql2 = mysqli_query($con, "
    SELECT * FROM employment_history
    WHERE personal_id = '$id'
") or die(mysqli_error($con));

$row4 = mysqli_num_rows($sql2);
$name_address_employer = isset($_POST['name_address_employer']) ? $_POST['name_address_employer'] : array();
$em_position = isset($_POST['em_position']) ? $_POST['em_position'] : array();
$em_from = isset($_POST['em_from']) ? $_POST['em_from'] : array();
$em_to = isset($_POST['em_to']) ? $_POST['em_to'] : array();
$em_remarks = isset($_POST['em_remarks']) ? $_POST['em_remarks'] : array();
$employment_id = isset($_POST['employment_id']) ? $_POST['employment_id'] : array();

$ctrx3 = count($name_address_employer);

if ($row4 == $ctrx3) {
    for ($x3 = 0; $x3 < $ctrx3; $x3++) {
        $name_address_employer_esc = mysqli_real_escape_string($con, isset($name_address_employer[$x3]) ? $name_address_employer[$x3] : '');
        $emppos = mysqli_real_escape_string($con, isset($em_position[$x3]) ? $em_position[$x3] : '');
        $empfrom = mysqli_real_escape_string($con, isset($em_from[$x3]) ? $em_from[$x3] : '');
        $empto = mysqli_real_escape_string($con, isset($em_to[$x3]) ? $em_to[$x3] : '');
        $em_remarks_esc = mysqli_real_escape_string($con, isset($em_remarks[$x3]) ? $em_remarks[$x3] : '');
        $emid = isset($employment_id[$x3]) ? (int)$employment_id[$x3] : 0;

        if (trim($name_address_employer_esc) != '') {
            mysqli_query($con, "
                UPDATE employment_history
                SET
                    name_address_employer = '$name_address_employer_esc',
                    em_position = '$emppos',
                    em_from = '$empfrom',
                    em_to = '$empto',
                    em_remarks = '$em_remarks_esc'
                WHERE personal_id = '$id'
                AND employment_id = '$emid'
            ") or die(mysqli_error($con));
        }
    }
} else {
    for ($x3 = 0; $x3 < $ctrx3; $x3++) {
        $name_address_employer_esc = mysqli_real_escape_string($con, isset($name_address_employer[$x3]) ? $name_address_employer[$x3] : '');
        $emppos = mysqli_real_escape_string($con, isset($em_position[$x3]) ? $em_position[$x3] : '');
        $empfrom = mysqli_real_escape_string($con, isset($em_from[$x3]) ? $em_from[$x3] : '');
        $empto = mysqli_real_escape_string($con, isset($em_to[$x3]) ? $em_to[$x3] : '');
        $em_remarks_esc = mysqli_real_escape_string($con, isset($em_remarks[$x3]) ? $em_remarks[$x3] : '');
        $emid = isset($employment_id[$x3]) ? (int)$employment_id[$x3] : 0;

        if (trim($name_address_employer_esc) != '') {
            $select4 = mysqli_query($con, "
                SELECT employment_id FROM employment_history
                WHERE employment_id = '$emid'
                AND personal_id = '$id'
            ") or die(mysqli_error($con));

            if (mysqli_num_rows($select4) > 0) {
                mysqli_query($con, "
                    UPDATE employment_history
                    SET
                        name_address_employer = '$name_address_employer_esc',
                        em_position = '$emppos',
                        em_from = '$empfrom',
                        em_to = '$empto',
                        em_remarks = '$em_remarks_esc'
                    WHERE personal_id = '$id'
                    AND employment_id = '$emid'
                ") or die(mysqli_error($con));
            } else {
                mysqli_query($con, "
                    INSERT INTO employment_history
                        (personal_id, name_address_employer, em_position, em_from, em_to, em_remarks)
                    VALUES
                        ('$id', '$name_address_employer_esc', '$emppos', '$empfrom', '$empto', '$em_remarks_esc')
                ") or die(mysqli_error($con));
            }
        }
    }
}


/* =========================================================
   TRAININGS AND SEMINARS
   ========================================================= */

$sql4 = mysqli_query($con, "
    SELECT * FROM training_seminars
    WHERE personal_id = '$id'
") or die(mysqli_error($con));

$row8 = mysqli_num_rows($sql4);
$title = isset($_POST['title']) ? $_POST['title'] : array();
$venue = isset($_POST['venue']) ? $_POST['venue'] : array();
$organizer = isset($_POST['organizer']) ? $_POST['organizer'] : array();
$training_date = isset($_POST['training_date']) ? $_POST['training_date'] : array();
$training_seminars_id = isset($_POST['training_seminars_id']) ? $_POST['training_seminars_id'] : array();

$ctrx5 = count($title);

if ($row8 == $ctrx5) {
    for ($x4 = 0; $x4 < $ctrx5; $x4++) {
        $t_title = mysqli_real_escape_string($con, isset($title[$x4]) ? $title[$x4] : '');
        $t_venue = mysqli_real_escape_string($con, isset($venue[$x4]) ? $venue[$x4] : '');
        $t_organizer = mysqli_real_escape_string($con, isset($organizer[$x4]) ? $organizer[$x4] : '');
        $trainingdate = mysqli_real_escape_string($con, isset($training_date[$x4]) ? $training_date[$x4] : '');
        $trainid = isset($training_seminars_id[$x4]) ? (int)$training_seminars_id[$x4] : 0;

        if (trim($t_title) != '') {
            mysqli_query($con, "
                UPDATE training_seminars
                SET
                    title = '$t_title',
                    venue = '$t_venue',
                    organizer = '$t_organizer',
                    training_date = '$trainingdate'
                WHERE personal_id = '$id'
                AND training_seminars_id = '$trainid'
            ") or die(mysqli_error($con));
        }
    }
} else {
    for ($x4 = 0; $x4 < $ctrx5; $x4++) {
        $t_title = mysqli_real_escape_string($con, isset($title[$x4]) ? $title[$x4] : '');
        $t_venue = mysqli_real_escape_string($con, isset($venue[$x4]) ? $venue[$x4] : '');
        $t_organizer = mysqli_real_escape_string($con, isset($organizer[$x4]) ? $organizer[$x4] : '');
        $trainingdate = mysqli_real_escape_string($con, isset($training_date[$x4]) ? $training_date[$x4] : '');
        $trainid = isset($training_seminars_id[$x4]) ? (int)$training_seminars_id[$x4] : 0;

        if (trim($t_title) != '') {
            $select5 = mysqli_query($con, "
                SELECT training_seminars_id FROM training_seminars
                WHERE training_seminars_id = '$trainid'
                AND personal_id = '$id'
            ") or die(mysqli_error($con));

            if (mysqli_num_rows($select5) > 0) {
                mysqli_query($con, "
                    UPDATE training_seminars
                    SET
                        title = '$t_title',
                        venue = '$t_venue',
                        organizer = '$t_organizer',
                        training_date = '$trainingdate'
                    WHERE personal_id = '$id'
                    AND training_seminars_id = '$trainid'
                ") or die(mysqli_error($con));
            } else {
                mysqli_query($con, "
                    INSERT INTO training_seminars
                        (personal_id, title, venue, organizer, training_date)
                    VALUES
                        ('$id', '$t_title', '$t_venue', '$t_organizer', '$trainingdate')
                ") or die(mysqli_error($con));
            }
        }
    }
}


/* =========================================================
   ADDITIONAL INFORMATION
   ========================================================= */

$tin_esc = mysqli_real_escape_string($con, isset($_POST['tin']) ? $_POST['tin'] : '');
$sss_esc = mysqli_real_escape_string($con, isset($_POST['sss']) ? $_POST['sss'] : '');
$philhealth_esc = mysqli_real_escape_string($con, isset($_POST['philhealth']) ? $_POST['philhealth'] : '');
$pagibig_esc = mysqli_real_escape_string($con, isset($_POST['pagibig']) ? $_POST['pagibig'] : '');
$dialect_esc = mysqli_real_escape_string($con, isset($_POST['dialect']) ? $_POST['dialect'] : '');
$drivers_license_esc = mysqli_real_escape_string($con, isset($_POST['drivers_license']) ? $_POST['drivers_license'] : '');
$date_issued_licensed_number_esc = mysqli_real_escape_string($con, isset($_POST['date_issued_licensed_number']) ? $_POST['date_issued_licensed_number'] : '');
$special_skills_esc = mysqli_real_escape_string($con, isset($_POST['special_skills']) ? $_POST['special_skills'] : '');
$illness_esc = mysqli_real_escape_string($con, isset($_POST['illness']) ? $_POST['illness'] : '');
$own_bus_esc = mysqli_real_escape_string($con, isset($_POST['own_bus']) ? $_POST['own_bus'] : '');
$nature_bus_esc = mysqli_real_escape_string($con, isset($_POST['nature_bus']) ? $_POST['nature_bus'] : '');
$profession_esc = mysqli_real_escape_string($con, isset($_POST['profession']) ? $_POST['profession'] : '');
$license_no_esc = mysqli_real_escape_string($con, isset($_POST['license_no']) ? $_POST['license_no'] : '');

$sql_add = mysqli_query($con, "
    SELECT personal_id
    FROM additional_info
    WHERE personal_id = '$id'
") or die(mysqli_error($con));

if (mysqli_num_rows($sql_add) > 0) {
    mysqli_query($con, "
        UPDATE additional_info
        SET
            tin = '$tin_esc',
            sss = '$sss_esc',
            philhealth = '$philhealth_esc',
            pagibig = '$pagibig_esc',
            height = '$height_esc',
            weight = '$weight_esc',
            dialect = '$dialect_esc',
            drivers_license = '$drivers_license_esc',
            date_issued_licensed_number = '$date_issued_licensed_number_esc',
            special_skills = '$special_skills_esc',
            illness = '$illness_esc',
            own_bus = '$own_bus_esc',
            nature_bus = '$nature_bus_esc',
            profession = '$profession_esc',
            license_no = '$license_no_esc'
        WHERE personal_id = '$id'
    ") or die(mysqli_error($con));
} else {
    mysqli_query($con, "
        INSERT INTO additional_info
            (
                personal_id,
                tin,
                sss,
                philhealth,
                pagibig,
                height,
                weight,
                dialect,
                drivers_license,
                date_issued_licensed_number,
                special_skills,
                illness,
                own_bus,
                nature_bus,
                profession,
                license_no
            )
        VALUES
            (
                '$id',
                '$tin_esc',
                '$sss_esc',
                '$philhealth_esc',
                '$pagibig_esc',
                '$height_esc',
                '$weight_esc',
                '$dialect_esc',
                '$drivers_license_esc',
                '$date_issued_licensed_number_esc',
                '$special_skills_esc',
                '$illness_esc',
                '$own_bus_esc',
                '$nature_bus_esc',
                '$profession_esc',
                '$license_no_esc'
            )
    ") or die(mysqli_error($con));
}


/* =========================================================
   CHARACTER REFERENCE
   ========================================================= */

$c_name = isset($_POST['c_name']) ? $_POST['c_name'] : array();
$c_employer = isset($_POST['c_employer']) ? $_POST['c_employer'] : array();
$c_position = isset($_POST['c_position']) ? $_POST['c_position'] : array();
$c_relationship = isset($_POST['c_relationship']) ? $_POST['c_relationship'] : array();
$c_contact_no = isset($_POST['c_contact_no']) ? $_POST['c_contact_no'] : array();
$character_id = isset($_POST['character_id']) ? $_POST['character_id'] : array();

$ctrx4 = count($c_name);

for ($x2 = 0; $x2 < $ctrx4; $x2++) {
    $charname = mysqli_real_escape_string($con, isset($c_name[$x2]) ? $c_name[$x2] : '');
    $charemp = mysqli_real_escape_string($con, isset($c_employer[$x2]) ? $c_employer[$x2] : '');
    $charpos = mysqli_real_escape_string($con, isset($c_position[$x2]) ? $c_position[$x2] : '');
    $charrel = mysqli_real_escape_string($con, isset($c_relationship[$x2]) ? $c_relationship[$x2] : '');
    $charcon = mysqli_real_escape_string($con, isset($c_contact_no[$x2]) ? $c_contact_no[$x2] : '');
    $charids = isset($character_id[$x2]) ? (int)$character_id[$x2] : 0;

    /*
     * Skip only when every field in this reference row is empty.
     * This allows employer, position, relationship, and contact
     * number to be updated even when the name is left blank.
     */
    if (
        trim($charname) == '' &&
        trim($charemp) == '' &&
        trim($charpos) == '' &&
        trim($charrel) == '' &&
        trim($charcon) == ''
    ) {
        continue;
    }

    if ($charids > 0) {
        $select3 = mysqli_query($con, "
            SELECT character_id
            FROM character_reference
            WHERE character_id = '$charids'
            AND personal_id = '$id'
        ") or die(mysqli_error($con));

        if (mysqli_num_rows($select3) > 0) {
            mysqli_query($con, "
                UPDATE character_reference
                SET
                    c_name = '$charname',
                    c_employer = '$charemp',
                    c_position = '$charpos',
                    c_relationship = '$charrel',
                    c_contact_no = '$charcon'
                WHERE personal_id = '$id'
                AND character_id = '$charids'
            ") or die(mysqli_error($con));
        } else {
            mysqli_query($con, "
                INSERT INTO character_reference
                    (personal_id, c_name, c_employer, c_position, c_relationship, c_contact_no)
                VALUES
                    ('$id', '$charname', '$charemp', '$charpos', '$charrel', '$charcon')
            ") or die(mysqli_error($con));
        }
    } else {
        mysqli_query($con, "
            INSERT INTO character_reference
                (personal_id, c_name, c_employer, c_position, c_relationship, c_contact_no)
            VALUES
                ('$id', '$charname', '$charemp', '$charpos', '$charrel', '$charcon')
        ") or die(mysqli_error($con));
    }
}


/* =========================================================
   PERSON TO CONTACT IN CASE OF EMERGENCY
   ========================================================= */

$p_name_esc = mysqli_real_escape_string($con, isset($_POST['p_name']) ? $_POST['p_name'] : '');
$p_relationship_esc = mysqli_real_escape_string($con, isset($_POST['p_relationship']) ? $_POST['p_relationship'] : '');
$p_contact_no_esc = mysqli_real_escape_string($con, isset($_POST['p_contact_no']) ? $_POST['p_contact_no'] : '');
$address_esc = mysqli_real_escape_string($con, isset($_POST['address']) ? $_POST['address'] : '');

$sql_contact = mysqli_query($con, "
    SELECT personal_id
    FROM person_to_contact
    WHERE personal_id = '$id'
") or die(mysqli_error($con));

if (mysqli_num_rows($sql_contact) > 0) {
    mysqli_query($con, "
        UPDATE person_to_contact
        SET
            p_name = '$p_name_esc',
            p_relationship = '$p_relationship_esc',
            p_contact_no = '$p_contact_no_esc',
            address = '$address_esc'
        WHERE personal_id = '$id'
    ") or die(mysqli_error($con));
} else {
    mysqli_query($con, "
        INSERT INTO person_to_contact
            (personal_id, p_name, p_relationship, p_contact_no, address)
        VALUES
            ('$id', '$p_name_esc', '$p_relationship_esc', '$p_contact_no_esc', '$address_esc')
    ") or die(mysqli_error($con));
}

echo "Employee information updated successfully.";

?>