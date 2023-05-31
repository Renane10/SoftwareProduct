<?php
session_start();
include_once("conexao.php");
$q_usu = "select usu_id,usu_nome from usuarios where ativo = 'T' order by usu_id";
$res_usu = mysqli_query($conn,$q_usu);

$sql_comando = "Select * from agendamentos where id = ".$_POST['msg_proc'];
$sql = mysqli_query($conn, $sql_comando);

$q_cliente   = "select cli_id,cli_nome from clientes order by cli_id";
$res_cliente = mysqli_query($conn,$q_cliente);

$q_ser   = "select ser_id,ser_nome from servicos order by ser_id";
$res_ser = mysqli_query($conn,$q_ser);



//echo "CODIGO ".$_POST['msg_proc'];
$_SESSION['reg_agendamentos'] = $_POST['msg_proc'];

if(isset($_POST['msg_proc'])){


    while($row_dados = mysqli_fetch_array($sql)){

        $tabDepend = '<div class="container">';

        //linha de colaborador
        $tabDepend .= '<div  class="row">';
        $tabDepend .= '<div  class="col-md-2"><label class="control-label">Colaborador</label></div>';
        $tabDepend .= '<div class="col-md-4">
                    <select class="form-select" aria-label="Default select example" id="txtUsuario" name="txtUsuario" required></div>';
        while($usuario = mysqli_fetch_assoc($res_usu)){
            $tabDepend .='<option value="'.$usuario['usu_id'].'">'.$usuario['usu_nome'].'</option>';
        };
        $tabDepend .='</select></div>';
        $tabDepend .= '</div></br>';


        //linha de Data
        $tabDepend .= '<div  class="row">';
        $tabDepend .= '<div  class="col-md-2"><label class="control-label">Data do Serviço</label></div>';
        $tabDepend .= '<div  class="col-md-4"><input type="datetime-local" class="form-control" id="txtDate" name="txtDate" size="10px"; value="'.$row_dados['data'].'"></div>';
        $tabDepend .= '</div></br>';

        //linha de cliente
        $tabDepend .= '<div  class="row">';
        $tabDepend .= '<div class="col-md-2"><label class="control-label">Cliente</label></div>';
        $tabDepend .= '<div class="col-md-4">
                <select class="form-select" id="txtCliente" name="txtCliente" required>';
        while($cliente = mysqli_fetch_assoc($res_cliente)){
            $tabDepend .='<option value="'.$cliente['cli_id'].'">'.$cliente['cli_nome'].'</option>';
        };
        $tabDepend .= '</select></div></div></br>';

        //linha de serviços
        $tabDepend .= '<div  class="row">';
        $tabDepend .= '<div class="col-md-2"><label class="control-label">Serviço</label></div>';
        $tabDepend .= '<div class="col-md-4">
            <select class="form-select" aria-label="Default select example" id="txtServico" name="txtServico" required>';
        while($servico = mysqli_fetch_assoc($res_ser)){
            $tabDepend .='<option value="'.$servico['ser_id'].'">'.$servico['ser_nome'].'</option>';
        };
        $tabDepend .='</select></div></div></br>';
        //verificando se ele está ativo para dar checked no checkbox
        $row_dados['feito'] == 1 ? $checked = 'checked' : $checked = '';
        //linha de Feito checkbox
        $tabDepend .= '<div  class="row">';
        $tabDepend .= '<div  class="col-md-2"><label class="control-label">Feito</label></div>';
        $tabDepend .= '<div  class="col-md-4"> <input id="switch-shadow" class="switch switch--shadow" id="feito" name="feito" type="checkbox" '.$checked.' />
                                      <label for="switch-shadow"></div>';

        $tabDepend .= '</div></br>';
    }
    echo $tabDepend;
}
?>