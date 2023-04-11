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
            $login 	= strtoupper($_POST["txtLogin"]);
        	$senha 	= strtoupper($_POST["txtSenha"]);
        	$nome   = strtoupper($_POST["txtNome"]);
            $_POST["ativo"] == 'on' ? $ativo = 'T' : $ativo = 'F';

			$sql_comando = "update clients set ";
        	$sql_comando .= "cli_login = '$login',";
        	$sql_comando .= "cli_senha = '$senha',";            
        	$sql_comando .= "cli_nome = '$nome',";
        	$sql_comando .= "ativo = '$ativo'";
        	$sql_comando .= "where cli_id = '".$_SESSION['reg_cliente']."'";
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
            $login 	= strtoupper($_POST["txtLogin"]);
        	$senha 	= strtoupper($_POST["txtSenha"]);	
        	$nome   = strtoupper($_POST["txtNome"]);

            $sql_comando = "INSERT INTO usuarios VALUES(";
            $sql_comando .= "'','$login','$nome','$senha','T')";
			$sql = mysqli_query($conn, $sql_comando);

			if ($sql){
        	    $_SESSION['msg'] = "Cliente Incluido com sucesso...";
        		header("Location: lista_clientes.php");
        	}else{
        	    $_SESSION['msg'] = "Falha na inclusão... ";
        	    header("Location: lista_clientes.php");
        	}
            break;
    }
?>