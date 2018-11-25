<?php
require_once('database.php');
$FullName=$_POST['fullname'];
$FullName= trim($FullName);
$Email=$_POST['email'];
$email = trim($Email);
$Phone=$_POST['phone'];
$Phone = trim($Phone);
$FirstAddress=$_POST['paddress'];
$FirstAddress = trim($FirstAddress);
$birth_date=$_POST["dateofbirth"];
$pincode=$_POST['pincode'];
$Gender = $_POST["Gender"];
$username = $_POST["uname"];
$Password= $_POST["pasw"];
$ConfirmPassword= $_POST["ConfirmPassword"];
$expert= $_POST["expert"];
$sslc= $_POST["sslc"];
$sslc = trim($sslc);
$pu= $_POST["pu"];
$pu = trim($pu);
$engineering= $_POST["engineering"];
$engineering = trim($engineering);

$country=$_POST["country"];
$state=$_POST["state"];

$photo = $_FILES['file']['name'];

$filepath="upload/".$photo;
$up=move_uploaded_file($_FILES["file"]["tmp_name"] , "$filepath");
if(!$up)
{
    echo'image not uploaded';
}

validate($FullName,"name");
validate($email,"mail");
validate($Password,"password");
validate($ConfirmPassword,"confirm password");

//if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{12,20}$/', $Password)) {
//    echo 'the password does not meet the requirements!<br>';
//    exit(1);
//}
//else {
    $password = password_hash($Password, PASSWORD_DEFAULT);
    if (password_verify($ConfirmPassword, $password)) {
    } else {
        echo 'Invalid password<br>';
        exit(1);
    }
//}

function validate($variable,$str)
{
    if (empty($variable)) {
                echo "Enter valid value for $str"."<br />";
                exit(1);
    }
}
$date=date('Y-m-d');
$datetime1 = date_create($date);
$datetime2 = date_create($birth_date);
$dob = $datetime2->getTimestamp();
$interval = date_diff($datetime1, $datetime2);
$age=$interval->format('%y Year %m Month %d Day');


$mailid=strchr($email,"@");
$maildomain=ltrim($mailid,"@");
$lastnametrue=str_word_count($FullName);
if ($lastnametrue==1)
{
    echo "Enter the last name";
    exit(1);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "invalid email";
    exit(1);
}


$avg = ( $sslc + $pu + $engineering ) / 3;
if(($sslc < 60 && $pu < 60 && $engineering<60) && $avg<65)
{
    echo "Marks doesnot satisfy";
    exit(0);
}

if(strlen($Phone) != 10)
{
    echo "Enter the valid mobile number <br>";
    exit(1);
}
$name = explode(" ", "$FullName", 2);
$firstname = $name[0];
$lastname = $name[1];

$table = "login_details";
$field = array("username","password");
$data = array($username,$password);
$insert=Insertdata($table,$field,$data);

$table = "profile";
$field = array("firstname","lastname","email","dob","age","photo","gender","id");
$data = array($firstname,$lastname,$email,$dob,$age,$filepath,$Gender,$insert);
Insertdata($table,$field,$data);


$table = "Academics";
$field = array("sslc","pu","engineering","id");
$data = array($sslc,$pu,$engineering,$insert);
Insertdata($table,$field,$data);


$table = "contact_info";
$field = array("mobile","address","country","state","pincode","id");
$data = array($Phone,$FirstAddress,$country,$state,$pincode,$insert);
Insertdata($table,$field,$data);

//$table="Academics";
//$field = array("sslc","pu","B.E","id");
//$data = array($sslc,$pu,$engineering,$insert);
//Insertdata($table,$field,$data);

if(isset($_POST["submit"])) {

}

?>