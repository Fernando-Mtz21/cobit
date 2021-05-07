<?php 
session_start();
include('cliente/controladoroad.php');
if(isset($_SESSION['cliente'])){
	header("location:consulta.php");
} else if (isset($_POST['send'])){
	$pass_cliente = $_POST['password'];
	$correo_cliente = $_POST['correo'];
	$usuario = Controlador::acceder($correo_cliente, $pass_cliente);
	if($usuario){
		$_SESSION['cliente'] = array(
			'id' => $usuario->getId_cliente(),
			'nombre' => $usuario->getNom_cliente(),
			'apellido' => $usuario->getApell_cliente(),
			'fec_nac' => $usuario->getFec_nac_cliente(),
			'edad' => $usuario->getEdad_cliente(),
			'telefono' => $usuario->getTel_cliente(),
			'correo' => $usuario->getCorreo_cliente(),
			'sexo' => $usuario->getSexo_cliente(),
			't_sang' => $usuario->getT_sang_cliente(),
			'peso' => $usuario->getPeso_cliente(),
			'altura' => $usuario->getAltura_cliente()
		);
		header("location:consulta.php");
	}else{
		echo "<script>window.alert('Usuario no enontrado, verifique los datos');</script>";
	}
}
//$r = Controlador::ic();
//print_r ($r);
//echo '<br>';
//echo $r;
?>
<!DOCTYPE html>
<html lang="es-MX">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title>Login</title>
		<link rel="stylesheet" href="log.css">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" type="text/css" href="../icon/styles.css">
	</head>
	<body>
		<header id="header" class="sticky">
        	<a href="index.html" class="logo">Co<span>bit</span>19</a>
    	</header>
		<div class="container-all">
			<div class="ctn-form">
				<h1 class="title">Iniciar Sesi&oacute;n</h1>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
					<label for="">Ingrese su correo electr&oacute;nico</label>
					<input type="text" placeholder="Correo" name="correo">
					<label for="">Ingrese su contrase&ntilde;a</label>
					<input type="password" placeholder="Password" name="password">
					<input type="submit" name="send">
				</form>
				<span class="text-footer">¿No tienes una cuenta? <a href="singup.php">Crea una cuenta</a><br>¿Es usted un m&eacute;dico de esta p&aacute;gina? <a href="log_dr.php">Inicie sesi&oacute;n</a></span>
			</div>
			
			<div class="ctn-text im2">
				<div class="capa"></div>
				<h1 class="title-description">Hola, usuario</h1>
				<p class="text-description">En esta secci&oacute;n se le pide introducir el correo electr&oacute;nico y contrase&ntilde;a otorgado por usted anteriormente, en caso de que no tenga una cuenta creada puede crear una nueva dando clic en la parte inferior del formulario.</p>
			</div>
		</div>
	</body>
</html>