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
  <body style="background-color:white; color:black;">
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
                              <a class="dropdown-item" href="agregarmascota.html">Agregar mascota</a>
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
                  <form class="form-inline my-2 my-lg-0">
                      <input class="form-control mr-sm-2" type="text" placeholder="Deshabilitado :(">
                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                  </form>
          </nav>
          <br>
    </header>


</div></div>
      

<div class="container-fluid">
<div class="row">
  <div class="d-none d-md-none d-xl-block">
<div class="col">
<div class="card" style="width: 18rem;">
  <img src="<?PHP echo $user->imagen_perfil; ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $user->nombre." ".$user->apellido; ?></h5>
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



<div class="col">
  
<div class="card text-center">

  <div class="card-body" style="height: 15rem;">
      <div class="form-group">
          <label for="exampleFormControlTextarea1"> ¿Que hay de nuevo?</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">Escribe aqui...</textarea>
        </div>
      </form>
    <a href="#" class="btn btn-success">Adjuntar</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <a href="#" class="btn btn-success">Postear</a>
  </div><hr>


  <div class="overflow-auto" style="max-height: 28rem">
<?php 
foreach($allPost as $post => $value){
  echo '    <div class="card mb-3">
  <div class="row no-gutters">
    <div class="col-lg-4">
      <img src="'.$user->imagen_perfil.'" class="rounded-circle" alt="mi nombre" style="width:100px;height:100px; padding: 10px;">
      <p class="card-text"><small class="text-muted">Hace 3 horas.</small></p>
    </div>
    <div class="col">
      <div class="card-body">
        <h5 class="card-title">@'.$user->username.' <small class="text-muted">'.$value->titulo.'</small></h5>
        <p class="card-text">Este es un posteo que hizo otro usuario y que sale en mi muro...</p>
       <a href="#">Ver mas...</a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="#">Comentar.</a>
      </div>
    </div>
  </div>
</div>';}
?>



        </div>
        
    </div>
</div>


<div class="d-none d-sm-none d-md-block">
<div class="col">


    <div class="card"  style="width: 18rem;text-align:justify;" >
        <div class="card-body">
        <h5 class="card-title">Amigos sugeridos</h5>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
              <div style="text-align:center;">La Colorada</div>
          <div><span><img src="https://licoret.com/modules/ttvcmstestimonial/views/img/cliente%20licoret%20tienda%20de%20licores%203.jpg" class="rounded-circle" style="width:50px; height:50px;">&nbsp&nbsp&nbsp</span><span><a href="perfilamigo.php"  style="text-decoration: none;">Ver perfil</a></span>&nbsp&nbsp&nbsp<span><a class="agregarAmigo" href="#"  style="text-decoration: none;"> Agregar</a></span></div></li>
          <li class="list-group-item"><div style="text-align:center;">Rambo</div>
          <div><span><img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/acorralado-john-rambo-sylvester-stallone-7-1527009539.jpg?crop=0.66721044045677xw:1xh;center,top&resize=100:*" class="rounded-circle" style="width:50px; height:50px;">&nbsp&nbsp&nbsp</span><span><a href="perfilamigo.php"  style="text-decoration: none;">Ver perfil</a></span>&nbsp&nbsp&nbsp<span><a class="agregarAmigo"href="#"  style="text-decoration: none;"> Agregar</a></span></div></li></li>
          <li class="list-group-item"><div style="text-align:center;">Yisus Craist</div>
          <div><span><img src="https://www.armadomania.com/estatico/imagenes_productos/SANTO_SAGRADO_CORAZON_DE_JESUS.100x100.jpg" class="rounded-circle" style="width:50px; height:50px;">&nbsp&nbsp&nbsp</span><span><a href="perfilamigo.php"  style="text-decoration: none;">Ver perfil</a></span>&nbsp&nbsp&nbsp<span><a class="agregarAmigo"href="#"  style="text-decoration: none;"> Agregar</a></span></div></li></li>
          <li class="list-group-item"><div style="text-align:center;">Casper White</div>
          <div><span><img src="http://horizonsmagazine.com/blog/wp-content/uploads/2013/09/casper.jpg" class="rounded-circle" style="width:50px; height:50px;">&nbsp&nbsp&nbsp</span><span><a href="perfilamigo.php"  style="text-decoration: none;">Ver perfil</a></span>&nbsp&nbsp&nbsp<span><a class="agregarAmigo"href="#"  style="text-decoration: none;"> Agregar</a></span></div></li></li>
          <li class="list-group-item"><div style="text-align:center;">Barney</div>
          <div><span><img src="https://i0.wp.com/erizos.mx/wp-content/uploads/2018/01/barney-sexo-tantrico.jpg?resize=100%2C100&ssl=1" class="rounded-circle" style="width:50px; height:50px;">&nbsp&nbsp&nbsp</span><span><a href="perfilamigo.php"  style="text-decoration: none;">Ver perfil</a></span>&nbsp&nbsp&nbsp<span><a class="agregarAmigo"href="#"  style="text-decoration: none;"> Agregar</a></span></div></li></li>
        </ul>
      </div></div></div>
</div> 
</div></div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>