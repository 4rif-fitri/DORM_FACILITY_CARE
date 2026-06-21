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
					<div class="input-control hidden">
						<label for="filter-date">Date</label>
						<input type="date" name="filter-date" value="" max="<?= date('Y-m-d') ?>" id="filter-date">
					</div>
					<div class="input-control ">
						<label for="filter-status">Status</label>
						<select name="filter-status" id="filter-status">
							<option value="">All Status</option>
							<option value="Pending" selected>Pending</option>
							<option value="In_Progress">In Progress</option>
							<option value="Completed">Completed</option>
							<option value="Rejected">Rejected</option>
							<option value="Cancelled">cancelled</option>
						</select>
					</div>
					<div class="input-control">
						<label for="filter-catagory">Catagory</label>
						<select name="filter-catagory" id="filter-catagory">
							<option value="" selected>All Catagory</option>
							<option value="Plumbing">Plumbing</option>
							<option value="Electrical">Electrical</option>
							<option value="Cleaning">Cleaning</option>
							<option value="Facilities">Facilities</option>
							<option value="Security">Security</option>
							<option value="Others">Others</option>
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
				<button class="btn-reset-filter" id="btn-reset-filter">Reset Filter</button>
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

				

				<div class="reportCard">
					<div id="reportCard-info">
						<div id="reportCard-left">
							<p><strong>Id</strong></p>
							<p><strong>Category</strong></p>
							<p><strong>Description</strong></p>
							<p><strong>Date</strong></p>
							<p><strong>Status</strong></p>
						</div>
						
						<div id="reportCard-right">
							<p><?= $row['reportID'] ?></p>
							<p><?=  $row['reportCategory'] ?></p>
							<p><?= $row['college'] ?></p>
							<p><?= $row['dateReported'] ?></p>
							<p><?= $row['status'] ?></p>
						</div>
					</div>

					<div id="reportCard-bottom">
						<a href="./trackReport.php?id=<?= $row['reportID'] ?>" class="updateBtn">Track Report</a>
					</div>
					<?php endwhile ?>
				</div>
			</section>

		</main>
	</section>

	<!-- your script -->
	<script>
		$(document).ready(function() {

			loadTable();

			function loadTable() {
				console.log("Request");
				document.getElementById("table-data").innerHTML = "";

				let tr = document.createElement("tr");
				tr.innerHTML = `<td colspan='6'><center>Wait Load the data...</center></td>`
				document.getElementById("table-data").appendChild(tr);

				$.ajax({
					url: "../../api/getReportUser.php",
					type: "POST",
					data: {
						userID: "<?= $_SESSION["userID"] ?>",
						date: $("#filter-date").val(),
						status: $("#filter-status").val(),
						category: $("#filter-catagory").val(),
						location: $("#filter-location").val()
					},

					success: response => {
						console.log(response.data);
						console.log(response.data.length);
						document.getElementById("table-data").innerHTML = ""

						if (response.data.length > 0) {
							response.data.forEach(data => {
								let tr = document.createElement("tr");
								tr.innerHTML = `
								<td>${data.reportID}</td>
								<td>${data.reportCategory}</td>
								<td>${data.college}</td>
								<td>${data.dateReported}</td>
								<td>${data.status}</td>
								<td>
									<a href="./trackReport.php?id=${data.reportID}" class="updateBtn">Update</a>
								</td>
							`;
								document.getElementById("table-data").appendChild(tr);
							});
						} else {
							let tr = document.createElement("tr");
							tr.innerHTML = `<td colspan='6'><center>Sorry No Data</center></td>`
							document.getElementById("table-data").appendChild(tr);
						}


					},
					error: response => {
						console.log(response.responseText);
					}

				});

			}

			$("#filter-date,#filter-status,#filter-catagory,#filter-location").on("change", function() {
				loadTable();
			});

			$("#btn-reset-filter").on("click", function(e) {
				e.preventDefault();

				$("#filter-date").val("<?= date('Y-m-d') ?>");
				$("#filter-status").val("Pending");
				$("#filter-catagory").val("");
				$("#filter-location").val("");

				loadTable();
			});
		});
	</script>


	<!-- testing only -->
	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="USER">
	<input type="text" name="title" id="title" hidden value="My Report">
</body>

</html>