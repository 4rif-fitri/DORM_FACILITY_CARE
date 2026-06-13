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
		<?php $title = "Manage College Admin" ?>
		<?php include(__DIR__ . "../../../components/system-admin/header.php") ?>

		<!-- CONTENT HERE -->
		<main class="_content-area">
			<nav class="add-box">
				<a href="" class="addBtn">Add Admin</a>
			</nav>

			<section class="table-container">
				<table class="myReportTbl">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>College</th>
							<th>Email</th>
							<th>Phone No</th>
							<th>Edit</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>D032410396</td>
							<td>Arif Fitri</td>
							<td>Al-Jazari</td>
							<td>arifa321@gmail.com</td>
							<td>011 167 6767</td>
							<td><a href="./collegeAdminUpdate.php" class="updateBtn">Update</a></td>
						</tr>

						<tr>
							<td>D032410396</td>
							<td>Muhammad Imran Danial bin Samsudin</td>
							<td>Satria</td>
							<td>carod1234@gmail.com</td>
							<td>013 145 7816</td>
							<td><a href="./collegeAdminUpdate.php" class="updateBtn">Update</a></td>
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
	<input type="text" name="title" id="title" hidden value="Manage College Admin">
</body>

</html>