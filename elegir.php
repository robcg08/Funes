<!DOCTYPE html>
    <?php
        $conn = oci_connect('fm', 'fm', 'localhost/funar');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $username = $_POST["username"];
        $password = $_POST["password"];
        $stid = oci_parse($conn, "SELECT * FROM usuario where usuario = '" . $username . "' and pass = '". $password . "'");
        oci_execute($stid);
        if ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
            
            $cedula = $row['CEDULA'];
            $nick = $row['NICK'];
            $priv = $row['PRIVADO'];
            $stid1 = oci_parse($conn, "SELECT * FROM persona where cedula = '" . $cedula ."'");
            oci_execute($stid1);
            $row1 = oci_fetch_array($stid1, OCI_ASSOC+OCI_RETURN_NULLS);
            $nombre = $row1['NOMBRE'];
            $ap = $row1['PRIMER_APELLIDO'];
            $ap2 = $row1['SEGUNDO_APELLIDO'];
            
            echo "$cedula/";
            echo "$nombre/";
            echo "$ap/";
            echo "$ap2/";
            echo "$nick/";
            echo "$priv";
            
         }
  ?>
