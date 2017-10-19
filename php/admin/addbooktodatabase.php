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



if ($_SERVER["REQUEST_METHOD"] === "POST")
{
	$title = htmlspecialchars($_POST["Title"]);
	$author = htmlspecialchars($_POST["Author"]);
	if (preg_match('~[0-9]~', $author) == 1)
	{
		$author = substr($author, 0, strrpos($author, ","));
	}
	$language = htmlspecialchars($_POST["Language"]);
	$released = htmlspecialchars($_POST["Released"]);
	$isbn13 = htmlspecialchars($_POST["ISBN-13"]);
	$isbn10 = htmlspecialchars($_POST["ISBN-10"]);

	if (!isset($title))
	{
		echo $twig->render("registerbook.twig", array(
			"message" => "title not found"
		));
		exit;
	}

	if (!isset($author))
	{
		echo $twig->render("registerbook.twig", array(
			"message" => "author not found"
		));
		exit;
	}

	if (!isset($language))
	{
		echo $twig->render("registerbook.twig", array(
			"message" => "language not found"
		));
		exit;
	}

	if (!isset($isbn13))
	{
		echo $twig->render("registerbook.twig", array(
			"message" => "isbn13 not found"
		));
		exit;
	}

	if (!isset($isbn10))
	{
		echo $twig->render("registerbook.twig", array(
			"message" => "isbn10 not found"
		));
		exit;
	}

	$stmt = $db->prepare("SELECT * FROM books WHERE isbn13 = :isbn13"); // find book in database
	$stmt->execute(array(
		":isbn13" => $isbn13
	));

	if ($stmt->rowCount() === 0) // if book does not exist in database
	{
		$stmt = $db->prepare("INSERT INTO books VALUES (:isbn10, :isbn13, :title, :language, :release_year, :borrower_social_secuirty_number);");
		$stmt->execute(array(
			":isbn10" => $isbn10,
			":isbn13" => $isbn13,
			":title" => $title,
			":language" => $language,
			":release_year" => $released,
			":borrower_social_secuirty_number" => NULL
		));

		$stmt = $db->prepare("SELECT * FROM authors WHERE name = :name;");
		$stmt->execute(array(
			":name" => $author
		));

		if ($stmt->rowCount() === 0) // if author does not exist in database
		{
			$stmt = $db->prepare("INSERT INTO authors VALUES (NULL, :name);");
			$stmt->execute(array(
				":name" => $author
			));
		}

		$stmt = $db->prepare("SELECT * FROM authors WHERE name = :name;");
		$stmt->execute(array(
			":name" => $author
		));

		$author_id = $stmt->fetch(PDO::FETCH_ASSOC)["id"];

		if ($author_id) // if author's id could be found
		{
			$stmt = $db->prepare("SELECT * FROM author_writes_book WHERE author_id = :author_id AND isbn10 = :isbn10;");
			$stmt->execute(array(
				":author_id" => $author_id,
				":isbn10" => $isbn10
			));

			if ($stmt->rowCount() === 0) // if relation between author and book does not exist in database
			{
				$stmt = $db->prepare("INSERT INTO author_writes_book VALUES (:isbn10, :author_id);");
				$stmt->execute(array(
					":isbn10" => $isbn10,
					":author_id" => $author_id
				));

				echo $twig->render("registerbook.twig", array(
					"message" => "book, author, and relation inserted"
				));
				exit;
			}
			else // if relation betweeen author and book is already in database
			{
				echo $twig->render("registerbook.twig", array(
					"message" => "relation already found"
				));
			}
		}
		else // if authour's id could not be found
		{
			echo $twig->render("registerbook.twig", array(
				"message" => "author id not found"
			));
			exit;
		}


		echo $twig->render("registerbook.twig", array(
			"message" => "book inserted"
		));
		exit;
	}
	else // if book is already in database
	{
		echo $twig->render("registerbook.twig", array(
			"message" => "already in database"
		));
		exit;
	}
}

?>