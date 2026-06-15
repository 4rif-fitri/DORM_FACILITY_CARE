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

	$stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE email = ? AND password = ?");
	mysqli_stmt_bind_param($stmt, "ss", $email, $password);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if (mysqli_num_rows($result) > 0) {

		$user = mysqli_fetch_assoc($result);

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
	} else {
		echo "
			<script>alert('Invalid Credential')</script>
		";
	}
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
								<h1 class="bg-primary">Welcome Back !</h1>
								<p>Lorem, ipsum dolor</p>
							</article>

							<div class="input-control">
								<label for="email">Email</label>
								<input required placeholder="Your emaill" type="email" name="email" id="email">
							</div>

							<div class="input-control">
								<label for="password">Password</label>
								<input required placeholder="Your password" type="password" name="password"
									id="password">
							</div>

							<div class="input-control">
								<button type="submit" class="btn">Log in</button>
							</div>
						</form>
						<div class="input-control">
							<form method="POST" action=""><input hidden value="ADMIN@utem.edu.my" type="text" name="email"><input hidden value="admin123" type="text" name="password"><button name="submit" type="submit">System Admin</button></form>
							<form method="POST" action=""><input hidden value="MIRZA@utem.edu.my" type="text" name="email"><input hidden value="ctr125" type="text" name="password"><button name="submit" type="submit">Contractor</button></form>

							<form method="POST" action=""><input hidden value="D032410018@student.utem.edu.my" type="text" name="email"><input hidden value="std126" type="text" name="password"><button name="submit" type="submit">User AIMAN </button></form>
							<form method="POST" action=""><input hidden value="D032410021@student.utem.edu.my" type="text" name="email"><input hidden value="std127" type="text" name="password"><button name="submit" type="submit">User ALYA </button></form>
							<form method="POST" action=""><input hidden value="D032410257@student.utem.edu.my" type="text" name="email"><input hidden value="std123" type="text" name="password"><button name="submit" type="submit">User HAKIM </button></form>
							<form method="POST" action=""><input hidden value="D032410278@student.utem.edu.my" type="text" name="email"><input hidden value="std124" type="text" name="password"><button name="submit" type="submit">User ABQARI</button></form>
							<form method="POST" action=""><input hidden value="D032410297@student.utem.edu.my" type="text" name="email"><input hidden value="std125" type="text" name="password"><button name="submit" type="submit">User FARHAN </button></form>

							<form method="POST" action=""><input hidden value="TUAH@utem.edu.my" type="text" name="email"><input hidden value="staff123" type="text" name="password"><button name="submit" type="submit">Admin TUAH</button></form>
							<form method="POST" action=""><input hidden value="JEBAT@utem.edu.my" type="text" name="email"><input hidden value="staff124" type="text" name="password"><button name="submit" type="submit">Admin JEBAT</button></form>
							<form method="POST" action=""><input hidden value="JAZARI@utem.edu.my" type="text" name="email"><input hidden value="staff127" type="text" name="password"><button name="submit" type="submit">Admin AJ</button></form>
							<form method="POST" action=""><input hidden value="LESTARI@utem.edu.my" type="text" name="email"><input hidden value="staff128" type="text" name="password"><button name="submit" type="submit">Admin Lestari</button></form>
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

					<!-- <div class="headline">
						<h1 class="text">Lorem ipsum dolor</h1>
						<h1 class="text2">Lorem ipsum</h1>
					</div> -->

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

							<div class="input-control">
								<button type="submit" class="btn">Log in</button>
							</div>
							<!-- <div class="input-control">
								<a href="./pages/user/dashboard.php">user</a>
								<a href="./pages/system-admin/dashboard.php">system admin</a>
								<a href="./pages/contractor/dashboard.php">contractor</a>
								<a href="./pages/college-admin/dashboard.php">college admin</a>
							</div> -->
						</form>
					</div>

				</section>
			</div>

		</main>
		<!-- CONTENT HERE -->

	</aside>

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