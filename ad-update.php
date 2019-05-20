<?php
extract($_POST);

if(!isset($dish_up)){
    header('location: login.php');
    die();
}



else {
    try{
        require("connection.php");

    $db->beginTransaction();

            $updatedishsql = $db->prepare("UPDATE dish
            SET name=:dish  , description =:desc , ct_id=:cat  , price=:p 
            WHERE name ='$dish' ;");

            $updatedishsql->bindParam(':dish', $dish);
            $updatedishsql->bindParam(':desc', $desc);
            $updatedishsql->bindParam(':cat', $cat);
            $updatedishsql->bindParam(':p', $price);

            $updatedishsql->execute();

    $db->commit();

    $db = null;

    }

    catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


    header('location: adminview.php?v=d');



}