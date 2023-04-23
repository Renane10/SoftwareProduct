<?php
	session_start();
	include_once("conexao.php");

	$tabDepend = '<div class="container">';

	//linha de login
	$tabDepend .= '<div  class="row">';
        $tabDepend .= '<div  class="col-md-2"><label class="control-label">Nome</label></div>';
        $tabDepend .= '<div  class="col-md-4"><input type="text" class="form-control" id="txtNome" name="txtNome" size="10px";></div>';
    
    //linha de Senha
        $tabDepend .= '<div class="col-md-2"><label class="control-label">Telefone</label></div>';
        $tabDepend .= '<div class="col-md-4"><input type="text" class="form-control" id="txtTelefone" name="txtTelefone" size="10px;"></div>';
    $tabDepend .= '</div></br>';  
    
	//linha nome
    $tabDepend .= '<div  class="row">';
		$tabDepend .= '<div  class="col-md-2"><label class="control-label">Endereço</label></div>';
		$tabDepend .= '<div  class="col-md-4"><input type="text" class="form-control" name="txtEndereço" id="txtEndereço" size="50px;"></div>';
	$tabDepend .= '</div>';
	echo $tabDepend;

?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
	 var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

$('#txtTelefone').mask(SPMaskBehavior, spOptions);