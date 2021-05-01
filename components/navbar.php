<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><b>D<i class='material-icons'>&#xE91d;</i>pa<i class='material-icons'>&#xe88a;</i>ier</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">

        <?php
        if (isset($_SESSION['user'])) {
          echo "
          <li class='nav-item'>
          <img class='img-navbar rounded-circle' src='pictures/" . $row1['picture'] . "'>
          </li>
            <li class='nav-item'>
          <font class='nav-link active' aria-current='page'>Hi, " . $row1['first_name'] . "!</font>
        </li>
        <li class='nav-item'>
          <a class='nav-link' aria-current='page' href='components/logout.php?logout'>Logout</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' aria-current='page' href='user/detailsUser.php?id=" . $row1['id'] . "'>View Profile</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' aria-current='page' href='adopt/userlistAdopt.php?id=" . $row1['id'] . "'>View Adoption</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' aria-current='page' href='senior.php'>Adopt Senior Pets!</a>
        </li>
        ";
        } else if (isset($_SESSION['adm'])) {
          echo "
          <li class='nav-item'>
          <img class='img-navbar rounded-circle' src='pictures/" . $row1['picture'] . "'>
          </li>
          <li class='nav-item'>
          <font class='nav-link active' aria-current='page'>Hi, admin " . $row1['first_name'] . "!</font>
        </li>
        <li class='nav-item'>
          <a class='nav-link' aria-current='page' href='senior.php'>Adopt Senior Pets!</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' aria-current='page' href='Dashboard.php'>Dashboard</a>
        </li>
        ";
        } else {
          echo "<li class='nav-item'>
          <a class='nav-link' aria-current='page' href='components/login.php'>Login</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' aria-current='page' href='senior.php'>Adopt Senior Pets!</a>
        </li>
        ";
        }
        ?>

      </ul>
    </div>
  </div>
</nav>