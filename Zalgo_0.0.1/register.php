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
      require_once "header.php";
      require_once "common/common.php";
      require_once "includes/conn.inc.php";
      // store user info
      $data = array();
      // if we receive post data, process it
      if (isset($_GET['action'])){
        session_start();
        if ($_GET['action'] == "reg"){
          // check if this device registered more than 5 accounts
          $reg_sql = "select username FROM user_info WHERE reg_ip = '{$_SERVER['REMOTE_ADDR']}';";
          if(count(multi_ret_query($conn,$reg_sql)) >= 5){
            _url_back("register.php","You have already registered the maximum number of accounts!");
            exit();
          }

          // check auth code
          if(isset($_POST['authcode'])){
            if (!($_POST['authcode'] == $_SESSION['auth_code'])){
              _url_back("register.php","Your auth code is not correct, please try again!");
              exit();
            }
          }else{
            _url_back("register.php","Unauthorized operations!");
            exit();
          }
          // clean auth code cache
          if(isset($_SESSION["auth_code"])){
            unset($_SESSION["auth_code"]);
          }
          // check uniqid
          if(!isset($_POST['uniqid'])){
              _url_back("register.php","Unauthorized operations!");
              exit();
          }
          if(!($_POST['uniqid'] == $_SESSION['uniqid'])){
            _url_back("register.php","Unauthorized operations!");
            exit();
          }
          $data['uniqid'] = $_SESSION['uniqid'];
          // clean uniqid cache
          if(isset($_SESSION['uniqid'])){
            unset($_SESSION['uniqid']);
          }
          // receive Username
          if (isset($_POST['username'])){
            $data['username'] = _username_clean("register.php",$_POST['username'],20,2);
            // check if username has been taken
            if(!ret_query($conn,"select username from user_info where username = '".$data['username']."';") == null){
              _url_back("register.php","Sorry, this username has been taken!");
              exit();
            }
          }else{
            _url_back("register.php","Please fill username!");
            exit();
          }
          // receive gender
          if (isset($_POST['gender'])){
            $data['gender'] = _gender_clean($_POST['gender']);
          }else{
            _url_back("register.php","Please select a gender option!");
            exit();
          }
          // receive Password
          if (isset($_POST['password']) && isset($_POST['repassword'])){
            $data['password'] = _password_clean("register.php",$_POST['password'],$_POST['repassword'],30,3);
          }else{
            _url_back("register.php","Please fill password!");
            exit();
          }
          // receive Email
          if (isset($_POST['email'])){
            if($_POST['email'] != "" || $_POST['email'] != null){
              $data['email'] = _email_clean("register.php",$_POST['email'],30,4);
            }
            else{
              $data['email'] = "";
            }
          }

          // write in database
          $reg_query = "insert into user_info
          (username, uniqid, gender, email, reg_time, last_login_time, reg_ip, last_login_ip, password)
          values ('{$data['username']}','{$data['uniqid']}','{$data['gender']}','{$data['email']}',
          now(),now(),'{$_SERVER['REMOTE_ADDR']}','{$_SERVER['REMOTE_ADDR']}','{$data['password']}');";
          if(void_query($conn,$reg_query)){
            _url_back("login.php","Success!");
          }
          else{
            _url_back("index.php","There is an error occured!");
          };

        }
      }
      else{
        // generate unique id to prevent xss
        session_start();
        $_SESSION['uniqid'] = $uniqid = sha1(uniqid(rand(),true));
      }
    ?>
    <div class="form-container">
      <form class="register-form" action="register.php?action=reg" method="post">
        <div class="login-box">
          <div class="form-group">
            <input type="hidden" name="uniqid" value="<?php echo $uniqid;?>"></input>
            <label>Username(*): </label>
            <input type="text" name = "username" class="form-control"></input>
          </div>
          <div class="form-group form-check form-check-inline">
            <label class="form-check-label">Gender(*):</label> &nbsp&nbsp&nbsp&nbsp&nbsp
            <br/>
            <input class="form-check-input" type="radio" name="gender" value="male"> <label class="form-check-label">Male</label>&nbsp&nbsp&nbsp
            <input class="form-check-input" type="radio" name="gender" value="female">  <label class="form-check-label">Female</label>&nbsp&nbsp&nbsp
            <input class="form-check-input" type="radio" name="gender" value="others">  <label class="form-check-label">Others</label>&nbsp&nbsp&nbsp
            <input class="form-check-input" type="radio" name="gender" value="private"> <label class="form-check-label">Prefer not to tell</label>
          </div>
          <div class="form-group">
            <label>Password(*): </label>
            <input type="password" name="password" class="form-control"></input>
          </div>
          <div class="form-group">
            <label>Confirm Password(*): </label>
            <input type="password" name="repassword" class="form-control"></input>
          </div>
          <div class="form-group">
            <label>Email: </label>
            <input type="email" name = "email" class="form-control"></input>
          </div>
          <label>Auth Code(*): </label>
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
  <script src="js/loginreg.js" type="text/javascript"></script>
  <script src="js/register.js" type="text/javascript"></script>
</html>
