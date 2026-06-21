<?php
require_once __DIR__ . "../../../inc/init.php";
auth("CTR");

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

	$sql = "	SELECT
			user.userID, 
			user.name, 
			user.numTel, 
			user.email,

			report.reportID,
			report.reportCategory,
			report.reportDesc,
			report.reportRoom,
			report.status,
			report.dateReported,
			report.college,
			report.reportImgUrl,
			report.completedImgUrl,
			report.dateAssigned,
			report.remarks

        	FROM report 
		INNER JOIN user ON report.userID = user.userID
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
		<?php $title = "Update Tasks" ?>
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
							<span></span>
							<?php if ($row["status"] == "Completed") : ?>
								<button disabled data-bs-target="#model-mark" data-bs-toggle="modal" class="btn btn-success">Completed</button>
							<?php else : ?>
								<button data-bs-target="#model-mark" data-bs-toggle="modal" class="btn btn-success">Completed</button>
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
						<div>
							<div class="report-detail">
								<div class="input-control">
									<label for="category"><b>RepotID: </b> <?= $row["reportID"] ?></label>
								</div>

								<div class="input-control">
									<label for=""><b>Reporter Name: </b><?= $row["name"] ?></label>
								</div>

								<div class="input-control">
									<label for=""><b>Reporter ID: </b><?= $row["userID"] ?></label>
								</div>

								<div class="input-control">
									<label for=""><b>Phone Number: </b><?= $row["numTel"] ?></label>
								</div>

								<div class="input-control">
									<label for="room"><b>College & Room: </b><?= trim($row["college"]) ?>, <?= $row["reportRoom"] ?></label>
								</div>
							</div>
							<div class="report-detail">

								<div class="input-control">
									<label for=""><b>Email: </b><?= $row["email"] ?></label>
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
						</div>
					</section>
				</div>

				<div class="image-container">
					<section>
						<h4>
							<img src="../../images/report.svg" alt="">
							Report Image
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

				<div class="comment-container">

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
										<td><?= $row["name"] ?></td>
										<td>Report has been Submitted</td>
									</tr>
									<?php if (in_array($row["status"], ["Assigned", "Completed", "In_Progress"])) : ?>
										<tr>
											<td><?= $row["dateAssigned"] ?></td>
											<td><span class="assigned">Assigned</span></td>
											<td>System Admin</td>
											<td>Report Assigned to <?= $_SESSION["name"] ?></td>
										</tr>
									<?php endif ?>
									<?php if (in_array($row["status"], ["Assigned", "Completed", "In_Progress"])) : ?>
										<tr>
											<td><?= $row["dateAssigned"] ?></td>
											<td><span class="inProgress">In Progress</span></td>
											<td><?= $_SESSION["name"] ?>(You)</td>
											<td>Working In Progress</td>
										</tr>
									<?php endif ?>
									<?php if (in_array($row["status"], ["Completed"])) : ?>
										<tr>
											<td><?= $row["dateAssigned"] ?></td>
											<td><span class="completed">Completed</span></td>
											<td><?= $_SESSION["name"] ?>(You)</td>
											<td><?= $row["remarks"] ?></td>
										</tr>
									<?php endif ?>
									<?php if ($row["status"] == "Rejected") : ?>
										<tr>
											<td><?= $row["dateAssigned"] ?></td>
											<td><span class="completed">Rejected</span></td>
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

	<div class="modal fade" id="model-mark">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form onsubmit="handleSubmit(event)" action="" method="POST">
					<div class="modal-header">
						<h4>
							<img src="../../images/report.svg" alt="">
							Close Report
						</h4>
					</div>
					<div class="modal-body">
						<div class="input-control">
							<label for="message">
								<h4>Message</h4>
							</label>
							<input class="message" placeholder="Short Message Before Report End" type="text" name="message"
								id="message">
						</div>
						<div class="input-control">
							<label for="image" class="required">
								<h4>
									Upload Image
								</h4>
							</label>
							<input class="image" hidden type="file" accept="image/*" name="image" id="image">
							<label for="image" class="image-area">
								<button type="button" class="btn btn-close hidden"></button>

								<article>
									<i class="fa-solid fa-file-arrow-up"></i>
									<h5 class="text-drop">Click or Drop Image Here!</h5>
								</article>

							</label>
							<p class="hidden name-file">asd.png</p>

						</div>
					</div>
					<div class="modal-footer">
						<button type="reset" data-bs-dismiss="modal" class="btn btn-danger">
							Clear
						</button>

						<button type="submit" class="btn btn-success">
							Done!
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="model">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<img class="modal-image" src="" alt="">
			</div>
		</div>
	</div>

	<div class="popUpFail hidden">
		<div class="card p-3">
			<h1 class="text-center">🚫</h1>
			<h2>Fail to Update Report</h2>
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
				<h2>Done Update Task</h2>
				<a href="./assignedTasks.php" class="btn btn-success w-100">Ok</a>
			</article>
		</div>
	</div>


	<!-- your script -->
	<script>
		let inputImg = document.getElementById("image");
		let imageArea = document.querySelector(".image-area");
		let btnClose = document.querySelector(".btn-close");
		let nameFile = document.querySelector(".name-file");
		let imageAreaIcon = document.querySelector(".image-area i");
		let textDrop = document.querySelector(".text-drop")
		let currentUrl = null;

		let model = document.getElementById("model")
		let myModal = new bootstrap.Modal(model)
		let images = document.querySelectorAll(".image img")
		let imgURL = ""

		let prew = url => {
			// console.log(url);
			document.querySelector(".modal-image").src = url
			myModal.show()
		}

		const modelMark = bootstrap.Modal.getOrCreateInstance(
			document.getElementById("model-mark")
		);

		let delay = time => new Promise(resolve => setTimeout(resolve, time))

		async function handleSubmit(e) {
			e.preventDefault();

			let mark = e.target.querySelector(".message").value.trim()
			if (mark == "") {
				alert("Type something in Message");
				return;
			}

			if (imgURL == "") {
				alert("Please insert A Photo to Prove");
				return;
			}

			modelMark.hide()
			document.querySelector(".popUpLoading").classList.remove("hidden")
			await delay(2000)

			$.ajax({
				url: "../../api/completedTask.php",
				method: "POST",
				data: {
					reportID: "<?= $_GET["id"] ?>",
					message: mark,
					url: imgURL,
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

		images.forEach(image => image.addEventListener("click", e => prew(e.target.src)));

		function addPhoto(file) {
			if (!file) return;

			if (currentUrl) {
				URL.revokeObjectURL(currentUrl);
			}

			currentUrl = URL.createObjectURL(file);
			let img = new Image()
			img.src = currentUrl
			img.onload = e => {
				let width = e.target.width
				let height = e.target.height

				let ratio = Math.min(600 / width, 600 / height)

				if (ratio < 1) {
					width *= ratio
					height *= ratio
				}

				let canvas = document.createElement("canvas")
				let ctx = canvas.getContext("2d")

				canvas.width = width
				canvas.height = height

				ctx.drawImage(img, 0, 0, width, height)

				imgURL = canvas.toDataURL()

			}

			imageArea.style.backgroundImage = `url(${currentUrl})`;
			imageArea.style.backgroundSize = "cover";
			imageArea.style.backgroundPosition = "center";

			nameFile.textContent = file.name;
			textDrop.classList.add("hidden");
			imageAreaIcon.classList.add("hidden");
			nameFile.classList.remove("hidden");
			btnClose.classList.remove("hidden");
		}

		function removePhoto() {
			if (currentUrl) {
				URL.revokeObjectURL(currentUrl);
				currentUrl = null;
			}

			imageArea.style.backgroundImage = "";

			textDrop.classList.remove("hidden");
			imageAreaIcon.classList.remove("hidden");
			nameFile.classList.add("hidden");
			btnClose.classList.add("hidden");

			nameFile.textContent = "";

			inputImg.value = "";
		}

		btnClose.addEventListener("click", e => {
			e.preventDefault();
			e.stopPropagation();

			removePhoto();
		});

		inputImg.addEventListener("change", e => {
			const file = e.target.files[0];

			if (!file) return;

			addPhoto(file);
		});
		["dragover", "dragenter"].forEach(event => {
			imageArea.addEventListener(event, e => {
				e.preventDefault();

				imageArea.classList.add("hover");
				imageAreaIcon.classList.add("icon-hover");
			})
		});
		["dragleave"].forEach(event => {
			imageArea.addEventListener(event, e => {
				e.preventDefault();

				imageArea.classList.remove("hover");
				imageAreaIcon.classList.remove("icon-hover");
			});
		});
		imageArea.addEventListener("drop", e => {
			e.preventDefault();

			imageArea.classList.remove("hover");
			imageAreaIcon.classList.remove("icon-hover");

			let file = e.dataTransfer.files[0];

			if (!file) return;

			if (!file.type.startsWith("image/")) {
				alert("Please upload image files only.");
				return;
			}

			let dt = new DataTransfer();
			dt.items.add(file);
			inputImg.files = dt.files;

			addPhoto(file);
		});
	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="CTR">
	<input type="text" name="title" id="title" hidden value="Update Tasks">
</body>

</html>