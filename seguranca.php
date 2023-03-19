<?php
	ob_start();
	//if($_SESSION['nome'] == ""){
    if($_SESSION['id'] < 1){	    
		$_SESSION['loginErro'] = "Área restrita para usuários cadastrados.";
		unset($_SESSION['id']);
		unset($_SESSION['nome']);
		unset($_SESSION['funcao']);
		unset($_SESSION['equipe']);
		unset($_SESSION['menu']);		
		header("Location: index.php");
	}
?>