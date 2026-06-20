<?php
require_once __DIR__ . "../../../inc/init.php";
auth("SAD");

//php code hrre
$userID = $_SESSION["userID"];

$sql = "	SELECT 	reportID, 
				reportCategory, 	
				reportDesc, 
				dateReported, 
				status,
				college
        	FROM report
		WHERE status = 'Pending'
		ORDER BY dateReported DESC
		";

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
				<div class="filter-cantainer">
					<div class="input-control">
						<label for="filter-date">Date</label>
						<select name="filter-date" id="filter-date">
							<option value="Today" selected>Today</option>
							<option value="This Week">This Week</option>
							<option value="This Mounth">This Mounth</option>
						</select>
					</div>
					<div class="input-control">
						<label for="filter-status">Status</label>
						<select name="filter-status" id="filter-status">
							<option value="" selected>Select Status</option>
							<option value="Plumbing">Plumbing</option>
							<option value="Electrical">Electrical</option>
							<option value="Cleaning">Cleaning</option>
							<option value="Facilities">Facilities</option>
							<option value="Security">Security</option>
							<option value="Others">Others</option>
						</select>
					</div>
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
					<div class="input-control">
						<label for="filter-location">location</label>
						<select name="filter-location" id="filter-location">
							<option selected value="">All College</option>
							<option value="Satria_Jebat">Satria Jebat</option>
							<option value="Satria_Tuah">Satria Tuah</option>
							<option value="Satria_Kasturi">Satria Kasturi</option>
							<option value="Satria_Lekir">Satria Lekir</option>
							<option value="Satria_Lekiu">Satria Lekiu</option>
							<option value="Lestari">Lestari</option>
							<option value="Al_Jazari">Al Jazari</option>
						</select>
					</div>
				</div>
				<button class="btn-reset-filter">Reset Filter</button>
			</nav>

			<section class="table-container" style="width:100%;">
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
								<td><?= $row["college"] ?></td>
								<td><?= $row["dateReported"] ?></td>
								<td><?= $row["status"] ?></td>
								<td><a href="./reportUpdate.php?id=<?= $row["reportID"] ?>" class="updateBtn">Update</a></td>
							</tr>
						<?php endwhile ?>
					</tbody>

				</table>

				
				<div class="pagination">
					<p>Show 1 to 10 of 100 entries</p>
					<article>
						<button class="btn-previous">Previous</button>
						<button class="btn-number active">1</button>
						<button class="btn-number">2</button>
						<button class="btn-number">3</button>
						<button class="btn-next">Next</button>
					</article>
				</div>
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