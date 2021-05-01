<?php
session_start(); // start a new session or continues the previous

// not applicable for common
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
}

require_once '../components/db_connect.php';

$error = false;

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    $status = 'user';
} else  if (isset($_SESSION["adm"])) {
    $status = '';
}

if ($_POST) {
    $userID = $_POST['userID'];
    $petID = $_POST['petID'];
}

// retrieve pet data
$sql = "SELECT * FROM pet WHERE id = {$petID}";
$result = $connect->query($sql);

if ($result->num_rows == 1) {
    $pet = $result->fetch_assoc();
    $p_name = $pet['name'];
    $p_picture = $pet['picture'];
    $p_locStreet = $pet['locStreet'];
    $p_locZip = $pet['locZip'];
    $p_locCity = $pet['locCity'];
    $p_descript = $pet['descript'];
    $p_age = $pet['age'];
    $p_breed = $pet['breed'];
    $p_hobby = $pet['hobby'];
    $p_size = $pet['size'];
    $p_status = $pet['status'];
} else {
    header("location: ../error.php");
}

$message = "
<table class='table w-50'><tr>
Name: $p_name <br>
Breed: $p_breed <br>
Age: $p_age yrs old<br>
<br><img src='" . $p_picture . "' width='200' alt=" . $p_name . ">
</tr></table><hr>
";

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dopatier - Add Adoption</title>
    <?php require_once '../components/style.php' ?>

</head>

<body>
    <fieldset>
        <legend class='h2 mb-3'>Adopt Pet</legend>
        <h3 class="mb-4">Do you really want to adopt this pet?</h3>
        <p>Cancellation is <b>NOT</b> possible! Please contact us directly if you want to modify your adoption.</p>
        <p><?php echo ($message) ?? ''; ?></p>

        <?php
        echo "<form action='actions/a_createAdopt.php' method='post'>
						<input type='hidden' name='userID' value='$userID' />
						<input type='hidden' name='petID' value=' $petID' />
						<a href='../pet/detailsPet.php?id=$petID'><button class='btn btn-outline-success' type='button'>No, Back</button></a>
        				<button class='btn btn-outline-primary' type='submit'>Yes, 'Dop Me!</button>
                        </form>
                        ";
        ?>
        <br><br>

    </fieldset>
</body>

</html>