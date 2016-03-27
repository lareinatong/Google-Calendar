<?php
    header("Content-Type: application/json");
    ini_set("session.cookie_httponly", 1);
	session_start();
	if($_SESSION['token'] !== $_POST['token']){
		die("Request forgery detected");
	}
    
    require 'Mod5-Database.php';
    $id = $_POST['id'];

    $stmt = $mysqli->prepare("delete from events where id = ?");
    if(!$stmt){
        echo json_encode(array("success"=>false,
                               "message"=>"Query Prep Failed: " + $mysqli->error));
        exit;
    }
    $stmt->bind_param('i', $id);    
    $stmt->execute();
    // escape the output using the htmlentities() function:
    echo json_encode(array("success"=>true,
                            "message"=> "Delete Complete.",
			    "deleteId"=>htmlentities($id)));
    
    $stmt->close();
?>