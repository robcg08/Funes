<?php
$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registro de Categorías</title>
    <link href="/funes/Interfaz/CSS/registroCategorias.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen:300,400' rel='stylesheet' type='text/css'>
</head>

<body>
    <header>

    </header>

    <body>
        <div class="containerBody">
            <div class="mainBody">
                <div class="divRegistro">
                    <h1>Registro de Categorías</h1>
                    <div class="divForm">
                        <form class="formRegistroCategorias" action="insertar_categoria.php" method="post">
                            <div>
                                <p>Nombre</p>
                                <input type="text" name = 'nombre' id='nombre'>
                            </div>
                             <div>
                                  <p>Tipo Categoría</p>
                                  <?php

                                  $stid = oci_parse($conn, "select * from tipo_categoria");

                                  oci_execute($stid);

                                  echo "<select name = 'tipo_categoria' id='tipo_categoria' >";
                                  while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                    echo"<option value=".$row['ID_TIPO_CATEGORIA'].">".$row['NOMBRE']."</option>";
                                  }
                                  echo "</select>";
                                  ?>
                                  <input type="button" value="--" onclick="menosmenos()">
                                </div>
                            <div class="submit">
                                <input type="submit" class="btnRegistrar" value="Registrar">
                            </div>
                        </form>
                        <div class="categorias">
                            <h1>Categorías Registradas</h1>
                        </div>
                        <!-- mostrar una tabla con las categorias registradas -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</body>

</html>
