<?php
			SESSION_START();
class MuroController extends ControladorBase{
    public $conectar;
	public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
		$this->adapter =$this->conectar->conexion();  }
		
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

				$this->setearSesion($us);
				$_SESSION['ObjUsuario']=$us;

				$id=$us->id_usuario; //id de usuario logeadp

				$po= new Post($this->adapter);
				$posteos= $po->getMisPost($id); //obtiene todos los posteos a mostrar
				
				foreach ($posteos as $p) { $a= new Usuario($this->adapter);
					$idp=$p->ID_POST;

						$com=new Comentario($this->adapter);
						
						$coments=$com->getComentarios($idp); //obtiene todos los comentarios de 1 posteo

						$kk=null;
						foreach ((array)$coments as $c) { $a= new Usuario($this->adapter); $iduc=$c->ID_USUARIO;
							$a=$a->getUsuario($iduc);
							$co= new Comentario($this->adapter);
							$co->__set('id_comentario',$c->ID_COMENTARIO);
							$co->__set('post',$p);
							$co->__set('usuario',$a);
							$co->__set('descripcion',$c->DESCRIPCION);
							$co->__set('fecha',$c->FECHA);
							$co->__set('estado',$c->ESTADO);
							$c=$co; //echo $c->usuario->ID_USUARIO;
							$kk[]=$c;
						}
							$comentarios[]=$kk;
							}
				
			$this->view('mimuro',array("user"=>$us,"allPost"=>$posteos,"coments"=>$comentarios));
			} else {$this->redirect("Usuario","index");}


		}
		
		public function mostrarAmigos(){
			if(isset($_SESSION['id'])&& isset($_SESSION['mail'])){
				$mail=$_SESSION["mail"];

				$us=new Usuario($this->adapter);
				$obj=$us->getBy('MAIL',$mail);
				$us= $this->setearUsuario($obj);
				$_SESSION['ObjUsuario']=$us;

				$pais=new Pais($this->adapter);
				$allPaises=$pais->getPaises();

				$this->setearSesion($us);
				
				$id=$us->id_usuario;
				$ami= new Amigo($this->adapter);
				$amigos= $ami->obtenerAmigos($id); //echo $id; echo gettype($amigos);




					
				$this->view('amigos',array("user"=>$us, "allPaises"=>$allPaises,"amigos"=>$amigos,));
			} else {echo "ups! algo salio mal :(";}
		}
													


		public function mostrarMuro(){
			if(isset($_SESSION['id'])&& isset($_SESSION['mail'])){
				$mail=$_SESSION["mail"];

				$pais=new Pais($this->adapter);
				$allPaises=$pais->getPaises();

				$us=new Usuario($this->adapter);
				$obj=$us->getBy('MAIL',$mail);
				$us= $this->setearUsuario($obj);
				$_SESSION['ObjUsuario']=$us;

				$this->setearSesion($us);

				$id=$us->id_usuario; //id de usuario logeadp
				
				$ami= new Usuario($this->adapter);
				$amigos= $ami->obtenerAmigos($id); //obtiene un array con tods ls amigos(clsUSUARIO) - echo $id; echo gettype($amigos);

				$po= new Post($this->adapter);
				$posteos= $po->postajenos($id); //obtiene todos los posteos a mostrar
				$kk=null;
				
				if($posteos !=null){
				
					foreach ($posteos as $p) { 

						$a= new Usuario($this->adapter); $i=$p->ID_USUARIO;$idp=$p->ID_POST;
					$a= $a->getAmi($i);

						$p=$this->setearPost($p);
						$pos2[]=$p;

						$com=new Comentario($this->adapter);
						
						$coments=$com->getComentarios($idp); //obtiene todos los comentarios de 1 posteo

						$kk=null;
						foreach ((array)$coments as $c) { $a= new Usuario($this->adapter); $iduc=$c->ID_USUARIO;
							$a=$a->getUsuario($iduc);
							$co= new Comentario($this->adapter);
							$co->__set('id_comentario',$c->ID_COMENTARIO);
							$co->__set('post',$p);
							$co->__set('usuario',$a);
							$co->__set('descripcion',$c->DESCRIPCION);
							$co->__set('fecha',$c->FECHA);
							$co->__set('estado',$c->ESTADO);
							$c=$co; //echo $c->usuario->ID_USUARIO;
							$kk[]=$c;
						}

							$comentarios[]=$kk;}
					

						} else {$pos2=null; $comentarios=null;}


						$pp= new Post($this->adapter);
						$publicp= $pp->getPublicPost($id);
						

						if($publicp !=null){
							foreach ($publicp as $p) { $a= new Usuario($this->adapter); $i=$p->ID_USUARIO;$idp=$p->ID_POST;
													
								
										$p=$this->setearPost($p);
										$publicos[]=$p;
		
										$comp=new Comentario($this->adapter); $kkp=null;
										
										$comentspp=$comp->getComentarios($idp); //obtiene todos los comentarios de 1 posteo
				
										
										foreach ((array)$comentspp as $c) { $a= new Usuario($this->adapter); $iduc=$c->ID_USUARIO;
											$a=$a->getUsuario($iduc);
											$co= new Comentario($this->adapter);
											$co->__set('id_comentario',$c->ID_COMENTARIO);
											$co->__set('post',$p);
											$co->__set('usuario',$a);
											$co->__set('descripcion',$c->DESCRIPCION);
											$co->__set('fecha',$c->FECHA);
											$co->__set('estado',$c->ESTADO);
											$c=$co; //echo $c->usuario->ID_USUARIO;
											$kkp[]=$c;
										}
												$pcoment[]=$kkp;
									 }

								} else {$publicos=null; $pcoment=null;}

								$report=new Report($this->adapter);
								$report = $report->getPReport(); 
							
				
			$this->view('index',array("user"=>$us, "allPaises"=>$allPaises,"allPost"=>$pos2,"coments"=>$comentarios, "publicos"=>$publicos, "pcoment"=>$pcoment,"reportes"=>$report,));
			} else {$this->redirect("Usuario","index");}
			
		}

		public function setearSesion($obj){
			//SESSION_UNSET();
			$_SESSION['id']= $obj->id_usuario;
			$_SESSION['username']= $obj->username;
			$_SESSION['pass']= $obj->pass;
			$_SESSION['salt']= $obj->salt;
			$_SESSION['estado']= $obj->estado;
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
			$_SESSION['descripcion']= $obj->descripcion;
			$_SESSION['intereses']= $obj->intereses;
			
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
			$descripcion=isset($_POST['descript'])?$_POST['descript']:null;
			$intereses=isset($_POST['intereses'])?$_POST['intereses']:null;

			$imagen_perfil=isset($_POST["actual"])?$_POST["actual"]:NULL;
			
					if(isset($_FILES['fotoperfil']['name'])&& $_FILES['fotoperfil']['size']!=0 ){$imagen_perfil= $this->subirFoto($username);} else {$imagen_perfil=$_POST['actual'];}
			

			$user->__set('id_usuario',$id); 
			$user->__set('username',$username);
			$user->__set('pass',$password);
			$user->__set('salt',$salt);
			$user->__set('estado',$estado);
			
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
			$user->__set('descripcion',$descripcion);

			$intereses="";
			$arr= $_POST['intereses'];
			$num= count($arr);
			for($n=0;$n<$num; $n++){ $intereses= $intereses.$arr[$n].",";}


			
			$user->__set('intereses',$intereses);


			//ahora actualizo:
			$save=$user->guardar(); echo $save;
			$this->setearSesion($user);
			$_SESSION['ObjUsuario']=$user;
			
			//y voy al muro: 
			$this->redirect("Muro","mostrarMuro");
		 						}else{echo "<div class=\"alert alert-danger\" role=\"alert\">Password Incorrecto!</div>";}
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
					return $user2;}

