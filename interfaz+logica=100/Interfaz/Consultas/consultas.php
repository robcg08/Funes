
<!DOCTYPE html>
<html>
<?php
    session_start();
    if (!isset($_SESSION['usuario'])){
        header("location:../index.php");
    }


?>
<head>
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
                            <a href="#">Persona Categorias</a>
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
                    <div class="divForm">
                        <form class="formConsultas">
                            <div class="nom">
                                <p>Nombre</p>
                                <input type="text">
                            </div>
                            <div class="tipo">
                                <select></select>
                            </div>

                            <div class="submit">
                                <input type="submit" class="btnConsultas" value="Consultar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
