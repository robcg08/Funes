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

        <script>

            var categorias = new Array();

            function showUser(str)
            {
            var url = "persona_categoria.php?q="+str;
            if (str=="")
              {
              document.getElementById("txtHint").innerHTML="";
              return;
              }
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
                document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
                }
              }
            xmlhttp.open("GET",url,true);
            xmlhttp.send();
            }

            function masmas (str){
                var q = false;
                for(var i=0; i<categorias.length; i++) {
                    if (categorias[i] == str) {
                        q = true
                    }
                }
                if (q == true) {
                    var myjson = JSON.stringify(categorias);
                    showUser(myjson);
                }
                else{
                    categorias.push(str);
                    var myjson = JSON.stringify(categorias);
                    showUser(myjson);
                }

            }
            function menosmenos (){
                categorias.pop();
                var myjson = JSON.stringify(categorias);
                showUser(myjson);
            }

            function send_array(){document.persona.categorias.value = categorias.toString();}

        </script>

        <meta charset="utf8">
        <title>Registro de Personas</title>
        <link href="/funes/Interfaz/CSS/registroPersonas.css" type="text/css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oxygen:300,400' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <section>
            <div class="containerBody">
                <div class="mainBody">
                    <div class="divRegistro">
                        <h1>Registro de Personas</h1>
                        <div class="divForm">
                            <form name = "persona" class="formRegistroPersonas" onSubmit='send_array()' action="insertar_persona_usuario.php" method="post">
                                <input name='categorias' type='hidden' value=''>
                                <div>
                                    <p>Nombre</p>
                                    <input type="text" name = "nombre" id="nombre">
                                </div>
                                <div>
                                    <p>Primer Apellido</p>
                                    <input type="text" name = "apellido" id="apellido">
                                </div>
                                <div>
                                    <p>Segundo Apellido</p>
                                    <input type="text"name = "segundoApellido" id="segundoApellido">
                                </div>
                                <div>
                                    <p>Cédula</p>
                                    <input type="text" name = "cedula" id="cedula">
                                </div>
                                <div>
                                    <p>Lugar de trabajo</p>
                                    <input type="text" name = "lugarTrabajo" id="lugarTrabajo">
                                </div>
                                <div>
                                    <p>Cargo</p>
                                    <input type="text" name = "cargo" id="cargo">
                                </div>
                                <div>
                                    <p>Género</p>
                                    <select name = "genero" id="genero">
                                        <option>M</option>
                                        <option>F</option>
                                    </select>
                                </div>
                                <div>
                                    <p>Fecha de Nacimiento</p>
                                    <input type="date" name = "fecha" id="fecha">
                                </div>
                                <div>
                                  <p>Categoría</p>
                                  <?php

                                  $stid = oci_parse($conn, "select * from categoria");

                                  oci_execute($stid);

                                  echo "<select name = 'categoria' id='categoria' onchange='masmas(this.value)'>";
                                  while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                    echo"<option value=".$row['ID_CATEGORIA'].">".$row['NOMBRE']."</option>";
                                  }
                                  echo "</select>";
                                  ?>
                                  <input type="button" value="--" onclick="menosmenos()">
                                </div>
                                <div id="txtHint"><b></b></div>
                                <div class="submit">
                                    <input type="submit" class="btnRegistrar" value="Registrar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
    <footer>

    </footer>
</html>
