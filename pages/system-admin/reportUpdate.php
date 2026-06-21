<?php
require_once __DIR__ . "../../../inc/init.php";
auth("SAD");

//php code hrre
if (isset($_GET["rejectID"])) {

	$reportId = $_GET["rejectID"];

	$sql = "UPDATE report
            SET status='Rejected'
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
			report.dateAssigned

        	FROM report 
		INNER JOIN user ON report.userID   = user.userID
		WHERE reportId = '$reportId'";

	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	if ($row["status"] == "Assigned") {
		$sql = "	SELECT
			reporter.userID,
			reporter.name,
			reporter.numTel,
			reporter.email,

			contractor.name AS contractorName,
			contractor.email AS contractorEmail,

			report.reportID,
			report.reportCategory,
			report.reportDesc,
			report.reportRoom,
			report.status,
			report.dateReported,
			report.college,
			report.reportImgUrl,
			report.completedImgUrl,
			report.dateAssigned

        	FROM report 
		INNER JOIN user reporter ON report.userID = reporter.userID
		INNER JOIN user contractor ON report.contractorID = contractor.userID
		WHERE reportId = '$reportId'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	}
} else {
	header("Location: reportManage.php");
}

$sql = " SELECT u.userID, u.name, u.email,
    			 u.numTel, c.cType
		FROM user u
		JOIN contractor c
		ON u.userID = c.contractorID
";
$resultContractor = mysqli_query($conn, $sql);
$dataContractor = [];

while ($datas = mysqli_fetch_assoc($resultContractor)) {
	$dataContractor[] = [
		"id" => $datas["userID"],
		"name" => $datas["name"],
		"email" => $datas["email"],
		"no" => $datas["numTel"],
		"cType" => $datas["cType"]
	];
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

						<article>
							<?php if (in_array($row["status"], ["Assigned", "Rejected", "In_Progress"])) : ?>
								<a href="./reportUpdate.php?rejectID=<?= $row["reportID"] ?>" class="btn btn-danger disabled">Reject</a>
								<button data-bs-toggle="modal" data-bs-target="#modalContraktor" class="btn btn-success disabled">Assign</button>

							<?php elseif (in_array($row["status"], ["Completed"])) : ?>
								<a href="./reportUpdate.php?rejectID=<?= $row["reportID"] ?>" class="btn btn-danger disabled">Reject</a>
								<article>
									<button data-bs-toggle="modal" data-bs-target="#modalContraktor" class="btn btn-success disabled">Assign</button>
									<!-- <button class="btn btn-primary mx-1">Ganerate PDF</button> -->
								</article>
							<?php else : ?>
								<a href="./reportUpdate.php?rejectID=<?= $row["reportID"] ?>" class="btn btn-danger">Reject</a>
								<button data-bs-toggle="modal" data-bs-target="#modalContraktor" class="btn btn-success">Assign</button>
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
									<?php if (in_array($row["status"], ["Assigned", "Completed"])) : ?>
										<tr>
											<td><?= $row["dateAssigned"] ?></td>
											<td><span class="assigned">Assigned</span></td>
											<td>System Admin(You)</td>
											<td>Report Assigned to <?= $row["contractorName"] ?></td>
										</tr>
									<?php endif ?>
									<?php if ($row["status"] == "Completed") : ?>
										<tr>
											<td><?= $row["dateAssigned"] ?></td>
											<td><span class="completed">Completed</span></td>
											<td><?= $row["name"] ?></td>
											<td>Report has been Close</td>
										</tr>
									<?php endif ?>
									<?php if ($row["status"] == "Rejected") : ?>
										<tr>
											<td><?= $row["dateAssigned"] ?></td>
											<td><span class="completed">Completed</span></td>
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

	<div class="modal fade" id="modalContraktor">
		<form action="" onsubmit="handleSubmit(event)" method="post">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5">
							<img src="../../images/report.svg" alt="">
							Assign Contractor
						</h1>
					</div>
					<div class="modal-body">

						<section>

							<div class="comment">
								<div class="input-control">
									<label for="selectContractor">Select contractor</label>
									<select name="selectContractor" id="selectContractor">
										<option disabled selected value="">Select contractor</option>
										<?php foreach ($dataContractor as $contractor): ?>
											<option value="<?= $contractor['id'] ?>">
												<?= $contractor['name'] ?>
											</option>
										<?php endforeach; ?>
									</select>
									<p class="hidden my-2" id="emailContractor">lorem@gamail.com</p>
									<p class="hidden mb-2" id="phoneContractor">0197231577</p>
									<p class="hidden mb-2" id="cTypeContractor">IT technician</p>
								</div>
							</div>

						</section>

					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success">Assign!</button>
					</div>
				</div>
			</div>
		</form>
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
			<h2>Fail to Assign Contractor</h2>
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
				<h2>Done Assign Contractor</h2>
				<a href="./reportUpdate.php?id=<?= $_GET["id"] ?>" class="btn btn-success w-100">Ok</a>
			</article>
		</div>
	</div>

	<!-- your script -->
	<script>
		let selectContractor = document.querySelector("#selectContractor")
		let textEmailContractor = document.getElementById("emailContractor")
		let textphoneContractor = document.getElementById("phoneContractor")
		let textcTypeContractor = document.getElementById("cTypeContractor")

		let model = document.getElementById("model")
		let myModal = new bootstrap.Modal(model)

		const modalContraktor = bootstrap.Modal.getOrCreateInstance(
			document.getElementById("modalContraktor")
		);

		let images = document.querySelectorAll(".image")

		let delay = time => new Promise(resolve => setTimeout(resolve, time))

		const prew = url => {
			document.querySelector(".modal-image").src = url;
			myModal.show();
		}

		document.querySelectorAll(".imgReport").forEach(img => {
			img.addEventListener("click", () => {
				prew(img.dataset.src);
			});
		});

		let dataContractor = <?= json_encode($dataContractor) ?>;

		selectContractor.addEventListener("change", e => {
			let id = (e.target.value)
			console.log(id);

			let orang = dataContractor.find(data => data.id == id)

			textEmailContractor.classList.remove("hidden")
			textphoneContractor.classList.remove("hidden")
			textcTypeContractor.classList.remove("hidden")

			textEmailContractor.textContent = orang.email
			textphoneContractor.textContent = orang.no
			textcTypeContractor.textContent = orang.cType
		})

		async function handleSubmit(e) {
			e.preventDefault();
			let idConst = e.target.querySelector("select").value
			if (idConst == "") {
				alert("Sila Pilih Contractor")
				return
			} else {
				modalContraktor.hide();
				document.querySelector(".popUpLoading").classList.remove("hidden")
				await delay(2000)
				$.ajax({
					url: "../../api/assignContractor.php",
					method: "POST",
					data: {
						reportID: "<?= $_GET["id"] ?>",
						contractorID: idConst,
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

		}
	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="SAD">
	<input type="text" name="title" id="title" hidden value="Update Report">
</body>

</html>