<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> ELIMINAR PAREJA </title>
        <link rel="stylesheet" type="text/css" href="../../../css/estilo.css">
        <link rel="icon" type="image/png" href="../../../logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="../../../logo/LOGODEFINITIVO.png"/>
        
        <?php
            //Realizamos la conexión.
            require '../../../../connection.php';
            
            //Obtenemos el valor de la propiedad idPareja mediante el método
            //GET, que lo pasamos por la URL.
            $idPareja=$_GET['idPareja'];
            
            //Con esta consulta vemos toda la información de un idPareja concreto.
            //(del que haya venido por el método GET).
            $consulta="MATCH (n) WHERE n.idPareja='". $idPareja ."' RETURN n";
            
            //Enviamos la consulta y con getResult obtenemos los resultados.
            $resultado = $connection->sendCypherQuery($consulta)->getResult();
            
            //Cogemos todos los nodos.
            $nodos=$resultado->getNodes();
            
            //Cogemos el primero (y único)
            $nodo= reset($nodos);
            
            //Ya podemos llamar a getProperty.
            $valorIdPareja=$nodo->getProperty('idPareja');
        ?>
        
        <!-- Hacemos un formulario con el método POST para enviar la información
        a eliminarrParejas2.php-->
        <form action="eliminarPareja2.php" method="POST">
            <fieldset> 
                <!-- Ponemos un input oculto que tenga como value el idPareja -->
                <input type="hidden" name="idPareja" value="<?php echo $nodo->getProperty('idPareja')?>" autofocus=""> 
                
                <!-- Mostramos un mensaje de advertencia -->
                <center><p id="paviso"> SE VA A ELIMINAR LA PAREJA CON EL ID '<?php echo $nodo->getProperty('idPareja')?>', ¿QUIERE CONTINUAR?</p></center>
                <center><p><input style="font-size: 18px;" type="submit" id="botonInsertarPareja" value="SI" name="eliminar"/>
                
                <!-- Como solo puede haber un input tipo submit, si el usuario
                elige no eliminar la Pareja, con onclick podemos mandarlo a donde 
                queramos, en este caso a ver las Parejas.-->
                <input style="font-size: 18px;" type="button" id="botonInsertarPareja" value="No, volver a parejas" name="no" 
                       onclick="self.location.href = '../parejas.php'" /></p></center>

            </fieldset>    
        </form>
        
    </body>
</html>