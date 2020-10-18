<?php require('header.php');?>



<div style="margin: 50px 0;">

	<?php 
	$posts = getpost();
	$i = 0;
	while ($post = mysqli_fetch_assoc($posts)) {?>
		<div class="container postrow" style="padding: 50px 0; "id="<?= $i++ ?>">
			<div class="postcolon" style="max-height: 400px;">
				<img src="assets/images/<?= $post['image']; ?>" alt="" style="height: 100%; width:100%; padding: 30px;">
			</div>
			<div class="postcolon" style="padding: 35px;">
				<h3><?= $post['title']; ?></h3>
				<p><?= $post['post']; ?></p>
				<br><span style="color: #26264b;"><?= $post['created_at']; ?></span><br><br>
			</div>
		</div>

		<?php 
		if ($i == 20) {
			break;
		}
	}

	?>

</div>


<?php require('footer.php'); ?>

