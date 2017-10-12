<?php

define("path", realpath(__DIR__ . '/..'));

require path . '/vendor/autoload.php';
require 'dbconnection.php';
require 'helpers.php';

$loader = new Twig_Loader_Filesystem(path . '/templates');
$twig = new Twig_Environment($loader, array(
	'cache' => path . '/cache', 
	'debug' => true)
);

$allbooks = $db->query('SELECT * FROM books')->fetchAll();

echo $twig->render('index.twig', array(
	'allbooks' => $allbooks
));

?>