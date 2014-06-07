<!DOCTYPE html>
<html>

<head>
    <script>

            function loadXMLDoc(nombre)
            {
                var url = "nombre="+nombre;

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
                xmlhttp.open("POST","ajax_categoria_persona.php",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send(url);
            }
    </script>
    <meta charset="utf-8">
    <title>Consultas</title>
    <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen:300,400' rel='stylesheet' type='text/css'>
    <link href="../CSS/consultas.css" rel="stylesheet" type="text/css">
</head>

<body>
    <section>
        <div class="containerBody">
            <div class="mainBody">
                <div class="divRegistro">
                    <div class="divForm">
                        <form class="formConsultas">
                            <div class="nom">
                                <p>Buscar Persona por Categoria</p>
                                <input type="text" name = "nombre" id = "nombre">
                            </div>
                            <div class="tipo">
                            </div>

                            <div id="myDiv"></div>

                            <div class="submit">
                                <input type="button" class="btnConsultas" value="Consultar" onclick="loadXMLDoc(nombre.value)">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
