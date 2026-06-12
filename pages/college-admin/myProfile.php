<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" href="../../images/image.png" type="image/x-icon">

	<meta charset="UTF-8">
	<title>Dorm Facility Care</title>
	<link rel="stylesheet" href="../../lib/bootstrap.css">
	<script src="../../lib/bootstrap.js"></script>
	<link rel="stylesheet" href="../../style/layout.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	<script src="../../lib/jquery.js"></script>

	<script src="../../script/load-component.js"></script>

	<!-- your styling -->
	<link rel="stylesheet" href="../../style/myProfile.css">
</head>

<body>

	<section class="_workspace">

		<!-- CONTENT HERE -->
		<main class="_content-area">
			<!-- banner HERE -->
			<div class="profile-banner"></div>

			<div class="profile-card">
				<div id="profile-avatar" class="profile-avatar">
					<i class="fa-solid fa-user"></i>
				</div>
				<div class="profile-header">
					<h2 class="profile-name">Name</h2>
					<button onclick="hidContent()" class="btn btn-primary">Edit Profile</button>
				</div>
				<div class="profile-info">
					<p class="info-line" id="email-info">email@example.com</p>
					<p class="info-line" id="phone-info">123-456-7890</p>
					<p class="info-line" id="role-info">COLLEGE ADMIN</p>
				</div>
			</div>

		</main>
		<main class="_edit-form" style="display: none;">
			<div class="edit-card">
				<h2>Edit Profile</h2>
				<form>
					<div class="mb-3">
						<label for="photo" class="form-label">Avatar</label>
						<input type="file" class="form-control" id="photo">
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" id="email" placeholder="Enter your email">
					</div>
					<div class="mb-3">
						<label for="phone" class="form-label">Phone Number</label>
						<input type="text" class="form-control" id="phone" placeholder="Enter your phone number">
					</div>
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
						<input type="password" class="form-control" id="current-password"
							pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
							title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
							required">
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

			$("._content-area").hide();
			$("._edit-form").show();
		}
		function hidChangePass() {
			$("._edit-password-form").show();
			$("._edit-form").hide();
		}
		function cancelChangePass() {
			$("._edit-password-form").hide();
			$("._edit-form").show();
		}

		var passLength = $("#password-length");
		var passUpper = $("#password-uppercase");
		var passLower = $("#password-lowercase");
		var passNumber = $("#password-number");
		$("#new-password").on("input", function () {
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

			if (!currentPassword || !newPassword || !confirmPassword) {
				$("#password-error").text("Please fill in all password fields.");
				return;
			}

			const strongPassword = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
			if (!strongPassword.test(newPassword)) {
				$("#new-password-error").text("Password does not meet the requirements.");
				return;
			}

			if (newPassword !== confirmPassword) {
				$("#confirm-password-error").text("New password and confirm password do not match.");
				return;
			}

			alert("Password changed successfully!");
			cancelChangePass();
		}

		let avatarUrl = null;
		function saveChanges() {
			const file = $("#photo")[0].files[0];
			const email = $("#email").val();
			const phone = $("#phone").val();

			$("#email-info").text(email);
			$("#phone-info").text(phone);

			sessionStorage.setItem("email", email);
			sessionStorage.setItem("phone", phone);

			if (file) {
				const reader = new FileReader();

				reader.onload = function (e) {
					const imageData = e.target.result;

					$("#profile-avatar").php(`
						<img
							src="${imageData}"
							alt="Avatar"
							style="width:100%;height:100%;object-fit:cover;border-radius:50%;"
						>
					`);

					sessionStorage.setItem("avatar", imageData);
				};

				reader.readAsDataURL(file);
			}

			$("._edit-form").hide();
			$("._content-area").show();
		}
		$(document).ready(function () {

			const email = sessionStorage.getItem("email");
			const phone = sessionStorage.getItem("phone");
			const avatar = sessionStorage.getItem("avatar");

			if (email) {
				$("#email-info").text(email);
			}

			if (phone) {
				$("#phone-info").text(phone);
			}

			if (avatar) {
				$("#profile-avatar").php(`
					<img
						src="${avatar}"
						alt="Avatar"
						style="width:100%;height:100%;object-fit:cover;border-radius:50%;"
					>
				`);
			}

		});

		function cancelChange() {
			$("._edit-form").hide();
			$("._content-area").show();
		}

	</script>

	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="USER">
	<input type="text" name="title" id="title" hidden value="My Profile">
</body>

</html>