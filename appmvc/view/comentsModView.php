<!doctype html>
<html lang="en">
  <head>
    <title>Nuevo login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

<body style="background-color:#43549E;">
    
<div class="container-fluid">
    <a href="<?php echo $helper->url("Moderador","entrar"); ?>"><button type="button" class="btn btn-primary btn-lg">Post</button></a>
    <a href="<?php echo $helper->url("Moderador","Comentsmod"); ?>"><button type="button" class="btn btn-secondary btn-lg">Comentarios</button></a>
    <a href="<?php echo $helper->url("Muro","cerrarSesion"); ?>"><button type="button" class="btn btn-dark btn-lg">Salir</button></a>
      <div class="card text-center">
          <nav aria-label="Page navigation example" class="row justify-content-around">
          
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>

        <div class="overflow-auto" style="height:40rem;">
          <form action="<?php  echo $helper->url("Moderador","moderarComent");?>" method="post">
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">ID REP</th>
                            <th scope="col">COMENT BY</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">DESCRIPCION</th>  
                            <th scope="col">REPORT BY</th>
                            <th scope="col">FECHA DENUNCIA</th>
                            <th scope="col">FECHA MODERACION</th>
                            <th scope="col">MOTIVO</th>                                                  
                            <th scope="col">ESTADO</th>
                            <th scope="col">#</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        

        <?PHP
            foreach($reportes as $rep){        $estado; if($rep->ESTADO==1){$estado='Activo';}else {$estado='Inactivo';}

            echo '
                            <tr>
                                <th scope="row">'.$rep->ID_REPORT.'</th>
                                <td>'.$rep->ID_USUARIO.'</td>
                                <td>'.$rep->FECHA.'</td> 
                                <td>'.$rep->DESCRIPCION.'</td>
                                <td>'.$rep->ID_USER_REP.'</td>
                                <td>'.$rep->FECHA_DENUNCIA.'</td>
                                <td>'.$rep->FECHA_MODERACION.'</td>
                                <td>'.$rep->MOTIVO.'</td>                          
                                <td>'.$estado.'</td> 
                                <td><input type="checkbox" name="ids[]" value="'.$rep->ID_COMENTARIO .'"></td>                             
                            </tr>
                    ';
            }
            ?>
                       </tbody>
                    </table>
                    





      </div>
      <div class="row justify-content-around">
     <input type="submit" name="activar" class="btn btn-success" value="Activar Comentario">
     <input type="submit" name="desactivar" class="btn btn-danger" value="Desactivar Comentario">
     </div>
     </form>

    </div>
</div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>