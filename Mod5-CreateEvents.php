<?php
    header("Content-Type: application/json");
    ini_set("session.cookie_httponly", 1);
    session_start();
    require 'Mod5-Database.php';
    $username = $_POST['username'];
    $date = htmlentities($_POST['date']);
    $time = htmlentities($_POST['time']);
    $title = htmlentities($_POST['title']);
	$groupshare = htmlentities($_POST['groupshare']);
    $stmt = $mysqli->prepare("insert into events (date,time,title,username,groupshare) values (?,?,?,?,?)");
    if(!$stmt){
        echo json_encode(array(
		"success" => false,
		"message" => "Create Event Failed."
		));
		exit;
    }   
    $stmt->bind_param('ssssi', $date,$time,$title,$username,$groupshare);    
    $stmt->execute();
    $stmt->close();
    echo json_encode(array("success"=>true,
			       "message"=>"Event Created Successfully"
                               ));      
    
    

?>