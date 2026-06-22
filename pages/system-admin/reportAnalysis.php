<?php
require_once __DIR__ . "../../../inc/init.php";
auth("SAD");

//php code hrre
function getDataCategory($conn)
{
	$sql = "SELECT dateReported,college,reportCategory, COUNT(*) AS total
            FROM report
            GROUP BY reportCategory";

	$result = mysqli_query($conn, $sql);

	$data = [];

	while ($row = mysqli_fetch_assoc($result)) {
		$data[] = [
			$row["reportCategory"],
			(int)$row["total"],
			$row["college"],
			$row["dateReported"],
		];
	}

	return $data;
}
function getDataCollage($conn)
{
	$sql = "SELECT dateReported,college,reportCategory, COUNT(*) AS total
            FROM report
            GROUP BY college";

	$result = mysqli_query($conn, $sql);

	$data = [];

	while ($row = mysqli_fetch_assoc($result)) {
		$data[] = [
			$row["college"],
			(int)$row["total"],
			$row["reportCategory"],
		];
	}

	return $data;
}
function getDatatable($conn)
{
	$sql = "	SELECT college,reportCategory,dateReported,
				    COUNT(*) AS totalReport,
				    SUM(status='Pending') AS pending,
				    SUM(status='Assigned') AS assigned,
				    SUM(status='In_Progress') AS inProgress,
				    SUM(status='Completed') AS completed
			FROM report
			GROUP BY college
			ORDER BY totalReport DESC";
	$result = mysqli_query($conn, $sql);

	$data = [];

	while ($row = mysqli_fetch_assoc($result)) {
		$data[] = [
			$row["college"],
			$row["totalReport"],
			$row["pending"],
			$row["assigned"],
			$row["inProgress"],
			$row["completed"],
			$row["reportCategory"],
			$row["dateReported"],
		];
	}
	return $data;
}

// function getDataTarnd($conn)
// {
// 	$sql = 	"SELECT DATE_FORMAT(dateReported, '%b') AS month,
//     			COUNT(*) AS total
// 			FROM report
// 			GROUP BY MONTH(dateReported)
// 			ORDER BY MONTH(dateReported)
// 			";

// 	$result = mysqli_query($conn, $sql);

// 	$dataTrend = [];

// 	while ($row = mysqli_fetch_assoc($result)) {
// 		$dataTrend[] = [
// 			$row["month"],
// 			(int)$row["total"]
// 		];
// 	}

// 	echo json_encode($dataTrend);
// }
//php code hrre

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- your styling -->
	<link rel="stylesheet" href="../../style/pages/system-admin/reportAnalysis.css">
</head>

