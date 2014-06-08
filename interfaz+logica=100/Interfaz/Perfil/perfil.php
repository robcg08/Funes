<?php

$conn = oci_connect('fm', 'fm', 'localhost/funar');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$usuario = "adcube";
$stid = oci_parse($conn, "select usuario.usuario, persona.nombre, persona.primer_apellido, persona.segundo_apellido, usuario.pass, usuario.privado
                        from usuario inner join persona
                        on usuario.cedula = persona.cedula
                        where usuario.usuario = '".$usuario."'");

oci_execute($stid);

$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

?>


<!DOCTYPE html>

<html>
    <head>

        <script type="text/javascript">

        var user = "<?php echo $usuario; ?>"

         function entidad(usuario)
            {
                var url = "usuario="+usuario;

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
                xmlhttp.open("POST","ajax_review.php",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send(url);
            }
        function persona(usuario)
            {
                var url = "usuario="+usuario;

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
                xmlhttp.open("POST","ajax_review_persona.php",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send(url);
            }

        </script>
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
                            <form class="formMiPerfil" action="actualizar_usuario.php" method = "post">
                                <div>
                                    <p>Nombre</p>
                                    <?php
                                    echo"<input type='text' name = 'nombre' id = 'nombre' value = '".$row['NOMBRE']."' required>";
                                    ?>
                                </div>
                                <div>
                                    <p>Apellido</p>
                                    <?php
                                    echo"<input type='text' name = 'apellido1' id = 'apellido1' value = '".$row['PRIMER_APELLIDO']."' required>";
                                    ?>
                                </div>
                                <div>
                                    <p>Segundo Apellido</p>
                                    <?php
                                    echo"<input type='text' name = 'apellido2' id = 'apellido2' value = '".$row['SEGUNDO_APELLIDO']."' required>";
                                    ?>
                                </div>
                                <div>
                                    <p>Contraseña</p>
                                    <?php
                                    echo"<input type='text' name = 'pass' id = 'pass' value = '' required>";
                                    ?>
                                </div>
                                <div class="datos">
                                    <p>Datos Privados (Nombre de usuario)</p>
                                    <?php
                                    if ($row['PRIVADO'] == "si") {
                                        echo"<input id='datosPrivados' type='radio' name='datosPrivados' value='si' checked>";
                                        echo"<label for='si'>SI</label>";
                                        echo"<input id='datosPrivados' type='radio' name='datosPrivados' value='no'>";
                                        echo"<label for='no'>NO</label>";
                                    }
                                    else{
                                        echo"<input id='datosPrivados' type='radio' name='datosPrivados' value='si'>";
                                        echo"<label for='si'>SI</label>";
                                        echo"<input id='datosPrivados' type='radio' name='datosPrivados' value='no' checked>";
                                        echo"<label for='no'>NO</label>";
                                    }
                                    ?>
                                </div>
                                <div class="submit">
                                    <input type="submit" class="btnRegistrar" value="Actualizar">
                                </div>
                            </form>
                        </div>
                        <div class="reviews">
                            <div class="reviews2">
                                <input type="button" class="btnRegistrar" onclick="entidad(user)" value="entidad">
                                <input type="button" class="btnRegistrar" onclick="persona(user)" value="persona">
                                <h1>Mis reviews</h1>
                                <div id="myDiv"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
