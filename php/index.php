<?php
$FullName=$_POST['fullname'];
$Email=$_POST['email'];
$Phone=$_POST['phone'];
$FirstAddress=$_POST['paddress'];
$laddress=$_POST['laddress'];
$birth_date=$_POST["dateofbirth"];
$Gender = $_POST["Gender"];
$Company = $_POST["company"];
$Experience = $_POST["experience"];
$Location = $_POST["location"];
$Food = $_POST["food"];
$Tshirt = $_POST["tshirt"];
$Languages = $_POST["languages"];
$Session = $_POST["session"];
$Hobbies = $_POST["hobbies"];
$Flag = false;

function validate($variable)
{
    if (empty($variable)) {
       global $Flag ;
       $Flag = true;
                echo "Enter valid value"."<br />";
        }
}
$date=date('Y-m-d');
$datetime1 = date_create($date);
$datetime2 = date_create($birth_date);
$interval = date_diff($datetime1, $datetime2);
$age=$interval->format('%y Year %m Month %d Day');
validate($FullName);
validate($Email);

if(strlen($Phone) != 10)
{
    global $Flag;
    $Flag = true;
    echo "Enter the valid number";
}
if(!$Flag) {
    header("Location: index.html");

$fp=fopen("form-details.csv","a+");
$no_of_rows=count(file("form-details.csv"));
$form_data = [];
foreach($_POST as $key=>$value)
{
    if($no_of_rows == 0)
    {
        array_push($form_data, $key);
    }
}
fputcsv($fp, $form_data);
$form_data = [];
foreach($_POST as $key=>$value)
{
        array_push($form_data, $value);
}
fputcsv($fp, $form_data);
fclose($fp);
}
?>