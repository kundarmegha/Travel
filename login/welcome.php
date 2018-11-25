<?php
    //ob_start();
session_start();
$first=$_SESSION['firstname'];
$last=$_SESSION['lastname'];
$photo=$_SESSION['photo'];
$email=$_SESSION['email'];
$age=$_SESSION['age'];
$dob = date("d-m-Y",$_SESSION['dob']);
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800))
{

    echo "<script>location.href='login.html'</script>";
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time();
if(isset($_POST['logout']))
{
    session_destroy();
    unset($_SESSION['username']);
    echo "<script>location.href='login.html'</script>";
}
?>

<html>
<head>
    <link rel="stylesheet" href="css/style.css">
<title></title>
</head>
<body>
<div class="hero-section">
<div class="banner">
<img src="<?php echo $photo?>">
</div>
    <div class="text-region">
<span style="font-size: 30px; font-weight: bold;">
    <?php echo $first ." ". $last?>
</span>
<span><?php echo $email ?></span><br>
<span><?php echo $age ?></span><br>
<span><?php echo $dob ?></span><br>
        <form action="welcome.php" method="post">
            <button type="submit" class="logout"  name="logout">Logout</button><br /><br />
        </form> <form action="edit.php" method="post">
            <button type="submit" class="logout"  name="edit">edit</button><br /><br />
        </form>
    </div>
</div>
</body>
</html>
