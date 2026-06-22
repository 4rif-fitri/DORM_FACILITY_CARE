<?php
require_once __DIR__ . "../../../inc/init.php";
auth("SAD");

//php code hrre
$sql = "SELECT * FROM user
		JOIN student ON user.userID = student.userID
		ORDER BY name ASC
		";

$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql);

if(isset($_POST['submit'])){
	$matricNo = $_POST['matrik'];
	$name = $_POST['name'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$numTel = $_POST['numTel'];
	$email = $_POST['email'];
	$college = $_POST['collage'];
	$studentRoom = $_POST['studentRoom'];

	$sqlUser = "INSERT INTO user
			(userID, name, password, numTel, email, type)
			VALUES 
			('$matricNo', '$name', '$password', '$numTel', '$email', 'STD')
			";
	
	if(mysqli_query($conn, $sqlUser)){
		$sqlStudent = "INSERT INTO student
				 (userID, studentCollege, studentRoom)
				 VALUES
				 ('$matricNo', '$college', '$studentRoom')
				 ";

		$resultStudent = mysqli_query($conn, $sqlStudent);

		echo "
        <script>
            alert('Student Added Successfully');
            window.location.href='';
        </script>";
	}
}
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
		<?php $title = "Add Student" ?>
		<?php include(__DIR__ . "../../../components/system-admin/header.php") ?>

		<!-- CONTENT HERE -->
		<main class="_content-area">
			<nav class="add-box">
				<button type="button" class="addBtn" data-bs-toggle="modal" data-bs-target="#Modal">
					Add Student
				</button>
				<!-- <a href="" class="addBtn">Add Student</a> -->
			</nav>

			<section class="table-container">
				<table class="myReportTbl trackingReportTbl">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>College</th>
							<th>Phone No</th>
							<th>Edit</th>
						</tr>
					</thead>

					<tbody>

						<?php while($row = mysqli_fetch_assoc($result)) : ?> 
						<tr>
							<td><?= $row['userID'] ?></td>
							<td><?= $row['name'] ?></td>
							<td><?= $row['studentCollege'] ?></td>
							<td><?= $row['numTel'] ?></td>
							<td>
								<button onclick="update(<?= $row['userID'] ?>)" class="updateBtn" data-bs-target="#modalStudent" data-bs-toggle="modal">Update</button>
							</td>
						</tr>
						<?php endwhile ?>

					</tbody>

				</table>

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
							<button onclick="update('<?= $row['userID'] ?>')" class="updateBtn" data-bs-target="#modalStudent" data-bs-toggle="modal">Update</button>
						</div>
					</div>
				<?php endwhile ?>
			</section>


		</main>
		<!-- CONTENT HERE -->

	</section>

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
							<input type="text" name="matrik" id="matrik">
						</div>

						<div class="input-control">
							<label for="name">Name</label>
							<input type="text" name="name" id="name">
						</div>
						<div class="input-control">
							<label for="password">Password</label>
							<input type="text" value="abc123" name="password" id="password">
						</div>
						<div class="input-control">
							<label for="numTel">numTel</label>
							<input type="text" name="numTel" id="numTel">
						</div>
						<div class="input-control">
							<label for="email">email</label>
							<input type="text" name="email" id="email">
						</div>

						<div class="input-control col-2">
							<div class="input-control">
								<label for="collage">Collage</label>
								<select name="collage" id="collage">
									<option disabled selected value="">Select Collage</option>
									<option value="Satria">Satria</option>
									<option value="Al_Jazari">Al_Jazari</option>
									<option value="Lestari">Lestari</option>
								</select>
							</div>
							<article>
								<label for="block" class="required">Block</label>
								<select required id="block">

								</select>
							</article>

							<article>
								<label for="level" class="required">Level</label>
								<select id="level">

								</select>
							</article>
							<article>
								<label for="rumah" class="required">No Rumah</label>
								<select id="rumah">

								</select>
							</article>

							<article>
								<label for="bilik" class="required">Bilik</label>
								<select id="bilik">

								</select>
							</article>

							<article>
								<label for="katil" class="required">Katil</label>
								<select id="katil">

								</select>
							</article>
						</div>
						<div class="input-control">
							<label for="studentRoom">Student Room</label>
							<input type="text" readonly name="studentRoom" id="studentRoom">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
						<button type="submit"  name="submit" class="btn btn-primary">Add Student</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalStudent">
		<form method="POST" action="">
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
								<h3>ID: 001</h3>
								<p class="required">All fields must be filled.</p>
							</article>
							<form action="" method="post">

								<section class="form-detail">

									<div class="input-control">
										<label for="uptName" class="required">Name</label>
										<input type="text" name="name" id="uptName">
									</div>

									<div class="input-control">
										<label for="uptPhoneNumber" class="required">Phone Number</label>
										<input type="number" name="phoneNumber" id="uptPhoneNumber">
									</div>

									<div class="input-control">
										<label for="uptEmail" class="required">Email</label>
										<input type="email" name="email" id="uptEmail">
									</div>

									<div class="input-control col-2">
										<div class="input-control">
											<label for="uptCollage">Collage</label>
											<select name="collage" id="uptCollage">
												<option disabled selected value="">Select Collage</option>
												<option value="Satria">Satria</option>
												<option value="Al_Jazari">Al_Jazari</option>
												<option value="Lestari">Lestari</option>
											</select>
										</div>
										<article>
											<label for="uptBlock" class="required">Block</label>
											<select required id="uptBlock">

											</select>
										</article>

										<article>
											<label for="uptLevel" class="required">Level</label>
											<select id="uptLevel">

											</select>
										</article>
										<article>
											<label for="uptRumah" class="required">No Rumah</label>
											<select id="uptRumah">

											</select>
										</article>

										<article>
											<label for="uptBilik" class="required">Bilik</label>
											<select id="uptBilik">

											</select>
										</article>

										<article>
											<label for="uptKatil" class="required">Katil</label>
											<select id="uptKatil">

											</select>
										</article>
									</div>
									<div class="input-control">
										<label for="uptStudentRoom">Student Room</label>
										<input type="text" disabled name="studentRoom" id="uptStudentRoom">
									</div>

								</section>


							</form>

						</section>

					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success">Assign!</button>
					</div>
				</div>
			</div>
		</form>
	</div>

	<!-- your script -->


	<script>
		let selectCollege = document.getElementById("collage");
		let selectBlock = document.getElementById("block");
		let selectLevel = document.getElementById("level");
		let selectRumah = document.getElementById("rumah");
		let selectBilik = document.getElementById("bilik");
		let selectKatil = document.getElementById("katil");
		let studentRoom = document.getElementById("studentRoom");


		let uptselectCollege = document.getElementById("uptCollage");
		let uptselectBlock = document.getElementById("uptBlock");
		let uptselectLevel = document.getElementById("uptLevel");
		let uptselectRumah = document.getElementById("uptRumah");
		let uptselectBilik = document.getElementById("uptBilik");
		let uptselectKatil = document.getElementById("uptKatil");
		let uptstudentRoom = document.getElementById("uptStudentRoom");

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

		function update(id) {

			$.ajax({
				url: "../../api/getStudentDetail.php",
				method: "POST",
				data: {
					userID: id
				},
				success: response => {
					console.log(response[0]);

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
						<option ${kolej == "Satria" ? "selected" : ""} value="A">Satria</option>
						<option ${kolej == "Al_Jazari" ? "selected" : ""} value="B">Al Jazari</option>
						<option ${kolej == "Lestari" ? "selected" : ""} value="C">Lestari</option>
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
	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="SAD">
	<input type="text" name="title" id="title" hidden value="Add Student">
</body>

</html>