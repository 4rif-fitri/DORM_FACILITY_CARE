<?php
require_once __DIR__ . "../../../inc/init.php";
auth("CTR");

//php code hrre

if (isset($_GET["idDoit"])) {
	$reportID = $_GET["idDoit"];
	$sql = "	UPDATE report
			SET  status = 'In_Progress',
				dateAssigned = NOW()
			WHERE reportID = '$reportID' 
			";
	mysqli_query($conn, $sql);
	header("Location: updateTasks.php?id=$reportID");
}

$idContractor = $_SESSION["userID"];
$sql = "	SELECT 	reportID, 
				reportCategory, 	
				reportDesc, 
				dateReported, 
				status
        	FROM report
		WHERE (status = 'Assigned' OR status = 'In_Progress') AND contractorID = '$idContractor'
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
		<?php $title = "Assigned Tasks" ?>
		<?php include(__DIR__ . "../../../components/contractor/header.php") ?>
		<!-- CONTENT HERE -->
		<main class="_content-area">
			<!-- <nav class="filter-box">
				<a href="" class="filterBtn">all</a>
				<a href="" class="filterBtn">canceled</a>
				<a href="" class="filterBtn">pending</a>
				<a href="" class="filterBtn">assigned</a>
				<a href="" class="filterBtn">in progress</a>
				<a href="" class="filterBtn">completed</a>
			</nav> -->

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
								<td><a href="./assignedTasks.php?idDoit=<?= $row["reportID"] ?>" class="updateBtn">Take</a></td>
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

	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="CTR">
	<input type="text" name="title" id="title" hidden value="Assigned Tasks">
</body>

</html>