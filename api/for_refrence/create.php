<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Methods,Access-Control-Allow-Headers,Content-Type, Authorization, X-Requested-With');

    include('../../config/database.php');
    include('../../models/Employee.php');

    // Instatiate the DB

    $database = new Database();
    $db = $database->connect();

    // Instantiate the Query

    $post = new Employee($db);

    // Get the JSON Data from Postman

    $data = json_decode(file_get_contents('php://input'));

    $post->id = $data->emp_id;
    $post->empname = $data->emp_name;
    $post->salary = $data->emp_salary;
    $post->mobile = $data->emp_mobile;


    // Insert Data into the table
    if($post->create()){
        echo(json_encode(
            array('Message' => "Record Inserted Sucessfully")
        ));
    }else {
        echo(json_encode(array(
            "Message" => 'Unable to insert record'
        )));
    }

?>