<?php
if (!isset($_SESSION)) session_start();

if (empty($_SESSION['id'])) {

}else{
	$_SESSION['msg'] = "Você já está logado(a) no sistema!";
	header("Location: sistema.php");
}
//cor fundo #314559 / RGB(49,69,89)
//cor btn-primary #3d7bae / RGB(61,123,174)
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Login</title>
		<link rel="icon" href="images/logo.png" type="image/ico">
		<link href="login/css/bootstrap.css" rel="stylesheet">
		<link href="login/css/signin.css" rel="stylesheet">
    	<link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    	<!-- Custom styles for this template-->
    	<link href="css/sb-admin-2.min.css" rel="stylesheet">
	</head>
	<body style="background: #7ba7ed;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
								<center><div class="logo">
									<br>
									<a href="index.php"><img src="images/logo.png" width="50" height="50"></a>
									<font face="impact" size="5px" color="white">Tech ERP</font>
								</div></center>
							</div>
                            <div class="col-lg-6">
                                <div class="p-5">
								<?php
								$ip = $_SERVER['REMOTE_ADDR'];
								?>
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Olá, seja bem-vind@!</h1>
										<p><? echo $ip;?> é o seu endereço de ip.</p>
                                    </div>
                                    <script>
										<?php
                                        if(isset($_SESSION['msgcad'])or $_SESSION['msgcad']==''){
                                            echo " swal.fire({
                                                icon: 'error',
                                                title: '".$_SESSION['msgcad']."',
                                                showConfirmButton: false,
                                                timer: 2500
                                                });";
                                        }
											if(isset($_SESSION['msg']) or $_SESSION['msg']=='' ){
                                                echo " swal.fire({
                                                icon: 'error',
                                                title: '".$_SESSION['msg']."',
                                                showConfirmButton: false,
                                                timer: 2500
                                                });";

											}

										?>
                                    </script>
										<form class="user" method="POST" action="valida.php">
											<div class="form-group">
												<input type="text" name="txtUsuario" placeholder="Digite o seu usuário" class="form-control form-control-user"><br>
											</div>
											<div class="form-group">	
												<input type="password" name="txtSenha" placeholder="Digite a sua senha" class="form-control form-control-user"><br>
											</div>				
										<input type="submit" name="btnLogin" value="Acessar" class="btn btn-primary btn-user btn-block">
										</form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>