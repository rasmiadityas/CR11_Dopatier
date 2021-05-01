<?php
session_start();
require_once '../components/db_connect.php';

// acquire session details
if (isset($_SESSION['adm'])) {
	$userID = $session = $_SESSION['adm'];
} else if (isset($_SESSION['user'])) {
	$userID = $session = $_SESSION['user'];
}

if ($_GET['id']) {
	$petID = $id = $_GET['id'];
	$sql = "SELECT * FROM pet WHERE id = {$id}";
	$result = $connect->query($sql);

	if ($result->num_rows == 1) {
		$data = $result->fetch_assoc();
		$name = $data['name'];
		$picture = $data['picture'];
		$locStreet = $data['locStreet'];
		$locZip = $data['locZip'];
		$locCity = $data['locCity'];
		$descript = $data['descript'];
		$age = $data['age'];
		$breed = $data['breed'];
		$hobby = $data['hobby'];
		$size = $data['size'];
		$status = $data['status'];
		$stattext = $status;

		if ($status == "Available") {
			$statid = 1;
		} else if ($status == "Reserved") {
			$statid = 2;
		}

		// not showing reserved to common
		if ((!isset($_SESSION['adm']) && !isset($_SESSION['user'])) && $status == "Reserved") {
			header("Location: ../index.php");
		}

		// looping through adopt table
		$sql = mysqli_query($connect, "SELECT * FROM adopt");
		$result2 = mysqli_fetch_all($sql, MYSQLI_ASSOC);

		$tbody = '';
		if (count($result2) > 0) {
			$i = 0;
			while ($i < count($result2)) {

				// now loop at row i
				$n_adoptID = $result2[$i]['id'];
				$n_userID = $result2[$i]['userID'];
				$n_petID = $result2[$i]['petID'];

				// user details
				$sql = "SELECT * FROM user WHERE id = {$n_userID}";
				$result = $connect->query($sql);
				if ($result->num_rows == 1) {
					$n_user = $result->fetch_assoc();
					$n_f_name = $n_user['first_name'];
					$n_l_name = $n_user['last_name'];
					$n_email = $n_user['email'];
				} else {
					header("location: ../error.php");
				}

				// pet details
				$sql = "SELECT * FROM pet WHERE id = {$n_petID}";
				$result = $connect->query($sql);
				if ($result->num_rows == 1) {
					$n_pet = $result->fetch_assoc();
					$n_name = $n_pet['name'];
					$n_breed = $n_pet['breed'];
				} else {
					header("location: ../error.php");
				}

				// admin can see who reserves what
				if ($petID == $result2[$i]['petID']) {
					$ownerID = $result2[$i]['userID'];
				}

				if (isset($_SESSION['adm'])) {
					if ($statid == 2) {
						$stattext = "Reserved by " . $n_f_name . " " . $n_l_name . " (ID: " . $ownerID . ")";
					}
				}

				// user can see own reserved animal
				if (isset($_SESSION['user'])) {
					if ($userID == $result2[$i]['userID'] && $petID == $result2[$i]['petID']) {
						$status = "Available";
						$statid = 3;
						$stattext = "You adopt this buddy!";
					}
				}

				$i++;
			}
		}

		// user cannot see animal reserved by others
		if (isset($_SESSION['user'])) {
			if ($statid == 2) {
				header("location: ../index.php");
			}
		}

		if ($data['age'] > 8) { // age variance
			$agetext =  "Age: " .  $data['age'] . " yrs old (I'm a <a href='../senior.php'>senior!</a>)";
		} else {
			$agetext =  "Age: " .  $data['age']  . " yrs old";
		}

		$tbody = "<table class='table w-50'>
			<tr>
			<img src='$picture' width='200' alt='$name'><br><br>
            Breed: $breed<br>
			Size: $size<br>
			$agetext<br><br>
			Description: $descript<br>
			Hobby: $hobby<br>
			Location: $locStreet, $locZip $locCity<br>
			</tr></table>";
	} else {
		header("location: ../error.php");
	}
	$connect->close();
} else {
	header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Dopatier - Pet Details</title>
	<?php require_once '../components/style.php' ?>

</head>

<body>
	<fieldset>
		<legend class='h2'><?php echo $name ?></legend>
		<p><?php
			if ($statid == 1) { // status variance
				echo  "<font class='available'>" . $stattext . "</font>";
			} else if ($statid == 2) {
				echo  "<font class='reserved'>" . $stattext . "</font>";
			} else if ($statid == 3) {
				echo  "<font class='owned'>" . $stattext . "</font>";
			}
			?></p>

		<p>
			<?php
			echo ($tbody) ?? '';
			?>
		</p><br>

		<?php
		if (isset($_SESSION['user'])) { // buttons for user
			echo "<table class='table'>
						<tr>
						<a href= '../index.php'><button class='btn btn-outline-success' type='button'>Home </button></a>&nbsp;";

			if ($statid == 1) {
				echo "<form action='../adopt/createAdopt.php' method='post'>
						<input type='hidden' name='userID' value='$userID' />
						<input type='hidden' name='petID' value=' $petID' />
						<button class='btn btn-outline-primary' type='submit'>'Dop Me!</button>
						</form>";
			} else if ($statid == 3) {
				echo "<a href= '../adopt/userlistAdopt.php'><button class='btn btn-outline-primary' type='button'>My Adoption</button></a>&nbsp;";
			}

			echo "</tr>
				 		<br><br> 
			 			</table>
						";
		} else if (isset($_SESSION['adm'])) { // buttons for admin
			echo "
						<table class='table'>
						<tr>
						<a href='updatePet.php?id=$id'><button class='btn btn-outline-warning' type='button'>Edit</button></a>&nbsp;
						 <a href='deletePet.php?id=$id'><button class='btn btn-outline-danger' type='button'>Delete</button></a>&nbsp;
                 		<a href= 'dashlistPet.php'><button class='btn btn-outline-success' type='button'>Pet List</button></a>
				 		</tr>
				 		<br><br> 
						</table>
						";
		} else { // buttons for common
			echo "
						<table class='table'>
						<tr>
						<a href= '../index.php'><button class='btn btn-outline-success' type='button'>Home </button></a>&nbsp;
						<a href= '../components/login.php'><button class='btn btn-outline-primary' type='button'>'Dop Me!</button></a>
						</tr>
				 		<br><br> 
			 			</table>
						";
		}
		?>



	</fieldset>
</body>

</html>