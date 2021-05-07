<?php
include('conexion.php');
include('usuario.php');
include('cita.php');

class Usuariooad extends Conexion{
	protected static $con;
	
	private static function conectar(){
		self::$con = Conexion::conectando();
	}
	
	private static function desconectar(){
		self::$con = null;
	}
	
	public function login($usuario){
		$query = "SELECT * FROM cliente WHERE correo_cliente = :correo_cliente AND pass_cliente = :pass_cliente";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->bindValue(":correo_cliente", $usuario->getCorreo_cliente());
		$resultado->bindValue(":pass_cliente", $usuario->getPass_cliente());
		$resultado->execute();
		if($resultado->rowCount() == 1){
			$row = $resultado->fetch();
			$cliente = new Cliente();
			$cliente->setId_cliente($row['id_cliente']);
			$cliente->setNom_cliente($row['nom_cliente']);
			$cliente->setApell_cliente($row['apell_cliente']);
			//$cliente->setPass_cliente($row['pass_cliente']);
			$cliente->setFec_nac_cliente($row['fec_nac_cliente']);
			$cliente->setEdad_cliente($row['edad_cliente']);
			$cliente->setTel_cliente($row['tel_cliente']);
			$cliente->setCorreo_cliente($row['correo_cliente']);
			$cliente->setSexo_cliente($row['sexo_cliente']);
			$cliente->setT_sang_cliente($row['t_sang_cliente']);
			$cliente->setPeso_cliente($row['peso_cliente']);
			$cliente->setAltura_cliente($row['altura_cliente']);
			return $cliente;
		}else{
			return false;
		}
	}
	
