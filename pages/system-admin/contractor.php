<?php
require_once __DIR__ . "../../../inc/init.php";
auth("SAD");

//php code hrre
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

if(isset($_POST['submit'])){
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

	if(mysqli_query($conn, $sqlUser)){
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
				<button type="button" class="addBtn" data-bs-toggle="modal" data-bs-target="#Modal">
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
							<!-- <th>Action</th> -->
						</tr>
					</thead>

					<tbody>
						<?php while ($row = mysqli_fetch_assoc($result)) : ?>
							<tr>
								<td><?= $row['userID'] ?></td>
								<td><?= $row['name'] ?></td>
								<td><?= $row['expertise'] ?></td>
								<td><?= $row['numTel'] ?></td>
								<td>
									<button class="updateBtn" data-bs-target="#modalStudent" data-bs-toggle="modal">Update</button>
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
							<button class="updateBtn" data-bs-target="#modalStudent" data-bs-toggle="modal">Update</button>
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
		<form method="POST" action="">
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
										<label for="phoneNumber" class="required">Phone Number</label>
										<input type="number" name="phoneNumber" id="phoneNumber">
									</div>

									<div class="input-control">
										<label for="email" class="required">Email</label>
										<input type="email" name="email" id="email">
									</div>

									<div class="input-control">
										<label for="expertise" class="required">Expertise</label>
										<input type="text" name="expertise" id="expertise">
									</div>
								</section>

							</form>

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

	</script>


	<input type="checkbox" hidden style="position: absolute; z-index: 10;" name="_dekstop-sideBar" id="_dekstop-sideBar">
	<input type="checkbox" hidden style="position: absolute;" name="_mobile-sideBar" id="_mobile-sideBar">
	<input type="text" name="role" id="role" hidden value="SAD">
	<input type="text" name="title" id="title" hidden value="Add Contractor">
</body>

</html>