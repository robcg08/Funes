<?php
error_reporting(E_ERROR | E_PARSE);

$canton = $_POST['canton'];

$conn = oci_connect('fm', 'fm', 'localhost/funar','AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$stid = oci_parse($conn, "select id_distrito, nombre from distrito where id_canton = ".$canton."order by id_distrito");

oci_execute($stid);

echo "
<p>Distrito</p>
<select name = 'distrito' id='distrito' onchange='changeDistrito(this.value)' required>";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
echo"<option value=".$row['ID_DISTRITO'].">".$row['NOMBRE']."</option>";
}
echo "</select>";

?>
