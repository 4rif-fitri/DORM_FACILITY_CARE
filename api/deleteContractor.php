<?php
require_once "../inc/conn.php";

header("Content-Type: application/json");
ob_clean();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$userID = $_POST["userID"];

	mysqli_begin_transaction($conn);

	try {

		mysqli_query($conn, "DELETE FROM contractor WHERE ContractorID = '$userID'");

		mysqli_query($conn, "DELETE FROM user WHERE userID = '$userID'");

		mysqli_commit($conn);

		echo json_encode([
			"status" => "success",
			"message" => "Contractor deleted"
		]);
	} catch (Exception $e) {

		mysqli_rollback($conn);

		echo json_encode([
			"status" => "error",
			"message" => mysqli_error($conn)
		]);
	}
}
