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
                            <div class="submit">
                                <input type="submit" class="btnRegistrar" value="Registrar">
                            </div>
                        </form>
                        <div class="categorias">
                            <h1>Categorías Registradas</h1>
                        </div>
                        <?php
                        $stid = oci_parse($conn, "SELECT consultas.get_categorias(1) AS mfrc FROM dual");
                        oci_execute($stid);

                        echo "
                          </form>
                          <table border='1'>
                          <tr>
                            <th>Categoria</th>
                          </tr>";

                          while (($fila = oci_fetch_array($stid, OCI_ASSOC))) {
                              $rc = $fila['MFRC'];
                              oci_execute($rc);
                              while (($fila_rc = oci_fetch_array($rc, OCI_ASSOC))) {
                                  echo "<tr>\n";
                                  echo "<td>" . $fila_rc['NOMBRE'] . "</td>\n";
                                  echo "</tr>\n";
                              }
                              oci_free_statement($rc);
                          }
                          echo "</table>";

                        ?>                       <!-- mostrar una tabla con las categorias registradas -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</body>

</html>
