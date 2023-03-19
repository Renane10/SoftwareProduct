<?php
	session_start();
	include_once("conexao.php");

	$tabDepend = '<div class="container">';

	//linha de login
	$tabDepend .= '<div  class="row">';
        $tabDepend .= '<div  class="col-md-2"><label class="control-label">Login</label></div>';
        $tabDepend .= '<div  class="col-md-4"><input type="text" class="form-control" id="txtLogin" name="txtLogin" size="10px";></div>';
    
    //linha de Senha
        $tabDepend .= '<div class="col-md-2"><label class="control-label">Senha</label></div>';
        $tabDepend .= '<div class="col-md-4"><input type="password" class="form-control" id="txtSenha" name="txtSenha" size="10px;"></div>';
    $tabDepend .= '</div></br>';  
    
	//linha nome
    $tabDepend .= '<div  class="row">';
		$tabDepend .= '<div  class="col-md-2"><label class="control-label">Nome</label></div>';
		$tabDepend .= '<div  class="col-md-4"><input type="text" class="form-control" name="txtNome" id="txtNome" size="50px;"></div>';
	$tabDepend .= '</div>';
	echo $tabDepend;

?>