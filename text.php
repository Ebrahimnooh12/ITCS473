<?php
session_start();
extract($_GET);
extract($_POST);


try{
    require("connection.php");
    $userid=$_SESSION['activeuser'][1];
    
    if($st == 'ul'){
        $dis_sql ="SET PRIMARY_KEY_CHECKS=0;";
        $updateinfosql = "UPDATE address
           SET city ='$c' , street =$s , building=$b  
           WHERE lid = 9 AND cid = $userid;" ;

               $dis = $db->exec($dis_sql);
           $updateinfo = $db->exec($updateinfosql);

           $en_sql = "SET PRIMARY_KEY_CHECKS=1;";
           $en = $db->exec($en_sql);
    }
    $db = null;
    

}

catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    //header('location: myaccount.php');

   

?>