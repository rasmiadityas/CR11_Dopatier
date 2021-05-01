<?php
session_start();
require_once '../../components/db_connect.php';

// only for user
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
}

if ($_POST) {
    $userID = $_POST['userID'];
    $petID = $_POST['petID'];

    // retrieve user data
    $sql = "SELECT * FROM user WHERE id = {$userID}";
    $result = $connect->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $u_first_name = $user['first_name'];
        $u_last_name = $user['last_name'];
        $u_email = $user['email'];
        $u_date_birth = $user['date_of_birth'];
        $u_picture = $user['picture'];
    }

    // retrieve pet data
    $sql = "SELECT * FROM pet WHERE id = {$petID}";
    $result = $connect->query($sql);

    if ($result->num_rows == 1) {
        $pet = $result->fetch_assoc();
        $p_name = $pet['name'];
        $p_picture = $pet['picture'];
        $p_locStreet = $pet['locStreet'];
        $p_locZip = $pet['locZip'];
        $p_locCity = $pet['locCity'];
        $p_descript = $pet['descript'];
        $p_age = $pet['age'];
        $p_breed = $pet['breed'];
        $p_hobby = $pet['hobby'];
        $p_size = $pet['size'];
        $p_status = $pet['status'];
    }

    // add to adoption table
    $sql = "INSERT INTO adopt (userID, petID) VALUES($userID, $petID)";

    if ($connect->query($sql) === true) {

        $class = "success";
        $newstat = "Reserved";
        if (isset($_SESSION["user"])) {
            $opmsg = "Congratulation! You have adopted this friend!<br>";
        } else {
            $opmsg = "A new adoption below is made:<br>";
        }
        $message = $opmsg . "
                        <table class='table w-50'><tr>
                        User:  $u_first_name $u_last_name<br>
                        Email:  $u_email<br><br>
                        
                        Name: $p_name <br>
                        Breed: $p_breed <br>
                        Age: $p_age yrs old<br>
                        <br><img src='" . $p_picture . "' width='200' alt=" . $p_name . ">
                        </tr></table><hr>
                        ";
    } else {
        $class = "danger";
        $message = "Error while creating record: <br>" . $connect->error;
    }

    // change pet status
    $sql = "UPDATE pet SET status = '$newstat' WHERE id = {$petID}";
    if ($connect->query($sql) === true) {
    } else {
        header("location: ../../error.php");
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
    <title>Dopatier - Add Adoption Confirmation</title>
    <?php require_once '../../components/style.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Add Adoption Confirmation</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../../index.php'><button class="btn btn-success" type='button'>Homepage</button></a>
        </div>
    </div>
</body>

</html>