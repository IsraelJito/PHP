<?php 
ob_start();
require('header.php');
session_start();
if (!isset($_SESSION['user'])) {
	header('Location: index.php');
}
$user = $_SESSION['user'];
$errors;
if (isset($_POST['submit'])) {
	if (createpost(array_merge($_POST, $_FILES))) {
		$success = "New Post Successfully Created!";
	}
} 
?>

<!-- <div id="preloader"></div> -->

<div class="container" style="padding: 100px 0">
	<h4 style="text-align: center; padding: 30px 0;">Welcome User <?= $_SESSION['user']['name'] ?></h4>

	<section>

		<h2 style="text-align: center;">New Post!</h2>
		<div>
			<div style="text-align: center;">
				<?php if (!empty($success)) {?>
					<span style="color: green;"><?= $success ?></span> 
				<?php } ?>
				<?php if (!empty($errors)) {?>
					<span style="color: red;"><?= $errors ?></span>
				<?php } ?>
			</div>
			<form method="post" action="" class="createpost_form" enctype="multipart/form-data">
				<label for="title">Blog Title</label>
				<input type="text" name="title" id="title" placeholder="Blog Title..">
				<!-- <div class="postimage"></div> -->
				<label for="image">Image</label>
				<input type="file" name="image" id="image" placeholder="Blog Image..">
				<select name="status">
					<option value="active" selected>Publish</option>
					<option value="inactive">Save as draft</option>
				</select>
				<label for="post">Blog Posts</label>
				<textarea type="text" name="post" id="post" placeholder="Blog Post.."></textarea>
				<br><button type="submit" name="submit" style="background-color: blue; padding: 5px; border-radius: 5px;">Post</button>
			</form>
		</div>
		<a href="logout.php"><button type="submit" name="submit" style="background-color: red; padding: 5px; float: right; border-radius: 5px;">Logout</button></a>
	</section>
</div>


<?php require('footer.php'); ?>