<?php
error_reporting(E_ERROR | E_PARSE);

$distrito = $_POST['distrito'];

$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$stid = oci_parse($conn, "select id_barrio, nombre from barrio where id_distrito = ".$distrito."");

oci_execute($stid);

echo "
<p>Barrio</p>
<select name = 'barrio' id='barrio' required>";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
echo"<option value=".$row['ID_BARRIO'].">".$row['NOMBRE']."</option>";
}
echo "</select>";

?>
