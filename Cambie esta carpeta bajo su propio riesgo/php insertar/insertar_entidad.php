<?php

$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$nombre = "inamu";
$cedula = 4587394;

$pais=2;
$provincia=2;
$canton=2;
$distrito=2;
$barrio=2;
$adicional=2;

$categoria=2;



$stid = oci_parse($conn, 'begin :result := insertar_id_direccion(:i, :p, :c, :d, :b, :a); end;');
oci_bind_by_name($stid, ':i', $pais);
oci_bind_by_name($stid, ':p', $provincia);
oci_bind_by_name($stid, ':c', $canton);
oci_bind_by_name($stid, ':d', $distrito);
oci_bind_by_name($stid, ':b', $barrio);
oci_bind_by_name($stid, ':a', $adicional);
oci_bind_by_name($stid, ':result', $result, 40);

oci_execute($stid);

$id_direccion = $result;


$stid = oci_parse($conn, "insert into entidad(nombre, cedula_juridica, id_direccion, id_entidad) values (:n, :c, :d, s_entidad.nextval)");

oci_bind_by_name($stid, ':n', $nombre);
oci_bind_by_name($stid, ':c', $cedula);
oci_bind_by_name($stid, ':d', $id_direccion);

oci_execute($stid);


$stid = oci_parse($conn, 'begin :result := get_id_entidad(:n, :c);end;');
oci_bind_by_name($stid, ':n', $nombre);
oci_bind_by_name($stid, ':c', $id_direccion);
oci_bind_by_name($stid, ':result', $result, 40);

oci_execute($stid);


$id_entidad = $result;


$stid = oci_parse($conn, "insert into categoriaxentidad(id_categoria, id_entidad) values (:c, :e)");

oci_bind_by_name($stid, ':c', $categoria);
oci_bind_by_name($stid, ':e', $id_entidad);

oci_execute($stid);

echo "listo";

?>
