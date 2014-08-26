<!DOCTYPE html>
<html>
<head>
    <script src="../libs/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
</head>
<body>

<?php
$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$cedula = $_POST['cedula'];

if(!is_numeric($cedula)){
	echo "NO es un numero";
	echo "<input name='existe' id='existe' type='hidden' value='0'>";
}
else{

$existe = False;

$stid = oci_parse($conn, "select cedula from persona");

oci_execute($stid);

$stid2 = oci_parse($conn, "select cedula from usuario where cedula = ".$cedula." ");

oci_execute($stid2);

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
	if ($row['CEDULA'] == $cedula) {
		$existe = True;
	}
}

if ($row2 = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)) {
		$existe = False;
}

if ($existe) {
	echo "<div class='txtInfo'>";
	echo "<p>Esta cédula ya existe puede continuar</p>";
	echo "</div>";
	echo "<input name='existe' type='hidden' value='1'>";
}
else{
	echo "<div class='txtInfo'>";
	echo "<p>Por favor ingrese mas datos</p>";
	echo "<a href='../Registros/registroPersonas_usuario.php'> registrar aqui</a>";
	echo "</div>";
	echo "<button class='btnInfo' onclick='alert2()'></button>";
	echo "<input name='existe' id='existe' type='hidden' value='0'>";

}
}

?>
</body>
</html>
