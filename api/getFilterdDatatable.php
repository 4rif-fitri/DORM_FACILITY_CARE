<?php
session_start();
require_once "../inc/conn.php";

header("Content-Type: application/json");
ob_clean();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$filter = $_POST["filter"];
	$sql;

	if($filter == "All category"){
		$sql = "	SELECT college,
					COUNT(*) AS totalReport,
					SUM(status='Pending') AS pending,
					SUM(status='Assigned') AS assigned,
					SUM(status='In_Progress') AS inProgress,
					SUM(status='Completed') AS completed
				FROM report
				GROUP BY college
				ORDER BY totalReport DESC";
	}else{
		$sql = "	SELECT college,
					COUNT(*) AS totalReport,
					SUM(status='Pending') AS pending,
					SUM(status='Assigned') AS assigned,
					SUM(status='In_Progress') AS inProgress,
					SUM(status='Completed') AS completed
				FROM report
				WHERE reportCategory = '$filter'
				GROUP BY college
				ORDER BY totalReport DESC";
	}

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

	if ($result) {
		echo json_encode([
			"status" => "success",
			"datas" => $data
		]);
	} else {
		echo json_encode([
			"status" => "error",
			"message" => mysqli_error($conn)
		]);
	}
}
