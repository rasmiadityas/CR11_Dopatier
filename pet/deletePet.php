<?php
session_start();
require_once '../components/db_connect.php';

// not allowed beside admin
if (!isset($_SESSION['adm'])) {
    header("Location: ../index.php");
    exit;
}

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pet WHERE id = {$id}";
    $result = $connect->query($sql);

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();

        $id = $data['id'];
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
    } else {
        header("location: ../error.php");
    }

    $message = "<h5>You have selected the data below:</h5>
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

    $connect->close();
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dopatier - Delete Pet</title>
    <?php require_once '../components/style.php' ?>

</head>

<body>
    <fieldset>
        <legend class='h2 mb-3'>Delete Pet</legend>
        <p><?php echo ($message) ?? ''; ?></p>

        <h3 class="mb-4">Do you really want to delete this record?</h3>

        <form action="actions/a_deletePet.php?id=<?php echo $id ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <button class="btn btn-outline-danger" type="submit">Yes, Delete</button>
            <a href='dashlistPet.php'><button class='btn btn-outline-success' type='button'>No, Back</button></a>
        </form>
        <br><br>

    </fieldset>
</body>

</html>