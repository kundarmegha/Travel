<?php
if(isset($_POST['register']))
{
$fullname=$_POST['fullname'];
$fullname=strtoupper($fullname);
$email=$_POST['email'];
$eid=$_POST['eid'];
$eid=strtoupper($eid);
$password=$_POST['password'];
$confirm=$_POST['confirm'];
$dob=$_POST['dob'];
$address=$_POST['address'];
$position=$_POST['position'];
$project=$_POST['project'];
$experience=$_POST['experience'];
$intrest=$_POST['intrest'];
$knowledge=$_POST['knowledge'];
$hobbies=$_POST['hobbies'];
$flag=1;
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
if (!(preg_match("/^.+[a-z]$/i", $lastname)))
{
    $lasterr='* Enter the valid lastname *';
    $flag=0;
}
if(!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $mailerr='* Enter the valid mail *';
    $flag=0;
}
if (!(preg_match("/^(spec)[0-9]{3}$/i", $eid)))
{
    $eiderr='* Enter the valid eid *';
    $flag=0;
}

// if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9][A-Za-z][!@#$%]{8,12}$/', $password)) {
//     $paswerr='* password constraints doesn\'t match *';
//     $flag=0;
// }

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
$field = array("eid","password");
$data = array($eid,$password);
$dbObj->Insertdata($table,$field,$data);

$table = "profile";
$field = array("eid","firstname","lastname","email","dob","address");
$data = array($eid,$firstname,$lastname,$email,$dob,$address);
$dbObj->Insertdata($table,$field,$data);

$table = "work_details";
$field = array("eid","position","project","experience");
$data = array($eid,$position,$project,$experience);
$dbObj->Insertdata($table,$field,$data);

// $table = "personal_details";
// $field = array("eid","intrests","knowledge","hobbies");
// $data = array($eid,$intrest,$knowledge,$experience);
// $dbObj->Insertdata($table,$field,$data);

$intrest=explode(',',$intrest);
$table = "intrest_details";
$field = array("eid","intrests");
$n=sizeof($intrest);
for($i=0;$i<$n;$i++)
{
$data = array($eid,$intrest[$i]);
$dbObj->Insertdata($table,$field,$data);
}

$hobbies=explode(',',$hobbies);
$table = "hobby_details";
$field = array("eid","hobbies");
$n=sizeof($hobbies);
for($i=0;$i<$n;$i++)
{
$data = array($eid,$hobbies[$i]);
$dbObj->Insertdata($table,$field,$data);
}


$knowledge=explode(',',$knowledge);
$table = "knowledge_details";
$field = array("eid","knowledge");
$n=sizeof($knowledge);
for($i=0;$i<$n;$i++)
{
$data = array($eid,$knowledge[$i]);
$dbObj->Insertdata($table,$field,$data);
}
echo "<script>alert('registration successful');location.href='login.php'</script>";
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
          Already have an account?  <a href="login.php"><button class="btn btn-danger">Login</button></a>
        </div>
    </header>
    <section >    
            <h1 class="col-md-12 text-center">
            <span class="label label-danger"  style="text-align:center;">Employee registration
            </h1></div><br><br>
        <form action="index.php" method="post" name="register" class="col-md-4 col-md-offset-4"><br><br>
        <span class="error"><?php echo $firerr ;  ?></span> <br>
        <span class="error"><?php echo $lasterr ;  ?></span> <br>
        <input type="text" name="fullname" placeholder="Enter the fullname" value="<?php echo $_POST['fullname'];?>"
        class="form-control"
         required><br><span class="error"><?php echo $mailerr ?> </span><br>
         <input type="email" name="email" value="<?php echo $_POST['email'];?>" class="form-control" placeholder="Enter the Email" required><br>
         <span class="error"><?php echo $eiderr ?> </span><br>
         <input type="text"  name="eid" value="<?php echo $_POST['eid'];?>"  class="form-control" placeholder="Enter the EID" maxlength="7" required><br>
         <span class="error"><?php echo $paswerr ?> </span><br>
         <input type="password"  name="password"   class="form-control" placeholder="Enter Password" required><br>
         <span class="error"><?php echo $passerr ?> </span><br>
         <input type="password"  name="confirm"   class="form-control" placeholder="Confirm password" required><br>
         <input type="date"  name="dob" value="<?php echo $_POST['dob'];?>" class="form-control" placeholder="Enter the Date of birth" required><br>
         <input type="text"  name="address" value="<?php echo $_POST['address'];?>"  class="form-control" placeholder="Enter adress" maxlength="300" required><br>        
         <select name="position" class="form-control">
                <option value="" disabled selected>Select your Position</option>
               <option value="ceo">CEO</option>
               <option value="cto">CTO</option>
               <option value="coo">COO</option>
               <option value="devloper">Devloper</option>
               <option value="tester">Tester</option>
               <option value="dev-op">Dev-Op</option>
         </select><br>
         <input type="text"  name="project" value="<?php echo $_POST['project'];?>"  class="form-control" placeholder="Enter the Project"><br>
         <input type="number" name="experience" value="<?php echo $_POST['experience'];?>" class="form-control" placeholder="enter the experience" maxlength="2" required><br>
         <input type="text" name="intrest" value="<?php echo $_POST['intrest'];?>" class="form-control" placeholder="enter the intrests"><br>
         <input type="text" name="knowledge" value="<?php echo $_POST['knowledge'];?>" class="form-control" placeholder="enter the knowledge"><br>
         <input type="text" name="hobbies" value="<?php echo $_POST['hobbies'];?>" class="form-control" placeholder="enter the hobbies"><br>
        <button type="submit" class="form-control btn btn-danger" name="register">Hell yeah!</button><br><br>
        </form>
    </section>
</body>
</html>