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