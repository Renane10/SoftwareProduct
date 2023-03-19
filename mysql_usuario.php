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
			$ID 	= strtoupper($_POST["txtId"]);
            $login 	= strtoupper($_POST["txtLogin"]);
        	$senha 	= strtoupper($_POST["txtSenha"]);
        	$nome   = strtoupper($_POST["txtNome"]);
        	$funcao = strtoupper($_POST["txtFuncao"]);
        	$email 	= strtoupper($_POST["txtEMail"]);	
        	$equipe	= strtoupper($_POST["txtEquipe"]);	
        	$dtAlt 	= date('Y-m-d');	
        	$status	= strtoupper($_POST["txtStatus"]);	
        	$resp 	= strtoupper($_POST["txtResp"]);	
        	$menu 	= strtoupper($_POST["txtMenu"]);	
        	$ramal 	= strtoupper($_POST["txtRamal"]);
        	$dtAlt 	= date('Y-m-d');
        	$altPor	= $_SESSION['id'];
            
			$sql_comando = "update usuario set ";
			$sql_comando .= "usu_id = '$ID',";
        	$sql_comando .= "usu_login = '$login',";
        	$sql_comando .= "usu_senha = '$senha',";            
        	$sql_comando .= "usu_nome = '$nome',";
        	$sql_comando .= "usu_email = '$email',";
        	$sql_comando .= "usu_funcao = '$funcao',";
        	$sql_comando .= "usu_status = '$status',";
        	$sql_comando .= "usu_id_alt = '$altPor',";
        	$sql_comando .= "eqp_id = '$equipe',";
        	$sql_comando .= "usu_resp = '$resp',";
        	$sql_comando .= "men_id = '$menu',";
        	$sql_comando .= "ramal = '$ramal',";
        	$sql_comando .= "usu_dt_alt = '$dtAlt' ";
        	$sql_comando .= "where usu_id = ".$_SESSION['reg_usuario'];
        	
			$sql = mysqli_query($conn, $sql_comando);


			$entrada 	= strtoupper($_POST["txtEntrada"]);
			$saida 	= strtoupper($_POST["txtSaida"]);
			$pausa 	= strtoupper($_POST["txtPausa"]);
			$sql_comando2 = "update horario set ID = '$ID', entrada ='$entrada', pausa = '$pausa', saida = '$saida' where ID ='$ID'";
            write_log([$sql,$sql_comando2],'usuario');
			$sql2 = mysqli_query($conn, $sql_comando2);
			
			//*************************     ARQUIVOS     *************************************    
    //if(!isset($_FILES['fanexo']['name'])){
        //Cria diretorio e grava imagem
        $nome_imagem = $_FILES['fanexo']['name'];
        
		$currentName = $_FILES['fanexo']['name'];
		$parts = explode(".", $currentName);
		$extension = array_pop($parts);
		
		$newName = md5($currentName . microtime());
		$destination = "foto/{$newName}.{$extension}";
		
		$newName = $login;
		$destination = "foto/{$newName}.jpg";
        //Verificar se é possive mover o arquivo para a pasta escolhida
    	if(move_uploaded_file($_FILES['fanexo']['tmp_name'],$_UP['pasta'].$destination)){
    	}else{
    	    echo "Não foi possivel salva a imagem !".$_UP['pasta'].$nome_imagem;   
		}
		
	
        	
        	if ($sql){
        	    unset($_SESSION['reg_usuario']);
        	    $_SESSION['msg'] = "Usuário alterado com sucesso... ";
        	    //$_SESSION['msg'] = $sql_comando;
        		header("Location: sistema.php?pg=4");
        	}else{
        	    unset($_SESSION['reg_usuario']);
        	    $_SESSION['msg'] = "Falha na alteração... ";
        	    //$_SESSION['msg'] = $sql_comando;	    
        	    header("Location: sistema.php?pg=4");
        	}

            break;
        case "exc":

            $sql_comando = "update usuario set ";
            $sql_comando .= "usu_status = 'EXCLUIDO', ";
            $sql_comando .= "usu_id_alt = '".$_SESSION['id']."', ";
            $sql_comando .= "usu_dt_alt = '".date('Y-m-d')."' ";            
            $sql_comando .= "where usu_id = ".$_POST['recipient-id']; 

            //echo $sql_comando;

        	$sql = mysqli_query($conn, $sql_comando);
        	
        	if ($sql){
        	    $_SESSION['msg'] = "Usuário excluido com sucesso... ";
        	    //$_SESSION['msg'] = $sql_comando;
        		header("Location: sistema.php?pg=4");
        	}else{
        	    $_SESSION['msg'] = "Falha na exclusao... ";
        	    //$_SESSION['msg'] = $sql_comando;	    
        	    header("Location: sistema.php?pg=4");
        	}

            break;
        case "pes":
            echo $parametro;            
            break;
		case "inc":
			$ID 	= strtoupper($_POST["txtId"]);
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
            $ramal 	= strtoupper($_POST["txtRamal"]);
            $dtAlt 	= date('Y-m-d');
        	$altPor	= $_SESSION['id'];
        
            $sql_ultreg = "Select max(usu_id)+1 as reg from usuario ";
            $sql_reg = mysqli_query($conn, $sql_ultreg);
            
            $row_reg = mysqli_fetch_array($sql_reg);
            $reg_novo = $row_reg['reg'];

            $token = bin2hex(openssl_random_pseudo_bytes(20));
            $secure = rand(1000000000, 9999999999);

            $sql_comando = "INSERT INTO usuario VALUES(";
            $sql_comando .= "'$ID','$nome','$email','$funcao','$status','$dtCad','$altPor','$equipe','$resp','$senha','$login','$menu','$dtAlt',
	        '$token','$secure',now(),'ramal')";
			$sql = mysqli_query($conn, $sql_comando);

			$sql_comando2 = "insert into horario values('$ID','$entrada','$pausa',$saida'";
			$sql2 = mysqli_query($conn, $sql_comando);
            write_log([$sql_comando,$sql_comando2],'usuario');
			if ($sql){
        	    $_SESSION['msg'] = "Usuário Incluido com sucesso...";
        	    //$_SESSION['msg'] = $sql_comando;
        		header("Location: sistema.php?pg=4");
        	}else{
        	    $_SESSION['msg'] = "Falha na inclusão... ";
        	    //$_SESSION['msg'] = $sql_comando;	    
        	    header("Location: sistema.php?pg=4");
        	}
		
	//*************************     ARQUIVOS     *************************************    
    //if(!isset($_FILES['fanexo']['name'])){
        //Cria diretorio e grava imagem
        $nome_imagem = $_FILES['fanexo']['name'];
        
		$currentName = $_FILES['fanexo']['name'];
		$parts = explode(".", $currentName);
		$extension = array_pop($parts);
		
		$newName = md5($currentName . microtime());
		$destination = "foto/{$newName}.{$extension}";
		
		$newName = $login;
		$destination = "foto/{$newName}.jpg";
        //Verificar se é possive mover o arquivo para a pasta escolhida
    	if(move_uploaded_file($_FILES['fanexo']['tmp_name'],$_UP['pasta'].$destination)){
    	}else{
    	    echo "Não foi possivel salva a imagem !".$_UP['pasta'].$nome_imagem;   
		}
		
	
    //}
        	
        	if ($sql){
        	    $_SESSION['msg'] = "Usuário incluso com sucesso... ";
        	    //$_SESSION['msg'] = $sql_comando;
        		header("Location: sistema.php?pg=4");
        	}else{
        	    $_SESSION['msg'] = "Falha na inclusão... ";
        	    //$_SESSION['msg'] = $sql_comando;	    
        	    header("Location: sistema.php?pg=4");
        	}
            break;
        case "lim":
            $_SESSION['bdLogin'] = "";
            $_SESSION['bdSenha'] = "";
            $_SESSION['bdNome'] = "";
            $_SESSION['bdEmail'] = "";
            $_SESSION['bdFuncao'] = "";
            $_SESSION['bdEquipe'] = "";
            $_SESSION['bdResp'] = "";
            $_SESSION['bdStatus'] = "";    
            $_SESSION['bdDtCad'] = "";            
            break;            
    }
?>