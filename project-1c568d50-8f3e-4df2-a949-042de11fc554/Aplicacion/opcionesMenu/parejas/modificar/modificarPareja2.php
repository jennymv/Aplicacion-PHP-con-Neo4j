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
        
        <?php
            //Realizamos la conexión.
            require '../../../../connection.php';
            
            //Obtenemos los datos por el método POST, definido en el formulario
            //de modificarPareja.php
            $idPareja=$_POST["idPareja"];
            $nombre1=$_POST["nombre1"];
            $nombre2=$_POST["nombre2"];
            $domicilio=$_POST["domicilio"];
            $fechaBoda=$_POST["fechaBoda"];    
            
        
            //Para poder tratar las excepciones o errores hacemos uso del try,
            //cath y finally.
            
            //El try lo que hace es ejecutar el código que vaya dentro de él.
            try{
                //En $query almacenamos la consulta, que en este caso es para
                //actualizar una pareja.
                $query = "MATCH (n) WHERE n.idPareja='". $idPareja ."' "
                        . "SET n.nombre1='". $nombre1 ."', n.nombre2='". $nombre2 ."', "
                        . "n.domicilio='". $domicilio ."', n.fechaBoda='". $fechaBoda ."'";
                
                //Con sendCypherQuery mandamos la consulta a la Base de Datos.
                $connection->sendCypherQuery($query);
                
                //Si lo anterior se ejecuta correctamente, significa que ha ido
                //bien. Incluyo una pequeña imagen y texto informativo.
                echo "<div style='text-align:center'>";
                echo "<img src='../../../imagenes/bien.png' width='90px' height='90px'>";
                echo "</div>";
                echo "<p id='tInsertado'>"; echo "PAREJA MODIFICADA CORRECTAMENTE"; echo "</p>";
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
                echo "ERROR AL MODIFICAR PAREJA"; 
                echo "</p>";
                echo "</br>";
                
            //Este código se va a ejecuytar siempre.
            //Haya un error o no, se mostrará siempre un botón de Ver parejas.
            } finally {
                echo "<div style='text-align:center'>";
                echo "<p style='display:inline'><a href='../parejas.php'>" . ""
                        . "<button class='botonesInsertarPD' type='button'>" . "Ver parejas" . "</button></a></p>";
                echo "</div>";
            } 
        ?>

    </body>
</html>