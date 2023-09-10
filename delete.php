<?php
include './database.php';

$id = $_GET['id'];
$delete = "DELETE FROM `notes_table` WHERE `id`='$id'";
$res = mysqli_query($conn, $delete);
header("Location: /");

?>