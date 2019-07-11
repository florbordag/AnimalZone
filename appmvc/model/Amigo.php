<?php

class Amigo extends EntidadBase{
	private $usuario_s;
	private $usuario_r;
	private $estado;
	private $fecha;

	



    public function __construct($adapter) {
        $table="amigo";
        parent::__construct($table, $adapter);
    }



	public function SolicitarAmistad(){
		require_once "Usuario.php";
		$query="INSERT INTO `amigo`(`ID_USUARIO_S`, `ID_USUARIO_R`, `ESTADO`, `FECHA`) VALUES ('$this->usuario_s->id_usuario', '$this->usuario_s->id_usuario' ,'$this->estado','$this->fecha');";

			$save=$this->db()->query($query);
			
			return $save;
	}

	public function eliminarAmigo()
	{
		$query= "DELETE FROM `amigo` WHERE ID_USUARIO_S= '$this->usuario_s->id_usuario' AND ID_USUARIO_R='$this->usuario_r ->id_usuario';";
		$save=$this->db()->query($query);
		return $save;
	}

}
?>