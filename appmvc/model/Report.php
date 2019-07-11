<?php


class Report extends EntidadBase
{
private $post; //id_post
private $usuario; //id_usuario
private $fecha_denuncia;
private $moderador; //id_usuario_mod
private $motivo;
private $fecha_moderacion;
private $comentario=null;
	

	    public function __construct($adapter) {
        $table="report";
        parent::__construct($table, $adapter);
        require_once ('Comentario.php');
require_once ('Post.php');
    }

    public function denunciar(){
if($this->comentario==null){

        $query="INSERT INTO `denuncia_post`(`ID_POST`, `ID_USUARIO`, `FECHA_DENUNCIA`, `ID_USUARIO_MOD`, `MOTIVO`, `FECHA_MODERACION`, `ID_COMENTARIO`) VALUES ('$this->post->id_post','$this->usuario->id_usuario','$this->fecha_denuncia','$this->moderador->id_usuario_mod','$this->motivo','$this->fecha_moderacion',NULL);";}

        else{ 
            $query="INSERT INTO `denuncia_post`(`ID_POST`, `ID_USUARIO`, `FECHA_DENUNCIA`, `ID_USUARIO_MOD`, `MOTIVO`, `FECHA_MODERACION`, `ID_COMENTARIO`) VALUES ('$this->post->id_post','$this->usuario->id_usuario','$this->fecha_denuncia','$this->moderador->id_usuario_mod','$this->motivo','$this->fecha_moderacion','$this->comentario->id_comentario');";}

        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }

        public function moderar($fecha){
        $query="UPDATE `denuncia_post` SET `FECHA_MODERACION`= $fecha WHERE ID_COMENTARIO= '$this->id_comentario';";

            $save=$this->db()->query($query);
            
            return $save;
    }
}
?>