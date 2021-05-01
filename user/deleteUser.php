<?php
session_start();
require_once '../components/db_connect.php';

// not allowed beside admin
if (!isset($_SESSION['adm'])) {
    header("Location: ../index.php");
    exit;
}

//initial bootstrap class for the confirmation message
$class = 'd-none';
//the GET method will show the info from the user to be deleted
if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id = {$id}";
    $result = $connect->query($sql);
    $data = $result->fetch_assoc();
    if ($result->num_rows == 1) {
        $f_name = $data['first_name'];
        $l_name = $data['last_name'];
        $email = $data['email'];
        $date_of_birth = $data['date_of_birth'];
        $picture = $data['picture'];
    }
}
//the POST method will actually delete the user permanently
if ($_POST) {
    $id = $_POST['id'];
    $picture = $_POST['picture'];
    ($picture == "avatar.png") ?: unlink("../pictures/$picture");
    $sql = "DELETE FROM user WHERE id = {$id}";
    if ($connect->query($sql) === TRUE) {
        $class = "alert alert-success";
        $message = "Successfully Deleted! Please wait for the page to refresh...";
        header("refresh:3;url=dashlistUser.php");
    } else {
        $class = "alert alert-danger";
        $message = "The entry was not deleted due to: <br>" . $connect->error;
    }
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dopatier - Delete User</title>
    <?php require_once '../components/style.php' ?>

</head>

<body>
    <div class="<?php echo $class; ?>" role="alert">
        <p><?php echo ($message) ?? ''; ?></p>
    </div>
    <fieldset>
        <legend class='h2 mb-3'>User Delete Confirmation</legend>
        <h5>You have selected the data below:</h5>
        <table class="table w-75 mt-3">
            <tr>
                <td>
                    <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $picture ?>' alt="<?php echo $f_name ?>"><br>
                    <?php echo "$f_name $l_name" ?><br>
                    <?php echo $email ?><br>
                    <?php echo $date_of_birth ?>
                </td>
            </tr>
        </table>
        <h3 class="mb-4">Do you really want to delete this user?</h3>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <input type="hidden" name="picture" value="<?php echo $picture ?>" />
            <button class="btn btn-outline-danger" type="submit">Yes, Delete</button>
            <a href="dashlistUser.php"><button class="btn btn-outline-success" type="button">No, Back</button></a>
        </form>
    </fieldset>
</body>

</html>