<?php

class Amigo extends EntidadBase{
	private $id_usuario_s;
	private $id_usuario_r;
	private $estado;
	private $fecha;

	

    public function __construct($adapter) {
        $table="amigo";
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


	public function SolicitarAmistad($yo, $amigo){
		$query="INSERT INTO `amigo`(`ID_USUARIO_S`, `ID_USUARIO_R`, `ESTADO`, `FECHA`) VALUES ('$yo', '$amigo' ,0,NOW());";

			$save=$this->db()->query($query);
			echo $this->db()->error;
			return $save;
	}

	public function eliminarAmigo($yo, $id)
	{
		$query= "DELETE FROM `amigo` WHERE ID_USUARIO_S= $id AND ID_USUARIO_R=$yo;";
		$save=$this->db()->query($query);
		return $save;
	}

    public function aceptar($yo, $id){
			  
		  $query= "UPDATE amigo SET ESTADO=1 WHERE ID_USUARIO_R=$yo AND ID_USUARIO_S =$id;";
		  
		  $save=$this->db()->query($query);
		  //echo $this->db()->error;
		  return $save;
		  
		
	  }

}
?>