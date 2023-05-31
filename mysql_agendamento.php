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
        $usuario	= strtoupper($_POST["txtUsuario"]);
        $cliente	= strtoupper($_POST["txtCliente"]);
        $servico    = strtoupper($_POST["txtServico"]);
        $data 	    = converterDataHoraBd($_POST["txtDate"]);
        $_POST["feito"] == 'on' ? $feito = 1 : $feito = 0;


        $sql_comando = "update agendamentos set ";
        $sql_comando .= "usuario = '$usuario',";
        $sql_comando .= "cliente = '$cliente',";
        $sql_comando .= "servico = '$servico',";
        $sql_comando .= "data = '$data',";
        $sql_comando .= "feito = '$feito'";
        $sql_comando .= "where id = {$_SESSION['reg_agendamentos']}";

        $sql = mysqli_query($conn, $sql_comando);

        //*************************     ARQUIVOS     *************************************

        if ($sql){
            unset($_SESSION['reg_agendamentos']);
            $_SESSION['msg'] = "Agendamento alterado com sucesso... ";
            //$_SESSION['msg'] = $sql_comando;
            header("Location: lista_agendamento.php");
        }else{
            unset($_SESSION['reg_agendamentos']);
            $_SESSION['msg'] = "Falha na alteração... ";
            //$_SESSION['msg'] = $sql_comando;
            header("Location: lista_agendamento.php");
        }

        break;

    case "inc":
        $data 	    = converterDataHoraBd($_POST["txtDate"]);
        $usuario    = $_POST["txtUsuario"];
        $cliente	= $_POST["txtCliente"];
        $servico	= $_POST["txtServico"];


        $sql_comando = "INSERT INTO agendamentos VALUES(";
        $sql_comando .= "'','$data','$usuario','$cliente','$servico','0')";
        $sql = mysqli_query($conn, $sql_comando);

        if ($sql){
            $_SESSION['msg'] = "Agendamento Incluido com sucesso...";
            header("Location: lista_agendamento.php");
        }else{
            $_SESSION['msg'] = "Falha na inclusão... ";
            header("Location: lista_agendamento.php");
        }
        break;
    case "exc":
        $cli_id     = $_POST["id"];
        $sql_comando = "DELETE FROM agendamentos WHERE id = '$id' ";
        $sql = mysqli_query($conn, $sql_comando);
        break;
}
?>