<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "dados";
$port = 3306;

try{
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);

}catch(PDOException $erro){
    echo "Error!" . $erro->getMessage();
}