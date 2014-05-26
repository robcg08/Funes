<?php
error_reporting(E_ERROR | E_PARSE);

$pais = $_POST['pais'];

$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$stid = oci_parse($conn, "select id_provincia, nombre from provincia where id_pais = ".$pais."");

oci_execute($stid);

echo "
<p>Provincia</p>
<select name = 'provincia' id='provincia' onchange='changeProvincia(this.value)' required>";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
echo"<option value=".$row['ID_PROVINCIA'].">".$row['NOMBRE']."</option>";
}
echo "</select>";


?>

