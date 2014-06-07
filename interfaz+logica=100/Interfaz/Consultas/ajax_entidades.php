<?php
$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$nombre = $_POST['nombre'];

$filtro = $_POST['filtro'];

$tipo;

if ($filtro == "cedula") {
$stid = oci_parse($conn, "SELECT consultas.get_entidad_cedula('".$nombre."') AS mfrc FROM dual");
oci_execute($stid);
}
elseif ($filtro == "nombre") {
$stid = oci_parse($conn, "SELECT consultas.get_entidad_nombre('".$nombre."') AS mfrc FROM dual");
oci_execute($stid);
}

echo "
</form>
<table border='1'>
<tr>
  <th>Review</th>
  <th>Cedula Juridica</th>
  <th>Nombre</th>
</tr>";

while (($fila = oci_fetch_array($stid, OCI_ASSOC))) {
    $rc = $fila['MFRC'];
    oci_execute($rc);
    while (($fila_rc = oci_fetch_array($rc, OCI_ASSOC))) {
        echo "<tr>\n";
    	echo "
    		<td>
    		<form name='review' action='#review' method='post'>
			<input type='hidden' name=''>
			<input type='submit' value='X'>
			</form>
			</td>";
        echo "<td>" . $fila_rc['CEDULA_JURIDICA'] . "</td>\n";
        echo "<td>" . $fila_rc['NOMBRE'] . "</td>\n";
        echo "</tr>\n";
    }
    oci_free_statement($rc);

}
echo "</table>";


?>
