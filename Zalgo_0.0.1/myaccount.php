<?php
# import documents
require_once "common/common.php";
if (!defined("COOKIE_SALT_VAL")){
  define("COOKIE_SALT_VAL","O#ur42WBe@S3)2i|tES2*&eCu#r@iTy3/2IsoK9.32Y8e3s");
}

//delete cookie
if(isset($_COOKIE["username"]) && isset($_COOKIE["userkey"])){
  setcookie ("username","", time() - 100);
  setcookie ("userkey","", time() - 100);
  _url_back("index.php");
}


 ?>
