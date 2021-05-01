<?php
session_start();
require_once '../../components/db_connect.php';

// not allowed beside admin
if (!isset($_SESSION['adm'])) {
    header("Location: ../../index.php");
    exit;
}

if ($_POST) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $picture = $_POST['picture'];
    $locStreet = $_POST['locStreet'];
    $locZip = $_POST['locZip'];
    $locCity = $_POST['locCity'];
    $descript = $_POST['descript'];
    $age = $_POST['age'];
    $breed = $_POST['breed'];
    $hobby = $_POST['hobby'];
    $size = $_POST['size'];
    $status = $_POST['status'];

    if ($picture === "") {
        $picture = "https://i.pinimg.com/236x/74/5b/d2/745bd2edb5733d769c4dac034ee33213--facebook-profile-profile-pictures.jpg";
    }

    $sql = "UPDATE pet SET
name = '$name',
picture = '$picture',
locStreet = '$locStreet',
locZip = $locZip,
locCity = '$locCity',
descript = '$descript',
age = $age,
breed = '$breed',
hobby = '$hobby',
size = '$size',
status = '$status'
WHERE id = {$id}";

    if ($connect->query($sql) === true) {

        $class = "success";
        $message = "The record below was successfully updated: <br>
                        <table class='table w-50'><tr>
                        Name:  $name <br>
                        Breed: $breed <br>
                        Age: $age yrs old<br>
                        Size: $size <br>
                        Status: $status <br>
                        Description: $descript<br>
			Hobby: $hobby<br>
			Location: $locStreet, $locZip $locCity<br><br>
                        <img src='" . $picture . "' width='200' alt=" . $name . ">
                        </tr></table><hr>
                        ";
    } else {
        $class = "danger";
        $message = "Error while updating record: <br>" . $connect->error;
    }
    $connect->close();
} else {
    header("location: ../../error.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dopatier - Edit Pet Confirmation</title>
    <?php require_once '../../components/style.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Edit Pet Confirmation</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>

            <a href='../updatePet.php?id=<?php echo $id; ?>'><button class="btn btn-warning" type='button'>Edit again</button></a>
            <a href='../dashlistPet.php'><button class="btn btn-success" type='button'>Back</button></a>
        </div>
    </div>
</body>

</html>