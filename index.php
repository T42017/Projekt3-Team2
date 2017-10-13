<?php
	require __DIR__ . '/vendor/autoload.php';
	$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
	$twig = new Twig_Environment($loader, array('cache' => __DIR__ . '/cache', 'debug' => true));

    $libraryPDO = new PDO('mysql:host=localhost;dbname=biblioteksystem;charset=utf8mb4', 'root', '');

    function GetPermaLink($skip = 0)
    {
	   $path = ltrim($_SERVER['REQUEST_URI'], '/');
	   $elements = explode('/', $path);
	

        
	   if(empty($elements[0]))
	   {
		  return null;
	   }
	   else
	   {
		  for($i=0; $i< $skip;$i++)
			array_shift($elements);
		
		  $req = array_shift($elements);
		  return strtolower($req);
	   }
    }

    $search = GetPermaLink(2);

    if(isset($_GET['s'])){
        $tmpSearch = urldecode($_GET['s']);
        $stmt = $libraryPDO->prepare('SELECT * FROM books WHERE Name LIKE :name');
        $searchparam = '%'.$tmpSearch.'%';
        $stmt->bindParam(':name', $searchparam);
        $stmt->execute();
        
        echo $twig->render('index.twig', 
		array(
			'names' => $stmt->fetchAll(),
			));
    } else{
        echo $twig->render('index.twig');
    }

    /*
    if(!empty($search))
    {
        $search = urldecode($search);
        $stmt = $libraryPDO->prepare('SELECT * FROM books WHERE Name LIKE :name');
        $searchparam = '%'.$search.'%';
        $stmt->bindParam(':name', $searchparam);
        $stmt->execute();
        
        echo $twig->render('index.twig', 
		array(
			'names' => $stmt->fetchAll(),
			));
    } else{
        echo $twig->render('index.twig');
    }
    */
?>