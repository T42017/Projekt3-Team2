<?php

require 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$title = $_POST["title"];
	$creator = $_POST["creator"];
	$isbn10 = $_POST["isbn10"];
	$isbn13 = $_POST["isbn13"];
	$release_year = $_POST["release_year"];
	$language = $_POST["language"];

	if (!isset($title) || !isset($creator) || !isset($isbn10) || !isset($isbn13) || !isset($release_year) || !isset($language))
	{
		echo "some information not found.";
		exit;
	}

	$stmt = $db->prepare("INSERT INTO books (isbn10, isbn13, title, language, release_year) VALUES(:isbn10, :isbn13, :title, :language, :release_year);");
	$stmt->execute(array(
		":isbn10" => $isbn10,
		":isbn13" => $isbn13,
		":title" => $title,
		":language" => $language,
		":release_year" => $release_year
	));
	header("Location: registerbook.php");
}

?>