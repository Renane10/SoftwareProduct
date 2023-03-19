<?php
	session_start();	
	//Incluindo a conexão com banco de dados
	include_once("conexao.php");	

		$usuario = $_POST['txtUsuario'];
	    $senha = $_POST['txtSenha'];
			
		//Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
		$result_usuario = "SELECT * FROM usuarios WHERE usu_login = '$usuario' and usu_senha = '$senha' and ativo = 'T' LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		$resultado = mysqli_fetch_assoc($resultado_usuario);

		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		if(isset($resultado)){

			//$exibeUser = $resultado->fetch(PDO::FETCH_ASSOC);
		    
			$_SESSION['id'] = $resultado['usu_id'];
			$_SESSION['login'] = $resultado['usu_login'];
			$_SESSION['nome'] = $resultado['usu_nome'];
			$_SESSION['pwd'] = $resultado['usu_senha'];
			$_SESSION['msg'] = "";

            
			header("Location: tela_bemvindo.php");

			//echo $_SESSION['id'];

		//Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		//redireciona o usuario para a página de login
		}else{	
			//Váriavel global recebendo a mensagem de erro
			$_SESSION['msg'] = "Usuário ou senha incorreta";
			header("Location: index.php");
		}
?>