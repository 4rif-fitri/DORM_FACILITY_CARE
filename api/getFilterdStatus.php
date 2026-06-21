<?php
session_start();
require_once "../inc/conn.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$filterStatusCollege = $_POST["filterStatusCollege"] ?? "";
	$filterStatusMonth = $_POST["filterStatusMonth"] ?? "";

	$sql = "
        SELECT status, COUNT(*) AS total
        FROM report
        WHERE 1=1
    ";

	if (!empty($filterStatusCollege)) {
		$sql .= " AND college = '$filterStatusCollege'";
	}

	if (!empty($filterStatusMonth)) {
		$year = date('Y', strtotime($filterStatusMonth));
		$month = date('m', strtotime($filterStatusMonth));

		$sql .= "
            AND YEAR(dateReported) = '$year'
            AND MONTH(dateReported) = '$month'
        ";
	}

	$sql .= "
        GROUP BY status
        ORDER BY total DESC
    ";

	$result = mysqli_query($conn, $sql);

	$data = [];

	while ($row = mysqli_fetch_assoc($result)) {
		$data[] = [
			$row["status"],
			(int)$row["total"]
		];
	}

	echo json_encode([
		"status" => "success",
		"datas" => $data
	]);
}
