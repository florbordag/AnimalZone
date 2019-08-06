<!doctype html>
<html lang="en">
  <head>
    <title>Crear Mascota - <?php echo '@'.$usuario->username?></title>
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


<div class="col">
<div class="mx-auto" style="width:800px;">
<div class="card">

<form action="<?PHP echo $helper->url("Usuario","crearMascota"); ?>" method="post" enctype="multipart/form-data">

  <input type="hidden" value="<?php echo $usuario->id_usuario ?>" name="id_usuario">

  <div class="form-group">
    <label for="fotoperfil">Elegir foto de perfil</label>
    <input type="file" class="form-control-file" name="fotoperfil" id="fotoperfil" accept="image/png, image/jpeg, image/gif, image/png">
  </div>
  <div class="card-body">

  <div class="form-group">
    <label for="nombre">Nombre</label><small class="text-muted">(*).</small>
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre.." required>
  </div>

  <div class="form-group">
    <label for="apellido">Especie</label><small class="text-muted">(*).</small>
    <input type="text" class="form-control" id="especie" name="especie" placeholder="Ej: Perro" required>
  </div>

  <div class="form-group">
    <label for="cp">Raza</label>
    <input type="text" class="form-control" id="raza" name="raza" placeholder="Ej: Labrador, Cruza...">
  </div>

  <label style="margin-left:20px;">Sexo:</label><small class="text-muted">(*).</small>
  <div class="form-check" style="margin-left:15px;">
  <input class="form-check-input" type="radio" name="sexo" id="hembra" value="Hembra" required>
  <label class="form-check-label" for="hembra">
    Hembra
  </label>
</div><br>
<div class="form-check" style="margin-left:15px;">
  <input class="form-check-input" type="radio" name="sexo" id="macho" value="Macho">
  <label class="form-check-label" for="macho">
    Macho
  </label>
</div><hr>

  <div class="form-group">
    <label for="party">Fecha de Nacimiento:</label><br>
    <input type="date" id="nacimiento" name="nacimiento" min="2000-01-01" style="width:200px;height:35px;border:hidden;">
  </div>

<br>

  <div class="form-group">Descripcion:
      <textarea class="form-control" name="descripcion" id="descripcion" rows="5">Cuéntanos algo sobre tu mascota... </textarea>
    </div>
  <div class="form-group">  
  <label for="nuevopass">Confirmar identidad</label><small class="text-muted">(*).</small>
    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password actual" required>
  </div>
  <small class="text-muted">(*) Datos Obligatorios.</small><br><br>
 </div>
 <center><button type="submit" class="btn btn-primary" style="width:100px;">Guardar Mascota</button><center>
</form>



</div>
</div>
</div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>