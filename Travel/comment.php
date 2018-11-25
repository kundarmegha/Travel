<?php
require_once('dbFunc.php');
$name = "guruss";
$comment=$_POST['comment'];
$comment = trim($comment);
$proimage = $_SESSION['proimage'];
$reply = $_POST['creply'];
$reply = trim($reply);
$pid = $_POST['pid'];
$obj = new dbFunc();
$sid = 1;
$flag = 1;
if(isset($_POST['submit']))
{
    $gcaptch_response = $_POST['g-recaptcha-response'];

    $remoteip = $_SERVER['REMOTE_ADDR'];
    $secret = '6LdumnwUAAAAAHFDUR77bYYM9o8XPhg2xJsVdNxW';
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $post_data = http_build_query(
        array(
            'secret' => $secret,
            'response' => $gcaptch_response,
            'remoteip' => $remoteip
        )
    );
    $options=array(

        // If site has SSL then
//        'ssl'=>array(
//
//            // In my case its /etc/ssl/certs/cacert.pem
//
//            'cafile'            => '/path/to/cacert.pem',
//            'verify_peer'       => true,
//            'verify_peer_name'  => true,
//        ),

        'http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $post_data
            )
    );

    $context = stream_context_create( $options );

    $result_json = file_get_contents( $url, false, $context );
    $resulting = json_decode($result_json, true);
    if($resulting['success']) {
   $flag=1;
    } else {

   $captchaerr = "captcha error";
   $flag=0;
    }

    if(!(empty($comment))) {
        $date = date('Y-m-d H:i:s');
        $date = strtotime($date);
        if (preg_match('/call|buy|poker|casino|www.|.com/i', $comment)) {
            $flag = 0;
        }
        if (preg_match('/[\' \. * " \'[0-9]/', $comment)) {
            $flag = 0;
        }
        if ($flag == 1) {
            $table = "comments";
            $field = array("sid", "name", "body", "date");
            $data = array($sid, $name, $comment, $date);
            $obj->Insertdata($table, $field, $data);
            echo "<script>location.href='comment.php'</script>";
        }
    }
}
if(isset($_POST['reply']));
{
  if(!(empty($reply))){
      $date=date('Y-m-d H:i:s');
      $date = strtotime($date);
      $table = "reply";
      $field = array("name","reply","pid","date");
      $data = array($name,$reply,$pid,$date);
      $obj->Insertdata($table,$field,$data);
      echo "<script>location.href='comment.php'</script>";

  }
}
$row = $obj-> fetch_comment($sid);
    ?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Page Title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="js/main.js"></script>
</head>
<body>
      <div class="container">
      <h2 class='page-header'>Comments</h2>
      <?php
      $count = sizeof($row);
      if ($count >= 1)
      {
           foreach ($row as $key => $value)
           {
           ?>
             <div class='row'>   
              <div class='col-md-8'>
              <section class='comment-list'>
          <!-- First Comment -->
          <article class='row'>
            <div class='col-md-2 col-sm-2 hidden-xs'>
              <figure class='thumbnail'>
                <img class='img-responsive' src='<?php echo $proimage ?>' />
                <figcaption class='text-center'>username</figcaption>
              </figure>
            </div>
            <div class='col-md-10 col-sm-10'>
              <div class='panel panel-default arrow left'>
                <div class='panel-body'>
                  <header class='text-left'>
                    <div class='comment-user'><i class='fa fa-user'></i><?php echo $value['name'] ?></div>
                    <time class='comment-date' ><i class='fa fa-clock-o'></i><?php $date =date("d-m-Y",$value['date']); echo $date; ?></time>
                  </header>
                  <div class='comment-post'>
                    <p>
                    <?php echo $value['body'] ?>
                    </p>
                  </div>
                  <p class='text-right'><a href='#' class='btn btn-default btn-sm' onclick='reply("<?php echo $key ?>")';><i class='fa fa-reply'></i> reply</a></p>

                     <?php
                     $replies = $obj-> reply_comment($key);
                     $rcount = sizeof($replies);
                     if ($rcount >= 1)
                     {
                     foreach ($replies as $rkey => $rvalue)
                     {

                     ?>
                        <div class='col-md-2 col-sm-2 hidden-xs'>
                            <figure class='thumbnail'>
                                <img class='img-responsive' src='<?php echo $proimage ?>' />
                                <figcaption class='text-center'>username</figcaption>
                            </figure>
                        </div>
                        <div class='col-md-10 col-sm-10'>
                            <div class='panel panel-default arrow left'>
                                <div class='panel-body'>
                                    <header class='text-left'>
                                        <div class='comment-user'><i class='fa fa-user'></i><?php echo $value['name'] ?></div>
                                        <time class='comment-date' ><i class='fa fa-clock-o'></i><?php $date =date("d-m-Y H:i:s",$value['date']); echo $date ?></time>
                                    </header>
                                    <div class='comment-post'>
                                        <p>
                                            <?php echo $rvalue['reply'] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>


<?php }}?>


                    <div class='row'>
            <div class='col-md-8' id='<?php echo $key ?>' style="display:none;">
                <form method='POST' action='comment.php'>
                    <input name="pid" value="<?php echo $key ?>" type="hidden"/>
                    <textarea name='creply' id='comment' class='form-control' cols='25' rows='8' maxlength='300' required></textarea>
                   <br>
                    <input type='submit' name='reply' class='btn btn-danger' value='Submit'>
                </form>
            </div>
        </div>
                  </div>
              </div>
            </div>
          </article>
          
          </section>
          </div>
           </div><?php }} ?>
        </div>
      <div class="container">
        <div class='row'>
            <div class='col-md-8'>
                <form method='POST' action='comment.php'>
                    <textarea name='comment1' id='comment1'></textarea>
                    <textarea name='comment' id='comment' class='form-control' cols='30' rows='10' maxlength='300' required></textarea>
                    <br>
                    <span class="error"><?php echo $captchaerr ?> </span><br>
                    <div class="g-recaptcha" data-sitekey="6LdumnwUAAAAAPxnmm9BtC-WW9Uid4mSQGXbKPEz"></div><br>
                    <input type='submit' name='submit' class='btn btn-danger' value='Submit'>
                </form>
            </div>
        </div>
        </div>
</body>
<script src='https://www.google.com/recaptcha/api.js'></script>
</html>