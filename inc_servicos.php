<?php
	session_start();
	include_once("conexao.php");
	include_once("seguranca.php");

	$nome_servico 	= strtoupper($_POST["txtNomeServicos"]);
    $descricao  	= strtoupper($_POST["txtDescricao"]);
    $valor_tabela 	= number_format($_POST["txtValorTabela"], 2, ',', '.');
    $custo_estimado = number_format($_POST["txtCustoEstimado"], 2, ',', '.');
    $valor_venda    = number_format($_POST["txtValorvenda"], 2, ',', '.');
    $tempo_minutos	= strtoupper($_POST["txtTempoMinutos"]);
    $id             = strtoupper($_POST["txtId"]);
	
    $sql_ultreg = "Select max(ser_id)+1 as reg from servicos ";
    $sql_reg = mysqli_query($conn, $sql_ultreg);
    
    $row_reg = mysqli_fetch_array($sql_reg);
    $reg_novo = $row_reg['reg'];

	$sql_comando = "INSERT INTO servicos VALUES(";
	$sql_comando .= "'$reg_novo','$nome_servico','$descricao','$valor_tabela','$custo_estimado','$valor_venda','$tempo_minutos','$id')";

	$sql = mysqli_query($conn, $sql_comando);
	
	if ($sql){
	    $_SESSION['msg'] = "Servico incluso com sucesso... ";
	    //$_SESSION['msg'] = $sql_comando;
		header("Location: sistema.php?pg=4");
	}else{
	    $_SESSION['msg'] = "Falha na inclusão... ";
	    //$_SESSION['msg'] = $sql_comando;
	    header("Location: sistema.php?pg=4");
	}
?>