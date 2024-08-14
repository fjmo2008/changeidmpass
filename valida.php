<?php

require_once 'config.php';

// Validación de usuario y contraseña
if (isset($_POST['usuario']) && isset($_POST['contrasena1']) && isset($_POST['contrasena2'])) {
  $usuario = $_POST['usuario'];
  $contrasena1 = $_POST['contrasena1'];
  $contrasena2 = $_POST['contrasena2'];

  // Credenciales de administrador LDAP
  $dn = Config::LDAP_DN;
  $password = Config::LDAP_PASSWORD;

  // Conexión al servidor LDAP
  $ldap = ldap_connect(Config::LDAP_URL, 389);
  
  // Datos del usuario a buscar
  $filtro = '(uid='.$usuario.')';
  $dnFiltro = 'o=sjd';

  // Búsqueda del usuario
  $resultado = ldap_search($ldap, $dnFiltro, $filtro);
  $first = ldap_first_entry($ldap, $resultado);

  // Obtención del DN del usuario
  $dnUsuario = ldap_get_dn($ldap, $first);

  // Autenticación como usuario
  if (ldap_bind($ldap, $dnUsuario, $contrasena1)) {
    // Autenticación como administrador
    if (ldap_bind($ldap, $dn, $password)) {
      // Cambio de contraseña
      $newPassword = array('userPassword' => $contrasena2);
      if (ldap_modify($ldap, $dnUsuario, $newPassword)) {
        echo 'Contraseña del usuario actualizada correctamente';
      } else {
        echo 'ERROR: No se ha podido actualizar la contraseña del usuario';
      };
    } else {
      echo 'Fallo en la autenticación del Administrador';
    };
  } else {
    echo 'Usuario o contraseña incorrectos';
  }

  echo '<br><br><br>';

  // Cierre de la conexión
  ldap_close($ldap);

  $url = Config::URL_APP;
  
  $textoEnlace = 'Volver';

  echo "<a href='$url'>$textoEnlace</a>";

}

?>