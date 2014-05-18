<?php

$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$usuario = "adcubero";
$cedula = 78787;
$review = "este mae no hace ";
$estrellas = 2;



$stid = oci_parse($conn, "begin :result := insertar_review('".$review."', :e);end;");
oci_bind_by_name($stid, ':e', $estrellas);
oci_bind_by_name($stid, ':result', $result, 40);

oci_execute($stid);

$id_review = $result;

$stid = oci_parse($conn, "insert into review_persona (usuario, cedula, id_review) values (:u, :c, :i)");

oci_bind_by_name($stid, ':u', $usuario);
oci_bind_by_name($stid, ':c', $cedula);
oci_bind_by_name($stid, ':i', $id_review);

oci_execute($stid);

echo "listo";
?>
