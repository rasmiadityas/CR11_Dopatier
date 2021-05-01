<?php
session_start();
require_once '../components/db_connect.php';

// only for admin
if (!isset($_SESSION['adm'])) {
    header("Location: ../index.php");
}

// get admin details
$id = $_SESSION['adm'];
$status = 'adm';

$sql = mysqli_query($connect, "SELECT * FROM user WHERE id={$id}");
$row2 = mysqli_fetch_array($sql, MYSQLI_ASSOC);

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
        } else {
            header("location: error.php");
        }

        // pet details
        $sql = "SELECT * FROM pet WHERE id = {$petID}";
        $result = $connect->query($sql);
        if ($result->num_rows == 1) {
            $pet = $result->fetch_assoc();
            $name = $pet['name'];
            $breed = $pet['breed'];
        } else {
            header("location: error.php");
        }

        $tbody .= "<tr class='text-center'>
        <td>" . $adoptID . "</td>
        <td><a href='../user/detailsUser.php?id=" . $userID . "' title=' User ID: " . $userID . "' data-toggle='tooltip'>" . $f_name . " " . $l_name . " </a></td>
            <td>" . $email . "</td>
            <td><a href='../pet/detailsPet.php?id=" . $petID . "' title=' Pet ID: " . $petID . "' data-toggle='tooltip'>" . $name . " </a></td>
            <td>" . $breed . "</td>
         </tr>";

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
    <title>Dopatier - Admin: Adoption List</title>
    <?php require_once '../components/style.php' ?>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img class="userImage" src="../pictures/admavatar.png" alt="Adm avatar">
                <p class="mt-2">Admin: <?php echo $row2['first_name'] ?></p>
                <a href="../dashboard.php">Dashboard</a><br>
                <a href="../index.php">Live Homepage</a><br>
                <a href="../user/dashlistUser.php">User Management</a><br>
                <a href="../pet/dashlistPet.php">Pet Management</a><br>
                <a href="#">&#8226 Adoption Management</a><br>
                <a href="../components/logout.php?logout">Sign Out</a>
            </div>

            <div class="col-8 mt-2">
                <p class='h2'>Adoption Management
                <table class='table table-striped'>
                    <thead class='table-success'>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Pet</th>
                            <th>Breed</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>