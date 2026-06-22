<?php
session_start();
require_once "../inc/conn.php";

header("Content-Type: application/json");
ob_clean();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$userID = $_POST["userID"];

	$sql = "	SELECT 
			user.userID,
			user.name,
			user.numTel,
			user.email,

			contractor.expertise

        		FROM user 
        		INNER JOIN contractor ON user.userID = contractor.contractorID 
        		WHERE user.userID = '$userID'";

	$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

	echo json_encode([
		"status" => "success",
		"datas" => $result 
	]);
}
