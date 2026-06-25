<?php
require_once __DIR__ . "../../../inc/init.php";
auth("SAD", $_SESSION["type"] ?? null);

//php code hrre
if (isset($_GET["rejectID"])) {

	$reportId = $_GET["rejectID"];

	$sql = "UPDATE report
            SET status='Rejected',
		  dateRejected = NOW()
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

			report.*

        	FROM report 
		INNER JOIN user ON report.userID   = user.userID
		WHERE reportId = '$reportId'";

	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	if (in_array($row["status"], ["Assigned", "In_Progress", "Completed"])) {
		$sql = "SELECT
    reporter.userID,
    reporter.name,
    reporter.numTel,
    reporter.email,

    contractor.name AS contractorName,
    contractor.email AS contractorEmail,
    c.statuss AS contractorStatus,

    report.*

FROM report
INNER JOIN user reporter ON report.userID = reporter.userID
INNER JOIN user contractor ON report.contractorID = contractor.userID
INNER JOIN contractor c ON contractor.userID = c.contractorID
WHERE reportId = '$reportId'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
	}

	// fetch comments
	$sql = "	SELECT *
	    		FROM comments
    			INNER JOIN user u ON comments.userID  = u.userID
    			WHERE comments.reportID = '$reportId'";
	$comments = mysqli_query($conn, $sql);
} else {
	header("Location: reportManage.php");
}

$sql = "SELECT u.userID, u.name, u.email,
               u.numTel, c.expertise, c.statuss
        FROM user u
        JOIN contractor c
            ON u.userID = c.contractorID
        ORDER BY 
	   		CASE WHEN c.statuss = 'Available' THEN 1
               ELSE 2
          	END,
            u.name ASC";
$resultContractor = mysqli_query($conn, $sql);
$dataContractor = [];

while ($datas = mysqli_fetch_assoc($resultContractor)) {
	$dataContractor[] = [
		"id" => $datas["userID"],
		"name" => $datas["name"],
		"email" => $datas["email"],
		"no" => $datas["numTel"],
		"expertise" => $datas["expertise"],
		"status" => $datas["statuss"],
	];
}

// comment posting
if (isset($_POST['submit'])) {
	try {
		$desc = $_POST["description"];
		$userID = $_SESSION["userID"];
		$sqlComment = "INSERT INTO comments
					(theComment, reportID, userID)
					VALUES
					('$desc', $reportId, '$userID')
		";
		mysqli_query($conn, $sqlComment);

		header("Location: reportUpdate.php?id=$reportId");
	} catch (mysqli_sql_exception $e) {
		$msg = $e->getMessage();

		echo "<script>alert('Failed: $msg');
			window.location.href='reportUpdate.php?id=$reportId';
		</script>";
	}
}

