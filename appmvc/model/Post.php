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
		
		//verifico si el post se encuentra en la BD
		//sino es null entonces UPDATE
		//si es null entonces INSERT

      $id=$this->user->id_usuario;
			$query= "INSERT INTO `post`(`ID_POST`, `ID_USUARIO`, `DESCRIPCION`, `FECHA`, `TITULO`, `IMAGEN1`, `IMAGEN2`, `IMAGEN3`, `ADJUNTO`, `PALABRA1`, `PALABRA2`, `PALABRA3`, `ESTADO`, `PUBLICO`) VALUES ('$this->id_post','$id','$this->descripcion',NOW(),'$this->titulo','$this->imagen1','$this->imagen2','$this->imagen3','$this->adjunto','$this->palabra1','$this->palabra2','$this->palabra3','$this->estado','$this->publico');";

			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
			
    }

    public function editar(){
      if($this->id_post){
			
        $query= "UPDATE `post` SET `DESCRIPCION`='$this->descripcion',`TITULO`='$this->titulo',`PALABRA1`='$this->palabra1',`PALABRA2`='$this->palabra2',`PALABRA3`='$this->palabra3',`PUBLICO`=$this->publico WHERE ID_POST=$this->id_post;";
        
        $save=$this->db()->query($query);
        //echo $this->db()->error;
        return $save;
        
      }
    }

    public function getPost($id){
      $query=$this->db()->query("SELECT * FROM post WHERE ID_POST=$id;");

      if($row = $query->fetch_object()) {
        $resultSet=$row;
     }
     //$this->db()->error;
     return $resultSet;
    }

    public function getPublicPost($id){
      $sql="SELECT p.* FROM post p JOIN usuario u ON p.ID_USUARIO= u.ID_USUARIO AND u.ID_USUARIO!=$id
      WHERE p.PUBLICO=1
      AND u.ID_USUARIO not in (SELECT ID_USUARIO from usuario u join amigo a on u.ID_USUARIO=a.ID_USUARIO_S or u.ID_USUARIO=a.ID_USUARIO_R
              where (a.ID_USUARIO_S=$id or a.ID_USUARIO_R=$id)
              and u.ID_USUARIO != $id
              and a.ESTADO=1);";
  
      $query=$this->db()->query($sql);
      while ($row = $query->fetch_object()) { 
          $resultSet[]=$row;
         
      }
      $resultSet=isset($resultSet)?$resultSet:NULL;
      return $resultSet;
  }

  public function eliminar($id)
	{
		$query= "DELETE FROM `post` WHERE ID_POST=$id;";
		$save=$this->db()->query($query);
		return $save;
  }
  
  public function getPostByKw($kw1,$kw2,$kw3,$id){
    $sql="SELECT * FROM 
    (SELECT * FROM post as posteos WHERE PALABRA1 IN ('$kw1','$kw2','$kw3')
    OR PALABRA2 IN('$kw1','$kw2','$kw3') OR PALABRA3 IN ('$kw1','$kw2','$kw3') AND ESTADO=1) 
    AS posteos
    WHERE ESTADO=1 
    AND ID_USUARIO!=$id 
    AND (PUBLICO=1 OR ID_USUARIO IN(SELECT DISTINCT(u.ID_USUARIO) from usuario u join amigo a on u.ID_USUARIO=a.ID_USUARIO_S or u.ID_USUARIO=a.ID_USUARIO_R
    where (a.ID_USUARIO_S=$id or a.ID_USUARIO_R=$id)
    and u.ID_USUARIO !=$id
     and a.ESTADO=1)) ORDER BY FECHA DESC";

    $query=$this->db()->query($sql); //echo $this->db()->error;
    while ($row = $query->fetch_object()) { 
        $resultSet[]=$row; 
       
    }
    $resultSet=isset($resultSet)?$resultSet:NULL; 
    return $resultSet;
  }

  public function getMisPostByKw($kw1,$kw2,$kw3,$id){
    $sql="SELECT * FROM post WHERE (PALABRA1 IN ('$kw1','$kw2','$kw3')
    OR PALABRA2 IN ('$kw1','$kw2','$kw3') OR PALABRA3 IN ('$kw1','$kw2','$kw3'))
    AND ESTADO=1 AND ID_USUARIO=$id ORDER BY FECHA DESC";

    $query=$this->db()->query($sql); //echo $this->db()->error;
    while ($row = $query->fetch_object()) { 
        $resultSet[]=$row; 
       
    }
    $resultSet=isset($resultSet)?$resultSet:NULL; 
    return $resultSet;
  }
  
}

?>