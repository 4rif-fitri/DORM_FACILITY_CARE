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
</head>

<body>

	<section class="_workspace">
		<?php $title = "Manage College Admin" ?>
		<?php include(__DIR__ . "../../../components/system-admin/header.php") ?>

		<!-- CONTENT HERE -->
		<main class="_content-area">
			<nav class="add-box">
				<button type="button" class="addBtn" data-bs-toggle="modal" data-bs-target="#Modal">
					Add Admin
				</button>
				<!-- <a href="" class="addBtn">Add Admin</a> -->
			</nav>

			<section class="table-container">
				<table class="myReportTbl">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>College</th>
							<th>Email</th>
							<th>Phone No</th>
							<th>Edit</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>D032410396</td>
							<td>Arif Fitri</td>
							<td>Al-Jazari</td>
							<td>arifa321@gmail.com</td>
							<td>011 167 6767</td>
							<td>
								<button class="updateBtn" data-userID="1" data-bs-target="#modalAdmin" data-bs-toggle="modal">Update</button>
								<!-- <a href="./collegeAdminUpdate.php" class="updateBtn">Update</a> -->
							</td>
						</tr>

						<tr>
							<td>D032410396</td>
							<td>Muhammad Imran Danial bin Samsudin</td>
							<td>Satria</td>
							<td>carod1234@gmail.com</td>
							<td>013 145 7816</td>
							<td>
								<button class="updateBtn" data-userID="1" data-bs-target="#modalAdmin" data-bs-toggle="modal">Update</button>
								<!-- <a href="./collegeAdminUpdate.php" class="updateBtn">Update</a> -->
							</td>
						</tr>
					</tbody>

				</table>
			</section>


		</main>
		<!-- CONTENT HERE -->



	</section>

	<div class="modal fade" id="modalAdmin">
		<form method="POST" action="">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5">
							<img src="../../images/report.svg" alt="">
							Update Admin
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

	<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form action="" method="post">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Add Admin</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="input-control">
							<label for="name">Name</label>
							<input type="text" name="name" id="name">
						</div>
						<div class="input-control">
							<label for="password">Password</label>
							<input type="password" name="password" id="password">
						</div>
						<div class="input-control">
							<label for="numTel">numTel</label>
							<input type="text" name="numTel" id="numTel">
						</div>
						<div class="input-control">
							<label for="email">email</label>
							<input type="text" name="email" id="email">
						</div>
						<div class="input-control">
							<label for="collage">Collage</label>
							<select name="collage" id="collage">
								<option disabled selected value="">Select Collage</option>
								<option value="KOLEJ KEDIAMAN SATRIA JEBAT">KOLEJ KEDIAMAN SATRIA JEBAT</option>
								<option value="KOLEJ KEDIAMAN SATRIA TUAH">KOLEJ KEDIAMAN SATRIA TUAH</option>
								<option value="KOLEJ KEDIAMAN SATRIA KASTURI">KOLEJ KEDIAMAN SATRIA KASTURI</option>
								<option value="KOLEJ KEDIAMAN SATRIA LEKIR">KOLEJ KEDIAMAN SATRIA LEKIR</option>
								<option value="KOLEJ KEDIAMAN SATRIA LEKIU">KOLEJ KEDIAMAN SATRIA LEKIU</option>
								<option value="KOLEJ KEDIAMAN AL JAZARI">KOLEJ KEDIAMAN AL JAZARI</option>
								<option value="KOLEJ KEDIAMAN LESTARI">KOLEJ KEDIAMAN LESTARI</option>
							</select>
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

	<!-- your script -->
	<script>

	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar"
		id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="SAD">
	<input type="text" name="title" id="title" hidden value="Manage College Admin">
</body>

</html>