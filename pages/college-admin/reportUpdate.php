<?php
require_once __DIR__ . "../../../inc/init.php";
auth("CAD");

//php code hrre
if (isset($_GET["rejectID"])) {

	$reportId = $_GET["rejectID"];

	$sql = "UPDATE report
            SET status='Canceled'
            WHERE reportId='$reportId'";

	if (mysqli_query($conn, $sql)) {
		header("Location: reportUpdate.php?id=$reportId");
		exit;
	} else echo mysqli_error($conn);
} else if (isset($_GET["id"])) {
	$reportId = $_GET["id"];

	$sql = "SELECT *
        	FROM report
        	WHERE reportId = '$reportId'";

	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
} else {
	header("Location: reportManage.php");
}
//php code hrre

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- your styling -->
	<link rel="stylesheet" href="../../style/form.css">
</head>

<body>

	<section class="_workspace">
		<?php $title = "Update Report" ?>
		<?php include(__DIR__ . "../../../components/system-admin/header.php") ?>
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
									<div class="dot <?= in_array($row["status"], ["Pending", "Assigned", "In_Progress", "Completed"]) ? "active" : "" ?> "></div>
									<div class="desh"></div>
									<div class="dot <?= in_array($row["status"], ["Assigned", "In_Progress", "Completed"]) ? "active" : "" ?>"></div>
									<div class="desh"></div>
									<div class="dot <?= in_array($row["status"], ["In_Progress", "Completed"]) ? "active" : "" ?>"></div>
									<div class="desh"></div>
									<div class="dot <?= in_array($row["status"], ["Completed"]) ? "active" : "" ?>"></div>
								</article>
								<article>
									<p class="<?= in_array($row["status"], ["Pending", "Assigned", "In_Progress", "Completed"]) ? "text-active" : "" ?>">Pending</p>
									<p></p>
									<p class="<?= in_array($row["status"], ["Assigned", "In_Progress", "Completed"]) ? "text-active" : "" ?>">Assigned</p>
									<p></p>
									<p class="<?= in_array($row["status"], ["In_Progress", "Completed"]) ? "text-active" : "" ?>">In Progress</p>
									<p></p>
									<p class="<?= in_array($row["status"], ["Completed"]) ? "text-active" : "" ?>">Completed</p>
								</article>

							</div>
						</div>

						<article>
							<?php if ($row["status"] == "Canceled") : ?>
								<button href="./reportUpdate.php?rejectID=<?= $row["reportID"] ?>" class="btn btn-danger disabled">Reject</button>
								<button data-bs-toggle="modal" data-bs-target="#modalContraktor" class="btn btn-success disabled">Forward</button>
							<?php elseif ($row["status"] == "Assigned") : ?>
								<button href="./reportUpdate.php?rejectID=<?= $row["reportID"] ?>" class="btn btn-danger disabled">Reject</button>
								<button data-bs-toggle="modal" data-bs-target="#modalContraktor" class="btn btn-success disabled">Forward</button>
							<?php else : ?>
								<button href="./reportUpdate.php?rejectID=<?= $row["reportID"] ?>" class="btn btn-danger">Reject</button>
								<button onclick="handleForward(event)" data-bs-toggle="modal" data-bs-target="#modalContraktor" class="btn btn-success">Forward</button>
							<?php endif ?>
						</article>
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
								<textarea readonly type="text" name="description" id="description"><?= $row["reportDesc"] ?></textarea>
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
							<div class="other">
								<p>USer</p>
								Mana Wifi
							</div>
							<div class="me">
								<p>Me</p>
								Sabo
							</div>
						</div>

						<div class="comment">
							<div class="input-control">
								<label for="description">Comment</label>
								<textarea type="text" name="description" id="description"></textarea>
							</div>
						</div>

						<article>
							<button class="btn btn-success">Submit</button>
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
							<div class="imgReport"
								data-src="<?= $row["reportImgUrl"] ?? "" ?>"
								style="background-image:url('<?= $row["reportImgUrl"] ?? "" ?>')">
							</div>
							<div class="imgReport"
								data-src="<?= $row["completedImgUrl"] ?? "" ?>"
								style="background-image:url('<?= $row["completedImgUrl"] ?? "" ?>')">
							</div>
						</div>
					</section>
				</div>
			</section>

		</main>
		<!-- CONTENT HERE -->

	</section>


	<div class="popUpFail hidden">
		<div class="card p-3">
			<h1 class="text-center">🚫</h1>
			<h2>Fail to Forward Report</h2>
			<a href="" class="btn btn-success">Ok</a>
		</div>
	</div>
	<div class="popUpLoading hidden">
		<div class="loading-container">
			<div class="loading-circle"></div>
			<div class="loading-circle"></div>
			<div class="loading-circle"></div>
			<div class="loading-circle"></div>
		</div>
		<div class="bulat">
			<article>
				<h1 class="text-center">✅</h1>
				<h2>Done Forward Report</h2>
				<a href="./reportUpdate.php?id=<?= $_GET["id"] ?>" class="btn btn-success w-100">Ok</a>
			</article>
		</div>
	</div>

	<!-- your script -->
	<script>
		let delay = time => new Promise(resolve => setTimeout(resolve, time))

		async function handleForward(e) {
			e.preventDefault();
			document.querySelector(".popUpLoading").classList.remove("hidden")
			await delay(2000)
			$.ajax({
				url: "../../api/handleForward.php",
				method: "POST",
				data: {
					reportID: "<?= $_GET["id"] ?>",
				},
				success: response => {
					console.log(response);
					document.querySelector(".popUpLoading .bulat").style.animation = "fadeIN 0.2s forwards"
					document.querySelector(".popUpLoading .bulat > *").style.animation = "show 0.3s forwards"
				},
				error: error => {
					console.log(error);
					document.querySelector(".popUpLoading").classList.add("hidden");
					document.querySelector(".popUpFail").classList.remove("hidden");
				}
			})
		}
	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="CAD">

	<input type="text" name="title" id="title" hidden value="Update Report">
</body>

</html>