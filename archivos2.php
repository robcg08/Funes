<!DOCTYPE html>
<html>    
    <body>
        <form name = "paci" action="archivos.php" method="post">
        <?php

            // CONECTARSE A LA BASE DE DATOS

            // VERIFICA SI EFECTIVAMENTE SE SUBE ALGUN ARCHIVO
            if((!empty($_FILES["uploaded_file1"])) && ($_FILES['uploaded_file1']['error'] == 0)) {
                
                $filename = basename($_FILES['uploaded_file1']['name']); // NOMBRE DEL ARCHIVO
                
                $ext = substr($filename, strrpos($filename, '.') + 1); // EXTENSION DEL ARCHIVO
            
                $newname = ''.$filename;
                        if ((move_uploaded_file($_FILES['uploaded_file1']['tmp_name'],$newname))) {
                            //echo "It's done! The file has been saved as: ".$newname;
                            echo "EL ARCHIVO fue Procesado Satisfactoriamente !!!!!";
                            
                            if ($ext == "jpg" || $ext == 'JPG'){ 
                                echo '<img src="'.$filename.'" height="100" width="100">',"<br>";
                            } 
                            
                            if ($ext == "txt" || $ext == 'TXT'){
                                $f = fopen($filename, "r");
                                while ($line = fgets($f)) {
                                    echo "$line<br/>";
                                }
                                echo "<br/>";
                            }
                                                        
                        } else {
                            echo "Error: Ocurrio un Problema al Subir el Archivo!";
                        }
            } else {
                echo "Error: El Archivo no pudo ser Guardado";
            } 
            echo '<br>';
        ?>
        <input type="submit" value="Regresar">
        </form> 
    </body>
</html>
