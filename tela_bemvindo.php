<?php
if (!isset($_SESSION)){
// server should keep session data for AT LEAST 1 hour
    ini_set('session.gc_maxlifetime', 43200);
// each client should remember their session id for EXACTLY 1 hour
    session_set_cookie_params(43200);
    session_start(); // ready to go!;
}
require_once("conexao.php");
require_once("sistema.php");

?>

<div align="center">
    <h2>Bem-vindo ao Tech ERP</h2>
    <h5>Renan Oliveira Gomes da Silva - 5B</h5>
    <img src="images/logo.png" alt="Logo Tech ERP" width="15%">
</div>
