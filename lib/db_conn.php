<?php
header('Content-Type: text/html; charset=utf-8');

$host_name = 'localhost';
$db_id = 'root';
$db_pw = '';
$db_name = 'localdb';
$conn = mysqli_connect($host_name, $db_id, $db_pw, $db_name); //("url", "user", "password", "database");
if(!$conn){
    die('Connect Error: ' . mysqli_connect_errno());
}

error_reporting(0); //에러메세지 출력 삭제

session_start();

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
?>
