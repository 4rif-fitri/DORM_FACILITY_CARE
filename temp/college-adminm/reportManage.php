<?php
require_once __DIR__ . "../../../inc/init.php";

auth("CAD");

//php code hrre
$idAdmin = $_SESSION["userID"];

function getCollage($college)
{
	if ($college == "KOLEJ KEDIAMAN SATRIA JEBAT") return "Satria_Jebat";
	else if ($college == "KOLEJ KEDIAMAN SATRIA TUAH") return "Satria_Tuah";
	else if ($college == "KOLEJ KEDIAMAN SATRIA KASTURI") return "Satria_Kasturi";
	else if ($college == "KOLEJ KEDIAMAN SATRIA LEKIR") return "Satria_Lekir";
	else if ($college == "KOLEJ KEDIAMAN SATRIA LEKIU") return "Satria_Lekiu";
	else if ($college == "KOLEJ KEDIAMAN AL JAZARI") return "Al_Jazari";
	else if ($college == "KOLEJ KEDIAMAN LESTARI") return "Lestari";
}

$sql = "	SELECT user.userID, user.name, user.email, user.numTel,
			college_admin.college
			FROM user INNER JOIN college_admin
			ON user.userID = college_admin.colAdminID 
			WHERE userID = '$idAdmin'
			";

$result = mysqli_query($conn, $sql);
$dataAdmin = mysqli_fetch_assoc($result);

$collage = getCollage($dataAdmin["college"]);

$sql = "	SELECT * FROM report 
		WHERE college = '$collage' AND status = 'Pending'
		ORDER BY dateReported DESC";
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

	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="CAD">
	<input type="text" name="title" id="title" hidden value="Manage Report">
</body>

</html>