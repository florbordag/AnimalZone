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
	if ($usuario->consultar($mail)){ $existe=true;} else {$existe=false;}

		if($existe){					
		echo "<div class=\"alert alert-danger\" role=\"alert\">El mail ingresado ya se encuentra registrado.</div>";
		$this->registro();
    	}else{ 
				$save=$usuario->save2($codigo);
				
				
				
				$_SESSION['usuario']=$usuario;
				$_SESSION['mail']=$mail;

				

				//$usuario= $this->setearUsuario($usuario);
				$this->redirect("Muro","modificarPerfil");}	
				
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
	return $user2;
}

public function misPost($id){
	require_once 'model/Post.php';
	$post= new Post($this->adapter);
	$query= "SELECT * from post WHERE ID_USUARIO = '$id' ORDER BY FECHA DESC;";
	$allpost= $post->getPosts($id);
	return $allpost;
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
			// Chequea si la combinanción usuario, password existen en la BD
		
		
			$user= new Usuario($this->adapter);
			$user2= new Usuario($this->adapter);
			if ($user->obtenerpass($password,$mail)){
				$user= $user->getBy('MAIL',$mail);
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

	$_SESSION['id']= $id;
	$_SESSION['mail']=$mail;

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

				$post= new Post($this->adapter);
				$allPost= $post->getPosts($id); //echo gettype($allPost); echo gettype($post);
			//	foreach ($allPost as $p=>$val){echo $p->id_post." problem in usuariocontroller accion login";}


			//	foreach($allPost as $post=>$value){echo $value->titulo. " ".$post->id_post;}
		     $this->view("index",array("user"=>$user2,"allPost"=>$allPost));}
				//$this->view("index",array("user"=>$user2,));}
				 else{
					echo "<div class=\"alert alert-danger\" role=\"alert\">Contraseña o mail Incorrecto!</div>";
					$this->view("login2",'');
				}}

	}


}
?>
