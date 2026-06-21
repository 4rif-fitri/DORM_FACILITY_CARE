<?php
require_once __DIR__ . "../../../inc/init.php";
auth("SAD");

//php code hrre

//php code hrre

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- your styling -->
	<link rel="stylesheet" href="../../style/pages/system-admin/collegeAdminUpdate.css">
	<style>
		._content-area>section {
			width: 100%;
			background-color: #fff;
			padding: 1rem;
			border: 14px;
			margin: 0 auto;
		}

		form {
			grid-template-columns: repeat(1, 1fr);
		}

		@media screen and (min-width:1000px) {
			._content-area>section {
				width: 1000px;
			}

		}
	</style>
</head>

<body>

	<section class="_workspace">
		<?php $title = "Update Student" ?>
		<?php include(__DIR__ . "../../../components/system-admin/header.php") ?>

		<!-- CONTENT HERE -->
		<main class="_content-area">

			<section>
				<article>
					<h3>ID: 001</h3>
					<p class="required">All fields must be filled.</p>
				</article>
				<form action="" method="post">

					<section class="form-detail">

						<div class="input-control">
							<label for="name" class="required">Name</label>
							<input type="text" name="name" id="name">
						</div>

						<div class="input-control">
							<label for="name" class="required">Password</label>
							<input type="password" name="password" id="password">
						</div>

						<div class="input-control">
							<label for="cPassword" class="required">Confirm Password</label>
							<input type="password" name="cPassword" id="cPassword">
						</div>

						<div class="input-control">
							<label for="college" class="required">College</label>
							<select name="college" id="college">
								<option selected disabled value="">Select Location</option>
								<option value="location_1">Location 1</option>
								<option value="location_2">Location 2</option>
							</select>
						</div>

						<div class="input-control">
							<label for="phoneNumber" class="required">Phone Number</label>
							<input type="number" name="phoneNumber" id="phoneNumber">
						</div>

						<div class="input-control">
							<label for="email" class="required">Email</label>
							<input type="email" name="email" id="email">
						</div>

						<div class="input-control">
							<button class="btn btn-danger">Reset</button>
							<button class="btn btn-primary">Update</button>
						</div>
					</section>



				</form>

			</section>

		</main>
		<!-- CONTENT HERE -->

	</section>

	<!-- your script -->
	<script>
		let inpName = document.querySelector("#name")
		let inpPassword = document.querySelector("#password")
		let inpCPassword = document.querySelector("#cPassword")
		let inpLocation = document.querySelector("#location")
		let inpCollege = document.querySelector("#college")
		let inpPhoneNumber = document.querySelector("#phoneNumber")
		let inpEmail = document.querySelector("#email")
		let inpImage = document.querySelector("#image") //


		let form = document.querySelector("form")

		form.addEventListener("submit", e => {
			e.preventDefault();

			const inputs = [
				inpName,
				inpPassword,
				inpCPassword,
				inpLocation,
				inpPhoneNumber,
				inpPhoneNumber,
				inpEmail,
				inpImage
			];

			let isValid = true;

			for (const input of inputs) {

				// type file
				if (input.type === "file") {
					if (input.files.length === 0) {
						isValid = false;
						alert('Please Insert a Photo');
						break;
					}

				} else {

					if (input.value.trim() === "") {
						isValid = false;
						input.focus()
						break;
					}
				}
			}

			if (!isValid) {
				console.log("!OK");

			} else {
				console.log("OK");

			}

		});
	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="SAD">
	<input type="text" name="title" id="title" hidden value="Update College Admin">
</body>

</html>