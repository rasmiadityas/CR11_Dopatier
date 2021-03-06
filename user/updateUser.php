<?php
session_start();
require_once '../components/db_connect.php';
require_once '../components/file_upload.php';

// not allowed for common
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

// acquire session details
if (isset($_SESSION["user"])) {
    $session = $_SESSION["user"];
} else {
    $session = $_SESSION["adm"];
}

//fetch and populate form
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_GET['id']) {
        $id = $_GET['id'];
        if (isset($_SESSION["user"])) {
            // user accesses id from session
            $sql = "SELECT * FROM user WHERE id = {$session}";
            $id = $session;
        } else {
            // admin accesses id from get
            $sql = "SELECT * FROM user WHERE id = {$id}";
        }
        $result = $connect->query($sql);

        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            $f_name = $data['first_name'];
            $l_name = $data['last_name'];
            $email = $data['email'];
            $date_birth = $data['date_of_birth'];
            $picture = $data['picture'];
        }
    }
}

//update form
$class = 'd-none';
if (isset($_POST["submit"])) {
    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $id = $_POST['id'];
    //variable for upload pictures errors is initialized
    $uploadError = '';
    $pictureArray = file_upload($_FILES['picture']); //file_upload() called
    $picture = $pictureArray->fileName;
    if ($pictureArray->error === 0) {
        ($_POST["picture"] == "avatar.png") ?: unlink("../pictures/{$_POST["picture"]}");
        $sql = "UPDATE user SET first_name = '$f_name', last_name = '$l_name', email = '$email', date_of_birth = '$date_of_birth', picture = '$pictureArray->fileName' WHERE id = {$id}";
    } else {
        $sql = "UPDATE user SET first_name = '$f_name', last_name = '$l_name', email = '$email', date_of_birth = '$date_of_birth' WHERE id = {$id}";
    }
    if ($connect->query($sql) === true) {
        $class = "alert alert-success";
        $message = "The record was successfully updated! Please wait for the page to refresh...";
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=updateUser.php?id={$id}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connect->error;
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=updateUser.php?id={$id}");
    }
}

$backBtn = '';
//if it is a user it will create a back button to view profile
if (isset($_SESSION["user"])) {
    $backBtn = "detailsUser.php?id={$id}";
}
//if it is a adm it will create a back button to dashlistUser
if (isset($_SESSION["adm"])) {
    $backBtn = "dashlistUser.php";
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dopatier - Edit User</title>
    <?php require_once '../components/style.php' ?>

</head>

<body>
    <fieldset>
        <div class="container">
            <div class="<?php echo $class; ?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
            </div>

            <h2>Edit Profile</h2>
            <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $data['picture'] ?>' alt="<?php echo $f_name ?>">
            <form method="post" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <th>First Name</th>
                        <td><input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php echo $f_name ?>" /></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php echo $l_name ?>" /></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $email ?>" /></td>
                    </tr>
                    <tr>
                        <th>Date of birth</th>
                        <td><input class="form-control" type="date" name="date_of_birth" placeholder="Date of birth" value="<?php echo $date_birth ?>" /></td>
                    </tr>
                    <tr>
                        <th>Picture</th>
                        <td><input class="form-control" type="file" name="picture" /></td>
                    </tr>
                    <tr>
                        <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
                        <input type="hidden" name="picture" value="<?php echo $picture ?>" />
                    </tr>
                </table>
                <button name="submit" class="btn btn-outline-success" type="submit">Save Changes</button>
                <a href="<?php echo $backBtn ?>"><button class="btn btn-outline-warning" type="button">Back</button></a>
            </form>
        </div>
    </fieldset>
</body>

</html>