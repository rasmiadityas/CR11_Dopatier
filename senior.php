<?php
session_start();
require_once 'components/db_connect.php';

if (isset($_SESSION['user'])) {
    // select logged-in users details - procedural style
    $res1 = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
    $row1 = $res1->fetch_array(MYSQLI_ASSOC);
} else if (isset($_SESSION['adm'])) {
    // select logged-in users details - procedural style
    $res1 = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['adm']);
    $row1 = $res1->fetch_array(MYSQLI_ASSOC);
}

// select product  details
$res2 = mysqli_query($connect, "SELECT * FROM pet");
$row2 = $res2->fetch_all(MYSQLI_ASSOC);

$res3 = mysqli_query($connect, "SELECT * FROM adopt");
$row3 = $res3->fetch_all(MYSQLI_ASSOC);

$connect->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dopatier - Senior Pets</title>

    <?php require_once 'components/style.php' ?>

</head>

<body>
    <?php include 'components/navbarSenior.php' ?>

    <div class="container d-flex flex-wrap p-2">

        <?php
        $i = 0;
        while ($i < count($row2)) {
            if ($row2[$i]['age'] > 8) {

                echo "<div class='card m-2 border' style='width: 12rem;'>
                    <img src='" . $row2[$i]['picture'] . "' class='card-img-top' height=70%>
                    <div class='card-body d-flex flex-column'>
                    <p class='card-text'><i class='material-icons'>&#xf21a;</i> I'm a senior!</p> 
                    <h5 class='card-title'>" . $row2[$i]['name'] . "</h5>
                    <p class='card-text'>" . $row2[$i]['breed'] . " (" . $row2[$i]['size'] . ")</p>
                        <p class='card-text'>" . $row2[$i]['age'] . " yrs old</p>
                        <p class='card-text'>Home: " . $row2[$i]['locCity'] . "</p>
                        <a href='#' class='btn btn-outline-dark'>'Dop Me!</a>                        
                    </div>
                </div>";
            }
            $i++;
        }
        ?>

    </div>

</body>

</html>