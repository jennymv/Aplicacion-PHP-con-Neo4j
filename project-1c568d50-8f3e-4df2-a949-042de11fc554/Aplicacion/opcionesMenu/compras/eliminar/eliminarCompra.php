<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> ELIMINAR COMPRA </title>
        <link rel="stylesheet" type="text/css" href="../../../css/estilo.css">
        <link rel="icon" type="image/png" href="../../../logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="../../../logo/LOGODEFINITIVO.png"/>
        
        <?php
            //Realizamos la conexión.
            require '../../../../connection.php';
            
            //Obtenemos el valor de la propiedad idPareja, idVestido y fecha
            //mediante el método GET, que lo pasamos por la URL.
            $idPareja=$_GET['idPareja'];
            $idVestido=$_GET['idVestido'];
            $fecha=$_GET['fecha'];    
        ?>
        
        <!-- Hacemos un formulario con el método POST para enviar la información
        a eliminarrCompra2.php-->
        <form action="eliminarCompra2.php" method="POST">
            <fieldset> 
                <!-- Ponemos input ocultos con los valores de idPAreja, idVestido
                y fecha-->
                <p><input type="hidden" name="idPareja" value="<?php echo $_GET["idPareja"]?>"></p>
                <p><input type="hidden" name="idVestido" value="<?php echo $_GET["idVestido"]?>"></p>
                <p><input type="hidden" name="fecha" value="<?php echo $_GET["fecha"]?>"></p>
                
                <!-- Mostramos un mensaje de advertencia -->
                <center><p id="paviso"> SE VA A ELIMINAR LA COMPRA PARA LA PAREJA CON EL ID '<?php echo $_GET["idPareja"]?>', ¿QUIERE CONTINUAR?</p></center>
                <center><p><input style="font-size: 18px;" type="submit" id="botonInsertarPareja" value="SI" name="eliminar"/>
                
                <!-- Como solo puede haber un input tipo submit, si el usuario
                elige no eliminar la comprs, con onclick podemos mandarlo a donde 
                queramos, en este caso a ver las Compras.-->        
                <input style="font-size: 18px;" type="button" id="botonInsertarPareja" value="No, volver a compras" name="no" 
                       onclick="self.location.href = '../compras.php'" /></p></center>

            </fieldset>    
        </form>

    </body>
</html>