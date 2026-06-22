<?php
require_once "../inc/conn.php";

header("Content-Type: application/json");
ob_clean();

$sql = " 	SELECT 
    		user.userID,
    		user.name,
    		user.numTel,
    		user.email,
    		contractor.expertise
		FROM user
		INNER JOIN contractor ON user.userID = contractor.contractorID
";

$result = mysqli_query($conn, $sql);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
	$data[] = $row;
}

echo json_encode([
	"status" => "success",
	"datas" => $data
]);
