<?php
session_start();
		require_once __DIR__ . "../../../inc/init.php";

		auth("CAD");

//php code hrre

//php code hrre

?>
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
	<link rel="stylesheet" href="../../style/pages/college-admin/reportAnalysis.css">
</head>

<body>

	<section class="_workspace">
		<?php $title = "Report Analysis" ?>
		<?php include(__DIR__ . "../../../components/system-admin/header.php") ?>

		<!-- CONTENT HERE -->
		<main class="_content-area">

			<section class="analisis-conainer">
				<section class="pieChart">
					<h2>Reports by Category</h2>
					<canvas id="canvas_pieChart">

					</canvas>

					<div class="filter-control">
						<input type="month" name="month" id="month">

						<select name="college" id="college">
							<option value="">Satria Jebat</option>
							<option value="">Satria Tuah</option>
							<option value="">Satria Kasturi</option>
							<option value="">Satria Lekir</option>
							<option value="">Satria Lekiu</option>
							<option value="">Lestari</option>
							<option value="">Al Jazari</option>
						</select>

						<button class="btn-reset">Reset</button>
						<button class="btn-export">Export cvs</button>
					</div>
				</section>
				<section class="barGraphBlock">
					<h2>Reports by Block</h2>
					<canvas id="canvas_barGraphBlock">

					</canvas>

					<div class="filter-control">
						<input type="month" name="month" id="month">

						<select name="category" id="category">
							<option value="">All category</option>
							<option>Electrical</option>
							<option>Plumbing</option>
							<option>Furniture</option>
							<option>Internet</option>
							<option>Others</option>
						</select>
						<button class="btn-reset">Reset</button>
						<button class="btn-export">Export cvs</button>

					</div>
				</section>
				<section class="barGraphTrand">
					<h2>Monthly Report Trend</h2>
					<canvas id="canvas_barGraphTrand">

					</canvas>

					<div class="filter-control">
						<input type="month" name="month" id="month">
						<select name="category" id="category">
							<option value="">All category</option>
							<option>Electrical</option>
							<option>Plumbing</option>
							<option>Furniture</option>
							<option>Internet</option>
							<option>Others</option>
						</select>
						<button class="btn-reset">Reset</button>
						<button class="btn-export">Export cvs</button>
					</div>
				</section>
				<section class="donutBar">
					<h2>Report Status</h2>
					<canvas id="canvas_donutBar">

					</canvas>

					<div class="filter-control">
						<input type="month" name="month" id="month">
						<select name="college" id="college">
							<option value="">Satria Jebat</option>
							<option value="">Satria Tuah</option>
							<option value="">Satria Kasturi</option>
							<option value="">Satria Lekir</option>
							<option value="">Satria Lekiu</option>
							<option value="">Lestari</option>
							<option value="">Al Jazari</option>
						</select>
						<button class="btn-reset">Reset</button>
						<button class="btn-export">Export cvs</button>

					</div>
				</section>
				<section class="table">
					<h2>Top 5 Problem Locations</h2>

					<table>
						<thead>
							<tr>
								<th>Rank</th>
								<th>Collage</th>
								<th>Total Report</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Satria Jebat</td>
								<td>100</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Al Jazari</td>
								<td>20</td>
							</tr>
						</tbody>
					</table>

					<div class="filter-control">
						<input type="month" name="month" id="month">
						<select name="category" id="category">
							<option value="">All category</option>
							<option>Electrical</option>
							<option>Plumbing</option>
							<option>Furniture</option>
							<option>Internet</option>
							<option>Others</option>
						</select>
						<button class="btn-reset">Reset</button>
						<button class="btn-export">Export cvs</button>

					</div>
				</section>
			</section>

		</main>
		<!-- CONTENT HERE -->

	</section>

	<!-- your script -->
	<script>
		let canvas_category = document.getElementById("canvas_pieChart");
		let canvas_Block = document.getElementById("canvas_barGraphBlock");
		let canvas_Trand = document.getElementById("canvas_barGraphTrand");
		let canvas_Status = document.getElementById("canvas_donutBar");
		let resizeTimer;
		let rect = canvas_category.getBoundingClientRect();


		let drawPieChart = canvas => {
			let ctx = canvas.getContext("2d")


			canvas.width = rect.width;
			canvas.height = rect.height;

			let width = rect.width;
			let height = rect.height;

			let centerX = width / 2;
			let centerY = height / 2;

			let datas = [10, 20, 30, 40, 50];

			let colors = [
				"#1E90FF",
				"#FF5A79",
				"#FF9F43",
				"#FFE066",
				"#2ECC71",
			];

			let total = datas.reduce((a, b) => a + b, 0);

			let radius = Math.min(width, height) * 0.35;

			let startAngle = 0;

			datas.forEach((data, index) => {

				let sliceAngle = (data / total) * Math.PI * 2;

				ctx.beginPath();
				ctx.moveTo(centerX, centerY);

				ctx.fillStyle = colors[index];

				ctx.arc(
					centerX,
					centerY,
					radius,
					startAngle,
					startAngle + sliceAngle
				);

				ctx.closePath();
				ctx.fill();

				ctx.strokeStyle = "#000";
				ctx.lineWidth = 1;
				ctx.stroke();

				// Percentage label
				let midAngle = startAngle + sliceAngle / 2;

				let labelX =
					centerX + Math.cos(midAngle) * radius * 0.65;

				let labelY =
					centerY + Math.sin(midAngle) * radius * 0.65;

				let percentage =
					((data / total) * 100).toFixed(1) + "%";

				ctx.font = "bold 16px Arial";
				ctx.textAlign = "center";
				ctx.textBaseline = "middle";

				ctx.strokeStyle = "#000";
				ctx.lineWidth = 3;
				ctx.strokeText(percentage, labelX, labelY);

				ctx.fillStyle = "#fff";
				ctx.fillText(percentage, labelX, labelY);

				startAngle += sliceAngle;
			});
		}

		let drawBarChart = canvas => {
			let ctx = canvas.getContext("2d")
			canvas.width = 700
			canvas.height = 300

			let datas = [10, 50, 90, 70, 30]
			let labels = ["Student 1", "Student 2", "Student 3", "Student 4", "Student 5"]
			let colors = [
				"#1E90FF",
				"#FF5A79",
				"#FF9F43",
				"#FFE066",
				"#2ECC71",
			]

			let startX = 50
			let startY = 250
			let max = Math.max(...datas)
			let gap = 30
			let barWidth = 70

			ctx.beginPath()
			ctx.moveTo(startX, startY)
			ctx.lineTo(startX + 600, startY)
			ctx.lineTo(startX, startY)
			ctx.lineTo(startX, startY - 200)

			datas.forEach((value, index) => {
				let barHeight = (value / max) * 200
				let x = startX + gap + index * (barWidth + gap)
				let y = startY - barHeight
				ctx.fillStyle = colors[index]
				ctx.fillRect(x, y, barWidth, barHeight)
				ctx.font = "bold 0.75rem arial"

				ctx.fillText(`${datas[index]} Mark`, x, y - 10)
				ctx.fillText(`${labels[index]} Mark`, x, startY + 15)
			})

			ctx.fillStyle = "#000"
			ctx.lineWidth = 3
			ctx.stroke()
		}

		function drawLineGraph(canvas) {

			const ctx = canvas.getContext("2d");

			const rect = canvas.getBoundingClientRect();

			canvas.width = rect.width;
			canvas.height = rect.height;

			const width = canvas.width;
			const height = canvas.height;

			const data = [200, 150, 170, 100, 80, 50, 350, 200, 200, 230];

			const labels = [
				"Jan", "Feb", "Mar", "Apr", "May",
				"Jun", "Jul", "Aug", "Sep", "Oct"
			];

			const padding = 50;

			const graphWidth = width - padding * 2;
			const graphHeight = height - padding * 2;

			const maxValue = Math.max(...data);

			// =========================
			// GRID
			// =========================

			ctx.strokeStyle = "#fff";
			ctx.lineWidth = 0;

			for (let i = 0; i <= 5; i++) {

				let y = padding + (graphHeight / 5) * i;

				ctx.beginPath();
				ctx.moveTo(padding, y);
				ctx.lineTo(width - padding, y);
				ctx.stroke();
			}

			// =========================
			// AXIS
			// =========================

			ctx.strokeStyle = "#000";
			ctx.lineWidth = 2;

			ctx.beginPath();

			ctx.moveTo(padding, padding);
			ctx.lineTo(padding, height - padding);

			ctx.lineTo(width - padding, height - padding);

			ctx.stroke();

			// =========================
			// POINTS
			// =========================

			const points = [];

			data.forEach((value, index) => {

				const x =
					padding +
					(graphWidth / (data.length - 1)) * index;

				const y =
					height -
					padding -
					(value / maxValue) * graphHeight;

				points.push({
					x,
					y
				});
			});

			// =========================
			// AREA
			// =========================

			ctx.beginPath();

			ctx.moveTo(points[0].x, height - padding);
			ctx.lineTo(points[0].x, points[0].y);

			points.forEach(point => {
				ctx.lineTo(point.x, point.y);
			});

			ctx.lineTo(
				points[points.length - 1].x,
				height - padding
			);

			ctx.closePath();

			ctx.fillStyle = "rgba(124,58,237,0.15)";
			ctx.fill();

			// =========================
			// LINE
			// =========================

			ctx.beginPath();

			ctx.strokeStyle = "#7c3aed";
			ctx.lineWidth = 3;

			ctx.moveTo(points[0].x, points[0].y);

			for (let i = 1; i < points.length; i++) {
				ctx.lineTo(points[i].x, points[i].y);
			}

			ctx.stroke();

			// =========================
			// POINT CIRCLE
			// =========================

			points.forEach((point, index) => {

				ctx.beginPath();

				ctx.arc(
					point.x,
					point.y,
					5,
					0,
					Math.PI * 2
				);

				ctx.fillStyle = "#7c3aed";
				ctx.fill();

				ctx.strokeStyle = "#fff";
				ctx.lineWidth = 2;
				ctx.stroke();

				// Value
				ctx.fillStyle = "#000";
				ctx.font = "bold 12px Arial";
				ctx.textAlign = "center";

				ctx.fillText(
					data[index],
					point.x,
					point.y - 15
				);

				// Month Label
				ctx.fillStyle = "#666";

				ctx.fillText(
					labels[index],
					point.x,
					height - 20
				);
			});

		}

		drawPieChart(canvas_category);
		drawPieChart(canvas_Block);
		drawLineGraph(canvas_Trand);
		drawBarChart(canvas_Status);

		window.addEventListener("resize", () => {

			clearTimeout(resizeTimer);

			resizeTimer = setTimeout(() => {

				drawPieChart(canvas_category);
				drawPieChart(canvas_Block);
				drawLineGraph(canvas_Trand);
				drawBarChart(canvas_Status);

			}, 1000);

		});
	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="CAD"> <input type="text" name="title" id="title" hidden value="Report Analysis">
	<input type="text" name="title" id="title" hidden value="Report Analysis">
</body>

</html>