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
    ?>
    <div class="form-container">
      <form class="login-form" action="login.php" method="post">
        <div class="login-box">
          <div class="form-group">
            <label>Username: </label>
            <input type="text" name = "username" class="form-control"></input>
          </div>
          <div class="form-group">
            <label>Password: </label>
            <input type="password" name="password" class="form-control"></input>
          </div>
          <label>Auth Code: </label>
          <div class="form-group form-inline">
            <input type="text" name="authcode" class="form-control auth"></input>
            <img src="includes/authcode.inc.php" id="code_pic"/>
            <button type="button" class="btn btn-outline-light btn-sm" id="code_refresh">Refresh</button>
          </div>
          <input type="submit" value="Log In" class="submit btn btn-success btn-lg btn-block"></input>
          <a href="register.php" class="register-tag">Doesn't have an account? Register now!</a>
        </div>
      </form>
    </div>
  </body>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="js/loginreg.js" type="text/javascript"></script>
</html>
