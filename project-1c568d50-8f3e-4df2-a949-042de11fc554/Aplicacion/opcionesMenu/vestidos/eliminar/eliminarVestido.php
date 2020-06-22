<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> ELIMINAR VESTIDO </title>
        <link rel="stylesheet" type="text/css" href="../../../css/estilo.css">
        <link rel="icon" type="image/png" href="../../../logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="../../../logo/LOGODEFINITIVO.png"/>
        <?php
            //Realizamos la conexión.
            require '../../../../connection.php';
            
            //Obtenemos el valor de la propiedad idVestido mediante el método
            //GET, que lo pasamos por la URL.
            $idVestido=$_GET['idVestido'];
            
            //Con esta consulta vemos toda la información de un idVestido concreto.
            //(del que haya venido por el método GET).
            $consulta="MATCH (n) WHERE n.idVestido='". $idVestido ."' RETURN n";
            
            //Enviamos la consulta y con getResult obtenemos los resultados.
            $resultado = $connection->sendCypherQuery($consulta)->getResult();
            
            //Cogemos todos los nodos.
            $nodos=$resultado->getNodes();
            
            //Cogemos el primero (y único)
            $nodo= reset($nodos);
            
            //Ya podemos llamar a getProperty.
            $valorIdVestido=$nodo->getProperty('idVestido');
        ?>
        
        <!-- Hacemos un formulario con el método POST para enviar la información
        a eliminarVestidos2.php-->
        <form action="eliminarVestido2.php" method="POST">
            <fieldset> 
                <!-- Ponemos un input oculto que tenga como value el idVestido -->
                <input type="hidden" name="idVestido" value="<?php echo $nodo->getProperty('idVestido')?>" autofocus=""> 
                
                <!-- Mostramos un mensaje de advertencia -->
                <center><p id="paviso"> SE VA A ELIMINAR EL VESTIDO CON EL ID '<?php echo $nodo->getProperty('idVestido')?>', ¿QUIERE CONTINUAR?</p></center>
                <center><p><input style="font-size: 18px;" type="submit" id="botonInsertarPareja" value="SI" name="eliminar"/>
                
                <!-- Como solo puede haber un input tipo submit, si el usuario
                elige no eliminar el Vestido, con onclick podemos mandarlo a donde 
                queramos, en este caso a ver los Vestidos.-->       
                <input style="font-size: 18px;" type="button" id="botonInsertarPareja" value="No, volver a vestidos" name="no" 
                       onclick="self.location.href = '../vestidos.php'" /></p></center>

            </fieldset>    
        </form>
        
    </body>
</html>