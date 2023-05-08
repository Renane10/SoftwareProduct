<?php  
    if (!isset($_SESSION)){   
    // server should keep session data for AT LEAST 1 hour
    ini_set('session.gc_maxlifetime', 43200);
    // each client should remember their session id for EXACTLY 1 hour
    session_set_cookie_params(43200);
    session_start(); // ready to go!;
    }

    include_once('conexao.php');
    include_once('sistema.php');

    $sql_comando = "Select * from servicos";

	$resultado = mysqli_query($conn, $sql_comando);
	$linhas = mysqli_num_rows($resultado);
?>
<script language=javascript>
function deleteServico(ser_id){
        $.ajax({
            url:"mysql_servicos.php",
            method:"post",
            data:{ser_id:ser_id,
                  btnAcao:'exc'}
        }).done(function() {
            window.location.reload(true);
        });
    }
$(document).ready(function(){
        $('.diag_data').click(function(){  
            var ser_id = $(this).attr("id");
            $('#ser_id').val(ser_id);
            $('#titulo_proc').val('Alteração de Serviço ');
            $.ajax({  
                url:"pesq_servicos_modal.php",  
                method:"post",  
                data:{ser_id:ser_id},  
                success:function(data){  
                    $('#ser_id').html(data);
                    $('#titulo_proc').html('Alteração de Serviço ');
                    $('#diagModal').modal("show");  
                }  
           }); 
        }); 
        $('.diag_incluir').click(function(){  
            var ser_id = $(this).attr("id");
            var msg_proc = ser_id;
            $('#novo_nome').val(ser_id);
            $('#titulo_inc').val('Inclusão de Serviço ');
            $.ajax({  
                url:"inc_servicos_modal.php",  
                method:"post",  
                data:{msg_proc:msg_proc},  
                success:function(data){  
                    $('#msg_novo').html(data);
                    $('#titulo_inc').html('Inclusão de Serviços ');
                    $('#diagIncluir').modal("show");  
                }  
           }); 
        });         
    });
</script>
<form method="POST" action="mysql_servicos.php" enctype="multipart/form-data">
<div class="container theme-showcase" role="main">
    <h1 class="h3 mb-2 text-gray-800">Relação de Serviços</h1>
        <p class="mb-4" style="font-size:15px;" style="text-transform:uppercase;"><?php echo $_SESSION['msg'];?></p>
    <? if($_SESSION['funcao'] == 'ADMINISTRATIVO'){?>
        <div class="col-md-12" align="right" style="margin-top: -66px;">
            <button type="button" id="<?php echo $linhas['ser_id'];?>" name="diag" value="diag" class="btn btn-success btn-icon-split diag_incluir">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Novo Serviço</span>
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
                                <th>ID</th>
                                <th>Nome do Serviço</th>
                                <th>Descrição</th>
                                <th>Valor de Tabela</th>
                                <th>Custo Estimado</th>
                                <th>Valor de Venda</th>
                                <th>Tempo para execução (minutos)</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nome do Serviço</th>
                                <th>Descrição</th>
                                <th>Valor de Tabela</th>
                                <th>Custo Estimado</th>
                                <th>Valor de Venda</th>
                                <th>Tempo para execução (minutos)</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                        <tbody style="text-transform:uppercase;">

                        <?php
                            while($linhas = mysqli_fetch_array($resultado)){
                                echo "<tr>";
                                echo "<td>".$linhas['ser_id']."</td>";
                                echo "<td>".$linhas['ser_nome']."</td>";
                                echo "<td>".$linhas['ser_descricao']."</td>";
                                echo "<td> R$ ".number_format($linhas['ser_valor_tabela'], 2, ',','.')."</td>";
                                echo "<td> R$ ".number_format($linhas['ser_custo_estimado'], 2, ',','.')."</td>";
                                echo "<td> R$ ".number_format($linhas['ser_valor_venda'], 2, ',','.')."</td>";
                                echo "<td>".$linhas['ser_tempo_minutos']."</td>";
                                echo "<td>";
                                ?>
                                    <!-- BOTÃO ALTERAR -->
                                    <a type="button" name="diag" value="diag" id="<?php echo $linhas['ser_id'];?>" class="btn btn-success btn-circle btn-sm diag_data" title="Alterar informações"><i class="fas fa-pencil-alt"></i></a>
                                    <a type="button"  onclick="deleteServico(<?= $linhas['ser_id'];?>)" class="btn btn-danger btn-circle btn-sm" title="Excluir Serviço"><i class="fas fa-close"></i></a>
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
                    <span class="glyphicon glyphicon-hdd" data-toggle="tooltip" data-placement="top" title="Inclusão Serviços"></span> Incluir
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
                <h5 class="modal-body" name="ser_id" id="ser_id"></h5>
                <input name="ser_id" type="hidden" id="ser_id">
            </div>
            <div class="modal-footer" style="background-color: #75ad74;">
                <button type="submit" class="btn btn-success btn-md" name="btnAcao" id="btnAcao" value="alt">
                    <span class="glyphicon glyphicon-wrench" data-toggle="tooltip" data-placement="top" title="Alterar Serviços"></span> Alterar
                </button>
            </div>
        </div>
    </div>
</div>
</form>