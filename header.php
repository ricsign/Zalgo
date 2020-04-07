
  <?php
    # import documents
    require_once "common/common.php";
    if(!defined('ACC_CODE')){
      _back();
      exit();
    }
   ?>
  <link rel="stylesheet" href="css/header.css">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Zalgo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Learn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Problems</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Setting</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Log In</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
      </ul>
    </div>
  </nav>
