<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>MODIFICAR VESTIDO</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../../css/estilo.css">
        <link rel="icon" type="image/png" href="../../../logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="../../../logo/LOGODEFINITIVO.png"/>
        <p id="titulop" style='margin-left: 325px;'> MODIFICAR VESTIDO </p>
        
        <?php
            //Realizamos la conexión.
            require '../../../../connection.php';
            
            //Obtenemos el valor de la propiedad idVestido mediante el método
            //GET, que lo pasamos por la URL.
            $idVestido=$_GET['idVestido'];
            
            //Con esta consulta vemos toda la información de un idVestido concreto.
            //(del que haya venido por el método GET).
            $consulta = "MATCH (n) WHERE n.idVestido='". $idVestido ."' RETURN n";
                    
            //Enviamos la consulta y con getResult obtenemos los resultados.
            $resultado = $connection->sendCypherQuery($consulta)->getResult();
            
            //Cogemos todos los nodos.
            $nodos=$resultado->getNodes();
            
            //Cogemos el primero (y único)
            $nodo= reset($nodos);
            
            //Ya podemos llamar a getProperty.
            $valorIdVestido=$nodo->getProperty('idVestido');
            $valorDescripcion=$nodo->getProperty('descripcion');
            $valorPrecio=$nodo->getProperty('precio');
        ?>
        
        <!-- Hacemos un formulario con el método POST para enviar la información
        a modificarVestido2.php-->
        <form action="modificarVestido2.php" method="POST">
		<fieldset>
                    
                    <!-- Para que modificar sea realmente modificar, cuando
                    pulsamos en el botón de cada uno de los vestidos, nos sale
                    la información actual gracias al value.-->
                    <p class="pF"> idVestido: <input type="text" name="idVestido" 
                                                    value="<?php echo $nodo->getProperty('idVestido')?>" autofocus=""></p>
                    <p class="pF"> Descripción: <input style="width: 350px;" type="text" name="descripcion" 
                                                    value="<?php echo $nodo->getProperty('descripcion')?>"></p>
                    <p class="pF"> Precio: <input type="text" name="precio" 
                                                    value="<?php echo $nodo->getProperty('precio')?>"></p>
                    
                    <!-- Botón de modificar. -->
                    <center><p><input type="submit" id="botonInsertarPareja" value="MODIFICAR" name="modificar"/></p></center>
                    
		</fieldset>    
        </form>
        
        <!-- Botón para volver a Parejas. -->
        <div>
            <p style="text-align: center; margin-top: 30px; font-size: 20px"><a id="botonMenuPrincipal" href="../vestidos.php">VOLVER A VESTIDOS</a><p>
        </div>

    </body>
</html>
