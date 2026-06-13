<?php
require_once __DIR__ . "../../../inc/init.php";
auth("STD");

//php code hrre

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
		<?php include(__DIR__ . "../../../components/user/header.php") ?>

		<!-- CONTENT HERE -->
		<main class="_content-area">
			<div class="dashboard-area">

				<!-- BIG TOTAL CARD -->
				<a href="myReport.php">
					<div class="dashboard-total-card">
						<div class="dashboard-header">
							<img class="dashboard-icon" src="../../images/total.svg" alt="">
							<h2>Total Reports</h2>
						</div>

						<p id="totalReport">2</p>
					</div>
				</a>

				<!-- SMALL CARDS -->
				<div class="dashboard-stats">
					<div class="dashboard-box">
						<div class="dashboard-header">
							<img class="dashboard-icon" src="../../images/pending.svg" alt="">
							<h2>Pending</h2>
						</div>

						<p id="pendingReport">0</p>
					</div>

					<div class="dashboard-box">
						<div class="dashboard-header">
							<img class="dashboard-icon" src="../../images/assigned.svg" alt="">
							<h2>Assigned</h2>
						</div>

						<p id="assignedReport">1</p>
					</div>

					<div class="dashboard-box">
						<div class="dashboard-header">
							<img class="dashboard-icon" src="../../images/inprogress.svg" alt="">
							<h2>In Progress</h2>
						</div>

						<p id="progressReport">0</p>
					</div>

					<div class="dashboard-box">
						<div class="dashboard-header">
							<img class="dashboard-icon" src="../../images/completed.svg" alt="">
							<h2>Completed</h2>
						</div>

						<p id="completedReport">1</p>
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
	<input type="text" name="role" id="role" hidden value="USER">
	<input type="text" name="title" id="title" hidden value="Dashboard">
</body>

</html>