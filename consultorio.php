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
						<!--<img src="https://previews.dropbox.com/p/thumb/ABJoRS3_ennzNelC9YH3VglpB_qDKjDsPwGho8cHXuKRK4wBSvHsnDtCHlq7o0SuOP7rKBv7z4HhpIJJ4pBoXm9SA9nhHGbVM2BUaxfHq9-7l8z7xKlXnWumzUSZSqyU4lkWj0HEypwVsPcMBH3J0hUlp_bYZIQJjPtgmZfCD0Luqy_7o14YA9fWZ9IME3Se7gGAwjat8ihJjgKOfZ8D9YZRkrV1ZLzfBnAdV_jaaacSEaVv5grvuknv9ultyU-zau2mxDJLTm6_50aNLlW82DHTaKEexzDSZNpqZb6f1L773NEG7CTKZzToaWfJlGlB6v3lJBvmoZ4FMSIyzbC2dnFDiVdaehEFuAWx3oJg9xxrSQ/p.jpeg?fv_content=true&size_mode=5">-->
						<img src="data:image/jpeg;base64,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">
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
