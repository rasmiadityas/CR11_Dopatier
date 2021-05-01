<?php
session_start();
require_once '../components/db_connect.php';

// not allowed beside admin
if (!isset($_SESSION['adm'])) {
    header("Location: ../index.php");
    exit;
}

// select pet data to populate form
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
    <?php require_once '../components/style.php' ?>
    <title>Dopatier - Edit Pet</title>

</head>

<body>
    <fieldset>
        <legend class='h2'>Edit Pet</legend>
        <form action="actions/a_updatePet.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="name" placeholder="Name" value="<?php echo $name ?>" /></td>
                </tr>
                <tr>
                    <th>Image URL</th>
                    <td><input class='form-control' type=" text" name="picture" placeholder="https://... " value="<?php echo $picture ?>" /></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <select class=" form-select" name="status" aria-label="Default select example" value="<?php echo $status ?>">
                            <option value='Available'>Available</option>
                            <option value='Reserved'>Reserved</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td>
                        <select class=" form-select" name="size" aria-label="Default select example" value="<?php echo $size ?>">
                            <option value='Small'>Small</option>
                            <option value='Large'>Large</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type=" text" name="breed" placeholder="Breed" value="<?php echo $breed ?>" /></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type=" number" step="any" name="age" placeholder="Age" value="<?php echo $age ?>" /></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class='form-control' type=" text" name="descript" placeholder="Description" value="<?php echo $descript ?>" /></td>
                </tr>
                <tr>
                    <th>Hobby</th>
                    <td><input class='form-control' type=" text" name="hobby" placeholder="Hobby" value="<?php echo $hobby ?>" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input class='form-control' type=" text" name="locStreet" placeholder="e.g. Hauptstrasse 32" value="<?php echo $locStreet ?>" /></td>
                </tr>
                <tr>
                    <th>Zip Code</th>
                    <td><input class='form-control' type=" text" name="locZip" placeholder="e.g. 1010" value="<?php echo $locZip ?>" /></td>
                </tr>
                <tr>
                    <th>City</th>
                    <td><input class='form-control' type=" text" name="locCity" placeholder="City" value="<?php echo $locCity ?>" /></td>
                </tr>

            </table>

            <tr>
                <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
                <td><button class='btn btn-outline-warning' type=" submit">Edit Pet</button>
                    <a href="dashlistPet.php"><button class='btn btn-outline-success' type="button">Back</button></a>
                </td>
            </tr>
            <br><br>

        </form>

    </fieldset>
</body>

</html>