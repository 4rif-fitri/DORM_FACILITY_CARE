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
	<link rel="stylesheet" href="../../style/reportDisplay.css">
</head>

<body>

	<section class="_workspace">
		<?php $title = "My Report" ?>
		<?php include(__DIR__ . "../../../components/user/header.php") ?>

		<!-- CONTENT HERE -->
		<main class="_content-area">
			<nav class="filter-box">
				<a href="" class="filterBtn filtered">all</a>
				<a href="" class="filterBtn">pending</a>
				<a href="" class="filterBtn">assigned</a>
				<a href="" class="filterBtn">in progress</a>
				<a href="" class="filterBtn">completed</a>
			</nav>

			<section class="table-container">
				<table class="myReportTbl trackingReportTbl">
					<thead>
						<tr>
							<th>Id</th>
							<th>Category</th>
							<th>Description</th>
							<th>Date</th>
							<th>Status</th>
							<th>Track</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>067</td>
							<td>No wifi</td>
							<td>Aku Nak IFI</td>
							<td>28/5/2026</td>
							<td>Pending</td>
							<td><a href="./trackReport.php" class="updateBtn">Track</a></td>
						</tr>

						<tr>
							<td>067</td>
							<td>No wifi</td>
							<td>Aku Nak IFI</td>
							<td>28/5/2026</td>
							<td>Pending</td>
							<td><a href="./trackReport.php" class="updateBtn">Track</a></td>
						</tr>
					</tbody>

				</table>
			</section>

		</main>
	</section>

	<!-- your script -->
	<script>
		document.querySelectorAll("tr").forEach(tr => {
			tr.addEventListener("click", e => {
				console.log(tr)
			})
		})
	</script>


	<!-- testing only -->
	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="USER">
	<input type="text" name="title" id="title" hidden value="My Report">
</body>

</html>