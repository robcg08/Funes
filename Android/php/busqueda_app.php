<!DOCTYPE html>
    <?php
        $conn = oci_connect('fm', 'fm', 'localhost/funar');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $modo = $_POST['modo'];
        $bus = $_POST['busqueda'];
        $col = $_POST['columna'];

        if ($modo == "Persona"){
            $pk = "CEDULA";
        } else {
            $pk = "ID_ENTIDAD";
        }

        echo "$modo/$bus/$col/$pk";

        $stid = oci_parse($conn, "SELECT ". $pk . " FROM ". $modo . " where " . $col . "= '" . $bus . "'");
        oci_execute($stid);

        echo "primer execute-";

        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){

            echo"Segundo execute";
            $cedula = $row[$pk];
            echo "$cedula/";

            $stid1 =  oci_parse($conn, "select review_". $modo .".usuario,review.calificacion,review.review,review.evidencia from review_". $modo ." inner join review on review_". $modo .".id_review = review.id_review where review_". $modo . "." .$pk . "= " .$cedula); // PERSONA
            oci_execute($stid1);

            $row1 = oci_fetch_array($stid1, OCI_ASSOC+OCI_RETURN_NULLS);
            $review = $row1['REVIEW'];
            echo "$review+";
        }
    ?>
