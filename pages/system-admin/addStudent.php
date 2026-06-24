<?php
require_once __DIR__ . "../../../inc/init.php";
auth("SAD", $_SESSION["type"] ?? null);

//php code hrre
if (isset($_POST['submit'])) {
	try {
		$matricNo = $_POST['matrik'];
		$name = $_POST['name'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$numTel = $_POST['numTel'];
		$email = $_POST['email'];
		$college = $_POST['collage'];
		$studentRoom = $_POST['studentRoom'];

		$sqlUser = "
			INSERT INTO user
			(userID, name, password, numTel, email, type)
			VALUES
			('$matricNo', '$name', '$password', '$numTel', '$email', 'STD')
		";

		mysqli_query($conn, $sqlUser);

		$sqlStudent = "
			INSERT INTO student
			(userID, studentCollege, studentRoom)
			VALUES
			('$matricNo', '$college', '$studentRoom')
		";

		mysqli_query($conn, $sqlStudent);

		echo "<script>
			alert('Student Added Successfully');
			window.location.href='addStudent.php';
		</script>";
	} catch (mysqli_sql_exception $e) {
		$msg = ($e->getCode() == 1062) ? "Student ID already exists (duplicate matric number)" : $e->getMessage();

		echo "<script>alert('Failed: $msg');
			window.location.href='addStudent.php';
		</script>";
	}
}

if (isset($_GET['sid'])) {
	$userID = mysqli_real_escape_string($conn, $_GET['sid']);

	mysqli_query($conn, "DELETE FROM student WHERE userID = '$userID'");
	mysqli_query($conn, "DELETE FROM user WHERE userID = '$userID'");

	echo "
    <script>
        alert('Student deleted successfully');
        window.location.href='addStudent.php';
    </script>";
	exit;
}

$sql = "	SELECT * FROM user
		JOIN student ON user.userID = student.userID
		ORDER BY name ASC";

if (isset($_POST["search"])) {
	$text = trim($_POST["filter-orang"]);

	$sql = " SELECT * FROM user
        JOIN student ON user.userID = student.userID
        WHERE user.name LIKE '%$text%'
        OR user.userID LIKE '%$text%'
        ORDER BY name ASC
    ";
}


$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql);

//php code hrre

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- your styling -->
	<link rel="stylesheet" href="../../style/reportDisplay.css">
	<style>
		.col-2 {
			display: grid;
			grid-template-columns: repeat(2, 1fr);
			gap: 0.5rem;
		}
	</style>
</head>

