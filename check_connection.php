<?php 
	require 'config/database.php';
	$db = new Database;
	$conn = $db->connect();

	if($conn->connect_error){
		echo("Connection Error");
	}
	else{
		echo("Connection Establish Successfull :D <br>");

		$res = $conn->query("select * from tab1");

		if($res->num_rows > 0){
			while($row = $res->fetch_assoc()){
				echo($row['id']." ".$row['name']." <br>");
			}
		}
		else {
			echo("No data in table.");
		}
		$conn->close();
	}
?>