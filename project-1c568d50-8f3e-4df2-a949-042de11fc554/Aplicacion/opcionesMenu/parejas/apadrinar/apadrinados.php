<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>APADRINADOS</title>
        <link rel="stylesheet" type="text/css" href="../../../css/estilo.css">
        <link rel="icon" type="image/png" href="../../../logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="../../../logo/LOGODEFINITIVO.png"/>
        
        <?php
            //Realizamos la consulta.
            require '../../../../connection.php';
                    
            //Obtenemos el valor de la propiedad idPareja mediante el método
            //GET, que lo pasamos por la URL.
            $idPareja=$_GET['idPareja'];
                    
            //Realizamos la conexión.
            require '../../../../connection.php';
          
            
            //Para poder tratar las excepciones o errores hacemos uso del try,
            //cath y finally.
            
            //El try lo que hace es ejecutar el código que vaya dentro de él.            
            try{
                //En $query almacenamos la consulta, que en este caso es para
                //ver las parejas apadrinadas por una pareja.
                $query = "MATCH (n:Pareja)-[r:ApadrinadoPor]->(m:Pareja) WHERE m.idPareja='". $idPareja ."' RETURN  n ORDER BY n.idPareja";
                
                //Con sendCypherQuery mandamos la consulta a la Base de Datos.
                $resultado = $connection->sendCypherQuery($query)->getResult();
                
                //Hacemos una tabla.
                echo "<table style='margin: 0 auto;font-size: 20px; margin-bottom: 10px;'>";
                    echo "<thead>";
                        echo "<caption  style='background-color: #d7cab1; border-top: 3px solid black; font-size: 25px;"
                    . "border-left: 3px solid black; border-right: 3px solid black;'><b>";echo "APADRINADOS POR '". $idPareja ."'"; echo "</b></caption>";
                    echo "</thead>";
                        
                    //Con este foreach obtenemos los nodos que nos devuelve la 
                    //consulta y podemos acceder a las propiedades
                    foreach ($resultado->getNodes() as $rel){
                        echo "<tr>";
                        echo "<td width='50'>"; echo ($rel->getProperty('idPareja')); echo "</td>";
                        echo "<td width='100'>"; echo ($rel->getProperty('nombre1')); echo "</td>";
                        echo "<td width='100'>"; echo ($rel->getProperty('nombre2')); echo "</td>";
                        echo "<td width='400'>"; echo ($rel->getProperty('domicilio')); echo "</td>";
                        echo "<td width='150'>"; echo ($rel->getProperty('fechaBoda')); echo "</td>";
                        echo "</tr>";
                    }
                echo "</table>";
                
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
                echo "ERROR AL VER LAS PAREJAS APADRINADAS"; 
                echo "</p>";
                echo "</br>";
                
            //Este código se va a ejecuytar siempre.
            //Haya un error o no, se mostrará siempre un botón de menú principal
            //y Ver parejas.
            } finally {
                echo "<div style='text-align:center'>";
                echo "<p style='display:inline'><a href='../../../index.html'>" . ""
                        . "<button class='botonesInsertarPD' type='button'>" . "Menú Principal" . "</button></a></p>";
                echo "<p style='display:inline'><a href='../parejas.php'>" . ""
                        . "<button class='botonesInsertarPD' type='button'>" . "Ver parejas" . "</button></a></p>";
                echo "</div>";
            }        
        ?>
        
        
    </body>
</html>