public function setearPost($po){
			$po2=new Post($this->adapter);
						$id=$po->ID_POST;
						$id_usuario=$po->ID_USUARIO;
						$descrip=$po->DESCRIPCION;
						$fecha=$po->FECHA;
						$titulo=$po->TITULO;
						$img1=$po->IMAGEN1;
						$img2=$po->IMAGEN2;
						$img3=$po->IMAGEN3;
						$adj=$po->ADJUNTO;
						$w1=$po->PALABRA1;
						$w2=$po->PALABRA2;
						$w3=$po->PALABRA3;
						$estado=$po->ESTADO;
						$publico=$po->PUBLICO;

						

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

						return $po2;} //object 

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

	public function subirFP1($username){

		$fileName=$_FILES['img1']['name'];
		$tmpName=$_FILES['img1']['tmp_name'];
		$fileSize=$_FILES['img1']['size'];
		$fileType=$_FILES['img1']['type'];
		    if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){
			$imagenes=$_SERVER['DOCUMENT_ROOT']."/AnimalZone/appmvc/public/img/post/";
			$extension=explode("/",$fileType);
			$fileName=$username.'.'.$extension[1];
			$filePath=$imagenes.$fileName;
			$serverName="http://localhost/AnimalZone/appmvc/public/img/post/".$fileName;
				if($result=move_uploaded_file($tmpName, $filePath)){
				$return=$serverName;}else{echo "no se subio";exit;}}
				return $return;
	}