<body>

	<section class="_workspace">
		<?php $title = "Manage Student" ?>
		<?php include(__DIR__ . "../../../components/system-admin/header.php") ?>

		<!-- CONTENT HERE -->
		<main class="_content-area">
			<nav class="filter-box">
				<form action="" method="post">
					<div class="filter-cantainer">
						<div class="input-control">
							<label for="filter-orang">Search Name/Matric Number</label>
							<input type="text" name="filter-orang" id="filter-orang">
						</div>
					</div>
					<button type="submit" name="search" class="updateBtn" id="btn-search-filter" style="width: 10rem !important;">Search</button>
				</form>
			</nav>
			<nav class="add-box">
				<button type="button" class="updateBtn" data-bs-toggle="modal" data-bs-target="#Modal">
					Add Student
				</button>
			</nav>

			<section class="table-container">
				<table class="myReportTbl trackingReportTbl">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>College</th>
							<th>Phone No</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						<?php if (mysqli_num_rows($result) > 0): ?>

							<?php while ($row = mysqli_fetch_assoc($result)) : ?>
								<tr>
									<td><?= $row['userID'] ?></td>
									<td><?= $row['name'] ?></td>
									<td><?= $row['studentCollege'] ?></td>
									<td><?= $row['numTel'] ?></td>
									<td>
										<button onclick="getdataStudent('<?= $row['userID'] ?>')" class="updateBtn" data-bs-target="#modalStudent" data-bs-toggle="modal">Update</button>
										<a href="addStudent.php?sid=<?= $row['userID'] ?>"
											class="deleteBtn"
											onclick="return confirm('Delete student <?= $row['userID'] ?>? This action cannot be undone.')">
											Delete
										</a>
									</td>
								</tr>
							<?php endwhile ?>
						<?php else: ?>
							<tr>
								<td colspan="5" style="text-align:center; padding:20px;">
									No data found
								</td>
							</tr>
						<?php endif; ?>

					</tbody>

				</table>
				<?php if (mysqli_num_rows($result2) > 0): ?>
					<?php while ($row2 = mysqli_fetch_assoc($result2)) : ?>
						<div class="reportCard">
							<div id="reportCard-info">
								<div id="reportCard-left">
									<p><strong>Id</strong></p>
									<p><strong>Name</strong></p>
									<p><strong>College</strong></p>
									<p><strong>Phone No</strong></p>
								</div>
								<div id="reportCard-right">
									<p><?= $row2['userID'] ?></p>
									<p><?= $row2['name'] ?></p>
									<p><?= $row2['studentCollege'] ?></p>
									<p><?= $row2['numTel'] ?></p>
								</div>
							</div>
							<div id="reportCard-bottom">
								<button onclick="getdataStudent('<?= $row2['userID'] ?>')" class="updateBtn" data-bs-target="#modalStudent" data-bs-toggle="modal">Update</button>
								<a href="addStudent.php?sid=<?= $row2['userID'] ?>"
									class="deleteBtn"
									onclick="return confirm('Delete student <?= $row2['userID'] ?>? This action cannot be undone.')">
									Delete
								</a>
							</div>
						</div>
					<?php endwhile ?>
				<?php else: ?>
					<div class="reportCard" style="text-align:center; padding:20px;">
						No data found
					</div>
				<?php endif; ?>
			</section>


		</main>
		<!-- CONTENT HERE -->
	</section>

	<!-- Add Student -->
	<div class="modal fade" id="Modal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form action="" method="post">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Add Student</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="input-control">
							<label for="matrik">Matrik Number</label>
							<input required type="text" name="matrik" id="matrik">
						</div>

						<div class="input-control">
							<label for="name">Name</label>
							<input required type="text" name="name" id="name">
						</div>
						<div class="input-control">
							<label for="password">Password</label>
							<input required readonly type="text" value="abc123" name="password" id="password">
						</div>
						<div class="input-control">
							<label for="numTel">numTel</label>
							<input required type="text" name="numTel" id="numTel">
						</div>
						<div class="input-control">
							<label for="email">email</label>
							<input required type="text" name="email" id="email">
						</div>

						<div class="input-control col-2">
							<div class="input-control">
								<label for="collage">Collage</label>
								<select required name="collage" id="collage">
									<option disabled selected value="">Select Collage</option>
									<option value="Satria">Satria</option>
									<option value="Al_Jazari">Al_Jazari</option>
									<option value="Lestari">Lestari</option>
								</select>
							</div>
							<article>
								<label for="block" class="required">Block</label>
								<select required id="block"></select>
							</article>

							<article>
								<label for="level" class="required">Level</label>
								<select id="level"></select>
							</article>
							<article>
								<label for="rumah" class="required">No Rumah</label>
								<select id="rumah"></select>
							</article>

							<article>
								<label for="bilik" class="required">Bilik</label>
								<select id="bilik"></select>
							</article>

							<article>
								<label for="katil" class="required">Katil</label>
								<select id="katil"></select>
							</article>
						</div>
						<div class="input-control">
							<label for="studentRoom">Student Room</label>
							<input type="text" required readonly name="studentRoom" id="studentRoom">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
						<button type="submit" name="submit" class="btn btn-primary">Add Student</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Add Student -->

	<!-- update Student -->
	<div class="modal fade" id="modalStudent">
		<form method="POST" action="" id="formUpdate">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5">
							<img src="../../images/report.svg" alt="">
							Update Student
						</h1>
					</div>
					<div class="modal-body">
						<section>
							<article>
								<h3 id="textID">ID: 001</h3>
								<p class="required">All fields must be filled.</p>
							</article>

							<section class="form-detail">
								<input type="text" hidden name="uptID" id="uptID">
								<div class="input-control">
									<label for="uptName" class="required">Name</label>
									<input require type="text" name="name" id="uptName">
								</div>

								<div class="input-control">
									<label for="uptPhoneNumber" class="required">Phone Number</label>
									<input require type="number" name="phoneNumber" id="uptPhoneNumber">
								</div>

								<div class="input-control hidden">
									<label for="uptEmail" class="required">Email</label>
									<input require type="email" name="email" id="uptEmail">
								</div>

								<div class="input-control col-2">
									<div class="input-control hidden">
										<label for="uptCollage">Collage</label>
										<select require name="collage" id="uptCollage">
											<option disabled selected value="">Select Collage</option>
											<option value="Satria">Satria</option>
											<option value="Al_Jazari">Al_Jazari</option>
											<option value="Lestari">Lestari</option>
										</select>
									</div>
									<article class="hidden">
										<label for="uptBlock" class="required">Block</label>
										<select required id="uptBlock"></select>
									</article>

									<article class="hidden">
										<label for="uptLevel" class="required">Level</label>
										<select id="uptLevel"></select>
									</article>
									<article class="hidden">
										<label for="uptRumah" class="required">No Rumah</label>
										<select id="uptRumah"></select>
									</article>

									<article class="hidden">
										<label for="uptBilik" class="required">Bilik</label>
										<select id="uptBilik"></select>
									</article>

									<article class="hidden">
										<label for="uptKatil" class="required">Katil</label>
										<select id="uptKatil"></select>
									</article>
								</div>
								<div class="input-control">
									<label for="uptStudentRoom">Student Room</label>
									<input type="text" required readonly name="uptStudentRoom" id="uptStudentRoom">
								</div>

							</section>
						</section>
					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success">Update</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="popUpFail hidden">
		<div class="card p-3">
			<h1 class="text-center">🚫</h1>
			<h2>Fail to Add Report</h2>
			<a href="./addStudent.php" class="btn btn-success">Ok</a>
		</div>
	</div>
	<div class="popUpDone hidden">
		<div class="card p-3">
			<h1 class="text-center">✅</h1>
			<h2>Done Add Report</h2>
			<a href="./addStudent.php" class="btn btn-success">Ok</a>
		</div>
	</div>
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
				<h2>Done Update Student</h2>
				<a href="./addStudent.php" class="btn btn-success w-100">Ok</a>
			</article>
		</div>
	</div>
	<!-- update Student -->

	<!-- your script -->
	<script>
		let selectCollege = document.getElementById("collage");
		let selectBlock = document.getElementById("block");
		let selectLevel = document.getElementById("level");
		let selectRumah = document.getElementById("rumah");
		let selectBilik = document.getElementById("bilik");
		let selectKatil = document.getElementById("katil");
		let studentRoom = document.getElementById("studentRoom");

		let uptName = document.getElementById("uptName")
		let uptPhoneNumber = document.getElementById("uptPhoneNumber")
		let uptEmail = document.getElementById("uptEmail")
		let uptStudentRoom = document.getElementById("uptStudentRoom")

		let uptselectCollege = document.getElementById("uptCollage");
		let uptselectBlock = document.getElementById("uptBlock");
		let uptselectLevel = document.getElementById("uptLevel");
		let uptselectRumah = document.getElementById("uptRumah");
		let uptselectBilik = document.getElementById("uptBilik");
		let uptselectKatil = document.getElementById("uptKatil");
		let uptstudentRoom = document.getElementById("uptStudentRoom");
		let uptID = document.getElementById("uptID")
		let textID = document.getElementById("textID")

		let delay = time => new Promise(resolve => setTimeout(resolve, time))

		let showLoading = () => {
			document.querySelector(".popUpLoading").classList.remove("hidden")
		}
		let HideLoading = () => {
			document.querySelector(".popUpLoading .bulat").style.animation = "fadeIN 0.2s forwards"
			document.querySelector(".popUpLoading .bulat > *").style.animation = "show 0.3s forwards"
		}
		let showError = () => {
			document.querySelector(".popUpLoading").classList.add("hidden");
			document.querySelector(".popUpFail").classList.remove("hidden");
		}

		function getModal() {
			return bootstrap.Modal.getOrCreateInstance(document.getElementById('modalStudent'));
		}

		selectCollege.addEventListener("change", e => {

			let asrama = e.target.value;

			let optBlock = "";
			let optLevel = "";
			let optNoRumah = "";
			let optBilik = "";
			let optKatil = "";

			// SATRIA
			if (asrama === "Satria") {

				optBlock = `
					<option value="SJ-J">Satria Jebat</option>
					<option value="ST-T">Satria Tuah</option>
					<option value="SL-L">Satria Lekir</option>
					<option value="SE-E">Satria Lekiu</option>
					<option value="SK-K">Satria Kasturi</option>
				`;

				optLevel = `
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
				`;

				optNoRumah = `
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
				`;

				optBilik = `
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
					<option value="D">D</option>
					<option value="E">E</option>
				`;

				optKatil = `
					<option value="1">1</option>
					<option value="2">2</option>
			`;
			}

			// AL JAZARI
			else if (asrama === "Al_Jazari") {

				optBlock = `
				<option value="A">Blok A</option>
				<option value="B">Blok B</option>
				<option value="C">Blok C</option>
				`;

				optLevel = `
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				`;

				optNoRumah = `
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				`;

				optBilik = `
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
					<option value="D">D</option>
					<option value="E">E</option>
				`;

				optKatil = `
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
				`;

			}

			// LESTARI
			else if (asrama === "Lestari") {

				optBlock = `
				<option value="B1">B1</option>
				<option value="B2">B2</option>
				`;

				optLevel = `
					<option value="G">G</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
				`;

				optNoRumah = `
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
					<option value="D">D</option>
					<option value="E">E</option>
				`;

				optBilik = `
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
				`;

				optKatil = `
					<option value="1">1</option>
					<option value="2">2</option>
				`;

			}

			selectBlock.innerHTML = optBlock;
			selectLevel.innerHTML = optLevel;
			selectRumah.innerHTML = optNoRumah;
			selectBilik.innerHTML = optBilik;
			selectKatil.innerHTML = optKatil;

			updateAddress();
		});

		document.querySelectorAll(".col-2 select").forEach(select => {
			select.addEventListener("change", updateAddress);
		});

		function updateAddress() {
			let block = selectBlock.value || "";
			let level = selectLevel.value || "";
			let rumah = selectRumah.value || "";
			let bilik = selectBilik.value || "";
			let katil = selectKatil.value || "";
			studentRoom.value = `${block}-${level}-${rumah}-${bilik}(${katil})`;
		}

		// ========

		let getFullAddreddToUpdate = () => {
			let block = uptselectBlock.value || "";
			let level = uptselectLevel.value || "";
			let rumah = uptselectRumah.value || "";
			let bilik = uptselectBilik.value || "";
			let katil = uptselectKatil.value || "";
			uptstudentRoom.value = `${block}-${level}-${rumah}-${bilik}(${katil})`;
		}

		function getdataStudent(id) {
			console.log("Request");

			$.ajax({
				url: "../../api/getStudentDetail.php",
				method: "POST",
				data: {
					userID: id
				},
				success: response => {
					console.log(response[0]);
					getModal().show();

					let kolej = response[0].studentCollege
					let alamat = response[0].studentRoom

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

					optCollege = `
						<option ${kolej == "Satria" ? "selected" : ""} value="Satria">Satria</option>
						<option ${kolej == "Al_Jazari" ? "selected" : ""} value="Al_Jazari">Al Jazari</option>
						<option ${kolej == "Lestari" ? "selected" : ""} value="Lestari">Lestari</option>
					`

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

					uptID.value = response[0].userID
					textID.textContent = response[0].userID
					uptName.value = response[0].name
					uptPhoneNumber.value = response[0].numTel
					uptEmail.value = response[0].email

					uptselectCollege.innerHTML = optCollege
					uptselectBlock.innerHTML = optBlock
					uptselectLevel.innerHTML = optLevel
					uptselectRumah.innerHTML = optNo_Rumah
					uptselectBilik.innerHTML = optBilik
					uptselectKatil.innerHTML = optKatil

					getFullAddreddToUpdate()
				},
				errors: response => {
					console.log(response);
				}
			})
		}

		document.getElementById("formUpdate").addEventListener("submit", async e => {
			e.preventDefault()
			getModal().hide()
			showLoading()
			await delay(1000)
			$.ajax({
				url: "../../api/updateDataStudent.php",
				method: "POST",
				data: {
					uptuserID: document.getElementById("uptID").value,
					uptname: uptName.value,
					uptphoneNumber: uptPhoneNumber.value,
					uptemail: uptEmail.value,
					uptcollage: document.getElementById("uptCollage").value,
					uptstudentRoom: uptstudentRoom.value
				},
				success: res => {
					console.log(res);
					HideLoading()
				},
				error: err => {
					console.log(err.responseText);
					showError()
				}
			});

		})
	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="SAD">
	<input type="text" name="title" id="title" hidden value="Add Student">
</body>

</html>