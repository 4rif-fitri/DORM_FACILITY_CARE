<?php
require_once __DIR__ . "../../../inc/init.php";
auth("STD");

//php code hrre
$userID = $_SESSION["userID"];

$sql = "	SELECT 	reportID, 
				reportCategory, 	
				reportDesc, 
				dateReported, 
				status,
				college
        	FROM report
        	WHERE userID = '$userID'
		ORDER BY dateReported DESC
		";

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
				<div class="filter-cantainer">
					<div class="input-control">
						<label for="filter-catagory">Catagory</label>
						<select name="filter-catagory" id="filter-catagory">
							<option value="" selected>Select Status</option>
							<option value="Pending" selected>Pending</option>
							<option value="In_Progress">In Progress</option>
							<option value="Completed">Completed</option>
							<option value="Rejected">Rejected</option>
							<option value="Cancelled">cancelled</option>
						</select>
					</div>
				</div>
				<button class="btn-reset-filter">Reset Filter</button>
			</nav>

			<section class="table-container">
				<table class="myReportTbl">
					<thead>
						<tr>
							<th>Id</th>
							<th>Category</th>
							<th>Collage</th>
							<th>Date</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						<?php while ($row = mysqli_fetch_assoc($result)) : ?>
							<tr>
								<td><?= $row["reportID"] ?></td>
								<td><?= $row["reportCategory"] ?></td>
								<td><?= $row["college"] ?></td>
								<td><?= $row["dateReported"] ?></td>
								<td><?= $row["status"] ?></td>
								<td><a href="./trackReport.php?id=<?= $row["reportID"] ?>" class="updateBtn">Track</a></td>
							</tr>
						<?php endwhile ?>
					</tbody>

				</table>

				<table class="reportCard">
					<tbody>
						<tr>
							<th>Id</th>
							<td>67</td>
						</tr>

						<tr>
							<th>Category</th>
							<td>Plumbing</td>
						</tr>

						<tr>
							<th>Date</th>
							<td>09/11/2025</td>
						</tr>

						<tr>
							<th>Status</th>
							<td>Pending</td>
						</tr>

						<tr>
							<td><a href="#" class="updateBtn">Track</a></td>
							<td></td>
						</tr>
					</tbody>

					<tbody>
						<tr>
							<th>Id</th>
							<td>67</td>
						</tr>

						<tr>
							<th>Category</th>
							<td>Plumbing</td>
						</tr>

						<tr>
							<th>Date</th>
							<td>09/11/2025</td>
						</tr>

						<tr>
							<th>Status</th>
							<td>Pending</td>
						</tr>

						<tr>
							<td><a href="#" class="updateBtn">Track</a></td>
							<td></td>
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