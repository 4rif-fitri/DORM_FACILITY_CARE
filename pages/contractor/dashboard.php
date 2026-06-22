<?php
require_once __DIR__ . "../../../inc/init.php";
auth("CTR", $_SESSION["type"] ?? null);

//php code hrre
$contractorID = $_SESSION["userID"];

$sql = "SELECT

COUNT(*) AS totalReport,

COALESCE(SUM(CASE WHEN status='Assigned' THEN 1 ELSE 0 END),0) AS assignedReport,
COALESCE(SUM(CASE WHEN status='In_Progress' THEN 1 ELSE 0 END),0) AS progressReport,
COALESCE(SUM(CASE WHEN status='Completed' THEN 1 ELSE 0 END),0) AS completedReport

FROM report

WHERE contractorID = '$contractorID'";

$result = mysqli_query($conn, $sql);

$data = mysqli_fetch_assoc($result);

$totalReport = $data['totalReport'];
$assignedReport = $data['assignedReport'];
$progressReport = $data['progressReport'];
$completedReport = $data['completedReport'];
//php code hrre

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- your styling -->
	<link rel="stylesheet" href="../../style/dashboard.css">
</head>

<body>

	<section class="_workspace">
		<?php $title = "Dashboard" ?>
		<?php include(__DIR__ . "../../../components/system-admin/header.php") ?>
		<!-- CONTENT HERE -->
		<main class="_content-area">
			<div class="dashboard-area">

				<!-- BIG TOTAL CARD -->
				<a href="completedTasks.php" style="text-decoration: none;">
					<div class="dashboard-total-card">
						<div class="dashboard-header">
							<img class="dashboard-icon" src="../../images/total.svg" alt="">
							<h2>Total Tasks</h2>
						</div>

						<p id="totalReport"><?= $totalReport ?></p>
					</div>
				</a>

				<!-- SMALL CARDS -->
				<div class="dashboard-stats">

					<div class="dashboard-box">
						<div class="dashboard-header">
							<img class="dashboard-icon" src="../../images/assigned.svg" alt="">
							<h2>Assigned</h2>
						</div>

						<p id="assignedReport"><?= $assignedReport ?></p>
					</div>

					<div class="dashboard-box">
						<div class="dashboard-header">
							<img class="dashboard-icon" src="../../images/inprogress.svg" alt="">
							<h2>In Progress</h2>
						</div>

						<p id="progressReport"><?= $progressReport ?></p>
					</div>

					<div class="dashboard-box">
						<div class="dashboard-header">
							<img class="dashboard-icon" src="../../images/completed.svg" alt="">
							<h2>Completed</h2>
						</div>

						<p id="completedReport"><?= $completedReport ?></p>
					</div>

				</div>

			</div>



		</main>
		<!-- CONTENT HERE -->

	</section>

	<!-- your script -->
	<script>

	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="CTR">
	<input type="text" name="title" id="title" hidden value="Dashboard">
</body>

</html>