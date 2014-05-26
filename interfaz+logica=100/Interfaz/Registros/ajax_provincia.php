<?php
error_reporting(E_ERROR | E_PARSE);

$provincia = $_POST['provincia'];

$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$stid = oci_parse($conn, "select id_canton, nombre from canton where id_provincia = ".$provincia."");

oci_execute($stid);

echo "
<p>Canton</p>
<select name = 'canton' id='canton' onchange='changeCanton(this.value)' required>";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
echo"<option value=".$row['ID_CANTON'].">".$row['NOMBRE']."</option>";
}
echo "</select>";

?>
