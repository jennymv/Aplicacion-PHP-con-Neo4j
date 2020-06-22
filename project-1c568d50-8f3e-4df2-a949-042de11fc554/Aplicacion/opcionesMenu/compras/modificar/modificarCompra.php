<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> MODIFICAR COMPRA </title>
        <link rel="stylesheet" type="text/css" href="../../../css/estilo.css">
        <link rel="icon" type="image/png" href="../../../logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="../../../logo/LOGODEFINITIVO.png"/>
        <p id="titulop" style='margin-left: 325px;'> MODIFICAR COMPRA </p>
        
        <?php
            //Realizamos la conexión.
            require '../../../../connection.php';
            
            //Obtenemos el valor de la propiedad idPareja, idVestido y fecha
            // mediante el método GET, que lo pasamos por la URL.
            $idPareja=$_GET['idPareja'];
            $idVestido=$_GET['idVestido'];
            $fecha=$_GET['fecha'];    
        ?>
        
        <!-- Hacemos un formulario con el método POST para enviar la información
        a modificarCompra2.php-->
        <form action="modificarCompra2.php" method="POST">
            <fieldset> 
                
                <!-- Para que modificar sea realmente modificar, cuando
                pulsamos en el botón de cada una de las compras, nos sale
                a información actual gracias al value.--> 
                <p  class="pF"> idPareja: <input type="text" name="idPareja" value="<?php echo $_GET["idPareja"]?>"></p>
                <p  class="pF"> idVestido: <input type="text" name="idVestido" value="<?php echo $_GET["idVestido"]?>"></p>
                <p  class="pF"> Fecha Compra: <input type="text" name="fecha" value="<?php echo $_GET["fecha"]?>"></p>
                
                <!-- Botón de modificar. -->
                <center><p><input type="submit" id="botonInsertarPareja" value="MODIFICAR" name="modificar"/></p></center>

            </fieldset>    
        </form>
        
        <!-- Botón para volver a Compras. -->
        <div>
            <p style="text-align: center; margin-top: 30px; font-size: 20px"><a id="botonMenuPrincipal" href="../compras.php">VOLVER A COMPRAS</a><p>
        </div>

    </body>
</html>