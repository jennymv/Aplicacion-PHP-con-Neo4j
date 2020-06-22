<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> COMISIONES PAREJAS </title>
        <link rel="stylesheet" type="text/css" href="../../css/estilo.css">
        <link rel="icon" type="image/png" href="../../logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="../../logo/LOGODEFINITIVO.png"/>
        <p id="titulop" style='margin-left: 300px;'> RESUMEN COMISIONES </p>
        
                <?php
                    //Realizamos la conexión.
                    require '../../../connection.php';
                    
                    //Incluimos las funciones.
                    require '../funcionesComisionesJaime.php';
                    
                    //Obtenemos los valores que nos vienen por el método GET.
                    $idPareja=$_GET['idPareja'];
                    
                    //Consulta para obtener las comisiones (necesario para las comisiones)
                    $consultaComisiones = 'MATCH (n:Comision) RETURN n';
                    //Devolvemos el resultado de la consulta de las comisiones y lo guardamos
                    //en una variable. ($resultadoComisiones)
                    $resultadoComisiones = $connection->sendCypherQuery($consultaComisiones)->getResult();
                    
                    $nodosComisiones = $resultadoComisiones->getNodes();
                    
                    $nodoComisiones = reset($nodosComisiones);
                    
                    $numeroNiveles = $nodoComisiones->getProperty('nNiveles');
                    $porcentajes = $nodoComisiones->getProperty('tipoPorcentaje');
                    
                    
                    
                    //Llamamos a la función que nos calcula las comisiones.
                    $comisiones = comisionesPorPareja($idPareja, $numeroNiveles, $porcentajes, $connection);
                    
                    //En caso de que no haya comisiones mostramos un mensaje.
                    if ($comisiones == NULL) {
                        echo "<center><p  id='pNoComisiones'> NO EXISTEN COMISIONES "
                        . "PARA ESTA PAREJA. </p></center>";
                        //En caso de que si haya...
                    } else {
                        //Construimos la tabla de las comisiones.
                        echo "<center><table id='tablaComisiones'>";
                            echo "<caption class='captionTablaC'> COMISIONES PARA LA PAREJA '"; echo $idPareja; echo "'"; echo "</caption>";
                            echo "<th class='tituloTablaC'> VESTIDO </th>";
                            echo "<th class='tituloTablaC'> COMISIÓN </th>";
                        foreach ($comisiones as $indice => $valor) {
                            echo "<tr>";
                            echo "<td>"; echo $indice; echo "</td>";
                            echo "<td>"; echo $valor; echo " €"; echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table></center>";
                      }
                ?>
       
        
        <div>
            <p style="text-align: center; margin-top: 30px; font-size: 20px"><a id="botonMenuPrincipal" href="parejas.php">VOLVER A PAREJAS</a><p>
        </div>
    </body>
</html>