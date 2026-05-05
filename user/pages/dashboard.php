<?php include(__DIR__ . "/../../header.php");

// authorize(["user"]);

if (isset($_POST["submit"])) {
	echo "<script>alert('BERJAYA');</script>";
}

?>

<link rel="stylesheet" href="<?= BASE_URL ?>/user/style/dashboard.css">

<main>
	<h1>LOREM</h1>
</main>

<script src="<?= BASE_URL ?>/user/script/dashboard.js"></script>
<script>

</script>

<?php include(__DIR__ . "/../../footer.php"); ?>