<?php
require_once __DIR__ . "../../../inc/init.php";
auth("SAD");

//php code hrre
$userID = $_SESSION["userID"];

$sql = "	SELECT 	reportID, 
				reportCategory, 	
				reportDesc, 
				dateReported, 
				status
        	FROM report
		WHERE status = 'Pending'
		ORDER BY dateReported DESC
		";

if (isset($_GET["status"])) {
	$status = $_GET["status"];
	if ($status != "All") {
		$sql = "	SELECT 	reportID, 
				reportCategory, 	
				reportDesc, 
				dateReported, 
				status
			FROM report
			WHERE status = '$status'
			ORDER BY dateReported DESC
			";
	}else{
		$sql = "	SELECT 	reportID, 
				reportCategory, 	
				reportDesc, 
				dateReported, 
				status
        	FROM report
		ORDER BY dateReported DESC
		";
	}
}

$result = mysqli_query($conn, $sql);
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
				<a href="reportManage.php?status=All" class="filterBtn">All</a>
				<a href="reportManage.php?status=Canceled" class="filterBtn">Canceled</a>
				<a href="reportManage.php?status=Pending" class="filterBtn">Pending</a>
				<a href="reportManage.php?status=Assigned" class="filterBtn">Assigned</a>
				<a href="reportManage.php?status=In_Progress" class="filterBtn">In Progress</a>
				<a href="reportManage.php?status=Completed" class="filterBtn">Completed</a>
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
						<?php while ($row = mysqli_fetch_assoc($result)) : ?>
							<tr>
								<td><?= $row["reportID"] ?></td>
								<td><?= $row["reportCategory"] ?></td>
								<td><?= $row["reportDesc"] ?></td>
								<td><?= $row["dateReported"] ?></td>
								<td><?= $row["status"] ?></td>
								<td><a href="./reportUpdate.php?id=<?= $row["reportID"] ?>" class="updateBtn">Update</a></td>
							</tr>
						<?php endwhile ?>
					</tbody>

				</table>
			</section>

		</main>
		<!-- CONTENT HERE -->

	</section>

	<!-- your script -->
	<script>
		const params = new URLSearchParams(window.location.search);
		const status = params.get("status");
		let filterBox = document.querySelectorAll(".filter-box a")
		filterBox.forEach(box => box.classList.remove("filtered"))

		if (status == "All" || status == null) filterBox[0].classList.add("filtered")
		else if (status == "Canceled") filterBox[1].classList.add("filtered")
		else if (status == "Pending") filterBox[2].classList.add("filtered")
		else if (status == "Assigned") filterBox[3].classList.add("filtered")
		else if (status == "In_Progress") filterBox[4].classList.add("filtered")
		else if (status == "Completed") filterBox[5].classList.add("filtered")
	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="SAD">
	<input type="text" name="title" id="title" hidden value="Manage Report">
</body>
</body>

</html>