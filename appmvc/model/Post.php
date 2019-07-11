<?php
class Post extends EntidadBase{
    private $id_post;
    private $user; //id_usuario
    private $descripcion;
    private $fecha;
    private $titulo;
    private $imagen1=null;
    private $imagen2=null;
    private $imagen3=null;
    private $adjunto=null;
    private $palabra1=null;
    private $palabra2=null;
    private $palabra3=null;
    private $estado;
    private $publico;
    
    public function __construct($adapter) {
        $table="post";
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
		require_once "Usuario.php";
    require_once "Grupo.php";
		
		//verifico si el post se encuentra en la BD
		//sino es null entonces UPDATE
		//si es null entonces INSERT
		if($this->id_post){
			
			$query= "UPDATE post set TITULO = '$this->titulo', DESCRIPCION = '$this->descripcion'
			,ADJUNTO = '$this->adjunto' ,IMAGEN1 = '$this->imagen1', IMAGEN2 = '$this->imagen2',
			IMAGEN3= '$this->imagen3', where ID_POST = $this->id_post";
			
			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
			
		}
		else{
      $id=$this->user->id_usuario;
			$query= "INSERT INTO `post`(`ID_POST`, `ID_USUARIO`, `DESCRIPCION`, `FECHA`, `TITULO`, `IMAGEN1`, `IMAGEN2`, `IMAGEN3`, `ADJUNTO`, `PALABRA1`, `PALABRA2`, `PALABRA3`, `ESTADO`, `PUBLICO`) VALUES ('$this->id_post','$id','$this->descripcion','$this->fecha','$this->titulo','$this->imagen1','$this->imagen2','$this->imagen3','$this->adjunto','$this->palabra1','$this->palabra2','$this->palabra3','$this->estado','$this->publico');";

			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
		}	
    }


}

?>