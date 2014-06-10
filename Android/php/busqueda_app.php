<!DOCTYPE html>
    <?php
        $conn = oci_connect('fm', 'fm', 'localhost/funar'); // Coneccion a la base de datos ('usuario', 'password', 'base d datos')
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $modo = $_POST['modo'];      // "Persona" o "Entidad"
        $bus = $_POST['busqueda'];  // Lo que se quiere buscar ya sea nombre apellidos cedula juridica...
        $col = $_POST['columna'];  // nombre de la columna en la cual se va a ver si hay coincidencia con $bus

        if ($modo == "Persona"){
            $pk = "CEDULA";                                           // PK de la tabla Persona
            $todo = ", nombre, primer_apellido, segundo_apellido ";  // columnas a seleccionar en el select
        } else {
            $pk = "ID_ENTIDAD";                      // PK de la tabla Entidad
            $todo = ", nombre ,cedula_juridica ";   // columnas a seleccionar en el select
        }

        $stid = oci_parse($conn, "SELECT ". $pk . $todo ."FROM ". $modo . " where " . $col . "= '" . $bus . "' order by nombre"); // select
        oci_execute($stid);                                                                                                      // Se ejecuta el select

        echo ">"; // separador con el "<!DOCTYPE html>"

        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
            // Por cada fila en la que hay coincidencia:

            $cedula = $row[$pk]; // llave primaria del dato que se encontro
            echo "$cedula ";    // se imprime con el separador " "

            if ($modo == "Persona"){
                $nombre = $row['NOMBRE'];          // Nombre de la persona
                $pap = $row['PRIMER_APELLIDO'];   // Primer apellido de la persona
                $sap = $row['SEGUNDO_APELLIDO']; // Segundo apellido de la persona
                echo "$nombre $pap $sap%";      // echo de variables separadas por " " y separadas por la siguiente fila por "%"
            } else {
                $nombre = $row['NOMBRE'];              // Nombre de la entidad
                $cedjud = $row['CEDULA_JURIDICA'];    // cedula juridica de la entidad
                echo "$nombre $cedjud%";             // echo de variables separadas por " " y separadas por la siguiente fila por "%"
            }
        }
    ?>
