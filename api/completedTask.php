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
			<html>
			<head>
			<style>
				body {
					font-family: Arial, sans-serif;
					background-color: #f4f6f9;
					padding: 20px;
					color: #333;
				}
				.container {
					max-width: 600px;
					margin: auto;
					background: #ffffff;
					border-radius: 10px;
					overflow: hidden;
					box-shadow: 0 2px 10px rgba(0,0,0,0.1);
				}
				.header {
					background: #28a745;
					color: white;
					text-align: center;
					padding: 20px;
				}
				.content {
					padding: 25px;
				}
				.info {
					background: #f8f9fa;
					padding: 15px;
					border-left: 4px solid #28a745;
					margin: 15px 0;
				}
				.remarks {
					background: #fff3cd;
					padding: 15px;
					border-left: 4px solid #ffc107;
					margin: 15px 0;
				}
				.footer {
					text-align: center;
					padding: 15px;
					background: #f8f9fa;
					color: #666;
					font-size: 12px;
				}
			</style>
			</head>
			<body>
			<div class='container'>
				<div class='header'>
					<h2>Report Completed</h2>
				</div>

				<div class='content'>
					<p>Dear <strong>{$dataReport['name']}</strong>,</p>

					<p>We are pleased to inform you that your maintenance report has been successfully completed.</p>

					<div class='info'>
						<p><strong>Report ID:</strong> #{$dataReport['reportID']}</p>
						<p><strong>Category:</strong> {$dataReport['reportCategory']}</p>
						<p><strong>Status:</strong> Completed</p>
					</div>

					<div class='remarks'>
						<p><strong>Contractor Remarks:</strong></p>
						<p>{$message}</p>
					</div>

					<p>If you have any further issues, please submit a new report through the Dorm Facility Care system.</p>

					<p>Thank you for using <strong>Dorm Facility Care</strong>.</p>

					<p>
						Best Regards,<br>
						Dorm Facility Care Team
					</p>
				</div>

				<div class='footer'>
					© " . date('Y') . " Dorm Facility Care. All Rights Reserved.
				</div>
			</div>
			</body>
			</html>
			";
	
		send(
			$dataReport["email"],
			"Dorm Facility Care - Report Completed",
			$ss
		);
	
		$sql = "	UPDATE report
				SET 	status = 'Completed', 
					completedImgUrl = '$completedImgUrl', 
					remarks = '$message',
					dateCompleted = NOW()
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
