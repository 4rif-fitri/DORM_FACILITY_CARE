<?php
session_start();
require_once "../inc/conn.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$where = [];

	$userID = $_POST["userID"];

	// wajib tapis ikut user login
	$where[] = "userID='$userID'";

	if (!empty($_POST["date"])) {
		$date = $_POST["date"];
		$where[] = "DATE(dateReported)='$date'";
	}

	if (!empty($_POST["status"])) {
		$status = $_POST["status"];
		$where[] = "status='$status'";
	}

	if (!empty($_POST["category"])) {
		$category = $_POST["category"];
		$where[] = "reportCategory='$category'";
	}

	if (!empty($_POST["location"])) {
		$location = $_POST["location"];
		$where[] = "college='$location'";
	}

	$sql = "SELECT 
				reportID,
				reportCategory,
				reportRoom,
				college,
				status,
				dateReported,
				dateInProgress,
				dateAssigned,
				dateCompleted,
				dateRejected
			FROM report";

	if (!empty($where)) {
		$sql .= " WHERE " . implode(" AND ", $where);
	}

	$sql .= " ORDER BY GREATEST(
				IFNULL(dateReported, '0000-00-00 00:00:00'),
				IFNULL(dateInProgress, '0000-00-00 00:00:00'),
				IFNULL(dateAssigned, '0000-00-00 00:00:00'),
				IFNULL(dateCompleted, '0000-00-00 00:00:00'),
				IFNULL(dateRejected, '0000-00-00 00:00:00')
			) DESC";

	$result = mysqli_query($conn, $sql);

	$data = [];

	while ($row = mysqli_fetch_assoc($result)) {
		$data[] = $row;
	}

	echo json_encode([
		"status" => "success",
		"sql" => $sql,
		"data" => $data
	]);
}
