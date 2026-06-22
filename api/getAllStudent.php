<?php
require_once "../inc/conn.php";

header("Content-Type: application/json");
ob_clean();

$sql = "SELECT * FROM user 
        JOIN student ON user.userID = student.userID
        ORDER BY name ASC";

$result = mysqli_query($conn, $sql);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
	$data[] = $row;
}
echo json_encode([
	"status" => "success",
	"datas" => $data
]);
