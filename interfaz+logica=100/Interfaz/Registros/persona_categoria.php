<?php
$data = json_decode($_GET['q']);

$conn = oci_connect('fm', 'fm', 'localhost/funar','AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

for ($i=0; $i < sizeof($data); $i++) {
	$stid = oci_parse($conn, 'begin :result := get_nom_categoria(:c); end;');
	$categoriaINT = intval($data[$i]);
	oci_bind_by_name($stid, ':c', $categoriaINT);
	oci_bind_by_name($stid, ':result', $result, 100);

	oci_execute($stid);

	echo $result;

	echo " || ";


}
?>
