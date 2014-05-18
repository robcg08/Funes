<?php

$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$usuario = "adcubero";
$id_entidad = 6;
$review = "no se q hacen ahi";
$estrellas = 1;



$stid = oci_parse($conn, 'begin :result := insertar_review(:r, :e);end;');
oci_bind_by_name($stid, ':r', $review);
oci_bind_by_name($stid, ':e', $estrellas);
oci_bind_by_name($stid, ':result', $result, 40);

oci_execute($stid);

$id_review = $result;

$stid = oci_parse($conn, "insert into review_entidad(usuario, id_review, id_entidad) values (:u, :i, :e)");

oci_bind_by_name($stid, ':u', $usuario);
oci_bind_by_name($stid, ':i', $id_review);
oci_bind_by_name($stid, ':e', $id_entidad);


oci_execute($stid);

echo "listo";


?>
