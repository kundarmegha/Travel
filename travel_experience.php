<?php

     class A{

        // public $file_name=$_FILES['file']['tmp_name'];

        function filters(){
            $fileReader=new FileReader();
           // $file=convert linuxcareer-$filename -colorspace gray linuxcareer-color-$filename;
        }

        function negateImage($imagePath, $grayOnly, $channel) {
            echo $_FILES['file']['tmp_name'];
            $imagick = new \Imagick(realpath($imagePath));
            $imagick->negateImage($grayOnly, $channel);
            header("Content-Type: image/jpg");
            echo $imagick->getImageBlob();
        }

        function blur_image(){
            header('Content-type: image/jpeg');

            $image = new Imagick('test.jpg');

            $image->adaptiveBlurImage(5,3);
            echo $image;
        }

        function multi_function($color){
            switch($color){
                case 'blacknwhite':
            }
        }

     }
    //  if($_FILES['file']['name']){
    //     header('Content-type: image/jpeg');

    //     $image = new Imagick($_FILES['file']['name']);

    //     $image->adaptiveBlurImage(5,3);
    //     echo $image;
    //  }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
    
      $(function(){
      
           $('#image_file').change(function(){

              var fileReader=new FileReader();

              var file=this.files[0];
        
              alert($_FILES['file']['tmp_name']);

              if (!file.name.match(/.(jpg|jpeg|png|gif)$/i)){
               alert('Please enter the image');
               $("#image_file").val('');
              }

            });

        });

        function readURL(input) {
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                    document.getElementById("blah").style.display="block";
                    document.getElementById("blacknwhite").style.display="block";
                }

                reader.readAsDataURL(input.files[0]);
            }

        }

    </script>
</head>
<body>

    <form method="post" enctype="multipart/form-data">

    <input type='file'id="image_file" name="file" onchange="readURL(this);" /><br/>
    <img id="blah" src="#" alt="your image" id="display_image" style="display:none;height:300px;width:400px;"/>
    <input type="button" name="blacknwhite" id="blacknwhite" style="display:none;" value="Greyscale" onclick="<?php $a=new A();$a->multi_function("blacknwhite");?>">
    <input type="submit">

    </form>

</body>
</html>