<?php
    header("Content-Type: application/json");
    ini_set("session.cookie_httponly", 1);
    session_start();
    require 'Mod5-Database.php';
    $username = $_POST['username'];
    $date = $_POST['date'];
    $stmt = $mysqli->prepare("SELECT time,title,id,groupshare,sourceuser  FROM events WHERE date = ? AND username = ?");
    $stmt->bind_param('ss', $date,$username);    
    $stmt->execute();            
    $stmt->bind_result($time, $title, $id, $groupshare, $sourceuser);
    $exist = false;
    while ($stmt->fetch()){
        $exist = true;
        if ($groupshare){
            $groupshare = "Group";
        } else {
            $groupshare = "Individual";
        }
		$result = array("eventTime" => $time,
                        "eventTitle" => $title,
						"eventId" => $id,
                        "groupshare"=> $groupshare,
						"sourceuser"=> $sourceuser
                        );
        $allResult[] = $result;
    }

    $stmt->close();
    
    if ($exist){
        echo json_encode(array("success"=>true,
                               "eventList"=>$allResult));
    } else {
        echo json_encode(array("success"=>false));   
    }
    

?>