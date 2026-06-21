<?php
session_start();
require_once "./inc/conn.php";
require_once "./inc/auth.php";
require_once "./inc/mail.php";
auth("STD");

//php code hrre

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_POST["email"];
	$password = $_POST["password"];

	$stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE email = ?");
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if (mysqli_num_rows($result) > 0) {

		$user = mysqli_fetch_assoc($result);

		if (
			password_verify($password, $user["password"]) ||
			$password === $user["password"]
		) {

			if ($password === $user["password"]) {
				$hash = password_hash($password, PASSWORD_DEFAULT);

				$update = mysqli_prepare($conn, "UPDATE user SET password=? WHERE userID=?");
				mysqli_stmt_bind_param($update, "si", $hash, $user["userID"]);
				mysqli_stmt_execute($update);
			}

			$_SESSION["name"] = $user["name"];
			$_SESSION["email"] = $user["email"];
			$_SESSION["userID"] = $user["userID"];
			$_SESSION["type"] = $user["type"];
			$_SESSION["url"] = $user["imgProfileUrl"];

			if ($user["type"] == "STD" || $user["type"] == "STF") {
				header("Location: ./pages/user/dashboard.php");
			} else if ($user["type"] == "SAD") {
				header("Location: ./pages/system-admin/dashboard.php");
			} else if ($user["type"] == "CTR") {
				header("Location: ./pages/contractor/dashboard.php");
			} else if ($user["type"] == "CAD") {
				header("Location: ./pages/college-admin/dashboard.php");
			}

			exit;
		}
	}

	echo "<script>alert('Invalid Credential')</script>";
}
//php code hrre

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" href="../../images/image.png" type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	<meta charset="UTF-8">
	<title>Dorm Facility Care</title>
	<script src="./lib/jquery.js"></script>
	<link rel="stylesheet" href="./style/index.css">
	<link rel="stylesheet" href="./lib/bootstrap.css">
	<script src="./lib/bootstrap.js"></script>
</head>

<body>
	<input hidden type="checkbox" name="_mobile-sideBar" id="_mobile-sideBar">

	<section class="_workspace">

		<header class="_navbar">
			<article>
			</article>

			<label for="_mobile-sideBar">
				<p class="_btn-login _mobile">Login</p>
			</label>

		</header>

		<!-- CONTENT HERE -->
		<main class="_content-area ">

			<div class="index-container">

				<section class="right _dekstop">
					<img class="logo" src="./images/logo2.svg" alt="">
					<div>
						<form action="" method="post" id="form">
							<article>
								<h1>Welcome Back !</h1>
								<p>Lorem, ipsum dolor</p>
							</article>

							<div class="input-control">
								<label for="email">Email</label>
								<input required placeholder="Your emaill" type="email" name="email" id="email">
							</div>

							<div class="input-control">
								<label for="password">Password</label>
								<input required placeholder="Your password" type="password" name="password" id="password">
							</div>

							<button type="button" class="btn text-primary" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
								Forgot Password
							</button>

							<div class="input-control">
								<button type="submit" class="btn">Log in</button>
							</div>
						</form>
						<div class="input-control">
							<form method="POST" action=""><input hidden value="ADMIN@utem.edu.my" type="text" name="email"><input hidden value="abc123" type="text" name="password"><button name="submit" type="submit">System Admin</button></form>
							<form method="POST" action=""><input hidden value="MIRZA@utem.edu.my" type="text" name="email"><input hidden value="abc123" type="text" name="password"><button name="submit" type="submit">Contractor</button></form>

							<form method="POST" action=""><input hidden value="D032410018@student.utem.edu.my" type="text" name="email"><input hidden value="abc123" type="text" name="password"><button name="submit" type="submit">User AIMAN </button></form>
							<form method="POST" action=""><input hidden value="D032410021@student.utem.edu.my" type="text" name="email"><input hidden value="abc123" type="text" name="password"><button name="submit" type="submit">User ALYA </button></form>
							<form method="POST" action=""><input hidden value="D032410297@student.utem.edu.my" type="text" name="email"><input hidden value="abc123" type="text" name="password"><button name="submit" type="submit">User FARHAN </button></form>
						</div>
					</div>

				</section>

				<section class="left ">

					<div class="phone">
						<article>
							<h1>Dorm Facility Care!</h1>
						</article>
						<img class="img1" src="./images/Jla3P43tx11.png" alt="">
						<img class="img2" src="./images/mdm4r8ExUV8.png" alt="">
					</div>

				</section>
			</div>

		</main>
		<!-- CONTENT HERE -->

	</section>



	<aside class="_sidebar-_mobile _sidebar _mobile">


		<!-- CONTENT HERE -->
		<main class="_content-area">

			<div class="index-container">
				<section class="right">
					<div>
						<form action="" method="post">
							<article>
								<h1>Welcome Back !</h1>
								<p>Lorem, ipsum dolor</p>
							</article>

							<div class="input-control">
								<label for="email">Email</label>
								<input required placeholder="Your emaill" type="email" name="email" id="email">
							</div>

							<div class="input-control">
								<label for="password">Password</label>
								<input required placeholder="Your password" type="password" name="password" id="password">
							</div>

							<button type="button" class="btn text-primary" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
								Forgot Password
							</button>

							<div class="input-control">
								<button type="submit" class="btn">Log in</button>
							</div>
						</form>
					</div>

				</section>
			</div>

		</main>
		<!-- CONTENT HERE -->

	</aside>

	<div class="modal fade" id="forgotPasswordModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Forgot Password</h1>
				</div>
				<div class="modal-body">
					<div class="input-control">
						<label for="email">Email</label>
						<input type="email" name="email" id="email">
					</div>
					<div class="input-control">
						<label for="phone">Phone Number</label>
						<input type="tel" name="phone" id="phone">
					</div>
				</div>
				<div class="modal-footer">
					<button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		let loading = `<div class="_loading-container"><img width="200" src="./images/Loading_icon.gif" alt=""></div>`;
		$("body").prepend(loading);

		let delay = time => new Promise(resolve => setTimeout(resolve, time));

		$(document).ready(async () => {
			await delay(1000);
			$("._loading-container").remove();
		})

		document.querySelectorAll("form").forEach(form => {
			form.addEventListener("submit", e => {
				let inputs = form.querySelectorAll("input");

				for (let input of inputs) {
					if (input.value.trim() === "") {
						e.preventDefault();
						input.focus();
						return;
					}
				}
			});
		});
	</script>
</body>

</html>