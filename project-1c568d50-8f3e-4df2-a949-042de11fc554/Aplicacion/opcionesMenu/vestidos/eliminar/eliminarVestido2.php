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
            
            //Obtenemos los datos por el método POST, definido en el formulario
            //de eliminarVestido.php
            $idVestido=$_POST["idVestido"];
            
            
            //Para poder tratar las excepciones o errores hacemos uso del try,
            //cath y finally.
            
            //El try lo que hace es ejecutar el código que vaya dentro de él.
            try{
                //En $query almacenamos la consulta, que en este caso es para
                //eliminar un vestido.
                $query = "MATCH (n) WHERE n.idVestido='".$idVestido."' DETACH DELETE n";
                
                //Con sendCypherQuery mandamos la consulta a la Base de Datos.
                $connection->sendCypherQuery($query);
                
                //Si lo anterior se ejecuta correctamente, significa que ha ido
                //bien. Incluyo una pequeña imagen y texto informativo.
                echo "<div style='text-align:center'>";
                echo "<img src='../../../imagenes/bien.png' width='90px' height='90px'>";
                echo "</div>";
                echo "<p id='tInsertado'>"; echo "VESTIDO CON ID '". $idVestido ."' ELIMINADO CORRECTAMENTE"; echo "</p>";
                echo "</br>";
                
            //Si hay algún error nos salta esta excepción.
            }  catch (Exception $e){
                //Este echo mostraría el error específico de Neo4j al realizar
                //la consulta, como es una interfaz sencilla, dejo el código
                //pero pongo mi propio mensaje de error. En caso de querer ver
                //el error que nos da Neo4j, descomentamos la siguiente línea.
                //echo $e->getMessage(); 
                //Si se ejecuta este código, es que algo ha ido mal. 
                echo "<div style='text-align:center' >";
                echo "<img src='../../../imagenes/error.png' width='90px' height='90px'>";
                echo "</div>";
                echo "<p id='tError'>"; 
                echo "ERROR AL ELIMINAR VESTIDO"; 
                echo "</p>";
                echo "</br>";
                
            //Este código se va a ejecuytar siempre.
            //Haya un error o no, se mostrará siempre un botón de menú principal
            //y Ver vestidos.
            } finally {
                echo "<div style='text-align:center'>";
                echo "<p style='display:inline'><a href='../../../index.html'>" . ""
                        . "<button class='botonesInsertarPD' type='button'>" . "Menú Principal" . "</button></a></p>";
                echo "<p style='display:inline'><a href='../vestidos.php'>" . ""
                        . "<button class='botonesInsertarPD' type='button'>" . "Ver vestidos" . "</button></a></p>";
                echo "</div>";
            }
        ?>

    </body>
</html>