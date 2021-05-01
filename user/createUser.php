<?php
session_start(); // start a new session or continues the previous

// not applicable for user
if (isset($_SESSION["user"])) {
    header("Location: ../index.php");
}

require_once '../components/db_connect.php';
require_once '../components/file_upload.php';
$error = false;
$fname = $lname = $email = $date_of_birth = $pass = $picture = '';
$fnameError = $lnameError = $emailError = $dateError = $passError = $picError = $statusError = '';
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    $status = 'user';
} else  if (isset($_SESSION["adm"])) {
    $status = '';
}

if (isset($_POST['btn-signup'])) {

    //status handling for admin can add status
    if (isset($_SESSION["adm"])) {
        $status = trim($_POST['status']);
        $status = strip_tags($status);
        $status = htmlspecialchars($status);

        // basic status validation
        if (empty($status)) {
            $error = true;
            $statusError = "Please enter the status";
        } else if ($status != "user" && $status != "adm") {
            $error = true;
            $statusError = "Plese enter the right status";
        }
    }

    // sanitize user input to prevent sql injection
    $fname = trim($_POST['fname']);

    //trim - strips whitespace (or other characters) from the beginning and end of a string
    $fname = strip_tags($fname);

    // strip_tags -- strips HTML and PHP tags from a string

    $fname = htmlspecialchars($fname);
    // htmlspecialchars converts special characters to HTML entities

    $lname = trim($_POST['lname']);
    $lname = strip_tags($lname);
    $lname = htmlspecialchars($lname);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $date_of_birth = trim($_POST['date_of_birth']);
    $date_of_birth = strip_tags($date_of_birth);
    $date_of_birth = htmlspecialchars($date_of_birth);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    $uploadError = '';
    $picture = file_upload($_FILES['picture']);

    // basic name validation
    if (empty($fname) || empty($lname)) {
        $error = true;
        $fnameError = "Please enter your full name and surname";
    } else if (strlen($fname) < 3 || strlen($lname) < 3) {
        $error = true;
        $fnameError = "Name and surname must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lname)) {
        $error = true;
        $fnameError = "Name and surname must contain only letters and no spaces.";
    }

    //basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {
        // checks whether the email exists or not
        $query = "SELECT email FROM user WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    //checks if the date input was left empty
    if (empty($date_of_birth)) {
        $error = true;
        $dateError = "Please enter your date of birth.";
    }
    // password validation
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter password.";
    } else if (strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }

    // password hashing for security
    $password = hash('sha256', $pass);
    // if there's no error, continue to signup
    if (!$error) {

        $query = "INSERT INTO user(first_name, last_name, password, date_of_birth, email, picture, status) VALUES('$fname', '$lname', '$password', '$date_of_birth', '$email', '$picture->fileName', '$status')";
        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered!";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
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
    <title>Dopatier - Add User</title>
    <?php require_once '../components/style.php' ?>

</head>

<body>
    <fieldset class="field-register">
        <div class="container">
            <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
                <h2>Create User</h2>
                <hr />
                <?php
                if (isset($errMSG)) {
                ?>
                    <div class="alert alert-<?php echo $errTyp ?>">
                        <p><?php echo $errMSG; ?></p>
                        <p><?php echo $uploadError; ?></p>
                    </div>
                <?php
                }
                ?>

                <input type="text" name="fname" class="form-control" placeholder="First name" maxlength="50" value="<?php echo $fname ?>" />
                <span class="text-danger"> <?php echo $fnameError; ?> </span>

                <input type="text" name="lname" class="form-control" placeholder="Last Name" maxlength="50" value="<?php echo $lname ?>" />
                <span class="text-danger"> <?php echo $fnameError; ?> </span>

                <input type="email" name="email" class="form-control" placeholder="Email" maxlength="40" value="<?php echo $email ?>" />
                <span class="text-danger"> <?php echo $emailError; ?> </span>
                <div class="d-flex">
                    <input class='form-control w-50' type="date" name="date_of_birth" value="<?php echo $date_of_birth ?>" />
                    <span class="text-danger"> <?php echo $dateError; ?> </span>

                    <input class='form-control w-50' type="file" name="picture">
                    <span class="text-danger"> <?php echo $picError; ?> </span>
                </div>
                <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                <span class="text-danger"> <?php echo $passError; ?> </span>

                <?php
                if (isset($_SESSION["adm"])) { // buttons for admin
                ?>
                    <select class="form-select" name="status" aria-label="Default select example">
                        <option value='user'>User</option>
                        <option value='adm'>Admin</option>
                    </select>
                    <hr />
                    <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Add User</button>
                    <a href="dashlistUser.php"><button class='btn btn-success' type="button"> Back</button></a>
                    <hr />

                <?php
                } else { // buttons for common
                ?>
                    <hr />
                    <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
                    <a href="../components/login.php"><button class='btn btn-warning text-white' type="button">Login Here</button></a>
                    <a href="../index.php"><button class='btn btn-success' type="button">Homepage</button></a>
                    <hr />

                <?php
                }
                ?>

            </form>

        </div>
    </fieldset>
</body>

</html>