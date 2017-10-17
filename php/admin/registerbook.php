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

	$book = array();

	if (is_isbn($isbn))
	{
		$url = "http://libris.kb.se/xsearch?query=$isbn&format=json";
		$obj = json_decode(file_get_contents($url), true);

		if ($obj && $obj["xsearch"] && $obj["xsearch"]["list"] && is_array($obj["xsearch"]["list"]) && $search = $obj["xsearch"]["list"][0]) // disgusting, but must be done somehow
		{
			$book["Title"] = $search["title"] ? $search["title"] : NULL;
			$book["Author"] = $search["creator"] ? $search["creator"] : NULL;
			$book["Language"] = $search["language"] ? $search["language"] : NULL;
			$book["Release Year"] = $search["date"] ? $search["date"] : NULL;

			if (is_array($search["isbn"]))
			{
				if (count($search["isbn"]) == 2)
				{
					if (strlen($search["isbn"][0]) == 10)
					{
						$book["ISBN-10"] = $search["isbn"];
						$book["ISBN-13"] = isbn13_from_isbn10($search["isbn"]);
					}
					else
					{
						$book["ISBN-10"] = isbn10_from_isbn13($search["isbn"]);
						$book["ISBN-13"] = $search["isbn"];
					}
				}
			}
			else // assume every entry has an isbn
			{
				if (strlen($search["isbn"]) === 10)
				{
					$book["ISBN-10"] = $search["isbn"];
					$book["ISBN-13"] = isbn13_from_isbn10($search["isbn"]);
				}
				else
				{
					$book["ISBN-13"] = $search["isbn"];
					$book["ISBN-10"] = isbn10_from_isbn13($search["isbn"]);
				}
			}
		}
	}

	echo $twig->render('registerbook.twig', array(
		"book" => $book,
		"message" => "Found book"
	));
}
else
{
	echo $twig->render('registerbook.twig', array(
		"message" => "No message"
	));
}
?>