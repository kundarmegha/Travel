<?php  
//session_start();
require_once 'dbConnect.php';  

    class dbFunc {  
        private $db;
        public function __construct() {  
            $this->db = new dbConnect();   
        }  

        function Insertdata($table,$field,$data)
        {
            $field_values= implode(',',$field);
            $data_values=implode("','",$data);
        
            $sql= "INSERT INTO $table (".$field_values.")
        VALUES ('".$data_values."') ";
            $result = mysqli_query($this->db->conn,$sql);
            if($result)
            {
//                echo "<script>location.href='login.php'</script>";
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
                exit(1);
            }
        }
        function loginprocess($eid,$password)
        {
            $ret = mysqli_query($this->db->conn, "SELECT * FROM login_details WHERE username='$eid'");
            $row = mysqli_fetch_assoc($ret);
            $pasw=$row['password'];
            $id=$row['username'];
            $_SESSION['username']=$row['username'];
            if (password_verify($password,$pasw))
            {
              $row = mysqli_fetch_assoc($ret);
            }
            else
            {
                echo "<script>alert('Wrong password or username);</script>";
                echo "<script>location.href='login.php'</script>";
            }
            return $id;
        }
        
        function getdata($table,$field,$where,$id)
        {
            $field_values= implode(',',$field);
            $sql= "SELECT $field_values FROM $table where $where='$id'";
            $result = mysqli_query($this->db->conn, $sql);
            if($result)
            {
                $num = sizeof($field);
                $row = mysqli_fetch_assoc($result);
                for ($i=0;$i<$num;$i++)
                {
                    $_SESSION[$field[$i]] = $row[$field[$i]];
                }

                echo "<script>location.href='viewStories.php'</script>";
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
            }
        }
        function update_data($table_name, $form_data,$id,$user_id)
        {        
            $valueSets = array();
            foreach($form_data as $key => $value) {
                $valueSets[] = $key . " = '" . $value . "'";
            }
            $sql = "UPDATE $table_name SET ". join(",",$valueSets) . " WHERE " . " $id = '".$user_id."'";
            $result = mysqli_query($this->db->conn, $sql);
            if (mysqli_query($this->db->conn, $sql)) {
                echo "Updated successfully";
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
            }
        } 
        function fetch_data($seid,$field,$table)
        {
         $sql = "select * from $table where username='$seid'";
         $result = mysqli_query($this->db->conn, $sql);
         if($result)
            {
                $row = mysqli_fetch_assoc($result);
                return $row;
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
            }
        }
        function fetch_comment($sid)
        {
            $sql = " Select id,sid,name,body,date from comments where sid = $sid order by  id desc  ;";
            $result = mysqli_query($this->db->conn, $sql);
            if($result)
            {
                while($row = mysqli_fetch_assoc($result))
                {
//                    print_r($row);die;
                    $solutions[$row['id']] = $row;
                }
                return $solutions;
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
                exit(1);
            }
        }

        function reply_comment($pid)
        {
            $sql = " Select * from reply where pid = $pid order by  id desc;";
            $result = mysqli_query($this->db->conn, $sql);
            if($result)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $solutions[$row['id']] = $row;
                }
                return $solutions;
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
                exit(1);
            }
        }


        function like_check($sid,$user,$select)
        {
            $sql = " Select $select from reaction where sid = $sid and user = '$user'";
            $result = mysqli_query($this->db->conn, $sql);
            if($result)
            {
                if($row = mysqli_fetch_assoc($result))
                {
                    $solutions = $row;
                }
                return $solutions;
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
                exit(1);
            }
        }

        function like_update($sid,$user,$like,$dislike)
        {
            $sql = "UPDATE reaction SET `like` = $like, dislike = $dislike  WHERE  sid = $sid and user =  '$user'";
            $result = mysqli_query($this->db->conn, $sql);
            if($result)
            {
                return true;
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
                exit(1);
            }
        }

        function like_count($sid,$user,$check)
        {
            $sql = "select count(id) from reaction where $check = '1' and sid= $sid";
            $result = mysqli_query($this->db->conn, $sql);
            if($result)
            {
                $row = mysqli_fetch_assoc($result);
                $solutions = $row['count(id)'];
                return $solutions;
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
                exit(1);
            }
        }
    }
?>  
