<?php
	session_start();
	include_once("conexao.php");
	include_once("seguranca.php");

	$nome 	= strtoupper($_POST["txtNome"]);
	$telefone	= strtoupper($_POST["txtTelefone"]);	
	$endereço   = strtoupper($_POST["txtEndereço"]);
	$id = strtoupper($_POST["txtId"]);
	
    $sql_ultreg = "Select max(cli_id)+1 as reg from cliente ";
    $sql_reg = mysqli_query($conn, $sql_ultreg);
    
    $row_reg = mysqli_fetch_array($sql_reg);
    $reg_novo = $row_reg['reg'];

	$sql_comando = "INSERT INTO usuario VALUES(";
	$sql_comando .= "'$nome','$telefone','$endereço','$id')";

	$sql = mysqli_query($conn, $sql_comando);
	
	if ($sql){
	    $_SESSION['msg'] = "Cliente incluso com sucesso... ";
	    //$_SESSION['msg'] = $sql_comando;
		header("Location: sistema.php?pg=4");
	}else{
	    $_SESSION['msg'] = "Falha na inclusão... ";
	    //$_SESSION['msg'] = $sql_comando;
	    header("Location: sistema.php?pg=4");
	}
?>