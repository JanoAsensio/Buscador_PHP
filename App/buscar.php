<?php
/*$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'ejemplo'
);

if (isset($conn)) {
    echo 'DB is connected';
}
*/

    $mysqli = new mysqli("localhost","root", "", "ejemplo");

    $salida = "";
    $query = "SELECT * FROM productos ORDER By Cod_producto";

    if(isset($_POST['consulta'])){
        $q = $mysqli->real_escape_string($_POST['consulta']);
        $query = "SELECT Cod_producto, Nombre, Marca, Modelo FROM productos WHERE Nombre LIKE '%".$q."%' OR Marca LIKE '%".$q."%' OR Modelo LIKE '%".$q."%'";
    }

    $resultado = $mysqli->query($query);

    if($resultado->num_rows > 0){

        $salida.="<table class='tabla_datos'>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Marca</td>
                            <td>Modelo</td>
                        </tr>
                    </thead>
                    <tbody>";

        while($fila = $resultado->fetch_assoc()){
            $salida.="<tr>
                    <td>".$fila['Cod_producto']."</td>
                    <td>".$fila['Nombre']."</td>
                    <td>".$fila['Marca']."</td>
                    <td>".$fila['Modelo']."</td>
            </tr>";
        }

        $salida.="</tbody></table>";

    } else{
        $salida.="No hay datos :(";
      }

    echo $salida;

    $mysqli->close();

?>