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

<div id="preloader"></div>

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
		<a href="viewpost.php"><button type="submit" name="submit" style="background-color: red; padding: 5px; float: right; border-radius: 5px;">View posts</button></a>
		<a href="logout.php"><button type="submit" name="submit" style="background-color: red; padding: 5px; float: right; border-radius: 5px;">Logout</button></a>
	</section>

	<section>
		<h3>My Posts</h3>
		<table id="table">
			<tr>
				<th>S/N</th>
				<th>Image</th>
				<th>Title</th>
				<th>Post</th>
				<th>Status</th>
				<th>Date Created</th>
				<th>Action</th>
			</tr>

			<?php 
			$posts = getUserposts();
			$i = 1;
			while ($post = mysqli_fetch_assoc($posts)) {

				?>
				<tr>
					
					<td><?= $i++?></td>
					<td style="max-height: 200px;"><img src="assets/images/<?= $post['image']?>" style="width: 100%; height: 100%;"></td>
					<td><?= $post['title']?></td>
					<td><?= $post['post']?></td>
					<td><?= $post['status']?></td>
					<td><?= $post['created_at']?></td>
					<td><a href="delete.php?id=<?= $post['id'] ?>" style="background: red; color: #fff; padding: 5px;">Delete!</a><br><br><a href="edit.php?id=<?= $post['id'] ?>" style="background: blue; color: #fff; padding: 5px;">Edit!</a></td>
				</tr>

				<?php
                        // if ($i == 5) {
                        // 	break;
                        // }
			} ?>
		</table>
	</section>
</div>



<?php require('footer.php'); ?>