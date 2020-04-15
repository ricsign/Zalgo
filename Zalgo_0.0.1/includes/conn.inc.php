<?php
define('ROOT_DIR',$_SERVER['DOCUMENT_ROOT']."/Projects/Zalgo/Zalgo_0.0.1/");
require_once ROOT_DIR."common/common.php";
//check if includes constant
if(!defined('DB_ACC')){
  _back();
  exit();
}

define("DB_USER","root");
define("DB_PASSWORD","");
define("DB_HOST","127.0.0.1:3306");
define("DB_NAME", "zalgo");

$conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

// check if correctly connected
if (!$conn){
  die("Server error, please try again!");
}


//==============================================================================
//==============================================================================
//==============================================================================
// functions area

function release($conn){
  $conn->close();
}


//query without return
function void_query($conn,$sql){
  $result = $conn->query($sql);
  return $result;
}


// query with return
function ret_query($conn,$sql){
  $result = $conn->query($sql);
  if($result == false){
    echo "Server Error";
  }else{
    //if it has data set
    if ($result->num_rows > 0){
      return $result->fetch_array();
    }
    // else return null
    else{
      return null;
    }
  }

}

?>
