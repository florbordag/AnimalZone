<?php
			SESSION_START();
class MuroController extends ControladorBase{
    public $conectar;
	public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
		$this->adapter =$this->conectar->conexion();  }
		
	/*	public function desmembrarPost()}{
			switch ($i) {
				case "nombre":
					echo "$user=";
					break;
				case "barra":
					echo "i es una barra";
					break;
				case "pastel":
					echo "i es un pastel";
					break;
			}
		} */

		public function cerrarSesion(){
			session_unset();
			session_destroy();
			$this->redirect();
		}

		public function miMuro(){
			if(isset($_SESSION['id'])&& isset($_SESSION['mail'])){
				$mail=$_SESSION["mail"];
				$us=new Usuario($this->adapter);
				
				
				$obj=$us->getBy('MAIL',$mail);
			
				$us= $this->setearUsuario($obj);
				$pais=new Pais($this->adapter);
				$allPaises=$pais->getPaises();

				$this->setearSesion($us);
				 

				$this->view('index',array("user"=>$us, "allPaises"=>$allPaises,));
			} else {echo "ups! algo salio mal :(";}
			
		}
		

		public function mostrarMuro(){
			if(isset($_SESSION['id'])&& isset($_SESSION['mail'])){
				$mail=$_SESSION["mail"];
				$us=new Usuario($this->adapter);
				
				
				$obj=$us->getBy('MAIL',$mail);
			
				$us= $this->setearUsuario($obj);
				$pais=new Pais($this->adapter);
				$allPaises=$pais->getPaises();

				$this->setearSesion($us);
				 
				echo $us->imagen_perfil.$us->mail;
				$this->view('index',array("user"=>$us, "allPaises"=>$allPaises,));
			} else {echo "ups! algo salio mal :(";}
			
		}

		public function setearSesion($obj){
			//SESSION_UNSET();
			$_SESSION['id']= $obj->id_usuario;
			$_SESSION['username']= $obj->username;
			$_SESSION['pass']= $obj->pass;
			$_SESSION['salt']= $obj->salt;
			$_SESSION['estado']= $obj->estado;
			$_SESSION['usuario_alta']= $obj->usuario_alta;
			$_SESSION['fecha_alta']= $obj->fecha_alta;
			$_SESSION['usuario_ult_mod']= $obj->usuario_ult_mod;
			$_SESSION['fecha_ult_mod']= $obj->fecha_ult_mod;
			$_SESSION['nombre']= $obj->nombre;
			$_SESSION['apellido']= $obj->apellido;
			$_SESSION['sexo']= $obj->sexo;
			$_SESSION['mail']= $obj->mail;
			$_SESSION['animal_fav']= $obj->animal_fav;
			$_SESSION['pais']= $obj->pais;
			$_SESSION['cp']= $obj->cp;
			$_SESSION['nacimiento']= $obj->nacimiento;
			
		}

	public function actualizarPerfil(){
		if(isset($_POST['id']) ) { 

			$user=new Usuario($this->adapter);
			$user2=new Usuario($this->adapter);

			$id=$_POST['id'];
			$password=$_POST['pass'];
			$mail=$_POST['mail'];
		if ($user2->obtenerpass($password,$mail)){

			$username=isset($_POST['username'])?$_POST['username']:null;
			$salt=isset($_POST['salt'])?$_POST['salt']:null;
			$estado=isset($_POST['estado'])?$_POST['estado']:null;
			$usuario_alta=isset($_POST['usuario_alta'])?$_POST['usuario_alta']:null;
			$fecha_alta=isset($_POST['fecha_alta'])?$_POST['fecha_alta']:null;

			$hoy=strftime( "%Y-%m-%d-%H-%M-%S", time() );
			$usuario_ult_mod= $hoy;


			$fecha_ult_mod=isset($_POST['fecha_ult_mod'])?$_POST['fecha_ult_mod']:null;
			$nombre=isset($_POST['nombre'])?$_POST['nombre']:null;
			$apellido=isset($_POST['apellido'])?$_POST['apellido']:null;
			$sexo=isset($_POST['sexo'])?$_POST['sexo']:null;
			$mail=isset($_POST['mail'])?$_POST['mail']:null;
			$animal_fav=isset($_POST['animal_fav'])?$_POST['animal_fav']:null;
			$codigo=$_POST['pais'];

			$pais=new Pais($this->adapter);
			$allPaises= $pais->getPaises(); 
			foreach ($allPaises as $pa){if ($pa->codigo == $codigo){$pais->__set('pais',$pa->pais); $pais->__set('codigo',$codigo);}}

			$cp=isset($_POST['cp'])?$_POST['cp']:null;
			$nacimiento=isset($_POST['nacimiento'])?$_POST['nacimiento']:null;
			$imagen_perfil=isset($_POST["actual"])?$_POST["actual"]:NULL;
			
					if($imagen_perfil){$imagen_perfil= $this->subirFoto($username);} else {$imagen_perfil=$_POST['actual'];} 
			

			$user->__set('id_usuario',$id); 
			$user->__set('username',$username);
			$user->__set('pass',$password);
			$user->__set('salt',$salt);
			$user->__set('estado',$estado);
			$user->__set('usuario_alta',$usuario_alta);
			$user->__set('fecha_alta',$fecha_alta);
			$user->__set('usuario_ult_mod',$usuario_ult_mod);
			$user->__set('fecha_ult_mod',$fecha_ult_mod);
			$user->__set('nombre',$nombre);
			$user->__set('apellido',$apellido);
			$user->__set('sexo',$sexo);
			$user->__set('mail',$mail);
			$user->__set('imagen_perfil',$imagen_perfil);
			$user->__set('animal_fav',$animal_fav);
			$user->__set('pais',$pais);
			$user->__set('cp',$cp);
			$user->__set('nacimiento',$nacimiento);

			//ahora actualizo:
			$save=$user->guardar(); echo $save;
			$this->setearSesion($user);
			
			//y voy al muro: 
			$this->redirect("Muro","mostrarMuro");
		 						}else{echo "<div class=\"alert alert-danger\" role=\"alert\">Password Incorrecto!</div>";;}
							}else {echo "error MuroController Actualizar no isset nada";}

		}

