<?php
    define("path", realpath(__DIR__ . '/..'));
    
	require path . '/vendor/autoload.php';
	$loader = new Twig_Loader_Filesystem(path . '/templates');
	$twig = new Twig_Environment($loader, array('cache' => path . '/cache', 'debug' => true));
	
    $libraryPDO = new PDO('mysql:host=localhost;dbname=library;charset=utf8mb4', 'root', '');

    if(isset($_GET['search']))
	{
        $search = urldecode($_GET['search']);
        //$param = htmlspecialchars(str_replace('+', ' ', $_GET['search']));
		$stmt = $libraryPDO->prepare("SELECT * FROM books WHERE title = :name ");
        $specialparam = '%'.$search;
        
        var_dump($specialparam);
        
		$stmt->bindParam(':name', $search); 
		$stmt->execute();
        
        
        
        echo $twig->render('index.twig', 
		array(
			'names' => $stmt->fetchAll(),
			));
	}
	else
	{
		echo $twig->render('index.twig');
	}
?>