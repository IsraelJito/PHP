<?php 
ob_start();
require('function.php');
session_start();
$db = dbconnect();
$errors = [];
if (isset($_POST['submit'])) {
	if (login($_POST)){
		header('Location: createposts.php');
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>

		body {
			background: linear-gradient(to right, green -10%, transparent 50%, green 110%);
		}

		div h2 {
			margin-top: 100px;
			text-align: center;
			font-size: 40px;
		}

		form {
			margin: auto;
			width: 80%;
			padding: 50px;
			border: 1px solid black;
			width: 70%;
			min-width: 200px;
		}

		form input {
			width: 90%;
			padding: 10px 0;
			margin-bottom: 30px;
			background-color: transparent;
			border: 0;
			border-bottom: 2px solid black;
			color: black;
		}
		
		form input:focus {
			font-size: large;
		}
	</style>
</head>
<body>

	<div style="max-width: 800px; min-width: 300px; margin: auto;">
		<h2>LogIn</h2>
		<?php if (!empty($errors['credentials'])) {?>
			<br><span style="color: red; text-align: center;"><?= $errors['credentials'] ?></span>
		<?php }?>
	<form action="" method="post">
		<?php if (!empty($errors['username'])) {?>
			<span style="color: red"><?= $errors['username'] ?></span>
		<?php }?>
		<input type="text" name="username" placeholder="Enter Login Id">
		<?php if (!empty($errors['password'])) {?>
			<br><span style="color: red"><?= $errors['password'] ?></span>
		<?php }?>
		<input type="password" name="password" placeholder="Enter Password">
		<br><button type="submit" name="submit">Login</button>
	</form>
	</div>


</body>
</html>