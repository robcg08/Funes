<?php
$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$usuario = $_POST["usuario"];
$password = intval($_POST["password"]);

$stid = oci_parse($conn, "SELECT * FROM usuario where usuario = '" . $usuario . "'");
oci_execute($stid);


if ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){

	if ($row['PASS'] == $password) {
		session_start();
  	$_SESSION['usuario'] = $row['USUARIO'] ;
    $_SESSION['cedula'] = $row['CEDULA'] ;
  	header("Location: Consultas/consultas.php");
	}
	else{
	echo "sorry la contraseña esta mal";
	}

}
else{
	echo "sorry usuario malo";
}

?>
