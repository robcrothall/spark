<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../ctl/logout.php">Intranet logout</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
<!--      <li class="nav-item active">
      <li class="nav-item">
        <a class="nav-link" href="../ctl/logout.php">Logout</a>
      </li>
-->
      <li class="nav-item">
			<?php
				if($_SESSION["id"] !== "0") {
            	echo '<a class="nav-link" href="../ctl/password.php">Password</a> ';
				}
			?>	
<!--        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>  -->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../ctl/register.php">Register</a>
      </li>
      <li class="nav-item">
			<?php
				if($_SESSION["id"] !== "0") {
            	echo '<a class="nav-link" href="../ctl/search.php">Search</a> ';
				}
			?>	
      </li>
      <?php
      if($_SESSION["user_role"] == "STAFF" | $_SESSION["user_role"] == "ADMIN") {
      	echo '<li class="nav-item dropdown">';
        echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        echo 'Administration';
        echo '</a>';
        echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
        echo '<a class="dropdown-item" href="../ctl/country.php">Countries</a>';
        echo '<a class="dropdown-item" href="../ctl/history.php">History</a>';
        echo '<a class="dropdown-item" href="../ctl/occupation.php">Occupation</a>';
        echo '<a class="dropdown-item" href="../ctl/party.php">Party</a>';
        echo '<a class="dropdown-item" href="../ctl/people.php">People</a>';
        echo '<a class="dropdown-item" href="../ctl/place.php">Places</a>';
        echo '<a class="dropdown-item" href="../ctl/region.php">Regions</a>';
        echo '<a class="dropdown-item" href="../ctl/ship.php">Ships</a>';
        echo '<a class="dropdown-item" href="../ctl/synonyms.php">Synonyms</a>';
        echo '<a class="dropdown-item" href="../ctl/voyage.php">Voyages</a>';
        echo '<div class="dropdown-divider"></div>';
        echo '<a class="dropdown-item" href="../ctl/password_force.php">Password force</a>';
        echo '<a class="dropdown-item" href="../ctl/payments.php">Payments</a>';
        echo '<a class="dropdown-item" href="../ctl/roles.php">Roles</a>';
        echo '<a class="dropdown-item" href="../ctl/users.php">Users</a>';
        if($_SESSION["user_role"] == "ACCT") {
            echo '<div class="dropdown-divider"></div>';
            echo '<a class="dropdown-item" href="../view/construction_form">Electricity billing</a>';
            echo '<a class="dropdown-item" href="../view/construction_form">Phone billing</a>';
            echo '<a class="dropdown-item" href="../view/construction_form">Restaurant billing</a>';
        }
        echo '</div>';
      	echo '</li>';
   	}
      ?>
    </ul>
<!--    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
-->
  </div>
</nav> 
