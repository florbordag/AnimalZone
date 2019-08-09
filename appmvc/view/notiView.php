<!doctype html>
<html lang="en">
  <head>
    <title>Animal Zone - <?php echo '@'.$user->username;?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <header>
          
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
              <a class="navbar-brand" href="<?PHP echo $helper->url("Muro","mostrarMuro"); ?>">AnimalZone</a>
              <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                  aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="collapsibleNavId">
                  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                      <li class="nav-item active">
                          <a class="nav-link" href="<?PHP echo $helper->url("Muro","miMuro"); ?>">Mi muro<span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?PHP echo $helper->url("Muro","mostrarAmigos"); ?>">Amigos</a>
                      </li>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mascotas</a>
                          <div class="dropdown-menu" aria-labelledby="dropdownId">
                              <a class="dropdown-item" href="mascotas.html">Visitar mascota</a>
                              <a class="dropdown-item" href="<?PHP echo $helper->url("Usuario","agregarMascota"); ?>">Agregar mascota</a>
                          </div>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?PHP echo $helper->url("Muro","modificarPerfil"); ?>"><span class="perfil">Perfil</span></a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?PHP echo $helper->url("Muro","cerrarSesion"); ?>"><span class="perfil">Cerrar Sesion</span></a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="sugeridos.php"><span class="amiguis">Amigos Sugeridos</span></a>
                      </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0" action="<?PHP echo $helper->url("Muro","buscarUsuario");?>" method="post">
                      <input class="form-control mr-sm-2" type="text" name="username" placeholder="Ej: florbordag">
                      <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Buscar Usuario">
                  </form>
          </nav>
          <br>
    </header>

<div class="container-fluid">
  <div class="row">
    <div class="d-none d-md-none d-xl-block">
<div class="col">
<div class="card" style="width: 18rem;">
  <img src="<?PHP echo $user->imagen_perfil; ?>" class="card-img-top" alt="..." style="width:300px;height:300px;">
  <div class="card-body">
    <h5 class="card-title"><?Php echo $user->nombre." ".$user->apellido; ?></h5>
    <h6 class="card-title"><?Php echo "@".$user->username; ?></h6>
    <small class="text-muted"><?PHP echo $user->mail; ?></small><br>
    <br>
    <p class="card-text">Una breve descripcion sobre mi persona o intereses.</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><a href="#"><img src="https://buenavida.pr/wp-content/uploads/2017/05/Mascota-1170x780.jpg" style="width: 100px;"><br>Chocolate</a></li>
    <li class="list-group-item"><a href="#">Mascota 2</a></li>
    <li class="list-group-item"><a href="#">Mascota 3</a></li>
  </ul>
  <div class="card-body">
    <a href="<?PHP echo $helper->url("Muro","modificarPerfil"); ?>" class="card-link">Modificar Perfil</a>
    <a href="<?PHP echo $helper->url("Muro","cerrarSesion"); ?>" class="card-link">Cerrar Sesión</a>
  </div>
</div></div>
  </div>


<div class="col" style="padding: 0px; margin:0px;">  
      <div class="row">
        <div class="col">
        <form action="<?PHP echo $helper->url("Muro","buscarAmigo"); ?>" method="post">
          <input type="text" class="form-control" name="buscarAmigo" id="buscarAmigo" aria-describedby="helpId" placeholder="Buscar amigo por nombre de usuario o mail.."  style="margin-left:20px;">
      </div>
    <button type="submit" class="btn btn-success"  style="margin-right:20px;margin-left:20px;">Buscar amigo</button></div>
    </form>
    <div class="d-flex align-content-stretch flex-wrap" style="margin-top: 40px; padding: 5px;">
      <div class="overflow-auto" style="max-height: 38rem; margin:0px;">
        <div class="card text-center" style=" min-width:400px;">

          <div class="card-deck" style="margin-left:60px;">
                        <?PHP 
                        if($amigos!=null){

                        foreach ($amigos as $ami) {echo 
                      '  <div class="card-center" style="width:280px; height:300px;padding-top:15px;">
                        <img src="'.$ami->IMAGEN_PERFIL.'" class="rounded-circle" alt="nombre amigo" style="width: 100px; height:100px;">
                            <div class="card-body">
                                <h6 class="card-title">'.$ami->NOMBRE." ".$ami->APELLIDO.'</h6>
                                <small class="text-muted">@'.$ami->USERNAME.'</small>
                                <br><br>
                                <form action="';echo $helper->url("Muro","gestionarSolicitud");echo'" method="post">
                                <input type="hidden" name="id_amigo" value="'.$ami->ID_USUARIO.'">
                                <p class="card-text"><input type="submit" name="aceptar" value="Aceptar" class="btn btn-outline-primary" style="height:35px;">
                                  &nbsp&nbsp&nbsp&nbsp&nbsp 
                                  <input type="submit" name="rechazar" value="Rechazar" class="btn btn-outline-primary" style="height:35px;"></p>
                                  </form>
                                
                                
                            </div></div>' 
                        ;}} else{echo 'No hay solicitudes pendientes';}?>
          </div>




        </div>
      </div>
    </div>
</div>


  <div class="d-none d-sm-none d-md-block">
  <div class="card text-center"  style="max-width: 20rem;text-align:justify;" >
                    <div class="card-body">
                        <h5 class="card-title">Amigos sugeridos</h5>
                        <ul class="list-group list-group-flush">


                            <?php 
                            if($sugeridos!=null){
                                foreach ($sugeridos as $s){
                                    echo'
                                    <li class="list-group-item">
                                    <div style="text-align:center;padding-bottom:5px;">'.$s->NOMBRE.' '.$s->APELLIDO.'</div>
                                    <div><span><img src="'.$s->IMAGEN_PERFIL.'" class="rounded-circle" style="width:50px; height:50px;">
                                    &nbsp&nbsp&nbsp</span>
                                    <span><form action="';echo $helper->url("Muro","stalkUsuario");echo'" method="post" style="padding-top:5px;">
                                    <input class="btn btn-outline-success btn-sm" type="submit" name="stalkear" value="Ver Muro"><input type="hidden" name="id_stalk" value="'.$s->ID_USUARIO.'">
                                    </span>&nbsp&nbsp&nbsp<span><input class="btn btn-outline-success btn-sm" type="submit" name="agregarAmigo" value="Agregar"></span>
                                    </form></div>
                                </li>';}}

                            ?>


                        </ul>
                    </div>
                </div>
 </div> 

</div></div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>