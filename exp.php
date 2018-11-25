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

              if (!file.name.match(/.(jpg|jpeg|png|gif)$/i)){
               alert('Please enter the image');
               $("#image_file").val('');
              }

            });

        });
     
        function readURL(input) {
            
            if (input.files && input.files[0]) {

                var reader = new FileReader();
               // var object = new ActiveXObject("Scripting.FileSystemObject");

                // var file_name=getFile(image_file.value);
                // var file = object.GetFile();
                //     file.Move("uploads/");
                //     alert("File is moved successfully");

                reader.onload = function (e) {
                    if(! ($("#image_file").value='')){
                    $('#blah').attr('src', e.target.result);
                    document.getElementById("blah").style.display="block";
                    document.getElementById("blacknwhite").style.display="block";
                    document.getElementById("toaster").style.display="block";
                    document.getElementById("nashville").style.display="block";
                    document.getElementById("lomo").style.display="block";
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }

        }

        function grayscale(filter){

            var f = document.getElementById( 'image_file' ).value;
            f=f.split("\\").pop();

            $.post("file2.php",
            {
                name:filter,
                url:f
            },
            function(data, status){
    
               //alert("Data: " + data + "\nStatus: " + status);
                    $('#blah').attr('src', data);
                    document.getElementById("blah").style.display="block";
                    
            });

        }

    </script>

</head>

<body>

    <form method="post" enctype="multipart/form-data">

    <input type="file" id="image_file" name="file" onchange="readURL(this);" /><br/>

    <img id="blah" src="#" alt="your image" id="display_image" style="display:none;height:300px;width:400px;"/>
    <input type="button" name="blacknwhite" id="blacknwhite" style="display:none;" value="Greyscale" onclick="grayscale('gray')">
    <input type="button" name="toaster" id="toaster" style="display:none;" value="toaster" onclick="grayscale('toaster')">
    <input type="button" name="nashville" id="nashville" style="display:none;" value="nashville" onclick="grayscale('nashville')">
    <input type="button" name="lomo" id="lomo" style="display:none;" value="lomo" onclick="grayscale('lomo')">
    <!-- <input type="button" name="kelvin" id="kelvin" style="display:none;" value="kelvin" onclick="grayscale('kelvin')"> -->
    <input type="submit">

    </form>

</body>
</html>