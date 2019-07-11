
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


<div class="mx-auto" style="width:800px;">
<img src="https://i.ibb.co/fQwqd2Z/portada.png" alt="portada" border="0"></div>

<center><div class="col-8" style="margin-top:100px;">
<form class="needs-validation" action="<?php echo $helper->url("usuario","crear"); ?>" method="post" novalidate>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="Mark" required>
      <div class="valid-feedback">
        Se ve bien!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="apellido">Apellido</label>
      <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="Otto" required>
      <div class="valid-feedback">
        Se ve bien!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="username">Username</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="username">@</span>
        </div>
        <input type="text" class="form-control" id="username" placeholder="Username" name="username" aria-describedby="inputGroupPrepend" required>
        <div class="invalid-feedback">
          Por favor elija un nombre de usuario.
        </div>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="mail">Email</label>
      <input type="email" class="form-control" id="mail" name="mail" placeholder="Ejemplo@example.com" required>
      <div class="invalid-feedback">
        Por favor ingrese un email válido.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="pais">Pais</label>


      <select class="custom-select" id="pais" name="pais">
  <option selected>Seleccione</option>
      
<?php foreach ($allPaises as $pais => $value) {
      echo "<option value=\"$value->codigo\"> ".$value->pais." </option> ";}
      ?>
</select>
      <div class="invalid-feedback">
        Elija un país válido.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="pass">Password</label>
      <input type="password" class="form-control" id="pass" name="pass" placeholder="Password..." required>
      <div class="invalid-feedback">
        Ingresa un password.
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Acepto los <a href="legal.html">términos y condiciones</a>.
      </label>
      <div class="invalid-feedback">
       Debes aceptar los términos y condiciones para poder registrarte.
      </div>
    </div>
  </div><br>
  <button class="btn btn-primary" type="submit">Únete a la comunidad!</button>
</form>
</center>

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
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>