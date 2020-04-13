<?php
  // _back
  // to return to the last page visited
  // $message: message send back
  function _back($message = null){
    echo "<script>";
    if ($message){
      echo "alert('".$message."');";
    }
    echo "window.history.back(-1);
          </script>";
  }


  function _url_back($url,$message = null){
    echo "<script>";
    if ($message){
      echo "alert('".$message."');";
    }
     echo "window.location.href='".$url."';</script>";
  }


  function _username_clean($ret_url,$string,$max_length,$min_length){
    // trim blanks from both side
    $string = trim($string);
    //check length
    if(mb_strlen($string,'utf-8') < $min_length || mb_strlen($string,'utf-8') > $max_length){
      _url_back($ret_url,"Username is too long or too short!");
      exit();
    }
    // trim sensitive characters
    $sensitive_pattern = '/[<>\'\"\\%]/';
    if(preg_match($sensitive_pattern,$string)){
      _url_back($ret_url,"Username may conatin sensitive characters, please try again!");
      exit();
    }
    // return mysql_real_escape_string($string);
    return $string;
  }


  function _gender_clean($value){
    if ($value == "male"){
      return 0;
    }
    else if ($value == "female"){
      return 1;
    }
    else if ($value == "others"){
      return 2;
    }
    else{
      return 3;
    }
  }


  function _password_clean($ret_url,$password,$repassword,$max_length,$min_length){
    // trim blanks from both side
    $password = trim($password);
    $repassword = trim($repassword);
    //check length
    if(mb_strlen($password,'utf-8') < $min_length || mb_strlen($password,'utf-8') > $max_length){
      _url_back($ret_url,"Password is too long or too short!");
      exit();
    }
    // check if password == Confirm
    if($password != $repassword){
      _url_back($ret_url,"Your passwords are different!");
    }
    return password_hash($password, PASSWORD_DEFAULT);
  }


  function _email_clean($ret_url,$email,$max_length,$min_length){
    // trim blanks from both side
    $email = trim($email);
    //check length
    if(mb_strlen($email,'utf-8') < $min_length || mb_strlen($email,'utf-8') > $max_length){
      _url_back($ret_url,"Email is too long or too short!");
      exit();
    }
    // trim sensitive characters
    $sensitive_pattern = '/[<>\'\"\\%]/';
    if(preg_match($sensitive_pattern,$email)){
      _url_back($ret_url,"Email may conatin sensitive characters, please try again!");
      exit();
    }
    // email validate
    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
      _url_back($ret_url,"Invalid Email format!");
    }
    // return mysql_real_escape_string($email);
    return $email;
  }

 ?>
