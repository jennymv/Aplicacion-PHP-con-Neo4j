<?php	
	use Neoxygen\NeoClient\ClientBuilder;

	require 'vendor/autoload.php';
	
	$connection = ClientBuilder::create()
	  ->addConnection('default', 'http', 'localhost', 7474)
	  ->setAutoFormatResponse(true)
	  ->build();
	
	/*
	if ($connection == true ){
		echo "CONEXIÓN ESTALECIDA CON ÉXITO";
	}
	*/
	
	/*
	$query = "CREATE (johndoe: Person {name: 'John Doe', 
    					born: 1950}
    			)";
    $connection->sendCypherQuery($query);
	*/
?>