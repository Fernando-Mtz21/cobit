<?php
session_start();
include('cliente/controladoroad.php');
if(!isset($_SESSION['cliente'])){
	header("location:index.html");
}
?>
<!DOCTYPE html>
<html lang="es-MX">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title>Document</title>
		<link rel="stylesheet" href="log.css">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" type="text/css" href="../icon/styles.css">
		<style>a{ text-decoration: none; } table{ border-collapse: collapse; text-align: center; } th{ background-color: #DE1A1A; color: #fff; } th, td{ padding: .8rem; font-size: 1.4rem; border-bottom: 1px solid #DE1A1A; } .desc{ cursor: pointer; color: #b212ed; } @media screen and (max-width: 600px){ thead{ display: none; } td{ display: block; text-align: right; } td:first-child{ background-color: #DE1A1A; color: #fff; text-align: center; } td:nth-child()::before{ content: "Fecha"; } td:nth-child(2)::before{ content: "Hora"; } td:nth-child(3)::before{ content: "Médico"; } td:nth-child(4)::before{ content: "Descripción"; color: black; } /*td:nth-child(5)::before{ content: "Editar"; } */ td:nth-child(5)::before{ content: "Descripción"; } td:nth-child(6)::before{ content: "Eliminar"; } td::before{ float: left; margin-right: 3rem; font-weight: bold; } }</style>
	</head>
	<body>
		<header id="header" class="sticky">
			<a href="index.html" class="logo">Co<span>bit</span>19</a>
			<div class="icon-menu menuToggle" id="menu" onclick="toggle();"></div>
			<ul class="navigation">
				<li><a href="consulta.php" onclick="toggle();">Agendar cita</a></li>
				<li><a href="ver_citas.php" class="current">Ver mis citas</a></li>
				<li><a href="logout.php" onclick="toggle();">Cerrar sesi&oacute;n</a></li>
			</ul>
		</header>
		<div class="container-all">
			<div class="ctn-form">
				<center><h1>Mis citas</h1></center>
				<?php $txt = Controlador::ver_mis_citas($_SESSION['cliente']['id']); echo $txt; ?>
			</div>
		</div>
	</body>
	<script>
		function msg(e){
			var men = document.getElementById(e).value;
			window.alert("Motivo de la cita: " + men);
		}
		var t = 0;
			function toggle(){
				var header = document.querySelector("header");
				var menu = document.getElementById("menu");
				menu.classList.toggle("active");
				header.classList.toggle("active");
				if(t == 0){
					menu.classList.remove("icon-menu");
					menu.classList.add("icon-times");
					t = 1;
				}else{
					menu.classList.remove("icon-times");
					menu.classList.add("icon-menu");
					t = 0;
				}
			}
	</script>
</html>