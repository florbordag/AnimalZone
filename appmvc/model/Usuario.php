<?php
class Usuario extends EntidadBase{
    private $id_usuario;
    private $username;
    private $pass;
    private $salt;
    private $estado;
    private $fecha_alta;
    private $usuario_ult_mod;
    private $fecha_ult_mod;
    private $nombre;
    private $apellido;
    private $sexo;
    private $mail;
    private $imagen_perfil;
    private $animal_fav;
    private $pais;
    private $cp;
    private $nacimiento;
    private $descripcion;
    private $intereses;

    
    public function __construct($adapter) {
        $table="usuario";
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
        $password=$this->pass;
        $salt = bin2hex(random_bytes(32)); 
        $saltedPass = $password. $salt; 
        $hashedPass = hash('sha256', $saltedPass);
		require_once "Pais.php";
		//$codigo= $this->$pais->codigo;		echo $codigo;	
$query= "INSERT INTO `usuario`(`ID_USUARIO`, `USERNAME`, `PASSWORD`,`SALT`, `ESTADO`, `FECHA_ALTA`, `USUARIO_ULT_MOD`, `FECHA_ULT_MOD`, `NOMBRE`, `APELLIDO`, `SEXO`, `MAIL`,`IMAGEN_PERFIL`, `ANIMAL_FAV`, `PAIS`, `CP`, `NACIMIENTO`, `DESCRIPCION`, `INTERESES`) VALUES (NULL,'$this->username','$hashedPass',$salt,NULL,NULL,NULL,NULL,'$this->nombre','$this->apellido',NULL,'$this->mail','https://image.freepik.com/iconos-gratis/usuario_318-10541.jpg',NULL,$this->pais->codigo',NULL,NULL,NULL,NULL);";

            $save=$this->db()->query($query);
            //$this->db()->error;
            return $save;

		}	
	

        public function save2($pais){
            require_once "Pais.php";
            //$codigo= $this->$pais->codigo;		
            //echo $pais;	
    $query= "INSERT INTO `usuario`(`ID_USUARIO`, `USERNAME`, `PASSWORD`,`SALT`, `ESTADO`, `FECHA_ALTA`, `USUARIO_ULT_MOD`, `FECHA_ULT_MOD`, `NOMBRE`, `APELLIDO`, `SEXO`, `MAIL`,`IMAGEN_PERFIL`, `ANIMAL_FAV`, `PAIS`, `CP`, `NACIMIENTO`,`DESCRIPCION`, `INTERESES`) VALUES (NULL,'$this->username','$this->pass','$this->salt',1,NOW(),NULL,NULL,'$this->nombre','$this->apellido',NULL,'$this->mail','https://image.freepik.com/iconos-gratis/usuario_318-10541.jpg',NULL,'$pais',NULL,NULL,NULL,NULL);";
    
                $save=$this->db()->query($query);
                //$this->db()->error;
                return $save;
    
            }	

            public function guardar(){
        
                if($this->id_usuario){
                    $password= $this->pass;
                    $salt = $this->salt;
                    $saltedPass = $password. $salt; 
                    $hashedPass = hash('sha256', $saltedPass);

                    $num=$this->pais->__get('codigo');
                    $query= "UPDATE usuario set USERNAME= '$this->username', PASSWORD ='$hashedPass',
                    SALT= '$salt', ESTADO ='$this->estado', FECHA_ALTA ='$this->fecha_alta',
                    USUARIO_ULT_MOD= '$this->usuario_ult_mod', FECHA_ULT_MOD =NOW(),NOMBRE= '$this->nombre', APELLIDO ='$this->apellido',

                                SEXO='$this->sexo', MAIL='$this->mail', IMAGEN_PERFIL='$this->imagen_perfil',
                                ANIMAL_FAV ='$this->animal_fav',PAIS= '$num', CP='$this->cp', NACIMIENTO='$this->nacimiento', DESCRIPCION='$this->descripcion', INTERESES='$this->intereses'
                                WHERE ID_USUARIO = '$this->id_usuario';";

                    $save=$this->db()->query($query);

                    if($this->db()->error){$save = $this->db()->error;} else{echo "exito";}
                    return $save;
                    
                    
                }
            }

            public function obtenerpass($password,$mail){
                $sql = "SELECT SALT, PASSWORD FROM usuario WHERE MAIL = '$mail'";
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

public function consultar($mail){
    $sql="SELECT * from usuario WHERE MAIL='$mail'";
$result= $this->db()->query($sql);
$row = $result->fetch_assoc();
if($result->num_rows > 0){return true;}else{return false;}
}

public function consultarUsuario($username){
    $sql="SELECT * from usuario WHERE USERNAME='$username'";
$result= $this->db()->query($sql);
$row = $result->fetch_assoc();
if($result->num_rows > 0){return true;}else{return false;}
}


public function getUsuario($id){
    $query=$this->db()->query("SELECT * FROM usuario WHERE ID_USUARIO=$id;");

    if($row = $query->fetch_object()) {
       $resultSet=$row;
    }
    //$this->db()->error;
    return $resultSet;
  }

   public function buscarUsuariosxNombre($u,$id){
       $sql="SELECT * FROM `usuario` WHERE USERNAME LIKE '%$u%' AND ID_USUARIO!=$id";
    $query=$this->db()->query($sql);
    while ($row = $query->fetch_object()) { 
        $resultSet[]=$row;
       
    }
    $resultSet=isset($resultSet)?$resultSet:NULL;
    return $resultSet;
   }

   public function quierenAmistad($id){
  $sql="SELECT * FROM usuario WHERE ID_USUARIO IN (SELECT ID_USUARIO_S FROM amigo WHERE ID_USUARIO_R=$id AND ESTADO=0)";

  $query=$this->db()->query($sql);
  while ($row = $query->fetch_object()) { 
      $resultSet[]=$row;
     
  }$resultSet=isset($resultSet)?$resultSet:NULL;
   return $resultSet;}


   public function getAll(){
    $sql="SELECT * FROM usuario";
  
    $query=$this->db()->query($sql);
    while ($row = $query->fetch_object()) { 
        $resultSet[]=$row;
       
    }$resultSet=isset($resultSet)?$resultSet:NULL;
     return $resultSet;}


     public function activarUsuarios($users){
        $query="UPDATE usuario SET ESTADO=1 WHERE ID_USUARIO IN ($users);";

        $save=$this->db()->query($query);
        echo $this->db()->error;
     }

     public function desactivarUsuarios($users){
        $query="UPDATE usuario SET ESTADO=0 WHERE ID_USUARIO IN ($users);";

        $save=$this->db()->query($query);
        echo $this->db()->error;
     }
}

?>