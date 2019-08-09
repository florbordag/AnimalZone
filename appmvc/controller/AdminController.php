<?php
SESSION_START();
class AdminController extends ControladorBase{
    public $conectar;
	public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }

		//Listar todos los Usuarios	
        public function agregar(){
			$this->view('adminRegis','');
		}



    public function crear(){

			if(isset($_POST["crear"])){
            
				//Creamos un usuario
				$admin=new Admin($this->adapter);

                $password = $_POST['pass'];
                $mail = $_POST['mail'];

                $salt = bin2hex(random_bytes(32)); 
                $saltedPass = $password.$salt;    
                $hashedPass = hash('sha256', $saltedPass);
                                
                            $admin->__set('mail',$mail);
                            $admin->__set('pass',$hashedPass);
                            $admin->__set('salt',$salt);

                            $admin->agregarAdmin();

                            //$usuario= $this->setearUsuario($usuario);
                        echo	'ADMIN CREADO!';}	
				
    }


    public function index(){
        $allUsers=new Usuario($this->adapter);
        $allUsers=$allUsers->getAll();

        $this->view('indexAdmin',array("allUsers"=>$allUsers,));
    }
    public function indexmod(){
        $allUsers=new Moderador($this->adapter);
        $allUsers=$allUsers->getAll();

        $this->view('modAdmin',array("allUsers"=>$allUsers,));
    }

public function administrar(){
    $admin=$_SESSION['ObjAdmin'];
    if(isset($_POST['ids'])){
        $users= $_POST['ids'];
        $usuarios= implode(',',$users);
        if(isset($_POST['activar'])){
            $u=new Usuario($this->adapter);
            $u->activarUsuarios($usuarios);
            
            $this->index(); }

         if(isset($_POST['desactivar'])){
            $u=new Usuario($this->adapter);
            $u->desactivarUsuarios($usuarios);
            $this->index();}
        
        if(isset($_POST['mod'])){ 
            foreach ($users as $u){
                $umo= new Usuario($this->adapter);
                $umo= $umo->getUsuario($u);

                $mod= new Moderador($this->adapter);
                $mod->__set('id_usuario_mod',$u);
                $mod->__set('username',$umo->USERNAME.'mod');
                $mod->__set('pass',$umo->PASSWORD);
                $mod->__set('salt',$umo->SALT);
                $mod->__set('estado',1);
                $mod->__set('usuario_alta',$admin->USERNAME);
                $mod->__set('usuario_ult_mod',$admin->USERNAME);
                $mod->__set('mail',$umo->MAIL);

                $mod->agregarMod($mod); } 
                echo "<div class=\"alert alert-success\" role=\"alert\">ÉXITO! Moderador Creado. Se notificara por mail al responsable.</div>";
                $this->redirect("Admin","index");
            }

                } else {echo "<div class=\"alert alert-danger\" role=\"alert\">UPS! Ocurrio un problema.</div>";
                    $this->index();}
                }





                    public function administrarMods(){
                        $admin=$_SESSION['ObjAdmin'];
                        if(isset($_POST['ids'])){
                            $u=new Moderador($this->adapter);
                            $users= $_POST['ids'];
                            $usuarios= implode(',',$users);

                            if(isset($_POST['activar'])){
                                $u->activarUsuarios($usuarios);
                                
                                $this->indexmod(); }
                    
                             if(isset($_POST['desactivar'])){
                                
                                $u->desactivarUsuarios($usuarios);
                                $this->indexmod();}
                            
                            if(isset($_POST['eliminarmod'])){ 
                                
                                    $this->indexmod();
                                }
                    
                                    } else {echo "<div class=\"alert alert-danger\" role=\"alert\">UPS! Ocurrio un problema.</div>";
                                        $this->index();}

                }







    }

?>
