<?php

function comisionCompra($idVestido, $numeroNiveles, $porcentajes, $connection) {
    //primero vamos a buscar la pareja que hizo la compra y el precio, todo esto,
    //lo mismo se obtiene de la págiuna de compras, cuanod se llama al boton,
    // o lo mismo no te hace falta una fucnción y puedes meter el códifo...
    // en fin yo voy a ver si me aclaro..

    $consulta = "MATCH (p:Pareja)-[r:Compra]->(v:Vestido) where v.idVestido='" .
            $idVestido . "'  RETURN p.idPareja as pareja,v.precio as precio";
    $resultado = $connection->sendCypherQuery($consulta)->getResult();

    //empezamos por la pareja que ha comprado el vestido
    $idPareja = $resultado->get('pareja');
    //cogemos el precio ...y le quitamos el € 
    $precio = str_replace("€","",$resultado->get('precio'));
    //var_dump($precio);
    // buscar los ancestros!!
    $comisiones = array();

    $nivel = 0;

    do {
        $padrino = padrino($idPareja, $connection);
        if ($padrino !== null) {
            $valorComision = $precio * $porcentajes[$nivel] / 100;
            $comisiones[$padrino] = $valorComision;
            $idPareja=$padrino;
            $nivel++;
        }
    } while (($padrino!==null) && ($nivel < $numeroNiveles));
    return $comisiones;
}

function padrino($pareja, $connection) {
    $consulta = 'MATCH (n:Pareja)-[r:ApadrinadoPor]->(m:Pareja) WHERE n.idPareja="' .
            $pareja . '" RETURN  m.idPareja AS parejaPadrina';
    $resultado = $connection->sendCypherQuery($consulta)->getResult();
    return $resultado->get('parejaPadrina');
}


function comisionesPorPareja($idPareja, $numeroNiveles, $porcentajes, $connection){
    $comisiones = array();
    //obtenemos los vestidos que se han vendido...
    $consulta = 'MATCH ()-[r:Compra]->(v:Vestido) RETURN v';
    $resultado = $connection->sendCypherQuery($consulta)->getResult();
    $nodos=$resultado->getNodes();
    foreach ($nodos as $nodo){
        $IdVestido= $nodo->getProperty('idVestido');
        //vemos las comisiones del vestido
        $comisionesVestido= comisionCompra($IdVestido,$numeroNiveles,$porcentajes,$connection);
        //comprobamos si nuestra $idPareja está en las comisiones
        if (array_key_exists ( $idPareja , $comisionesVestido )){
            $comisiones[$IdVestido]=$comisionesVestido[$idPareja];
        }
    }
    return $comisiones;
    //MATCH (p:Pareja)-[r:Compra]->(v:Vestido) RETURN v LIMIT 25
    //recorremos los nodos y
    //para cada vestido tenemos un array con sus comisiones
    //si aparece la pareja $idPareja, bingos!, añadimos el idvestido y el valor de la comisión!
    //del tipo comisiones[$idVestido]=valorComision...
}