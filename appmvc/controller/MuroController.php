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
		
		public function mostrarAmigos(){
			if(isset($_SESSION['id'])&& isset($_SESSION['mail'])){
				$mail=$_SESSION["mail"];

				$us=new Usuario($this->adapter);
				$obj=$us->getBy('MAIL',$mail);
				$us= $this->setearUsuario($obj);

				$pais=new Pais($this->adapter);
				$allPaises=$pais->getPaises();

				$this->setearSesion($us);
				
				$id=$us->id_usuario;
				$ami= new Amigo($this->adapter);
				$amigos= $ami->obtenerAmigos($id); //echo $id; echo gettype($amigos);

				

				//foreach ($amigos as $ami) {echo "un amigo es".$ami['ID_USUARIO_R'];}
				$allAmigos= $this->recuperarAmigos($amigos);



					
				$this->view('amigos',array("user"=>$us, "allPaises"=>$allPaises,"amigos"=>$allAmigos,));
			} else {echo "ups! algo salio mal :(";}
		}
			
		
			public function recuperarAmigos($amigos){

													foreach ($amigos as $ami) {
																		$idami= $ami['ID_USUARIO_R'];
																		$user= new Usuario($this->adapter);
																		$user2= new Usuario($this->adapter);
																		$user= $user->getBy('ID_USUARIO',$idami);
																		$user2=$this->setearUsuario($user);
																		$allAmigos[]= $user2; } return $allAmigos;}

						public function recuperarPost($posteos){

													foreach ($posteos as $post) {
																		$idpost= $post['ID_POST'];				
																		$po= new Post($this->adapter);
																		$po2= new Post($this->adapter);
																		$po= $po->getBy('ID_POST',$idpost);
																		$po2=$this->setearPost($po);
																		$allPost[]= $po2; } return $allPost;}															


		public function mostrarMuro(){
			if(isset($_SESSION['id'])&& isset($_SESSION['mail'])){
				$mail=$_SESSION["mail"];

				$us=new Usuario($this->adapter);
				$obj=$us->getBy('MAIL',$mail);
				$us= $this->setearUsuario($obj);

				$pais=new Pais($this->adapter);
				$allPaises=$pais->getPaises();

				$this->setearSesion($us);

				$id=$us->id_usuario; //id de usuario logeadp
				$ami= new Amigo($this->adapter);
				$amigos= $ami->obtenerAmigos($id); //obtiene un array con los ids de los amigos - echo $id; echo gettype($amigos);
				// foreach ($amigos as $ami) {echo $ami->id_usuario_r;}

				//$po= new Post($this->adapter);
				$po= new Post($this->adapter);
				
				
				foreach ($amigos as $ami) {$idd=$ami['ID_USUARIO_R']; 
					$po2= $po->getPostAmigos($idd);//obtiene todos los post de 1 amigo
					echo gettype($po);
					$posteos=$this->recuperarPost($po2); //si  pones ($posteos) anda// me devuelve un array de objetos post de 1 amigo (todos los post de 1 amigo)
					$todosPost[]=$posteos;
												}
				


				
				$this->view('index',array("user"=>$us, "allPaises"=>$allPaises,"amigos"=>$amigos,"allPost"=>$todosPost,));
			} else {$this->redirect("Usuario","index");}
			
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
			$fecha_ult_mod= $hoy;


			$usuario_ult_mod=isset($_POST['usuario_ult_mod'])?$_POST['usuario_ult_mod']:null;
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
			
					if(isset($_FILES['fotoperfil']['name'])){$imagen_perfil= $this->subirFoto($username);}
			

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

public function setearPost($po){
						
						$id=$po['ID_POST'];
						$id_usuario=$po['ID_USUARIO'];
						$descrip=$po['DESCRIPCION'];
						$fecha=$po['FECHA'];
						$titulo=$po['TITULO'];
						$img1=$po['IMAGEN1'];
						$img2=$po['IMAGEN2'];
						$img3=$po['IMAGEN3'];
						$adj=$po['ADJUNTO'];
						$w1=$po['PALABRA1'];
						$w2=$po['PALABRA2'];
						$w3=$po['PALABRA3'];
						$estado=$po['ESTADO'];
						$publico=$po['PUBLICO'];

						$po2=new Post($this->adapter);

						$po2->__set('id_post',$id); 
						$po2->__set('descripcion',$descrip);
						$po2->__set('fecha',$fecha);
						$po2->__set('titulo',$titulo);
						$po2->__set('imagen1',$img1);
						$po2->__set('imagen2',$img2);
						$po2->__set('imagen3',$img3);
						$po2->__set('adjunto',$adj);
						$po2->__set('palabra1',$w1);
						$po2->__set('palabra2',$w2);
						$po2->__set('palabra3',$w3);
						$po2->__set('estado',$estado);
						$po2->__set('publico',$publico);

						
																		$user= new Usuario($this->adapter);
																		$user2= new Usuario($this->adapter);
																		$user= $user->getBy('ID_USUARIO',$id_usuario);
																		$user2=$this->setearUsuario($user);
						
						$po2->__set('user',$user2);

						return $po2;} 

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
		$return=$serverName;}else{echo "no se subio";exit;}}
		return $return;
	}
	

}

?>
