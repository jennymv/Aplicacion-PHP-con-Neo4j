<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PAREJAS</title>
        <link rel="stylesheet" type="text/css" href="../../css/estilo.css">
        <link rel="icon" type="image/png" href="../../logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="../../logo/LOGODEFINITIVO.png"/>
        <p id="titulop"> GESTIÓN DE PAREJAS </p>

        <div style="margin: 0 auto; width:1050px; height: 400px; overflow-y:scroll;">
            <table style="margin: auto; width: 1000px;  margin-right: 190px;">
  		<thead>
  			<th  style='font-size: 20px;'>idPareja</th>
  			<th  style='font-size: 20px;'>Nombre1</th>
  			<th  style='font-size: 20px;'>Nombre2</th>
  			<th  style='font-size: 20px;'>Domicilio</th>
                        <th  style='font-size: 20px;'>FechaBoda</th>
                        <th  style='font-size: 20px;'>Padrino</th>
                        <th colspan="4"> <a href="./insertar/insertarPareja.html">
                            <img title="Añadir Pareja" width='40px' height='40px' 
                                 src='../../imagenes/botonAñadir.png'/>
                            </a> Insertar Pareja</th>
  		</thead>
                
                <?php
                    //Realizamos la conexión.
                    require '../../../connection.php';
                    
                    //Incluimos las funciones.
                    require '../funcionesComisionesJaime.php';
                    
                    //Consulta con la que vamos a trabajar.
                    $consulta = 'MATCH (n:Pareja) RETURN DISTINCT n';
                    
                    //Devolvemos el resultado de la consulta y lo guardamos en una variable.
                    $resultado = $connection->sendCypherQuery($consulta)->getResult();
                    
                    
                    //Construimos la tabla.
                    foreach ($resultado->getNodes() as $nodo) {
                        echo "<tr>";
                            //Mediante getProperty llegamos a las propiedades del nodo
                            //que está almacenado en la variable.
                            echo "<td  style='font-size: 20px;'>"; echo ($nodo->getProperty('idPareja')); echo "</td>";
                            echo "<td  style='font-size: 20px;'>"; echo ($nodo->getProperty('nombre1')); echo "</td>";
                            echo "<td  style='font-size: 20px;'>"; echo ($nodo->getProperty('nombre2')); echo "</td>";
                            echo "<td  style='font-size: 20px;'>"; echo ($nodo->getProperty('domicilio')); echo "</td>";
                            echo "<td  style='font-size: 20px;'>"; echo ($nodo->getProperty('fechaBoda')); echo "</td>";
                            //Declaramos la variable $pareja, que se va a usar en la función
                            //para sacar el id de la Pareja Padrina.
                            $pareja=$nodo->getProperty('idPareja');
                            
                            //Llamamos a la función padrino, para que nos muestre el mismo.
                            echo "<td  style='font-size: 20px;'>"; echo padrino($pareja, $connection); echo "</td>";
  
                            //Botones de modificar, eliminar, comisiones y apadrinados.
                            //Para poder llevar desde esta página a otra por el método
                            //get los datos, metemos las variables en la URL.
                            echo "<td style='border-right:none; border-left:none;' title='Modificar Pareja'>"
                                    . "<a href='./modificar/modificarPareja.php?idPareja=".$nodo->getProperty('idPareja')."'>"
                                    . "<img width='40px' height='35px' src='../../imagenes/botonModificar.png'></img></a></td>";
                            echo "<td style='border-right:none; border-left:none;' title='Eliminar Pareja'>"
                                    . "<a href='./eliminar/eliminarPareja.php?idPareja=".$nodo->getProperty('idPareja')."'>"
                                    . "<img width='40px' height='37px' src='../../imagenes/botonEliminar.png'></img></a></td>";
                            echo "<td style='border-right:none; border-left:none;' title='Ver comisiones de la Pareja'>"
                                    . "<a href='resumenComisionesParejas.php?idPareja=".$nodo->getProperty('idPareja')."'>"
                                    . "<img width='40px' height='37px' src='../../imagenes/botonComisiones.png'></img></a></td>";
                            echo "<td style='border-right:none; border-left:none;' title='Apadrinados por la Pareja'>"
                                    . "<a href='./apadrinar/apadrinados.php?idPareja=".$nodo->getProperty('idPareja')."'>"
                                    . "<img width='40px' height='40px' src='../../imagenes/botonApadrinados.png'></img></a></td>";
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