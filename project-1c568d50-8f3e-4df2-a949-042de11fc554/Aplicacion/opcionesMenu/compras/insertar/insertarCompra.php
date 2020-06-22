<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>INSERTAR COMPRA</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../../css/estilo.css">
        <link rel="icon" type="image/png" href="../../../logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="../../../logo/LOGODEFINITIVO.png"/>
        <p id="titulop" style='margin-left: 325px;'> INSERTAR COMPRA </p>
        
        <?php
            //Realizamos la conexión.
            require '../../../../connection.php';
  
            //Consulta para las Parejas
            $query1 = "MATCH (n:Pareja) WHERE EXISTS (n.idPareja) RETURN n";
            //Devolvemos el resultado de la consulta y lo guardamos en una variable.
            $resultado1 = $connection->sendCypherQuery($query1)->getResult();
            
            
            //Consulta para los Vestidos. Cogemos aquellos que no han sido comprados.
            $query2 = "MATCH (n:Vestido) WHERE NOT EXISTS {MATCH (a:Pareja)-[:Compra]->(n)} RETURN n";
            //Devolvemos el resultado de la consulta y lo guardamos en una variable.
            $resultado2 = $connection->sendCypherQuery($query2)->getResult(); 
        ?>
        
        <!-- Hacemos un formulario que va a enviar la información a insertarCompra2.php
        mediante el método POST, el nombre que pongamos en name es el que tenemos que
        utilizar en insertarCompra2.php-->
        <form action="insertarCompra2.php" method="POST">
            <fieldset>
                    <!-- Para sacar los id de las Parejas -->
                    <p class="pF"> IdPareja: <select name="idPareja">
                        <?php 
                            foreach ($resultado1->getNodes() as $res) {
                                echo "<option name='idPareja'>";echo ($res->getProperty('idPareja')); echo "</option>";
                            }
                        ?>
                    </select></p>
                    
                    <!-- Para sacar los id de los Vestidos -->
                    <p class="pF"> IdVestido: <select name="idVestido">
                        <?php 
                            foreach ($resultado2->getNodes() as $res2) {
                                echo "<option name='idVestido'>";echo ($res2->getProperty('idVestido')); echo "</option>";
                            }
                        ?>
                    </select></p>
                    <p class="pF"> Fecha Compra: <input class="iF" type="text" name="fecha" placeholder=" Fecha de la Compra"></p>
                    
                    <center><p class="pF"><input id="botonInsertarVestido" type="submit" value="INSERTAR" name="insertar"/></p></center>
                    
            </fieldset>    
        </form>  

        <!-- Botón menú principal -->
        <div>
            <p style="text-align: center; margin-top: 30px; font-size: 20px"><a id="botonMenuPrincipal" href="../compras.php">VOLVER A COMPRAS</a><p>
        </div>
    </body>
</html>