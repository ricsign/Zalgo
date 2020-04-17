
  <?php
    # import documents
    require_once "common/common.php";
    if(!defined('ACC_CODE')){
      _back();
      exit();
    }
    if (!defined("COOKIE_SALT_VAL")){
      define("COOKIE_SALT_VAL","O#ur42WBe@S3)2i|tES2*&eCu#r@iTy3/2IsoK9.32Y8e3s");
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
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Learn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Problems</a>
        </li>

      </ul>
      <ul class="navbar-nav ml-auto">
        <?php
          if(isset($_COOKIE["username"]) && isset($_COOKIE["userkey"])){
            if($_COOKIE["userkey"] == sha1(sha1(COOKIE_SALT_VAL.$_COOKIE['username'].COOKIE_SALT_VAL))){
        ?>
        <li class="nav-item">
          <a class="nav-link" href="myaccount.php">My Account</a>
        </li>
        <?php
            }
            else{
          ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Log In</a>
        </li>
          <?php
            }
          }
          else{
        ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Log In</a>
        </li>
        <?php
          }
        ?>
        <li class="nav-item">

          <a class="nav-link" href="#">About</a>
        </li>
      </ul>
    </div>
  </nav>
