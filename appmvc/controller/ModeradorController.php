<?php
SESSION_START();
class ModeradorController extends ControladorBase{
    public $conectar;
	public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }

public function login(){
    $this->View("loginmod","");
}

public function entrar(){
    if(isset($_POST['usuario']) && isset($_POST['pass']) ) {
        $mod= new Moderador($this->adapter);
        $usuario= $_POST['usuario'];
        $password = $_POST['pass'];

        if($mod->obtenerpass($password,$usuario)){
            $mod=$mod->getMod($usuario);
            $_SESSION['ObjMod']=$mod;

            $report=new Report($this->adapter);
            $reportes=$report->getAllPostReported();
            $this->View("indexMod",array("reportes"=>$reportes,));}
            } else{ 
                if(isset($_SESSION['ObjMod'])){ 
                    $report=new Report($this->adapter);
                    $reportes=$report->getAllPostReported();
                    $this->View("indexMod",array("reportes"=>$reportes,));
                } else {$this->login();}}          
                
        }

        public function Comentsmod(){
                $report=new Report($this->adapter);
                $reportes=$report->getAllComentReported();
                if($reportes!=null){

                $this->View("comentsMod",array("reportes"=>$reportes,));} else {$this->entrar();}
        }

        public function moderar(){
            $rep=new Report($this->adapter);
            $admin=$_SESSION['ObjMod'];
            if(isset($_POST['ids'])){

                $post= $_POST['ids'];
                $posteos= implode(',',$post);

                if(isset($_POST['activar'])){
                    $u=new Post($this->adapter);
                    $u->activarPost($posteos);
                    $rep->moderarPost($posteos);
                    $this->entrar(); }
        
                 if(isset($_POST['desactivar'])){
                    $u=new Post($this->adapter);
                    $u->desactivarPost($posteos);
                    $rep->moderarPost($posteos);
                    $this->entrar();}
                } else {$this->entrar();}
            }

            public function moderarComent(){
                $rep=new Report($this->adapter);
                $admin=$_SESSION['ObjMod'];
                if(isset($_POST['ids'])){
    
                    $com= $_POST['ids'];
                    $coments= implode(',',$com);
    
                    if(isset($_POST['activar'])){
                        $u=new Comentario($this->adapter);
                        $u->activarComent($coments);
                        $rep->moderarComent($coments);
                        
                        $this->Comentsmod(); }
            
                     if(isset($_POST['desactivar'])){
                        $u=new Comentario($this->adapter);
                        $u->desactivarComent($coments);
                        $rep->moderarComent($coments);
                        $this->Comentsmod();}
                    } else {$this->Comentsmod();}
                }




    }

?>
