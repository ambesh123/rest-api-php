<?php 

    header('Content-Type: application/json');

	require '../../config/database.php';
	require '../../models/Employee.php';


    $request_method = $_SERVER['REQUEST_METHOD'];

	if($request_method != 'DELETE'){
    	echo json_encode(array(
	            'Message'=>'Wrong Request Method'
	        	));
    }
    else{

		$db = new Database();
		$conn = $db->connect();

		if($conn->connect_error){
			echo(json_encode(array('Message' => 'Connection Error')));
		}
		else{
			$post = new Employee($conn);

			$data = json_decode(file_get_contents('php://input'));

			$post->id = $data->emp_id;

			$res = $post->delete();
			
			$ret = array();

			$ret['Status'] = $res;
			
			if($res){
				$ret['Message'] = 'Record deleted Successfully';
			}
			else{
				$ret['Message'] = 'No such record';
			}

			echo(json_encode($ret));
		}
	}
?>