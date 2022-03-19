<?php
session_start();
include_once("connection.php");

$login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
$nome = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
$senha = md5($_POST["senha"]);

$query = "SELECT * FROM usuarios WHERE usuario = '$login'";
$result = mysqli_query($conn, $query);
if(!$result){
	echo mysqli_error($conn);
	exit();
}
$data = mysqli_fetch_assoc($result);
if($data != null){
	header("Location: index.php?errcad=1");
	session_destroy();
	exit();
}

$query = "INSERT INTO usuarios (usuario, senha, nome, criado) VALUES ('$login', '$senha', '$nome', CONVERT_TZ(NOW(), 'SYSTEM', '-03:00'));";
$sucesso = mysqli_query($conn, $query);

if($sucesso){
	header("Location: index.php?scss=1");
	exit();
} else {
	header("Location: index.php?errcad=2");
	session_destroy();
	exit();
}
