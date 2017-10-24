<?php
    define("path", realpath(__DIR__ . '/../..'));
    
	require path . '/vendor/autoload.php';
	require 'dbconnection.php';
	require 'functions.php';

	$loader = new Twig_Loader_Filesystem(path . '/templates');
	$twig = new Twig_Environment($loader, array('cache' => path . '/cache', 'debug' => true));
	
    $p = GetPermaLink(3);


    function RenderDefault()
    {
        global $twig;
        echo $twig->render('index.twig');
        //render default page / home page..
    }


    if(!empty($p))
    {
        switch($p)
        {
            case 'registerbooks':
                //render register book page
                break;
            case 'removebooks':
                //render remove book page
                break;
                
            case 'borrowedbooks':
                //register borrowed books page
                break;
                
            case 'availablebooks':
                //render available books page
                break;
                
            default:
                //output 404
                break;
        }
    }

    RenderDefault();

?>