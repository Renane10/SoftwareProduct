<?php
	session_start();
	include_once("conexao.php");
	include_once("seguranca.php");

	$login 	= strtoupper($_POST["txtLogin"]);
	$senha 	= strtoupper($_POST["txtSenha"]);	
	$nome   = strtoupper($_POST["txtNome"]);
	$funcao = strtoupper($_POST["txtFuncao"]);
	$email 	= strtoupper($_POST["txtEMail"]);	
	$equipe	= strtoupper($_POST["txtEquipe"]);	
	$dtCad 	= date('Y-m-d');	
	$status	= strtoupper($_POST["txtStatus"]);	
	$resp 	= strtoupper($_POST["txtResp"]);	
	$menu 	= strtoupper($_POST["txtMenu"]);	
	$dtAlt 	= date('Y-m-d');
	$altPor	= $_SESSION['id'];

    $sql_ultreg = "Select max(usu_id)+1 as reg from usuario ";
    $sql_reg = mysqli_query($conn, $sql_ultreg);
    
    $row_reg = mysqli_fetch_array($sql_reg);
    $reg_novo = $row_reg['reg'];

	$sql_comando = "INSERT INTO usuario VALUES(";
	$sql_comando .= "'$reg_novo','$nome','$email','$funcao','$status','$dtCad','$altPor','$equipe','$resp','$senha','$login','$menu','$dtAlt')";

	$sql = mysqli_query($conn, $sql_comando);
	
	if ($sql){
	    $_SESSION['msg'] = "Usuário incluso com sucesso... ";
	    //$_SESSION['msg'] = $sql_comando;
		header("Location: sistema.php?pg=4");
	}else{
	    $_SESSION['msg'] = "Falha na inclusão... ";
	    //$_SESSION['msg'] = $sql_comando;
	    header("Location: sistema.php?pg=4");
	}
?>