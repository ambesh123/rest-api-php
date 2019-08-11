<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Methods,Access-Control-Allow-Headers,Content-Type, Authorization, X-Requested-With');

    include('../../config/database.php');
    include('../../models/Employee.php');

    // Instatiate the DB

    $database = new Database();
    $db = $database->connect();

    // Instantiate the Query

    $post = new Employee($db);

    $data = json_decode(file_get_contents('php://input'));
    
    $post->id = $data->emp_id;

    $post->salary = $data->emp_salary;
    


    if($post->update()) {
        echo(json_encode(array(
            'Message' => 'Record Updated Sucessfully...!'
        )));
    }else {
        echo(json_encode(array(
            'Message' => 'unable to Update Record'
        )));
    }
?>