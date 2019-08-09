<?php


class Report extends EntidadBase
{private $id_report;
private $post; //id_post
private $usuario; //id_usuario reportero jaja
private $fecha_denuncia;
private $moderador; //id_usuario_mod
private $motivo;
private $fecha_moderacion=null;
private $comentario=null;
	

	    public function __construct($adapter) {
        $table="report";
        parent::__construct($table, $adapter);
        require_once ('Comentario.php');
require_once ('Post.php');
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


    public function reportPost(){
        $idp= $this->post->ID_POST;
        $idu=$this->usuario->id_usuario;
        
            $query="INSERT INTO `report`(`ID_REPORT`,`ID_POST`, `ID_USUARIO`, `FECHA_DENUNCIA`, `ID_USUARIO_MOD`, `MOTIVO`, `FECHA_MODERACION`, `ID_COMENTARIO`) VALUES (NULL,'$idp','$idu',NOW(),NULL,'$this->motivo',NULL,NULL);";

        $save=$this->db()->query($query);
        echo $this->db()->error;
        return $save;
    }

    public function reportComent(){
        $idp= $this->post->ID_POST;
        $idu=$this->usuario->id_usuario;
        $idc=$this->comentario->ID_COMENTARIO;
        
            $query="INSERT INTO `report`(`ID_REPORT`,`ID_POST`, `ID_USUARIO`, `FECHA_DENUNCIA`, `ID_USUARIO_MOD`, `MOTIVO`, `FECHA_MODERACION`, `ID_COMENTARIO`) VALUES (NULL,'$idp','$idu',NOW(),NULL,'$this->motivo',NULL,$idc);";

        $save=$this->db()->query($query);
        echo $this->db()->error;
        return $save;
    }

        public function moderarComent($coments){
        $query="UPDATE `report` SET `FECHA_MODERACION`= NOW() WHERE ID_COMENTARIO IN ($coments);";

            $save=$this->db()->query($query);
            
            return $save;
    }

    public function moderarPost($post){
        $query="UPDATE `report` SET `FECHA_MODERACION`= NOW() WHERE ID_POST IN ($post);";

            $save=$this->db()->query($query);
            
            return $save;
    }

    public function getPReport(){
        $query=$this->db()->query("SELECT * FROM report WHERE ID_COMENTARIO IS NULL;");
        while ($row = $query->fetch_object()) { 
            $resultSet[]=$row;
           
        }
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
      }
      
    public function getCReport(){
        $query=$this->db()->query("SELECT * FROM report WHERE ID_COMENTARIO!=NULL;");
  
        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
        
        return $resultSet;
      }

      public function getAllPostReported(){
        $sql="SELECT p.*,r.ID_REPORT,r.ID_USUARIO as ID_USER_REP,r.FECHA_DENUNCIA,r.MOTIVO,r.FECHA_MODERACION FROM post p JOIN report r ON p.ID_POST=r.ID_POST;";
      
        $query=$this->db()->query($sql);
        while ($row = $query->fetch_object()) { 
            $resultSet[]=$row;
           
        }$resultSet=isset($resultSet)?$resultSet:NULL;
         return $resultSet;}

         public function getAllComentReported(){
            $sql="SELECT c.*,r.ID_REPORT,r.ID_USUARIO as ID_USER_REP,r.FECHA_DENUNCIA,r.MOTIVO,r.FECHA_MODERACION FROM comentario c JOIN report r ON c.ID_COMENTARIO=r.ID_COMENTARIO;";
          
            $query=$this->db()->query($sql);
            while ($row = $query->fetch_object()) { 
                $resultSet[]=$row;
               
            }$resultSet=isset($resultSet)?$resultSet:NULL;
             return $resultSet;}
  
}
?>