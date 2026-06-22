<?php
session_start();
require_once "../inc/conn.php";

header("Content-Type: application/json");
ob_clean();

function generatePassword($length = 10)
{
	$lower = 'abcdefghijklmnopqrstuvwxyz';
	$upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$numbers = '0123456789';
	$symbols = '!@#$%^&*';

	$all = $lower . $upper . $numbers . $symbols;

	$password = [];

	// pastikan ada minimum requirement
	$password[] = $lower[random_int(0, strlen($lower) - 1)];
	$password[] = $upper[random_int(0, strlen($upper) - 1)];
	$password[] = $numbers[random_int(0, strlen($numbers) - 1)];
	$password[] = $symbols[random_int(0, strlen($symbols) - 1)];

	for ($i = 4; $i < $length; $i++) {
		$password[] = $all[random_int(0, strlen($all) - 1)];
	}

	shuffle($password);

	return implode('', $password);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	// $email = $_POST["email"] ?? '';
	// $phone = $_POST["phone"] ?? '';	
	$email = 'd032410321@student.utem.edu.my';
	$phone = '0197237577';

	$stmt = mysqli_prepare($conn, "SELECT userID FROM user WHERE email = ? AND numTel = ?");
	mysqli_stmt_bind_param($stmt, "ss", $email, $phone);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$datauser = mysqli_fetch_assoc($result);

	if (!$datauser) {
		echo json_encode([
			"status" => "error",
			"message" => "User not found",
			$email,
			$phone,
		]);
		exit;
	}

	$newPassword = password_hash(generatePassword(), PASSWORD_DEFAULT);
	$userID = $datauser['userID'];

	send();

	$stmt2 = mysqli_prepare($conn, "UPDATE user SET password = ? WHERE userID = ?");
	mysqli_stmt_bind_param($stmt2, "si", $newPassword, $userID);
	$ok = mysqli_stmt_execute($stmt2);

	if ($ok) {
		echo json_encode([
			"status" => "success"
		]);
	} else {
		echo json_encode([
			"status" => "error",
			"message" => mysqli_error($conn)
		]);
	}
}