<body>

	<section class="_workspace">
		<?php $title = "Report Analysis" ?>
		<?php include(__DIR__ . "../../../components/system-admin/header.php") ?>
		<!-- CONTENT HERE -->
		<main class="_content-area">

			<section class="analisis-conainer">
				<section class="pieChart">
					<h2 id="textReportCategory">Reports by Category for All Category</h2>
					<canvas id="canvas_pieChart">

					</canvas>

					<div class="filter-control">
						<input type="month" name="month" id="filter-month-category">

						<select name="college" id="filter-college-category">
							<option selected value="">All College</option>
							<option value="Satria_Jebat">Satria Jebat</option>
							<option value="Satria_Tuah">Satria Tuah</option>
							<option value="Satria_Kasturi">Satria Kasturi</option>
							<option value="Satria_Lekir">Satria Lekir</option>
							<option value="Satria_Lekiu">Satria Lekiu</option>
							<option value="Lestari">Lestari</option>
							<option value="Al_Jazari">Al Jazari</option>
						</select>

						<button class="btn-reset" id="filter-college-reset">Reset</button>
						<!-- <button class="btn-export" id="filter-college-export">Export cvs</button> -->
					</div>
				</section>
				<!-- <section class="barGraphBlock">
					<h2>Reports by Block</h2>
					<canvas id="canvas_barGraphBlock">

					</canvas>

					<div class="filter-control">
						<select name="college" id="college">
							<option selected value="">All College</option>
							<option value="">Satria Jebat</option>
							<option value="">Satria Tuah</option>
							<option value="">Satria Kasturi</option>
							<option value="">Satria Lekir</option>
							<option value="">Satria Lekiu</option>
							<option value="">Lestari</option>
							<option value="">Al Jazari</option>
						</select>

						<select name="category" id="category">
							<option value="">All Category</option>
							<option>Electrical</option>
							<option>Plumbing</option>
							<option>Furniture</option>
							<option>Internet</option>
							<option>Others</option>
						</select>
						<button class="btn-reset">Reset</button>
						<button class="btn-export">Export cvs</button>

					</div>
				</section> -->
				<!-- <section class="barGraphTrand">
					<h2>Monthly Report Trend</h2>
					<canvas id="canvas_barGraphTrand">

					</canvas>

					<div class="filter-control">
						<select name="college" id="college">
							<option selected value="">All College</option>
							<option value="">Satria Jebat</option>
							<option value="">Satria Tuah</option>
							<option value="">Satria Kasturi</option>
							<option value="">Satria Lekir</option>
							<option value="">Satria Lekiu</option>
							<option value="">Lestari</option>
							<option value="">Al Jazari</option>
						</select>
						<select name="category" id="category">
							<option value="">All Category</option>
							<option>Electrical</option>
							<option>Plumbing</option>
							<option>Furniture</option>
							<option>Internet</option>
							<option>Others</option>
						</select>
						<button class="btn-reset">Reset</button>
						<button class="btn-export">Export cvs</button>
					</div>
				</section> -->
				<section class="donutBar">
					<h2 id="textReportStatus">Report Status for All Collage</h2>
					<canvas id="canvas_donutBar">

					</canvas>

					<div class="filter-control">
						<input type="month" name="month" id="filter-status-month">
						<select name="college" id="filter-status-college">
							<option value="">All Collage</option>
							<option value="Satria_Jebat">Satria Jebat</option>
							<option value="Satria_Tuah">Satria Tuah</option>
							<option value="Satria_Kasturi">Satria Kasturi</option>
							<option value="Satria_Lekir">Satria Lekir</option>
							<option value="Satria_Lekiu">Satria Lekiu</option>
							<option value="Lestari">Lestari</option>
							<option value="Al_Jazari">Al Jazari</option>
						</select>
						<button class="btn-reset" id="filter-status-reset">Reset</button>
						<!-- <button class="btn-export" id="filter-status-export">Export cvs</button> -->
					</div>
				</section>
				<section class="table" id="table">
					<h2>Top Problem Locations</h2>

					<div class="table-responsive">
						<table>
							<thead>
								<tr>
									<th>Rank</th>
									<th>Collage</th>
									<th>Total Report</th>
									<th><span class="pending">Pending</span></th>
									<th><span class="assigned">Assigned</span></th>
									<th><span class="inProgress">In Progress</span></th>
									<th><span class="completed">Completed</span></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<div class="filter-control">
						<input type="month" name="month" id="filter-month-table">
						<select name="category" id="filter-category-table">
							<option value="">All category</option>
							<option value="Electrical">Electrical</option>
							<option value="Plumbing">Plumbing</option>
							<option value="Furniture">Furniture</option>
							<option value="Internet">Internet</option>
							<option value="Others">Others</option>
						</select>
						<button class="btn-reset" id="filter-table-reset">Reset</button>
						<!-- <button class="btn-export" id="filter-table-export">Export cvs</button> -->

					</div>
				</section>
			</section>

		</main>
		<!-- CONTENT HERE -->

	</section>

	<!-- your script -->
	<script>
		let table = document.getElementById("table")
		let tbody = table.querySelector("tbody")

		let canvas_category = document.getElementById("canvas_pieChart");
		// let canvas_Block = document.getElementById("canvas_barGraphBlock");
		// let canvas_Trand = document.getElementById("canvas_barGraphTrand");
		let canvas_Status = document.getElementById("canvas_donutBar");
		let resizeTimer;
		let rect = canvas_category.getBoundingClientRect();

		let dataBlock = <?= json_encode(getDataCollage($conn)) ?>;
		let datacategory = <?= json_encode(getDataCategory($conn)) ?>;
		let datatable = <?= json_encode(getDatatable($conn)) ?>;

		const colors = [
			"#2563EB", // Blue
			"#DC2626", // Red
			"#16A34A", // Green
			"#F59E0B", // Amber
			"#7C3AED", // Purple
			"#EC4899", // Pink
			"#06B6D4", // Cyan
			"#84CC16", // Lime
			"#F97316", // Orange
			"#64748B" // Slate
		];


		let filterMonthCategory = ""
		let filterCollegeCategory = ""

		let filterCategory = () => {
			$.ajax({
				url: "../../api/filterReportsbyCategory.php",
				method: "POST",
				data: {
					filterMonthCategory: filterMonthCategory,
					filterCollegeCategory: filterCollegeCategory
				},
				success: response => {
					console.log(response);
					if (filterCollegeCategory == "") {
						document.getElementById("textReportCategory").textContent = `Reports by Category for All Category`
					} else {
						document.getElementById("textReportCategory").textContent = `Reports by Category for ${filterCollegeCategory}`
					}
					let datas = response.datas.map(item => [
						item.reportCategory,
						parseInt(item.total)
					]);

					drawPieChart(canvas_category, datas);

				},
				error: response => {
					console.log(response.responseText);
				},
				complete: () => {}
			})
		}

		document.getElementById("filter-college-reset").addEventListener('click', () => {

			filterMonthCategory = "";
			filterCollegeCategory = "";

			document.getElementById("filter-month-category").value = "";
			document.getElementById("filter-college-category").value = "";

			filterCategory();
		});

		document.getElementById("filter-month-category").addEventListener("change", e => {
			filterMonthCategory = e.target.value
			filterCategory()
		})
		document.getElementById("filter-college-category").addEventListener("change", e => {
			filterCollegeCategory = e.target.value
			filterCategory()
		})


		// === Status filter ===

		let filterStatusCollege = ""
		let filterStatusMonth = ""
		let dataStatus
		let filterStatus = () => {
			console.log({
				filterStatusCollege,
				filterStatusMonth
			});

			$.ajax({
				url: "../../api/getFilterdStatus.php",
				method: "POST",
				data: {
					filterStatusCollege: filterStatusCollege,
					filterStatusMonth: filterStatusMonth
				},
				success: response => {
					console.log(filterStatusCollege);

					if (filterStatusCollege == "") {
						document.getElementById("textReportStatus").textContent = `Report Status for All Collage`
					} else {
						document.getElementById("textReportStatus").textContent = `Report Status for ${filterStatusCollege}`
					}
					dataStatus = response.datas
					console.log(response)

					drawBarChart(canvas_Status, response.datas);

				},
				error: response => {
					console.log(response.responseText);
				},
				complete: () => {}
			})
		}
		filterStatus()
		document.getElementById("filter-status-reset").addEventListener('click', e => {
			filterStatusCollege = ""
			filterStatusMonth = ""

			document.getElementById("filter-status-month").value = ""
			document.getElementById("filter-status-college").value = ""

			filterStatus()
		})

		document.getElementById("filter-status-college").addEventListener("change", e => {
			filterStatusCollege = e.target.value
			filterStatus()

		})
		document.getElementById("filter-status-month").addEventListener("change", e => {
			filterStatusMonth = e.target.value
			filterStatus()
		})

		// === Status filter ===


		// === table filter ===

		let tableFilterDate = ""
		let tableFiltercatagory = ""

		let filterTable = () => {

			$.ajax({
				url: "../../api/getFilterdDatatable.php",
				method: "POST",
				data: {
					tableFilterDate: tableFilterDate,
					tableFiltercatagory: tableFiltercatagory
				},
				success: response => {
					// console.log(response)

					if (tableFiltercatagory == "") {
						table.querySelector("h2").textContent = `Top Problem Locations`
					} else {
						table.querySelector("h2").textContent = `Top Problem Locations for ${tableFiltercatagory}`
					}
					renderTable(response.datas)
				},
				error: response => {
					console.log(response.responseText);
				},
				complete: () => {}
			})
		}
		filterTable()
		document.getElementById("filter-table-reset").addEventListener('click', e => {
			tableFilterDate = ""
			tableFiltercatagory = ""

			document.getElementById('filter-month-table').value = ""
			document.getElementById('filter-category-table').value = ""

			filterTable()
		})

		document.getElementById("filter-month-table").addEventListener("change", e => {
			tableFilterDate = e.target.value
			filterTable()
		})

		document.getElementById("filter-category-table").addEventListener("change", e => {
			tableFiltercatagory = e.target.value
			filterTable()
		})

		let renderTable = (datatable) => {
			tbody.innerHTML = ""
			let totalReport = 0;
			let totalPending = 0;
			let totalAssigned = 0;
			let totalInProgress = 0;
			let totalCompleted = 0;

			datatable.forEach((datas, index) => {
				// console.log(datas);

				totalReport += Number(datas[1]);
				totalPending += Number(datas[2]);
				totalAssigned += Number(datas[3]);
				totalInProgress += Number(datas[4]);
				totalCompleted += Number(datas[5]);

				let tr = document.createElement("tr")
				tr.innerHTML = `
					<td>${index+1}</td>
					<td>${datas[0]}</td>
					<td>${datas[1]}</td>
					<td>${datas[2]}</td>
					<td>${datas[3]}</td>
					<td>${datas[4]}</td>
					<td>${datas[5]}</td>
				`
				tbody.appendChild(tr)
			})

			let totalRow = document.createElement("tr")
			totalRow.style.backgroundColor = "lightyellow"
			totalRow.innerHTML = `
						<td colspan="2"><b>Total</b></td>
						<td><b>${totalReport}</b></td>
						<td><b>${totalPending}</b></td>
						<td><b>${totalAssigned}</b></td>
						<td><b>${totalInProgress}</b></td>
						<td><b>${totalCompleted}</b></td>
					`;

			tbody.appendChild(totalRow)
		}

		// === table filter ===

		let drawPieChart = (canvas, datas) => {

			let ctx = canvas.getContext("2d")

			let rect = canvas.parentElement.getBoundingClientRect();

			canvas.width = rect.width;
			canvas.height = 400;

			let centerX = canvas.width * 0.3;
			let centerY = canvas.height / 2;

			let total = datas.reduce((acc, curr) => acc + curr[1], 0)
			let radius = 150
			let startAngle = 0

			let lagendX = 500
			let lagendY = 50

			datas.forEach((data, index) => {
				// console.log(data);

				let slideAngle = (data[1] / total) * Math.PI * 2
				ctx.beginPath()
				ctx.fillStyle = colors[index]
				ctx.moveTo(centerX, centerY)
				ctx.arc(centerX, centerY, radius, startAngle, startAngle + slideAngle)
				ctx.closePath()
				ctx.fill()
				ctx.strokeStyle = "#000"
				ctx.lineWidth = 2
				ctx.stroke()

				let midAngle = startAngle + slideAngle / 2
				let percentage = `${((data[1] / total) * 100).toFixed(1)}%`
				let x = centerX + Math.cos(midAngle) * 90
				let y = centerY + Math.sin(midAngle) * 90

				ctx.font = "bold 1rem arial"

				ctx.strokeStyle = "#fff"
				ctx.strokeText(percentage, x - 10, y + 5)
				startAngle += slideAngle

				ctx.fillStyle = "#000"
				ctx.fillText(percentage, x - 10, y + 5)


				ctx.fillStyle = colors[index];
				ctx.fillRect(lagendX, lagendY + 30, 30, 30);

				ctx.fillStyle = "#000";
				ctx.fillText(`${data[0]} (${data[1]})`, lagendX + 40, lagendY + 50);



				lagendY += 50
			})
		}

		let drawBarChart = (canvas, datas) => {
			// console.log(datas);

			let ctx = canvas.getContext("2d")
			canvas.width = 700
			canvas.height = 300

			let startX = 50
			let startY = 250
			let max = Math.max(...datas.map(item => item[1]));
			let gap = 30
			let barWidth = 70

			ctx.beginPath()
			ctx.moveTo(startX, startY)
			ctx.lineTo(startX + 600, startY)
			ctx.lineTo(startX, startY)
			ctx.lineTo(startX, startY - 200)

			datas.forEach((item, index) => {

				let value = item[1];
				let label = item[0];

				let barHeight = (value / max) * 200;
				let x = startX + gap + index * (barWidth + gap);
				let y = startY - barHeight;

				ctx.fillStyle = colors[index];
				ctx.fillRect(x, y, barWidth, barHeight);

				ctx.fillStyle = "#000";
				ctx.font = "15px Arial";
				ctx.fillText(value, x, y - 10);
				ctx.fillText(label, x, startY + 20);
			});
			ctx.fillStyle = "#000"
			ctx.lineWidth = 3
			ctx.stroke()
		}

		// function drawLineGraph(canvas, datas) {

		// 	const ctx = canvas.getContext("2d");

		// 	const rect = canvas.getBoundingClientRect();

		// 	canvas.width = rect.width;
		// 	canvas.height = 400;

		// 	const width = canvas.width;
		// 	const height = canvas.height;

		// 	const padding = 50;

		// 	const graphWidth = width - padding * 2;
		// 	const graphHeight = height - padding * 2;

		// 	const maxValue = Math.max(...datas.map(item => item[1]));

		// 	// Grid
		// 	ctx.strokeStyle = "#ddd";
		// 	ctx.lineWidth = 1;

		// 	for (let i = 0; i <= 5; i++) {

		// 		let y = padding + (graphHeight / 5) * i;

		// 		ctx.beginPath();
		// 		ctx.moveTo(padding, y);
		// 		ctx.lineTo(width - padding, y);
		// 		ctx.stroke();
		// 	}

		// 	// Axis
		// 	ctx.strokeStyle = "#000";
		// 	ctx.lineWidth = 2;

		// 	ctx.beginPath();
		// 	ctx.moveTo(padding, padding);
		// 	ctx.lineTo(padding, height - padding);
		// 	ctx.lineTo(width - padding, height - padding);
		// 	ctx.stroke();

		// 	const points = [];

		// 	datas.forEach((item, index) => {

		// 		const value = item[1];

		// 		const x = padding + (graphWidth / (datas.length - 1)) * index;

		// 		const y = height - padding - (value / maxValue) * graphHeight;

		// 		points.push({
		// 			x,
		// 			y
		// 		});
		// 	});

		// 	// Area
		// 	ctx.beginPath();
		// 	ctx.moveTo(points[0].x, height - padding);
		// 	ctx.lineTo(points[0].x, points[0].y);

		// 	points.forEach(point => {
		// 		ctx.lineTo(point.x, point.y);
		// 	});

		// 	ctx.lineTo(points[points.length - 1].x, height - padding);
		// 	ctx.closePath();

		// 	ctx.fillStyle = "rgba(124,58,237,0.15)";
		// 	ctx.fill();

		// 	// Line
		// 	ctx.beginPath();
		// 	ctx.strokeStyle = "#7c3aed";
		// 	ctx.lineWidth = 3;

		// 	ctx.moveTo(points[0].x, points[0].y);

		// 	for (let i = 1; i < points.length; i++) {
		// 		ctx.lineTo(points[i].x, points[i].y);
		// 	}

		// 	ctx.stroke();

		// 	// Point
		// 	points.forEach((point, index) => {

		// 		ctx.beginPath();
		// 		ctx.arc(point.x, point.y, 5, 0, Math.PI * 2);
		// 		ctx.fillStyle = "#7c3aed";
		// 		ctx.fill();

		// 		ctx.fillStyle = "#000";
		// 		ctx.textAlign = "center";
		// 		ctx.font = "bold 12px Arial";

		// 		ctx.fillText(datas[index][1], point.x, point.y - 15);
		// 		ctx.fillText(datas[index][0], point.x, height - 20);
		// 	});
		// }

		drawPieChart(canvas_category, datacategory);
		// drawPieChart(canvas_Block, dataBlock);
		// drawLineGraph(canvas_Trand, dataTrand);
		drawBarChart(canvas_Status, []);
		renderTable(datatable)

		window.addEventListener("resize", () => {

			clearTimeout(resizeTimer);

			resizeTimer = setTimeout(() => {

				drawPieChart(canvas_category, datacategory);
				// drawPieChart(canvas_Block, dataBlock);
				// drawLineGraph(canvas_Trand, dataTrand);
				drawBarChart(canvas_Status, dataStatus);

			}, 1000);

		});
	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="SAD">
	<input type="text" name="title" id="title" hidden value="Report Analysis">
</body>

</html>