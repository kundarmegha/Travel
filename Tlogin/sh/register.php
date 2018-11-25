<?php
if(isset($_POST['register']))
{
$fullname=$_POST['fullname'];
$fullname=strtoupper($fullname);
$email=$_POST['email'];
$password=$_POST['password'];
$confirm=$_POST['confirm'];
$username = $_POST['username'];
$dob=$_POST['dob'];
$flag=1;
//$photo = $_FILES['file']['name'];
//$filepath="upload/".$photo;
//$up=move_uploaded_file($_FILES["file"]["tmp_name"] , "$filepath");
//if(!$up)
//{
//    echo'image not uploaded';
//}
$name = explode(" ", "$fullname", 2);
$firstname = $name[0];
if (!(preg_match("/^.+[a-z]{3,}$/i", $firstname)))
{
    $firerr='* Enter the valid firstname *';
    $flag=0;
}

$lastname = $name[1];

if(empty($lastname))
{
    $lasterr='* Enter the lastname *';
    $flag=0;
}
if (!(preg_match("/^.*[a-z]$/i", $lastname)))
{
    $lasterr='* Enter the valid lastname *';
    $flag=0;
}
if(!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $mailerr='* Enter the valid mail *';
    $flag=0;
}
//if (!(preg_match("/^*[a-z][0-9]/i", $username)))
//{
//    $eiderr='* Enter the valid username *';
//    $flag=0;
//}

 if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
     $paswerr='* password constraints doesn\'t match *';
     $flag=0;
 }

$password = password_hash($password, PASSWORD_DEFAULT);
if (!(password_verify($confirm, $password))) {
    $passerr='* password doesn\'t match *';
    $flag=0;
}
$dob = strtotime($dob);
if($flag==1)
{
include_once('dbFunc.php');
$dbObj=new dbFunc();
$table = "login_details";
$field = array("username","password");
$data = array($username,$password);
$dbObj->Insertdata($table,$field,$data);

$table = "profile";
$field = array("username","firstname","lastname","email","dob");
$data = array($username,$firstname,$lastname,$email,$dob);
$dbObj->Insertdata($table,$field,$data);

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
        <h2>Welcome to the Travelling Stories</h2>
        <div class="login">
          Already have an account?  <a href="login.php"><button class="btn btn-danger">Login</button></a>
        </div>
    </header>
    <section >    
            <h1 class="col-md-12 text-center">
            <span class="label label-danger"  style="text-align:center;">Registration
            </h1></div><br><br>
        <form action="register.php" method="post" name="register" class="col-md-4 col-md-offset-4" enctype="multipart/form-data"><br><br>
        <span class="error"><?php echo $firerr ;  ?></span> <br>
        <span class="error"><?php echo $lasterr ;  ?></span> <br>
        <input type="text" name="fullname" placeholder="Enter the fullname" value="<?php echo $_POST['fullname'];?>"
        class="form-control"
         required><br><span class="error"><?php echo $mailerr ?> </span><br>
         <input type="email" name="email" value="<?php echo $_POST['email'];?>" class="form-control" placeholder="Enter the Email" required><br>
         <span class="error"><?php echo $eiderr ?> </span><br>
         <input type="text"  name="username" value="<?php echo $_POST['eid'];?>"  class="form-control" placeholder="Enter the username" maxlength="15" required><br>
         <span class="error"><?php echo $paswerr ?> </span><br>
         <input type="password"  name="password"   class="form-control" placeholder="Enter Password" required><br>
         <span class="error"><?php echo $passerr ?> </span><br>
         <input type="password"  name="confirm"   class="form-control" placeholder="Confirm password" required><br>
         <input type="date"  name="dob" value="<?php echo $_POST['dob'];?>" class="form-control" placeholder="Enter the Date of birth" required><br>
<!--        <label >Select a file</label>-->
<!--        <input type="file" name="file"><br><br>-->
        <button type="submit" class="form-control btn btn-danger" name="register">Hell yeah!</button><br><br>
        </form>
    </section>
</body>
</html>
