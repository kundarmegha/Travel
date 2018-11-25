<?php
require_once ('dbFunc.php');
$obj = new dbFunc();
$user = "deeksha";
$sid = 2;
$select = "`like`";
$lrow = $obj->like_check($sid,$user,$select);
$select = "dislike";
$drow = $obj->like_check($sid,$user,$select);
$like=$lrow['like'];
$dislike=$drow['dislike'];
$lcheck = "`like`";
$lcount = $obj->like_count($sid,$user,$lcheck);
$dcheck = "dislike";
$dcount = $obj->like_count($sid,$user,$dcheck);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script>
        $(document).ready(function() {
            $("#like").click(function(e) {
                var like;
                var dislike;
                if ( $("#dislike").hasClass( "pressed" )) {
                    $('#like').toggleClass('pressed not_pressed'); like=1;dislike=0;
                    $('#dislike').toggleClass('pressed not_pressed');dislike=0;
                }
                else {
                    $('#like').toggleClass('pressed not_pressed');
                    if ($("#like").hasClass("pressed")){
                        like = 1;dislike=0;
                        }
                    else {
                        like = 0;dislike=0;
                    }
                }
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: {"like": like, "dislike": dislike},
                    success: function(response){
                        var res = (JSON.parse(response));
                        $("#lcount").html(res.lcount);
                        $("#dcount").html(res.dcount);
                    }
                });
            });
            $("#dislike").click(function(e) {
                if ( $("#like").hasClass( "pressed" )) {
                    $('#dislike').toggleClass('pressed not_pressed');dislike=1;like=0;
                    $('#like').toggleClass('pressed not_pressed');like=0;
                }
                else {
                    $('#dislike').toggleClass('pressed not_pressed');
                    if ( $("#dislike").hasClass( "pressed" )) {
                        dislike = 1;like=0
                    }
                        else {
                        dislike = 0;like=0;
                    }
                }
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: {"like": like, "dislike": dislike},
                    success: function(response){
                        var res = (JSON.parse(response));
                        $("#lcount").html(res.lcount);
                        $("#dcount").html(res.dcount);                    }
                });
            });
        });
    </script>
</head>
<body>
<div class="col-sm-4">
    <span class="<?php if($like==1) {echo "pressed" ;} else { echo "not_pressed";} ?>" id="like"><i class="fa fa-thumbs-up" ></i></span>
    <span id="lcount"><?php echo $lcount ?></span>
    <span class="<?php if($dislike==1) echo "pressed" ; else echo "not_pressed";?>" id="dislike"><i class="fa fa-thumbs-down" ></i></span>
    <span id="dcount"><?php echo $dcount ?></span></div>
</body>
</html>
