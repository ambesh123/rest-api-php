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

    $result = $post->read();

    $num = $result->rowCount();

    if($num > 0) {

        $posts_array = array();
        $posts_array['Employee Data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){

            extract($row);

            $post_item = array(
                'Employee ID'=>$row['emp_id'],
                'Employee Name'=>$row['emp_name'],
                'Employee Mobile'=>$row['emp_mobile'],
                'Employee Salary'=>$row['emp_salary']
            );

            array_push($posts_array['Employee Data'], $post_item);
        }

        // Encoding To JSON Format
        echo json_encode($posts_array);
    }else {

        echo json_encode(array(
            'Message'=>'No Record Found!'
        ));
    }

?>