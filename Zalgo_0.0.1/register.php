<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Zalgo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/loginreg.css">
  </head>

  <body>
    <?php
      # Prevent illegal operations
      define("ACC_CODE",True);
      require_once "header.php";
      require_once "common/common.php";

      // store user info
      $data = array();
      // if we receive post data, process it
      if (isset($_GET['action'])){
        session_start();
        if ($_GET['action'] == "reg"){
          // check auth code
          if (!($_POST['authcode'] == $_SESSION['auth_code'])){
            _url_back("register.php","Your auth code is not correct, please try again!");
            exit();
          }
          // clean auth code cache
          if(isset($_SESSION["auth_code"])){
            unset($_SESSION["auth_code"]);
          }
          // receive Username
          if (isset($_POST['username'])){
            $data['username'] = _username_clean("register.php",$_POST['username'],20,2);
          }
        }
      }
    ?>
    <div class="form-container">
      <form class="login-form" action="register.php?action=reg" method="post">
        <div class="login-box">
          <div class="form-group">
            <label>Username: </label>
            <input type="text" name = "username" class="form-control"></input>
          </div>
          <div class="form-group form-check form-check-inline">
            <label class="form-check-label">Gender:</label> &nbsp&nbsp&nbsp
            <br/>
            <input class="form-check-input" type="radio" name="gender" value="male"> <label class="form-check-label">Male</label>&nbsp&nbsp&nbsp
            <input class="form-check-input" type="radio" name="gender" value="female">  <label class="form-check-label">Female</label>&nbsp&nbsp&nbsp
            <input class="form-check-input" type="radio" name="gender" value="others">  <label class="form-check-label">Others</label>&nbsp&nbsp&nbsp
            <input class="form-check-input" type="radio" name="gender" value="private"> <label class="form-check-label">Prefer not to tell</label>
          </div>
          <div class="form-group">
            <label>Password: </label>
            <input type="password" name="password" class="form-control"></input>
          </div>
          <div class="form-group">
            <label>Confirm Password: </label>
            <input type="password" name="repassword" class="form-control"></input>
          </div>
          <div class="form-group">
            <label>Email: </label>
            <input type="email" name = "email" class="form-control"></input>
          </div>
          <label>Auth Code: </label>
          <div class="form-group form-inline">
            <input type="text" name="authcode" class="form-control auth"></input>
            <img src="includes/authcode.inc.php" id="code_pic"/>
            <button type="button" class="btn btn-outline-light btn-sm" id="code_refresh">Refresh</button>
          </div>
          <input type="submit" value="Register" class="submit btn btn-success btn-lg btn-block"></input>
          <a href="login.php" class="register-tag">Already have an acoount? Click here!</a>
        </div>
      </form>
    </div>
  </body>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="js/login.js" type="text/javascript"></script>
</html>
