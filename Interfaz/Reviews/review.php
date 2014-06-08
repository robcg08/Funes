<!DOCTYPE html>
<html>
    <?php
        $conn = oci_connect('fm', 'fm', 'localhost/funar');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
    ?>
    <head>
        <meta charset="utf-8">
        <title>Reviews</title>
        <link href="/funes/Interfaz/CSS/reviews.css" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oxygen:300,400' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
        <script src="../libs/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="/funes/Interfaz/libs/rate/src/jquery.rateit.js" type="text/javascript"></script>
        <link href="/funes/Interfaz/libs/rate/src/rateit.css" rel=stylesheet type="text/css">
        <link href="/funes/Interfaz/libs/qtip/jquery.qtip.css" rel="stylesheet" type="text/css">
        <link href="/funes/Interfaz/CSS/pruebaHover.css" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Marcellus+SC' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
        <script src="/funes/Interfaz/libs/qtip/jquery.qtip.js" type="text/javascript"></script>
        <script src="../scripts/script.js" type="text/javascript"></script>
        <link href="../CSS/head.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <header>
            <div class="navbar" >
                <div class="logo">
                    <h1>LOGO</h1>
                </div>
                <div class="links">
                    <ul class="nav">
                        <li>
                            <a href="#">Personas</a>
                        </li>
                        <li>
                            <a href="#">Entidades</a>
                        </li>
                        <li>
                            <a href="#">Categorias</a>
                        </li>
                        <li class="search">
                            <form class="formSearch" role="search">
                                <input type="text" class="txtBuscar" placeholder="Buscar">
                                <input type="submit" class="btnBuscar" value="">
                            </form>
                        </li>

                        <li class="editar">
                            <img src="../img/settings.svg">
                            <ul class="subEditar">
                                <li class="perfil"><a href="#">Mi perfil</a></li>
                                <li><a href="#">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <section>
            <div class="containerBody">
                <div class="mainBody">
                    <div class="divRegistro">
                        <div class="pruebaReview">
                            <div class="calificarTxt">
                                <h1>Entidad</h1>
                            </div>
                            <div class="entidad">
                                <div class="name">
                                    <?php
                                        $id = 1;
                                        $stid2 = oci_parse($conn, 'begin :result := get_nom_entidad(:idd); end;');
                                        oci_bind_by_name($stid2, ':idd', $id);

                                        oci_bind_by_name($stid2, ':result', $result, 40);
                                        oci_execute($stid2);
                                        echo "<a class='prueba' href='#'>".$result."</a>";
                                    ?>

                                </div>
                                <div class="rate">
                                    <?php

                                        $stid2 = oci_parse($conn, 'begin :result := get_promedio_reviews_entidad(:idd); end;');
                                        oci_bind_by_name($stid2, ':idd', $id);

                                        oci_bind_by_name($stid2, ':result', $result4, 40);
                                        oci_execute($stid2);
                                        echo "<div id='rateid1' class='rateit' data-rateit-step='0.5' data-rateit-max=10 data-rateit-readonly='true' data-rateit-value=".$result4."></div>"

                                    ?>
                                </div>
                                <div class="total">
                                    <?php
                                        $stid2 = oci_parse($conn, 'begin :result := get_total_reviews_entidad(:idd); end;');
                                        oci_bind_by_name($stid2, ':idd', $id);

                                        oci_bind_by_name($stid2, ':result', $result3, 40);
                                        oci_execute($stid2);

                                        echo "<p>(".$result3." "."ratings)</p>";
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="reviews">
                            <div class="left">
                                <div class="calfProm">
                                    <h1>
                                        <?php
                                            echo "<b>".$result4."</b>";
                                        ?>

                                    </h1>
                                    <p>avg of
                                        <span>
                                            <?php
                                                echo "<b>".$result3."</b>";
                                            ?>
                                        </span>
                                        ratings
                                    </p>
                                </div>
                            </div>

                            <div class="right">
                                <div class="horizontalBars">
                                    <table class="Bars">
                                        <?php

                                            for ($i = 10; $i >= 1; $i--) {
                                                $stid2 = oci_parse($conn, "begin :result := get_clasificacion_entidad(:c,:id);  end;");
                                                oci_bind_by_name($stid2, ':c', $i);
                                                oci_bind_by_name($stid2, ':id', $id);
                                                oci_bind_by_name($stid2, ':result', $result2, 40);
                                                oci_execute($stid2);

                                                echo "<tr>";
                                                echo "<td>",$i,"<span>★</span>","</td>";
                                                echo "<td>","<svg width='100' height='10'>",
                                                "<rect x='0' y='0' width='".$result2."' height='10' fill='#006cff' />",

                                                "</svg>";
                                                echo "</td>";

                                                echo "<td>";
                                                echo $result2;
                                                echo "</td>";
                                            }
                                        ?>
                                    </table>

                                </div>
                            </div>

                        </div>

                        <div class="calificar">
                            <div class="calificarTxt">
                                <h1>Calificar | Reportar</h1>
                            </div>
                            <div class="calificar2">
                                <?php
                                    $usuarioActual = "juan112";
                                    $stid = oci_parse($conn,"select review_entidad.usuario
                                                            from review_entidad
                                                            inner join review
                                                            on review_entidad.id_review = review.id_review
                                                            where review_entidad.id_entidad =".$id);
                                    oci_execute($stid);
                                    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){

                                        if($row['USUARIO'] == $usuarioActual){


                                            echo "<script type='text/javascript'>";
                                            echo "$(function (){ $('.btnCalificar').css('background','grey');
                                            $('.btnCalificar').hover(function(){
                                            $(this).css('cursor','default')});
                                            $('.formCalificar').get(0).setAttribute('action', '#');
                                            });";
                                            echo "</script>";
                                        }

                                      }
                                ?>


                                <form action="calificar.php" class="formCalificar">
                                    <input type="submit" class="btnCalificar" value="Calificar">
                                </form>
                                <form action="reportar.php" class="formCalificar">
                                    <input type="submit" class="btnReportar" value="Reportar">
                                </form>
                            </div>
                        </div>

                        <div class="calificaciones">
                            <div class="calificacionesTxt">
                                <h1>Calificaciones</h1>
                            </div>
                            <div class="calificaciones2">
                                 <?php

                                      $stid = oci_parse($conn, "select review_entidad.usuario,review.calificacion,review.review,review.evidencia
                                                                from review_entidad
                                                                inner join review
                                                                on review_entidad.id_review = review.id_review
                                                                where review_entidad.id_entidad =".$id);

                                      oci_execute($stid);
                                    echo "<ul>";
                                      while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){

                                        echo "<li>";
                                        echo "<div class='calf'>";
                                        echo  "<div class='rateit' id='rateReview' data-rateit-max='10' data-rateit-readonly='true' data-rateit-value=".$row['CALIFICACION']."></div>";
                                        echo "</div>";
                                        echo "<div class='usuario'>";
                                        echo "<h3>".$row['USUARIO']."</h3>";
                                        echo "</div>";
                                        echo "<div class='comentario'>";
                                        echo "<p>".'"'.$row['REVIEW'].'"'."</p>";
                                        echo "</div>";
                                        echo "<div class='evidencia'>";
                                        echo "<p>Evidencia</p>";
                                        if ($row['EVIDENCIA'] == null){
                                            echo  "<p class='noDisp'>NO DISPONIBLE</p>";
                                        }else{
                                            echo "<form action='ver_evidencia.php' method = 'post' enctype='multipart/form-data'>";
                                            echo "<input type='text' class='txtFile' name='uploaded_file1' value=".$row['EVIDENCIA'].">";
                                            echo  "<input type='submit' class='btnEvidencia' value='Ver'>";
                                            echo "</form>";
                                        }
                                        echo "</div>";
                                        echo "</li>";

                                      }
                                      echo "</ul>";
                                    ?>
                            </div>
                        </div>
                        <div class="divForm">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>

</html>
