<?php
session_start();
include('cliente/controladoroad.php');
if(isset($_GET['id'])){
	Controlador::cancela_cita($_GET['id']);
	header("location:ver_citas.php");
}else{
	header("location:index.html");
}
?>