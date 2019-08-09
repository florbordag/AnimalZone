<?php


class Admin extends EntidadBase{
	private $id_usuario;
	private $username;
	private $pass;
	private $salt;
	private $fecha_alta;
	private $fecha_ult_mod;
	private $mail;
	

    public function __construct($adapter) {
        $table="admin";
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

		

	public function agregarAdmin(){

		$query="INSERT INTO `administrador`(`ID_USUARIO`, `USERNAME`, `PASSWORD`, `SALT`,`FECHA_ALTA`, `FECHA_ULT_MOD`,`MAIL`) VALUES (NULL,'$this->username','$this->pass','$this->salt',NOW(),NULL, '$this->mail');";

			$save=$this->db()->query($query); echo $this->db()->error;
			
			return $save;
	}

	public function eliminarAdmin($user)
	{
		$query= "DELETE FROM administrador WHERE ID_USUARIO= $user->id_usuario;";
		$save=$this->db()->query($query);
		return $save;
	}

	public function obtenerpass($password,$mail){
		$sql = "SELECT SALT, PASSWORD FROM administrador WHERE MAIL = '$mail'";
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

public function getAdmin($mail){
	$query=$this->db()->query("SELECT * FROM administrador WHERE MAIL='$mail';");

	if($row = $query->fetch_object()) {
	  $resultSet=$row;
   }
   //$this->db()->error;
   return $resultSet;
  }

}
?>