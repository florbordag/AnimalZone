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
	

	public function __get($property) { 
		if (property_exists($this, $property)) { 
		return $this->$property; } 
		}
		public function __set($property, $value) { 
		if (property_exists($this, $property)) { 
		$this->$property = $value; } 
		return $this; 
		} 



	public function save(){
		require_once ('Post.php');
require_once ('Usuario.php');
$p=$this->post->ID_POST;
$u=$this->usuario->id_usuario;
		$query="INSERT INTO `comentario`(`ID_COMENTARIO`, `ID_POST`, `ID_USUARIO`, `DESCRIPCION`, `FECHA`, `ESTADO`) VALUES ('$this->id_comentario','$p' ,'$u','$this->descripcion',NOW(),1);";
		
			$save=$this->db()->query($query);
			echo $this->db()->error;
			
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
	
	public function getComent($id){
		$query=$this->db()->query("SELECT * FROM comentario WHERE ID_COMENTARIO=$id;");
  
		if($row = $query->fetch_object()) {
		   $resultSet=$row;
		}
		
		return $resultSet;
	  }

	  public function getComentarios($id){
		$sql="SELECT * FROM comentario WHERE ID_POST =$id;";
	
		$query=$this->db()->query($sql);
		while ($row = $query->fetch_object()) { 
			$resultSet[]=$row;
		   
		}
		$resultSet=isset($resultSet)?$resultSet:NULL;
		return $resultSet;
	}

	public function eliminar($id)
	{
		$query= "DELETE FROM `comentario` WHERE ID_COMENTARIO=$id;";
		$save=$this->db()->query($query);
		return $save;
	}

}
?>