<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>CONFIGURACIÓN</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
        <link rel="icon" type="image/png" href="logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="logo/LOGODEFINITIVO.png"/>
        <p id="titulop" style='margin-left: 250px;'> INFORMACIÓN DE COMISIONES </p>
        
        <!-- Hacemos un formulario para mostrar la información de las comisiones. -->
        <form action="insertarPareja.php" method="POST">
            <fieldset>
                
        
        <?php
            //Realizamos la conexión.
            require '../connection.php';
            
            //Consulta con la que vamos a sacar la información de las comisiones.
            $consulta = 'MATCH (n:Comision) RETURN n';
                    
            //Devolvemos el resultado de la consulta y lo guardamos en una variable.
            $resultado = $connection->sendCypherQuery($consulta)->getResult();
                    
            //Con este foreach sacamos las propiedades nNiveles y tipoPorcentaje,
            //que es la información que damos de las comisiones.
            foreach ($resultado->getNodes() as $nodo) {
                $nodo->getProperty('nNiveles');
                $nodo->getProperty('tipoPorcentaje');
            }

            //Aquí mostramos la información, que la obtenemos gracias al foreach
            //anterior.
            echo "<p class='pF'> Número de niveles: <input class='inputComi' style='width: 230px; "
            . "text-align:center;' class'iF' type='text' name='niveles' value='".$nodo->getProperty('nNiveles')."' "
            . "readonly placeholder=' Número de niveles de comisión'></p>";
            //En este caso, para obtener el valor de la propiedad tipoPorcentaje,
            //como es un array, usamos implode.
            //Lo que hace implode es unir los elementos de un array, pudiendo
            //definir el elemento que los separa, en este caso los separamos con 
            //un guión.
            echo "<p class='pF'> Tipo de porcentaje: <input class='inputComi' style='width: 270px;' "
            . "value='". implode(" - ", $nodo->getProperty('tipoPorcentaje'))."' class='iF' type='text' name='porcentaje' "
            . "readonly placeholder=' Tipo de porcentaje por niveles de comisión'></p>";
                    
        ?>     
               
            </fieldset>    
        </form>
            
        <!-- Botón para volver al menú principal -->
        <div id="divBotonPrincipal">
            <p style="text-align: center; font-size: 20px"><a id="botonMenuPrincipal" href="index.html">MENÚ PRINCIPAL</a><p>
        </div>
    </body>
</html>