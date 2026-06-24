<?php

ob_start();

require_once __DIR__ . "../../../inc/init.php";
auth("CTR");

if (!isset($_SESSION["userID"])) {
	header("Location: ../../index.php");
	exit;
}

$userID = $_SESSION["userID"];


$stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE userID = ?");
mysqli_stmt_bind_param($stmt, "s", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

function mapType($type) {
	$labels = [
		"STD" => "STUDENT",
		"STF" => "STAFF",
		"CTR" => "CONTRACTOR",
		"CAD" => "COLLEGE ADMIN",
		"SAD" => "SYSTEM ADMIN"
	];
	return $labels[$type] ?? $type;
}

function bindParams($stmt, $types, $params) {
	$args = array_merge([$types], $params);
	$refs = [];
	foreach ($args as $key => $value) {
		$refs[$key] = &$args[$key];
	}
	call_user_func_array("mysqli_stmt_bind_param", array_merge([$stmt], $refs));
}

function sendJson($data) {
	ob_end_clean();
	header("Content-Type: application/json");
	echo json_encode($data);
	exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (($_POST["action"] ?? "") == "update_profile") {

		$email  = trim($_POST["email"] ?? "");
		$phone  = trim($_POST["phone"] ?? "");
		$avatar = $_POST["avatar"] ?? "";
		$status = trim($_POST["status"] ?? "");

		// Availability status is a contractor-only field.
		$allowedStatuses = ["Available", "Not Available"];
		if ($user["type"] !== "CTR" || !in_array($status, $allowedStatuses, true)) {
			$status = "";
		}

		$fields = [];
		$types  = "";
		$params = [];

		if ($email !== "") {
			$fields[] = "email = ?";
			$types   .= "s";
			$params[] = $email;
		}
		if ($phone !== "") {
			$fields[] = "numTel = ?";
			$types   .= "s";
			$params[] = $phone;
		}
		if ($avatar !== "") {
			$fields[] = "imgProfileUrl = ?";
			$types   .= "s";
			$params[] = $avatar;
		}
		if ($status !== "") {
			$fields[] = "statuss = ?";
			$types   .= "s";
			$params[] = $status;
		}

		if (empty($fields)) {
			sendJson(["success" => false, "message" => "Nothing to update."]);
		}

		$types   .= "s";
		$params[] = $userID;

		$sql    = "UPDATE user SET " . implode(", ", $fields) . " WHERE userID = ?";
		$update = mysqli_prepare($conn, $sql);
		bindParams($update, $types, $params);
		mysqli_stmt_execute($update);

		// Keep the session copy in sync with what's now in the DB.
		if ($email !== "")  $_SESSION["email"] = $email;
		if ($avatar !== "") $_SESSION["url"]   = $avatar;
		if ($status !== "") $_SESSION["status"] = $status;

		sendJson(["success" => true, "message" => "Profile updated."]);
	}

	if (($_POST["action"] ?? "") == "change_password") {

		$currentPassword = $_POST["current_password"] ?? "";
		$newPassword     = $_POST["new_password"] ?? "";
		$confirmPassword = $_POST["confirm_password"] ?? "";

		if (!$currentPassword || !$newPassword || !$confirmPassword) {
			sendJson(["success" => false, "field" => "current", "message" => "Please fill in all password fields."]);
		}

		$strongPassword = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/';
		if (!preg_match($strongPassword, $newPassword)) {
			sendJson(["success" => false, "field" => "new", "message" => "Password does not meet the requirements."]);
		}

		if ($newPassword !== $confirmPassword) {
			sendJson(["success" => false, "field" => "confirm", "message" => "New password and confirm password do not match."]);
		}

		if (!password_verify($currentPassword, $user["password"])) {
			sendJson(["success" => false, "field" => "current", "message" => "Current password is incorrect."]);
		}

		$newHash = password_hash($newPassword, PASSWORD_DEFAULT);
		$update  = mysqli_prepare($conn, "UPDATE user SET password = ? WHERE userID = ?");
		mysqli_stmt_bind_param($update, "ss", $newHash, $userID);
		mysqli_stmt_execute($update);

		sendJson(["success" => true, "message" => "Password changed successfully!"]);
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- your styling -->
	<link rel="stylesheet" href="../../style/myProfile.css">
</head>

<body>

	<section class="_workspace">
		<?php $title = "My Profile" ?>
		<?php include(__DIR__ . "../../../components/contractor/header.php") ?>

		<!-- CONTENT HERE -->
		<main class="_content-area">
			<!-- banner HERE -->
			<div class="profile-banner"></div>

			<div class="profile-card">
				<div id="profile-avatar" class="profile-avatar">
					<?php if (!empty($user["imgProfileUrl"])): ?>
						<img
							src="<?= htmlspecialchars($user["imgProfileUrl"]) ?>"
							alt="Avatar"
							style="width:100%;height:100%;object-fit:cover;border-radius:50%;"
						>
					<?php else: ?>
						<i class="fa-solid fa-user"></i>
					<?php endif; ?>
				</div>
				<div class="profile-header">
					<h2 class="profile-name"><?= htmlspecialchars($user["name"]) ?></h2>
					<button onclick="hidContent()" class="btn btn-primary">Edit Profile</button>
				</div>
				<div class="profile-info">
					<p class="info-line" id="email-info"><?= htmlspecialchars($user["email"]) ?></p>
					<p class="info-line" id="phone-info"><?= htmlspecialchars($user["numTel"] ?? "") ?></p>
					<p class="info-line" id="role-info"><?= htmlspecialchars(mapType($user["type"])) ?></p>
					<?php if ($user["type"] === "CTR"): ?>
						<p class="info-line" id="status-info"><?= htmlspecialchars($user["statuss"] ?? "Not Available") ?></p>
					<?php endif; ?>
				</div>
			</div>

		</main>
		<main class="_edit-form" style="display: none;">
			<div class="edit-card">
				<h2>Edit Profile</h2>
				<form>
					<div class="mb-3">
						<label for="photo" class="form-label">Avatar</label>
						<input type="file" class="form-control" id="photo" accept="image/*">
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" id="email" placeholder="Enter your email">
					</div>
					<div class="mb-3">
						<label for="phone" class="form-label">Phone Number</label>
						<input type="text" class="form-control" id="phone" placeholder="Enter your phone number">
					</div>
					<?php if ($user["type"] === "CTR"): ?>
						<div class="mb-3">
							<label for="status" class="form-label">Availability Status</label>
							<select class="form-control" id="status">
								<option value="Available">Available</option>
								<option value="Not Available">Not Available</option>
							</select>
						</div>
					<?php endif; ?>
					<p id="profile-error" class="text-danger"></p>
					<button type="button" onclick="hidChangePass()" class="btn btn-warning">Change
						Password</button>
					<button type="button" onclick="cancelChange()" class="btn btn-secondary">Cancel</button>
					<button type="button" onclick="saveChanges()" class="btn btn-success">Save Changes</button>
				</form>
			</div>
		</main>

		<main class="_edit-password-form" style="display: none;">
			<div class="edit-card">
				<h2>Edit Password</h2>
				<form>
					<div class="mb-3">
						<label for="current-password" class="form-label">Current Password</label>
						<input type="password" class="form-control" id="current-password">
						<input type="checkbox" id="show-password" class="form-check-input"
							style="margin-top: 10px;">
						<label for="show-password" class="form-check-label">Show Password</label>
						<p id="password-error" class="text-danger"></p>
					</div>
					<div class="mb-3">
						<label for="new-password" class="form-label">New Password</label>
						<input type="password" class="form-control" id="new-password"
							placeholder="Enter new password">
						<input type="checkbox" id="show-new-password" class="form-check-input"
							style="margin-top: 10px;">
						<label for="show-new-password" class="form-check-label">Show Password</label>
						<p id="new-password-error" class="text-danger"></p>
					</div>
					<div class="mb-3">
						<label for="confirm-password" class="form-label">Confirm New Password</label>
						<input type="password" class="form-control" id="confirm-password"
							placeholder="Confirm new password">
						<input type="checkbox" id="show-confirm-password" class="form-check-input"
							style="margin-top: 10px;">
						<label for="show-confirm-password" class="form-check-label">Show Password</label>
						<p id="confirm-password-error" class="text-danger"></p>
					</div>
					<button type="button" onclick="cancelChangePass()" class="btn btn-secondary">Cancel</button>
					<button type="button" onclick="saveChangesPass()" class="btn btn-success">Save Changes</button>
				</form>
				<div id="password-requirements" style="margin-top: 20px;">
					<h5>New password must contain the following:</h5>
					<ul>
						<li id="password-length">At least 8 characters long</li>
						<li id="password-uppercase">Contains at least one uppercase letter</li>
						<li id="password-lowercase">Contains at least one lowercase letter</li>
						<li id="password-number">Contains at least one number</li>
					</ul>
				</div>
			</div>
		</main>
		<!-- CONTENT HERE -->

	</section>

	<!-- your script -->
	<script>
		function hidContent() {
			$("#email").val($("#email-info").text());
			$("#phone").val($("#phone-info").text());
			if ($("#status").length) {
				$("#status").val($("#status-info").text().trim());
			}
			$("#profile-error").text("");

			$("._content-area").hide();
			$("._edit-form").show();
		}

		function hidChangePass() {
			$("._edit-password-form").show();
			$("._edit-form").hide();
		}

		function cancelChangePass() {
			$("#current-password").val("").attr("type", "password");
			$("#new-password").val("").attr("type", "password");
			$("#confirm-password").val("").attr("type", "password");
			$("#show-password, #show-new-password, #show-confirm-password").prop("checked", false);
			$("#password-error").text("");
			$("#new-password-error").text("");
			$("#confirm-password-error").text("");

			$("._edit-password-form").hide();
			$("._edit-form").show();
		}


		function wireShowPasswordToggle(checkboxId, inputId) {
			$(checkboxId).on("change", function() {
				const type = $(this).is(":checked") ? "text" : "password";
				$(inputId).attr("type", type);
			});
		}
		wireShowPasswordToggle("#show-password", "#current-password");
		wireShowPasswordToggle("#show-new-password", "#new-password");
		wireShowPasswordToggle("#show-confirm-password", "#confirm-password");

		var passLength = $("#password-length");
		var passUpper = $("#password-uppercase");
		var passLower = $("#password-lowercase");
		var passNumber = $("#password-number");
		$("#new-password").on("input", function() {
			var password = $(this).val();

			if (password.length >= 8) {
				passLength.css("color", "green");
			} else {
				passLength.css("color", "red");
			}

			if (/[A-Z]/.test(password)) {
				passUpper.css("color", "green");
			} else {
				passUpper.css("color", "red");
			}

			if (/[a-z]/.test(password)) {
				passLower.css("color", "green");
			} else {
				passLower.css("color", "red");
			}

			if (/\d/.test(password)) {
				passNumber.css("color", "green");
			} else {
				passNumber.css("color", "red");
			}
		});

		function saveChangesPass() {
			const currentPassword = $("#current-password").val();
			const newPassword = $("#new-password").val();
			const confirmPassword = $("#confirm-password").val();

			$("#password-error").text("");
			$("#new-password-error").text("");
			$("#confirm-password-error").text("");

			$.ajax({
				url: "",
				method: "POST",
				dataType: "json",
				data: {
					action: "change_password",
					current_password: currentPassword,
					new_password: newPassword,
					confirm_password: confirmPassword
				},
				success: function(res) {
					if (res.success) {
						alert(res.message);
						cancelChangePass();
					} else {
						if (res.field === "current") {
							$("#password-error").text(res.message);
						} else if (res.field === "confirm") {
							$("#confirm-password-error").text(res.message);
						} else {
							$("#new-password-error").text(res.message);
						}
					}
				},
				error: function() {
					$("#password-error").text("Something went wrong. Please try again.");
				}
			});
		}

		function saveChanges() {
			const file = $("#photo")[0].files[0];
			const email = $("#email").val();
			const phone = $("#phone").val();
			const status = $("#status").length ? $("#status").val() : "";

			$("#profile-error").text("");

			function sendUpdate(avatarData) {
				$.ajax({
					url: "",
					method: "POST",
					dataType: "json",
					data: {
						action: "update_profile",
						email: email,
						phone: phone,
						avatar: avatarData || "",
						status: status
					},
					success: function(res) {
						if (res.success) {
							$("#email-info").text(email);
							$("#phone-info").text(phone);
							if (status) {
								$("#status-info").text(status);
							}

							if (avatarData) {
								$("#profile-avatar").html(`
									<img
										src="${avatarData}"
										alt="Avatar"
										style="width:100%;height:100%;object-fit:cover;border-radius:50%;"
									>
								`);
							}

							$("._edit-form").hide();
							$("._content-area").show();
						} else {
							$("#profile-error").text(res.message);
						}
					},
					error: function() {
						$("#profile-error").text("Could not save changes. Please try again.");
					}
				});
			}

			if (file) {
				const reader = new FileReader();
				reader.onload = function(e) {
					sendUpdate(e.target.result); 
				};
				reader.readAsDataURL(file);
			} else {
				sendUpdate(null);
			}
		}

		function cancelChange() {
			$("#profile-error").text("");
			$("._edit-form").hide();
			$("._content-area").show();
		}
	</script>

	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="CTR">
	<input type="text" name="title" id="title" hidden value="My Profile">
</body>

</html>