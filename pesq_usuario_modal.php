<?php
	session_start();
	include_once("conexao.php");

	//echo "CODIGO ".$_POST['msg_proc'];
	$_SESSION['reg_usuario'] = $_POST['msg_proc'];
	
	if(isset($_POST['msg_proc'])){
	    $sql_comando = "Select * from usuarios where usu_id = ".$_POST['msg_proc'];
		$sql = mysqli_query($conn, $sql_comando);

        while($row_dados = mysqli_fetch_array($sql)){

			$tabDepend = '<div class="container">';

            //linha de login/senha
			$tabDepend .= '<div  class="row">';
                $tabDepend .= '<div  class="col-md-2"><label class="control-label">Login</label></div>';
                $tabDepend .= '<div  class="col-md-4"><input type="text" class="form-control" id="txtLogin" name="txtLogin" size="10px"; value="'.$row_dados['usu_login'].'"></div>';

            //botão de Senha
                $tabDepend .= '<div class="col-md-2"><label class="control-label">Senha</label></div>';
                $tabDepend .= '<div class="col-md-4"><input type="password" class="form-control" id="txtSenha" name="txtSenha" size="10px;" value="'.$row_dados['usu_senha'].'"></div>';
            $tabDepend .= '</div></br>';  
            
			//linha nome/ativo
            $tabDepend .= '<div  class="row">';
    			$tabDepend .= '<div  class="col-md-2"><label class="control-label">Nome</label></div>';
    			$tabDepend .= '<div  class="col-md-4"><input type="text" class="form-control" name="txtNome" id="txtNome" size="50px;" value="'.$row_dados['usu_nome'].'"></div>';

                //verificando se ele está ativo para dar checked no checkbox
                $row_dados['ativo'] == 'T' ? $checked = 'checked' : $checked = '';
                //botão ativo
    			$tabDepend .= '<div  class="col-md-2"><label class="control-label">Ativo</label></div>';
    			$tabDepend .= '<div  class="col-md-4">   <input id="switch-shadow" class="switch switch--shadow" id="ativo" name="ativo" type="checkbox" '.$checked.' />
                                      <label for="switch-shadow"></label></div>';
            }

	        $tabDepend .= '</div>';
	echo $tabDepend;
    }
?>