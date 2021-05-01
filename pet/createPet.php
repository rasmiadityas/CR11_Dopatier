<?php
session_start();
require_once '../components/db_connect.php';

// not allowed beside admin
if (!isset($_SESSION['adm'])) {
    header("Location: ../index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../components/style.php' ?>
    <title>Dopatier - Add Pet</title>

</head>

<body>
    <fieldset>
        <legend class='h2'>Add Pet</legend>
        <form action="actions/a_createPet.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="name" placeholder="Name" /></td>
                </tr>
                <tr>
                    <th>Image URL</th>
                    <td><input class='form-control' type="text" name="picture" placeholder="https://... " /></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <select class="form-select" name="status" aria-label="Default select example">
                            <option value='Available'>Available</option>
                            <option value='Reserved'>Reserved</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td>
                        <select class="form-select" name="size" aria-label="Default select example">
                            <option value='Small'>Small</option>
                            <option value='Large'>Large</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type="text" name="breed" placeholder="Breed" /></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="number" step="any" name="age" placeholder="Age" /></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class='form-control' type="text" name="descript" placeholder="Description" /></td>
                </tr>
                <tr>
                    <th>Hobby</th>
                    <td><input class='form-control' type="text" name="hobby" placeholder="Hobby" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input class='form-control' type="text" name="locStreet" placeholder="e.g. Hauptstrasse 32" /></td>
                </tr>
                <tr>
                    <th>Zip Code</th>
                    <td><input class='form-control' type="text" name="locZip" placeholder="e.g. 1010" /></td>
                </tr>
                <tr>
                    <th>City</th>
                    <td><input class='form-control' type="text" name="locCity" placeholder="City" /></td>
                </tr>

            </table>

            <tr>
                <td><button class='btn btn-outline-warning' type="submit">Add Pet</button>
                    <a href="dashlistPet.php"><button class='btn btn-outline-success' type="button"> Back</button></a>
                </td>
            </tr>
            <br><br>

        </form>

    </fieldset>
</body>

</html>