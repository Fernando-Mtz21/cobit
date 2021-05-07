<?php
date_default_timezone_set('America/Monterrey');
session_start();
include('cliente/controladoroad.php');
if(!isset($_SESSION['cliente'])){
	header("location:index.html");
}
if(isset($_POST['nueva_cita'])){
	$cliente = $_SESSION['cliente']['id'];
	$dr = $_POST['dr'];
	$fecha_cita = $_POST['fecha_cita'];
	$hora_cita = $_POST['hora'];
	$fecha_hora_cita = $fecha_cita . " " . $hora_cita;
	$desc = $_POST['desc_cita'];
	$date1=date_create($fecha_cita);
	$date2=date_create(date("y-m-d"));
	$intervalo = date_diff($date2, $date1);
	$date2->format('w');
	$nodom = intval($date1->format('w'));
	$ec = intval($intervalo->format('%R%a'));
	if($ec < 0){
		echo "<script>window.alert('No puedes agendar citas en el pasado');</script>";
	} else if($nodom == 0){
		echo "<script>window.alert('No puedes agendar cita en domingo');</script>";
	} else{
		if(Controlador::existe_citaoad($fecha_hora_cita)){
			if(Controlador::agenda_cita($cliente, $dr, $fecha_hora_cita, $desc)){
				echo "<script>window.alert('Cita agendada');</script>";
				header("location:ver_citas.php");
			}else{
				echo "<script>window.alert('No se pudo agendar su cita, intente de nuevo');</script>";
			}
		}else{
			echo "<script>window.alert('Ya esta ocupada esta fecha y hora, seleccione otra fecha u hora');</script>";
		}
	}	
}
?>
<!DOCTYPE html>
<html lang="es-MX">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title>Consulta</title>
		<link rel="stylesheet" href="log.css">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" type="text/css" href="../icon/styles.css">
	</head>
	<body>
		<header id="header" class="sticky">
			<a href="index.html" class="logo">Co<span>bit</span>19</a>
			<div class="icon-menu menuToggle" id="menu" onclick="toggle();"></div>
			<ul class="navigation">
				<li><a href="consulta.php" onclick="toggle();" class="current">Agendar cita</a></li>
				<li><a href="ver_citas.php" onclick="toggle();">Ver mis citas</a></li>
				<li><a href="logout.php" onclick="toggle();">Cerrar sesi&oacute;n</a></li>
			</ul>
		</header>
		
		<div class="container-all">
			<div class="ctn-form">
				<center><h1>Bienvenido, <?php echo $_SESSION['cliente']['nombre'] . " " . $_SESSION['cliente']['apellido'];?> </h1></center>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
					<center><p>Agendar una cita</p></center>
					<label>Seleccione al doctor</label>
					<select name="dr"><?php $txt = Controlador::select_medico_oad(); echo $txt;?></select>
					<label>Seleccione la fecha de la cita &#40;De lunes a s&aacute;bado&#41;</label>
					<input type="date" name="fecha_cita">
					<label>Seleccione la hora de la cita</label>
					<?php
					$ho = "09:00";
					echo "<label class='label-r' for='hora0'><input type='radio' id='hora0>' name='hora' value='{$ho}:00'> {$ho}</label><br>"; 
					for($i = 1; $i < 14; $i++){
						$aum = " + 40 min";
						$str = $ho . $aum;
						$re = date('H:i',strtotime($str));
						echo "<label class='label-r' for='hora{$i}'><input type='radio' id='hora{$i}>' name='hora' value='{$re}:00'> {$re}</label><br>"; 
						$ho = $re;
					}

					/*$rw = $re . " + 40 min";
					$re = date('H:i',strtotime('09:00 + 40 min'));
					echo $re . "<br>";*/
					?>
					<label>Describa el motivo de su consulta &#40;opcional&#41;</label>
					<textarea name="desc_cita" placeholder="Motivo de su consulta"></textarea> 
					<input type="submit" name="nueva_cita"  value="Agendar cita">
				</form>
			</div>
		</div>
			<!--/*#$obj_fecha = date_create_from_format('Y-m-d', $_SESSION['cliente']['fec_nac']);
			
			$dato = '2020-05-19 21:00:45';
			#$fecha = preg_split("/[\s-]/", $_SESSION['cliente']['fec_nac']);
			#America/Monterrey
			$fecha = preg_split("/[\s-]/", $dato);
			
			
    		$ano = $fecha[0];
			$mes = $fecha[1];
			$dia = $fecha[2];
			
			
			$tiempo = preg_split("/[\s:]/", $fecha[3]);
			
			$hora = $tiempo[0];
			$minuto = $tiempo[1];
			$segundo = $tiempo[2];
			
			echo "<br>" . $ano . "<br>";
			echo $mes . "<br>";
			echo $dia . "<br>";
			echo $hora . "<br>";
			echo $minuto . "<br>";
			echo $segundo . "<br>";
			#echo var_dump($obj_fecha);
			echo date('h:i:s') . "<br>";
			echo date('l jS \of F Y h:i:s A') . "<br>";
			echo date('l jS \of F Y h:i:s A', mktime($hora,$minuto,$segundo,$mes,$dia,$ano)) . "<br>";
			$date1=date_create($_SESSION['cliente']['fec_nac']);
			$date2=date_create(date("y-m-d"));
			$d3 = date_create("2000-5-27 13:15:00");
			$d4 = date_create(date("y-m-d h:i:s"));
			echo date("y-m-d") . "<br>";
			$in = date_diff($d3, $d4);
			
			$intervalo = date_diff($date1, $date2);
			echo $intervalo->format('%R%a días') . "<br>";
			$ec = intval($intervalo->format('%R%a'));
			echo $ec . "<br>";
			if($ec < 0){
				echo "No esta bien";
			}else{
				echo "piola";
			}
			echo $in->format('%y') . "<br>";
			echo $date2->format('w') . "<br>";
			
			
			
			
			?>*/-->
		
		<!--<p>Mis citas</p>
		<?php $txt = Controlador::ver_mis_citas($_SESSION['cliente']['id']); //echo $txt; ?>-->
		<script type="text/javascript">
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
	</body>
</html>