<?php


$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$cedula = $_POST['cedula'];


$existe = False;

$stid = oci_parse($conn, "select cedula from persona");

oci_execute($stid);

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
	if ($row['CEDULA'] == $cedula) {
		$existe = True;
	}
}

if ($existe) {
	echo "Esta cedula ya exite,digite otra";
	echo "<input name='existe' type='hidden' value='0'>";
}
else{
	echo "Esta cedula esta disponible";
	echo "<input name='existe' type='hidden' value='1'>";
}


?>
