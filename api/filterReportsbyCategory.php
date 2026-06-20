<?php
session_start();
require_once "../inc/conn.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$filterMonthCategory = $_POST["filterMonthCategory"] ?? "";
	$filterCollegeCategory = $_POST["filterCollegeCategory"] ?? "";

	$sql = "
    SELECT reportCategory, COUNT(*) AS total
    FROM report
    WHERE 1=1
";

	if (!empty($filterCollegeCategory) && $filterCollegeCategory != "All College") {
		$sql .= " AND college = '$filterCollegeCategory'";
	}

	// FILTER MONTH (input type="month" => YYYY-MM)
	if (!empty($filterMonthCategory)) {
		$year = date('Y', strtotime($filterMonthCategory));
		$month = date('m', strtotime($filterMonthCategory));

		$sql .= " AND YEAR(dateReported) = '$year'
              AND MONTH(dateReported) = '$month'";
	}

	$sql .= " GROUP BY reportCategory";

	$query = mysqli_query($conn, $sql);

	$datas = [];

	while ($row = mysqli_fetch_assoc($query)) {
		$datas[] = $row;
	}

	echo json_encode([
		"status" => "success",
		"datas" => $datas,
		"filterMonthCategory" => $filterMonthCategory,
		"filterCollegeCategory" => $filterCollegeCategory
	]);
}
