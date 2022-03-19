<?php
session_start();
include_once("connection.php");

$comentario = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING);
$x = filter_input(INPUT_POST, 'x', FILTER_SANITIZE_STRING);
$y = filter_input(INPUT_POST, 'y', FILTER_SANITIZE_STRING);
$query = "INSERT INTO comentarios (usuario_id, comentario, x, y, submit_date) VALUES ('".$_SESSION['user_id']."','$comentario','$x','$y',CONVERT_TZ(NOW(),'SYSTEM','-03:00'))";
$result = mysqli_query($conn, $query);
if($result){
	header("Location: home.php");
	exit();
} else {
	header("Location: home.php?errc=1");
	exit();
}
?>