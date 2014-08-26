
<?php
    $conn = oci_connect('fm', 'fm', 'localhost/funar');
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    $usuario = $_POST['usuario'];



    $id=$usuario;
    $stid = oci_parse($conn, "select review.review,review.calificacion
                                from review
                                    inner join review_entidad
                                    on review_entidad.id_review = review.id_review
                                where review_entidad.usuario ='".$id."'");

    oci_execute($stid);
    echo "<ul>";
    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){

        echo "<li>";
        echo "<div class='calf'>";
        echo  "<div class='rateit' id='rateReview' data-rateit-max='10' data-rateit-readonly='true' data-rateit-value=".$row['CALIFICACION']."></div>";
        echo "</div>";
        echo "<div class='usuario'>";
        echo "<h3>".$row['CALIFICACION']."</h3>";
        echo "</div>";
        echo "<div class='comentario'>";
        echo "<p>".'"'.$row['REVIEW'].'"'."</p>";
        echo "</div>";

        echo "</li>";

    }
    echo "</ul>";
    echo "<div class='rateit'></div>";
?>
