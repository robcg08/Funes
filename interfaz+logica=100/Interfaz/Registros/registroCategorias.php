<?php
header('Content-Type: text/html; charset=UTF-8');
$conn = oci_connect('fm', 'fm', 'localhost/funar','AL32UTF8');
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
    <link href="../CSS/registroCategorias.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen:300,400' rel='stylesheet' type='text/css'>
    <script>
        function loadXMLDoc(categoria)
            {
                var url = "categoria="+categoria;

                var xmlhttp;
                if (window.XMLHttpRequest)
                  {// code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
                  }
                else
                  {// code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                  }
                xmlhttp.onreadystatechange=function()
                  {
                  if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
                    }
                  }
                xmlhttp.open("POST","ajax_nombre_categoria.php",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send(url);
            }
    function send(existe){
              if (existe == 1) {
                return true;
              }
              else{
                return false;
              }
            }

    </script>
</head>

<body>
    <header>

    </header>

    <body>
        <div class="containerBody">
            <div class="mainBody">
                <div class="divRegistro">
                    <h1 >Registro de Categorías</h1>
                    <div class="divForm">
                        <form class="formRegistroCategorias" name = "categoria" action="insertar_categoria.php" onsubmit = "return send(existe.value);" method="post">
                            <div>
                                <p>Nombre</p>
                                <input type="text" name = 'nombre' id='nombre' onkeyup="loadXMLDoc(nombre.value)">
                            </div>
                            <div id="myDiv"></div>
                            <div class="submit">
                                <input type="submit" class="btnRegistrar" value="Registrar">
                            </div>
                        </form>
                        <div class="categorias">
                        <div class="txtCategoria">
                            <h1 >Categorías Registradas</h1>
                        </div>
                        <div class="tablaCategorias">
                            <?php
                                $stid = oci_parse($conn, "SELECT consultas.get_categorias(1) AS mfrc FROM dual");
                                oci_execute($stid);

                                echo "
                                  </form>
                                  <table class='table' border='1'>
                                  <tr>
                                    <th>Categoría</th>
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

                            ?>
                        </div>
                        </div>
                                         <!-- mostrar una tabla con las categorias registradas -->
                    </div>
                    <?php
                        echo "<a href=".$_SERVER['HTTP_REFERER'].">";
                        echo    '<input type="button" class="btnRegistrar" value="Regresar">';
                        echo "</a>";
                    ?>
                </div>
            </div>
        </div>
    </body>
</body>

</html>
