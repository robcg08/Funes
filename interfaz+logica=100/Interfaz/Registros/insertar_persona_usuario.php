<?php
header('Content-Type: text/html; charset=UTF-8');
$conn = oci_connect('fm', 'fm', 'localhost/funar','AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$apellido2 = $_POST['segundoApellido'];
$genero = $_POST['genero'];
$fechaN = $_POST['fecha'];


$lugarTrabajo = $_POST['lugarTrabajo'];
$cargo = $_POST['cargo'];

$categoria = $_POST['categorias'];

$categoria=explode(',',$categoria);

echo $cedula;
echo "----";
echo $nombre;
echo "----";
echo $apellido;
echo "----";
echo $apellido2;
echo "----";
echo $genero;
echo "----";
echo $fechaN;
echo "----";
echo $lugarTrabajo;
echo "----";
echo $cargo;
echo "----";
print_r($categoria);



$stid = oci_parse($conn, "insert into persona(cedula, nombre, primer_apellido, segundo_apellido, genero, fecha_nacimiento)
	values (:c, :n, :a, :p, :g, date '".$fechaN."')");

oci_bind_by_name($stid, ':c', $cedula);
oci_bind_by_name($stid, ':n', $nombre);
oci_bind_by_name($stid, ':a', $apellido);
oci_bind_by_name($stid, ':p', $apellido2);
oci_bind_by_name($stid, ':g', $genero);


oci_execute($stid);

$stid = oci_parse($conn, 'begin :result := insertar_lugar_trabajo(:l);end;');
oci_bind_by_name($stid, ':l', $lugarTrabajo);
oci_bind_by_name($stid, ':result', $result, 40);

oci_execute($stid);

$id_lugar_trabajo = $result;

$stid = oci_parse($conn, 'begin :result := insertar_cargo(:c, :l);end;');
oci_bind_by_name($stid, ':c', $cargo);
oci_bind_by_name($stid, ':l', $id_lugar_trabajo);
oci_bind_by_name($stid, ':result', $result, 40);

oci_execute($stid);

$id_cargo = $result;

$stid = oci_parse($conn, "insert into trabajoxpersona (cedula, id_cargo, id_lugar_trabajo) values (:c, :a, :l)");

oci_bind_by_name($stid, ':c', $cedula);
oci_bind_by_name($stid, ':a', $id_cargo);
oci_bind_by_name($stid, ':l', $id_lugar_trabajo);

oci_execute($stid);

for ($i=0; $i < sizeof($categoria); $i++){

	$stid = oci_parse($conn, "insert into categoriaxpersona (id_categoria, cedula) values (:c, :e)");
	$categoriaINT = intval($categoria[$i]);
	oci_bind_by_name($stid, ':c', $categoriaINT);
	oci_bind_by_name($stid, ':e', $cedula);

	oci_execute($stid);

}

echo "listo - ya se pude registrar como usuario";
echo "<a href='../Registros/registroUsuarios.php'> click aqui</a>";
echo "<meta http-equiv='refresh' content='0; url=http://localhost/funes/interfaz+logica=100/Interfaz/Registros/registroUsuarios.php'>";



?>
