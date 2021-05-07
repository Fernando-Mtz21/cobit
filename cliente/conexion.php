<?php
class Conexion{
	public static function conectando(){
		try{
			/*"mysql:host=localhost;dbname=cobit19", "root", ""*/
			$cn = new PDO("mysql:host=remotemysql.com;dbname=0TOKev0EE5", "0TOKev0EE5", "VlrB27TmXD");
			return $cn;
		} catch(PDOException $ex){
			die($ex->getMessage());
		}
	}
}
?>