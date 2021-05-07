<?php
class Cliente{
	protected $id_cliente;
	protected $nom_cliente;
	protected $apell_cliente;
	protected $pass_cliente;
	protected $fec_nac_cliente;
	protected $edad_cliente;
	protected $tel_cliente;
	protected $correo_cliente;
	protected $sexo_cliente;
	protected $t_sang_cliente;
	protected $peso_cliente;
	protected $altura_cliente;
	
	public function getId_cliente(){
		return $this->id_cliente;
	}
	
	public function setId_cliente($id_cliente){
		$this->id_cliente = $id_cliente;
	}
	
	public function getNom_cliente(){
		return $this->nom_cliente;
	}
	
	public function setNom_cliente($nom_cliente){
		$this->nom_cliente = $nom_cliente;
	}
	
	public function getApell_cliente(){
		return $this->apell_cliente;
	}
	
	public function setApell_cliente($apell_cliente){
		$this->apell_cliente = $apell_cliente;
	}
	
	public function getPass_cliente(){
		return $this->pass_cliente;
	}
	
	public function setPass_cliente($pass_cliente){
		$this->pass_cliente = $pass_cliente;
	}
	
	public function getFec_nac_cliente(){
		return $this->fec_nac_cliente;
	}
	
	public function setFec_nac_cliente($fec_nac_cliente){
		$this->fec_nac_cliente = $fec_nac_cliente;
	}
	
	public function getEdad_cliente(){
		return $this->edad_cliente;
	}
	
	public function setEdad_cliente($edad_cliente){
		$this->edad_cliente = $edad_cliente;
	}
	
	public function getTel_cliente(){
		return $this->tel_cliente;
	}
	
	public function setTel_cliente($tel_cliente){
		$this->tel_cliente = $tel_cliente;
	}
	
	public function getCorreo_cliente(){
		return $this->correo_cliente;
	}
	
	public function setCorreo_cliente($correo_cliente){
		$this->correo_cliente = $correo_cliente;
	}
	
	public function getSexo_cliente(){
		return $this->sexo_cliente;
	}
	
	public function setSexo_cliente($sexo_cliente){
		$this->sexo_cliente = $sexo_cliente;
	}
	
	public function getT_sang_cliente(){
		return $this->t_sang_cliente;
	}
	
	public function setT_sang_cliente($t_sang_cliente){
		$this->t_sang_cliente = $t_sang_cliente;
	}
	
	public function getPeso_cliente(){
		return $this->peso_cliente;
	}
	
	public function setPeso_cliente($peso_cliente){
		$this->peso_cliente = $peso_cliente;
	}
	
	public function getAltura_cliente(){
		return $this->altura_cliente;
	}
	
	public function setAltura_cliente($altura_cliente){
		$this->altura_cliente = $altura_cliente;
	}
}
?>