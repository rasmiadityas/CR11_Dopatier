<?php
session_start();
require_once 'components/db_connect.php';

// not allowed beside admin
if (!isset($_SESSION['adm'])) {
    header("Location: index.php");
    exit;
}

$id = $_SESSION['adm'];
$status = 'adm';

// get admin details
$res = mysqli_query($connect, "SELECT * FROM user WHERE id={$id}");
$row2 = mysqli_fetch_array($res, MYSQLI_ASSOC);

//table data for user
$sqlSelect = "SELECT * FROM user WHERE status != ? ";
$stmt = $connect->prepare($sqlSelect);
$stmt->bind_param("s", $status);
$work = $stmt->execute();
$result = $stmt->get_result();

//this variable will hold the body for the table
$tbody = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr class='text-center'>
            <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
            <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
            <td>" . $row['date_of_birth'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>
            <a href='user/detailsUser.php?id=" . $row['id'] . "' class='view' title='View' data-toggle='tooltip'><i class='material-icons'>&#xE417;</i></a>
            <a href='user/updateUser.php?id=" . $row['id'] . "' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
            <a href='user/deleteUser.php?id=" . $row['id'] . "' class='delete' title='Delete' data-toggle='tooltip'><i class='material-icons'>&#xE872;</i></a>
            </td>
         </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

//table data for admin
$sqlSelect = "SELECT * FROM user WHERE status = ? ";
$stmt = $connect->prepare($sqlSelect);
$stmt->bind_param("s", $status);
$work = $stmt->execute();
$result = $stmt->get_result();

//this variable will hold the body for the table
$tbody2 = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody2 .= "<tr class='text-center'>
            <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
            <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
            <td>" . $row['date_of_birth'] . "</td>
            <td>" . $row['email'] . "</td>            
         </tr>";
    }
} else {
    $tbody2 = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dopatier - Admin: Dashboard</title>
    <?php require_once 'components/style.php' ?>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img class="userImage" src="pictures/admavatar.png" alt="Adm avatar">
                <p class="mt-2">Admin: <?php echo $row2['first_name'] ?></p>
                <a href="#">&#8226 Dashboard</a><br>
                <a href="index.php">Live Homepage</a><br>
                <a href="user/dashlistUser.php">User Management</a><br>
                <a href="pet/dashlistPet.php">Pet Management</a><br>
                <a href="adopt/dashlistAdopt.php">Adoption Management</a><br>
                <a href="components/logout.php?logout">Sign Out</a>
            </div>

            <div class="col-8 mt-2">
                <p class='h2'>Welcome Admin <?php echo $row2['first_name'] ?>!</p>
                <a href="index.php"><button class='btn btn-outline-dark'>Live Homepage</button></a><br><br>
                <a href="user/dashlistUser.php"><button class='btn btn-outline-dark'>User Management</button></a><br><br>
                <a href="pet/dashlistPet.php"><button class='btn btn-outline-dark'>Pet Management</button></a><br><br>
                <a href="adopt/dashlistAdopt.php"><button class='btn btn-outline-dark'>Adoption Management</button></a><br><br>
                <a href="components/logout.php?logout"><button class='btn btn-outline-dark'>Sign Out</button></a>
            </div>

        </div>
    </div>
</body>

</html>