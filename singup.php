<?php
include('cliente/controladoroad.php');
if(isset($_SESSION['cliente'])){
	header("location:consulta.php");
} else if(isset($_POST['send'])){
	$nom_cliente = $_POST['nombre'];
	$apell_cliente = $_POST['apellido'];
	$pass_cliente = $_POST['password'];
	$fec_nac_cliente = $_POST['fec_nac'];
	$date1=date_create($fec_nac_cliente);
	$date2=date_create(date("y-m-d"));
	$intervalo = date_diff($date1, $date2);
	$edad_cliente = intval($intervalo->format('%y'));
	#$edad_cliente = $_POST['edad'];
	$tel_cliente = $_POST['tel'];
	$correo_cliente = $_POST['correo'];
	$sexo_cliente = $_POST['sexo'];
	$t_sang_cliente = $_POST['t_sang'];
	$peso_cliente = $_POST['peso'];
	$altura_cliente = $_POST['altura'];
	if(Controlador::registrar($nom_cliente, $apell_cliente, $pass_cliente, $fec_nac_cliente, $edad_cliente, $tel_cliente, $correo_cliente, $sexo_cliente, $t_sang_cliente, $peso_cliente, $altura_cliente)){
		header("location:ins.php?correo={$correo_cliente}&pass={$pass_cliente}");
	}else{
		echo "<script>window.alert('Ocurrio un error, intente de nuevo');</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="es-MX">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title>Singup</title>
		<link rel="stylesheet" href="log.css">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" type="text/css" href="../icon/styles.css">
	</head>
	<body>
		<header id="header" class="sticky">
        	<a href="index.html" class="logo">Co<span>bit</span>19</a>
    	</header>
		<div class="container-all">
			<div class="ctn-text im1">
				<div class="capa"></div>
				<h1 class="title-description">Bienvenido, nuevo usuario</h1>
				<p class="text-description">En esta secci&oacute;n se le pide ingresar sus datos para crear una cuenta, esto con la finalidad de tener un orden adecuado para las futuras consultas pues de esta forma facilita al m&eacute;dico encargado la organizaci&oacute;n de los registros.</p>
			</div>
			
			<div class="ctn-form">
				<h1 class="title">Crear una cuenta</h1>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
					<label for="">Ingrese su nombre</label>
					<input type="text" placeholder="Nombre" name="nombre">
					<label for="">Ingrese su apellido</label>
					<input type="text" placeholder="apellido" name="apellido">
					<label for="">Ingrese su contrase&ntilde;a</label>
					<input type="password" placeholder="password" name="password">
					<label for="">Ingrese su fecha de nacimiento</label>
					<input type="date" placeholder="Fecha nacimiento" name="fec_nac">
					<label for="">Ingrese su tel&eacute;fono</label>
					<input type="text" placeholder="Telefono" name="tel">
					<label for="">Ingrese su correo electr&oacute;nico</label>
					<input type="text" placeholder="Correo" name="correo">
					<label for="">Ingrese su sexo</label>
					<select name="sexo">
						<option value=1>Hombre</option>
						<option value=0>Mujer</option>
					</select>
					<label for="">Ingrese su tipo de sangre</label>
					<select name="t_sang">
						<option value="A+">A+</option>
						<option value="A-">A-</option>
						<option value="B+">B+</option>
						<option value="B-">B-</option>
						<option value="O+">O+</option>
						<option value="O-">O-</option>
						<option value="AB+">AB+</option>
						<option value="AB-">AB-</option>
					</select>
					<label for="">Ingrese su peso &#40;valor entero&#41;</label>
					<input type="number" placeholder="Peso" name="peso">
					<label for="">Ingrese su altura en cent&iacute;metros</label>
					<input type="number" placeholder="altura" name="altura">
					<input type="submit" name="send">
				</form>
				<span class="text-footer">¿Ya tienes una cuenta? <a href="login.php">Iniciar sesi&oacute;n</a><br>¿Es usted un m&eacute;dico de esta p&aacute;gina? <a href="log_dr.php">Inicie sesi&oacute;n</a></span>
			</div>
		</div>
		<form>
	</body>
</html>