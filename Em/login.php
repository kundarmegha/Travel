<?php
session_start();
$flag=1;
 if(isset($_POST['login']))
 {
$eid = $_POST['eid'];
$password = $_POST['password'];

if (!(preg_match("/^(spec)[0-9]{3}$/i", $eid)))
{
    $eiderr='* Enter the valid eid *';
    $flag=0;
}
// if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
//     $paswerr='* password constraints doesn't match *';
//     $flag=0;
// }

if($flag==1)
{
require('dbFunc.php');
$dbObj=new dbFunc();
$id=$dbObj->loginprocess($eid, $password);

$table="profile";
$field=array('firstname','lastname','email','dob','address');
$where="eid";
$dbObj->getdata($table,$field,$where,$id);

$table="work_details";
$field=array('position','project','experience','status');
$where="eid";
$dbObj->getdata($table,$field,$where,$id);

$table="intrest_details";
$field=array('intrests');
$where="eid";
$dbObj->getdata($table,$field,$where,$id);

$table="knowledge_details";
$field=array('knowledge');
$where="eid";
$dbObj->getdata($table,$field,$where,$id);

$table="hobby_details";
$field=array('hobbies');
$where="eid";
$dbObj->getdata($table,$field,$where,$id);
echo "<script>location.href='dashboard.php'</script>";
}
 }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <script src="main.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
</head>

<body>
    <header>
        <h2>Welcome to the company</h2>
        <div class="login">
          Don't have an account?  <a href="index.php"><button class="btn btn-danger">Signup</button></a>
        </div>
    </header>
    <section >    
            <h1 class="col-md-12 text-center">
            <span class="label label-danger"  style="text-align:center;">Login
            </h1></div><br><br>
        <form action="login.php" method="post"  class="col-md-4 col-md-offset-4"><br><br>
        <span class="error"><?php echo  $eiderr; ?> </span><br>
         <input type="text"  name="eid"   class="form-control" placeholder="Enter the EID" maxlength="7" required><br>
         <span class="error"><?php echo $paswerr; ?> </span><br>
         <input type="password"  name="password"   class="form-control" placeholder="Enter Password" required><br>
        <button type="submit" name="login" class="form-control btn btn-danger">Let's Go</button><br><br>
        </form>
    </section>
</body>
</html>