<?php
require_once __DIR__ . "../../../inc/init.php";
auth("STD,STF", $_SESSION["type"] ?? null);

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

if (isset($_GET['rid'])) {
	$reportID = $_GET['rid'];

	$sql = "UPDATE report
            SET status = 'Cancelled'
            WHERE reportID = $reportID AND userID = '$userID'
		  ";

	if (mysqli_query($conn, $sql)) {
		echo "
		<script>
			alert('Report Cancelled succesfully');
			window.location.href = 'myReport.php';
		</script>";
	}
}
// $result = mysqli_query($conn, $sql);
// $result2 = mysqli_query($conn, $sql);
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
						<input type="number" name="filter-date" value="" max="<?= date('Y-m-d') ?>" id="filter-date">
					</div>
					<div class="input-control">
						<label for="filter-id">Report ID</label>
						<input type="text" name="filter-id" id="filter-id">
					</div>
					<div class="input-control ">
						<label for="filter-status">Status</label>
						<select name="filter-status" id="filter-status">
							<option value="">All Status</option>
							<option <?= (isset($_GET["status"]) && $_GET["status"] == "Pending") ? "selected" : "" ?> value="Pending">Pending</option>
							<option <?= (isset($_GET["status"]) && $_GET["status"] == "Assigned") ? "selected" : "" ?> value="Assigned">Assigned</option>
							<option <?= (isset($_GET["status"]) && $_GET["status"] == "In_Progress") ? "selected" : "" ?> value="In_Progress">In Progress</option>
							<option <?= (isset($_GET["status"]) && $_GET["status"] == "Completed") ? "selected" : "" ?> value="Completed">Completed</option>
							<option <?= (isset($_GET["status"]) && $_GET["status"] == "Rejected") ? "selected" : "" ?> value="Rejected">Rejected</option>
							<option <?= (isset($_GET["status"]) && $_GET["status"] == "Cancelled") ? "selected" : "" ?> value="Cancelled">Cancelled</option>
						</select>
					</div>
					<div class="input-control">
						<label for="filter-catagory">Category</label>
						<select name="filter-catagory" id="filter-catagory">
							<option value="" selected>All Category</option>
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
							<th>Location</th>
							<th>Date Reported</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody id="table-data"></tbody>

				</table>



			</section>

		</main>
	</section>

	<!-- your script -->
	<script>
		$(document).ready(function() {

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
						reportID: $("#filter-id").val(),
						date: $("#filter-date").val(),
						status: $("#filter-status").val(),
						category: $("#filter-catagory").val(),
						location: $("#filter-location").val()
					},

					success: response => {
						console.log(response.data);
						console.log(response.data.length);

						document.getElementById("table-data").innerHTML = ""
						document.querySelector(".table-container").querySelectorAll(".reportCard").forEach(card => card.remove())

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
									${data.status === "Cancelled" ? `<span disabled class="updateBtn disabled">Track</span>` : `<a href="./trackReport.php?id=${data.reportID}" class="updateBtn">Track</a>`} 
									${data.status == "Pending" ? `<a href="myReport.php?rid=${data.reportID}" class="deleteBtn">Cancel</a>` : `<span class="deleteBtn disabled">Cancel</span>` }
								</td>
								`;

								let div = document.createElement("div")
								div.classList.add("reportCard")
								div.innerHTML = `
									<div id="reportCard-info">
										<div id="reportCard-left">
											<p><strong>Id</strong></p>
											<p><strong>Category</strong></p>
											<p><strong>Location</strong></p>
											<p><strong>Date</strong></p>
											<p><strong>Status</strong></p>
										</div>

										<div id="reportCard-right">
											<p>${data.reportID}</p>
											<p>${data.reportCategory}</p>
											<p>${data.college}</p>
											<td>${(data.dateReported).split(" ")[0]}</td>
											<p>${data.status}</p>
										</div>
									</div>

									<div id="reportCard-bottom">
										${data.status === "Cancelled" ? `<span disabled class="updateBtn disabled">Track</span>` : `<a href="./trackReport.php?id=${data.reportID}" class="updateBtn">Track</a>`} 
										${data.status == "Pending" ? `<a href="myReport.php?rid=${data.reportID}" class="deleteBtn">Cancel</a>` : `<span class="deleteBtn disabled">Cancel</span>` }
									</div>`

								document.querySelector(".table-container").appendChild(div)
								document.getElementById("table-data").appendChild(tr);
							});

						} else {
							let tr = document.createElement("tr");
							tr.innerHTML = `<td colspan='6'><center>Sorry No Data</center></td>`
							document.getElementById("table-data").appendChild(tr);

							let div = document.createElement("div")
							div.classList.add("reportCard")
							div.innerHTML = `
								<p style="padding:0.5rem;  text-align:center; width:100%">Sorry No Data</p>
								`
							document.querySelector(".table-container").appendChild(div)
						}


					},
					error: response => {
						console.log(response.responseText);
					}

				});

			}

			loadTable();

			$("#filter-date,#filter-status,#filter-catagory,#filter-location,#filter-id").on("change", function() {
				loadTable();
			});
			$("#filter-id").on("input", function() {
				loadTable();
			});

			$("#btn-reset-filter").on("click", function(e) {
				e.preventDefault();
				$("#filter-date").val("<?= date('Y-m-d') ?>");
				$("#filter-status").val("");
				$("#filter-catagory").val("");
				$("#filter-location").val("");
				$("#filter-id").val("");
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