<?php

$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$nombre = $_POST['nombre'];
$tipo = $_POST['tipo_categoria'];

echo $nombre;
echo "\n";
echo $tipo;


$stid = oci_parse($conn, "insert into categoria (id_categoria, nombre, id_tipo_categoria) values (s_categoria.nextval, :n, :t)");

oci_bind_by_name($stid, ':n', $nombre);
oci_bind_by_name($stid, ':t', $tipo);

oci_execute($stid);


echo "listo";


?>
