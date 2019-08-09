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
			unset($_SESSION['ObjUsuario']);
			session_destroy();
			$this->redirect();
		}

		public function miMuro(){ 
			if(isset($_SESSION['ObjUsuario'])){
				$mail=$_SESSION["mail"];

				$pais=new Pais($this->adapter);
				$allPaises=$pais->getPaises();

				$us=new Usuario($this->adapter);
				$us=$_SESSION['ObjUsuario'];
				
				

				$id=$us->id_usuario; //id de usuario logeadp
				
				$ami= new Usuario($this->adapter);
				$amigos= $ami->obtenerAmigos($id); //obtiene un array con tods ls amigos(clsUSUARIO) - echo $id; echo gettype($amigos);

				$po= new Post($this->adapter);
				$po= $po->getMisPost($id); //obtiene todos los posteos a mostrar
				$quieren= new Usuario($this->adapter);
				$quieren= $quieren->quierenAmistad($id);
				
				if($po !=null){
				
					foreach ($po as $p){ $pi= new Post($this->adapter);

						 $i=$p->ID_USUARIO;$idp[]=$p->ID_POST;
						
						$pi=$this->setearPost($p); $posteos[]=$pi;}

						$com=new Comentario($this->adapter);						
						$com=$com->getComentarios($idp); //obtiene todos los comentarios de $po

						if($com!=null){
						foreach ($com as $c) {$u=new Usuario($this->adapter);$u=$u->getUsuario($c->ID_USUARIO); 
							
							$po= new Post($this->adapter); $po=$po->getPost($c->ID_POST);$po=$this->setearPost($po);
							$co= new Comentario($this->adapter);
							$co->__set('id_comentario',$c->ID_COMENTARIO);
							$co->__set('post',$po);
							$co->__set('usuario',$u);
							$co->__set('descripcion',$c->DESCRIPCION);
							$co->__set('fecha',$c->FECHA);
							$co->__set('estado',$c->ESTADO);
							$c=$co;
							$comentarios[]=$c;}} else{ $comentarios=null;}
							} else {$posteos=null; $comentarios=null;}
									
								$report=new Report($this->adapter);
								$report = $report->getPReport(); 

								$sugeridos=$this->sugeridos();
								
							
				
				$this->view('miMuro',array("user"=>$us, "allPaises"=>$allPaises,"allPost"=>$posteos,"coments"=>$comentarios, "reportes"=>$report,"sugeridos"=>$sugeridos,"pendientes"=>$quieren,));
			} else {$this->redirect("Muro","mostrarMuro");}


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
				$buscar=false;
				
				$sugeridos=$this->sugeridos();

				$quieren= new Usuario($this->adapter);
				$quieren= $quieren->quierenAmistad($id);
					
				$this->view('amigos',array("user"=>$us, "allPaises"=>$allPaises,"amigos"=>$amigos,"sugeridos"=>$sugeridos,"buscar"=>$buscar,"pendientes"=>$quieren,));
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
				$po= $po->postajenos($id); //obtiene todos los posteos a mostrar
				
				$quieren= new Usuario($this->adapter);
				$quieren= $quieren->quierenAmistad($id); //foreach($quieren as $q){echo $q->NOMBRE;}
				//echo gettype($quieren);
			
				
				if($po !=null){
				
					foreach ($po as $p){ $pi= new Post($this->adapter);

						$a= new Usuario($this->adapter); $i=$p->ID_USUARIO;$idp[]=$p->ID_POST;
						$a= $a->getAmi($i);
						$pi=$this->setearPost($p); $posteos[]=$pi;}

						$com=new Comentario($this->adapter);						
						$com=$com->getComentarios($idp); //obtiene todos los comentarios de $po

						if($com!=null){
						foreach ($com as $c) {$u=new Usuario($this->adapter);$u=$u->getUsuario($c->ID_USUARIO); 
							
							$po= new Post($this->adapter); $po=$po->getPost($c->ID_POST);$po=$this->setearPost($po);
							$co= new Comentario($this->adapter);
							$co->__set('id_comentario',$c->ID_COMENTARIO);
							$co->__set('post',$po);
							$co->__set('usuario',$u);
							$co->__set('descripcion',$c->DESCRIPCION);
							$co->__set('fecha',$c->FECHA);
							$co->__set('estado',$c->ESTADO);
							$c=$co;
							$comentarios[]=$c;}} else{ $comentarios=null;}
							} else {$posteos=null; $comentarios=null;}
									
								$report=new Report($this->adapter);
								$report = $report->getPReport(); 
							
							$sugeridos=$this->sugeridos();
				
				$this->view('index',array("user"=>$us, "allPaises"=>$allPaises,"allPost"=>$posteos,"coments"=>$comentarios, "reportes"=>$report,"sugeridos"=>$sugeridos,"pendientes"=>$quieren,));
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

		public function subirImgPost($user){

			$cantidad= count($_FILES["img"]["name"]);
			$date = time();
			for ($i=0; $i<$cantidad; $i++){
				$fileName=$_FILES['img']['name'][$i];
				$tmpName=$_FILES['img']['tmp_name'][$i];
				$fileSize=$_FILES['img']['size'][$i];
				$fileType=$_FILES['img']['type'][$i];
					if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){
					$imagenes=$_SERVER['DOCUMENT_ROOT']."/AnimalZone/appmvc/public/img/post/";
					$extension=explode("/",$fileType);
					$fileName=$user.$date.$i.'.'.$extension[1];
					$filePath=$imagenes.$fileName;
					$serverName="http://localhost/AnimalZone/appmvc/public/img/post/".$fileName;
						if($result=move_uploaded_file($tmpName, $filePath)){
						$return[$i]=$serverName;}else{$return[$i]=null;}}

			}

			
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

					$post->__set("imagen1",null);
					$post->__set("imagen2",null);
					$post->__set("imagen3",null);
					$adj=null;

					if(isset($_FILES['img'])){$img= $this->subirImgPost($us->username);
						$cant=count($img);
						for ($i=0; $i<$cant; $i++){ $a=$i+1;$post->__set("imagen".$a,$img[$i]);}
					} else{echo $_FILES['img']['error'];}



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
		public function editarComent(){
			if(isset($_POST['editarComent']) && isset($_POST['idComenteditar'])) {
				$id=$_POST['idComenteditar'];
				$coment= new Comentario($this->adapter);
				$coment->__set('id_comentario',$id);
				$coment->__set('descripcion',$_POST['comentEdit']);
				$coment->editar();
				$this->redirect("Muro","mostrarMuro");
			}
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
				if(isset($_POST['idPostR'])){
				$post= new Post($this->adapter);
				$post= $post->getPost($_POST['idPostR']);
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

		public function reportarComent(){
				if(isset($_POST['reportarComent'])){
				$post= new Post($this->adapter);
				$post= $post->getPost($_POST['idPostRc']);
				$coment= new Comentario($this->adapter);
				$coment= $coment->getComent($_POST['idComentRc']);
				$user = new Usuario($this->adapter);
				$user= $_SESSION['ObjUsuario'];
				$report= new Report($this->adapter);
				$report->__set('post',$post);
				$report->__set('usuario',$user);	
				$report->__set('comentario',$coment); 
				$motivo="";
				$arr= $_POST['Cmotivo'];
				$num= count($arr);
				for($n=0;$n<$num; $n++){ $motivo= $motivo.$arr[$n].",";}

				$report->__set('motivo',$motivo);
					$report->reportComent();
					$this->redirect("Muro","mostrarMuro");echo '<div class=\"alert alert-danger\" role=\"alert\">El comentario a sido reportado.</div>';
				}else {echo '<div class=\"alert alert-danger\" role=\"alert\">Debes seleccionar el motivo del reporte Motivos:'.$motivo.'</div>';}
			
			
			}


		public function buscarPost(){
				if(isset($_POST['kw1']) && $_POST['kw1']!=trim("") || isset($_POST['kw2']) && $_POST['kw2']!=trim("")||isset($_POST['kw3'])&& $_POST['kw3']!=trim("")){
					$pais=new Pais($this->adapter);
					$allPaises=$pais->getPaises();

					$po=new Post($this->adapter);
					$us=new Usuario($this->adapter);
					$us=$_SESSION['ObjUsuario'];
					$id=$us->id_usuario;
					$quieren= new Usuario($this->adapter);
					$quieren= $quieren->quierenAmistad($id);

					if($_POST['kw1']!=trim("")){ $kw1=$_POST['kw1'];} else {$kw1="kwnula012012012";}
					if($_POST['kw2']!=trim("")){ $kw2=$_POST['kw2'];} else {$kw2="kwnula012012012";}
					if($_POST['kw3']!=trim("")){ $kw3=$_POST['kw3'];} else {$kw3="kwnula012012012";}
					

					$po=$po->getPostByKw($kw1,$kw2,$kw3,$id);

					if($po !=null){
				
						foreach ($po as $p){ $pi= new Post($this->adapter);
	
							$a= new Usuario($this->adapter); $i=$p->ID_USUARIO;$idp[]=$p->ID_POST;
							$a= $a->getAmi($i);
							$pi=$this->setearPost($p); $posteos[]=$pi;}
	
							$com=new Comentario($this->adapter);						
							$com=$com->getComentarios($idp); //obtiene todos los comentarios de $po
	
							if($com!=null){
							foreach ($com as $c) {$u=new Usuario($this->adapter);$u=$u->getUsuario($c->ID_USUARIO); 
								
								$po= new Post($this->adapter); $po=$po->getPost($c->ID_POST);$po=$this->setearPost($po);
								$co= new Comentario($this->adapter);
								$co->__set('id_comentario',$c->ID_COMENTARIO);
								$co->__set('post',$po);
								$co->__set('usuario',$u);
								$co->__set('descripcion',$c->DESCRIPCION);
								$co->__set('fecha',$c->FECHA);
								$co->__set('estado',$c->ESTADO);
								$c=$co;
								$comentarios[]=$c;}} else{ $comentarios=null;}
								} else {$posteos=null; $comentarios=null;}
										
									$report=new Report($this->adapter);
									$report = $report->getPReport(); 
							$kws[0]=$kw1;$kws[1]=$kw2;$kws[2]=$kw3;
							$sugeridos=$this->sugeridos();

					$this->view('index',array("user"=>$us, "allPaises"=>$allPaises,"allPost"=>$posteos,"coments"=>$comentarios, "reportes"=>$report,"pendientes"=>$quieren,"sugeridos"=>$sugeridos,));
					
				} else {$this->redirect("Muro","mostrarMuro");}
			}

		public function buscarMisPost(){
			if(isset($_POST['kw1']) && $_POST['kw1']!=trim("") || isset($_POST['kw2']) && $_POST['kw2']!=trim("")||isset($_POST['kw3'])&& $_POST['kw3']!=trim("")){
				$pais=new Pais($this->adapter);
				$allPaises=$pais->getPaises();

				$po=new Post($this->adapter);
				$us=new Usuario($this->adapter);
				$us=$_SESSION['ObjUsuario'];
				$id=$us->id_usuario;

				if($_POST['kw1']!=trim("")){ $kw1=$_POST['kw1'];} else {$kw1="kwnula012012012";}
				if($_POST['kw2']!=trim("")){ $kw2=$_POST['kw2'];} else {$kw2="kwnula012012012";}
				if($_POST['kw3']!=trim("")){ $kw3=$_POST['kw3'];} else {$kw3="kwnula012012012";}
				

				$po=$po->getMisPostByKw($kw1,$kw2,$kw3,$id);

				if($po !=null){
			
					foreach ($po as $p){ $pi= new Post($this->adapter);

						$a= new Usuario($this->adapter); $i=$p->ID_USUARIO;$idp[]=$p->ID_POST;
						$a= $a->getAmi($i);
						$pi=$this->setearPost($p); $posteos[]=$pi;}

						$com=new Comentario($this->adapter);						
						$com=$com->getComentarios($idp); //obtiene todos los comentarios de $po

						if($com!=null){
						foreach ($com as $c) {$u=new Usuario($this->adapter);$u=$u->getUsuario($c->ID_USUARIO); 
							
							$po= new Post($this->adapter); $po=$po->getPost($c->ID_POST);$po=$this->setearPost($po);
							$co= new Comentario($this->adapter);
							$co->__set('id_comentario',$c->ID_COMENTARIO);
							$co->__set('post',$po);
							$co->__set('usuario',$u);
							$co->__set('descripcion',$c->DESCRIPCION);
							$co->__set('fecha',$c->FECHA);
							$co->__set('estado',$c->ESTADO);
							$c=$co;
							$comentarios[]=$c;}} else{ $comentarios=null;}
							} else {$posteos=null; $comentarios=null;}
									
								$report=new Report($this->adapter);
								$report = $report->getPReport(); 
						$kws[0]=$kw1;$kws[1]=$kw2;$kws[2]=$kw3;
						$sugeridos=$this->sugeridos();

				$this->view('mimuro',array("user"=>$us, "allPaises"=>$allPaises,"allPost"=>$posteos,"coments"=>$comentarios, "reportes"=>$report,"sugeridos"=>$sugeridos,));
				
			} else {$this->redirect("Muro","miMuro");}
			}

		public function visitarAmigo(){
			if(isset($_POST['visitar'])){
				$idami=$_POST['id_amigo'];
				$ami=new Usuario($this->adapter);
				$ami=$ami->getUsuario($idami);
				$us=new Usuario($this->adapter);
				$us=$_SESSION['ObjUsuario'];

				$post=new Post($this->adapter);
				$post=$post->getMisPost($idami);

				

				if($post!=null){
					foreach($post as $p){$ids[]=$p->ID_POST;}
					$comentarios=new Comentario($this->adapter);
					$comentarios=$comentarios->getComentarios($ids);
					if($comentarios!=null){
						foreach($comentarios as $c){$u=new Usuario($this->adapter);$u=$u->getUsuario($c->ID_USUARIO); 
							
								$po= new Post($this->adapter); $po=$po->getPost($c->ID_POST);
								$co= new Comentario($this->adapter);
								$co->__set('id_comentario',$c->ID_COMENTARIO);
								$co->__set('post',$po);
								$co->__set('usuario',$u);
								$co->__set('descripcion',$c->DESCRIPCION);
								$co->__set('fecha',$c->FECHA);
								$co->__set('estado',$c->ESTADO);
								$c=$co;
								$com[]=$c;
								}} else{$com=null;}
						

					} else {$post=null;$com=null;}
					$sugeridos=$this->sugeridos();

					$this->view('verPerfil',array("user"=>$us,"amigo"=>$ami,"post"=>$post,"comentarios"=>$com,"sugeridos"=>$sugeridos,));
				} else {$this->redirect("Muro","mostrarMuro");
					echo "<div class=\"alert alert-danger\" role=\"alert\">UPS! Ocurrió un error con el muro de tu amigue</div>";}

		}

		public function buscarUsuario(){
		
			$amigos=null; $a=null;
			$yo=new Usuario($this->adapter);
			$yo=$_SESSION['ObjUsuario'];

			if( $_POST['username']!=trim("")){
			$username=$_POST['username'];
				
			$ami= new Usuario($this->adapter);
			$amigos= $ami->buscarUsuariosxNombre($username,$yo->id_usuario);
			$buscar=true;

			$this->view('amigos',array("user"=>$yo,"amigos"=>$amigos,"buscar"=>$buscar,));}
		}

		public function sugeridos(){
			$usuarioYo=new Usuario($this->adapter);
			$suj=new Usuario($this->adapter);
			$usuarioYo=$_SESSION['ObjUsuario'];
			$intereses= $usuarioYo->intereses;
			//$intereses= explode(',',$inter); 
			
			$sugeridos= $suj->getNoAmigosXinteres($intereses, $usuarioYo->id_usuario);
			//echo gettype($sugeridos);
			
			//if($sugeridos==null){$sugeridos=$suj->getNoAmigosxPais($usuarioYo->id_usuario,$usuarioYo->pais);}
			if($sugeridos==null){$sugeridos=$suj->getNoAmigos($usuarioYo->id_usuario);}

			return $sugeridos;

		}


		public function buscarAmigo(){
		
			$amigos=null; $a=null;
			$yo=new Usuario($this->adapter);
			$yo=$_SESSION['ObjUsuario'];

			if( $_POST['buscarAmigo']!=trim("")){
			$username=$_POST['buscarAmigo'];
				
			$ami= new Usuario($this->adapter);
			$amigos= $ami->buscarMiAmigo($username, $yo->id_usuario);
			$buscar=true;

			$sugeridos=$this->sugeridos();
			$this->view('amigos',array("user"=>$yo,"amigos"=>$amigos,"buscar"=>$buscar,"sugeridos"=>$sugeridos,));}
		}

		public function mostrarSugeridos(){
			$usuarioYo=new Usuario($this->adapter);
			$usuarioYo=$_SESSION['ObjUsuario'];
			$suj=new Usuario($this->adapter);
			$allsugeridos=$suj->getNoAmigos($usuarioYo->id_usuario);
			$buscar=false;
			$sugeridos=$this->sugeridos();
			
			$quieren= new Usuario($this->adapter);
				$quieren= $quieren->quierenAmistad($usuarioYo->id_usuario);
			$this->view('amigos',array("user"=>$usuarioYo,"amigos"=>$allsugeridos,"buscar"=>$buscar,"sugeridos"=>$sugeridos,"pendientes"=>$quieren,));}
		
		

		public function stalkUsuario(){
			if(isset($_POST['stalkear'])){
				$idami=$_POST['id_stalk'];
				$ami=new Usuario($this->adapter);
				$ami=$ami->getUsuario($idami);
				$us=new Usuario($this->adapter);
				$us=$_SESSION['ObjUsuario'];

				$post=new Post($this->adapter);
				$post=$post->getPostStalk($idami);
				$quieren= new Usuario($this->adapter);
				$quieren= $quieren->quierenAmistad($us->id_usuario);

				if($post!=null){
					foreach($post as $p){$ids[]=$p->ID_POST;}
					$comentarios=new Comentario($this->adapter);
					$comentarios=$comentarios->getComentarios($ids);
					if($comentarios!=null){
						foreach($comentarios as $c){$u=new Usuario($this->adapter);$u=$u->getUsuario($c->ID_USUARIO); 
							
								$po= new Post($this->adapter); $po=$po->getPost($c->ID_POST);
								$co= new Comentario($this->adapter);
								$co->__set('id_comentario',$c->ID_COMENTARIO);
								$co->__set('post',$po);
								$co->__set('usuario',$u);
								$co->__set('descripcion',$c->DESCRIPCION);
								$co->__set('fecha',$c->FECHA);
								$co->__set('estado',$c->ESTADO);
								$c=$co;
								$com[]=$c;
								}} else{$com=null;}
					

				} else {$post=null;$com=null;}

				$sugeridos=$this->sugeridos();

				$this->view('verPerfil',array("user"=>$us,"amigo"=>$ami,"post"=>$post,"comentarios"=>$com,"sugeridos"=>$sugeridos,"pendientes"=>$quieren,));
			} else {
				
				if(isset($_POST['agregarAmigo'])){
					$u=$_SESSION['ObjUsuario'];
					$stalk= $_POST['id_stalk'];
					$relacion=new Amigo($this->adapter); echo $u->id_usuario.' '.$stalk;
					$relacion->SolicitarAmistad($u->id_usuario, $stalk);
					$this->redirect("Muro","mostrarMuro");

					echo "<div class=\"alert alert-danger\" role=\"alert\">SOLICITUD ENVIADA</div>";
			} else{$this->redirect("Muro","mostrarMuro");

				echo "<div class=\"alert alert-danger\" role=\"alert\">UPS! Ocurrió un error con el muro de tu amigue</div>";}}
				


		}


		public function verNotificaciones(){
			
			$us=$_SESSION['ObjUsuario'];
			$quieren= new Usuario($this->adapter);
			$quieren= $quieren->quierenAmistad($us->id_usuario); //foreach($quieren as $q){echo $q->NOMBRE;}
			//echo gettype($quieren);
			$sugeridos=$this->sugeridos();
			$this->view('noti',array("user"=>$us,"amigos"=>$quieren,"sugeridos"=>$sugeridos,));
		}

		public function gestionarSolicitud(){
			$u=new Usuario($this->adapter);
			$u=$_SESSION['ObjUsuario'];
			$a=new Amigo($this->adapter);
			$sugeridos=$this->sugeridos();
			if(isset($_POST['aceptar'])){
				$a->aceptar($u->id_usuario, $_POST['id_amigo']);}

			if(isset($_POST['rechazar'])){
				$a->eliminarAmigo($u->id_usuario, $_POST['id_amigo']);
			}
			$quieren= new Usuario($this->adapter);
			$quieren= $quieren->quierenAmistad($u->id_usuario);
			$this->view('noti',array("user"=>$u,"amigos"=>$quieren,"sugeridos"=>$sugeridos,));
		}

	}




?>
