<?php

$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$cedula = $_POST['cedula'];

$usuario = $_POST['usuario'];
$password = $_POST['pass'];
$privado = $_POST['datosPrivados'];

echo $cedula;
echo "----";
echo $usuario;
echo "----";
echo $password;
echo "----";
echo $privado;



$stid = oci_parse($conn, "insert into usuario (usuario, pass, privado, reportes, bloqueado, cedula) values (:u, :p, :v, 0, 'no' , :c)");

oci_bind_by_name($stid, ':u', $usuario);
oci_bind_by_name($stid, ':p', $password);
oci_bind_by_name($stid, ':v', $privado);
oci_bind_by_name($stid, ':c', $cedula);

oci_execute($stid);



echo "listo";

?>
