<?php
require_once __DIR__ . "../../../inc/init.php";
auth("STD");

//php code hrre

if (isset($_GET["id"])) {
	$reportId = $_GET["id"];

	$sql = "	SELECT *
        		FROM report
        		INNER JOIN user u ON report.userID  = u.userID 
        		-- INNER JOIN contractor c ON report.contractorID = c.contractorID
        		WHERE report.reportID = '$reportId'";

	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	if (in_array($row["status"], ["Assigned", "In_Progress", "Completed"])) {
		$sql = "	SELECT *
        		FROM report
        		INNER JOIN user u ON report.contractorID = u.userID 
        		INNER JOIN contractor c ON report.contractorID = c.contractorID
        		WHERE report.reportID = '$reportId'";

		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
	}
} else {
	header("Location: myReport.php");
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
									<div class="dot <?= in_array($row["status"], ["Pending", "Assigned", "In_Progress", "Completed", "Rejected"]) ? "active" : "" ?> "></div>
									<div class="desh"></div>
									<?php if ($row["status"] == "Rejected") : ?>
										<div class="dot <?= in_array($row["status"], ["Rejected"]) ? "active" : "" ?>"></div>
									<?php else : ?>
										<div class="dot <?= in_array($row["status"], ["Assigned", "In_Progress", "Completed"]) ? "active" : "" ?>"></div>
										<div class="desh"></div>
										<div class="dot <?= in_array($row["status"], ["In_Progress", "Completed"]) ? "active" : "" ?>"></div>
										<div class="desh"></div>
										<div class="dot <?= in_array($row["status"], ["Completed"]) ? "active" : "" ?>"></div>
									<?php endif ?>
								</article>
								<article>
									<p class="<?= in_array($row["status"], ["Pending", "Assigned", "In_Progress", "Completed", "Rejected"]) ? "text-active" : "" ?>">Pending</p>
									<p></p>
									<?php if ($row["status"] == "Rejected") : ?>
										<p class="<?= in_array($row["status"], ["Rejected"]) ? "text-active" : "" ?>">Rejected</p>
									<?php else : ?>
										<p class="<?= in_array($row["status"], ["Assigned", "In_Progress", "Completed"]) ? "text-active" : "" ?>">Assigned</p>
										<p></p>
										<p class="<?= in_array($row["status"], ["In_Progress", "Completed"]) ? "text-active" : "" ?>">In Progress</p>
										<p></p>
										<p class="<?= in_array($row["status"], ["Completed"]) ? "text-active" : "" ?>">Completed</p>
									<?php endif ?>
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
						<div>
							<div class="report-detail">
								<div class="input-control">
									<label for=""><b>RepotID: </b><?= $row["reportID"] ?></label>
								</div>

								<div class="input-control">
									<label for=""><b>Reporter Name: </b><?= $row["name"] ?></label>
								</div>

								<div class="input-control">
									<label for=""><b>Reporter ID: </b><?= $row["userID"] ?></label>
								</div>

								<div class="input-control">
									<label for="room"><b>College & Room: </b><?= trim($row["college"]) ?>, <?= $row["reportRoom"] ?></label>
								</div>
							</div>
							<div class="report-detail">

								<div class="input-control">
									<label for=""><b>Email: </b> <?= $row["email"] ?></label>
								</div>

								<div class="input-control">
									<label for="category"><b>Category: </b><?= $row["reportCategory"] ?></label>
								</div>

								<div class="input-control">
									<label for="description"><b>Description: </b><?= $row["reportDesc"] ?></label>
								</div>

								<div class="input-control">
									<label for="description"><b>Report Date: </b><?= $row["dateReported"] ?></label>
								</div>
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
							<div class="imgReport"
								data-src="<?= $row["reportImgUrl"] ?? "" ?>"
								style="background-image:url('<?= $row["reportImgUrl"] ?? "" ?>')">
							</div>
						</div>
					</section>
				</div>

				<div class="image-container">
					<section>
						<h4>
							<img src="../../images/report.svg" alt="">
							Image from CONTRACTOR
						</h4>
						<?php if ($row["completedImgUrl"] != "") : ?>
							<div class="image imgReportgroup">
								<div class="imgReport"
									data-src="<?= $row["completedImgUrl"] ?? "" ?>"
									style="background-image:url('<?= $row["completedImgUrl"] ?? "" ?>')">
								</div>
							</div>
						<?php else : ?>
							<center>
								<h2>No Image Yet</h2>
							</center>
						<?php endif ?>
					</section>
				</div>


				<div class="history-container">

					<section>
						<h4>
							<img src="../../images/report.svg" alt="">
							Update History
						</h4>
						<div class="report-detail">

							<table class="w-100 table">
								<thead>
									<tr>
										<th>Date & Time</th>
										<th>Status</th>
										<th>Update By</th>
										<th>Remarks</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?= $row["dateReported"] ?></td>
										<td><span class="pending">Pending</span></td>
										<td><?= $_SESSION["name"] ?> (You)</td>
										<td>Report has been Submitted</td>
									</tr>
									<?php if (in_array($row["status"], ["Assigned", "Completed", "In_Progress"])) : ?>
										<tr>
											<td><?= $row["dateAssigned"] ?></td>
											<td><span class="assigned">Assigned</span></td>
											<td>System Admin</td>
											<td>Report Assigned to <?= $row["name"] ?></td>
										</tr>
									<?php endif ?>
									<?php if (in_array($row["status"], ["In_Progress", "Completed"])) : ?>
										<tr>
											<td><?= $row["dateAssigned"] ?></td>
											<td><span class="inProgress">In Progress</span></td>
											<td><?= $row["name"] ?></td>
											<td>Working In Progress</td>
										</tr>
									<?php endif ?>
									<?php if ($row["status"] == "Completed") : ?>
										<tr>
											<td><?= $row["dateAssigned"] ?></td>
											<td><span class="completed">Completed</span></td>
											<td><?= $row["name"] ?></td>
											<td><?= $row["remarks"] ?></td>
										</tr>
									<?php endif ?>
									<?php if ($row["status"] == "Rejected") : ?>
										<tr>
											<td><?= $row["dateAssigned"] ?></td>
											<td><span class="rejected">Rejected</span></td>
											<td>System Admin</td>
											<td>Report has been rejected</td>
										</tr>
									<?php endif ?>
								</tbody>
							</table>

						</div>
					</section>

				</div>
			</section>

		</main>
		<!-- CONTENT HERE -->

	</section>

	<div class="modal fade" id="model">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<img class="modal-image" src="" alt="">
			</div>
		</div>
	</div>

	<!-- your script -->
	<script>
		$("#btn_submit-comment").click(() => {
			let desc = $("#comment-description").val();
			$(".chat").append('<div class="me"><p>Me</p>' + desc + '</div>');
			$("#comment-description").val("");
		});

		let model = document.getElementById("model")
		let myModal = new bootstrap.Modal(model)

		let images = document.querySelectorAll(".image")

		const prew = url => {
			document.querySelector(".modal-image").src = url;
			myModal.show();
		}

		document.querySelectorAll(".imgReport").forEach(img => {
			img.addEventListener("click", () => {
				prew(img.dataset.src);
			});
		});
	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="USER">
	<input type="text" name="title" id="title" hidden value="Track Report">
</body>

</html>