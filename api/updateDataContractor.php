<?php
session_start();
require_once "../inc/conn.php";

header("Content-Type: application/json");
ob_clean();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$userID = $_POST["userID"];
	$uptname = $_POST["uptname"];
	$uptphoneNumber = $_POST["uptphoneNumber"];
	$uptemail = $_POST["uptemail"];
	$uptexpertise = $_POST["uptexpertise"];

	$sqlUser = "
        UPDATE user
        SET
            name = '$uptname',
            numTel = '$uptphoneNumber',
            email = '$uptemail'
        WHERE userID = '$userID'
    ";

	$sqlContractor = "
        UPDATE contractor
        SET expertise = '$uptexpertise'
        WHERE contractorID = '$userID'
    ";

	if (mysqli_query($conn, $sqlUser) &&
		mysqli_query($conn, $sqlContractor)){

		echo json_encode([
			"status" => "success",
			"message" => "Contractor updated successfully"
		]);
	} else {

		echo json_encode([
			"status" => "error",
			"message" => mysqli_error($conn)
		]);
	}
}
