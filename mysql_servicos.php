<?php
	session_start();
	include_once("conexao.php");
	include_once("seguranca.php");
	include_once("funcao.php");

	if($_POST['btnAcao']=='alt'){
	   $parametro = $_POST['btnAcao']; 
	}else{
        $caracter   = strlen($_POST['btnAcao']) - 3;
        $parametro  = substr($_POST['btnAcao'],3,$caracter); 
        $parametro  = substr($_POST['btnAcao'],0,3);
	};
    
    //echo $parametro;
    
    switch ($_POST['btnAcao']) {
		case "alt":
            $nome_servico 	= strtoupper($_POST["txtNomeServicos"]);
            $descricao  	= strtoupper($_POST["txtDescricao"]);
        	$valor_tabela 	= number_format($_POST["txtValorTabela"], 2, ',', '.');
            $custo_estimado = number_format($_POST["txtCustoEstimado"], 2, ',', '.');
            $valor_venda    = number_format($_POST["txtValorvenda"], 2, ',', '.');
			$tempo_minutos	= strtoupper($_POST["txtTempoMinutos"]);


			$sql_comando = "update servicos set ";
        	$sql_comando .= "ser_nome = '$nome_servico',";
        	$sql_comando .= "ser_descricao = '$descricao',";            
        	$sql_comando .= "ser_valor_tabela = '$valor_tabela',";
        	$sql_comando .= "ser_custo_estimado = '$custo_estimado',";
			$sql_comando .= "ser_valor_venda = '$valor_venda',";
			$sql_comando .= "ser_tempo_minutos = '$tempo_minutos'";
        	$sql_comando .= "where ser_id = '".$_SESSION['reg_servicos']."'";

        	//echo $sql_comando.'<br>';
			$sql = mysqli_query($conn, $sql_comando);
			
			//*************************     ARQUIVOS     *************************************    

        	if ($sql){
        	    unset($_SESSION['reg_servicos']);
        	    $_SESSION['msg'] = "Serviço alterado com sucesso... ";
        	    //$_SESSION['msg'] = $sql_comando;
        		header("Location: lista_servicos.php");
        	}else{  
        	    unset($_SESSION['reg_servicos']);
        	    $_SESSION['msg'] = "Falha na alteração... ";
        	    //$_SESSION['msg'] = $sql_comando;	    
        	    header("Location: lista_servicos.php");
        	}

            break;

		case "inc":
            $nome_servico 	= strtoupper($_POST["txtNomeServicos"]);
            $descricao  	= strtoupper($_POST["txtDescricao"]);
        	$valor_tabela 	= number_format($_POST["txtValorTabela"], 2, ',', '.');
            $custo_estimado = number_format($_POST["txtCustoEstimado"], 2, ',', '.');
            $valor_venda    = number_format($_POST["txtValorvenda"], 2, ',', '.');
			$tempo_minutos	= strtoupper($_POST["txtTempoMinutos"]);

            $sql_comando = "INSERT INTO servicos VALUES(";
            $sql_comando .= "'$id','$nome_servico','$descricao','$valor_tabela','$custo_estimado','$valor_venda','$tempo_minutos')";
			$sql = mysqli_query($conn, $sql_comando);

			if ($sql){
        	    $_SESSION['msg'] = "Serviço Incluido com sucesso...";
        		header("Location: lista_servicos.php");
        	}else{
        	    $_SESSION['msg'] = "Falha na inclusão... ";
        	    header("Location: lista_serviços.php");
        	}
            break;
		case "exc":
			$ser_id     	= $_POST["ser_id"];
			$sql_comando	= "DELETE FROM servicos WHERE ser_id = '$ser_id' ";
			$sql = mysqli_query($conn, $sql_comando);
			break;
	}
?>
