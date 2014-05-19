<!DOCTYPE html>
<html>

<head>
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
                    <form class="formRegistroUsuarios">
                        <div>
                            <p>Nombre de Usuario</p>
                            <input type="text">
                        </div>
                        <div>
                            <p>Contraseña</p>
                            <input type="password">
                        </div>
                        <div>
                            <p>Cédula</p>
                            <input type="text">
                        </div>
                        <div>
                            <p>Correo Electrónico</p>
                            <input type="text">
                        </div>
                        <div class="datos">
                            <p>Datos Privados (Nombre de usuario)</p>
                            <input id="si" type="radio" name="datosPrivados" value="si">
                            <label for="si">SI</label>
                            <input id="no" type="radio" name="datosPrivados" value="no">
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