	public function singup($usuario){
		$query = "INSERT INTO cliente (nom_cliente, apell_cliente, pass_cliente, fec_nac_cliente, edad_cliente, tel_cliente, correo_cliente, sexo_cliente, t_sang_cliente, peso_cliente, altura_cliente) VALUES (:nom_cliente, :apell_cliente, :pass_cliente, :fec_nac_cliente, :edad_cliente, :tel_cliente, :correo_cliente, :sexo_cliente, :t_sang_cliente, :peso_cliente, :altura_cliente)";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->bindValue(":nom_cliente", $usuario->getNom_cliente());
		$resultado->bindValue(":apell_cliente", $usuario->getApell_cliente());
		$resultado->bindValue(":pass_cliente", $usuario->getPass_cliente());
		$resultado->bindValue(":fec_nac_cliente", $usuario->getFec_nac_cliente());
		$resultado->bindValue(":edad_cliente", $usuario->getEdad_cliente());
		$resultado->bindValue(":tel_cliente", $usuario->getTel_cliente());
		$resultado->bindValue(":correo_cliente", $usuario->getCorreo_cliente());
		$resultado->bindValue(":sexo_cliente", $usuario->getSexo_cliente());
		$resultado->bindValue(":t_sang_cliente", $usuario->getT_sang_cliente());
		$resultado->bindValue(":peso_cliente", $usuario->getPeso_cliente());
		$resultado->bindValue(":altura_cliente", $usuario->getAltura_cliente());
		if($resultado->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	public function select_medico(){
		$query = "SELECT * FROM medico";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->setFetchMode(PDO::FETCH_ASSOC);
		$resultado->execute();
		$txt = "";
		if($resultado->rowCount() > 0){
			while($row = $resultado->fetch()){
				$txt.= "<option value={$row['id_medico']}>Dr. {$row['apell_medico']}</option>";
			}
		}else{
			$txt = "<option value=''>No hay doctores</option>";
		}
		return $txt;
	}
	
	public function getmedico($id){
		$query = "SELECT * FROM medico WHERE id_medico = :id_medico";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->bindValue(":id_medico", $id);
		$resultado->execute();
		$txt = "";
		$row = $resultado->fetch();
		$txt = "Dr. " . $row['apell_medico'];
		return $txt;
	}
	
	public function getcliente($id){
		$query = "SELECT * FROM cliente WHERE id_cliente = :id_cliente";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->bindValue(":id_cliente", $id);
		$resultado->execute();
		$txt = "";
		$row = $resultado->fetch();
		$txt = $row['nom_cliente'] . " " . $row['apell_cliente'];
		return $txt;
	}
	
	public function mis_citas($usuario){
		$query = "SELECT * FROM cita WHERE id_cliente = :id_cliente";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->setFetchMode(PDO::FETCH_ASSOC);
		$resultado->bindValue(":id_cliente", $usuario->getId_cliente());
		$resultado->execute();
		$txt = "";
		if($resultado->rowCount() > 0){
			$txt = "<table><thead><tr><th>Fecha</th><th>Hora</th><th>M&eacute;dico</th><th>Descripci&oacute;n</th><th>Eliminar</th></tr></thead><tbody>";
			while($row = $resultado->fetch()){
				$fecha = preg_split("/[\s-]/", $row['fecha_hora_cita']);
				$ano = $fecha[0];
				$mes = $fecha[1];
				$dia = $fecha[2];
				$tiempo = preg_split("/[\s:]/", $fecha[3]);
				$hora = $tiempo[0];
				$minuto = $tiempo[1];
				$segundo = $tiempo[2];
				
				switch(intval($mes)){
					case 1:
						$mes_l = "Enero";
						break;
					case 2:
						$mes_l = "Febrero";
						break;
					case 3:
						$mes_l = "Marzo";
						break;
					case 4:
						$mes_l = "Abril";
						break;
					case 5:
						$mes_l = "Mayo";
						break;
					case 6:
						$mes_l = "Junio";
						break;
					case 7:
						$mes_l = "Julio";
						break;
					case 8:
						$mes_l = "Agosto";
						break;
					case 9:
						$mes_l = "Septiembre";
						break;
					case 10:
						$mes_l = "Octubre";
						break;
					case 11:
						$mes_l = "Noviembre";
						break;
					case 12:
						$mes_l = "Diciembre";
						break;
				}
				$m = self::getmedico($row['id_medico']);
				$txt.= "<tr>";
				$txt.= "<td>{$dia} de {$mes_l} de {$ano}</td>";
				$txt.= "<td>{$hora}:{$minuto}</td>";
				$txt.= "<td>{$m}</td>";
				$txt.= "<input type='hidden' value='{$row['desc_cita']}' id={$row['id_cita']}>";
				$txt.= "<td class='desc' onclick=msg({$row['id_cita']})>Ver Descripci&oacute;n</td>";
				#$txt.= "<td><a href='editar.php?id={$row['id_cita']}'>Editar</a></td>";
				$txt.= "<td><a href='eliminar.php?id={$row['id_cita']}' class='error'>Eliminar</a></td>";
				$txt.= "</tr>";
			}
			$txt.= "</tbody></table>";
		}else{
			$txt = "<center><h1 class='error'>No has agendado citas hasta ahora</h1><h1><a href='consulta.php'>Agendar cita</a></h1></center>";
		}
		return $txt;
	}
	
	public function agendar_cita($cita){
		$query = "INSERT INTO cita (id_cliente, id_medico, fecha_hora_cita, desc_cita) VALUES (:id_cliente, :id_medico, :fecha_hora_cita, :desc_cita)";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->bindValue(":id_cliente", $cita->getId_cliente());
		$resultado->bindValue(":id_medico", $cita->getId_medico());
		$resultado->bindValue(":fecha_hora_cita", $cita->getFecha_hora_cita());
		$resultado->bindValue(":desc_cita", $cita->getDesc_cita());
		if($resultado->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	public function cancelar_cita($cita){
		$query = "DELETE FROM cita WHERE id_cita = :id_cita";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->bindValue(":id_cita", $cita->getId_cita());
		if($resultado->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	public function editar_citas($cita){
		$query = "UPDATE cita SET id_cliente = :id_cliente, id_medico = :id_medico, fecha_hora_cita = :fecha_hora_cita, desc_cita = :desc_cita WHERE id_cita = :id_cita";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->bindValue(":id_cliente", $cita->getId_cliente());
		$resultado->bindValue(":id_medico", $cita->getId_medico());
		$resultado->bindValue(":fecha_hora_cita", $cita->getFecha_hora_cita());
		$resultado->bindValue(":desc_cita", $cita->getDesc_cita());
		$resultado->bindValue(":id_cita", $cita->getId_cita());
		if($resultado->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	public function ci(){
		$query = "SELECT * FROM cliente";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->setFetchMode(PDO::FETCH_ASSOC);
		$resultado->execute();
		$txt = "";
		while($row = $resultado->fetch()){
			$txt.="<tr><td width='60px'><div class='imgBx'><img src='https://bysperfeccionoral.com/wp-content/uploads/2020/01/136-1366211_group-of-10-guys-login-user-icon-png.jpg'></div></td><td><h4>{$row['nom_cliente']} {$row['apell_cliente']}<br><span>{$row['t_sang_cliente']} | {$row['edad_cliente']} a&ntilde;os | {$row['altura_cliente']} cm | {$row['peso_cliente']} kg </span></h4></td></tr>";
			/*$txt.= "id_cliente: {$row['id_cliente']} <br>";
			$txt.= "nom_cliente: {$row['nom_cliente']} <br>";O+ | 12 años | 170 cm| 65 kg
			$txt.= "apell_cliente: {$row['apell_cliente']} <br>";
			$txt.= "pass_cliente: {$row['pass_cliente']} <br>";
			$txt.= "fec_nac_cliente: {$row['fec_nac_cliente']} <br>";
			$txt.= "edad_cliente: {$row['edad_cliente']} <br>";
			$txt.= "tel_cliente: {$row['tel_cliente']} <br>";
			$txt.= "correo_cliente: {$row['correo_cliente']} <br>";
			$txt.= "sexo_cliente: {$row['sexo_cliente']} <br>";
			$txt.= "t_sang_cliente: {$row['t_sang_cliente']} <br>";
			$txt.= "peso_cliente: {$row['peso_cliente']} <br>";
			$txt.= "altura_cliente: {$row['altura_cliente']} <br><br>";*/
		}
		return $txt;
	}
	
	public function existe_cita($cita){
		$query = "SELECT * FROM cita WHERE fecha_hora_cita = :fecha_hora_cita";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->setFetchMode(PDO::FETCH_ASSOC);
		$resultado->bindValue(":fecha_hora_cita", $cita->getFecha_hora_cita());
		$resultado->execute();
		$txt = "";
		if($resultado->rowCount() > 0){
			return false;
		}else{
			return true;
		}
	}
	#SELECT * FROM `alumno` WHERE CAST(`fecharegistro_al` AS DATE) = '2021-05-02' ORDER BY CAST(`fecharegistro_al` AS TIME)
	public function mostrar_citas_hoy($cita){
		$query = "SELECT * FROM cita WHERE id_medico = :id_medico AND CAST(fecha_hora_cita AS DATE) = :fecha_hora_cita ORDER BY CAST(fecha_hora_cita AS TIME)";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->setFetchMode(PDO::FETCH_ASSOC);
		$resultado->bindValue(":id_medico", $cita->getId_medico());
		$resultado->bindValue(":fecha_hora_cita", $cita->getFecha_hora_cita());
		$resultado->execute();
		$txt = "";
		if($resultado->rowCount() > 0){
			while($row = $resultado->fetch()){
				$txt.= "<tr>";
				$c = self::getcliente($row['id_cliente']);
				$txt.= "<td>{$c}</td>";
				$fecha = preg_split("/[\s-]/", $row['fecha_hora_cita']);
				$ano = $fecha[0];
				$mes = $fecha[1];
				$dia = $fecha[2];
				
				$tiempo = preg_split("/[\s:]/", $fecha[3]);
				
				$hora = $tiempo[0];
				$minuto = $tiempo[1];
				$segundo = $tiempo[2];
				
				switch(intval($mes)){
					case 1:
						$mes_l = "Enero";
						break;
					case 2:
						$mes_l = "Febrero";
						break;
					case 3:
						$mes_l = "Marzo";
						break;
					case 4:
						$mes_l = "Abril";
						break;
					case 5:
						$mes_l = "Mayo";
						break;
					case 6:
						$mes_l = "Junio";
						break;
					case 7:
						$mes_l = "Julio";
						break;
					case 8:
						$mes_l = "Agosto";
						break;
					case 9:
						$mes_l = "Septiembre";
						break;
					case 10:
						$mes_l = "Octubre";
						break;
					case 11:
						$mes_l = "Noviembre";
						break;
					case 12:
						$mes_l = "Diciembre";
						break;
				}
				
				
				$txt.= "<td>{$dia} de {$mes_l} de {$ano}</td>";
				$txt.= "<td>{$hora}:{$minuto}</td>";
				$txt.= "<input type='hidden' value='{$row['desc_cita']}' id={$row['id_cita']}>";
				$txt.= "<td class='desc' onclick=msg({$row['id_cita']})>Ver Descripci&oacute;n</td>";
				$txt.= "</tr>";
			}
		}else{
			$txt = "<tr><td colspan='3'>No hay citas por hoy</td></tr>";
		}
		return $txt;
	}
	
	public function getcita($cita){
		$query = "SELECT * FROM cita WHERE id_cita = :id_cita";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->bindValue(":id_cita", $cita->getId_cita());
		$resultado->execute();
		$cita1 = new Cita();
		$row = $resultado->fetch();
		$cita1->setId_cita($row['id_cita']);
		$cita1->setId_cliente($row['id_cliente']);
		$cita1->setId_medico($row['id_medico']);
		$cita1->setFecha_hora_cita($row['fecha_hora_cita']);
		$cita1->setDesc_cita($row['desc_cita']);
		return $cita1;
	}
	
	public function logindr($usuario){
		$query = "SELECT * FROM medico WHERE correo_medico = :correo_cliente AND pass_medico = :pass_cliente";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->bindValue(":correo_cliente", $usuario->getCorreo_cliente());
		$resultado->bindValue(":pass_cliente", $usuario->getPass_cliente());
		$resultado->execute();
		if($resultado->rowCount() == 1){
			$row = $resultado->fetch();
			$cliente = new Cliente();
			$cliente->setId_cliente($row['id_medico']);
			$cliente->setNom_cliente($row['nom_medico']);
			$cliente->setApell_cliente($row['apell_medico']);
			//$cliente->setPass_cliente($row['pass_cliente']);
			$cliente->setFec_nac_cliente($row['fec_nac_medico']);
			$cliente->setEdad_cliente($row['edad_medico']);
			$cliente->setTel_cliente($row['tel_medico']);
			$cliente->setCorreo_cliente($row['correo_medico']);
			$cliente->setSexo_cliente($row['sexo_medico']);
			return $cliente;
		}else{
			return false;
		}
	}
	
	public function citas_totales(){
		$query = "SELECT * FROM cita";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->execute();
		$txt = $resultado->rowCount();
		return $txt;
	}
	
	public function pacientes_totales(){
		$query = "SELECT * FROM cliente";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->execute();
		$txt = $resultado->rowCount();
		return $txt;
	}
/*	
	public function mostrar_citas(){
		$query = "SELECT * FROM citas";
		self::conectar();
		$resultado = self::$con->prepare($query);
		$resultado->execute();
		$citas = array();
		$fila = $result->fetch();
		
	}
	[[0,3,5,48,48,8,8,5,5,3,3,0,3,5,8,8,5],[3,0,3,48,48,8,8,5,5,0,0,3,0,3,8,8,5],[5,3,0,72,72,48,48,24,24,3,3,5,3,0,48,48,24],[48,48,74,0,0,6,6,12,12,48,48,48,48,74,6,6,12],[48,48,74,0,0,6,6,12,12,48,48,48,48,74,6,6,12],[8,8,50,6,6,0,0,8,8,8,8,8,8,50,0,0,0],[8,8,50,6,6,0,0,8,8,8,8,8,8,50,0,0,8],[5,5,26,12,12,8,8,0,0,5,5,5,5,26,8,8,0],[5,5,26,12,12,8,8,0,0,5,5,5,5,26,8,8,0],[3,0,3,48,48,8,8,5,5,0,0,3,0,3,8,8,5],[3,0,3,48,48,8,8,5,5,0,0,3,0,3,8,8,5],[0,3,5,48,48,8,8,5,5,3,3,0,3,5,8,8,5],[3,0,3,48,48,8,8,5,5,0,0,3,0,3,8,8,5],[5,3,0,72,72,48,48,24,24,3,3,5,3,0,48,48,24],[8,8,50,6,6,0,0,8,8,8,8,8,8,50,0,0,8],[8,8,50,6,6,0,0,8,8,8,8,8,8,50,0,0,8],[5,5,26,12,12,8,8,0,0,5,5,5,5,26,8,8,0]]
	*/
	
}
?>