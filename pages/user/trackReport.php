<?php
require_once __DIR__ . "../../../inc/init.php";
auth("STD");

//php code hrre

if (isset($_GET["id"])) {
	$reportId = $_GET["id"];

	$sql = "SELECT *
        	FROM report
        	WHERE reportId = '$reportId'";

	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
} else {
	header("Location: myReport.php");
}

//php code hrre

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- your styling -->
	<link rel="stylesheet" href="../../style/pages/user/trackReport.css">
</head>

<body>

	<section class="_workspace">
		<?php $title = "Track Report" ?>
		<?php include(__DIR__ . "../../../components/user/header.php") ?>

		<!-- CONTENT HERE -->
		<main class="_content-area">

			<section>
				<div class="progress-container">
					<section>
						<h4>
							<img src="../../images/progres.svg" alt="">
							Progress
						</h4>
						<div class="track-progress">
							<div>
								<article>
									<div class="dot <?= $row["status"] == "Pending" ? "active" : "" ?> "></div>
									<div class="desh"></div>
									<div class="dot <?= $row["status"] == "Assigned" ? "text-active" : "" ?>"></div>
									<div class="desh"></div>
									<div class="dot <?= $row["status"] == "Assigned" ? "text-active" : "" ?>"></div>
									<div class="desh"></div>
									<div class="dot <?= $row["status"] == "Completed" ? "text-active" : "" ?>"></div>
								</article>
								<article>
									<p class="<?= $row["status"] == "Pending" ? "text-active" : "" ?>">Pending</p>
									<p></p>
									<p class="<?= $row["status"] == "Assigned" ? "text-active" : "" ?>">Assigned</p>
									<p></p>
									<p class="<?= $row["status"] == "In Progress" ? "text-active" : "" ?>">In Progress</p>
									<p></p>
									<p class="<?= $row["status"] == "Completed" ? "text-active" : "" ?>">Completed</p>
								</article>
							</div>
						</div>
					</section>

				</div>

				<div class="report-detail-container">

					<section>
						<h4>
							<img src="../../images/report.svg" alt="">
							Report Detail
						</h4>
						<div class="report-detail">

							<div class="input-control">
								<label for="category">category</label>
								<input value="<?= $row["reportCategory"] ?>" readonly type="text" name="category" id="category">
							</div>

							<div class="input-control">
								<label for="description">Description</label>
								<textarea readonly type="text" name="description" id="description">
									<?= $row["reportDesc"] ?>
								</textarea>
							</div>

							<div class="input-control">
								<label for="college">College</label>
								<input readonly type="text" name="college" value="<?= trim($row["reportCategory"]) ?>" id="college">
							</div>

							<div class="input-control">
								<label for="room">Room</label>
								<input value="<?= $row["reportRoom"] ?>" readonly type="text" name="room" id="room">
							</div>
						</div>

					</section>

				</div>

				<div class="comment-container">
					<section>
						<h4>
							<img src="../../images/report.svg" alt="">
							Comment
						</h4>
						<div class="chat">
							<div class="me">
								<p>Me</p>
								Mana Wifi Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae,
								dolorum.
							</div>
							<div class="other">
								<p>Admin</p>
								Sabo
							</div>
						</div>

						<div class="comment">
							<div class="input-control">
								<label for="description">
									Comment
								</label>
								<textarea type="text" name="description" id="comment-description"></textarea>
							</div>
						</div>

						<article>
							<button id="btn_submit-comment" class="btn btn-success">Submit</button>
						</article>
					</section>
				</div>

				<div class="image-container">
					<section>
						<h4>
							<img src="../../images/report.svg" alt="">
							Report Image
						</h4>

						<div class="image imgReportgroup">
							<div class="imgReport" style="background-image: url('<?= $row["reportImgUrl"] ?>')"></div>
							<div class="imgReport"></div>
						</div>
					</section>
				</div>
			</section>

		</main>
		<!-- CONTENT HERE -->

	</section>

	<!-- your script -->
	<script>
		$("#btn_submit-comment").click(() => {
			let desc = $("#comment-description").val();
			$(".chat").append('<div class="me"><p>Me</p>' + desc + '</div>');
			$("#comment-description").val("");
		});
	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="USER">
	<input type="text" name="title" id="title" hidden value="Track Report">
</body>

</html>