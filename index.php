<?php 
session_start();
$_SESSION["user_auth"] = "none";
?>

<!--DOCTYPE html-->
<html>
<head>
	<title>Site Cpi</title>
	<link href="css/slide.css" rel="stylesheet" type="text/css" />
	<meta charset="utf-8" />
</head>
<body align="center">
	<h1>Site CPI</h1>
	<br><br>
	<h1>Login</h1>
	<?php
		if(isset($_GET["errlog"])){
			$s = "<p style=\"color:red;\">";
			switch ($_GET["errlog"]) {
				case 1:
					$s = $s."Usuario nao existe!";
					break;
				case 2:
					$s = $s."Erro ao efetuar login";
					break;
				default:
					break;
			}
			echo $s."</p>";
		}
	?>

	<form method="post" action="auth_login.php">
		<label>
			Usuario:<br/>
			<input type="text" name="login" placeholder="Nome de usuario" required />
		</label><br/><br/>
		<label>
			Senha:<br/>
			<input type="password" name="senha" placeholder="Senha da conta" required/>
		</label><br/><br/>
		<input type="submit" value="Entrar"/>
	</form>

	<h1>Cadastrar</h1>
	<?php
		if(isset($_GET["scss"])){
			echo "<p style=\"color:green;\">Cadastrado com sucesso!</p>";
		}else if(isset($_GET["errcad"])){
			$s = "<p style=\"color:red;\">";
			switch ($_GET["errcad"]) {
				case 1:
					$s = $s."Usuario ja existe";
					break;
				case 2:
					$s = $s."Erro ao cadastrar usuario";
					break;
				default:
					break;
			}
			echo $s."</p>";
		}
	?>
	<form method="post" action="auth_cad.php" onsubmit="return check(this)">
		<label>
			Nome:<br/>
			<input type="text" name="name" placeholder="Nome completo" required/>
		</label><br/><br/>
		<label>
			Usuario:<br/>
			<input type="text" name="login" placeholder="Nome de usuario" required/>
		</label><br/><br/>
		<label>
			Senha:<br/>
			<input type="password" name="senha" placeholder="Senha da conta" required/>
		</label><br/><br/>
		<label>
			Repetir senha:<br/>
			<input type="password" name="senha" placeholder="Repetir senha" required/>
		</label><br/><br/>
		<input type="submit" value="Cadastrar"/>
	</form>
	<br><br>
	<div class="slide" style="width: 500px; height: 400px; display: inline-block;">
		<!-- Fotos para o carrossel -->
		<img src="image/car1.png" alt="Foto 1"/>
		<img src="image/car2.png" alt="Foto 2"/>
		<img src="image/car3.jpg" alt="Foto 3"/>
		<img src="image/car4.jpg" alt="Foto 4"/>
		<img src="image/car5.jpg" alt="Foto 5"/>
		<img src="image/car6.jpg" alt="Foto 5"/>
	</div>
	<script type="text/javascript" src="js/slide.js"></script>
	<script language="javascript" src="js/index.js"></script>
</body>
</html>