<?php
	session_start();
	require_once "../inc/conn.php";
	date_default_timezone_set('Asia/Kuala_Lumpur');

	header("Content-Type: application/json");
	ob_clean();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$id = $_SESSION["userID"];
	$category = $_POST["category"];
	$url = $_POST["url"];
	$description = $_POST["description"];
	$location = $_POST["location"];
	$room = $_POST["room_no"];
	$status = "Pending";
	$arr = array(
		$id,
		$category,
		$description,
		$location,
		$room,
		$url
	);


$timestamp = date("Y-m-d H:i:s");

$sql = "INSERT INTO report
        (reportCategory, reportDesc, reportRoom, college, status, userID, reportImgUrl, dateReported)
        VALUES (?,?,?,?,?,?,?,?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ssssssss",
    $category,
    $description,
    $room,
    $location,
    $status,
    $id,
    $url,
    $timestamp
);

	if (mysqli_stmt_execute($stmt)) {
		echo json_encode([
			"status" => "success",
			"message" => "Report saved"
		]);
	} else {
		echo json_encode([
			"status" => "error",
			"message" => mysqli_error($conn)
		]);
	}
}
