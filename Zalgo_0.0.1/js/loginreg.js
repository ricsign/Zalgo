
// refresh code
window.onload = function(){
  // refresh code when window loads for security reason
  document.getElementById("code_pic").src="includes/authcode.inc.php";document.getElementById("code_pic").src="includes/authcode.inc.php";document.getElementById("code_pic").src="includes/authcode.inc.php";

  document.getElementById("code_refresh").onclick = function(event){
    document.getElementById("code_pic").src="includes/authcode.inc.php";
  };
};
