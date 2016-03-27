<?php
header("Content-Type: application/json");

//Validate user's input

$username = preg_match('/[A-Za-z0-9]/', $_POST['username']) ? $_POST['username'] : "";
$password = preg_match('/[A-Za-z0-9\.\\s\-\_\!]/', $_POST['password']) ? $_POST['password'] : "";

if ($username == "") {
    echo json_encode(array(
	"success" => false,
	"message" => "Invalid Username"
	));
}elseif ($password == ""){
    echo json_encode(array(
	"success" => false,
	"message" => "Invalid Password"
	));
}else{
	//Valid user input, so proceed to insert the data into the database
	require 'Mod5-Database.php';
	$stmt = $mysqli->prepare("insert into users (username, password, salt) values (?, ?, ?)");
    if(!$stmt){
        echo json_encode(array(
		"success" => false,
		"message" => "Invalid username or password"
		));
		exit;
    }                   
    $length = rand(10,20);                    
    $salt = randomString($length);                    
    $pwd_hash = crypt($password, $salt);                    
    $stmt->bind_param('sss', $username, $pwd_hash, $salt);
    $stmt->execute();
	$stmt->close();
	echo json_encode(array(
	"success" => true,
	"message" => "You are now registered"
	));
}

function randomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
?>