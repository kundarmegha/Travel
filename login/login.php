<?php
require('database.php');
$username = $_POST['uname'];
$password = $_POST['pasw'];
//$where=$username;
//$selection="username";
//$table = "login_details";
//$field = array("username","password");
//retrieve($table,$field,$where,$selection);

$id=loginprocess($password, $username);

$table="profile";
$field=array('firstname','lastname','photo','email','age','dob','gender');
$where="id";
getdata($table,$field,$where,$id);

$table="Academics";
$field = array("sslc","pu","engineering","id");
$where="id";
getdata($table,$field,$where,$id);

$table="contact_info";
$field = array("mobile","address","country","state","pincode","id");
$where="id";
getdata($table,$field,$where,$id);

?>