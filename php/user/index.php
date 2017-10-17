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
        global $twig;
        
        echo $twig->render('index.twig');
        
        //render default page
    }

    if(!empty($parameter))
    {
        switch($parameter)
        {
            case strpos($parameter, "search") === 0:
                if(isset($_GET['s']))
                {
                    $search = urldecode($_GET['s']);
                    $stmt = $db->prepare("SELECT * FROM books WHERE title = :name ");
                    $specialparam = '%'.$search;

                    $stmt->bindParam(':name', $search); 
                    $stmt->execute();

                    echo $twig->render('index.twig', array('names' => $stmt->fetchAll()));
                }
                else
                {
                    echo $twig->render('index.twig');
                }
                break;
            
            case 'borrow':
                //render borrow page
                break;
            case 'history':
                //render user history page
                break;
            default:
                //output 404
                break;
        }
    }
    else
    {
        RenderDefault();
    }
?>