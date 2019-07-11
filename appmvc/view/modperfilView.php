<!doctype html>
<html lang="en">
  <head>
    <title>Modificar Perfil - <?php echo '@'.$usuario->username?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
          <header>
          
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="index.html">AnimalZone</a>
          <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
              aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavId">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item active">
                      <a class="nav-link" href="muro.html">Mi muro<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="amigos.html">Amigos</a>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mascotas</a>
                      <div class="dropdown-menu" aria-labelledby="dropdownId">
                          <a class="dropdown-item" href="mascotas.html">Visitar mascota</a>
                          <a class="dropdown-item" href="agregarmascota.html">Agregar mascota</a>
                      </div>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="miperfil.html"><span class="perfil">Perfil</span></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="cerrarSesion.php"><span class="perfil">Cerrar Sesion</span></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="sugeridos.php"><span class="amiguis">Amigos Sugeridos</span></a>
                  </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="text" name="buscar" placeholder="Deshabilitado :(">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
              </form>
      </nav>
      <br>
</header>


<div class="col">
<div class="mx-auto" style="width:800px;">
<div class="card">

<form action="<?PHP echo $helper->url("Muro","actualizarPerfil"); ?>" method="post" enctype="multipart/form-data">
  <img src="<?php echo $usuario->imagen_perfil; ?>" class="card-img-top" alt="imagen_perfil" style="width:500px;margin-left:150px;"><br>
  <br>
  <input type="hidden" value="<?php echo $usuario->imagen_perfil ?>" name="actual">
  <div class="form-group">
    <label for="fotoperfil">Elegir foto de perfil</label>
    <input type="file" class="form-control-file" name="fotoperfil" id="fotoperfil" accept="image/png, image/jpeg, image/gif, image/png">
  </div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $usuario->nombre." ".$usuario->apellido; ?></h5>
    <div class="form-group">
      <textarea class="form-control" name="descript" id="descript" rows="5"> Escribe algo sobre ti... </textarea>
    </div>
    <p class="card-text">Edita tu informacion básica.</p>

    <div class="form-group">
        <label class="sr-only" for="id">id_usuario</label>
        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $usuario->id_usuario; ?>">
        <input type="hidden" class="form-control" name="estado" id="estado" value="<?php echo $usuario->estado; ?>">
        <input type="hidden" class="form-control" name="usuario_alta" id="usuario_alta" value="<?php echo $usuario->usuario_alta; ?>">
        <input type="hidden" class="form-control" name="fecha_alta" id="fecha_alta" value="<?php echo $usuario->fecha_alta; ?>">
        <input type="hidden" class="form-control" name="us_ult_mod" id="us_ult_mod" value="<?php echo $usuario->usuario_ult_mod; ?>">
        <input type="hidden" class="form-control" name="fecha_ult_mod" id="fecha_ult_mod" value="<?php echo $usuario->fecha_ult_mod; ?>">
        <input type="hidden" class="form-control" name="mail" id="mail" value="<?php echo $usuario->mail; ?>">
        <input type="hidden" class="form-control" name="username" id="id" value="<?php echo $usuario->username; ?>">
        <input type="hidden" class="form-control" name="salt" id="salt" value="<?php echo $usuario->salt; ?>">
    </div>
    
    <div class="form-group">
    <label for="nombre">Nombre</label><small class="text-muted">(*).</small>
    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario->nombre; ?>">
  </div>

  <div class="form-group">
    <label for="apellido">Apellido</label><small class="text-muted">(*).</small>
    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $usuario->apellido; ?>">
  </div>

  <div class="form-group">
    <label for="party">Fecha de Nacimiento:</label><br>
    <input type="date" id="nacimiento" name="nacimiento" min="1917-01-01" max="2017-01-01" style="width:200px;height:35px;border:hidden;" value="<?PHP echo $usuario->nacimiento;?>">
  </div>
    <br>
  <label style="margin-left:20px;">Sexo:</label><small class="text-muted">(*).</small>
  <div class="form-check" style="margin-left:15px;">
  <input class="form-check-input" type="radio" name="sexo" id="fem" value="Femenino" required <?PHP if($usuario->sexo=="Femenino"){echo "checked";}?>>
  <label class="form-check-label" for="fem">
    Femenino
  </label>
</div><br>
<div class="form-check" style="margin-left:15px;">
  <input class="form-check-input" type="radio" name="sexo" id="masc" value="Masculino" <?PHP if($usuario->sexo=="Masculino"){echo "checked";}?>>
  <label class="form-check-label" for="exampleRadios2">
    Masculino
  </label>
</div>
<br>
<div class="form-group">
<label for="pais">Pais</label><small class="text-muted">(*).</small>
<select class="custom-select" id="pais" name="pais" required>
<?php foreach ($allPaises as $pais => $value) {
                if($value->codigo==$usuario->pais){echo "<option selected value=\"$value->codigo\"> ".$value->pais." </option> ";}
                else{echo "<option value=\"$value->codigo\"> ".$value->pais." </option> ";}}?>
</select>
 </div> 
 <div class="form-group">
    <label for="cp">Codigo Postal</label> <small class="text-muted">(Ésta informacion no se mostrará en tu perfil público).</small>
    <input type="text" class="form-control" id="cp" name="cp" value="<?PHP echo $usuario->cp;?>">
  </div>
  <div class="form-group">
    <label for="animal_fav">¡Ya casi terminas! ¿Cual es tu animal favorito?</label>
    <input type="text" class="form-control" id="animal_fav" name="animal_fav" value="<?php echo $usuario->animal_fav; ?>">
  </div>

  <div class="form-group">
    <label for="pass">Deseas cambiar el Password?</label>
    <input type="password" class="form-control" id="nuevopass" name="nuevopass" placeholder="Nuevo password">
  </div>
  <div class="form-group">  
  <label for="nuevopass">Confirmar identidad</label><small class="text-muted">(*).</small>
    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password actual" required>
  </div>
  <small class="text-muted">(*) Datos Obligatorios.</small><br><br>
 </div>
 <center><button type="submit" class="btn btn-primary" style="width:100px;">Guardar</button><center>
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