<?php
include('usuariooad.php');

class Controlador{
	public function acceder($correo_cliente, $pass_cliente){
		$usuario = new Cliente();
		$usuario->setCorreo_cliente($correo_cliente);
		$usuario->setPass_cliente($pass_cliente);
		return Usuariooad::login($usuario);
	}
	
	public function registrar($nom_cliente, $apell_cliente, $pass_cliente, $fec_nac_cliente, $edad_cliente, $tel_cliente, $correo_cliente, $sexo_cliente, $t_sang_cliente, $peso_cliente, $altura_cliente){
		$usuario = new Cliente();
		$usuario->setNom_cliente($nom_cliente);
		$usuario->setApell_cliente($apell_cliente);
		$usuario->setPass_cliente($pass_cliente);
		$usuario->setFec_nac_cliente($fec_nac_cliente);
		$usuario->setEdad_cliente($edad_cliente);
		$usuario->setTel_cliente($tel_cliente);
		$usuario->setCorreo_cliente($correo_cliente);
		$usuario->setSexo_cliente($sexo_cliente);
		$usuario->setT_sang_cliente($t_sang_cliente);
		$usuario->setPeso_cliente($peso_cliente);
		$usuario->setAltura_cliente($altura_cliente);
		return Usuariooad::singup($usuario);
	}
	
	public function select_medico_oad(){
		return Usuariooad::select_medico();
	}
	
	public function agenda_cita($id_cliente, $id_medico, $fecha_hora_cita, $desc_cita){
		$cita = new Cita();
		$cita->setId_cliente($id_cliente);
		$cita->setId_medico($id_medico);
		$cita->setFecha_hora_cita($fecha_hora_cita);
		$cita->setDesc_cita($desc_cita);
		return Usuariooad::agendar_cita($cita);
	}
	
	public function cancela_cita($id_cita){
		$cita = new Cita();
		$cita->setId_cita($id_cita);
		return Usuariooad::cancelar_cita($cita);
	}
	
	public function edita_cita($id_cita, $id_cliente, $id_medico, $fecha_hora_cita, $desc_cita){
		$cita = new Cita();
		$cita->setId_cita($id_cita);
		$cita->setId_cliente($id_cliente);
		$cita->setId_medico($id_medico);
		$cita->setFecha_hora_cita($fecha_hora_cita);
		$cita->setDesc_cita($desc_cita);
		return Usuariooad::editar_citas($cita);
	}
	
	public function ver_mis_citas($id_cliente){
		$usuario = new Cliente();
		$usuario->setId_cliente($id_cliente);
		return Usuariooad::mis_citas($usuario);
	}
	
	public function ic(){
		return Usuariooad::ci();
	}
	
	public function existe_citaoad($fecha_hora_cita){
		$cita = new Cita();
		$cita->setFecha_hora_cita($fecha_hora_cita);
		return Usuariooad::existe_cita($cita);
	}
	
	public function mostrar_citas_hoyoad($id_medico, $fecha_hora_cita){
		$cita = new Cita();
		$cita->setId_medico($id_medico);
		$cita->setFecha_hora_cita($fecha_hora_cita);
		return Usuariooad::mostrar_citas_hoy($cita);
	}
	
	public function getcitaoad($id_cita){
		$cita = new Cita();
		$cita->setId_cita($id_cita);
		return Usuariooad::getcita($cita);
	}
	
	public function accederdr($correo_cliente, $pass_cliente){
		$usuario = new Cliente();
		$usuario->setCorreo_cliente($correo_cliente);
		$usuario->setPass_cliente($pass_cliente);
		return Usuariooad::logindr($usuario);
	}
	
	public function citas_totalesoad(){
		return Usuariooad::citas_totales();
	}
	
	public function pacientes_totalesoad(){
		return Usuariooad::pacientes_totales();
	}
	
}
?>