<?php
session_start();
require_once '../components/db_connect.php';

// not allowed for common
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
	header("Location: index.php");
	exit;
}

// acquire session details
if (isset($_SESSION["user"])) {
	$session = $_SESSION["user"];
} else {
	$session = $_SESSION["adm"];
}

if ($_GET['id']) {
	$id = $_GET['id'];
	if (isset($_SESSION["user"])) {
		// user accesses id from session
		$sql = "SELECT * FROM user WHERE id = {$session}";
	} else {
		// admin accesses id from get
		$sql = "SELECT * FROM user WHERE id = {$id}";
	}
	$result = $connect->query($sql);

	if ($result->num_rows == 1) {
		$data = $result->fetch_assoc();
		$id = $data['id'];
		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		$date_of_birth = $data['date_of_birth'];
		$email = $data['email'];
		$password = $data['password'];
		$picture = $data['picture'];
		$status = $data['status'];

		$message = "<table class='table w-50'>
			<tr>
			<br><img src='../pictures/$picture' width='200' alt='$first_name'><br>
            <br>
			Name: $first_name $last_name<br>
			Date of Birth: $date_of_birth<br>
			Email: $email<br>
			<br>
			</tr></table>";
	} else {
		header("location: error.php");
	}
	$connect->close();
} else {
	header("location: error.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Dopatier - View Profile</title>
	<?php require_once '../components/style.php' ?>

</head>

<body>
	<fieldset>
		<legend class='h2'>User Details</legend>

		<form action="actions/a_update.php" method="post" enctype="multipart/form-data">
			<table class="table">

				<p><?php echo ($message) ?? ''; ?></p><br>

				<tr>
					<?php
					if (isset($_SESSION['adm'])) {
						echo "
						<a href='updateUser.php?id=$id'><button class='btn btn-outline-warning' type='button'>Edit</button></a>&nbsp;
						<a href='deleteUser.php?id=$id'><button class='btn btn-outline-danger' type='button'>Delete</button></a>&nbsp;
                <a href= 'dashlistUser.php'><button class='btn btn-outline-success' type='button'>User List</button></a>
				";
					} else if (isset($_SESSION['user'])) {
						echo "
						<a href='updateUser.php?id=$id'><button class='btn btn-outline-warning' type='button'>Edit</button></a>&nbsp;
                <a href= '../index.php'><button class='btn btn-outline-success' type='button'>Home</button></a>
				";
					}
					?>
				</tr>
				<br><br>
			</table>
		</form>
	</fieldset>
</body>

</html>