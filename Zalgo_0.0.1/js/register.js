
document.getElementsByClassName("register-form")[0].onsubmit = function(){
  // js validation
  // check if username is valid
  if(isvalid_username() == false){
    return false;
  }
  if(isvalid_gender() == false){
    return false;
  }
  if(isvalid_password() == false){
    return false;
  }
  if(isvalid_email() == false){
    return false;
  }
  if(isvalid_authcode() == false){
    return false;
  }
};
