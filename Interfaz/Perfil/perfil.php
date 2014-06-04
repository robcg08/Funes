<!DOCTYPE html>


<html>
    <head>
        <meta charset="utf-8">
        <title>Mi perfil</title>
        <link href="../CSS/perfil.css" rel="stylesheet" type="text/css">
        <link href="../CSS/head.css" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oxygen:300,400' rel='stylesheet' type='text/css'>
        <script src="../libs/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="../libs/rate/src/jquery.rateit.js" type="text/javascript"></script>
        <link href="../libs/rate/src/rateit.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
            $conn = oci_connect('fm', 'fm', 'localhost/funar');
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }
        ?>
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
                        <h1>Mi Perfil</h1>

                        <div class="divForm">
                            <form class="formMiPerfil">
                                <div>
                                    <p>Nombre</p>
                                    <input type="text">
                                </div>
                                <div>
                                    <p>Apellido</p>
                                    <input type="text">
                                </div>
                                <div>
                                    <p>Segundo Apellido</p>
                                    <input type="text">
                                </div>
                                <div class="datos">
                                    <p>Datos Privados (Nombre de usuario)</p>
                                    <input id="si" type="radio" name="datosPrivados" value="si">
                                    <label for="si">SI</label>
                                    <input id="no" type="radio" name="datosPrivados" value="no">
                                    <label for="no">NO</label>
                                </div>
                                <div class="submit">
                                    <input type="submit" class="btnRegistrar" value="Actualizar">
                                </div>
                            </form>
                        </div>
                        <div class="reviews">
                            <div class="reviews2">
                                <h1>Mis reviews</h1>
                                <?php
                                    $id="juan11";
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
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
