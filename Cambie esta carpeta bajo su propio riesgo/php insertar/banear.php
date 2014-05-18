<?php

$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$usuario = "adcubero";


$stid = oci_parse($conn, "insert into ban(id_ban, usuario) values (s_ban.nextval, :u)");

oci_bind_by_name($stid, ':u', $usuario);

//oci_execute($stid);


$stid = oci_parse($conn, 'begin :result := get_reportes(:u);end;');
oci_bind_by_name($stid, ':u', $usuario);
oci_bind_by_name($stid, ':result', $result, 40);

oci_execute($stid);

$reportes = $result;

$reportes = $reportes+1;

echo $reportes;

$stid = oci_parse($conn, "UPDATE usuario SET reportes = ".$reportes." WHERE usuario = :u ;");

oci_bind_by_name($stid, ':u', $usuario);

oci_execute($stid);


echo "listo";


?>
