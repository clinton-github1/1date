<?php

include "../shared/petition_db_connect.php";


class Petition{
    
    public function __construct(){
        
        $database= new Database();
        $db= $database->getConnection();
        
        
        if(isset($_POST['submit'])){
            
            $ID= rand(2000,100000);
            $Name= mysqli_real_escape_string($db, $_POST['name']);
            $Email= mysqli_real_escape_string($db, $_POST['email']);
            $City= mysqli_real_escape_string($db, $_POST['city']);
            $Country= mysqli_real_escape_string($db, $_POST['country']);
            $Progress_confirm= mysqli_real_escape_string($db, $_POST['progress']);
            
            
            $check_email= "SELECT * FROM petition WHERE Email='$Email'";
            $result= $db->query($check_email);
            if($result->num_rows>1){
                
                echo "<script>alert('Sign Petition only once!! This email address had signed already'), window.open('sign-petition.php', '_self')</script>";
                exit;
            }
            
            $sql= "INSERT INTO petition (ID, Name, Email, City, Country, Progress_confirm) VALUES ('$ID', '$Name', '$Email', '$City', '$Country', '$Progress_confirm')";
            
            if(!mysqli_query($db, $sql)){
                
                echo "<script>unsuccessful submission</script>" . mysqli_error($db);
            }
            
            echo "<script>alert('Petition sent!!!'), window.open('sign-petition.php', '_self')</script>";
            
            mysqli_close($db);
        }
        
    }
}

$petition= new Petition();
?>