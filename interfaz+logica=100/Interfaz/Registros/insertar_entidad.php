<?php
header('Content-Type: text/html; charset=UTF-8');
$conn = oci_connect('fm', 'fm', 'localhost/funar','AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$nombre = $_POST['nombre'];
$cedula = $_POST['cedula'];

$pais=$_POST['pais'];
$provincia=$_POST['provincia'];
$canton=$_POST['canton'];
$distrito=$_POST['distrito'];
$barrio=$_POST['barrio'];

$categoria=$_POST['categorias'];

$categoria=explode(',',$categoria);

$adicional = "";

echo $nombre;
echo "-----";
echo $cedula;
echo "-----";
echo $pais;
echo "-----";
echo $provincia;
echo "-----";
echo $canton;
echo "-----";
echo $distrito;
echo "-----";
echo $barrio;
echo "-----";
print_r($categoria);

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


$stid = oci_parse($conn, 'begin :result := get_id_entidad(:n, :dir);end;');
oci_bind_by_name($stid, ':n', $nombre);
oci_bind_by_name($stid, ':dir', $id_direccion);
oci_bind_by_name($stid, ':result', $result, 40);

oci_execute($stid);


$id_entidad = $result;

for ($i=0; $i < sizeof($categoria); $i++){

$stid = oci_parse($conn, "insert into categoriaxentidad(id_categoria, id_entidad) values (:c, :e)");
$categoriaInt = intval($categoria[$i]);
oci_bind_by_name($stid, ':c',$categoriaInt);
oci_bind_by_name($stid, ':e', $id_entidad);

oci_execute($stid);

}

echo "listo";
echo "<meta http-equiv='refresh' content='0; url=http://localhost/funes/interfaz+logica=100/Interfaz/Consultas/consultas_entidades.php'>";

?>
