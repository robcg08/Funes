<?php
$conn = oci_connect('fm', 'fm', 'localhost/funar','AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <script src="../libs/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script>
            var categorias = new Array();

            function loadXMLDoc(cedula)
            {
                var url = "cedula="+cedula;

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
                xmlhttp.open("POST","verificar_cedula_simple.php",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send(url);
            }

             function fechaa(fecha)
            {
                var url = "fecha="+fecha;

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
                    document.getElementById("fecha").innerHTML=xmlhttp.responseText;
                    }
                  }
                xmlhttp.open("POST","test_edad.php",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send(url);
            }

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
            function send(existe){
              if (existe == 1) {
                document.persona.categorias.value = categorias.toString();
                return true;
              }
              else{
                return false;
              }
            }

            $(function(){
                masmas($('#categoria').val());
            });
        </script>

        <meta charset="utf-8">
        <title>Registro de Personas</title>
        <link href="../CSS/registroPersonas.css" type="text/css" rel="stylesheet">
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
                            <form name = "persona" class="formRegistroPersonas" onsubmit = "return send(existe.value);" action="insertar_persona_usuario.php" method="post">
                                <input name='categorias' type='hidden' value=''>
                                <div>
                                    <p>Nombre</p>
                                    <input type="text" name = "nombre" id="nombre" required>
                                </div>
                                <div>
                                    <p>Primer Apellido</p>
                                    <input type="text" name = "apellido" id="apellido" required>
                                </div>
                                <div>
                                    <p>Segundo Apellido</p>
                                    <input type="text"name = "segundoApellido" id="segundoApellido" required>
                                </div>
                                <div>
                                    <p>Cédula</p>
                                    <input type="text" name = "cedula" id="cedula" maxlength="9" onkeyup="loadXMLDoc(cedula.value)" required>
                                </div>
                                <div id="myDiv"></div>
                                <div>
                                    <p>Lugar de trabajo</p>
                                    <input type="text" name = "lugarTrabajo" id="lugarTrabajo" required>
                                </div>
                                <div>
                                    <p>Cargo</p>
                                    <input type="text" name = "cargo" id="cargo" required>
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
                                    <input type="date" name = "fecha" id="fecha"  required>
                                </div>
                                <div id="fechaa"></div>
                                <div class="categorias">
                                  <p>Categoría</p>
                                  <?php

                                  $stid = oci_parse($conn, "select * from categoria");

                                  oci_execute($stid);

                                  echo "<select name = 'categoria' class='selCategoria' id='categoria' onchange='masmas(this.value)' required>";
                                  while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                    echo"<option value=".$row['ID_CATEGORIA'].">".$row['NOMBRE']."</option>";
                                  }
                                  echo "</select>";
                                  ?>
                                  <input type="button" class="btnMenos" value="-" onclick="menosmenos()">
                                  <br>
                                  <div class="catSel">
                                      <p>Categorías Seleccionadas</p>
                                      <div id="txtHint">

                                      <b></b></div>

                                        <a href='../Registros/registroCategorias.php'> Registrar Categoría</a>
                                    </div>
                                </div>
                                <div class="submit">
                                    <input type="submit" class="btnRegistrar" value="Registrar">
                                </div>
                            </form>
                        </div>
                        <?php
                            echo "<a href='../Consultas/consultas_personas.php'>";
                            echo    '<input type="button" class="btnRegistrar" value="Regresar">';
                            echo "</a>";
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </body>
    <footer>

    </footer>
</html>
