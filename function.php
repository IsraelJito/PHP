<?php 

function dbconnect() {
	$con = mysqli_connect('localhost', 'root', '', 'epb');

	if (mysqli_errno($con)) {
		die('CONNECTION ERROR**');
	}else{
		// if(!mysqli_select_db($con, 'epb')) {
		// 	die('COULD NOT CONNECT TO epb**');
		// }
		return $con;
	}
	
}

function runcheck($data) {
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	$data = filter_var($data, FILTER_SANITIZE_STRING);
	return $data;
}

function login($request) {
	global $db, $errors;

	if (empty($request['username'])) {
		$errors['username'] = "Enter Username..";
	}
	if (empty($request['password'])) {
		$errors['password'] = "Enter password..";
	}

	$username = $request['username'];
	$password = $request['password'];
	if (!empty($username) && !empty($password)) {
		$query = mysqli_query($db, "SELECT * FROM users WHERE '$username' = username and '$password' = password LIMIT 1" );
		$no = mysqli_num_rows($query);
		if ($no == 0) {
		 	$errors['credentials'] = "INVALID CREDENTIALS";
		 }else{
		 	$userdata = mysqli_fetch_assoc($query);
			$_SESSION['user'] = $userdata;
		 	return true;
		 }
	}
}

function createpost($request) {
	global $db, $errors, $user;
	
	if (empty(runcheck($request['title'])) || empty($request['image']['name']) || runcheck(empty($request['post'])) || empty($request['status'])) {
		$errors = "All fileds are required";
	}else{
		$title = runcheck($request['title']);
		$post = runcheck($request['post']);
		$status = $request['status'];
		if (!getimagesize($request['image']['tmp_name'])) {
			$errors = "Please you can only use an image file";
		}else {
			$random = rand(10, 10000);
			$str = str_shuffle('ASDFGHJKLmnbvcxzqweRTYUIOP'.$random);
			$oldimage = explode(".", $request['image']['name']);
			$extension = end($oldimage);
			$image = $str.".".$extension;
		}
	}
	if (empty($errors)) {
		$user_id = $user['id'];
		if (move_uploaded_file($request['image']['tmp_name'], 'assets/images/'.$image)) {
			$query = mysqli_query($db, "INSERT INTO  posts (author_id,title,image,status,post) VALUES ('$user_id','$title','$image','$status','$post')");
			if (mysqli_affected_rows($db) != 0) {
				return true;
			}
		}
	}
}

function getpost() {
	global $db;
	$query = mysqli_query($db, "SELECT id, title, image, post, created_at FROM posts WHERE status = 'active' ORDER BY id DESC");
	if (mysqli_num_rows($query) > 0) {
		return $query;
	}
}

function getUserposts() {
	global $db, $user;
	$user_id = $user['id'];
	$query = mysqli_query($db, "SELECT * FROM posts WHERE author_id = '$user_id' ORDER BY id DESC");
	if (mysqli_num_rows($query) != 0) {
		return $query;
	}
}




?>


