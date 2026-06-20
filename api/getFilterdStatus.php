<?php
session_start();
require_once "../inc/conn.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$filterStatusCollege = $_POST["filterStatusCollege"] ?? "";
	$filterStatusMonth = $_POST["filterStatusMonth"] ?? "";

	$sql = "SELECT college,status,dateReported, COUNT(*) AS total
			WHERE = '$filterStatusCollege'
            FROM report
            GROUP BY status";

	// FILTER COLLEGE
	// if (!empty($filterStatusCollege)) {
		// $sql .= " AND college = '$filterStatusCollege'";
	// }

	// FILTER MONTH
	// if (!empty($filterStatusMonth)) {
		// $year = date('Y', strtotime($filterStatusMonth));
		// $month = date('m', strtotime($filterStatusMonth));

		// $sql .= " AND YEAR(dateReported) = '$year'
				//   AND MONTH(dateReported) = '$month'";
	// }

	// $sql .= "
		// GROUP BY college
		// ORDER BY totalReport DESC
	// ";

	$result = mysqli_query($conn, $sql);

	$data = [];

	while ($row = mysqli_fetch_assoc($result)) {
		$data[] = [
			$row["status"],
			(int)$row["total"],
			$row["college"],
		];
	}

	echo json_encode([
		"status" => "success",
		"datas" => $data
	]);
}
