<?php
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ERROR | E_PARSE);
$conn = oci_connect('fm', 'fm', 'localhost/funar','AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$nombre = $_POST['nombre'];

$filtro = $_POST['filtro'];

$id;

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
  <th>Cédula Jurídica</th>
  <th>Nombre</th>
</tr>";

while (($fila = oci_fetch_array($stid, OCI_ASSOC))) {
    $rc = $fila['MFRC'];
    oci_execute($rc);
    while (($fila_rc = oci_fetch_array($rc, OCI_ASSOC))) {
        echo "<tr>\n";
    	echo "<td>
    		<form name='review' action='../Reviews/review.php' method='post'>";

            $stid2 = oci_parse($conn, 'begin :result := get_id_entidad(:nombre,:dirr); end;');
            $id_dir = $fila_rc['ID_DIRECCION'];
            oci_bind_by_name($stid2, ':dirr', $id_dir);
            oci_bind_by_name($stid2, ':nombre', $fila_rc['NOMBRE']);
            oci_bind_by_name($stid2, ':result', $result, 40);
            oci_execute($stid2)
            ;

        echo "<input type='hidden' name='id' value='".$result."'>
        <input type='submit' class='btnVer' value='Ver'>
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
