
<?php

include "dbh.classes.php";
class Signup extends DBH{

    protected function checkUser($uid,$email){
        $stmt = $this->connect()->prepare("SELECT users_id FROM users WHERE users_id=? AND users_email=?;");

        if(!$stmt->execute([$uid,$email])){
            $stmt = null;
            header("location:../index.php?error=stmtfailed");
            exit();
        }
        
        $resultCheck;
        if($stmt->rowCount()>0){
            $resultCheck=false;

        }
        else{
            $resultCheck= true;

        }
        return $resultCheck;


    }
    
    protected function setUser($uid,$pwd,$email){
        $stmt = $this->connect()->prepare("INSERT INTO users(users_uid,users_pwd,users_email) Values(?,?,?);");
          
        $hashedPwd= password_hash($pwd,PASSWORD_DEFAULT);
        if(!$stmt->execute([$uid,$hashedPwd,$email])){
            $stmt = null;
            header("location:../index.php?error=stmtfailed");
            exit();
        }
        
        $stmt = null;


}
public function showUsers(){
    $sql = "SELECT * FROM USERS";
    $stmt = $this->connect()->query($sql);
    $stmt->execute();
    
    $results = $stmt->fetchAll();
    
    if(!empty($results)){
        foreach($results as $result){
            echo " ID: ".$result["users_id"]."  Username:  ".$result["users_uid"] ."  Password:  ".$result["users_pwd"]."  Email:  ".$result["users_email"] ."<br>";
        }
    }
    
    return $results;
}

}