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

    $sql = "DELETE FROM pet WHERE id = {$id}";
    if ($connect->query($sql) === TRUE) {
        $class = "success";
        $message = "Successfully Deleted!";
    } else {
        $class = "danger";
        $message = "The entry was not deleted due to: <br>" . $connect->error;
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
    <title>Dopatier - Delete Pet Confirmation</title>
    <?php require_once '../../components/style.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Delete Pet Confirmation</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?= $message; ?></p>
            <a href='../dashlistPet.php'><button class="btn btn-success" type='button'>Back</button></a>
        </div>
    </div>
</body>

</html>