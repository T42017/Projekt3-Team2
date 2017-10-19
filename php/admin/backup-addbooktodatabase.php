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
	$title = $_POST["Title"];
	$creator = htmlspecialchars($_POST["Author"]);

	if (preg_match('~[0-9]~', $creator) == 1)
	{
		$creator = substr($creator, 0, strrpos($creator, ","));
	}

	$isbn10 = $_POST["ISBN-10"];
	$isbn13 = $_POST["ISBN-13"];
	$release_year = $_POST["Released"];
	$language = $_POST["Language"];

	if (!isset($title) || !isset($creator) || !isset($isbn10) || !isset($isbn13) || !isset($release_year) || !isset($language))
	{
		echo "some information not found.";
		exit;
	}

	$get_author_stmt = $db->prepare("SELECT * FROM authors WHERE name = :name");
	$get_author_stmt->execute(array(
		":name" => $creator
	));
	$author_id = $get_author_stmt->fetch(PDO::FETCH_ASSOC);

	if ($get_author_stmt->rowCount() === 0)
	{
		$insert_author_stmt = $db->prepare("INSERT INTO authors VALUES(NULL, :name)");
		$insert_author_stmt->execute(array(
			":name" => $creator
		));
	}

	$get_book_stmt = $db->prepare("SELECT * FROM books WHERE isbn10 = :isbn10");
	$get_book_stmt->execute(array(
		":isbn10" => htmlspecialchars($isbn10)
	));

	if ($get_book_stmt->rowCount() !== 0)
	{
		echo $twig->render("registerbook.twig", array(
			"message" => "Book already exists in database."
		));
		exit;
	}

	$query = "INSERT INTO books (isbn10, isbn13, title, language, release_year) VALUES(:isbn10, :isbn13, :title, :language, :release_year);";
	$insert_book_stmt = $db->prepare($query);
	$insert_book_stmt->execute(array(
		":isbn10" => $isbn10,
		":isbn13" => $isbn13,
		":title" => $title,
		":language" => $language,
		":release_year" => $release_year
	));

	echo "statement: "; var_dump($get_author_stmt);
	echo "<br />";
	echo $creator;
	echo "<br />";
	echo "author_id: "; var_dump($author_id);
	echo "<br />";
	echo "row count: "; var_dump($get_author_stmt->rowCount());

	if ($insert_book_stmt)
	{
		$add_relation_stmt = $db->prepare("INSERT INTO author_writes_book VALUES(:isbn10, :id)");
		$add_relation_stmt->execute(array(
			":isbn10" => $isbn10,
			":id" => $author_id
		));

		echo "<br />isbn: $isbn10<br />author_id: $author_id";

		echo $twig->render("registerbook.twig");
		exit;
	}
	else
	{
		echo $twig->render("registerbook.twig", array(
			"message" => "Statement failed."
		));
		exit;
	}
}

?>