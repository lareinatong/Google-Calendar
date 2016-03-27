<?php
header("Content-Type: application/json");
ini_set("session.cookie_httponly", 1);

if (isset($_POST['username'])){
    require 'Mod5-Database.php';
    $username = $mysqli->real_escape_string($_POST['username']);
    $username = preg_match('/[A-Za-z0-9]/', $username) ? $username : "";
    if ($username == "") {
        echo json_encode(array(
		"success" => false,
		"message" => "Incorrect Username or Password"
		));
    } else {           
        $stmt = $mysqli->prepare("SELECT username, password FROM users WHERE username=?");
        $stmt->bind_param('s', $username);
        $stmt->execute();            
        $stmt->bind_result($user, $pwd_hash);
        $stmt->fetch();
        $pwd_guess = $_POST['password'];            
        if(crypt($pwd_guess, $pwd_hash)==$pwd_hash){
			ini_set("session.cookie_httponly", 1);
            session_start();
			$_SESSION['username'] = $username;
			$_SESSION['token'] = substr(md5(rand()), 0, 10); 
			echo json_encode(array(
				"success" => true,
				"message" => "You are now logged in",
				"token" => $_SESSION['token']
			));
			exit;
        }else{
            echo json_encode(array(
		    "success" => false,
		    "message" => "Incorrect Username or Password"
		    ));
        }            
	}
	$stmt->close();
}
?>