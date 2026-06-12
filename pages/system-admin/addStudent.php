<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" href="../../images/image.png" type="image/x-icon">

	<meta charset="UTF-8">
	<title>Dorm Facility Care</title>
	<link rel="stylesheet" href="../../lib/bootstrap.css">
	<script src="../../lib/bootstrap.js"></script>
	<link rel="stylesheet" href="../../style/layout.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	<script src="../../lib/jquery.js"></script>

	<script src="../../script/load-component.js"></script>

	<!-- your styling -->
	<link rel="stylesheet" href="../../style/reportDisplay.css">
</head>

<body>

	<section class="_workspace">

		<!-- CONTENT HERE -->
		<main class="_content-area">
			<nav class="add-box">
				<a href="" class="addBtn">Add Student</a>
			</nav>

			<section class="table-container">
				<table class="myReportTbl trackingReportTbl">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>College</th>
							<th>Phone No</th>
							<th>Edit</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>D032410321</td>
							<td>Arif Fitri bin Mohd Jamil</td>
							<td>Al-Jazari</td>
							<td>011 167 6767</td>
							<td><a href="" class="updateBtn">Update</a></td>
						</tr>

						<tr>
							<td>D032410396</td>
							<td>Muhammad Imran Danial</td>
							<td>Satria</td>
							<td>013 145 7816</td>
							<td><a href="" class="updateBtn">Update</a></td>
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
	<input type="text" name="title" id="title" hidden value="Add Student">
</body>

</html>