<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>COMPRAS</title>
        <link rel="stylesheet" type="text/css" href="../../css/estilo.css">
        <link rel="icon" type="image/png" href="../../logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="../../logo/LOGODEFINITIVO.png"/>
        <p id="titulop"> GESTIÓN DE COMPRAS </p>
        <div style="margin: 0 auto; width:700px; height: 400px; overflow-y:scroll;">
            <table id="tablaComisionesCompras">
  		<thead>
  			<th class="thCompras">idPareja</th>
  			<th class="thCompras">idVestido</th>
                        <th class="thCompras">Fecha Compra</th>
                        <th colspan="3"> 
                            <a href="./insertar/insertarCompra.php">
                                <img title="Añadir Compra" width='40px' height='40px' src='../../imagenes/botonAñadir.png'/>
                            </a> Insertar Compra 
                        </th>

  		</thead>
                <?php
                
                    //Realizamos la conexión
                    require '../../../connection.php';

                    //Consulta con la que vamos a trabajar.
                    $consulta = 'MATCH (n:Comision),(a:Pareja)-[r:Compra]->(b:Vestido) RETURN a,r,b,n';
                    
                    //Devolvemos el resultado de la consulta y lo guardamos en una variable.
                    $resultado = $connection->sendCypherQuery($consulta)->getResult();
                    
                    //Obtenemos el valor de la relación mediante get().
                    $compra = $resultado->get('r');
                    
                    
                    //Consulta para obtener los vestidos (necesario para las comisiones)
                    $consultaVestidos = 'MATCH (n:Vestido) RETURN n';
                    //Devolvemos el resultado de la consulta de los vestidos y lo guardamos
                    //en una variable. ($resultadoVestidos)
                    $resultadoVestidos = $connection->sendCypherQuery($consultaVestidos)->getResult();
                    //Obtenemos el valor de la propiedad idVestido mediante un foreach:
                    foreach ($resultadoVestidos->getNodes() as $nodosVestido) {
                        $nodosVestido->getProperty('idVestido');
                    }
                    
                    
                    //Consulta para obtener las comisiones (necesario para las comisiones)
                    $consultaComisiones = 'MATCH (n:Comision) RETURN n';
                    //Devolvemos el resultado de la consulta de las comisiones y lo guardamos
                    //en una variable. ($resultadoComisiones)
                    $resultadoComisiones = $connection->sendCypherQuery($consultaComisiones)->getResult();
                    //Obtenemos el valor de la propiedad idVestido mediante un foreach:
                    foreach ($resultadoComisiones->getNodes() as $nodosComisiones) {
                        $nodosComisiones->getProperty('nNiveles');
                        $tipoPorcentaje = $nodosComisiones->getProperty('tipoPorcentaje');
                    }
                    //Para el envío de un array utilizamos serialize que sirve para almacenar su valor.
                    $tipoPorcentaje = serialize($tipoPorcentaje);
                    
                    //Construimos la tabla
                    foreach ($compra as $com) {
                        echo "<tr>";
                            //Mediante getProperty llegamos a las propiedades del nodo
                            //que está almacenado en la variable.
                            echo "<td>"; echo ($com->getStartNode()->getProperty('idPareja')); echo "</td>";
                            echo "<td>"; echo ($com->getEndNode()->getProperty('idVestido')); echo "</td>";
                            echo "<td>"; echo ($com->getProperty('fecha')); echo "</td>";
                            
                            //Botones de modificar, eliminar y comisiones.
                            //Para poder llevar desde esta página a otra por el método
                            //get los datos, metemos las variables en la URL.
                            //Como en este caso tenemos que enviar varias variables,
                            //las separamos con &.
                            echo "<td style='border-right:none; border-left:none;'><a "
                                    . "href='./modificar/modificarCompra.php?idPareja=".$com->getStartNode()->getProperty('idPareja').
                                    "&idVestido=".$com->getEndNode()->getProperty('idVestido')."&fecha=".$com->getProperty('fecha')."'>"
                                    . "<img title='Modificar Compra' width='40px' height='35px' src='../../imagenes/botonModificar.png'></img></a></td>";
                            echo "<td style='border-right:none; border-left:none;'>"
                                    . "<a href='./eliminar/eliminarCompra.php?idPareja=".$com->getStartNode()->getProperty('idPareja').""
                                    . "&idVestido=".$com->getEndNode()->getProperty('idVestido')."&fecha=".$com->getProperty('fecha')."'>"
                                    . "<img title='Eliminar Compra' width='40px' height='37px' src='../../imagenes/botonEliminar.png'></img></a></td>";
                            echo "<td style='border-right:none; border-left:none;'>"
                                    . "<a href='resumenComisionesCompras.php?idVestido=".$com->getEndNode()->getProperty('idVestido').""
                                    . "&numeroNiveles=".$nodosComisiones->getProperty('nNiveles')."&tipoPorcentaje=".$tipoPorcentaje."'>"
                                    . "<img title='Comisiones de la Compra' width='40px' height='37px' src='../../imagenes/botonComisiones.png'></img></a></td>";
                        echo "</tr>";
                    } 
                ?>
            </table>
        </div>
 
        <!-- Insertamos un botón para volver al menú principal -->
        <div id="divBotonPrincipal">
            <p style="text-align: center; font-size: 20px"><a id="botonMenuPrincipal" href="../../index.html">MENÚ PRINCIPAL</a><p>
        </div>
    </body>
</html>