<?php
session_start();
require_once "../inc/conn.php";

header("Content-Type: application/json");
ob_clean();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$reportID = $_POST["reportID"];

	$sql = "	UPDATE report
			SET status = 'Forward' 
			WHERE reportID  = '$reportID'";

	$result = mysqli_query($conn, $sql);

	if ($result) {
		echo json_encode([
			"status" => "success",
		]);
	} else {
		echo json_encode([
			"status" => "error",
			"message" => mysqli_error($conn)
		]);
	}
}
