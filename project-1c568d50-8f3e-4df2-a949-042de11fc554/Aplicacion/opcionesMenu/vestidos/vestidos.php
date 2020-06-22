<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>VESTIDOS</title>
        <link rel="stylesheet" type="text/css" href="../../css/estilo.css">
        <link rel="icon" type="image/png" href="../../logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="../../logo/LOGODEFINITIVO.png"/>
        <p id="titulop"> GESTIÓN DE VESTIDOS </p>
        <div style="margin: 0 auto; width:1000px; height: 400px; overflow-y:scroll;">
            <table style="margin: auto; width: 800px;">
  		<thead>
  			<th  style='font-size: 20px;'>idVestido</th>
  			<th  style='font-size: 20px;'>Descripción</th>
  			<th  style='font-size: 20px;'>Precio</th>
                        <th colspan="2"> 
                            <a href="./insertar/insertarVestido.html">
                                <img title="Añadir Vestido" width='40px' height='40px' src='../../imagenes/botonAñadir.png'/>
                            </a>
                        </th>
                        
  		</thead>
                <?php
                    //Realizamos la conexión.
                    require '../../../connection.php';
                    
                    //Consulta con la que vamos a trabajar.
                    $consulta = 'MATCH (n:Vestido) RETURN n';
                    
                    //Devolvemos el resultado de la consulta y lo guardamos en una variable.
                    $resultado = $connection->sendCypherQuery($consulta)->getResult();
                   
                    //Construimos la tabla.
                    foreach ($resultado->getNodes() as $nodo) {
                        echo "<tr>";
                            //Mediante getProperty llegamos a las propiedades del nodo
                            //que está almacenado en la variable.
                            echo "<td style='font-size: 20px;'>"; echo ($nodo->getProperty('idVestido')); echo "</td>";
                            echo "<td style='font-size: 20px;'>"; echo ($nodo->getProperty('descripcion')); echo "</td>";
                            echo "<td style='font-size: 20px;'>"; echo ($nodo->getProperty('precio')); echo "</td>";
                            
                            //Botones de modificar y eliminar.
                            //Para poder llevar desde esta página a otra por el método
                            //get los datos, metemos las variables en la URL.
                            echo "<td style='border-right:none; border-left:none;'><a "
                            . "href='./modificar/modificarVestido.php?idVestido=".$nodo->getProperty('idVestido')."'>"
                                    . "<img title='Modificar Vestido' width='40px' height='35px' src='../../imagenes/botonModificar.png'>"
                                    . "</img></a></td>";
                            echo "<td style='border-right:none; border-left:none;'>"
                            . "<a href='./eliminar/eliminarVestido.php?idVestido=".$nodo->getProperty('idVestido')."'>"
                                    . "<img title='Eliminar Vestido' width='40px' height='37px' src='../../imagenes/botonEliminar.png'>"
                                    . "</img></a></td>";
                        echo "</tr>";
                    } 
                ?>
            </table>
        </div>
        
        <!-- Insertamos un botón para volver al menú principal -->
        <div>
            <p style="text-align: center; margin-top: 30px; font-size: 20px"><a id="botonMenuPrincipal" href="../../index.html">
                    MENÚ PRINCIPAL</a><p>
        </div>
    </body>
</html>