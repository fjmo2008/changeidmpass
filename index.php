<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cambio de contraseña Portal del empleado</title>
  <link rel="icon" href="logo.ico" type="image/x-icon"></head>
<body>
  <h1>Cambio de contraseña Portal del empleado</h1>
  <form action="valida.php" method="post" onsubmit="return validarFormulario()">
    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario" required>
    <br>
    <label for="contrasena">Contraseña actual:</label>
    <input type="password" id="contrasena1" name="contrasena1" required>
    <br>
    <label for="contrasena">Contraseña nueva:</label>
    <input type="password" id="contrasena2" name="contrasena2" required>
    <br>
    <label for="contrasena">Repetir contraseña nueva:</label>
    <input type="password" id="contrasena3" name="contrasena3" required>
    <br>
    <button type="submit">Enviar</button>
  </form>
  <script>
  function validarFormulario() {
    const usuario = document.getElementById('usuario').value;
    const contrasena1 = document.getElementById('contrasena1').value;
    const contrasena2 = document.getElementById('contrasena2').value;
    const contrasena3 = document.getElementById('contrasena3').value;

    if (usuario === '' || contrasena1 === '' || contrasena2 === '' || contrasena3 === '') {
      alert('Debes completar todos los campos.');
      return false;
    }

    if (contrasena2 === contrasena3) {
      return true;
    }
    alert('La nueva contraseña no coincide con su repetición');
    return false;
  }
  </script>
</body>
</html>
