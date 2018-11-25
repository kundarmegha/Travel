<?php
session_start();
if (empty($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
if(isset($_POST[logout]))
{
    echo  "guru";
    session_destroy();
    unset($_SESSION['username']);
    echo "<script>location.href='login.php'</script>";
}
$username =$_SESSION['username'];
$first=$_SESSION['firstname'];
$last=$_SESSION['lastname'];
$email=$_SESSION['email'];
$dob = date("d-m-Y",$_SESSION['dob']);
include("data.php");
$y = new Connect();
$res = $y->search();



          ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link  rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="col-md-12 main-container">
    <div>
        <div class="col-md-6 col-sm-6 headerstyle">
            <a href="viewStories.php" >  <img src="logo.png" class="logo">
        </div>
        <div class="col-sm-5 headerstyle text-right">
            <a href="stories.php" ><button type="submit" name="addstory" class="btn btn-danger">Add a story</button></a>
        </div>
        <div class="col-sm-1 headerstyle text-right">
        <form action="viewStories.php" method="post">
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form></div><h1 class="bannertitle">Traveling stories</h1>
    </div>
    <img src="slider-1.jpg" class="centerview">
</div>
    <div class="col-md-12" ><h2 class="moreDetailtiyle">Stories</h2>
<?php
foreach($res as $row)
   {

          $title = $row['title'];
          $description = $row['description'];
          $photo = $row['photo'];
          ?>

    <div class="col-md-3 story-container"  id="story">
    <a href="details.php?id=<?php echo $row['id'];?>"><h2 class="storytitle"><?php echo substr($title, 0, 10);?></h2>
    <img src="<?php echo $photo;?>"  class="center">
    </div>


    <?php
  }
  ?>
  </div>
    </div>
</body>
</html>
