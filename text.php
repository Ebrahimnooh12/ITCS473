<?php
session_start();
extract($_GET);


try{
    require("connection.php");




            $db = null;
    

}

catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    //header('location: myaccount.php');

   

?>