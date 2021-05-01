<?php
session_start();
require_once '../components/db_connect.php';

// only for user
if (isset($_SESSION['adm'])) {
    header("Location: dashlistAdopt.php");
} else if (!isset($_SESSION['user'])) {
    header("Location: dashlistAdopt.php");
}
$session = $_SESSION['user'];
//table data for adopt
$sql = mysqli_query($connect, "SELECT * FROM adopt");
$result2 = mysqli_fetch_all($sql, MYSQLI_ASSOC);

$tbody = '';
if (count($result2) > 0) {
    $i = 0;

    while ($i < count($result2)) {

        $adoptID = $result2[$i]['id'];
        $userID = $result2[$i]['userID'];
        $petID = $result2[$i]['petID'];

        // user details
        $sql = "SELECT * FROM user WHERE id = {$userID}";
        $result = $connect->query($sql);
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $f_name = $user['first_name'];
            $l_name = $user['last_name'];
            $email = $user['email'];
        }

        // pet details
        $sql = "SELECT * FROM pet WHERE id = {$petID}";
        $result = $connect->query($sql);
        if ($result->num_rows == 1) {
            $pet = $result->fetch_assoc();
            $name = $pet['name'];
            $breed = $pet['breed'];
            $age = $pet['age'];
            $size = $pet['size'];
        }

        if ($session == $userID) {
            $tbody .= "<tr class='text-center'>
            <td><a href='../pet/detailsPet.php?id=" . $petID . "' title='View' data-toggle='tooltip'>" . $name . " </a></td>
            <td>" . $breed . "</td>
            <td>" . $age . "</td>
            <td>" . $size . "</td>
         </tr>";
        }

        $i++;
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dopatier - Adoption List</title>
    <?php require_once '../components/style.php' ?>

</head>

<body>
    <fieldset>
        <div class="container">
            <div class="row">

                <div class="col-8 mt-2">
                    <legend class='h2'>Your Adoption</legend>
                    <table class='table table-striped'>
                        <thead class='table-success'>
                            <tr>
                                <th>Name</th>
                                <th>Breed</th>
                                <th>Age</th>
                                <th>Size</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $tbody ?>
                        </tbody>
                    </table>
                </div>

                <a href='../index.php'><button class='btn btn-outline-success' type='button'>Home</button></a>
            </div>
        </div>
    </fieldset>
</body>

</html>