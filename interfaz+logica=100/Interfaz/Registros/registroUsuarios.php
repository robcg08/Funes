<!DOCTYPE html>
<html>

<head>


    <script>
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
        xmlhttp.open("POST","verificar_cedula.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send(url);
    }
    </script>



    <meta charset="utf8">
    <title>Registro de Usuario</title>
    <link href="/funes/Interfaz/CSS/registroUsuarios.css" type="text/css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen:300,400' rel='stylesheet' type='text/css'>
</head>

<body>
    <section>
        <div class="mainBody">
            <div class="divRegistro">
                <h1>Registro de Usuario</h1>
                <div class="divForm">
                    <form class="formRegistroUsuarios" action="insertar_usuario.php" method="post">
                        <div>
                            <p>Nombre de Usuario</p>
                            <input type="text" name = "usuario" id = "usuario">
                        </div>
                        <div>
                            <p>Contraseña</p>
                            <input type="password" name = "pass" id = "pass">
                        </div>
                        <div>
                            <p>Cédula</p>
                            <input type="text" name = "cedula" id = "cedula">
                            <input type="button" value="ver si ya esta registrado" onclick = "loadXMLDoc(cedula.value)">
                        </div>
                        <div id="myDiv"></div>
                        <div class="datos">
                            <p>Datos Privados (Nombre de usuario)</p>
                            <input id="datosPrivados" type="radio" name="datosPrivados" value="si">
                            <label for="si">SI</label>
                            <input id="datosPrivados" type="radio" name="datosPrivados" value="no">
                            <label for="no">NO</label>
                        </div>

                        <div class="submit">
                            <input type="submit" class="btnRegistrar" value="Registrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
