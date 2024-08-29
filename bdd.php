<?php

$server = "mysql:host=localhost; dbname=crud";
$username = "root";
$password = "" ;


try{
    $conn = new PDO($server, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo"connexion success";

}catch(Exception $e){
    echo "Error de connexion: " . $e->getMessage();

}
?>