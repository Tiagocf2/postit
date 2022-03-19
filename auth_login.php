<?php 
session_start();
include_once("connection.php");

$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
$senha = md5($_POST["senha"]);

$query = "SELECT id, nome FROM usuarios WHERE usuario = '$login' and senha = '$senha'";
$result = mysqli_query($conn, $query);
if($result){
	$data = mysqli_fetch_assoc($result);
	if($data){
		$_SESSION["user_auth"] = "user";
		$_SESSION["user_id"] = $data["id"];
		$_SESSION["user_nome"] = $data["nome"];
		header("Location: home.php");
		exit();
	} else {
		header("Location: index.php?errlog=1");
		session_destroy();
		exit();
	}
}else{
	header("Location: index.php?errlog=2");
	session_destroy();
	exit();
}
?>