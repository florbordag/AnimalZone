<?php

class Moderador extends EntidadBase{
	private $id_usuario_mod;
	private $username;
	private $pass;
	private $salt;
	private $estado;
	private $usuario_alta;
	private $fecha_alta;
	private $usuario_ult_mod;
	private $fecha_ult_mod;
	private $mail;

	
	

    public function __construct($adapter) {
        $table="moderador";
        parent::__construct($table, $adapter);
    }
    public function __get($property) { 
		if (property_exists($this, $property)) { 
		return $this->$property; } 
		}
		public function __set($property, $value) { 
		if (property_exists($this, $property)) { 
		$this->$property = $value; } 
		return $this; 
		} 

		public function obtenerpass($password,$user){
			$sql = "SELECT SALT, PASSWORD FROM moderador WHERE USERNAME = '$user'";
$result= $this->db()->query($sql); 
	if($result->num_rows == 1){
$row = $result->fetch_assoc();
$salt = $row['SALT'];
$saltedPass = $password . $salt;
$hashedPass = hash('sha256', $saltedPass);
if($hashedPass == $row['PASSWORD']){
					return true;}
				else {return false;}}

}

	public function agregarMod($user){

		$query="INSERT INTO `moderador`(`ID_USUARIO_MOD`, `USERNAME`, `PASSWORD`, `SALT`, `ESTADO`, `USUARIO_ALTA`, `FECHA_ALTA`, `USUARIO_ULT_MOD`, `FECHA_ULT_MOD`,`MAIL`) VALUES ($user->id_usuario_mod,'$user->username','$user->pass','$user->salt',$user->estado,'$user->usuario_alta',NOW(),NULL,NOW(), '$user->mail');";

			$save=$this->db()->query($query);
			echo $this->db()->error;
			return $save;
	}

	public function eliminarModerador($user)
	{
		$query= "DELETE FROM moderador WHERE ID_USUARIO= $user->id_usuario;";
		$save=$this->db()->query($query);
		return $save;
	}

	public function getAll(){
		$sql="SELECT * FROM moderador";
	  
		$query=$this->db()->query($sql);
		while ($row = $query->fetch_object()) { 
			$resultSet[]=$row;
		   
		}$resultSet=isset($resultSet)?$resultSet:NULL;
		 return $resultSet;}

		 
		 public function activarUsuarios($users){
			$query="UPDATE moderador SET ESTADO=1 WHERE ID_USUARIO_MOD IN ($users);";
	
			$save=$this->db()->query($query);
			//echo $this->db()->error;
		 }

		 public function desactivarUsuarios($users){
			$query="UPDATE moderador SET ESTADO=0 WHERE ID_USUARIO_MOD IN ($users);";
	
			$save=$this->db()->query($query);
			//echo $this->db()->error;
		 }
		 public function eliminarMods($users){
			$query="DELETE FROM moderador WHERE ID_USUARIO_MOD IN ($users);";
	
			$save=$this->db()->query($query);
			//echo $this->db()->error;
		 }

		 
		public function getMod($user){
			$query=$this->db()->query("SELECT * FROM moderador WHERE USERNAME='$user';");

			if($row = $query->fetch_object()) {
			$resultSet=$row;
		}
		//$this->db()->error;
		return $resultSet;
		}
}
?>