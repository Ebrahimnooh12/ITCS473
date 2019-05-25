<?php
require("connection.php");
extract($_GET);
extract($_POST);
// first
// last
// email
// un
// ps
// ps1
// pic
try {  
    $db->beginTransaction();
    $emp=$db->prepare("INSERT INTO customer (`cid`, `username`, `Fname`, `Lname`, `password`, `Email`, `profile_pic`)
          values (NULL,:Username,:FName,:LName,:pas,:em,NULL)");
  
    $emp->bindParam(':Username', $un);
    $emp->bindParam(':FName', $first);
    $emp->bindParam(':LName', $last);
    $emp->bindParam(':em', $email);
    if($ps==$ps1)
    {
        $ps=md5($ps);
        $emp->bindParam(':pas', $ps);
    }
    else{
        echo "Passwords are not matched";
        die;
    }
    

    $emp->execute();
    $db->commit();
    
    echo "yes";

  } catch (Exception $e) {
    $db->rollBack();
    $msg=$e->getMessage();
    echo $msg;
  }
?>