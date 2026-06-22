<?php
session_start();
require_once "../inc/conn.php";
require_once "../inc/mail.php";

header("Content-Type: application/json");
ob_clean();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$reportID = $_POST["reportID"];
	$message = $_POST["message"];
	$completedImgUrl = $_POST["url"];

	$sql = " 	SELECT *
			FROM report
			INNER JOIN user ON report.userID = user.userID
			WHERE reportID = '$reportID'
	";

	$result = mysqli_query($conn, $sql);

	if ($dataReport = mysqli_fetch_assoc($result)) {
		$ss = "
			Hello {$dataReport['name']},
	
			Your report #{$dataReport['reportID']} has been completed.
	
			Category: {$dataReport['reportCategory']}
			Status: Completed
	
			Thank you for using Dorm Facility Care.
			";
	
		send(
			$dataReport["email"],
			"Dorm Facility Care - Report Completed",
			$ss
		);
	
		$sql = "	UPDATE report
				SET status = 'Completed', completedImgUrl = '$completedImgUrl', remarks = '$message'
				WHERE reportID  = '$reportID'";
	
		$result = mysqli_query($conn, $sql);

		echo json_encode([
			"status" => "success",
		]);
	}else{

		echo json_encode([
			"status" => "error",
			"message" => mysqli_error($conn)
		]);
	}


}
