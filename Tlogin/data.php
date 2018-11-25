<?php
 class Connect {
    
    private $server = "localhost";
    private $user = "root";
    private  $password = "root";
    private  $dbname="comments";
    private  $dbc;
    
    
   public function __construct()  {
        $this->dbc = new mysqli($this->server,$this->user,$this->password,$this->dbname);

       return $this->dbc;
        
    }
    public function insertstories($table_name, $data)  
    {  

         $string = "INSERT INTO ".$table_name." (";            
         $string .= implode(",", array_keys($data)) . ') VALUES (';            
         $string .= "'" . implode("','", array_values($data)) . "')";  
         try{
           $res =  mysqli_query($this->dbc, $string);          
         print_r($res);
             echo "<script>location.href='stories.php'</script>";

         }catch(Exception $e){
             echo $e->getMessage(); die;
         }  
        }

        public function search(){
          $check = mysqli_query($this->dbc, "SELECT * FROM stories");

          // $result = mysqli_fetch_array($check);
          return $check;
     
     }

     public function viewdetail($id){
          $check = mysqli_query($this->dbc, "SELECT * FROM stories where id='$id'");
          return $check;
     }

     public function takesdetail($id){
          $check = mysqli_query($this->dbc, "SELECT * FROM stories where id='$id'");
          return $check;
     }

     public function updatestories($table_name, $form_data,$story_id)  
     {
          {
               $valueSets = array();
               foreach($data as $key => $value) {
               $valueSets[] = $key . " = '" . $value . "'";
               }
               $sql = "UPDATE $table_name SET ". join(",",$valueSets) . " WHERE id = '".$story_id."'";
               $result = mysqli_query($this->dbc, $sql);
               if (mysqli_query($this->dbc, $sql)) {
        
               }
               else
               {
               echo "Error: " . $dbc . "" . mysqli_error($dbc);
               }
             }
     }
}
$k = new Connect();

 


?>
