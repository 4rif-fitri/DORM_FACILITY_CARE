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
							<!-- <th>Edit</th> -->
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>D032410321</td>
							<td>Arif Fitri bin Mohd Jamil</td>
							<td>Al-Jazari</td>
							<td>011 167 6767</td>
							<!-- <td>
								<button class="updateBtn" data-bs-target="#modalStudent" data-bs-toggle="modal">Update</button>
							</td> -->
						</tr>

						<tr>
							<td>D032410396</td>
							<td>Muhammad Imran Danial</td>
							<td>Satria</td>
							<td>013 145 7816</td>
							<!-- <td>
								<button class="updateBtn" data-bs-target="#modalStudent" data-bs-toggle="modal">Update</button>
							</td> -->
						</tr>
					</tbody>

				</table>
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
							<input type="text" disabled name="studentRoom" id="studentRoom">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- <div class="modal fade" id="modalStudent">
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
										<label for="uptPassword" class="required">Password</label>
										<input type="password" name="password" id="uptPassword">
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
	</div> -->

	<!-- your script -->


	<script>
		let selectCollege = document.getElementById("collage");
		let selectBlock = document.getElementById("block");
		let selectLevel = document.getElementById("level");
		let selectRumah = document.getElementById("rumah");
		let selectBilik = document.getElementById("bilik");
		let selectKatil = document.getElementById("katil");
		let studentRoom = document.getElementById("studentRoom");

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
	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="SAD">
	<input type="text" name="title" id="title" hidden value="Add Student">
</body>

</html>