public function subirFP2($username){

		$fileName=$_FILES['img2']['name'];
		$tmpName=$_FILES['img2']['tmp_name'];
		$fileSize=$_FILES['img2']['size'];
		$fileType=$_FILES['img2']['type'];
	if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){
	$imagenes=$_SERVER['DOCUMENT_ROOT']."/AnimalZone/appmvc/public/img/post/";
	 $extension=explode("/",$fileType);
	$fileName=$username.'.'.$extension[1];
	$filePath=$imagenes.$fileName;
	$serverName="http://localhost/AnimalZone/appmvc/public/img/post/".$fileName;
	if($result=move_uploaded_file($tmpName, $filePath)){
		$return=$serverName;}else{echo "no se subio";exit;}}
		return $return;
	}
public function subirFP3($username){

		$fileName=$_FILES['img3']['name'];
		$tmpName=$_FILES['img3']['tmp_name'];
		$fileSize=$_FILES['img3']['size'];
		$fileType=$_FILES['img3']['type'];
	if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){
	$imagenes=$_SERVER['DOCUMENT_ROOT']."/AnimalZone/appmvc/public/img/post/";
	 $extension=explode("/",$fileType);
	$fileName=$username.'.'.$extension[1];
	$filePath=$imagenes.$fileName;
	$serverName="http://localhost/AnimalZone/appmvc/public/img/post/".$fileName;
	if($result=move_uploaded_file($tmpName, $filePath)){
		$return=$serverName;}else{echo "no se subio";exit;}}
		return $return;
	}
	public function subirAdj($username){

		$fileName=$_FILES['adj']['name'];
		$tmpName=$_FILES['adj']['tmp_name'];
		$fileSize=$_FILES['adj']['size'];
		$fileType=$_FILES['adj']['type'];
	$imagenes=$_SERVER['DOCUMENT_ROOT']."/AnimalZone/appmvc/public/img/post/";
	 $extension=explode("/",$fileType);
	$fileName=$username.'.'.$extension[1];
	$filePath=$imagenes.$fileName;
	$serverName="http://localhost/AnimalZone/appmvc/public/img/post/".$fileName;
	if($result=move_uploaded_file($tmpName, $filePath)){
		$return=$serverName;}else{echo "no se subio";exit;}
		return $return;
	}
	
