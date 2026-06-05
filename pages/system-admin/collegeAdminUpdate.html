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
	<link rel="stylesheet" href="../../style/pages/system-admin/collegeAdminUpdate.css">
</head>

<body>

	<section class="_workspace">

		<!-- CONTENT HERE -->
		<main class="_content-area">

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
				</section>

				<section class="form-photo">

					<div class="input-control">
						<label for="image" class="required">Edit Photo Profile</label>
						<input hidden type="file" accept="image/*" name="image" id="image">
						<label for="image" class="image-area">
							<button type="button" class="btn btn-close hidden"></button>

							<article>
								<i class="fa-solid fa-file-arrow-up"></i>
								<h5 class="text-drop">Click or Drop Image Here!</h5>
							</article>

						</label>
						<p class="hidden name-file">asd.png</p>
					</div>

					<div class="btn-group">
						<button type="reset" class="btn btn-dark">Clear</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>

				</section>

			</form>

		</main>
		<!-- CONTENT HERE -->

	</section>

	<!-- your script -->
	<script>
		let inputImg = document.getElementById("image");
		let imageArea = document.querySelector(".image-area");
		let btnClose = document.querySelector(".btn-close");
		let nameFile = document.querySelector(".name-file");
		let imageAreaIcon = document.querySelector(".image-area i");
		let textDrop = document.querySelector(".text-drop")

		let inpName = document.querySelector("#name")
		let inpPassword = document.querySelector("#password")
		let inpCPassword = document.querySelector("#cPassword")
		let inpLocation = document.querySelector("#location")
		let inpCollege = document.querySelector("#college")
		let inpPhoneNumber = document.querySelector("#phoneNumber")
		let inpEmail = document.querySelector("#email")
		let inpImage = document.querySelector("#image")//

		let currentUrl = null;


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
		function addPhoto(file) {
			if (!file) return;

			if (currentUrl) {
				URL.revokeObjectURL(currentUrl);
			}

			currentUrl = URL.createObjectURL(file);

			imageArea.style.backgroundImage = `url(${currentUrl})`;
			imageArea.style.backgroundSize = "cover";
			imageArea.style.backgroundPosition = "center";

			nameFile.textContent = file.name;
			textDrop.classList.add("hidden");
			imageAreaIcon.classList.add("hidden");
			nameFile.classList.remove("hidden");
			btnClose.classList.remove("hidden");
		}

		function removePhoto() {
			if (currentUrl) {
				URL.revokeObjectURL(currentUrl);
				currentUrl = null;
			}

			imageArea.style.backgroundImage = "";

			textDrop.classList.remove("hidden");
			imageAreaIcon.classList.remove("hidden");
			nameFile.classList.add("hidden");
			btnClose.classList.add("hidden");

			nameFile.textContent = "";

			inputImg.value = "";
		}

		inputImg.addEventListener("change", e => {
			const file = e.target.files[0];

			if (!file) return;

			addPhoto(file);
		});

		btnClose.addEventListener("click", e => {
			e.preventDefault();
			e.stopPropagation();

			removePhoto();
		});

		["dragenter", "dragover"].forEach(event => {
			imageArea.addEventListener(event, e => {
				e.preventDefault();

				imageArea.classList.add("hover");
				imageAreaIcon.classList.add("icon-hover");
			});
		});

		["dragleave"].forEach(event => {
			imageArea.addEventListener(event, e => {
				e.preventDefault();

				imageArea.classList.remove("hover");
				imageAreaIcon.classList.remove("icon-hover");
			});
		});

		imageArea.addEventListener("drop", e => {
			e.preventDefault();

			imageArea.classList.remove("hover");
			imageAreaIcon.classList.remove("icon-hover");

			let file = e.dataTransfer.files[0];

			if (!file) return;

			if (!file.type.startsWith("image/")) {
				alert("Please upload image files only.");
				return;
			}

			let dt = new DataTransfer();
			dt.items.add(file);
			inputImg.files = dt.files;

			addPhoto(file);
		});
	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="SAD">
	<input type="text" name="title" id="title" hidden value="Update College Admin">
</body>

</html>