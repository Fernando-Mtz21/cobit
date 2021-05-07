<?php
session_start();
include('cliente/controladoroad.php');
if(isset($_GET['correo']) && isset($_GET['pass'])){
	$correo_cliente = $_GET['correo'];
	$pass_cliente = $_GET['pass'];
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
	}
}else{
	header("location:index.html");
}
?>