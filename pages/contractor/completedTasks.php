<?php
require_once __DIR__ . "../../../inc/init.php";
auth("CTR");

//php code hrre

$userID = $_SESSION["userID"];

$sql = "	SELECT *
        	FROM report 
		WHERE contractorID  = '$userID' AND status = 'Completed'";

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
		<?php $title = "Completed Tasks" ?>
		<?php include(__DIR__ . "../../../components/system-admin/header.php") ?>
		<!-- CONTENT HERE -->
		<main class="_content-area">
			<section class="table-container">
				<table class="myReportTbl">
					<thead>
						<tr>
							<th>Id</th>
							<th>Category</th>
							<th>Location</th>
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
								<td><a class="btn btn-primary" href="./updateTasks.php?id=<?= $row["reportID"] ?>">See</a></td>
							</tr>
						<?php endwhile ?>
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
	<input type="text" name="role" id="role" hidden value="CTR">
	<input type="text" name="title" id="title" hidden value="Completed Tasks">
</body>

</html>