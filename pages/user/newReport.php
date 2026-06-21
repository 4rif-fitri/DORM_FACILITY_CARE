<?php
require_once __DIR__ . "../../../inc/init.php";
auth("STD", $_SESSION["type"]);

//php code hrre
$id = $_SESSION["userID"];
$sql =   "SELECT * FROM user INNER JOIN student
			ON user.userID = student.userID
			WHERE user.userID  = '$id'
			";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if (!$row) {
	die("No data found for this user");
}



//php code hrre

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- your styling -->
	<link rel="stylesheet" href="../../style/pages/user/newReport.css">
</head>

<body>



	<section class="_workspace">
		<?php $title = "New Report" ?>
		<?php include(__DIR__ . "../../../components/user/header.php") ?>

		<main class="_content-area">
			<div>
				<article>
					<h3>Details</h3>
					<p class="required">All fields must be filled.</p>
				</article>
				<form action="" method="post">

					<section class="form-detail">

						<div class="input-control">
							<label for="categories" class="required">Categories</label>
							<select name="categories" id="categories">
								<option disabled selected value="">Select Categories</option>
								<option value="Plumbing">Plumbing</option>
								<option value="Electrical">Electrical</option>
								<option value="Furniture">Cleaning</option>
								<option value="Internet">Facilities</option>
								<option value="Others">Security</option>
								<option value="Others">Others</option>
							</select>
						</div>

						<div class="input-control">
							<label for="description" class="required">Description</label>
							<textarea rows="10" name="description" id="description" rows="10"></textarea>
						</div>
						<div class="input-control col-3">
							<article>
								<label for="location" class="required">Location</label>
								<select disabled required name="location" id="location">
									<option value="Satria" <?= (trim($row["studentCollege"]) == "Satria") ? "selected" : "" ?>>Satria</option>

									<option value="Al_Jazari" <?= (trim($row["studentCollege"]) == "Al_Jazari") ? "selected" : "" ?>>Al Jazari</option>

									<option value="Lestari" <?= (trim($row["studentCollege"]) == "Lestari") ? "selected" : "" ?>>Lestari</option>
								</select>
							</article>

							<article>
								<label for="block" class="required">Block</label>
								<select required name="block" id="block">

								</select>
							</article>

							<article>
								<label for="level" class="required">Level</label>
								<select name="level" id="level">

								</select>
							</article>

							<article>
								<label for="rumah" class="required">No Rumah</label>
								<select name="rumah" id="rumah">

								</select>
							</article>

							<article>
								<label for="bilik" class="required">Bilik</label>
								<select name="bilik" id="bilik">

								</select>
							</article>

							<article>
								<label for="katil" class="required">Katil</label>
								<select name="katil" id="katil">

								</select>
							</article>



						</div>

						<div class="input-control">
							<p for="room_no">Full Alamat</p>
							<input disabled type="text" name="room_no" id="room_no">
						</div>
						<button type="button" id="reset-alamat" class="btn btn-secondary w-25">Reset Alamat</button>
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

						<div>
							<button type="reset" class="btn-reset clear">Reset</button>
							<button type="submit" class="btn-submit submit">Submit</button>
						</div>
					</section>

				</form>
			</div>
		</main>
	</section>
	<div class="popUpFail hidden">
		<div class="card p-3">
			<h1 class="text-center">🚫</h1>
			<h2>Fail to Add Report</h2>
			<a href="" class="btn btn-success">Ok</a>
		</div>
	</div>
	<div class="popUpDone hidden">
		<div class="card p-3">
			<!-- <img id="asd" src="" alt=""> -->
			<h1 class="text-center">✅</h1>
			<h2>Done Add Report</h2>
			<a href="./myReport.php" class="btn btn-success">Ok</a>
		</div>
	</div>
	<!-- <div class="popUpLoading hidden">
		<div class="card p-3">
			<h1 class="text-center">🔃</h1>
			<h2>Wait...</h2>
		</div>
	</div> -->
	<div class="popUpLoading hidden">
		<div class="loading-container">
			<div class="loading-circle"></div>
			<div class="loading-circle"></div>
			<div class="loading-circle"></div>
			<div class="loading-circle"></div>
		</div>
		<div class="bulat">
			<article>
				<h1 class="text-center">✅</h1>
				<h2>Done Add Report</h2>
				<a href="./myReport.php" class="btn btn-success w-100">Ok</a>
			</article>
		</div>
	</div>
	<script>
		let showLogin = () => {
			document.querySelector(".popUpLoading").classList.remove("hidden")
		}
		// <-------- Satria ------------->
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
		let rumahStaria = `
			<option selected disabled hidden value="">Select Rumah</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		`
		// <-------- AJ ------------->
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
		let rumahAj = `
			<option selected disabled hidden value="">Select Rumah</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
		`
		// WARN: assuming all blocks of a college have the same levels
		// unconfirmed for Lestari

		// <-------- Lestari ------------->
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
		let rumahLestari = `
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
		let inpRoomNo = document.querySelector("#rumah")

		let inpBilik = document.querySelector("#bilik")
		let inpKatil = document.querySelector("#katil")
		let inpImage = document.querySelector("#image")

		let room_no = document.getElementById("room_no")

		let currentUrl = null;
		let imgURL
		let btnClear = document.querySelector(".clear")

		btnClear.addEventListener("click", () => removePhoto())

		let getFullAddredd = () => {
			let kolej = "<?= $row["studentCollege"] ?>"

			if (kolej == "Al_Jazari") {
				let inpBlock = document.querySelector("#block").value
				let inpLevel = document.querySelector("#level").value
				let inpRoomNo = document.querySelector("#rumah").value
				let inpBilik = document.querySelector("#bilik").value
				let inpKatil = document.querySelector("#katil").value
				room_no.value = `AJ-${inpBlock}-${inpLevel}-${inpRoomNo}-${inpBilik}(${inpKatil})`
			} else if (kolej == "Lestari") {
				let inpBlock = document.querySelector("#block").value
				let inpLevel = document.querySelector("#level").value
				let inpRoomNo = document.querySelector("#rumah").value
				let inpBilik = document.querySelector("#bilik").value
				let inpKatil = document.querySelector("#katil").value
				room_no.value = `LS-${inpBlock}-${inpRoomNo}-${inpLevel}-${inpBilik}(${inpKatil})`
			} else if (kolej == "Satria") {
				let inpBlock = document.querySelector("#block").value
				let inpLevel = document.querySelector("#level").value
				let inpRoomNo = document.querySelector("#rumah").value
				let inpBilik = document.querySelector("#bilik").value
				let inpKatil = document.querySelector("#katil").value
				room_no.value = `${inpBlock}-${inpLevel}-${inpRoomNo}-${inpBilik}(${inpKatil})`
			}


		}

		let run = () => {
			let kolej = "<?= $row["studentCollege"] ?>"
			let alamat = "<?= $row["studentRoom"] ?>"
			// console.log("Full Address:" + alamat);

			let blok, floor, rumah, BILIK, bilik, katil
			alamat = alamat.split("-")

			if (kolej == "Al_Jazari") {
				blok = alamat[0]
				floor = alamat[1]
				rumah = alamat[2]
				BILIK = alamat[3]
				bilik = BILIK.split("(")[0]
				katil = BILIK.split("(")[1].replaceAll(")", "")

			} else if (kolej == "Lestari") {
				blok = alamat[0]
				rumah = alamat[1]
				floor = alamat[2]
				BILIK = alamat[3]
				bilik = BILIK.split("(")[0]
				katil = BILIK.split("(")[1].replaceAll(")", "")

			} else if (kolej == "Satria") {
				blok = alamat[1]
				floor = alamat[2]
				rumah = alamat[3]
				BILIK = alamat[4]
				bilik = BILIK.split("(")[0]
				katil = BILIK.split("(")[1].replace(")", "")
			}

			console.log({
				alamat,
				blok,
				floor,
				rumah,
				bilik,
				katil
			});

			let optBlock, optLevel, optNo_Rumah, optBilik, optKatil

			if (kolej == "Al_Jazari") {

				optBlock = `
						<option ${blok == "A" ? "selected" : ""} value="A">Blok A</option>
						<option ${blok == "B" ? "selected" : ""} value="B">Blok B</option>
						<option ${blok == "C" ? "selected" : ""} value="C">Blok C</option>
						`
				optLevel = `
						<option ${floor == "1" ? "selected" : ""} value="1">1</option>
						<option ${floor == "2" ? "selected" : ""} value="2">2</option>
						<option ${floor == "3" ? "selected" : ""} value="3">3</option>
						<option ${floor == "4" ? "selected" : ""} value="4">4</option>
						<option ${floor == "5" ? "selected" : ""} value="5">5</option>
					`
				optNo_Rumah = `
						<option ${rumah == "1" ? "selected" : ""} value="1">1</option>
						<option ${rumah == "2" ? "selected" : ""} value="2">2</option>
						<option ${rumah == "3" ? "selected" : ""} value="3">3</option>
						<option ${rumah == "4" ? "selected" : ""} value="4">4</option>
						<option ${rumah == "5" ? "selected" : ""} value="5">5</option>
						<option ${rumah == "6" ? "selected" : ""} value="6">6</option>
					`
				optBilik = `
						<option ${bilik == "A" ? "selected" : ""} value="A">A</option>
						<option ${bilik == "B" ? "selected" : ""} value="B">B</option>
						<option ${bilik == "C" ? "selected" : ""} value="C">C</option>
						<option ${bilik == "D" ? "selected" : ""} value="D">D</option>
						<option ${bilik == "E" ? "selected" : ""} value="E">E</option>
				`
				optKatil = `
						<option ${katil == "1" ? "selected" : ""} value="1">1</option>
						<option ${katil == "2" ? "selected" : ""} value="2">2</option>
						<option ${katil == "3" ? "selected" : ""} value="3">3</option>
				`

			} else if (kolej == "Satria") {
				optBlock = `
					<option ${blok == "J" ? "selected" : ""} value="SJ-J">Satria Jebat</option>
					<option ${blok == "T" ? "selected" : ""} value="ST-T">Satria Tuah</option>
					<option ${blok == "L" ? "selected" : ""} value="SL-L">Satria Lekir</option>
					<option ${blok == "E" ? "selected" : ""} value="SE-E">Satria Lekiu</option>
					<option ${blok == "K" ? "selected" : ""} value="SK-K">Satria Kasturi</option>
					`
				optLevel = `
					<option  ${floor == "1" ? "selected" : ""} value="1">1</option>
					<option  ${floor == "2" ? "selected" : ""} value="2">2</option>
					<option  ${floor == "3" ? "selected" : ""} value="3">3</option>
					<option  ${floor == "4" ? "selected" : ""} value="4">4</option>
					<option  ${floor == "5" ? "selected" : ""} value="5">5</option>
					<option  ${floor == "6" ? "selected" : ""} value="6">6</option>
					<option  ${floor == "7" ? "selected" : ""} value="7">7</option>
					<option  ${floor == "8" ? "selected" : ""} value="8">8</option>
					<option  ${floor == "9" ? "selected" : ""} value="9">9</option>
					`
				optNo_Rumah = `
					<option  ${rumah == "1" ? "selected" : ""} value="1">1</option>
					<option  ${rumah == "2" ? "selected" : ""} value="2">2</option>
					<option  ${rumah == "3" ? "selected" : ""} value="3">3</option>
					<option  ${rumah == "4" ? "selected" : ""} value="4">4</option>
					<option  ${rumah == "5" ? "selected" : ""} value="5">5</option>
					<option  ${rumah == "6" ? "selected" : ""} value="6">6</option>
					<option  ${rumah == "7" ? "selected" : ""} value="7">7</option>
					<option  ${rumah == "8" ? "selected" : ""} value="8">8</option>
					<option  ${rumah == "9" ? "selected" : ""} value="9">9</option>
					<option  ${rumah == "10" ? "selected" : ""} value="10">10</option>
					<option  ${rumah == "11" ? "selected" : ""} value="11">11</option>
					<option  ${rumah == "12" ? "selected" : ""} value="12">12</option>
					`
				optBilik = `
					<option  ${bilik == "A" ? "selected" : ""} value="A">A</option>
					<option  ${bilik == "B" ? "selected" : ""} value="B">B</option>
					<option  ${bilik == "C" ? "selected" : ""} value="C">C</option>
					<option  ${bilik == "D" ? "selected" : ""} value="D">D</option>
					<option  ${bilik == "E" ? "selected" : ""} value="E">E</option>
				`
				optKatil = `
					<option  ${katil == "1" ? "selected" : ""} value="1">1</option>
					<option  ${katil == "2" ? "selected" : ""} value="2">2</option>
				`
			} else if (kolej == "Lestari") {
				optBlock = `
					<option  ${blok == "B1" ? "selected" : ""} value="B1">B1</option>
					<option  ${blok == "B2" ? "selected" : ""} value="B2">B2</option>
				`
				optNo_Rumah = `
					<option  ${rumah == "A" ? "selected" : ""} value="A">A</option>
					<option  ${rumah == "B" ? "selected" : ""} value="B">B</option>
					<option  ${rumah == "C" ? "selected" : ""} value="C">C</option>
					<option  ${rumah == "D" ? "selected" : ""} value="D">D</option>
					<option  ${rumah == "E" ? "selected" : ""} value="E">E</option>
				`
				optLevel = `
					<option  ${floor == "G" ? "selected" : ""} value="G">G</option>
					<option  ${floor == "1" ? "selected" : ""} value="1">1</option>
					<option  ${floor == "2" ? "selected" : ""} value="2">2</option>
					<option  ${floor == "3" ? "selected" : ""} value="3">3</option>
				`
				optBilik = `
					<option  ${bilik == "01" ? "selected" : ""} value="01">01</option>
					<option  ${bilik == "02" ? "selected" : ""} value="02">02</option>
					<option  ${bilik == "03" ? "selected" : ""} value="03">03</option>
					<option  ${floor == "04" ? "selected" : ""} value="04">04</option>
					<option  ${floor == "05" ? "selected" : ""} value="05">05</option>
					<option  ${bilik == "06" ? "selected" : ""} value="06">06</option>
					<option  ${bilik == "07" ? "selected" : ""} value="07">07</option>
				`
				optKatil = `
					<option  ${katil == "1" ? "selected" : ""} value="1">1</option>
					<option  ${katil == "2" ? "selected" : ""} value="2">2</option>
				`
			}

			inpBlock.innerHTML = optBlock
			inpLevel.innerHTML = optLevel
			inpRoomNo.innerHTML = optNo_Rumah
			inpBilik.innerHTML = optBilik
			inpKatil.innerHTML = optKatil
			getFullAddredd()
		}
		run()

		// inpLocation.addEventListener("change", e => {
		// 	let kolej = e.target.value
		// 	console.log("Location selected: " + kolej);

		// 	if (kolej == "") return

		// 	inpLevel.setAttribute("disabled", "true")
		// 	inpLevel.innerHTML = `
		// 		<option selected disabled value="">Select Level</option>
		// 	`

		// 	inpBlock.removeAttribute("disabled")
		// 	inpBlock.innerHTML = ""
		// 	if (kolej == "Satria") {
		// 		inpBlock.innerHTML = blokStaria

		// 	} else if (kolej == "Al_Jazari") {
		// 		inpBlock.innerHTML = blokAj

		// 	} else if (kolej == "Lestari") {
		// 		inpBlock.innerHTML = blokLestari
		// 	}

		// })

		// inpBlock.addEventListener("change", e => {
		// 	let blok = e.target.value
		// 	let kolej = inpLocation.value
		// 	console.log("Block selected: " + kolej + " " + blok);


		// 	// WARN: assuming all blocks of a college have the same levels
		// 	// unconfirmed for Lestari
		// 	inpLevel.removeAttribute("disabled")
		// 	inpLevel.innerHTML = ""
		// 	if (kolej == "Satria") {
		// 		inpLevel.innerHTML = levelStaria

		// 	} else if (kolej == "Al_Jazari") {
		// 		inpLevel.innerHTML = levelAj

		// 	} else if (kolej == "Lestari") {
		// 		inpLevel.innerHTML = levelLestari
		// 	}

		// })

		let delay = time => new Promise(resolve => setTimeout(resolve, time))

		let form = document.querySelector("form")
		form.addEventListener("submit", async e => {
			e.preventDefault();

			const inputs = [
				inpCategories,
				inpDescription,
				inpLocation,
				inpBlock,
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
				console.log("All NOT Clear");
			} else {

				let getCollage = (c) => {
					if (c == "ST-T") return "Satria_Tuah"
					else if (c == "SJ-J") return "Satria_jebat"
					else if (c == "SL-L") return "Satria_Lekir"
					else if (c == "SE-E") return "Satria_Lekiu"
					else if (c == "SK-K") return "Satria_Kasturi"

					else if (c == "B2" || c == "B1") return "Lestari"
					else if (c == "Al_Jazari") return "Al_Jazari"
				}

				let collage
				if (inpLocation.value == "Satria") {
					collage = getCollage(inpBlock.value)
				} else if (inpLocation.value == "Al_Jazari") {
					collage = getCollage(inpLocation.value)
				} else if (inpLocation.value == "Lestari") {
					collage = getCollage(inpBlock.value)
				}

				showLogin()

				// document.querySelector(".popUpLoading").classList.remove("hidden");
				await delay(2000)
				$.ajax({
					url: "../../api/submitReport.php",
					method: "POST",
					data: {
						category: inpCategories.value,
						description: inpDescription.value,
						url: imgURL,
						location: collage,
						room_no: room_no.value
					},
					success: response => {
						console.log(response)
						// document.getElementById("asd").src = response[0][7]
						// document.querySelector(".popUpLoading").classList.add("hidden");
						// document.querySelector(".popUpDone").classList.remove("hidden");
						document.querySelector(".popUpLoading .bulat").style.animation = "fadeIN 0.2s forwards"
						document.querySelector(".popUpLoading .bulat > *").style.animation = "show 0.3s forwards"
					},
					error: response => {
						console.log(response.responseText);
						document.querySelector(".popUpLoading").classList.add("hidden");
						document.querySelector(".popUpFail").classList.remove("hidden");
					},
					complete: () => {}
				})

			}

		});

		inpBlock.addEventListener("change", e => {
			getFullAddredd()
		})
		inpLevel.addEventListener("change", e => {
			getFullAddredd()
		})
		inpRoomNo.addEventListener("change", e => {
			getFullAddredd()
		})
		inpBilik.addEventListener("change", e => {
			getFullAddredd()
		})
		inpKatil.addEventListener("change", e => {
			getFullAddredd()
		})
		document.getElementById("reset-alamat").addEventListener("click", e => {
			run()
		})

		// handle image 

		function addPhoto(file) {
			if (!file) return;

			if (currentUrl) {
				URL.revokeObjectURL(currentUrl);
			}

			currentUrl = URL.createObjectURL(file);
			let img = new Image()
			img.src = currentUrl
			img.onload = e => {
				let width = e.target.width
				let height = e.target.height

				let ratio = Math.min(600 / width, 600 / height)

				if (ratio < 1) {
					width *= ratio
					height *= ratio
				}

				let canvas = document.createElement("canvas")
				let ctx = canvas.getContext("2d")

				canvas.width = width
				canvas.height = height

				ctx.drawImage(img, 0, 0, width, height)

				imgURL = canvas.toDataURL()

			}

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