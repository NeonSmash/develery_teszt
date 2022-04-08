<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'teszt_kapcsolat');
define('DB_PASSWORD', 'HayW_8g@RYC5NDj3');
define('DB_NAME', 'kapcsolat');
 
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($mysqli === false){
    die("Hiba: Nem lehet csatlakozni. " . $mysqli->connect_error);
}
?>