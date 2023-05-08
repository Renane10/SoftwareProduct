<?php
	session_start();
	include_once("conexao.php");

	$tabDepend = '<div class="container">';

    //linha de nome/tempo
    $tabDepend .= '<div  class="row">';
        $tabDepend .= '<div  class="col-md-4"><label class="control-label">Nome</label></div>';
        $tabDepend .= '<div  class="col-md-8"><input type="text" class="form-control" id="txtNomeServicos" name="txtNomeServicos" size="10px";></div>';
        $tabDepend .= '</div></br>';    
        
    //linha de tempo
    $tabDepend .= '<div  class="row">';
        $tabDepend .= '<div  class="col-md-4"><label class="control-label">Tempo (MIN)</label></div>';
        $tabDepend .= '<div  class="col-md-8"><input type="text" class="form-control" id="txtTempoMinutos" name="txtTempoMinutos" size="10px";></div>';
        $tabDepend .= '</div></br>';    

    //linha de valor tabela
    $tabDepend .= '<div  class="row">';
        $tabDepend .= '<div  class="col-md-4"><label class="control-label">Valor de tabela R$</label></div>';
        $tabDepend .= '<div  class="col-md-8"><input type="text" class="form-control money2" id="txtValorTabela" name="txtValorTabela" size="10px";></div>';
        $tabDepend .= '</div></br>';

    //linha de custo estimado
    $tabDepend .= '<div  class="row">';
        $tabDepend .= '<div  class="col-md-4"><label class="control-label">Custo estimado R$</label></div>';
        $tabDepend .= '<div  class="col-md-8"><input type="text" class="form-control money2" id="txtCustoEstimado" name="txtCustoEstimado" size="10px";></div>';
        $tabDepend .= '</div></br>';

    //linha de valor venda
        $tabDepend .= '<div  class="row">';
            $tabDepend .= '<div  class="col-md-4"><label class="control-label">Valor venda R$</label></div>';
            $tabDepend .= '<div  class="col-md-8"><input type="text" class="form-control money2" id="txtValorvenda" name="txtValorvenda" size="10px";></div>';
            $tabDepend .= '</div></br>';

    //linha de descrição
    $tabDepend .= '<div  class="row">';
        $tabDepend .= '<div class="mb-3">
        <label for="txtDescricao" class="form-label">Descrição</label>
        <textarea class="form-control" id="txtDescricao" name="txtDescricao" rows="3";></textarea></div>';

	echo $tabDepend;

?>  

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $('.money2').mask("#.##0,00", {reverse: true});
</script>