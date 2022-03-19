<?php session_start();
if($_SESSION["user_auth"] == "none"){
	header("Location: index.php");
}
?>
<html>
	<head>
		<title>Homepage</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/postit.css">
		<link rel="stylesheet" type="text/css" href="css/home.css">
	</head>
	<body>
		<section class="first-section">
			<h1>Bem vindo <?php echo $_SESSION["user_nome"];?>!</h1>
			<a href="perfil.php">Configurar perfil</a><br>
			<form id="comment" class="postit-form" method="post" action="create_comment.php">
				<label>
					<p>Deixe um comentario!</p>
					<textarea name="texto" rows="5" cols="100" maxlength="500">Olá Tudo Bem? Me chamo <?php echo $_SESSION["user_nome"]?> :)</textarea>
				</label>
				<input type="hidden" name="x" value="0" />
				<input type="hidden" name="y" value="0" />
				<input name="submit" type="submit" value="post it"/>
			</form>
		</section>
		<script language="javascript" src="js/postit.js"></script>
	</body>
</html>

<?php
include_once("connection.php");
$query = "SELECT * FROM comentarios ORDER BY submit_date DESC";
$result = mysqli_query($conn, $query);

if($result){
	while ($row = $result->fetch_assoc()) {
    // do what you need.
		/*if(mysqli_num_rows($result) == 1){
			$data = array(0=>$data);
		}
		foreach($data as $row) {*/
		$query = "SELECT nome FROM usuarios WHERE id=".$row["usuario_id"];
		$_result = mysqli_query($conn, $query);
		$_data = mysqli_fetch_assoc($_result);
		echo "<div class='postit' style='top:".($row["y"])."px;left:".$row["x"]."px;'>";
	    echo "<span>".$row["comentario"]."</span>";
	    echo "<div>";
	    echo "<span><a href='like_comment.php?cid=".$row["id"]."'>&#9829;</a>";
	    echo "<span>".$row["likes"]."</span></span>";
		echo "<span>".$_data["nome"]."</span>";
	    echo "<span>".$row["submit_date"]."</span>";
	    echo "</div></div>";
	}
}
