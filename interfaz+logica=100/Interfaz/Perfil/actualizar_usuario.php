<?php

$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

//_SESSION['cedula']

$cedula=115770503;
$nombre=$_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$privacidad = $_POST['datosPrivados'];
$pass=$_POST['pass'];


$stid = oci_parse($conn, "update persona set nombre='".$nombre."', primer_apellido='".$apellido1."', segundo_apellido='".$apellido2."' where cedula = ".$cedula."");
oci_execute($stid);
$stid = oci_parse($conn, "update usuario set pass='".$pass."', privado='".$privacidad."' where cedula = ".$cedula."");
oci_execute($stid);

echo "listo ";

echo "<meta http-equiv='refresh' content='2; url=http://localHost/funes/Interfaz/index.php'>";



?>

