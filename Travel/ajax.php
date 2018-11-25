<?php
$like = $_POST['like'];
$dislike = $_POST['dislike'];
$table = "reaction";
$sid = 2;
$user = "deeksha";
require_once('dbFunc.php');
$obj = new dbFunc();
$select = "user";
$row = $obj->like_check($sid,$user,$select);
$count = sizeof($row);
if (!($count)) {
    $field = array("sid", "user", "`like`", "dislike");
    $data = array($sid,$user,$like, $dislike);
    $obj->Insertdata($table, $field, $data);
}
else
{
$obj->like_update($sid,$user,$like,$dislike);
}
$lcheck = "`like`";
$lcount = $obj->like_count($sid,$user,$lcheck);
$dcheck = "dislike";
$dcount = $obj->like_count($sid,$user,$dcheck);
//echo $lcount;
$count = [];
$count['like'] = $lcount;
$count['dislike'] = $dcount;
//echo "upvote :" . $lcount . "downvote :" . $dcount;
$result= new \stdClass();
$result->lcount = $lcount;
$result->dcount = $dcount;
$myJSON = json_encode($result);
echo $myJSON;
//echo $dcount;
?>