public function modificarPerfil(){


			if(isset($_SESSION["mail"])){
				$us=new Usuario($this->adapter);
				$mail=$_SESSION["mail"];
				$obj=$us->getBy('MAIL',$mail);
				$obj= $this->setearUsuario($obj);
				$pais=new Pais($this->adapter);
				$allPaises=$pais->getPaises();

				$_SESSION['id']= $obj->id_usuario; 

			$this->view('modperfil',array("usuario"=>$obj,"allPaises"=>$allPaises,));
	
												} 
		
										}

	public function setearUsuario($user){
					$user2=new Usuario($this->adapter);
					$id=$user['ID_USUARIO'];
					$username=$user['USERNAME'];
					$pass=$user['PASSWORD'];
					$salt=$user['SALT'];
					$estado=$user['ESTADO'];
					$usuario_alta=$user['USUARIO_ALTA'];
					$fecha_alta=$user['FECHA_ALTA'];
					$usuario_ult_mod=$user['USUARIO_ULT_MOD'];
					$fecha_ult_mod=$user['FECHA_ULT_MOD'];
					$nombre=$user['NOMBRE'];
					$apellido=$user['APELLIDO'];
					$sexo=$user['SEXO'];
					$mail=$user['MAIL'];
					$imagen_perfil=$user['IMAGEN_PERFIL'];
					$animal_fav=$user['ANIMAL_FAV'];
					$pais=$user['PAIS'];
					$cp=$user['CP'];
					$nacimiento=$user['NACIMIENTO'];
	
					$user2->__set('id_usuario',$id); 
					$user2->__set('username',$username);
					$user2->__set('pass',$pass);
					$user2->__set('salt',$salt);
					$user2->__set('estado',$estado);
					$user2->__set('usuario_alta',$usuario_alta);
					$user2->__set('fecha_alta',$fecha_alta);
					$user2->__set('usuario_ult_mod',$usuario_ult_mod);
					$user2->__set('fecha_ult_mod',$fecha_ult_mod);
					$user2->__set('nombre',$nombre);
					$user2->__set('apellido',$apellido);
					$user2->__set('sexo',$sexo);
					$user2->__set('mail',$mail);
					$user2->__set('imagen_perfil',$imagen_perfil);
					$user2->__set('animal_fav',$animal_fav);
					$user2->__set('pais',$pais);
					$user2->__set('cp',$cp);
					$user2->__set('nacimiento',$nacimiento);
					return $user2;}


 	public function subirFoto($username){

		$fileName=$_FILES['fotoperfil']['name'];
		$tmpName=$_FILES['fotoperfil']['tmp_name'];
		$fileSize=$_FILES['fotoperfil']['size'];
		$fileType=$_FILES['fotoperfil']['type'];
if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){
	$imagenes=$_SERVER['DOCUMENT_ROOT']."/AnimalZone/appmvc/public/img/profile/";
	 $extension=explode("/",$fileType);
	$fileName=$username.'.'.$extension[1];
	$filePath=$imagenes.$fileName;
	$serverName="http://localhost/AnimalZone/appmvc/public/img/profile/".$fileName;
	if($result=move_uploaded_file($tmpName, $filePath)){
		$usuario->__set("fotoperfil",$serverName);}else{echo "no se subio";exit;}}
		return $serverName;
	}
	

}

?>
