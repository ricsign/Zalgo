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
    define("ACC_CODE",true);
    define("DB_ACC",true);
    if (!defined("COOKIE_SALT_VAL")){
      define("COOKIE_SALT_VAL","O#ur42WBe@S3)2i|tES2*&eCu#r@iTy3/2IsoK9.32Y8e3s");
    }
    require_once "header.php";
    require_once "common/common.php";
    require_once "includes/conn.inc.php";
    // check login status, if already logged in, reject request
    if(isset($_COOKIE['username'])){
        _url_back("index.php","You don't need to log in!");
        exit();
    }
    // store user info
    $data = array();
    // if we receive post data, process it
    if (isset($_GET['action'])){
      session_start();
      if ($_GET['action'] == "login"){
        // check auth code
        if(isset($_POST['authcode'])){
          if (!($_POST['authcode'] == $_SESSION['auth_code'])){
            _url_back("login.php","Your auth code is not correct, please try again!");
            exit();
          }
        }else{
          _url_back("login.php","Unauthorized operations!");
          exit();
        }
        // clean auth code cache
        if(isset($_SESSION["auth_code"])){
          unset($_SESSION["auth_code"]);
        }
        // receive Username
        if (isset($_POST['username'])){
          $data['username'] = _username_clean("login.php",$_POST['username'],20,2);
        }else{
          _url_back("register.php","Please fill username!");
          exit();
        }
        // receive Password
        if (isset($_POST['password'])){
          $data['password'] = _login_password_clean("login.php",$_POST['password'],30,3);
        }else{
          _url_back("login.php","Please fill password!");
          exit();
        }
        // check database
        $login_query = "select password from user_info where username = '{$data['username']}' limit 1";
        $ret_password = ret_query($conn,$login_query);
        if($ret_password == null){
          _url_back("login.php","Username or password is incorrect!");
        }else{
          if(!password_verify($data['password'],$ret_password[0])){
            _url_back("login.php","Username or password is incorrect!");
          }else{
            // write in database and update last login time and ip
            $write_in_query = "update user_info set last_login_time=now(), last_login_ip='{$_SERVER["REMOTE_ADDR"]}' where username='{$data['username']}';";
            void_query($conn,$write_in_query);
            // receive remember me option
            if(isset($_POST['remember'])){
              $data['remember'] = _rememberme_clean($_POST['remember']);
              if($data['remember'] == 1){
                setcookie ("username", $data['username'], time() + 2592000); // set cookie to 1 month later
                setcookie ("userkey", sha1(sha1(COOKIE_SALT_VAL.$data['username'].COOKIE_SALT_VAL)), time() + 2592000); // userkey is for security, everytime user enter a page,ask for the value
              }else{
                setcookie ("username", $data['username']); // set cookie before shutting off the browser
                setcookie ("userkey", sha1(sha1(COOKIE_SALT_VAL.$data['username'].COOKIE_SALT_VAL))); // userkey is for security, everytime user enter a page,ask for the value
              }
            }else{
              setcookie ("username", $data['username']); // set cookie before shutting off the browser
              setcookie ("userkey", sha1(sha1(COOKIE_SALT_VAL.$data['username'].COOKIE_SALT_VAL))); // userkey is for security, everytime user enter a page,ask for the value
            }
            _url_back("index.php","Success!");
          }
        }
      }
    }
    ?>
    <div class="form-container">
      <form class="login-form" action="login.php?action=login" method="post">
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
          <div class="form-group">
            &nbsp&nbsp&nbsp&nbsp
            <input class="form-check-input" type="checkbox" name="remember" value="1"> <label class="form-check-label">Remember me</label>
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
