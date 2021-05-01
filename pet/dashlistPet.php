<?php
session_start();
require_once '../components/db_connect.php';

// not allowed beside admin
if (!isset($_SESSION['adm'])) {
    header("Location: ../index.php");
    exit;
}

//table data for pet
$sqlSelect = "SELECT * FROM pet";
$result = mysqli_query($connect, $sqlSelect);

//this variable will hold the body for the table
$tbody = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        if ($row['status'] == 'Available') { // status variance
            $stattext =  "<td style='text-align: center';><span class='status text-success'>&bull;</span> " . $row['status'] . "</td>";
        } else {
            $stattext = "<td style='text-align: center';><span class='status text-danger'>&bull;</span> " . $row['status'] . "</td>";
        }

        $tbody .= "<tr class='text-center'>
        <td>" . $row['id'] . "</td>
        <td><img class='img-thumbnail rounded-circle' src='" . $row['picture'] . "' alt=" . $row['name'] . "></td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['breed'] . "</td>
            <td>" . $row['size'] . "</td>
             $stattext 
        <td>
            <a href='detailsPet.php?id=" . $row['id'] . "' class='view' title='View' data-toggle='tooltip'><i class='material-icons'>&#xE417;</i></a>
            <a href='updatePet.php?id=" . $row['id'] . "' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
            <a href='deletePet.php?id=" . $row['id'] . "' class='delete' title='Delete' data-toggle='tooltip'><i class='material-icons'>&#xE872;</i></a>
            </td>
         </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

// get admin details
$id = $_SESSION['adm'];
$status = 'adm';
$res = mysqli_query($connect, "SELECT * FROM user WHERE id={$id}");
$row2 = mysqli_fetch_array($res, MYSQLI_ASSOC);

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dopatier - Admin: Pet List</title>
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
                <a href="#">&#8226 Pet Management</a><br>
                <a href="../adopt/dashlistAdopt.php">Adoption Management</a><br>
                <a href="../components/logout.php?logout">Sign Out</a>
            </div>

            <div class="col-8 mt-2">
                <p class='h2'>Pet Management <a href="createPet.php" class="btn btn-secondary"><i class="material-icons">&#xE147;</i>Add Pet</a>
                <table class='table table-striped'>
                    <thead class='table-success'>
                        <tr>
                            <th>ID</th>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Breed</th>
                            <th>Size</th>
                            <th>Status</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $tbody ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>