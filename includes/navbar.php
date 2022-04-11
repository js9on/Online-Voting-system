<header id="navheader" class="sticky-top">
<div class="bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <nav class="navbar navbar-expand-lg navbar-dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Votes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                
                <li class="nav-item">
                  <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
               

                <?php if(!isset($_SESSION['authenticated'])): ?>
                  <li class="nav-item">
                  <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contactus.php">Contact</a>
                </li>
                  <li class="nav-item">
                  <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
                <?php endif ?>

                <?php if(isset($_SESSION['authenticated'])): ?>
                  <li class="nav-item">
                  <a class="nav-link" href="mainvotes.php">Voting</a>
                </li>
                  <li class="nav-item">
                  <a class="nav-link" href="votes/index.php">Community voting</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="profile_update.php">Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="logout.php">Log out</a>
                </li>
                <?php endif ?>
              </ul>
            </div>
          </div>
        </nav>

    </div>
  </div>
</div>
</div>
                </header>
