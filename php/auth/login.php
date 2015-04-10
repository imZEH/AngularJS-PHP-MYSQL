<?php 
	require_once("../conf/REST.php");

	$REST = new REST();
	
	$mysqli = $REST->conn();

	$user=json_decode(file_get_contents('php://input'));

	if(empty($user->email) or empty($user->password)){
		$error = array('status' => "Failed", "msg" => "Username/Password required");
		$REST->response($REST->json($error), 204);
	}

	$email = $user->email;
	$password = $user->password;

	
	if(!empty($email) and !empty($password)){
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$query="SELECT u_id, Name FROM user WHERE username = '$email' and password = '".md5($password)."'LIMIT 1";
			$r = $mysqli->query($query) or die($mysqli->error.__LINE__);

			if($r->num_rows > 0) {
				$result = $r->fetch_assoc();	
				// If success everythig is good send header as "OK" and user details
				session_start();
				$_SESSION['uid']=uniqid('ang_');
				$REST->response($REST->json($result), 200);
			}
			$REST->response('No Data', 204);	// If no records "No Content" status
		}
	}
	
	$error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
	$REST->response($REST->json($error), 400);
?>