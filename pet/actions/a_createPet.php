<?php
session_start();
require_once '../../components/db_connect.php';

// not allowed beside admin
if (!isset($_SESSION['adm'])) {
    header("Location: ../../index.php");
    exit;
}

if ($_POST) {
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
    if ($age === "") {
        $age = 0;
    }
    if ($locZip === "") {
        $locZip = 0;
    }

    $sql = "INSERT INTO pet (name, picture, locStreet, locZip, locCity, descript, age, breed, hobby, size, status) 
    VALUES ('$name', '$picture', '$locStreet', $locZip, '$locCity', '$descript', $age, '$breed', '$hobby', '$size', '$status')";

    if ($connect->query($sql) === true) {

        $class = "success";
        $message = "The entry below was successfully created: <br>
                        <table class='table w-50'><tr>
                        Name:  $name <br>
                        Breed: $breed <br>
                        Age: $age yrs old<br>
                        Size: $size <br>
                        Status: $status <br><br>
                        <img src='" . $picture . "' width='200' alt=" . $name . ">
                        </tr></table><hr>
                        ";
    } else {
        $class = "danger";
        $message = "Error while creating record: <br>" . $connect->error;
    }

    $sql = "SELECT * FROM pet WHERE id = (SELECT MAX(id) FROM pet)";
    $result = $connect->query($sql);

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        $id = $data['id'];
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
    <title>Dopatier - Add Pet Confirmation</title>
    <?php require_once '../../components/style.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Add Pet Confirmation</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../updatePet.php?id=<?php echo $id; ?>'><button class='btn btn-warning' type='button'>Edit</button></a>
            <a href='../dashlistPet.php'><button class="btn btn-success" type='button'>Back</button></a>
        </div>
    </div>
</body>

</html>