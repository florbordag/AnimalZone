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
                  <form class="form-inline my-2 my-lg-0">
                      <input class="form-control mr-sm-2" type="text" placeholder="Deshabilitado :(">
                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
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
        <h5 class="card-title"><?php echo $user->nombre." ".$user->apellido; ?></h5>
        <p class="card-text"><?php echo $user->descripcion;?></p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><a href="#"><img src="https://buenavida.pr/wp-content/uploads/2017/05/Mascota-1170x780.jpg" style="width: 100px;"><br>Chocolate</a></li>
        <li class="list-group-item"><a href="#">Mascota 2</a></li>
        <li class="list-group-item"><a href="#">Mascota 3</a></li>
      </ul>
      <div class="card-body">
        <a href="<?PHP echo $helper->url("Muro","modificarPerfil"); ?>" class="card-link">Modificar Perfil</a><hr>
        <a href="<?PHP echo $helper->url("Muro","cerrarSesion"); ?>" class="card-link">Cerrar Sesión</a>
      </div>
    </div></div>
    </div>



    <div class="col">

    <center><a class="btn btn-primary" data-toggle="collapse" href="#post" role="button" aria-expanded="false" aria-controls="post">ESCRIBIR UN POST</a></center>

    <div class="card text-center " >
    <div class="collapse multi-collapse" id="post">
      <form action="<?PHP echo $helper->url("Muro","postear"); ?>" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
          
              <label for="descrip"> ¿Que hay de nuevo?</label> <hr>
              <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="public" id="inlineRadio1" value="0" checked>
      <label class="form-check-label" for="inlineRadio1">Amigos</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="public" id="inlineRadio2" value="1">
      <label class="form-check-label" for="inlineRadio2">Público</label>
    </div>
              <input type="text" name="titulo" class="form-control" placeholder="Título...">
              <textarea class="form-control" id="descrip" name="descrip" rows="3">Escribe aqui...</textarea>
            </div>
            <div class="form-group row">

              <div class="col">
                <label for="kw" class="col-form-label">#</label>
                <input type="text" id="kw" name="kw" placeholder="hashtag">
              </div>        
              <div class="col">
                <label for="kw2" class="col-form-label">#</label>
                <input type="text" id="kw2" name="kw2" placeholder="hashtag">
              </div>
              <div class="col">
                <label for="kw3" class="col-form-label">#</label>
                  <input type="text" id="kw3" name="kw3" placeholder="hashtag">
              </div>   

              </div>

          <hr>
          (*)Puedes subir hasta 3 imgenes
          <input type="file" class="form-control-file" name="img1" id="img1" accept="image/png, image/jpeg, image/gif, image/png">
          <input type="file" class="form-control-file" name="img2" id="img2" accept="image/png, image/jpeg, image/gif, image/png">
          <input type="file" class="form-control-file" name="img3" id="img3" accept="image/png, image/jpeg, image/gif, image/png">
          (*)Y un archivo adjunto
          <input type="file" class="form-control-file" name="adj" id="adj">
          <input type="submit" value="Postear" class="btn btn-success">
      </form>
    </div>
    </div>
      <hr>





      <div class="overflow-auto" style="max-height: 28rem">
    <?php 
    $idpost=null;

    if($allPost !=null){

          foreach($allPost as $post){
            $idpost=$post->id_post;
            $hoy= new DateTime();
            $fecha2 = new DateTime($post->fecha); 
            $intervalo = $hoy->diff($fecha2);
            $txt= $intervalo->format('%i');
          if ((int)$intervalo->format('%H')>0){$txt=$intervalo->format('Hace %h horas');} else {$txt= $intervalo->format('Hace %i minutos');}
          if((int)$intervalo->format('%D')>0){$txt=$intervalo->format('Hace %d días');}
          if((int)$intervalo->format('%M')>0){$txt=$intervalo->format('Hace %m meses');}
          if((int)$intervalo->format('%Y')>1){$txt=$intervalo->format('Hace %y años');}
          if((int)$intervalo->format('%Y')==1){$txt=$intervalo->format('Hace 1 año');}
          if((int)$intervalo->format('%M')==1){$txt=$intervalo->format('Hace 1 mes');}
          if((int)$intervalo->format('%D')==1){$txt=$intervalo->format('Hace 1 día');}


            echo '    <div class="card mb-3">
            <div class="row no-gutters">
              <div class="col-lg-4">
                <img src="'.$post->user->imagen_perfil.'" class="rounded-circle" alt="img_perfil" style="width:100px;height:100px; padding: 10px;">
                <p class="card-text"><small class="text-muted">'.$txt.'.</small></p>
              </div>
              <div class="col">
                <div class="card-body">
                  <h5 class="card-title">@'.$post->user->username.' <small class="text-muted">Titulo:'.$post->titulo.'</small></h5>
                  <p class="card-text">'.$post->descripcion.'</p>
                  
                  '; if($post->imagen1!=null){ echo '<img src="'.$post->imagen1.'" style="max-width:500px;">';}
                  if($post->imagen2!=null){ echo '<img src="'.$post->imagen2.'" style="max-width:500px;">';}
                  if($post->imagen3!=null){ echo '<img src="'.$post->imagen3.'" style="max-width:500px;">';}
                
                  
                  echo'<hr>

                  <a data-toggle="collapse" href="#comentar'.$post->id_post.'" role="button" aria-expanded="false" aria-controls="post">Comentar</a>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                  <a data-toggle="collapse" href="#reportar'.$post->id_post.'" role="button" aria-expanded="false" aria-controls="post">Reportar</a>
               
                  <div class="collapse multi-collapse" id="comentar'.$post->id_post.'">
                  <form action="';echo $helper->url("Muro","comentar");echo'" method="post">
                  
                  <div class="card-body">
                  <div class="form-group">
                        <textarea class="form-control" id="descripc" name="descripc" rows="2">Comentario...</textarea>
                        
                        <input type="hidden" class="form-control" name="idpostc" id="idpostc" value="'.$post->id_post.'">
                        <hr>
                        <input type="submit" value="Comentar" name="comentar" class="btn btn-success">
                        </div>
                      </div></form>
              </div> 
              <div class="collapse multi-collapse" id="reportar'.$post->id_post.'">
              <form action="';echo $helper->url("Muro","reportarPost");echo'" method="post">
              <div class="card-body">
              <div class="form-group">Dinos el motivo de tu reporte:<hr>
              <input class="form-check-input" type="checkbox" id="motivo1" name="motivo[]" value="Discriminacion">
              <label class="form-check-label" for="motivo1">Discriminación de cualquier tipo</label><hr>
              <input class="form-check-input" type="checkbox" id="motivo2" name="motivo[]" value="Contenido inadecuado">
              <label class="form-check-label" for="motivo2">Contenido ofensivo, lenguaje obsceno</label><hr>
              <input class="form-check-input" type="checkbox" id="motivo3" name="motivo[]" value="Imagenes sensibles">
              <label class="form-check-label" for="motivo3">Imagenes sensibles, violencia, pornografía</label>
                    
                    <input type="hidden" class="form-control" name="idpostr" id="idpostr" value="'.$post->id_post.'">
                    <hr>
                    <input type="submit" value="Enviar reporte" name="reportar" class="btn btn-success">
                    </div>
                  </div>
              </form> </div>
                </div>
              </div>
            </div>
          ';   foreach ($coments as $com){

            foreach((array)$com as $c){
          if($c->post->id_post == $idpost){ 

            $hoyc= new DateTime();
            $fecha2c = new DateTime($c->fecha); 
            $intervaloc = $hoyc->diff($fecha2c);
            $txtc= $intervaloc->format('%i');
          if ((int)$intervaloc->format('%H')>0){$txtc=$intervaloc->format('Hace %h horas');} else {$txtc= $intervaloc->format('Hace %i minutos');}
          if((int)$intervaloc->format('%D')>0){$txtc=$intervaloc->format('Hace %d días');}
          if((int)$intervaloc->format('%M')>0){$txtc=$intervaloc->format('Hace %m meses');}
          if((int)$intervaloc->format('%Y')>1){$txtc=$intervaloc->format('Hace %y años');}
          if((int)$intervaloc->format('%Y')==1){$txtc=$intervaloc->format('Hace 1 año');}
          if((int)$intervaloc->format('%M')==1){$txtc=$intervaloc->format('Hace 1 mes');}
          if((int)$intervaloc->format('%D')==1){$txtc=$intervaloc->format('Hace 1 día');}

          echo '    <div class="card mb-3">
          <div class="row no-gutters">

          <div class="col-4" style="margin-left:10%;">
          <img src="'.$c->usuario->IMAGEN_PERFIL.'" class="rounded-circle" alt="mi nombre" style="width:60px;height:60px;margin-top:20px;">
          <p class="card-text"><small class="text-muted">'.$txtc.'.</small></p>
          </div>
            <div class="col">
            <br>
                    <p style="text-align:left;"> </h5>@'.$c->usuario->USERNAME.':  </h5><small class="text-muted">'.$c->descripcion.'</small></p>
                  
                  ';
                  if($c->usuario->ID_USUARIO == $user->id_usuario){
                    echo'
                    <a data-toggle="collapse" style="margin-left:65%;" href="#eliminarComent'.$c->id_comentario.'" role="button" aria-expanded="false" aria-controls="post">Eliminar</a>
                    
                      <div class="collapse multi-collapse" id="eliminarComent'.$c->id_comentario.'">
                        <form action="';echo $helper->url("Muro","eliminarComentario");echo '" method="post">
                        <input type="hidden" name="idComenteliminar" id="idComenteliminar" value="'.$c->id_comentario.'">
                      <div class="alert alert-warning" role="alert">
                  ¿Seguro que quieres eliminar este comentario?&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input class="alert-link"  type="submit" name="eliminarComent" value="SI" style="border-style:hidden;background-color:transparent;">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a data-toggle="collapse" href="#eliminarComent'.$c->id_comentario.'" role="button" aria-expanded="true" aria-controls="post" class="alert-link">Cancelar</a>
                  </div> </form>
                </div>';} else{
                echo '

                <a data-toggle="collapse"  style="margin-left:65%;" href="#reportarc'.$c->id_comentario.'" role="button" aria-expanded="false" aria-controls="post">Reportar</a>
                </div>
                <div class="collapse multi-collapse" id="reportarc'.$c->id_comentario.'">
                <form action="';echo $helper->url("Muro","reportarComent");echo'" method="post">
                <div class="card-body">
                <div class="form-group">Dinos el motivo de tu reporte:<hr>
                <input class="form-check-input" type="checkbox" id="motivo1" name="motivo" value="Discriminacion">
                <label class="form-check-label" for="motivo1">Discriminación de cualquier tipo</label><hr>
                <input class="form-check-input" type="checkbox" id="motivo2" name="motivo" value="Lenguaje inadecuado">
                <label class="form-check-label" for="motivo2">Lenguaje ofensivo o violento</label><hr>
                <input class="form-check-input" type="checkbox" id="motivo3" name="motivo" value="Violencia">
                <label class="form-check-label" for="motivo3">Violencia</label>
                      
                      <input type="hidden" class="form-control" name="idcoment" id="idcoment" value="'.$c->id_comentario.'">
                      <input type="hidden" class="form-control" name="idpostrc" id="idpostrc" value="'.$post->id_post.'">
                      <hr>
                      <input type="submit" value="Enviar reporte" name="reportarcoment" class="btn btn-success">
                      </div>
                    </div></form></div>';}
          echo ' </div>




            </div>
            </div>';}
            }
                


                        }

            echo '</div>
            ';



      }

    }  else {echo "No hay post que mostrar. Agrega algunos amigos y publica tu primer post!<hr>";}
    ?>


    <?php 
    $idpost=null;

    if($publicos !=null){

          foreach($publicos as $post){
            $idpost=$post->id_post;
            $hoy= new DateTime();
            $fecha2 = new DateTime($post->fecha); 
            $intervalo = $hoy->diff($fecha2);
            $txt= $intervalo->format('%i');
          if ((int)$intervalo->format('%H')>0){$txt=$intervalo->format('Hace %h horas');} else {$txt= $intervalo->format('Hace %i minutos');}
          if((int)$intervalo->format('%D')>0){$txt=$intervalo->format('Hace %d días');}
          if((int)$intervalo->format('%M')>0){$txt=$intervalo->format('Hace %m meses');}
          if((int)$intervalo->format('%Y')>1){$txt=$intervalo->format('Hace %y años');}
          if((int)$intervalo->format('%Y')==1){$txt=$intervalo->format('Hace 1 año');}
          if((int)$intervalo->format('%M')==1){$txt=$intervalo->format('Hace 1 mes');}
          if((int)$intervalo->format('%D')==1){$txt=$intervalo->format('Hace 1 día');}


            echo '    <div class="card mb-3">
            <div class="row no-gutters">

              <div class="col-lg-4">
                <img src="'.$post->user->imagen_perfil.'" class="rounded-circle" alt="mi nombre" style="width:100px;height:100px; padding: 10px;">
                <p class="card-text"><small class="text-muted">'.$txt.'.</small></p>
              </div>
              <div class="col">
                <div class="card-body">
                  <h5 class="card-title">@'.$post->user->username.' <small class="text-muted">Titulo:'.$post->titulo.'</small></h5>
                  <p class="card-text">'.$post->descripcion.'</p>
                  
                  '; if($post->imagen1!=null){ echo '<img src="'.$post->imagen1.'" style="max-width:500px;">';}
                  if($post->imagen2!=null){ echo '<img src="'.$post->imagen2.'" style="max-width:500px;">';}
                  if($post->imagen3!=null){ echo '<img src="'.$post->imagen3.'" style="max-width:500px;">';}     
                  echo'<hr>
                  <a data-toggle="collapse" href="#comentar'.$post->id_post.'" role="button" aria-expanded="false" aria-controls="post">Comentar</a>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                  <a data-toggle="collapse" href="#reportar'.$post->id_post.'" role="button" aria-expanded="false" aria-controls="post">Reportar</a>
                
                  <div class="collapse multi-collapse" id="comentar'.$post->id_post.'">
                  <form action="';echo $helper->url("Muro","comentar");echo'" method="post">
                  <div class="card-body">
                  <div class="form-group">
                        <textarea class="form-control" id="descripc" name="descripc" rows="2">Comentario...</textarea>
                        
                        <input type="hidden" class="form-control" name="idpostc" id="idpostc" value="'.$post->id_post.'">
                        <hr>
                        <input type="submit" value="Comentar" name="comentar" class="btn btn-success">
                        </div>
                      </div></form>
              </div> 


                  <div class="collapse multi-collapse" id="reportar'.$post->id_post.'">
                  
                  <div class="card-body">
                  <div class="form-group">Dinos el motivo de tu reporte:<hr>
                  <form action="';echo $helper->url("Muro","reportarPost");echo'" method="post" id="reportPostp">
                    <input class="form-check-input" type="checkbox" id="motivo1" name="motivo[]" value="Discriminacion">
                   <label class="form-check-label" for="motivo1">Discriminación de cualquier tipo</label><hr>
                    <input class="form-check-input" type="checkbox" id="motivo2" name="motivo[]" value="Contenido inadecuado">
                  <label class="form-check-label" for="motivo2">Contenido ofensivo, lenguaje obsceno</label><hr>
                    <input class="form-check-input" type="checkbox" id="motivo3" name="motivo[]" value="Imagenes sensibles">
                  <label class="form-check-label" for="motivo3">Imagenes sensibles, violencia, pornografía</label>
                     <input type="hidden" class="form-control" name="idpostr" id="idpostr" value="'.$post->id_post.'">
                    <hr>
                    <input type="submit" value="Enviar reporte" name="reportar" class="btn btn-success"  form="reportPostp"></form>
                    </div>
                  </div></div>
              
                </div>
              </div>
            </div>      
          ';    foreach ($pcoment as $com){

            foreach((array)$com as $c){
          if($c->post->id_post == $idpost){ 

            $hoyc= new DateTime();
            $fecha2c = new DateTime($c->fecha); 
            $intervaloc = $hoyc->diff($fecha2c);
            $txtc= $intervaloc->format('%i');
          if ((int)$intervaloc->format('%H')>0){$txtc=$intervaloc->format('Hace %h horas');} else {$txtc= $intervaloc->format('Hace %i minutos');}
          if((int)$intervaloc->format('%D')>0){$txtc=$intervaloc->format('Hace %d días');}
          if((int)$intervaloc->format('%M')>0){$txtc=$intervaloc->format('Hace %m meses');}
          if((int)$intervaloc->format('%Y')>1){$txtc=$intervaloc->format('Hace %y años');}
          if((int)$intervaloc->format('%Y')==1){$txtc=$intervaloc->format('Hace 1 año');}
          if((int)$intervaloc->format('%M')==1){$txtc=$intervaloc->format('Hace 1 mes');}
          if((int)$intervaloc->format('%D')==1){$txtc=$intervaloc->format('Hace 1 día');}

          echo '    <div class="card mb-3">
          <div class="row no-gutters">

          <div class="col-4" style="margin-left:10%;">
          <img src="'.$c->usuario->IMAGEN_PERFIL.'" class="rounded-circle" alt="mi nombre" style="width:60px;height:60px;margin-top:20px;">
          <p class="card-text"><small class="text-muted">'.$txtc.'.</small></p>
          </div>
            <div class="col">

              <div><hr> 
                <p style="text-align:left;"> </h5>@'.$c->usuario->USERNAME.':  </h5><small class="text-muted">'.$c->descripcion.'</small></p>';
                if($c->usuario->ID_USUARIO == $user->id_usuario){
                  echo'
                  <a data-toggle="collapse" style="margin-left:65%;" href="#eliminarComent'.$c->id_comentario.'" role="button" aria-expanded="false" aria-controls="post">Eliminar</a>
                  </div>
                  <div class="collapse multi-collapse" id="eliminarComent'.$c->id_comentario.'">
                  <form action="';echo $helper->url("Muro","eliminarComentario");echo '" method="post">
                  <input type="hidden" name="idComenteliminar" id="idComenteliminar" value="'.$c->id_comentario.'">
                  <div class="alert alert-warning" role="alert">
                ¿Seguro que quieres eliminar este comentario?&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input class="alert-link"  type="submit" name="eliminarComent" value="SI" style="border-style:hidden;background-color:transparent;">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a data-toggle="collapse" href="#eliminarComent'.$c->id_comentario.'" role="button" aria-expanded="true" aria-controls="post" class="alert-link">Cancelar</a>
                </div> </form>
                  </div>';} else{
                  echo '
      
                  <a data-toggle="collapse"  style="margin-left:65%;" href="#reportarc'.$c->id_comentario.'" role="button" aria-expanded="false" aria-controls="post">Reportar</a>
                  </div>
                  <div class="collapse multi-collapse" id="reportarc'.$c->id_comentario.'">
                  <form action="';echo $helper->url("Muro","reportarComent");echo'" method="post">
                  <div class="card-body">
                  <div class="form-group">Dinos el/los motivo/s de tu reporte:<hr>
                  <input class="form-check-input" type="checkbox" id="motivo1" name="motivo" value="Discriminacion">
                  <label class="form-check-label" for="motivo1">Discriminación de cualquier tipo</label><hr>
                  <input class="form-check-input" type="checkbox" id="motivo2" name="motivo" value="Lenguaje inadecuado">
                  <label class="form-check-label" for="motivo2">Lenguaje ofensivo o violento</label><hr>
                  <input class="form-check-input" type="checkbox" id="motivo3" name="motivo" value="Violencia">
                  <label class="form-check-label" for="motivo3">Violencia</label>
                        
                        <input type="hidden" class="form-control" name="idcoment" id="idcoment" value="'.$c->id_comentario.'">
                        <input type="hidden" class="form-control" name="idpostrc" id="idpostrc" value="'.$post->id_post.'">
                        <hr>
                        <input type="submit" value="Enviar reporte" name="reportarcoment" class="btn btn-success">
                        </div>
                      </div></form></div>';}
                      echo '<div>



            </div>  </div> </div>
            </div>';}
            }
                


                        }

            echo '</div>';



      }

    }  else {echo "No hay post públicos que mostrar. Agrega algunos amigos y publica tu primer post!";}
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
    </div>
</div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>