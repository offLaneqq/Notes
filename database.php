<?php 

$server = 'localhost';
$username = 'username';
$password = 'password';
$db_name = 'notes';

$conn = new mysqli($server, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed - " . $conn->connect_error);
}
?>