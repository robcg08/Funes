<?php
header('Content-Type: text/html; charset=UTF-8');
$conn = oci_connect('fm', 'fm', 'localhost/funar','AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$nombre = $_POST['nombre'];

echo $nombre;


$stid = oci_parse($conn, "insert into categoria (id_categoria, nombre) values (s_categoria.nextval, :n)");

oci_bind_by_name($stid, ':n', $nombre);

oci_execute($stid);


echo "listo";
echo "<meta http-equiv='refresh' content='0; url=http://localhost/funes/interfaz+logica=100/Interfaz/Consultas/consultas_entidades.php'>";


?>
