<?php
require_once __DIR__ . "../../../inc/init.php";
auth("SAD");

//php code hrre

//php code hrre

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- your styling -->
	<link rel="stylesheet" href="../../style/reportDisplay.css">
</head>

<body>

	<section class="_workspace">
		<?php $title = "Manage Report" ?>
		<?php include(__DIR__ . "../../../components/system-admin/header.php") ?>

		<!-- CONTENT HERE -->
		<main class="_content-area">
			<nav class="filter-box">
				<a href="" class="filterBtn">all</a>
				<a href="" class="filterBtn">canceled</a>
				<a href="" class="filterBtn">pending</a>
				<a href="" class="filterBtn">assigned</a>
				<a href="" class="filterBtn">in progress</a>
				<a href="" class="filterBtn">completed</a>
			</nav>

			<section class="table-container">
				<table class="myReportTbl">
					<thead>
						<tr>
							<th>Id</th>
							<th>Category</th>
							<th>Location</th>
							<th>Date</th>
							<th>Status</th>
							<th>Edit</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>067</td>
							<td>No wifi</td>
							<td>Al-Jazari A-5-4-B-(2)</td>
							<td>28/5/2026</td>
							<td>Pending</td>
							<td><a href="./reportUpdate.php" class="updateBtn">Update</a></td>
						</tr>

						<tr>
							<td>067</td>
							<td>No wifi</td>
							<td>Al-Jazari A-5-4-B-(1)</td>
							<td>28/5/2026</td>
							<td>Pending</td>
							<td>
								<a href="./reportUpdate.php" class="updateBtn">Update</a>
							</td>
						</tr>
					</tbody>

				</table>
			</section>

		</main>
		<!-- CONTENT HERE -->

	</section>

	<!-- your script -->
	<script>

	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="SAD">
	<input type="text" name="title" id="title" hidden value="Manage Report">
</body>
</body>

</html>