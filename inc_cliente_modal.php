<?php
	session_start();
	include_once("conexao.php");

	$tabDepend = '<div class="container">';

	//linha de Telefone
	$tabDepend .= '<div  class="row">';
        $tabDepend .= '<div  class="col-md-2"><label class="control-label">Telefone</label></div>';
        $tabDepend .= '<div  class="col-md-4"><input type="text" class="form-control" id="txtTelefone" name="txtTelefone" size="10px";></div>';
    
    //linha de Endereço
        $tabDepend .= '<div class="col-md-2"><label class="control-label">Endereço</label></div>';
        $tabDepend .= '<div class="col-md-4"><input type="password" class="form-control" id="txtEndereço" name="txtEndereço" size="10px;"></div>';
    $tabDepend .= '</div></br>';  
    
	//linha Nome
    $tabDepend .= '<div  class="row">';
		$tabDepend .= '<div  class="col-md-2"><label class="control-label">Nome</label></div>';
		$tabDepend .= '<div  class="col-md-4"><input type="text" class="form-control" name="txtNome" id="txtNome" size="50px;"></div>';
	$tabDepend .= '</div>';
	echo $tabDepend;

?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
	 $('.telefone').mask('(00) 00000-0000');

