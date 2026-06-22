<?php
require_once __DIR__ . "../../../inc/init.php";
auth("SAD");

//php code hrre
if (isset($_GET['delete'])) {

	$id = mysqli_real_escape_string($conn, $_GET['delete']);

	mysqli_query($conn, "DELETE FROM contractor WHERE contractorID='$id'");
	mysqli_query($conn, "DELETE FROM user WHERE userID='$id'");

	header("Location: contractor.php");
	exit;
}


$sql = "SELECT 
		user.userID,
		user.name,
		contractor.expertise,
		user.numTel
		FROM user
		JOIN contractor ON user.userID = contractor.contractorID
		";

$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql);

if (isset($_POST['submit'])) {
	$userID = $_POST['contractorID'];
	$name = $_POST['name'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$numTel = $_POST['numTel'];
	$email = $_POST['email'];
	$expertise = $_POST['expertise'];

	$sqlUser = "INSERT INTO user
				(userID, name, password, numTel, email)
				VALUES
				('$userID', '$name', '$password', '$numTel', '$email')";

	if (mysqli_query($conn, $sqlUser)) {
		$sqlContractor = "INSERT INTO contractor
						  (contractorID, expertise)
						  VALUES
						  ('$userID', '$expertise')";

		$resultContractor = mysqli_query($conn, $sqlContractor);

		echo "
        <script>
            alert('Contractor Added Successfully');
            window.location.href='';
        </script>";
	}
}

if(isset($_GET['cid'])){
	$userID = $_GET['cid'];

	$sqlContractor = "DELETE FROM user
					  WHERE userID = '$userID'";
	
	if(mysqli_query($conn, $sqlContractor)){
		echo "<script>
            alert('Contractor Deleted Successfully');
            window.location.href='contractor.php';
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
</head>

<body>

	<section class="_workspace">
		<?php $title = "Contractor" ?>
		<?php include(__DIR__ . "../../../components/system-admin/header.php") ?>

		<!-- CONTENT HERE -->
		<main class="_content-area">
			<nav class="add-box">
				<button type="button" class="updateBtn" data-bs-toggle="modal" data-bs-target="#Modal">
					Add Contractor
				</button>
			</nav>

			<section class="table-container">
				<table class="myReportTbl trackingReportTbl">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Expertise</th>
							<th>Phone No</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody id="contractorTable">
						<?php while ($row = mysqli_fetch_assoc($result)) : ?>
							<tr>
								<td><?= $row['userID'] ?></td>
								<td><?= $row['name'] ?></td>
								<td><?= $row['expertise'] ?></td>
								<td><?= $row['numTel'] ?></td>
								<td>
									<button class="updateBtn" data-bs-target="#modalStudent" data-bs-toggle="modal">Update</button>
									<a href="contractor.php?cid=<?= $row['userID'] ?>"
										class="deleteBtn"
										onclick="return confirm('Delete contractor <?= $row['userID'] ?>? This action cannot be undone.')">
										Delete
									</a>
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
								<p><strong>Expertise</strong></p>
								<p><strong>Phone No</strong></p>
							</div>

							<div id="reportCard-right">
								<p><?= $row2['userID'] ?></p>
								<p><?= $row2['name'] ?></p>
								<p><?= $row2['expertise'] ?></p>
								<p><?= $row2['numTel'] ?></p>
							</div>
						</div>

						<div id="reportCard-bottom">
							<button onclick="getDetail('<?= $row2['userID'] ?>')" class="updateBtn">Update</button>
							<a href="contractor.php?delete=<?= $row2['userID'] ?>" class="btn btn-danger">Delete</a>
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
						<h1 class="modal-title fs-5" id="exampleModalLabel">Add Contractor</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="input-control">
							<label for="contractorID">Id</label>
							<input type="text" name="contractorID" id="contractorID">
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
						<div class="input-control">
							<label for="expertise" class="required">Expertise</label>
							<input type="text" name="expertise" id="expertise">
						</div>
					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
						<button type="submit" name="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalStudent">
		<form method="POST" action="" id="updateForm">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5">
							<img src="../../images/report.svg" alt="">
							Update Contractor
						</h1>
					</div>
					<div class="modal-body">

						<section>
							<article>
								<h3 id="ctrID">ID: 001</h3>
								<p class="required">All fields must be filled.</p>
							</article>
							<section class="form-detail">
								<input type="hidden" name="userID" id="userID">

								<div class="input-control">
									<label for="uptname" class="required">Name</label>
									<input type="text" name="uptname" id="uptname">
								</div>

								<div class="input-control">
									<label for="uptphoneNumber" class="required">Phone Number</label>
									<input type="number" name="uptphoneNumber" id="uptphoneNumber">
								</div>

								<div class="input-control">
									<label for="uptemail" class="required">Email</label>
									<input type="email" name="uptemail" id="uptemail">
								</div>

								<div class="input-control">
									<label for="uptexpertise" class="required">Expertise</label>
									<input type="text" name="uptexpertise" id="uptexpertise">
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

	<!-- your script -->
	<script>
		let uptname = document.getElementById("uptname")
		let uptphoneNumber = document.getElementById("uptphoneNumber")
		let uptemail = document.getElementById("uptemail")
		let uptexpertise = document.getElementById("uptexpertise")
		let ctrID = document.getElementById("ctrID")
		let userID = document.getElementById("userID")

		let updateForm = document.getElementById("updateForm")

		function getModal() {
			return bootstrap.Modal.getOrCreateInstance(document.getElementById('modalStudent'));
		}

		function getDetail(id) {
			console.log(id);

			$.ajax({
				url: "../../api/getDataContractor.php",
				method: "POST",
				dataType: "json",
				data: {
					userID: id
				},
				success: response => {
					console.log(response);
					getModal().show();
					userID.value = response.datas.userID
					ctrID.textContent = response.datas.userID
					uptname.value = response.datas.name
					uptphoneNumber.value = response.datas.numTel
					uptemail.value = response.datas.email
					uptexpertise.value = response.datas.expertise
				},
				error: response => {
					console.log(response.responseText);
				},
			})
		}

		updateForm.addEventListener("submit", e => {
			e.preventDefault()

			$.ajax({
				url: "../../api/updateDataContractor.php",
				method: "POST",
				data: {
					userID: userID.value,
					uptname: uptname.value,
					uptphoneNumber: uptphoneNumber.value,
					uptemail: uptemail.value,
					uptexpertise: uptexpertise.value
				},
				success: response => {
					console.log(response)

					if (response.status === "success") {
						getModal().hide();
						alert("Contractor Updated Successfully")
						location.reload()

					} else {
						alert(response.message)
					}
				},
				error: response => {
					console.log(response.responseText)
				}
			})
		})
	</script>

	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar" id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="SAD">
	<input type="text" name="title" id="title" hidden value="Add Contractor">
</body>

</html>