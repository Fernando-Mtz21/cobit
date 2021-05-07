<?php
date_default_timezone_set('America/Monterrey');
session_start();
include('cliente/controladoroad.php');
if(!isset($_SESSION['dr'])){
	header("location:index.html");
}
?>
<!DOCTYPE html>
<html lang="es-MX">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title>Consultorio</title>
		<link rel="stylesheet" type="text/css" href="consultorio.css">
		<link href="https://file.myfontastic.com/DUtdwFq5TpfuCWokLrh8nW/icons.css" rel="stylesheet">
		<style>.desc{ cursor: pointer; color: #b212ed; }</style>
	</head>
	<body>
		<div class="container">
			<div class="navigation">
				<ul>
					<li>
						<a href="index.html">
							<span class="icon"><i class="icon-plus"></i></span>
							<span class="title"><h2>COBIT19</h2></span>
						</a>
					</li>
					<li>
						<a href="logout.php">
							<span class="icon"><i class="icon-sign-out"></i></span>
							<span class="title">Salir</span>
						</a>
					</li>
				</ul>
			</div>
			<div class="main">
				<div class="topbar">
					<div class="toggle" onclick="toggleMenu();"><i class="icon-menu"></i></div>
					<div class="search">
						<!--<label>
							<input type="text" placeholder="Search here">
							<i class="icon-search"></i>
						</label>-->
					</div>
					<div class="user">
						<img src="https://previews.dropbox.com/p/thumb/ABJoRS3_ennzNelC9YH3VglpB_qDKjDsPwGho8cHXuKRK4wBSvHsnDtCHlq7o0SuOP7rKBv7z4HhpIJJ4pBoXm9SA9nhHGbVM2BUaxfHq9-7l8z7xKlXnWumzUSZSqyU4lkWj0HEypwVsPcMBH3J0hUlp_bYZIQJjPtgmZfCD0Luqy_7o14YA9fWZ9IME3Se7gGAwjat8ihJjgKOfZ8D9YZRkrV1ZLzfBnAdV_jaaacSEaVv5grvuknv9ultyU-zau2mxDJLTm6_50aNLlW82DHTaKEexzDSZNpqZb6f1L773NEG7CTKZzToaWfJlGlB6v3lJBvmoZ4FMSIyzbC2dnFDiVdaehEFuAWx3oJg9xxrSQ/p.jpeg?fv_content=true&size_mode=5">
					</div>
				</div>
				<div class="cardBox">
					<div class="card">
						<div>
							<div class="numbers"><?php echo Controlador::citas_totalesoad();?></div>
							<div class="cardName">Citas totales</div>
						</div>
						<div class="iconBox">
							<i class="icon-calendar-plus-o"></i>
						</div>
					</div>
					<div class="card">
						<div>
							<div class="numbers"><?php echo Controlador::pacientes_totalesoad(); ?></div>
							<div class="cardName">Pacientes totales</div>
						</div>
						<div class="iconBox">
							<i class="icon-users-1"></i>
						</div>
					</div>
				</div>
				<div class="details">
					<div class="recentOrders">
						<div class="cardHeader">
							<h2>Citas del d&iacute;a</h2>
							<!--<a href="#" class="btn">View All</a>-->
						</div>
						<table>
							<thead>
								<tr>
									<td>Nombre</td>
									<td>Fecha</td>
									<td>Hora</td>
									<td>Descripci&oacute;n</td>
								</tr>
							</thead>
							<tbody>
								<?php
								echo Controlador::mostrar_citas_hoyoad($_SESSION['dr']['id'], date("y-m-d")); ?>
							</tbody>
						</table>
					</div>
					<div class="recentCustomers">
						<div class="cardHeader">
							<h2>Pacientes</h2>
						</div>
						<table>
							<tbody>
								<?php echo Controlador::ic(); ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			function msg(e){
				var men = document.getElementById(e).value;
				window.alert("Motivo de la cita: " + men);
			}
			function toggleMenu(){
				let toggle = document.querySelector('.toggle');
				let navigation = document.querySelector('.navigation');
				let main = document.querySelector('.main');
				toggle.classList.toggle('active');
				navigation.classList.toggle('active');
				main.classList.toggle('active');
			}
		</script>
	</body>
</html>