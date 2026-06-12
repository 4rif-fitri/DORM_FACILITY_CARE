<?php
session_start();
require_once "./inc/init.php";

//php code hrre

//php code hrre

auth("STD");

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
		$_SESSION["id"] = $user["id"];

		header("Location: ./pages/user/dashboard.php");
		exit;
	} else {
		echo "
			<script>alert('Invalid Credential')</script>
		";
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" href="../../images/image.png" type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	<link rel="stylesheet" href="../lib/bootstrap.css">
	<script src="../lib/bootstrap.js">
		< /> <
		script src = "../lib/jquery.js" >
	</script>
	<meta charset="UTF-8">
	<title>Dorm Facility Care</title>
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
						<form action="" method="post">
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
							<div class="input-control">
								<a href="./pages/user/dashboard.php">user</a>
								<a href="./pages/system-admin/dashboard.php">system admin</a>
								<a href="./pages/contractor/dashboard.php">contractor</a>
								<a href="./pages/college-admin/dashboard.php">college admin</a>
							</div>
						</form>
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
							<div class="input-control">
								<a href="./pages/user/dashboard.php">user</a>
								<a href="./pages/system-admin/dashboard.php">system admin</a>
								<a href="./pages/contractor/dashboard.php">contractor</a>
								<a href="./pages/college-admin/dashboard.php">college admin</a>
							</div>
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


		document.addEventListener("submit", e => {
			let from = e.target

			let inputs = from.querySelectorAll("input")

			for (let input of inputs) {
				if (input.value.trim() == "") {
					e.preventDefault();
					input.focus()
					return
				}
			}



		})
	</script>
</body>

</html>