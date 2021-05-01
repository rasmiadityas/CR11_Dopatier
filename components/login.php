<?php
session_start();
require_once 'db_connect.php';

// if user alredy login go to index
if (isset($_SESSION['user']) != "") {
    header("Location: ../index.php");
    exit;
}
// if adm alredy login go to dashboard
if (isset($_SESSION['adm']) != "") {
    header("Location: ../dashboard.php");
}

$error = false;
$email = $password = $emailError = $passError = '';

if (isset($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    // prevent sql injections / clear user invalid inputs
    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $password = hash('sha256', $pass); // password hashing

        $sqlSelect = "SELECT id, first_name, password, status FROM user WHERE email = ? ";
        $stmt = $connect->prepare($sqlSelect);
        $stmt->bind_param("s", $email);
        $work = $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $result->num_rows;
        if ($count == 1 && $row['password'] == $password) {
            if ($row['status'] == 'adm') {
                $_SESSION['adm'] = $row['id'];
                header("Location: ../dashboard.php"); // logged in admin goes to dashboard
            } else {
                $_SESSION['user'] = $row['id'];
                header("Location: ../index.php"); // logged in user goes to index
            }
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
}
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dopatier - Login</title>
    <?php require_once 'style.php' ?>
</head>

<body>
    <fieldset>
        <div class="container">
            <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                <h2><b>D<i class='material-icons'>&#xE91d;</i>pa<i class='material-icons'>&#xe88a;</i>ier</b></h2>
                <h2>Log In</h2>
                <hr />
                <?php
                if (isset($errMSG)) {
                    echo $errMSG;
                }
                ?>

                <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
                <span class="text-danger"><?php echo $emailError; ?></span>

                <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
                <span class="text-danger"><?php echo $passError; ?></span>
                <hr />
                <button button class="btn btn-block btn-primary" type="submit" name="btn-login">Sign In</button>
                <a href="../user/createUser.php"><button class="btn btn-block btn-warning text-white" type="button">Register</button></a>
                <a href="../index.php"><button class="btn btn-block btn-success" type="button">Homepage</button></a>
            </form>

        </div>
    </fieldset>
</body>

</html>