<?php
// include("data.php");
// 
include("data.php");
$id = null;
if ( !empty($_GET['id'])) {
   $id = $_GET['id'];
   
}
$res=$k->takesdetail($id);
echo $id;
$result = $res->fetch_assoc();
$title=$result['title'];
$description=$result['description'];



if(isset($_POST['update'])){
    $title = $_POST["title"];
    $description = $_POST["description"];

    $form_data = array(
        'title'=> $title,
        'description'=>$description
        
      );
    
      $table_name = 'stories';
      $x = new Connect();
      $x->updatestories("$table_name",$form_data,$id);
}
?>
<html>
    <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link  rel="stylesheet" href="css/style.css">
    <script src="ckeditor/ckeditor.js"></script>
    </head>
    <body>
    <div class="col-md-12">
       
    </div>
    <div class="col-md-6 headerstyle">
    <a href="viewStories.php" >  <img src="logo.png" class="logo">
    </div>
    <div class="col-md-6 headerstyle text-right">
            <button type="button" name="view" class="btnstyle"><a href="viewStories.php#story" >View</a></button>
    </div>

    
    <div class="col-md-6" style="margin-left:28%;">
        <form action="storiesphp.php" method="post" enctype="multipart/form-data">
        <label for="title" class="storytext">Title of story</label>
            <input type="text" id="title" name="title" value="<?php echo $title;?>" class="form-control" ><br>
            <label for="title" class="storytext">Image</label>
            <input type="file" class="form-control" name="file"><br/>
       

        <label for="description" class="storytext">Write your travelling story</label>
        <textarea id="ckedit" style="display:none";><?php echo $description ;?></textarea>
            <textarea name="description" class="ckeditor" id="#ckedit" class="form-control"></textarea><br>
            <script type="text/javascript">
         </script>
        <input name="update" type="submit" id="update" value="Update" class="form-control btnsubmit"><br><br>
        </form>
        </div>
    </body>
    </html>