public function postear(){

	if(isset($_POST['descrip'])){ $hoy = date_create()->format('Y-m-d H:i:s');
		$post= new Post($this->adapter);
		$us=new Usuario($this->adapter);
		$mail=$_SESSION["mail"];
		$obj=$us->getBy('MAIL',$mail);
		$us= $this->setearUsuario($obj);

		$post->__set("user",$us);
		$post->__set("descripcion",$_POST['descrip']);
		$post->__set("fecha",$hoy);  echo $post->fecha;
		$post->__set("titulo",$_POST['titulo']);

		$img1=null; $img2=null; $img3=null;$adj=null;
		if(!empty($_FILES['img1']['name'])){$img1= $this->subirFP1($us->username);}
		if(!empty($_FILES['img2']['name'])){$img2= $this->subirFP2($us->username);}
		if(!empty($_FILES['img3']['name'])){$img3= $this->subirFP3($us->username);}

		$post->__set("imagen1",$img1);
		$post->__set("imagen2",$img2);
		$post->__set("imagen3",$img3);

		if(!empty($_FILES['adj']['name'])){$adj= $this->subirAdj($us->username);} 
		$post->__set('adjunto',$adj);

		$kw1=isset($_POST['kw1'])?$_POST['kw1']:NULL;
		$kw2=isset($_POST['kw2'])?$_POST['kw2']:NULL;
		$kw3=isset($_POST['kw3'])?$_POST['kw3']:NULL;

		$post->__set('palabra1',$kw1);
		$post->__set('palabra2',$kw2);
		$post->__set('palabra3',$kw3);
		$post->__set('estado',1);
		$post->__set('publico',$_POST['public']);

		$post->save();

	
		$this->redirect("Muro","miMuro");


	} else {echo "No hay contenido";}

}
 
		public function editarPost(){

			if(isset($_POST['editar']) && isset($_POST['idpost'])) {

				$post= new Post($this->adapter);
				$id=$_POST['idpost'];
				$post->__set('id_post',$id);
				$post->__set('titulo',$_POST['tituloe']);
				$post->__set('descripcion',$_POST['descripe']);

				$kw1=isset($_POST['kwe1'])?$_POST['kwe1']:NULL;
				$kw2=isset($_POST['kwe2'])?$_POST['kwe2']:NULL;
				$kw3=isset($_POST['kwe3'])?$_POST['kwe3']:NULL;

				$post->__set('palabra1',$kw1);
				$post->__set('palabra2',$kw2);
				$post->__set('palabra3',$kw3);
				$post->__set('publico',$_POST['publice']);
				$post->editar(); echo $post->id_post;

				$this->redirect("Muro","miMuro");
			} else {$this->redirect("Usuario","index");}

								}


								public function comentarMimuro(){

									if(isset($_POST['comentar']) && isset($_POST['idpostc'])){
									$coment= new Comentario($this->adapter);
									$user=new Usuario($this->adapter);
									$user=$_SESSION['ObjUsuario'];

									$post= new Post($this->adapter);
									$post= $post->getPost($_POST['idpostc']);
									
									$coment->__set('post',$post);
									$coment->__set('usuario',$user);
									$coment->__set('descripcion',$_POST['descripc']);

									$coment->save();

									echo $user->id_usuario; echo $post->DESCRIPCION;

									$this->redirect("Muro","miMuro");}
									else {$this->redirect("Usuario","index");}
										
										}

										public function comentar(){

											if(isset($_POST['comentar']) && isset($_POST['idpostc'])){
											$coment= new Comentario($this->adapter);
											$user=new Usuario($this->adapter);
											$user=$_SESSION['ObjUsuario'];
		
											$post= new Post($this->adapter);
											$post= $post->getPost($_POST['idpostc']);
											
											$coment->__set('post',$post);
											$coment->__set('usuario',$user);
											$coment->__set('descripcion',$_POST['descripc']);
		
											$coment->save();
		
											echo $user->id_usuario; echo $post->DESCRIPCION;
		
											$this->redirect("Muro","mostrarMuro");}
											else {$this->redirect("Usuario","index");}
												
												}

			public function eliminarPost(){
					$post= new Post($this->adapter);
					if(isset($_POST['idposteliminar'])){ $post->eliminar($_POST['idposteliminar']); $this->redirect("Muro","mostrarMuro"); }
					else {echo "ERROR AL ELIMINAR POST";}
			}
						
			public function eliminarComentario(){
				$coment= new Comentario($this->adapter);
				if(isset($_POST['idComenteliminar'])){ $coment->eliminar($_POST['idComenteliminar']); $this->redirect("Muro","mostrarMuro"); }
				else {echo "ERROR AL ELIMINAR COMENTARIO";}
		}



public function reportarPost(){
			if(isset($_POST['idpostr'])){
			$post= new Post($this->adapter);
			$post= $post->getPost($_POST['idpostr']);
			$user = new Usuario($this->adapter);
			$user= $_SESSION['ObjUsuario'];
			$report= new Report($this->adapter);
			$report->__set('post',$post);
			$report->__set('usuario',$user);	
			$report->__set('comentario',NULL); 
			$motivo="";
			$arr= $_POST['motivo'];
			$num= count($arr);
			for($n=0;$n<$num; $n++){ $motivo= $motivo.$arr[$n].",";}

			$report->__set('motivo',$motivo);
				$report->reportPost();
				$this->redirect("Muro","mostrarMuro");
			}else {echo "<div class=\"alert alert-danger\" role=\"alert\">Debes seleccionar el motivo del reporte</div>";}
		
		
		}


	}



?>
