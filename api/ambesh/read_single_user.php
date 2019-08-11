<?php 

    header('Content-Type: application/json');

	require '../../config/database.php';
	require '../../models/Employee.php';

	$db = new Database();
	$conn = $db->connect();

	if($conn->connect_error){
		echo(json_encode(array('Message' => 'Connection Error')));
	}
	else{
		$post = new Employee($conn);
		$res = $post->read_single_user_data();
		$ret = array();
		$ret['data'] = array();

		if($res->num_rows > 0){
			while($row = $res->fetch_assoc()){
				array_push($ret['data'], array('id' => $row['id'], 'name' => $row['name']));
			}
			$ret['Message'] = 'Success';

			echo json_encode($ret);
		}
		else{
			echo json_encode(array(
            'Message'=>'No Record Found!'
        	));
		}
	}
?>