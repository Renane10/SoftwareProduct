<script type="text/javascript">

function readURL(e){
    if(e.files&&e.files[0]){
        var r=new FileReader;
        r.onload=function(e){
            $("#imgf").attr("src",e.target.result)
        },
        r.readAsDataURL(e.files[0])}
    }
    
    function checkFile(e){
            var r=e.value,a=r.substr(r.lastIndexOf(".")+1),n=e.files[0].size,t=(n/5485760).toFixed(2);
            if("jpg"!=a||n>5485760){var i="Formato: "+a+"\n\n";
            return i+="Tamanho: "+t+" MB \n\n",i+="Certifique-se de que o arquivo está em formato jpg e é menor que 5 MB.\n\n",alert(i),e.value="",!1}
        return!0
    }   
    
    function checkFile2(e){var n=e.value,t=n.substr(n.lastIndexOf(".")+1),a=e.files[0].size,i=(a/5485760).toFixed(2);if("pdf"!=t||a>5485760){var o="Formato: "+t+"\n\n";return o+="Tamanho: "+i+" MB \n\n",o+="Certifique-se de que o arquivo está em formato pdf e é menor que 5 MB.\n\n",alert(o),e.value="",!1}return!0}const icons={"application/pdf":"http://iconbug.com/data/5b/507/52ff0e80b07d28b590bbc4b30befde52.png"},input=document.querySelector("#upload-photo"),image=document.querySelector("#pdfimg");input.addEventListener("change",function(){for(var e=0;e<this.files.length;e++){var n=new Image;n.src=icons[this.files[e].type],n.className="thumbs",thumbs.appendChild(n);var t=document.createElement("span");t.innerHTML=this.files[e].name,thumbs.appendChild(t)}}); 
    
