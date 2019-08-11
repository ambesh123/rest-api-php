<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include('../../config/database.php');
    include('../../models/Employee.php');

    // Instatiate the DB
    $database = new Database();
    $db = $database->connect();

    // Instantiate the Query

    $post = new Employee($db);

    $result = $post->read_single_user_data();

    $num = $result->rowCount();

    if($num > 0) {

        $posts_array = array();

            $row = $result->fetch(PDO::FETCH_ASSOC);

            $posts_array = array(
                'Employee ID'=>$row['emp_id'],
                'Employee Name'=>$row['emp_name'],
                'Employee Mobile'=>$row['emp_mobile'],
                'Employee Salary'=>$row['emp_salary']
            );
            
        // Encoding To JSON Format
        echo json_encode($posts_array);
    }else {

        echo json_encode(array(
            'Message'=>'No Records Found!'
        ));
    }

?>