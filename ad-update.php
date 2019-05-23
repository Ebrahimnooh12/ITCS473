<?php
extract($_POST);



if(!isset($old)){
    header('location: login.php');
    die();
}



    try{
        require("connection.php");

        if(isset($dish_up)){
        echo $old;
        $sql="UPDATE dish
        SET name='$dish'  , description ='$desc' , ct_id='$cat'  , price='$price' 
        WHERE did =$old;";

         $r= $db->exec($sql);

        $db = null;
        
        header('location: adminview.php?v=d');
        }



        if(isset($cus_up)){
            $db->beginTransaction();

            $update_cus_sql = $db->prepare("UPDATE customer
            SET username=:u  , Fname =:f , Lname=:l  , Email=:e
            WHERE username ='$old' ;");

            $update_cus_sql->bindParam(':u', $username);
            $update_cus_sql->bindParam(':f', $Fname);
            $update_cus_sql->bindParam(':l', $Lname);
            $update_cus_sql->bindParam(':e', $Email);

            $update_cus_sql->execute();

            $db->commit();

            $db = null;

            header('location: adminview.php?v=c');


        }


        if(isset($stf)){
            $db->beginTransaction();
            echo $job;
            $update_stf_sql = $db->prepare("UPDATE staff
            SET username=:u  , Fname =:f , Lname=:l  , type=:t
            WHERE username ='$old';");

            $update_stf_sql->bindParam(':u', $username);
            $update_stf_sql->bindParam(':f', $Fname);
            $update_stf_sql->bindParam(':l', $Lname);
            $update_stf_sql->bindParam(':t', $job);

            $update_stf_sql->execute();

            $db->commit();

            $db = null;

           header('location: adminview.php?v=s');


        }

    }

    catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }





