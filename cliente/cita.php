<?php
class Cita{
	protected $id_cita;
	protected $id_cliente;
	protected $id_medico;
	protected $fecha_hora_cita;
	protected $desc_cita;
	
	public function getId_cita(){
		return $this->id_cita;
	}
	
	public function setId_cita($id_cita){
		$this->id_cita = $id_cita;
	}
	
	public function getId_cliente(){
		return $this->id_cliente;
	}
	
	public function setId_cliente($id_cliente){
		$this->id_cliente = $id_cliente;
	}
	
	public function getId_medico(){
		return $this->id_medico;
	}
	
	public function setId_medico($id_medico){
		$this->id_medico = $id_medico;
	}
	
	public function getFecha_hora_cita(){
		return $this->fecha_hora_cita;
	}
	
	public function setFecha_hora_cita($fecha_hora_cita){
		$this->fecha_hora_cita = $fecha_hora_cita;
	}
	
	public function getDesc_cita(){
		return $this->desc_cita;
	}
	
	public function setDesc_cita($desc_cita){
		$this->desc_cita = $desc_cita;
	}
}
?>