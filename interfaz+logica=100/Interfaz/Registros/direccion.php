<?php

$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$stid = oci_parse($conn, "select id_provincia, nombre from provincia where id_pais = 2");

oci_execute($stid);


$nrows = oci_fetch_all($stid, $res);

$nombre = $res['NOMBRE'];

$id =  $res['ID_PROVINCIA'];

print_r($id);

?>
