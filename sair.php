<?php
	session_start();
	//session_destroy();
	
	unset($_SESSION['id']);
	unset($_SESSION['nome']);
	unset($_SESSION['funcao']);
	unset($_SESSION['equipe']);
	unset($_SESSION['menu']);
    setcookie("ID", NULL, 1);
    setcookie("TOKEN", NULL, 1);
    setcookie("SECURE", NULL, 1);
	header("Location: index.php");
?>