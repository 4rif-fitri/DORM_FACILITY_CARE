<header class="_navbar">
	<label for="_mobile-sideBar" class="_mobile">
		<img style="height: 4rem;" src="../../images/dropdown icon.png" alt="">
	</label>

	<h1 class="title"><?= $title ?></h1>
	<article>
		<a href="../../pages/system-admin/myProfile.php">
			<p class="_dekstop"><?= $_SESSION["name"] ?></p>
			<div class="_avatar-kecil" style="background-image: url('<?= $_SESSION["url"] ?>')">
			</div>
		</a>
	</article>
</header>