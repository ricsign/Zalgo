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


 ?>
