<?php
require_once __DIR__ . "../../../inc/init.php";
auth("STD");

//php code hrre
$userID = $_SESSION["userID"];

$sql = "	SELECT 	reportID, 
				reportCategory, 	
				reportDesc, 
				dateReported, 
				status
        	FROM report
        	WHERE userID = '$userID'
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
			WHERE status = '$status' AND 
			userID = '$userID'
			ORDER BY dateReported DESC
			";
	}
}

$result = mysqli_query($conn, $sql);

// php code hrre

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
				<a href="myReport.php?status=All" class="filterBtn filtered">all</a>
				<a href="myReport.php?status=Pending" class="filterBtn">pending</a>
				<a href="myReport.php?status=Assigned" class="filterBtn">assigned</a>
				<a href="myReport.php?status=In_Progress" class="filterBtn">in progress</a>
				<a href="myReport.php?status=Completed" class="filterBtn">completed</a>
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
						<?php while ($row = mysqli_fetch_assoc($result)) : ?>
							<tr>
								<td><?= $row["reportID"] ?></td>
								<td><?= $row["reportCategory"] ?></td>
								<td><?= $row["reportDesc"] ?></td>
								<td><?= $row["dateReported"] ?></td>
								<td><?= $row["status"] ?></td>
								<td><a href="./trackReport.php?id=<?= $row["reportID"] ?>" class="updateBtn">Track</a></td>
							</tr>
						<?php endwhile ?>
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

		const params = new URLSearchParams(window.location.search);
		const status = params.get("status");
		let filterBox = document.querySelectorAll(".filter-box a")
		filterBox.forEach(box => box.classList.remove("filtered"))

		if (status == "All" || status == null) filterBox[0].classList.add("filtered")
		else if (status == "Pending") filterBox[1].classList.add("filtered")
		else if (status == "Assigned") filterBox[2].classList.add("filtered")
		else if (status == "In_Progress") filterBox[3].classList.add("filtered")
		else if (status == "Completed") filterBox[4].classList.add("filtered")
	</script>


	<!-- testing only -->
	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="USER">
	<input type="text" name="title" id="title" hidden value="My Report">
</body>

</html>