<?php


class Admin extends EntidadBase{
	private $id_usuario;
	private $username;
	private $pass;
	private $estado;
	private $usuario_alta;
	private $fecha_alta;
	private $usuario_ult_mod;
	private $fecha_ult_mod;
	private $mail;
	

    public function __construct($adapter) {
        $table="admin";
		parent::__construct($table, $adapter);
		
    }

	public function agregarAdmin($user){
		require_once "Usuario.php";
		require_once "Moderador.php";

		$query="INSERT INTO `administrador`(`ID_USUARIO`, `USERNAME`, `PASSWORD`, `ESTADO`, `USUARIO_ALTA`, `FECHA_ALTA`, `USUARIO_ULT_MOD`, `FECHA_ULT_MOD`,`MAIL`) VALUES ($user->id,$user->username,$user->pass,$user->estado,$user->usuario_alta,$user->fecha_alta,$user->usuario_ult_mod,$user->fecha_ult_mod, $user->mail);";

			$save=$this->db()->query($query);
			
			return $save;
	}

	public function eliminarAdmin($user)
	{
		$query= "DELETE FROM administrador WHERE ID_USUARIO= $user->id_usuario;";
		$save=$this->db()->query($query);
		return $save;
	}

}
?>