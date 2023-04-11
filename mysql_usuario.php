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

			$sql_comando = "update usuarios set ";
        	$sql_comando .= "usu_login = '$login',";
        	$sql_comando .= "usu_senha = '$senha',";            
        	$sql_comando .= "usu_nome = '$nome',";
        	$sql_comando .= "ativo = '$ativo'";
        	$sql_comando .= "where usu_id = '".$_SESSION['reg_usuario']."'";
        	//echo $sql_comando.'<br>';
			$sql = mysqli_query($conn, $sql_comando);
			
			//*************************     ARQUIVOS     *************************************    

        	if ($sql){
        	    unset($_SESSION['reg_usuario']);
        	    $_SESSION['msg'] = "Usuário alterado com sucesso... ";
        	    //$_SESSION['msg'] = $sql_comando;
        		header("Location: lista_usuarios.php");
        	}else{
        	    unset($_SESSION['reg_usuario']);
        	    $_SESSION['msg'] = "Falha na alteração... ";
        	    //$_SESSION['msg'] = $sql_comando;	    
        	    header("Location: lista_usuarios.php");
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
        	    $_SESSION['msg'] = "Usuário Incluido com sucesso...";
        		header("Location: lista_usuarios.php");
        	}else{
        	    $_SESSION['msg'] = "Falha na inclusão... ";
        	    header("Location: lista_usuarios.php");
        	}
            break;

		case "exc":
            $usu_id 	= $_POST["usu_id"];

            $sql_comando = "DELETE FROM usuarios WHERE usu_id = '$usu_id' ";
			$sql = mysqli_query($conn, $sql_comando);
            break;
    }
?>