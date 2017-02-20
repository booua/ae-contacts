<?php

$db = new DB\SQL(
		    'mysql:host=localhost;port=8889;dbname=companies_data',
		    'root',
		    'root'
		);

$f3->set('DB', $db);
?>
