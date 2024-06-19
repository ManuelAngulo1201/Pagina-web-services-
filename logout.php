<?php
// Eliminar la cookie de sesión
setcookie('user', '', time() - 3600, "/");
setcookie('username', '', time() - 3600, "/");
header("Location: login.html");
exit();
?>