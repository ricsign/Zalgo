<?php
  # Prevent illegal operations
  // require_once "common/common.php";
  // if(!defined('ACC_CODE')){
  //   _back();
  //   exit();
  // }

  function auth_code($length,$pic_width,$pic_height){
    session_start();
    $code = generate_code($length);

    // store code in session
    $_SESSION["auth_code"] = $code;

    //create pic
    create_picture($code,$length,$pic_width,$pic_height);
  }


  // Random generate n-digits code
  function generate_code($length){
    // all options for auth code
    $option = "ABC1DEFG5H0IJ4KL8MNOP9QRS2T6UV7WXY3Z";
    $option_list = str_split($option);

    // randomly select code from option list
    $random_opt_list = array_rand($option_list,$length);

    // stitch together
    $code = "";
    foreach ($random_opt_list as $value) {
      $code .= $option_list[$value];
    }
    return $code;
  }

  //given code, create the picture
  function create_picture($code,$length,$pic_width,$pic_height){
    // create an image
    $img = imagecreatetruecolor($pic_width,$pic_height);

    //background color: light random color
    $bg_color = imagecolorallocate($img,mt_rand(230,255),mt_rand(230,255),mt_rand(230,255));

    //fill background
    imagefill($img,0,0,$bg_color);

    //random draw 10 lines (distractions)
    for($i=0; $i<10; $i++){
      //generate random colors for lines
      $rand_color = imagecolorallocate($img,mt_rand(100,230),mt_rand(100,230),mt_rand(100,230));
      //random position
      imageline($img,mt_rand(0,$pic_width),mt_rand(0,$pic_height),mt_rand(0,$pic_width),mt_rand(0,$pic_height),$rand_color);
    }

    //random draw 100 flakes (distractions)
    for($i=0; $i<100; $i++){
      $rand_color = imagecolorallocate($img,mt_rand(190,230),mt_rand(190,230),mt_rand(190,230));
      imagestring($img,1,mt_rand(1,$pic_width),mt_rand(1,$pic_height),'*',$rand_color);
    }

    //write the auth code on the image
    for($i=0; $i<strlen($_SESSION['auth_code']); $i++){
      imagestring($img,mt_rand(4,5),$i*$pic_width/$length+mt_rand(1,10),mt_rand(1,$pic_height/2),$_SESSION['auth_code'][$i],imagecolorallocate($img,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200)));
    }




    //output image
    header("Content-Type:image/png");
    imagepng($img);

    //destroy image
    imagedestroy($img);
  }






auth_code(6,150,32);

 ?>
