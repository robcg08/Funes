<?php

$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$cedula = 6666;

$usuario = "adcubero";
$nick = "moe";
$password = "12345";
$privado = "no";



$stid = oci_parse($conn, "insert into usuario (usuario, nick, pass, privado, reportes, bloqueado, cedula) values (:u, :n, :p, :v, 0, 'no' , :c)");

oci_bind_by_name($stid, ':u', $usuario);
oci_bind_by_name($stid, ':n', $nick);
oci_bind_by_name($stid, ':p', $password);
oci_bind_by_name($stid, ':v', $privado);
oci_bind_by_name($stid, ':c', $cedula);

oci_execute($stid);



echo "listo";

?>
