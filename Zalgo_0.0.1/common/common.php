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
      _url_back($ret_url,"Username is too long or too short");
      exit();
    }
    // trim sensitive characters
    $sensitive_pattern = '/[<>\'\"\\%]/';
    if(preg_match($sensitive_pattern,$string)){
      _url_back($ret_url,"Username may conatin sensitive characters, please try again!");
      exit();
    }
    return mysql_real_escape_string($string);


  }

 ?>
