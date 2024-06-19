<?php 

$usuarios = array(
    "AMF" => "9006144232",
    "OMG" => "123456" 
);

$username = $_POST["username"];
$password = $_POST["password"];

if(isset($usuarios[$username])&& $usuarios[$username] === $password){
    setcookie('user', 'authenticated', time() + 600, "/");
    setcookie('username', $username, time() + 600, "/");
    header("Location: paginaPrueba.php");  
    exit();
} else {
    echo "incorrecto";
}

?>