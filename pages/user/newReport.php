<?php
session_start();
require_once "./inc/init.php";
auth("STD");

//php code hrre

//php code hrre

?>
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

	<link rel="stylesheet" href="../../style/pages/user/newReport.css">
</head>

<body>

	<section class="_workspace">
		<?php $title = "New Report" ?>
		<?php include(__DIR__ . "../../../components/user/header.php") ?>

		<main class="_content-area">

			<article>
				<h3>Details</h3>
				<p class="required">All fields must be filled.</p>
			</article>
			<form action="" method="post">

				<section class="form-detail">

					<div class="input-control">
						<label for="categories" class="required">Categories</label>
						<select name="categories" id="categories">
							<option selected disabled value="">Select Categories</option>
							<option value="category_1">Category 1</option>
							<option value="category_2">Category 2</option>
						</select>
					</div>

					<div class="input-control">
						<label for="description" class="required">Description</label>
						<textarea rows="10" name="description" id="description" rows="10"></textarea>
					</div>

					<div class="input-control col-3">
						<article>
							<label for="location" class="required">Location</label>
							<select required name="location" id="location">
								<option selected disabled hidden value="">Select Location</option>
								<option value="Satria">Satria</option>
								<option value="Al_Jazari">Al Jazari</option>
								<option value="Lestari">Lestari</option>
							</select>
						</article>

						<article>
							<label for="block" class="required">Block</label>
							<select disabled required name="block" id="block">
								<option selected disabled value="">Select Block</option>

							</select>
						</article>

						<article>
							<label for="level" class="required">Level</label>
							<select disabled name="level" id="level">
								<option selected disabled value="">Select Level</option>

							</select>
						</article>
					</div>

					<div class="input-control">
						<label for="room_no" class="required">Room no.</label>
						<p class="text-danger hidden" style="margin-bottom: 0;">Errors</p>
						<input disabled type="text" name="room_no" id="room_no" placeholder="A-1-2-B(2)">
						<p class="hint">e.g: A-1-2-B(2)</p>
					</div>
				</section>

				<!-- problem (duplicate form-photo) -->
				<!-- <section class="form-photo">

					<div class="input-control">
						<label for="image" class="required">Upload Image</label>
						<input hidden type="file" accept="image/*" name="image" id="image">
						<label for="image" class="image-area">
							<button type="button" class="btn btn-close hidden"></button>

							<article>
								<label for="location" class="required">Location</label>
								<select name="location" id="location">
									<option selected disabled value="">Select Location</option>
									<option value="location_1">Location 1</option>
									<option value="location_2">Location 2</option>
								</select>
							</article>
	
							<article>
								<label for="block" class="required">Block</label>
								<select name="block" id="block">
									<option selected disabled value="">Select Block</option>
									<option value="block_1">Block 1</option>
									<option value="block_2">Block 2</option>
								</select>
							</article>
	
							<article>
								<label for="level" class="required">Level</label>
								<select name="level" id="level">
									<option selected disabled value="">Select Level</option>
									<option value="level_1">Level 1</option>
									<option value="level_2">Level 2</option>
								</select>
							</article>
						</div>
	
						<div class="input-control">
							<label for="room_no" class="required">Room no.</label>
							<p class="text-danger hidden" style="margin-bottom: 0;">Errors</p>
							<input type="text" name="room_no" id="room_no" placeholder="A-1-2-B(2)">
							<p class="hint">e.g: A-1-2-B(2)</p>
						</div>
					</section> -->

				<section class="form-photo">

					<div class="input-control">
						<label for="image" class="required">Upload Image</label>
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
						<button type="reset" class="btn btn-dark clear">Clear</button>
						<button type="submit" class="btn btn-primary submit">Submit</button>
					</div>

				</section>

			</form>

		</main>
	</section>

	<script>
		let blokStaria = `
			<option selected disabled hidden value="">Select Block</option>
			<option value="Satria_Jebat">Satria Jebat</option>
			<option value="Satria_Tuah">Satria Tuah</option>
			<option value="Satria_Lekir">Satria Lekir</option>
			<option value="Satria_Lekiu">Satria Lekiu</option>
			<option value="Satria_Kasturi">Satria Kasturi</option>
		`
		let levelStaria = `
			<option selected disabled hidden value="">Select Level</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
		`
		let blokAj = `
			<option selected disabled hidden value="">Select Block</option>
			<option value="Al_Jazari_A">Blok A</option>
			<option value="Al_Jazari_B">Blok B</option>
			<option value="Al_Jazari_C">Blok C</option>
		`
		let levelAj = `
			<option selected disabled hidden value="">Select Level</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		`
		// WARN: assuming all blocks of a college have the same levels
		// unconfirmed for Lestari
		let blokLestari = `
			<option selected disabled hidden value="">Select Block</option>
			<option value="Lestari_A">Lelaki A</option>
			<option value="Lestari_B">Perempuan B</option>
		`
		let levelLestari = `
			<option selected disabled hidden value="">Select Level</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
		`
		let hasSelectBlock = false,
			hasSelectLevel = false

		let inputImg = document.getElementById("image");
		let imageArea = document.querySelector(".image-area");
		let btnClose = document.querySelector(".btn-close");
		let nameFile = document.querySelector(".name-file");
		let imageAreaIcon = document.querySelector(".image-area i");
		let textDrop = document.querySelector(".text-drop")

		let inpCategories = document.querySelector("#categories")
		let inpDescription = document.querySelector("#description")
		let inpLocation = document.querySelector("#location")
		let inpBlock = document.querySelector("#block")
		let inpLevel = document.querySelector("#level")
		let inpRoomNo = document.querySelector("#room_no")
		let inpImage = document.querySelector("#image")

		let currentUrl = null;

		let btnClear = document.querySelector(".clear")

		btnClear.addEventListener("click", () => removePhoto())

		inpLocation.addEventListener("change", e => {
			let kolej = e.target.value
			console.log("Location selected: " + kolej);

			if (kolej == "") return

			inpLevel.setAttribute("disabled", "true")
			inpLevel.innerHTML = `
				<option selected disabled value="">Select Level</option>
			`

			inpBlock.removeAttribute("disabled")
			inpBlock.innerHTML = ""
			if (kolej == "Satria") {
				inpBlock.innerHTML = blokStaria

			} else if (kolej == "Al_Jazari") {
				inpBlock.innerHTML = blokAj

			} else if (kolej == "Lestari") {
				inpBlock.innerHTML = blokLestari
			}

		})

		inpBlock.addEventListener("change", e => {
			let blok = e.target.value
			let kolej = inpLocation.value
			console.log("Block selected: " + kolej + " " + blok);


			// WARN: assuming all blocks of a college have the same levels
			// unconfirmed for Lestari
			inpLevel.removeAttribute("disabled")
			inpLevel.innerHTML = ""
			if (kolej == "Satria") {
				inpLevel.innerHTML = levelStaria

			} else if (kolej == "Al_Jazari") {
				inpLevel.innerHTML = levelAj

			} else if (kolej == "Lestari") {
				inpLevel.innerHTML = levelLestari
			}

		})

		let form = document.querySelector("form")
		form.addEventListener("submit", e => {
			e.preventDefault();

			const inputs = [
				inpCategories,
				inpDescription,
				inpLocation,
				inpBlock,
				inpLevel,
				inpRoomNo,
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
	<input type="text" name="role" id="role" hidden value="USER">
	<input type="text" name="title" id="title" hidden value="New Report">
</body>

</html>