<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dopatier - Error</title>
    <?php require_once 'components/style.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Invalid Request</h1>
        </div>
        <div class="alert alert-warning" role="alert">
            <p>You've made an invalid request. Please go back and try again.</p>
            <?php
            if (isset($_SESSION['adm'])) {
                // for admin go back to dashboard
                echo "<a href='dashboard.php'><button class='btn btn-outline-success' type='button'>Back</button></a>";
            } else {
                // if not admin go back to index
                echo "<a href='index.php'><button class='btn btn-outline-success' type='button'>Back</button></a>";
            }
            ?>

        </div>
    </div>
</body>

</html>