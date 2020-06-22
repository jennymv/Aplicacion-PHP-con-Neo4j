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
        <p id="titulop" style='margin-left: 275px;'> RESUMEN DE COMISIONES </p>

                <?php
                    //echo "<pre>";
                    //error_reporting(0);
                
                    //Realizamos la conexión
                    require '../../../connection.php';
                    require '../funcionesComisionesJaime.php';
                    
                    //Obtenemos los valores que nos vienen por el método GET.
                    $idVestido=$_GET['idVestido'];
                    $numeroNiveles=$_GET['numeroNiveles'];
                    
                    //Deshacemos el trabajo hecho por serialize.
                    $porcentajes = unserialize($_GET['tipoPorcentaje']);
                    
                    //Llamamos a la función que nos calcula las comisiones.
                    $comisiones= comisionCompra($idVestido, $numeroNiveles, $porcentajes, $connection);
                    
                    //En caso de que no haya comisiones mostramos un mensaje.
                    if ($comisiones == NULL) {
                        echo "<center><p  id='pNoComisiones'> NO EXISTEN COMISIONES "
                        . "PARA ESTA COMPRA. </p></center>";
                        //En caso de que si haya...
                    } else {
                        //Construimos la tabla de las comisiones.
                        echo "<center><table id='tablaComisiones'>";
                            echo "<th  class='tituloTablaCC'> Pareja </th>";
                            echo "<th  class='tituloTablaCC'> Comisión </th>";
                        foreach ($comisiones as $indice => $valor) {
                            echo "<tr>";
                            echo "<td>"; echo $indice; echo "</td>";
                            echo "<td>"; echo $valor; echo " €"; echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table></center>";
                      }
                ?>
        
        
        </br>
        <div id="divBotonPrincipal">
            <p style="text-align: center; font-size: 20px"><a id="botonMenuPrincipal" href="compras.php">VOLVER A COMPRAS</a><p>
                </br>
            <p style="text-align: center; font-size: 20px"><a id="botonMenuPrincipal" href="../../index.html">MENÚ PRINCIPAL</a><p>
        </div>
    </body>
</html>