<!DOCTYPE html>
<html>
    <head>
        <meta charset="iso-8859-9">
        <title>Evidencia</title>
        <link href="../CSS/ver_evidencia.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <section>
            <div class="containerBody">
                <div class="mainBody">
                    <div class="divRegistro">
                    <h1>Evidencia</h1>
                    <?php

                    echo '<form name = "paci" action='.$_SERVER['HTTP_REFERER'].' method="post">';


                            // CONECTARSE A LA BASE DE DATOS
                            $filename =$_POST["uploaded_file1"];
                            //$filename = basename($_FILES['uploaded_file1']['name']); // NOMBRE DEL ARCHIVO


                            // VERIFICA SI EFECTIVAMENTE SE SUBE ALGUN ARCHIVO


                                $ext = substr($filename, strrpos($filename, '.') + 1); // EXTENSION DEL ARCHIVO

                                $newname = ''.$filename;

                                            if ($ext == "jpg" || $ext == 'JPG'){
                                                echo "<object src=".$filename.">";
                                                    echo "<embed class='img' src=".$filename.">";
                                                    echo "</embed>";
                                                echo "</object>";

                                            }

                                            if ($ext == "txt" || $ext == 'TXT'){

                                                echo "<object  src=".$filename.">";
                                                    echo "<embed class='texto' src=".$filename.">";
                                                    echo "</embed>";
                                                echo "</object>";

                                            }

                                            if ($ext == "pdf" || $ext == 'PDF'){

                                                echo "<object  src=".$filename.">";
                                                    echo "<embed class='pdf' src=".$filename.">";
                                                    echo "</embed>";
                                                echo "</object>";

                                            }




                        echo '<input type="submit" class="btnRegresar" value="Regresar">';
                        echo "</form>";
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
