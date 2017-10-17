<?php
    define("path", realpath(__DIR__ . '/../..'));
    
	require path . '/vendor/autoload.php';
	require 'dbconnection.php';
    require 'functions.php';

	$loader = new Twig_Loader_Filesystem(path . '/templates');
	$twig = new Twig_Environment($loader, array('cache' => path . '/cache', 'debug' => true));
	
    $parameter = GetPermaLink(3);


    function RenderDefault()
    {
        global $db, $twig;
        
        if(isset($_GET['s']))
        {
            $search = urldecode($_GET['s']);
            //$param = htmlspecialchars(str_replace('+', ' ', $_GET['search']));
            $stmt = $db->prepare("SELECT * FROM books WHERE title = :name ");
            $specialparam = '%'.$search;

            $stmt->bindParam(':name', $search); 
            $stmt->execute();

            echo $twig->render('index.twig', 
            array(
                'names' => $stmt->fetchAll(),
                ));
        }
        else
        {
            $stmt = $db->query('SELECT * FROM books');
            echo $twig->render('index.twig', array(
                'names' => $stmt->fetchAll()
            ));
        }
    }

    if(!empty($parameter))
    {
        switch($parameter)
        {
            case 'search':
                if(isset($_GET['s']))
        {
            $search = urldecode($_GET['s']);
            //$param = htmlspecialchars(str_replace('+', ' ', $_GET['search']));
            $stmt = $db->prepare("SELECT * FROM books WHERE title = :name ");
            $specialparam = '%'.$search;

            $stmt->bindParam(':name', $search); 
            $stmt->execute();

            echo $twig->render('index.twig', 
            array(
                'names' => $stmt->fetchAll(),
                ));
        }
        else
        {
            $stmt = $db->query('SELECT * FROM books');
            echo $twig->render('index.twig', array(
                'names' => $stmt->fetchAll()
            ));
        }
                echo "search";
                exit;
                break;
            case 'borrow':
                $id = GetPermaLink(4);
                echo "borrow";
                // if ulr like .. /admin/delete/{id}
                break;
            case 'history':
                echo "history";
                break;
            default:
                //output 404 not found or default template..
                RenderDefault();
                break;
        }
    }
    else
    {
        RenderDefault();
    }
?>