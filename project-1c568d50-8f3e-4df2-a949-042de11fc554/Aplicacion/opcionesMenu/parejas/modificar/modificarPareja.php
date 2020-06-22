<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>MODIFICAR PAREJA</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../../css/estilo.css">
        <link rel="icon" type="image/png" href="../../../logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="../../../logo/LOGODEFINITIVO.png"/>
        <p id="titulop" style='margin-left: 325px;'> MODIFICAR PAREJA </p>
        
        <?php
            //Realizamos la conexión.
            require '../../../../connection.php';
            
            //Obtenemos el valor de la propiedad idPareja mediante el método
            //GET, que lo pasamos por la URL.
            $idPareja=$_GET['idPareja'];

            //Con esta consulta vemos toda la información de un idPareja concreto.
            //(del que haya venido por el método GET).
            $consulta = "MATCH (n) WHERE n.idPareja='". $idPareja ."' RETURN n";
            
            //Enviamos la consulta y con getResult obtenemos los resultados.
            $resultado = $connection->sendCypherQuery($consulta)->getResult();
            
            //Cogemos todos los nodos.
            $nodos=$resultado->getNodes();
            
            //Cogemos el primero (y único)
            $nodo= reset($nodos);
            
            //Ya podemos llamar a getProperty.
            $valorIdPareja=$nodo->getProperty('idPareja');
            $valorNombre1=$nodo->getProperty('nombre1');
            $valorNombre2=$nodo->getProperty('nombre2');
            $valorDomicilio=$nodo->getProperty('domicilio');
            $valorFechaBoda=$nodo->getProperty('fechaBoda'); 
        ?>
        
        <!-- Hacemos un formulario con el método POST para enviar la información
        a modificarParejas2.php-->
        <form action="modificarPareja2.php" method="POST">
		<fieldset>
                    
                    <!-- Para que modificar sea realmente modificar, cuando
                    pulsamos en el botón de cada uno de los clientes, nos sale
                    la información actual gracias al value.--> 
                    <p class="pF"> idPareja: 
                        <input type="text" name="idPareja" value="<?php echo $nodo->getProperty('idPareja')?>" autofocus="">
                    </p>
                    
                    <p class="pF"> Nombre1: 
                        <input type="text" name="nombre1" value="<?php echo $nodo->getProperty('nombre1')?>">
                    </p>
                    
                    <p class="pF"> Nombre2: 
                        <input type="text" name="nombre2" value="<?php echo $nodo->getProperty('nombre2')?>">
                    </p>
                    
                    <p class="pF"> Domicilio: 
                        <input type="text" size="50px;" name="domicilio" value="<?php echo $nodo->getProperty('domicilio')?>">
                    </p>
                    
                    <p class="pF"> Fecha Boda: 
                        <input type="text" name="fechaBoda" value="<?php echo $nodo->getProperty('fechaBoda')?>">
                    </p>
                    
                    <!-- Botón de modificar. -->
                    <center><p><input id="botonInsertarPareja" type="submit" value="MODIFICAR" name="modificar"/></p></center>
                    
		</fieldset>    
        </form>
        
        <!-- Botón para volver a Parejas. -->
        <div>
            <p style="text-align: center; margin-top: 30px; font-size: 20px"><a id="botonMenuPrincipal" href="../parejas.php">VOLVER A PAREJAS</a><p>
        </div>

    </body>
</html>