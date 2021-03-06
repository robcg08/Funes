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

            function send_array(){document.entidad.categorias.value = categorias.toString();}

        function changePais(pais)
        {
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
            document.getElementById("provincia1").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("POST","ajax_pais.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("pais="+pais);
        }

        function changeProvincia(provincia)
        {
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
            document.getElementById("canton").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("POST","ajax_provincia.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("provincia="+provincia);
        changeCanton(canton.value);
        }

        function changeCanton(canton)
        {
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
            document.getElementById("distrito").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("POST","ajax_canton.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("canton="+canton);
        changeDistrito(distrito.value);
        }

        function changeDistrito(distrito)
        {
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
            document.getElementById("barrio").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("POST","ajax_distrito.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("distrito="+distrito);
        }


        $(function(){
            $('#provincia').change(
                function(){
                    changeCanton($('#pais').val());
                });
            changePais($('#pais').val());
            changeProvincia($('#pais').val());
            changeCanton($('#pais').val());
            masmas($('#categoria').val());
            console.log(changePais($('#pais').val()));
        });
    </script>

    <meta charset="utf-8">
    <title>Registro de Entidades</title>
    <link href="../CSS/registroEntidades.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen:300,400' rel='stylesheet' type='text/css'>

</head>

<body>
    <section>
        <div class="containerBody">
            <div class="mainBody">
                <div class="divRegistro">
                    <h1>Registro de Entidades</h1>
                    <div class="divForm">
                        <form name = "entidad" class="formRegistroEntidades" onSubmit='send_array()' action="insertar_entidad.php" method="post">
                            <input name='categorias' type='hidden' value=''>
                            <div>
                                <p>Nombre</p>
                                <input type="text" name = "nombre" id="nombre" required>
                            </div>
                            <div>
                                <p>Cédula Jurídica</p>
                                <input type="text" name = "cedula" id="cedula" required>
                            </div>
                            <div>
                                  <p>Categoría</p>
                                  <?php

                                  $stid = oci_parse($conn, "select * from categoria");

                                  oci_execute($stid);

                                  echo "<select name = 'categoria' id='categoria' class='selCategoria' onchange='masmas(this.value)'>";
                                  while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                    echo"<option onselect='masmas(this.value)' value=".$row['ID_CATEGORIA'].">".$row['NOMBRE']."</option>";
                                  }
                                  echo "</select>";
                                  ?>
                                  <input type="button" class="btnMenos" value="-" onclick="menosmenos()">
                                  <br>

                                </div>
                                <div class="catSel">
                                <p>Categorías Seleccionadas</p>
                                  <div id="txtHint">

                                  <b></b></div>
                                  <div>
                                  <a href='../Registros/registroCategorias.php'> Registrar Categoria</a>
                                  </div>
                                </div>
                            <div class="dir">
                                <h2>Dirección</h2>
                            </div>
                            <div class="dir2">
                                <p>País</p>
                                <?php

                                  $stid = oci_parse($conn, "select * from pais");

                                  oci_execute($stid);

                                  echo "<select name = 'pais' id='pais' onchange='changePais(this.value)' required>";
                                  while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                    echo"<option value=".$row['ID_PAIS'].">".$row['NOMBRE']."</option>";
                                  }
                                  echo "</select>";

                                ?>

                                <div class="prov">
                                    <div class="provincia" id ="provincia1">

                                    </div>
                                    <div class="canton" id ="canton">


                                    </div>
                                </div>
                                <div class="dis">
                                    <div class="distrito" id ="distrito">


                                    </div>
                                    <div class="barrio" id ="barrio">


                                    </div>
                                </div>
                            </div>

                            <div class="submit">
                                <input type="submit" class="btnRegistrar" value="Registrar">
                            </div>
                        </form>
                    </div>
                    <div class="btnRegresar">
                        <?php
                            echo "<a href='../Consultas/consultas_entidades.php'>";
                            echo    '<input type="button" class="btnRegistrar" value="Regresar">';
                            echo "</a>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
