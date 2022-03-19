<?php
session_start();
include_once("connection.php");
$cid = filter_input(INPUT_GET, 'cid', FILTER_SANITIZE_STRING);
$query = "UPDATE comentarios SET likes = likes + 1 WHERE id=".$cid;
$result = mysqli_query($conn, $query);
if($result){
	header("Location: home.php");
	exit();
} else {
	header("Location: home.php?errl=1");
	exit();
}