<?php
session_start();
extract($_GET);
extract($_POST);

if(isset($info_u)) {
    $pex = explode('.',$pic);
    $ex = $pex[1]; 
    $st='uf';
}

if(isset($loc_u)){
    $st='lu';
}

try{
    require("connection.php");
    $userid=$_SESSION['activeuser'][1];
    $nodeletesql="select cid from address where cid =$userid;";

    $nodelete= $db->query($nodeletesql);
    $dc = $nodelete->rowCount();

    if($dc == 1)
    {   
        header('location: myaccount.php?err=1');
        die();

    }

    $db->beginTransaction();
    switch ($st) {
        case 'uf':
            $set_pic = $userid.'.'.$ex;
            $updateinfosql = "UPDATE customer
            SET username ='$username' , Fname ='$fname' , Lname='$lname'  , Email='$email', profile_pic='$set_pic' 
            WHERE cid ='$userid' ;" ;
            $stmt = $db->prepare("UPDATE contact SET tel=:tel WHERE cnt_id=:cntid");
            $stmt->bindParam(':tel', $Tel);
            $stmt->bindParam(':cntid', $Telid);



            for ($i=0; $i < count($tel) ; $i++) { 
                $Telid=$telid[$i];
                $Tel=$tel[$i];
                $count=$stmt->rowCount();
                $stmt->execute();
           

            }

            $updateinfo = $db->query($updateinfosql);
            break;

        case 'dl':
            $updateFODdql ="delete FROM orderdetail where oid in (SELECT oid FROM ordering WHERE location = $locid);";
            $updateFOsql = "DELETE FROM ordering WHERE location=$locid;";
            $updatesql = "DELETE FROM address WHERE lid=$locid;";

            $updateFOD = $db->exec($updateFODdql);
            $updateF= $db->exec($updateFOsql);
            $update = $db->exec($updatesql);

            break;

        case 'lu':
             $updateinfosql = "UPDATE address
                SET city ='$c' , street ='$s' , building='$b'  
                WHERE lid ='$locid' ;" ;

                $updateinfo = $db->query($updateinfosql);
            break;    
    }

    $db->commit();

    $db = null;
    

}

catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

   header('location: myaccount.php');

   

?>