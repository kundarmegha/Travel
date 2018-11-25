<?php
include('dbFunc.php');
$seid=$_SESSION['seid'];
$obj = new dbFunc();
$table='work_details';
$field = array("eid","position","project","experience");
$res = $obj->fetch_data($seid,$field,$table);
$sexperience=$res['experience'];
$sposition=$res['position'];
$sproject=$res['project'];

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
$sintrests=$res['intrests'];

echo "   Experience: $sexperience Years <br> 
         Position: $sposition <br>
         Project: $sproject <br>
         Intrests: $sintrests <br>
         Knowledge: $sknowledge<br>
         Hobbies: $shobbies <br>
        ";
?>