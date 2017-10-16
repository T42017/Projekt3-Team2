<?php
define("path", realpath(__DIR__ . '/../..'));
    
require path . '/vendor/autoload.php';
require 'dbconnection.php';
require path . '/php/user/helpers.php'; #'../user/helpers.php';

$loader = new Twig_Loader_Filesystem(path . '/templates');
$twig = new Twig_Environment($loader, array(
	'cache' => path . '/cache', 
	'debug' => true
));

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$isbn = htmlspecialchars($_POST["isbn"]);

	$array = array(
		"is_isbn" => intval(is_isbn($isbn)),
		"isbn13" => strlen($isbn) == 10 ? isbn13_from_isbn10($isbn) : $isbn,
		"isbn10" => strlen($isbn) == 13 ? isbn10_from_isbn13($isbn) : $isbn
	);

	if (is_isbn($isbn))
	{
		
	}

	echo $twig->render('registerbook.html', array(
		"array" => $array
	));
}
else
{
	echo $twig->render('registerbook.html');
}
?>