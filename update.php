<?php
session_start();
extract($_GET);
extract($_POST);

if(isset($info_u)) {
    $st='uf';
}

if(isset($loc_u)){
    $st='ul';
}

try{
    require("connection.php");
    $userid=$_SESSION['activeuser'][1];
    $nodeletesql="select cid from address where cid =$userid;";

    $nodelete= $db->query($nodeletesql);
    $dc = $nodelete->rowCount();

    if($dc == 1 && $st != 'ul')
    {   
        header('location: myaccount.php?err=1');
        die();

    }

    $db->beginTransaction();
    switch ($st) {
        case 'uf':
            $updateinfosql = "UPDATE customer
            SET username ='$username' , Fname ='$fname' , Lname='$lname'  , Email='$email' 
            WHERE username ='$username' ;" ;
            $stmt = $db->prepare("UPDATE contact SET tel=:tel WHERE cnt_id=:cntid");
            $stmt->bindParam(':tel', $Tel);
            $stmt->bindParam(':cntid', $Telid);



            for ($i=0; $i < count($tel) ; $i++) { 
                $Telid=$telid[$i];
                $Tel=$tel[$i];
                $count=$stmt->rowCount();
                $stmt->execute();
           

            }

            $updateinfo = $db->exec($updateinfosql);
            break;

        case 'dl':
            $updateFODdql ="delete FROM orderdetail where oid in (SELECT oid FROM ordering WHERE location = $locid);";
            $updateFOsql = "DELETE FROM ordering WHERE location=$locid;";
            $updatesql = "DELETE FROM address WHERE lid=$locid;";

            $updateFOD = $db->exec($updateFODdql);
            $updateF= $db->exec($updateFOsql);
            $update = $db->exec($updatesql);

            break;
    }

    
    $db->commit();

    if($st == 'ul'){
        echo $locid;
        echo $c;

           $sql = "UPDATE address SET city=?, street=?, building=? WHERE lid=?";
            $stmt= $db->prepare($sql);
            $stmt->execute([$c, $s, $b, $locid]);
    }
    $db = null;
    

}

catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    header('location: myaccount.php');

   

?>