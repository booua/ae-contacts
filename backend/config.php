<?php

$config = [
    'session_timeout' => 60 * 60 * 30,
    'token' => '6hDhZ.p6h]RGn!(xp<vo',
    'secret_key' => 'sO6L1x1=E*b,wp>i3?@D',
    'redis' => 'redis://localhost:6379?database=1&password='.urlencode('xy]@6m2NE1S/_NE;H#x]')
];
$f3->set("auth_config", $config);


$db = new DB\SQL(
		    'mysql:host=localhost;port=8889;dbname=companies_data',
		    'root',
		    'root'
		);

$f3->set('DB', $db);
?>
