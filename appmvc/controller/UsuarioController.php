<?php
SESSION_START();
class UsuarioController extends ControladorBase{
    public $conectar;
	public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }

		//Listar todos los Usuarios	
		public function index(){
			$this->view('login2','');
		}



public function crear(){
			//crea un usuario para registrar:
		require_once 'model/Pais.php';

			if(isset($_POST["mail"]) && isset($_POST["pass"]) && isset($_POST['nombre']) && isset($_POST['apellido'])&&  isset($_POST['pais'])&& isset($_POST['username']) ){
            
				//Creamos un usuario
				$usuario=new Usuario($this->adapter);

	$username= $_POST['username'];
	$password = $_POST['pass'];
	$apellido = $_POST['apellido'];
	$nombre = $_POST['nombre'];
	$mail = $_POST['mail'];
	$codigo = $_POST['pais'];

	$pais=new Pais($this->adapter);
	$allPaises= $pais->getPaises(); 
	foreach ($allPaises as $pa){if ($pa->codigo == $codigo){$pais->__set('pais',$pa->pais);}}

	$salt = bin2hex(random_bytes(32)); 
  $saltedPass = $password.$salt;    
   $hashedPass = hash('sha256', $saltedPass);
				
				$usuario->__set('nombre',$nombre);
				$usuario->__set('apellido',$apellido);
				$usuario->__set('mail',$mail);
				$usuario->__set('pass',$hashedPass);
				$usuario->__set('salt',$salt);
				$usuario->__set('username',$username);
				$usuario->__set('pais',$pais);



			$existe;
			$existeuser;
	if ($usuario->consultar($mail)){ $existe=true;} else {$existe=false;}
	if ($usuario->consultar($username)){ $existeuser=true;} else {$existeuser=false;}

		if($existe){					
		echo "<div class=\"alert alert-danger\" role=\"alert\">El mail ingresado ya se encuentra registrado.</div>";
		$this->registro();
    	}else{ 

			if($existeuser){
				echo "<div class=\"alert alert-danger\" role=\"alert\">El nombre de usuario ya existe. Elija otro.</div>";
				$this->registro();
			} else{

				$save=$usuario->save2($codigo);
				
				
				
				$_SESSION['usuario']=$usuario;
				$_SESSION['mail']=$mail;

				

				//$usuario= $this->setearUsuario($usuario);
				$this->redirect("Muro","modificarPerfil");}	}
				
			
			
			} else{ $this->registro();}
}


public function modificarPerfil(){
		$allPaises= $_SESSION["allPaises"];
		$allPaises = unserialize($allPaises);
		$usuario=new Usuario($this->adapter);
		$usuario= $_SESSION["usuario"]; 
		$usuario = unserialize($usuario); 
		//$usuario->muestraDni();
		$this->view('modperfil','');

}


public function setearUsuario($user){
		$user2=new Usuario($this->adapter);
		$id=$user['ID_USUARIO'];
		$username=$user['USERNAME'];
		$pass=$user['PASSWORD'];
		$salt=$user['SALT'];
		$estado=$user['ESTADO'];
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
		$descripcion=$user['DESCRIPCION'];
		$intereses=$user['INTERESES'];
		
						$user2->__set('id_usuario',$id); 
						$user2->__set('username',$username);
						$user2->__set('pass',$pass);
						$user2->__set('salt',$salt);
						$user2->__set('estado',$estado);
						$user2->__set('usuario_alta',$usuario_alta);
						
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
						$user2->__set('descripcion',$descripcion);
						$user2->__set('intereses',$intereses);
	return $user2;
}




	public function registro(){

			$pais=new Pais($this->adapter);
			$allPaises=$pais->getPaises();
			$this->view("registro",array("allPaises"=>$allPaises,));

	}

	
	
	public function login(){	
		
		if(isset($_POST['mail']) && isset($_POST['pass']) ) {
			$mail= $_POST['mail'];
			$password = $_POST['pass'];

				if($mail=='admin@admin.com'){
					
					$admin= new Admin($this->adapter);
					if($admin->obtenerpass($password,$mail)){

						$admin=$admin->getAdmin($mail);
						$_SESSION['ObjAdmin']=$admin;
						$this->redirect("Admin","index");


					} else {
						echo "<div class=\"alert alert-danger\" role=\"alert\">Contraseña o mail Incorrecto!</div>";
							$this->view("login2",'');}
					
					
					
					
					} else {
					$user= new Usuario($this->adapter);
					$user2= new Usuario($this->adapter);
					if ($user->obtenerpass($password,$mail)){
						$user= $user->getBy('MAIL',$mail);

						$id=$user['ID_USUARIO'];
						$username=$user['USERNAME'];
						$pass=$user['PASSWORD'];
						$salt=$user['SALT'];
						$estado=$user['ESTADO'];
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
						$descripcion=$user['DESCRIPCION'];
						$intereses=$user['INTERESES'];
		
						$_SESSION['id']= $id;
						$_SESSION['mail']=$mail;
		
						$user2->__set('id_usuario',$id); 
						$user2->__set('username',$username);
						$user2->__set('pass',$pass);
						$user2->__set('salt',$salt);
						$user2->__set('estado',$estado);
						
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
						$user2->__set('descripcion',$descripcion);
						$user2->__set('intereses',$intereses);
		
					$this->redirect("Muro","mostrarMuro");}
					
						//$this->view("index",array("user"=>$user2,));}
						 else{

							echo "<div class=\"alert alert-danger\" role=\"alert\">Contraseña o mail Incorrecto!</div>";
							$this->view("login2",'');
						}

				
				}


			// Chequea si la combinanción usuario, password existen en la BD
		
		

			}
	}



public function subirFotoMasco($username){

	$fileName=$_FILES['fotoperfil']['name'];
	$tmpName=$_FILES['fotoperfil']['tmp_name'];
	$fileSize=$_FILES['fotoperfil']['size'];
	$fileType=$_FILES['fotoperfil']['type'];
	if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){
	$imagenes=$_SERVER['DOCUMENT_ROOT']."/AnimalZone/appmvc/public/img/profile/";
	$extension=explode("/",$fileType);
	$fileName=$username.'.'.$extension[1];
	$filePath=$imagenes.$fileName;
	$serverName="http://localhost/AnimalZone/appmvc/public/img/mascota/".$fileName;
		if($result=move_uploaded_file($tmpName, $filePath)){
		$return=$serverName;}else{echo "no se subio";exit;}}
		return $return;
}


	public function nuevaMascota(){
		$mascota= new Mascota($this->adapter);
		$usuario= new Usuario($this->adapter);
		$usuario= $_SESSION['ObjUsuario'];
		
		if(isset($_POST['nombre'])&& isset($_POST['especie']) && isset($_POST['sexo']))
			{
				$mascota->__set('id_usuario',$usuario->id_usuario);
				$mascota->__set('nombre',$_POST['nombre']);
				$mascota->__set('especie',$_POST['especie']);
				$mascota->__set('especie',$_POST['sexo']);
				$mascota->__set('raza',$_POST['raza']);
				$mascota->__set('nacimiento',$_POST['nacimiento']);
				$mascota->__set('descripcion',$_POST['descripcion']);
				$img=null;
				if($_FILES['fotoperfil']['size']!=0){$img= $this->subirFotoMasco($_POST['nombre']);}
				$mascota->__set('foto_perfil',$img);

			} $mascota->save();
			$this->redirect("Muro","mostrarMuro");

	}

	public function agregarMascota(){
		$this->view("crearMasco",'');
	}

}

?>
