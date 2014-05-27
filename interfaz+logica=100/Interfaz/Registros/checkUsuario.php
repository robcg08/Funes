<?php
$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$usuario = $_POST['usuario'];

if ($usuario != "") {

$usuario = strtolower($usuario);

$stid = oci_parse($conn, "select usuario from usuario");

oci_execute($stid);

$esta = False;

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
	if ($usuario == $row['USUARIO']) {
		$esta = True;
	}
}

if ($esta) {
	echo "Este Usuario ya esta, escoja otro.";
	echo "<input name='esta' type='hidden' value='0'>";
}
else{
	echo "Este Usuario esta disponible";
	echo "<input name='esta' type='hidden' value='1'>";
}

}

?>
