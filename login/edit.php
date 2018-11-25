<?php
session_start();
require('database.php');
$username=$_SESSION['username'];
$firstname=$_SESSION['firstname'];
$lastname=$_SESSION['lastname'];
$dob1 =$_SESSION['dob'];
$email=$_SESSION['email'];
$photo1=$_SESSION['photo'];
$country=$_SESSION['country'];
$state=$_SESSION['state'];
$pincode=$_SESSION['pincode'];
$mobile=$_SESSION['mobile'];
$address=$_SESSION['address'];
$sslc=$_SESSION['sslc'];
$pu=$_SESSION['pu'];
$engg=$_SESSION['engineering'];
$gender=$_SESSION['gender'];
$user_id=$_SESSION['id'];
if(isset($_POST['update']))
{
    $FullName=$_POST['fullname'];
    $FullName= trim($FullName);
    $Email=$_POST['email'];
    $email = trim($Email);
    $Phone=$_POST['phone'];
    $Phone = trim($Phone);
    $FirstAddress=$_POST['paddress'];
    $FirstAddress = trim($FirstAddress);
    $birth_date=$_POST["dateofbirth"];
    $pincode=$_POST['pincode'];
    $Gender = $_POST["Gender"];
    $username = $_POST["uname"];
    $Password= $_POST["pasw"];
    $ConfirmPassword= $_POST["ConfirmPassword"];
    $expert= $_POST["expert"];
    $sslc= $_POST["sslc"];
    $sslc = trim($sslc);
    $pu= $_POST["pu"];
    $pu = trim($pu);
    $engineering= $_POST["engineering"];
    $engineering = trim($engineering);
    $pincode=$_POST['pincode'];
    $country=$_POST["country"];
    $state=$_POST["state"];

    $photo = $_FILES['file']['name'];

    $filepath="upload/".$photo;
    $up=move_uploaded_file($_FILES["file"]["tmp_name"] , "$filepath");
    if(!$up)
    {
        echo'image not uploaded';
    }

//if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{12,20}$/', $Password)) {
//    echo 'the password does not meet the requirements!<br>';
//    exit(1);
//}
//else {
    $password = password_hash($Password, PASSWORD_DEFAULT);
    if (password_verify($ConfirmPassword, $password)) {
    } else {
        echo 'Invalid password<br>';
        exit(1);
    }
//}

    $date=date('Y-m-d');
    $datetime1 = date_create($date);
    $datetime2 = date_create($birth_date);
    $dob = $datetime2->getTimestamp();
    $interval = date_diff($datetime1, $datetime2);
    $age=$interval->format('%y Year %m Month %d Day');


    $mailid=strchr($email,"@");
    $maildomain=ltrim($mailid,"@");
    $lastnametrue=str_word_count($FullName);
    if ($lastnametrue==1)
    {
        echo "Enter the last name";
        exit(1);
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "invalid email";
        exit(1);
    }


    $avg = ( $sslc + $pu + $engineering ) / 3;
    if(($sslc < 60 && $pu < 60 && $engineering<60) && $avg<65)
    {
        echo "Marks doesnot satisfy";
        exit(0);
    }

    if(strlen($Phone) != 10)
    {
        echo "Enter the valid mobile number <br>";
        exit(1);
    }
    $name = explode(" ", "$FullName", 2);
    $firstname = $name[0];
    $lastname = $name[1];
    $table_name = 'profile';
    $table_id = 'id';
    $form_data = array(
        'firstname'=> $firstname,
        'lastname'=>$lastname,
        'email'=>$email,
        'gender'=>$Gender,
        'dob'=>$birth_date,
        'age'=>$age
    );
    update_data($table_name,$form_data,$table_id,$user_id);

    $table_name = 'contact_info';
    $table_id = 'id';
    $form_data = array(
        'mobile'=> $Phone,
        'address'=>$FirstAddress,
        'country'=>$country,
        'state'=>$state,
        'pincode'=>$pincode
    );
    update_data($table_name,$form_data,$table_id,$user_id);

    $table_name = 'Academics';
    $table_id = 'id';
    $form_data = array(
        'sslc'=> $sslc,
        'pu'=>$pu,
        'engineering'=>$engineering
    );
    update_data($table_name,$form_data,$table_id,$user_id);

    $table_name = 'login_details';
    $table_id = 'id';
    $form_data = array(
        'username'=> $username,
        'password'=>$password
    );
    update_data($table_name,$form_data,$table_id,$user_id);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>Registartion Form</title>
</head>
<body>
<div class="col-md-12">
    <div class="col-md-12">
        <h3 class="text-center">
            <span class="label label-warning">EDIT FORM</span>
        </h3>
    </div><div class="col-md-6 col-md-offset-3">
        <form method="POST" action="edit.php" name="myForm" onsubmit="return validateForm()" enctype="multipart/form-data">

            <br /><br />
            <input type="text" class="form-control" name="fullname" value="<?php echo $firstname . " " . $lastname; ?>" placeholder="Enter Full Name" id="fullname"
                   onblur="validatefield(this)"; required><br />
            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Enter Email" onblur="validateEmail(this)";
                ><br />

            <textarea style="width:100%;height:150px;" id="address"  maxlength="300" placeholder="Address"
                      name="paddress" maxlength="300" onkeyup="countmn()" onkeypress="countpl()"><?php echo $address?> </textarea><br>

            <span style="float:right;color:green;"><span id="paragraph">0</span><span> out of 300</span></span>
            <br><br>
            <!--        <div >-->
            <!--            <script type= "text/javascript" src = "js/countries.js"></script>-->
            <!--            Select Country :   <select id="country" name ="country"></select> </br></br>-->
            <!--            Select State: <select name ="state" id ="state" ></select>  </br> </br> <hr/>-->
            <!--        </div>-->
            <!---->
            <!--        <script language="javascript">-->
            <!--            populateCountries("country", "state"); // first parameter is id of country drop-down and second parameter is id of state drop-down-->
            <!--        </script>-->



            <select name="country" id="country-list" class="demoInputBox" ="<? echo $country?>" onChange="getState(this.value); mobile(this.value); pincode(country); ">
                <option value="">Select country</option>
                <option value="india">India</option>
                <option value="usa">USA</option>
            </select>

            <select id="ddlCity">
                <option value="">Select state</option>
            </select>
            <br><br>



            <input type="number" class="form-control" name="pincode" value="<?php echo $pincode ?>" id="pincode" placeholder="Pincode"><br />
            <div id="mobile"></div>
            <input type="tel" class="form-control" name="phone" value="<?php echo $mobile ?>" id="phone" placeholder="Phone"><br />

            <input type="date" size="50" name="dateofbirth" value="<?php echo $dob1; ?>" style="width: 100%; height: 30px; " class="text-center" > <br/>
            <br><input type="text" class="form-control" name="uname" value="<?php echo $username ?>" placeholder="Enter username "><br />
            <input type="password" class="form-control" name="pasw" placeholder="password"><br />
            <input type="password" class="form-control" name="ConfirmPassword" placeholder="confirm password" id="confirm_password"><br />
            <div class="radio text-center">
                <label>Select Gender</label><br/>
                <label><input type="radio" name="Gender" value="male" <?php if ($gender=='male') {echo "checked='checked'";} ?>">Male</label>
                <label><input type="radio" name="Gender" value="female" <?php if ($gender=='female') {echo "checked='checked'";} ?>">Female</label>
            </div>
            <label>Expert in</label><br>
            <input type="checkbox" name="expert" value="html" > HTML<br>
            <input type="checkbox" name="expert" value="css"> CSS<br>
            <input type="checkbox" name="expert" value="javascript"> Javascript<br><br>
            <br><br>


            <label class=" col-md-12">Languages Known</label>
            <input type="checkbox" name="language" value="English" checked onclick="return false"> English<br>
            <input type="checkbox" name="language" value="Kannada"> Kannada<br>
            <input type="checkbox" name="language" value="Hindi"> Hindi<br><br>
            <br><br>

            <label><b>SSLC Marks.:</b></label><br>
            <input type="number" placeholder="Enter SSLC marks" name="sslc" value="<?php echo $sslc?>" class="form-control">
            <br><br>
            <label ><b>PUC Marks:</b></label><br>
            <input type="number" placeholder="Enter PUC Marks" name="pu" value="<?php echo $pu?>" class="form-control">
            <br><br>
            <label <b>Engineering Marks</b></label><br>
            <input type="number" placeholder="Enter Engineering marks" name="engineering" value="<?php echo $engg?>" class="form-control">
            <br><br>
            <label <b>Hobbies</b></label><br>
            <input type="text" placeholder="Enter hobbies" name="hobbies" class="form-control">
            <br><br>
            <label >Select a file</label>
            <?php echo $dob. "dd";?>
            <input type="file" name="file" value=<?php echo "''$photo1''";?>><br><br>
            <button type="submit" name="update" class="form-control btn btn-primary" onclick="return Validate();" >Update</button><br /><br />
        </form>
        <form action="welcome.php" method="post">
            <button type="submit" name="welcome" class="form-control btn btn-primary"  >Profile</button><br /><br />
        </form>
    </div>
</div>
<script type="text/javascript" src="js/countries.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</body>
</html>