</script>
<?php
	session_start();
	include_once("conexao.php");

	$tabDepend = '<div class="container">';
	
	// linha foto
	$tabDepend .= '<div  class="row">';
        $tabDepend .= '<div  class="col-md-3"><label class="control-label">Foto</label></div>';
        $tabDepend .= '<div class="col-md-6">
		<input type="hidden" name="MAX_FILE_SIZE" value="6000000" />
		<input type="file" id="files, hidden_field" class="logo-upload btn btn-primary" onchange="readURL(this); checkFile(this);" name="fanexo" accept=".jpg, .jpeg, image/jpeg, image/jpg">
		</div>';
	$tabDepend .= '</div></br>'; 
	//linha de ID
	$tabDepend .= '<div  class="row">';
        $tabDepend .= '<div  class="col-md-2"><label class="control-label">ID</label></div>';
        $tabDepend .= '<div  class="col-md-3" align="left"><input type="text" class="form-control" id="txt_Id" name="txtId" size="10px";></div>';
    $tabDepend .= '</div></br>';   
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
	//linha email
	$tabDepend .= '<div  class="col-md-2"><label class="control-label">E-Mail</label></div>';
	$tabDepend .= '<div  class="col-md-4"><input type="text" class="form-control" name="txtEMail" id="txtEMail" size="50px;"></div>';
	$tabDepend .= '</div></br>';
	
	//linha função
	$tabDepend .= '<div  class="row">';
	$tabDepend .= '<div  class="col-md-2"><label class="control-label">Cargo</label></div>';
	$tabDepend .= '<div  class="col-md-4"><select name="txtFuncao" class="form-control" id="txtFuncao">';
	
	$tabDepend .= '<option>Selecione um cargo</option>';
	        $tabDepend .= '<option value="ESTAGIARIO">ESTAGIARIO</option>';
			$tabDepend .= '<option value="TECNICO">TECNICO</option>';
			$tabDepend .= '<option value="CONSULTOR">CONSULTOR</option>';
			$tabDepend .= '<option value="GERENTE">GERENTE</option>';
			$tabDepend .= '<option value="ADMINISTRATIVO">ADMINISTRATIVO</option>';
			$tabDepend .= '<option value="EST ADMINISTRATIVO">EST ADMINISTRATIVO</option>';
	$tabDepend .= '</select></div></br>';
		//linha menu
	
		$tabDepend .= '<div  class="col-md-2"><label class="control-label text-right">Menu</label></div>';
		$tabDepend .= '<div  class="col-md-4"><select name="txtMenu" class="form-control" id="txtMenu">';
	
			$result_status = "select * from menu order by men_descricao";
			$resultado_status = mysqli_query($conn, $result_status);
	
		$tabDepend .= '<option>Selecione um Menu</option>';
				while($row_status = mysqli_fetch_assoc($resultado_status)){
	
					$tabDepend .= '<option value="'.$row_status['men_id'].'">'.$row_status['men_descricao'].'</option>';
	
				}
	
		$tabDepend .= '</select></div></br>';		
			
		$tabDepend .='</div></br>';
	
	//linha equipe
	$tabDepend .= '<div  class="row">';
	$tabDepend .= '<div  class="col-md-2"><label class="control-label">Equipe</label></div>';
	$tabDepend .= '<div  class="col-md-4"><select name="txtEquipe" class="form-control" id="txtEquipe">';

		$result_equipe = "select * from equipe order by eqp_descricao";
		$resultado_equipe = mysqli_query($conn, $result_equipe);
	$tabDepend .= '<option>Selecione uma Equipe</option>';
		while($row_equipe = mysqli_fetch_assoc($resultado_equipe)){

		$tabDepend .= '<option value="'.$row_equipe['eqp_id'].'">'.$row_equipe['eqp_descricao'].'</option>';
		}

	$tabDepend .= '</select></div></br>';
	//linha responsavel
	$tabDepend .= '<div  class="col-md-2"><label class="control-label">Resp.Equipe</label></div>';
	$tabDepend .= '<div  class="col-md-4"><select name="txtResp" class="form-control" id="txtResp">';

		$result_resp = "select * from usuario where usu_funcao ='GERENTE' and usu_status ='ATIVO' order by usu_nome";
		$resultado_resp = mysqli_query($conn, $result_resp);
	
	$tabDepend .= '<option>Selecione um Responsável</option>';
		while($row_resp = mysqli_fetch_assoc($resultado_resp)){

			$tabDepend .= '<option value="'.$row_resp['usu_id'].'">'.$row_resp['usu_nome'].'</option>';

		}

	$tabDepend .= '</select></div></div></br>';	
	
	//linha status
	$tabDepend .= '<div  class="row">';
	$tabDepend .= '<div  class="col-md-2"><label class="control-label text-right">Status</label></div>';
	$tabDepend .= '<div  class="col-md-4"><select name="txtStatus" class="form-control" id="txtStatus">';

		$result_status = "select * from status where sta_menu ='adm' order by sta_desc";
		$resultado_status = mysqli_query($conn, $result_status);

	$tabDepend .= '<option>Selecione um Status</option>';
			while($row_status = mysqli_fetch_assoc($resultado_status)){

				$tabDepend .= '<option value="'.$row_status['sta_desc'].'">'.$row_status['sta_desc'].'</option>';

			}

	$tabDepend .= '</select></div>';


    //linha ramal
    $tabDepend .= '<div  class="col-md-2"><label class="control-label">Ramal</label></div>';
    $tabDepend .= '<div  class="col-md-4"><input type="number" class="form-control" name="txtRamal" id="txtRamal" size="50px;"><br></div>';




	//Horários
    $tabDepend .= '<div  class="row">';
		$tabDepend .= '<div  class="col-md-2"><label class="control-label">Hora da Entrada</label></div>';
		$tabDepend .= '<div  class="col-md-2"><input type="time" class="form-control" name="txtEntrada" id="Entrada" size="20px;" required></div>';
	$tabDepend .= '<div  class="col-md-2"><label class="control-label">Hora da Saida</label></div>';
	$tabDepend .= '<div  class="col-md-2"><input type="time" class="form-control" name="txtSaida" id="txtSaida" size="20px;" required></div>';
	$tabDepend .= '<div  class="col-md-2"><label class="control-label">Tempo de Pausa</label></div>';
	$tabDepend .= '<div  class="col-md-2"><input type="time" name="txtPausa" class="form-control" id="txtPausa" required>';
	$tabDepend .= '</div>';
	echo $tabDepend;

?>