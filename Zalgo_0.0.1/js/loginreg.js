// refresh code when window loads for security sake
document.getElementById("code_pic").src="includes/authcode.inc.php";document.getElementById("code_pic").src="includes/authcode.inc.php";
document.getElementById("code_refresh").onclick = function(){
  document.getElementById("code_pic").src="includes/authcode.inc.php";
};

// check if username is valid
function isvalid_username(){
  var username = document.getElementsByName("username")[0];
  if(username.value=="" || username.value.length < 2 || username.value.length > 20){
    alert("Username is too long or too short!");
    return false;
  }
  var sensitive_pattern = /[<>\'\"\\%]/;
  if (sensitive_pattern.test(username.value)) {
    alert('Username may conatin sensitive characters, please try again!');
    username.value="";
    return false;
  }
  return true;
}


// check if gender is valid
function isvalid_gender(){
  var gender = document.getElementsByName("gender");
  for(var i = 0; i < gender.length; i++){
    if(gender[i].checked){
      return true;
    }
  }
  alert('Please select a gender option!');
  return false;
}


// check if password is valid
function isvalid_password(){
  var password = document.getElementsByName("password")[0].value;
  var repassword = document.getElementsByName("repassword")[0].value;
  if(password.length < 3 || password.length > 30){
    alert("Password is too long or too short!");
    return false;
  }
  if (password != repassword){
    alert("Your passwords are different!");
    return false;
  }
  return true;
}


// check if email is valid
function isvalid_email(){
  var email = document.getElementsByName("email")[0].value;
  if(email != "" && email != null && email != undefined){
    if(email.length < 4 || email.length > 40){
      alert("Email is too long or too short!");
      return false;
    }
    var sensitive_pattern = /[<>\'\"\\%]/;
    if(sensitive_pattern.test(email)){
      alert("Email may conatin sensitive characters, please try again!");
      return false;
    }
    // email validate
    var email_match = /([\w\-]+\@[\w\-]+\.[\w\-]+)/;
    if (email_match.test(email) == false) {
      alert("Invalid Email format!");
      return false;
    }
  }
  return true;
}


// check if auth code is valid
function isvalid_authcode(){
  var authcode = document.getElementsByName("authcode")[0].value;
  if(authcode.length != 6){
    alert("Your auth code is not correct, please try again!");
    return false;
  }
  return true;
}
