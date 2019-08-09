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
  <body style="background-color:#43549E; color:white;">
<div class="col">

<div class="mx-auto" style="width:800px;">
<img src="https://i.ibb.co/fQwqd2Z/portada.png" alt="portada" border="0">
<div class="mx-auto" style="width:300px;margin-top:100px;">

<form class="needs-validation" action="<?php echo $helper->url("Moderador","entrar"); ?>" method="post" novalidate>
  <div class="form-group">
  <label for="mail">Usuario</label>
      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="roberto07mod" required>
      <div class="invalid-feedback">
        Por favor ingrese un email válido.
      </div>
  <div class="form-group">
  <label for="pass">Password</label>
      <input type="password" class="form-control" id="pass" name="pass" placeholder="Password..." required>
      <div class="invalid-feedback">
        Ingresa tu password.
      </div>
  </div>
   <center> ¿Aun no tienes una cuenta?<br>
    <a href="<?php echo $helper->url("usuario","registro"); ?>" style="color:yellow;">¡Registrate aqui!</a><br><center><br>

  <center><button type="submit" class="btn btn-primary" style="width:100px;">Login</button><center>
</form>



<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</div>

<center><a href="<?php echo $helper->url("Moderador","login"); ?>" style="color:#9EE7DD;">Ingresar como moderador</a></center>
</div>

</div>

      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>