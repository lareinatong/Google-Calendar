<?php
    header("Content-Type: application/json");
    ini_set("session.cookie_httponly", 1);
    session_start();
	if($_SESSION['token'] !== $_POST['token']){
		die("Request forgery detected");
	}
    require 'Mod5-Database.php';
    $id = $_POST['id'];
	$newDate = $_POST['newDate'];
	$newTime = $_POST['time'];
	$newTitle = $_POST['title'];

    $stmt = $mysqli->prepare("UPDATE events SET date=?,time=?,title=? WHERE id = ?");    
	if(!$stmt){
		echo json_encode(array("success"=>false,
                               "message"=>"Query Prep Failed: " + $mysqli->error));
		exit;
	}
    
	$stmt->bind_param('sssi', $newDate, $newTime, $newTitle, $id);        
	$stmt->execute();
	echo json_encode(array("success"=>true,
                               "message"=>"You have successfully updated"));
    $stmt->close();

?>