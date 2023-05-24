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
            $nome 	= strtoupper($_POST["txtNome"]);
        	$endereco 	= strtoupper($_POST["txtEndereco"]);
        	$telefone   = extract_numbers_tel($_POST["txtTelefone"]);
    

			$sql_comando = "update clientes set ";
        	$sql_comando .= "cli_nome = '$nome',";
        	$sql_comando .= "cli_telefone = '$telefone',";            
        	$sql_comando .= "cli_endereco = '$endereco'";
        	$sql_comando .= "where cli_id = '".$_SESSION['reg_clientes']."'";
        	//echo $sql_comando.'<br>';
			$sql = mysqli_query($conn, $sql_comando);
			
			//*************************     ARQUIVOS     *************************************    

        	if ($sql){
        	    unset($_SESSION['reg_cliente']);
        	    $_SESSION['msg'] = "Cliente alterado com sucesso... ";
        	    //$_SESSION['msg'] = $sql_comando;
        		header("Location: lista_clientes.php");
        	}else{
        	    unset($_SESSION['reg_cliente']);
        	    $_SESSION['msg'] = "Falha na alteração... ";
        	    //$_SESSION['msg'] = $sql_comando;	    
        	    header("Location: lista_clientes.php");
        	}

            break;

		case "inc":
            $data 	    = converterDataHoraBd($_POST["txtDate"]);
        	$usuario    = $_POST["txtUsuario"];
			$cliente	= $_POST["txtCliente"];
			$servico	= $_POST["txtServico"];

    
            $sql_comando = "INSERT INTO agendamentos VALUES(";
            $sql_comando .= "'','$data','$usuario','$cliente','$servico','0')";
			$sql = mysqli_query($conn, $sql_comando);

			if ($sql){
        	    $_SESSION['msg'] = "Serviço Incluido com sucesso...";
        		header("Location: lista_agendamento.php");
        	}else{
        	    $_SESSION['msg'] = "Falha na inclusão... ";
        	    header("Location: lista_agendamento.php");
        	}
            break;
		case "exc":
			$cli_id     = $_POST["cli_id"];
			$sql_comando = "DELETE FROM clientes WHERE cli_id = '$cli_id' ";
			$sql = mysqli_query($conn, $sql_comando);
			break;
		}
?>