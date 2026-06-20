<?php
session_start();
require_once "../inc/conn.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$tableFilterDate = $_POST["tableFilterDate"] ?? "";
	$tableFilterCategory = $_POST["tableFiltercatagory"] ?? "";

	$sql = "
		SELECT college,
			COUNT(*) AS totalReport,
			SUM(status='Pending') AS pending,
			SUM(status='Assigned') AS assigned,
			SUM(status='In_Progress') AS inProgress,
			SUM(status='Completed') AS completed
		FROM report
		WHERE 1=1
	";

	// FILTER CATEGORY
	if (!empty($tableFilterCategory) && $tableFilterCategory != "All category") {
		$sql .= " AND reportCategory = '$tableFilterCategory'";
	}

	// FILTER MONTH (input type="month" => YYYY-MM)
	if (!empty($tableFilterDate)) {
		$year = date('Y', strtotime($tableFilterDate));
		$month = date('m', strtotime($tableFilterDate));

		$sql .= " AND YEAR(dateReported) = '$year'
				  AND MONTH(dateReported) = '$month'";
	}

	$sql .= " GROUP BY college ORDER BY totalReport DESC";

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
		];
	}

	echo json_encode([
		"status" => "success",
		"datas" => $data,
		"tableFilterDate" => $tableFilterDate,
		"tableFilterCategory" => $tableFilterCategory
	]);
}
