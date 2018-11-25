<?php
session_start();
if (empty($_SESSION['eid'])) {
    header('Location: login.php');
    exit;
}

$eid =$_SESSION['eid'];
$first=$_SESSION['firstname'];
$last=$_SESSION['lastname'];
$location=$_SESSION['status'];
$email=$_SESSION['email'];
$dob = date("d-m-Y",$_SESSION['dob']);
$addres=$_SESSION['address'];
$experience=$_SESSION['experience'];
$intrests=$_SESSION['intrests'];
$knowledge=$_SESSION['knowledge'];
$hobbies=$_SESSION['hobbies'];
if(isset($_POST[update]))
{
    if(isset($_POST['status']))
    {
    $status = $_POST['status'];
    require_once('dbFunc.php');
    $obj = new dbFunc();
    $table_name = 'work_details';
    $table_id = 'eid';
    $form_data = array(
        'status'=> $status
        );
   $update = $obj->update_data($table_name,$form_data,$table_id,$eid);

//    $field=array('status');
//    $where="eid";
//    $obj->getdata($table_name,$field,$where,$eid);
    $_SESSION['status']=$_POST['status'];
   echo "<script>location.href='dashboard.php'</script>";
}
}
if(isset($_POST[logout]))
{
    session_destroy();
    unset($_SESSION['eid']);
    echo "<script>location.href='login.php'</script>";
}
if(isset($_POST[find]))
{
$_SESSION['find']=1;
}
if(isset($_POST[reset]))
{
$_SESSION['find']=0;
}
if(isset($_POST[profile]))
{
    $_SESSION['find']=0;
}
if($_SESSION['find']==1)
{
 $seid = $_POST['seid'];
 $_SESSION['seid']=$seid;
 if (!(preg_match("/^(spec)[0-9]{3}$/i", $seid)))
{
    $_SESSION['find']=0;
    $eiderr="Enter the valid Eid";
}
 $field = array("eid","firstname","lastname","email","dob","address");
require_once('dbFunc.php');
$obj = new dbFunc();
$table='profile';
$res = $obj->fetch_data($seid,$field,$table);
$fir = $res['firstname'];
$slast = $res['lastname'];
$semail =$res['email'];
$sdob = date("d-m-Y",$res['dob']);
$saddres=$res['address'];

$table='work_details';
$field = array("eid","status");
$res = $obj->fetch_data($seid,$field,$table);
$slocation=$res['status'];


$table='hobby_details';
$field = array("eid","hobbies");
$res = $obj->fetch_data($seid,$field,$table);
$shobbies=$res['hobbies'];

$table='knowledge_details';
$field = array("eid","knowledge");
$res = $obj->fetch_data($seid,$field,$table);
$sknowledge=$res['knowledge'];

$table='intrest_details';
$field = array("eid","intrests");
$res = $obj->fetch_data($seid,$field,$table);

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/dash.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    let isSubmitted=false;
$(document).ready(function() {
$("#more").click(function(e) {
//    e.preventDefault();
  $.ajax({   
    type: "POST",
    url: "ajax.php",
    success: function(response){
      
         $("#show").html(response);
        // alert(response);
        $("#more").hide();
    }
});
    return false;
});
});
</script>
</head>
<body>
<header>
    <div class="col-md-6">
        <h2>Welcome <?php echo $first;?></h2>
</div>
<div class="col-md-6 text-right">
        <form action="dashboard.php" method="post" class="logout">
        <button type="submit" name="profile" class="btn btn-danger">Profile</button>
           <button type="submit" name="logout" class="btn btn-danger">Logout</button>
    </form>
</div>
    </header>
    <section class="col-md-7 col-md-offset-1">
      <div class="find text-center">
       <h3 class="text-center" > Who are you looking for?</h3>
       <span class="error"><?php echo $eiderr ?></span>
       <form action="dashboard.php" method="post">
       <input type="text" name="seid" class="text-center"  <?php
        if($_SESSION['find']==1)
        {
        echo "value = '$seid'";
        }
        elseif(isset($_POST['profile']))
        {
            echo "value = '$eid'";

        }
        else
        {
            echo "placeholder='Enter the eid'";
        }
       ?> required>
       <button type="submit" name="find" class="btn btn-danger">Find</button><br><br>
        <?php
        if($_SESSION['find']==1)
        {
            if(!(isset($fir)))
            {
               echo "<div class='search-details text-center'>Employee not found</div>"; 
            }
            else{
       echo "<div class='search-details'>
        Id   :  $seid <br>
        Name : $fir $slast<br>
        email:  $semail <br>
        Status: $slocation <br>
        <div id='show'></div>
        ";
       echo " </div>
       <form method='post' >";
    //    if(!isset($_POST['more']))
    //    if(isSubmitted)
       echo "
       <button name='more' id='more' class='btn btn-danger'>More</button>&nbsp;&nbsp;";
    //    if(isset($_POST['more']))       
    //    if(isSubmitted)
       echo "
       <button type='submit' name='reset' class='btn btn-danger'>Reset</button>
       </form>";
      }
       }
       
       if(isset($_POST['profile']))
        {
        echo "<div class='search-details'>
        Id :  $eid <br>
        Name: $first $last<br>
        Email:  $email <br>
        Status: $location <br>";
        echo "
         Dob: $dob<br>
         Adddress: $addres<br>
         Experience: $experience Years <br>
         Intrests: $intrests<br>
         Knowledge: $knowledge <br>
         Hobbies: $hobbies<br>
         <button type='submit' name='clear' class='btn btn-danger'>Clear</button>
        ";
       }
       ?>
</div>   
    </form> 
    </section>
    <aside class="col-md-4 status">
        <form action="dashboard.php" method="post" >
     <span class="form-control status-but"><input type="radio" name="status" value="Office" >&nbsp;&nbsp;<label for="radio">Office</label></span>
     <span class="form-control status-but"><input type="radio" name="status" value="Work from home">&nbsp;&nbsp;<label for="radio">Work from home</label></span>
     <span class="form-control status-but"><input type="radio" name="status" value="Leave">&nbsp;&nbsp;<label for="radio">Leave</label></span>
     <span class="form-control status-but"><input type="radio" name="status" value="Onsite">&nbsp;&nbsp;<label for="radio">Onsite</label></span>   
     <button class="btn btn-danger text-center" name="update">update</button> 
    </form>
    </aside>
    </body>
</html>