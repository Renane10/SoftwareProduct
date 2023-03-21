<?php
	session_start();
	//session_destroy();
	
	unset($_SESSION['id']);
	unset($_SESSION['nome']);
	unset($_SESSION['funcao']);
	unset($_SESSION['equipe']);
	unset($_SESSION['menu']);
	header("Location: index.php");
?>