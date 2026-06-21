<?php
require_once "./inc/conn.php";

// Dapatkan semua user
$sql = "SELECT userID, password FROM user";
$result = mysqli_query($conn, $sql);

if (!$result) {
	die("Query gagal: " . mysqli_error($conn));
}

$updated = 0;

while ($row = mysqli_fetch_assoc($result)) {

	$userId = $row['userID'];
	$password = "abc123";

	// Skip jika password sudah di-hash
	if (password_get_info($password)['algo'] !== null) {
		continue;
	}

	// Hash password asal
	$hash = password_hash($password, PASSWORD_DEFAULT);

	// Update ke database
	$update = "UPDATE user
               SET password = ?
               WHERE userID = ?";

	$stmt = mysqli_prepare($conn, $update);
	mysqli_stmt_bind_param($stmt, "si", $hash, $userId);
	mysqli_stmt_execute($stmt);

	if (mysqli_stmt_affected_rows($stmt) > 0) {
		$updated++;
	}

	mysqli_stmt_close($stmt);
}

echo "Selesai. $updated password berjaya di-hash.";

mysqli_close($conn);
?>