// comment deleting
if (isset($_GET['cid'])) {
	try {
		$commentID = $_GET['cid'];

		$sql = "DELETE FROM comments
        	    WHERE commentsID = $commentID
				";
		mysqli_query($conn, $sql);

		header("Location: reportUpdate.php?id=$reportId");
	} catch (mysqli_sql_exception $e) {
		$msg = $e->getMessage();

		echo "<script>alert('Failed: $msg');
			window.location.href='reportUpdate.php?id=$reportId';
		</script>";
	}
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
							<?php
							while ($comment = mysqli_fetch_assoc($comments)) {
								if ($comment["userID"] == $_SESSION["userID"]) {
									echo '<div class="me">
										<p>Me</p>';
								} else {
									echo '<div class="other">';
									switch ($comment["type"]) {
										case "SAD":
											echo '<p>Admin</p>';
											break;
										case "STD":
											echo '<p>Student</p>';
											break;
										case "STF":
											echo '<p>Staff</p>';
											break;
										case "CTR":
											echo '<p>Contractor</p>';
											break;
									}
								}
								echo "<p>$comment[theComment]</p>";
								if ($comment["userID"] == $_SESSION["userID"]) // deletable if user's own comment
									echo "<a href='reportUpdate.php?id=$reportId&cid=$comment[commentsID]' class='deleteBtn'>Delete</a>";
								echo '</div>';
							}
							?>
						</div>

						<form action="" method="POST">
							<div class="comment">
								<div class="input-control">
									<label for="description">Comment</label>
									<textarea type="text" name="description" id="description" required></textarea>
								</div>
							</div>

							<article>
								<button name="submit" class="btn btn-success">Submit</button>
							</article>
						</form>
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
							Image from Contractor
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
											<td>System Admin(You)</td>
											<td>Report Assigned to <?= $row["contractorName"] ?></td>
										</tr>
									<?php endif ?>
									<?php if (in_array($row["status"], ["Completed", "In_Progress"])) : ?>
										<tr>
											<td><?= $row["dateInProgress"] ?></td>
											<td><span class="inProgress">In Progress</span></td>
											<td><?= $row["contractorName"] ?></td>
											<td>Working In Progress</td>
										</tr>
									<?php endif ?>
									<?php if ($row["status"] == "Completed") : ?>
										<tr>
											<td><?= $row["dateCompleted"] ?></td>
											<td><span class="completed">Completed</span></td>
											<td><?= $row["contractorName"] ?></td>
											<td><?= $row["remarks"] ?></td>
										</tr>
									<?php endif ?>
									<?php if ($row["status"] == "Rejected") : ?>
										<tr>
											<td><?= $row["dateRejected"] ?></td>
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
									<p class="hidden my-2" id="emailContractor">lorem@gamail.com</p>
									<p class="hidden mb-2" id="phoneContractor">0197231577</p>
									<p class="hidden mb-2" id="expertiseContractor">IT technician</p>
									<label for="selectContractor">Select contractor</label>
									<?php
									$reportCategory = trim(strtolower($row["reportCategory"]));
									$recommendedContractor = [];
									$otherContractor = [];

									foreach ($dataContractor as $contractor) {

										$expertise = trim(strtolower($contractor["expertise"]));

										if ($expertise === $reportCategory) {
											$recommendedContractor[] = $contractor;
										} else {
											$otherContractor[] = $contractor;
										}
									}
									?>

									<select name="selectContractor" id="selectContractor">
										<option disabled selected value="">Select contractor</option>

										<?php if (!empty($recommendedContractor)): ?>
											<optgroup label="Recommended (Matching Expertise)">
												<?php foreach ($recommendedContractor as $contractor): ?>
													<option <?= $contractor['status'] != "Available" ? "disabled" : "" ?> value="<?= $contractor['id'] ?>">
														<?= $contractor['name'] ?> (<?= $contractor['expertise'] ?>)
													</option>
												<?php endforeach; ?>
											</optgroup>
										<?php endif; ?>

										<?php if (!empty($otherContractor)): ?>
											<optgroup label="<?= !empty($recommendedContractor) ? 'Other Contractors' : 'All Available Contractors' ?>">
												<?php foreach ($otherContractor as $contractor): ?>
													<option <?= $contractor['status'] != "Available" ? "disabled" : "" ?> value="<?= $contractor['id'] ?>">
														<?= $contractor['name'] ?> (<?= $contractor['expertise'] ?>) <?= $contractor['status'] != "Available" ? " - Not Available" : "" ?>
													</option>
												<?php endforeach; ?>
											</optgroup>
										<?php endif; ?>

										<?php if (empty($recommendedContractor) && empty($otherContractor)): ?>
											<option disabled>No available contractor</option>
										<?php endif; ?>
									</select>
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
		let textExpertiseContractor = document.getElementById("expertiseContractor")

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
			textExpertiseContractor.classList.remove("hidden")

			textEmailContractor.innerHTML = `<b>Email: </b> ${orang.email}`
			textphoneContractor.innerHTML = `<b>Phone Number: </b> ${orang.no}`
			textExpertiseContractor.innerHTML = `<b>Expertise: </b> ${orang.expertise}`
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