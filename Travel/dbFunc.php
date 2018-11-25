<?php  
session_start();  
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
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
                exit(1);
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