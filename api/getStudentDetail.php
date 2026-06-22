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

			student.studentCollege,
			student.studentRoom

        		FROM user 
        		INNER JOIN student ON user.userID = student.userID
        		WHERE user.userID = '$userID'";

	$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

	echo json_encode([
		"status" => "success",
		$result
	]);

	// if ($result) {
	// 	echo json_encode([
	// 		"status" => "success",
	// 	]);
	// } else {
	// 	echo json_encode([
	// 		"status" => "error",
	// 		"message" => mysqli_error($conn)
	// 	]);
	// }
}
