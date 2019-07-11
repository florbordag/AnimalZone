<?php


class Comentario extends EntidadBase{
	private $id_comentario;
	private $post; //tabla:id_post
	private $usuario; //tabla:id_usuario
	private $descripcion;
	private $fecha;
	private $estado;

	
    public function __construct($adapter) {
        $table="comentario";
        parent::__construct($table, $adapter);
    }

	public function comentar(){
		require_once ('Post.php');
require_once ('Usuario.php');
require_once ('Report.php');
		$query="INSERT INTO `comentario`(`ID_COMENTARIO`, `ID_POST`, `USUARIO`, `DESCRIPCION`, `FECHA`, `ESTADO`) VALUES ('$this->id_comentario','$this->post->id_post' ,'$this->usuario->id_usuario','$this->descripcion','$this->fecha','$this->estado');";

			$save=$this->db()->query($query);
			
			return $save;
	}

        public function moderar(){
			require_once ('Post.php');
require_once ('Usuario.php');
require_once ('Report.php');
        $query="UPDATE `comentario` SET `ESTADO`= '$this->estado' WHERE ID_COMENTARIO= '$this->id_comentario';";

            $save=$this->db()->query($query);
            
            return $save;
    }

}
?>