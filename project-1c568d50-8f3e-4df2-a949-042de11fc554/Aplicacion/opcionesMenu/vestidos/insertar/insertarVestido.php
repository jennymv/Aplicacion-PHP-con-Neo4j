<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> INSERTAR VESTIDO </title>
        <link rel="stylesheet" type="text/css" href="../../../css/estilo.css">
        <link rel="icon" type="image/png" href="../../../logo/favicon.png">
    </head>
    <body>
        <img id="logopareja" src="../../../logo/LOGODEFINITIVO.png"/>
        <?php
            //Realizamos la conexión.
            require '../../../../connection.php';
            
            //Recogemos los datos del formulario, que han sido enviados por el 
            //método POST.
            $idVestido=$_POST["idVestido"];
            $descripcion=$_POST["descripcion"];
            $precio=$_POST["precio"];
            

            //Para poder tratar las excepciones o errores hacemos uso del try,
            //cath y finally.
            
            //El try lo que hace es ejecutar el código que vaya dentro de él.
            try {
                //En $query almacenamos la consulta, que en este caso es para
                //insertar un vestido.
                $query = "CREATE (".$idVestido.":Vestido {idVestido:'".$idVestido."', "
                        . "descripcion:'".$descripcion."', precio:'".$precio."'})";
                
                //Con sendCypherQuery mandamos la consulta a la Base de Datos.
                $connection->sendCypherQuery($query);
                
                //Si lo anterior se ejecuta correctamente, significa que ha ido
                //bien. Incluyo una pequeña imagen y texto informativo.
                echo "<div style='text-align:center'>";
                echo "<img src='../../../imagenes/bien.png' width='90px' height='90px'>";
                echo "</div>";
                echo "<p id='tInsertado'>"; 
                echo "VESTIDO INSERTADO CORRECTAMENTE";
                echo "</p>";
                echo "</br>";
            
            //Si hay algún error nos salta esta excepción.
            } catch (Exception $e){
                //Este echo mostraría el error específico de Neo4j al realizar
                //la consulta, como es una interfaz sencilla, dejo el código
                //pero pongo mi propio mensaje de error, en caso de querer ver
                //el error que nos da Neo4j, descomentamos la siguiente línea.
                //echo $e->getMessage(); 
                //Si se ejecuta este código, es que algo ha ido mal. 
                echo "<div style='text-align:center' >";
                echo "<img src='../../../imagenes/error.png' width='90px' height='90px'>";
                echo "</div>";
                echo "<p id='tError'>";
                echo "ERROR AL INSERTAR. EL VESTIDO CON EL ID '". $idVestido ."' YA EXISTE."; 
                echo "</p>";
                echo "</br>";
                
            //Este código se va a ejecuytar siempre.
            //Haya un error o no, se mostrará siempre un botón de Ver vestidos o 
            //de insertar uno nuevo.    
            } finally {
                echo "<div style='text-align:center'>";
                echo "<p style='display:inline'><a href='insertarVestido.html'>" . ""
                        . "<button class='botonesInsertarVD' type='button'>" . "Insertar Vestido" . ""
                        . "</button></a></p>";
                echo "<p style='display:inline'><a href='../vestidos.php'>" . "<button "
                        . "class='botonesInsertarVD' type='button'>" . "Ver vestidos" . "</button></a></p>";
                echo "</div>";
            }
        ?>

    </body>
</html>