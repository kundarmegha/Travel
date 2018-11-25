<?php
//ob_start();
$conn = new mysqli("localhost", "root", "root", "register");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

function Insertdata($table,$field,$data)
{


    global $conn;

    $field_values= implode(',',$field);

    $data_values=implode("','",$data);

    $sql= "INSERT INTO $table (".$field_values.")
VALUES ('".$data_values."') ";
    $result = mysqli_query($conn, $sql);
    $insert = mysqli_insert_id($conn);
    if($result)
    {
        echo "inserted";
        return $insert;
    }
    else
    {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
}

function loginprocess($password,$username)
{
    global $conn;
    $ret = mysqli_query($conn, "SELECT * FROM login_details WHERE username='$username'");
    $row = mysqli_fetch_assoc($ret);
    $pasw=$row['password'];
    $id=$row['id'];
    $_SESSION['username']=$row['username'];
    if (password_verify($password,$pasw))
    {
      $row = mysqli_fetch_assoc($ret);
    }
    else
    {
        echo "<script>location.href='login.html'</script>";
    }
    return $id;
}

function getdata($table,$field,$where,$id)
{
    global $conn;
    $field_values= implode(',',$field);
    $sql= "SELECT $field_values FROM $table where $where=$id";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        $num = sizeof($field);
        $row = mysqli_fetch_assoc($result);
        for ($i=0;$i<$num;$i++)
        {
            $_SESSION[$field[$i]] = $row[$field[$i]];
        }

        echo "<script>location.href='welcome.php'</script>";
    }
    else
    {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
}
function update_data($table_name, $form_data,$id,$user_id)
{
    global $conn;

    $valueSets = array();
    foreach($form_data as $key => $value) {
        $valueSets[] = $key . " = '" . $value . "'";
    }
    $sql = "UPDATE $table_name SET ". join(",",$valueSets) . " WHERE " . " $id = '".$user_id."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_query($conn, $sql)) {
        echo "Updated successfully";
    }
    else
    {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
}
?>

