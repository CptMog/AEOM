<?php

$pdo = new PDO
	(
		'mysql:host=localhost;dbname=aeom;charset=UTF8',
		'djawad',
		'djawad1996',
	    [
	    	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	    ]
    );


?>