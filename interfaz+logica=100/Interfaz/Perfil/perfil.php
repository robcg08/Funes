

<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        <title>Mi perfil</title>
        <link href="../CSS/perfil.css" rel="stylesheet" type="text/css">
        <link href="../CSS/head.css" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oxygen:300,400' rel='stylesheet' type='text/css'>
        <script src="../libs/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="../libs/rate/src/jquery.rateit.js" type="text/javascript"></script>
        <link href="../libs/rate/src/rateit.css" rel="stylesheet" type="text/css">

        <?php
session_start();

    if (!isset($_SESSION['usuario'])){
        header("location:../index.php");
    }

$conn = oci_connect('fm', 'fm', 'localhost/funar','AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
//$usuario = "robcg08";
$usuario = $_SESSION['usuario'];
$stid = oci_parse($conn, "select usuario.usuario, persona.nombre, persona.primer_apellido, persona.segundo_apellido, usuario.pass, usuario.privado
                        from usuario inner join persona
                        on usuario.cedula = persona.cedula
                        where usuario.usuario = '".$usuario."'");

oci_execute($stid);

$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

?>

        <script type="text/javascript">

        var user = "<?php echo $usuario; ?>";
            console.log(user);
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
                                    echo"<input type='password' name = 'pass' id = 'pass' value = '".$row['PASS']."' required>";
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
                            <form action = 'borrar_perfil.php' method = 'post' >
                                    <?php
                                      echo"<input type='hidden'' name='user' id='user' value = '" .$_SESSION['usuario']. "'>";
                                    ?>
                                   <input type="submit" class="btnCerrarCuenta" value="Cerrar Cuenta">
                            </form>

                        <div class="reviews">
                            <div class="reviews2">
                               <h1>Mis reviews</h1>
                                <input type="button" class="btnRegistrarEntidad" value="entidad">
                                <input type="button" class="btnRegistrarPersona"  value="persona">

                                <script>
                                    $(function(){
                                        $(".btnRegistrarEntidad").click(
                                            function(){
                                                $(".persona").hide();
                                                $(".entidad").show();
                                            });
                                        $(".btnRegistrarPersona").click(
                                            function(){
                                                $(".entidad").hide();
                                                $(".persona").show();
                                            });
                                    });

                                </script>

                                <div class="entidad">
                                    <?php
                                        $id=$usuario;
                                        $stid = oci_parse($conn, "select review.review,review.calificacion,review.id_review
                                                                    from review
                                                                        inner join review_entidad
                                                                        on review_entidad.id_review = review.id_review
                                                                    where review_entidad.usuario ='".$id."'");

                                        oci_execute($stid);
                                        echo "<ul>";
                                        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){

                                            echo "<li>";
                                            echo "<div class='calf'>";
                                            echo  "<div class='rateit' id='rateReview' data-rateit-max='10' data-rateit-readonly='true' data-rateit-value=".$row['CALIFICACION']."></div>";
                                            echo "</div>";

                                            echo "<div class='comentario'>";
                                            echo "<p>".'"'.$row['REVIEW'].'"'."</p>";
                                            echo "</div>";
                                            echo "<div class='usuario'>";
                                            echo "
                                                <form action = '../Reviews/borrar_review.php' method = 'post'>
                                                <input type = hidden name='id' id='id'  value='".$row['ID_REVIEW']."'>
                                                <input  class='btnBorrar' type = 'submit' value = 'Borrar'>
                                                </form>
                                            ";
                                            echo "</div>";
                                            echo "</li>";

                                        }
                                        echo "</ul>";

                                    ?>

                                </div>
                                <div class="persona">
                                    <?php
                                        $id=$usuario;
                                        $stid = oci_parse($conn, "select review.review,review.calificacion,review.id_review
                                                                    from review
                                                                        inner join review_persona
                                                                        on review_persona.id_review = review.id_review
                                                                    where review_persona.usuario ='".$id."'");

                                        oci_execute($stid);
                                        echo "<ul>";
                                            while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){

                                                echo "<li>";
                                                echo "<div class='calf'>";
                                                echo  "<div class='rateit' id='rateReview' data-rateit-max='10' data-rateit-readonly='true' data-rateit-value=".$row['CALIFICACION']."></div>";
                                                echo "</div>";
                                                echo "<div class='comentario'>";
                                                echo "<p>".'"'.$row['REVIEW'].'"'."</p>";
                                                echo "</div>";
                                                echo "<div class='usuario'>";
                                                echo "
                                                <form action = '../Reviews/borrar_review_usuario.php' method = 'post'>
                                                <input type = hidden name='id' id='id'  value='".$row['ID_REVIEW']."'>
                                                <input class='btnBorrar' type = 'submit' value = 'Borrar'>
                                                </form>
                                                    ";
                                                echo "</div>";
                                                echo "</li>";

                                            }
                                        echo "</ul>";

                                        ?>


                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
