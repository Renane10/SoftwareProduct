<?php  
    if (!isset($_SESSION)){   
    // server should keep session data for AT LEAST 1 hour
    ini_set('session.gc_maxlifetime', 43200);
    // each client should remember their session id for EXACTLY 1 hour
    session_set_cookie_params(43200);
    session_start(); // ready to go!;
    }
    include_once('sistema.php');

    $sql_comando = "Select * from agendamentos order by data";

	$resultado = mysqli_query($conn, $sql_comando);
	$linhas = mysqli_num_rows($resultado);
    $_SESSION['msg'] = "usuario ".$_SESSION['nome'];
?>
<script language=javascript>
    $(document).ready(function(){
        $('.diag_data').click(function(){  
            var usu_id = $(this).attr("id");
            var msg_proc = usu_id;
            $('#usu_nome').val(usu_id);
            $('#titulo_proc').val('Alteração de agendamento ');
            $.ajax({  
                url:"pesq_agendamento_modal.php",
                method:"post",  
                data:{msg_proc:msg_proc},  
                success:function(data){  
                    $('#msg_proc').html(data);
                    $('#titulo_proc').html('Alteração de agendamento ');
                    $('#diagModal').modal("show");  
                }  
           }); 
        }); 
        $('.diag_incluir').click(function(){  
            var usu_id = $(this).attr("id");
            var msg_proc = usu_id;
            $('#novo_nome').val(usu_id);
            $('#titulo_inc').val('Inclusão de agendamento ');
            $.ajax({  
                url:"inc_agendamento_modal.php",
                method:"post",  
                data:{msg_proc:msg_proc},  
                success:function(data){  
                    $('#msg_novo').html(data);
                    $('#titulo_inc').html('Inclusão de agendamento ');
                    $('#diagIncluir').modal("show");  
                }  
           }); 
        });         
    });
</script>
<form method="POST" action="mysql_agendamento.php" enctype="multipart/form-data">
<div class="container theme-showcase" role="main">
    <h1 class="h3 mb-2 text-gray-800">Agendamentos de serviços</h1>
        <p class="mb-4" style="font-size:15px;" style="text-transform:uppercase;"></p>
    <? if($_SESSION['funcao'] == 'ADMINISTRATIVO'){?>
        <div class="col-md-12" align="right" style="margin-top: -66px;">
            <button type="button" id="<?php echo $linhas['usu_id'];?>" name="diag" value="diag" class="btn btn-success btn-icon-split diag_incluir">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Realizar agendamento</span>
            </button>    
        </div>

    <?}?>
        <br>
    <!-- DataTales Example -->
    <div class="card mb-4" style="border-top:.25rem solid #3299CC!important">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Usuario</th>
                                <th>Cliente</th>
                                <th>Serviço</th>
                                <th>Realizado?</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Data</th>
                                <th>Usuario</th>
                                <th>Cliente</th>
                                <th>Serviço</th>
                                <th>Realizado?</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                        <tbody style="text-transform:uppercase;">

                        <?php
                            while($linhas = mysqli_fetch_array($resultado)){
                                $linhas['feito'] == 1 ? $feito = '<i class="fa-regular fa-circle-check text-success"></i>' : $feito ='<i class="fa-regular fa-circle-xmark text-danger"></i>';
                                $q_usu = 'select usu_nome from usuarios where usu_id = '.$linhas['usuario'];
                                $res = mysqli_query($conn, $q_usu);
                                $usu = mysqli_fetch_assoc($res);
                                $q_cliente = 'select cli_nome from clientes where cli_id = '.$linhas['cliente'];
                                $res_cli = mysqli_query($conn, $q_cliente);
                                $cli = mysqli_fetch_assoc($res_cli);
                                $q_cliente = 'select ser_nome from servicos where ser_id = '.$linhas['servico'];
                                $res_cli = mysqli_query($conn, $q_cliente);
                                $ser = mysqli_fetch_assoc($res_cli);
                                echo "<tr>";
                                echo "<td>".converterDataHoraDisplay($linhas['data'])."</td>";
                                echo "<td>".$usu['usu_nome']."</td>";
                                echo "<td>".$cli['cli_nome']."</td>";
                                echo "<td>".$ser['ser_nome']."</td>";
                                echo "<td>".$feito."</td>";
                                echo "<td>";
                                ?>
                                    <!-- BOTÃO ALTERAR -->
                                    <a type="button" name="diag" value="diag" id="<?php echo $linhas['id'];?>" class="btn btn-success btn-circle btn-sm diag_data" title="Alterar informações"><i class="fas fa-pencil-alt"></i></a>

                                <?php

                            }
                                echo "</td>";
                                echo "</tr>";
                        ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
<!-- Modal Inclusao-->
<div class="modal fade" id="diagIncluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #75ad74;">
                <h4 class="modal-title" id="titulo_inc" style="color:white;align:center; font-size:24px;" align="center" ></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-body" name="msg_novo" id="msg_novo"></h5>
                <input name="novo_nome" type="hidden" id="novo_nome">
            </div>
            <div class="modal-footer" style="background-color: #75ad74;">
                <button type="submit" class="btn btn-success btn-md" name="btnAcao" id="btnAcao" value="inc">
                    <span class="glyphicon glyphicon-hdd" data-toggle="tooltip" data-placement="top" title="Inclusão Usuario"></span> Incluir
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Alteração-->
<div class="modal r-modal success fade" id="diagModal" role="dialog">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #75ad74;">
                <h3 class="modal-title" id="titulo_proc" style="color:white;text-align: center;"></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-body" name="msg_proc" id="msg_proc"></h5>
                <input name="usu_nome" type="hidden" id="usu_nome">
            </div>
            <div class="modal-footer" style="background-color: #75ad74;">
                <button type="submit" class="btn btn-success btn-md" name="btnAcao" id="btnAcao" value="alt">
                    <span class="glyphicon glyphicon-wrench" data-toggle="tooltip" data-placement="top" title="Alterar Usuario"></span> Alterar
                </button>
            </div>
        </div>
    </div>
</div>
</form>
