<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    if($post->delete()) {
        echo(json_encode(array(
            'Message' => 'Record deleted Sucessfully'
        )));
    }else {
        echo(json_encode(array(
            'Message' => 'Record Not deleted'
        )));
    }
?>