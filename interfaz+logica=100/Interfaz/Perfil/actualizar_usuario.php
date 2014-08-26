<?php
session_start();
$conn = oci_connect('fm', 'fm', 'localhost/funar','AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

echo $_SESSION['usuario'];
echo $_SESSION['cedula'];
$cedula=$_SESSION['cedula'];
$nombre=$_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$privacidad = $_POST['datosPrivados'];
$pass=$_POST['pass'];
echo $pass;

$stid = oci_parse($conn, "update persona set nombre='".$nombre."', primer_apellido='".$apellido1."', segundo_apellido='".$apellido2."' where cedula = ".$cedula."");
oci_execute($stid);
$stid = oci_parse($conn, "update usuario set pass='".$pass."', privado='".$privacidad."' where cedula = ".$cedula."");
oci_execute($stid);

echo "listo ";

echo "<meta http-equiv='refresh' content='0; url=http://localhost/funes/interfaz+logica=100/Interfaz/Consultas/consultas_entidades.php'>";



?>

