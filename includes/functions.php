<?php

function emptyInputSignup($name, $email, $id, $password, $cpassword,){
    $result;
    if(empty($name) || empty($email) || empty($id) || empty($password) || empty($cpassword)){
    $result = true;
  }
  else{
    $result = false;
  }
  return $result;
 }
 
  function invalidName($name){
    $result;
    if(!preg_match("/^[a-zA-Z]*$/", $name)){
    $result = true;
  }
  else{
    $result = false;
  }
  return $result;
 }
 
  function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $result = true;
  }
  else{
    $result = false;
  }
  return $result;
 }
 
 
 function pwdMatch($password,$cpassword){
   $result;
   if($password !== $cpassword){
   $result = true;
 }
 else{
   $result = false;
 }
 return $result;
 }

 function idlength($id){
   $result;
   if(strlen($id) < 12)
   {
      $result = true;
   }
   else
   {
    $result = false;
   }
   return $result;
  }

 
  function numberonly($id){
    $result;
  if(!preg_match("/^[0-9]*$/", $id))
  {
    $result = true;
  }
  else
  {
    $result = false;
  }
  return $result;
}
 

function uidExists($conn,$id,$email){
  $sql = "SELECT * FROM users WHERE usersStudentID = ? OR usersEmail = ?;";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$sql)){
    $result = true;
  }
  else{
    $result = false;
  }
  return $result;
}


  

 

?>