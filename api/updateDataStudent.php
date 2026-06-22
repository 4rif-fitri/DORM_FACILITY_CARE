<?php
session_start();
require_once "../inc/conn.php";

header("Content-Type: application/json");
ob_clean();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$userID = $_POST["uptuserID"];
	$uptname = $_POST["uptname"];
	$uptphoneNumber = $_POST["uptphoneNumber"];
	$uptemail = $_POST["uptemail"];
	$uptcollage = $_POST["uptcollage"];
	$uptstudentRoom = $_POST["uptstudentRoom"];

	$sqlUser ="	UPDATE user
        			SET 	name = '$uptname',
            			numTel = '$uptphoneNumber',
            			email = '$uptemail'
        			WHERE userID = '$userID'
    			";

	$sqlStudent = "UPDATE student
        			SET 	studentCollege = '$uptcollage',
            			studentRoom = '$uptstudentRoom'
        			WHERE userID = '$userID'
    			";

	if (mysqli_query($conn, $sqlUser) && mysqli_query($conn, $sqlStudent)) {

		echo json_encode([
			"status" => "success",
			"message" => "Student updated successfully"
		]);
	} else {

		echo json_encode([
			"status" => "error",
			"message" => mysqli_error($conn)
		]);
	}
}
