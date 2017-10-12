<?php
	require __DIR__ . '/vendor/autoload.php';
	$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
	$twig = new Twig_Environment($loader, array('cache' => __DIR__ . '/cache', 'debug' => true));
	
    $libraryPDO = new PDO('mysql:host=localhost;dbname=biblioteksystem;charset=utf8mb4', 'root', '');

    if(isset($_GET['search']))
	{
		$stmt = $libraryPDO->prepare('SELECT * FROM books WHERE Name = :name');
		$stmt->bindParam(':name',$_GET['search']); 
		$stmt->execute();
        
        echo $twig->render('index.twig', 
		array(
			'names' => $stmt->fetchAll(),
			));
	}
?>