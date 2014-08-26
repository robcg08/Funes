<!DOCTYPE html>
<html>

    <head>
        <script>

            function loadXMLDoc(nombre,filtro)
            {
                var url = "nombre="+nombre+"&filtro="+filtro;

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
                xmlhttp.open("POST","ajax_persona.php",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send(url);
            }
        </script>
        <meta charset="utf-8">
        <title>Consultas</title>
        <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oxygen:300,400' rel='stylesheet' type='text/css'>
        <link href="../CSS/consultas.css" rel="stylesheet" type="text/css">
        <link href="../CSS/head.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <header>
            <div class="navbar" >
                <div class="logo">
                    <img class="img" src="../img/logo.png">
                </div>
                <div class="links">
                    <ul class="nav">
                        <li>
                            <a href="../Consultas/consultas_personas.php">Personas</a>
                        </li>
                        <li>
                            <a href="../Consultas/consultas_entidades.php">Entidades</a>
                        </li>
                        <li>
                            <a href="../Consultas/consultas_categoria_persona.php">Persona Categorías</a>
                        </li>
                        <li>
                            <a href="../Consultas/consultas_categorias.php">Categorías</a>
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
                                <li class="perfil"><a href="../Perfil/perfil.php">Mi perfil</a></li>
                                <li><a href="../logout.php">Salir</a></li>
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
                        <div class="myDiv">
                            <?php
                                $conn = oci_connect('fm', 'fm', 'localhost/funar','AL32UTF8');
                                if (!$conn) {
                                    $e = oci_error();
                                    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                                }
                                $stid = oci_parse($conn, "SELECT nombre from categoria");
                                oci_execute($stid);

                                echo "
                                                                    <table border='1'>
                                                                    <tr>
                                                                      <th>Nombre</th>
                                                                    </tr>";

                                while (($fila = oci_fetch_array($stid, OCI_ASSOC))) {

                                    echo "<tr>\n";
                                    echo "<td>" . $fila['NOMBRE'] . "</td>\n";
                                    echo "</tr>\n";

                                }
                                echo "</table>";
                            ?>
                            <a href='../Registros/registroCategorias.php' >
                               <input class="btnRegistrar"  type="button" value="Registrar Categoría" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </body>

</html>
