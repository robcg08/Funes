<!DOCTYPE html>
<html>
    <?php
        session_start();
        if (isset($_SESSION['usuario'])){
            header("location:../Interfaz/Consultas/consultas_entidades.php");
        }
    ?>
    <head>
        <title>Inicio</title>
        <meta charset="utf-8">
        <link type="text/css" href="../Interfaz/CSS/index.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oxygen:300,400' rel='stylesheet' type='text/css'>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    </head>

    <body>
        <div class="container_body">
            <div class="main_body">

                <div class=divLogin>
                    <div class="titleIngresar">
                        <h1>Inicia Sesión</h1>
                    </div>
                </div>
                <div class=divLogin1>
                    <div class="divIngresar">

                        <form class="formLogin" method="post" action="index_singin.php">
                            <div>
                                <p>Usuario</p>
                                <input type="text" name="usuario" id="usuario"  required>
                            </div>
                            <div>
                                <p>Contraseña</p>
                                <input type="password" name="password" id = "usuario"  required>
                            </div>

                            <div>
                                <input class="btnIngresar" name="iniciar" type="submit" value="Ingresar">

                            </div>
                        </form>
                    </div>
                    <div class="divisor">
                        <div class="up"></div>
                        <div class="mid">
                            <span>O</span>
                        </div>

                        <div class="down"></div>
                    </div>
                    <div class="divRegistrarse">
                        <div>
                            <h1>Regístrate</h1>
                        </div>
                        <div class="divDoRegistro">
                            <span>Todavía no tienes una cuenta? Regístrate</span>
                            <div>
                                <a href="../Interfaz/Registros/registroUsuarios.php">
                                    <input class="btnRegistrarseUsuario" type="button" value="Registrarse Usuario">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>

</html>
