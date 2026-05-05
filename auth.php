<?php
require_once __DIR__ . '/config.php';

// if (!isset($_SESSION['user_id'])) {
// 	header("Location: " . BASE_URL . "/index.php");
// 	exit;
// }

/**
 * Check role access
 */
function authorize($allowed_roles = [])
{
	// if (!isset($_SESSION['role'])) {
	// 	header("Location: " . BASE_URL . "/index.php");
	// 	exit;
	// }

	// if (!in_array($_SESSION['role'], $allowed_roles)) {
	// 	header("Location: " . BASE_URL . "/unauthorized.php");
	// 	exit;
	// }
}