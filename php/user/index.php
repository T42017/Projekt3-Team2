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
                    $SearchStmt = $db->prepare("SELECT * FROM books WHERE title LIKE :name ");
                    $specialparam = '%'.$search.'%';
                    var_dump($specialparam);

                    $SearchStmt->bindParam(':name', $specialparam); 
                    $SearchStmt->execute();

                    echo $twig->render('index.twig', array('names' => $SearchStmt->fetchAll()));
                }
                else
                {
                    echo $twig->render('index.twig');
                }
                break;
            
            case strpos($parameter, "borrowbook") === 0:
                if(isset($_GET['title']))
                {
                    $title = urldecode($_GET['title']);
                    
                    $BorrowStmt = $db->prepare("SELECT * FROM books WHERE title = :name ");

                    $BorrowStmt->bindParam(':name', $title); 
                    
                    $BorrowStmt->execute();
                    
                    
                    if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        
                        $bookisbn = $BorrowStmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        $BorrowStmt = $db->prepare("UPDATE books SET borrower_social_secuirty_number = :ssn WHERE isbn10 = :bookisbn");
                        
                        $BorrowSsn = htmlspecialchars($_POST['ssn']);
                        
                        $BorrowStmt->bindParam("ssn", $BorrowSsn);
                        $BorrowStmt->bindParam("bookisbn", $bookisbn[0]["isbn10"]);
                
                        $BorrowStmt->execute();
                        
                        $date = date("y/m/d");
                        
                        $AddToHistoryStmt = $db->prepare("INSERT INTO history VALUES(:ssn, :bookisbn, :date)");
                        
                        $AddToHistoryStmt->bindParam("ssn", $_POST['ssn']);
                        $AddToHistoryStmt->bindParam("bookisbn", $bookisbn[0]["isbn10"]);
                        $AddToHistoryStmt->bindParam("date", $date);
                        
                        $AddToHistoryStmt->execute();
                        
                        echo "Du lånar nu boken";
                    }

                    echo $twig->render('borrowbook.twig', array('title' => $BorrowStmt->fetchAll()));
                }
                else
                {
                    echo $twig->render("borrowbook.twig");
                }
                break;
            case strpos($parameter, "history") === 0:
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $HistoryStmt = $db->prepare("Select * FROM history WHERE social_security_number = :ssn");
                    
                    $HistorySsn = htmlspecialchars($_POST['ssn']);
                    
                    $HistoryStmt->bindParam("ssn", $HistorySsn);
                    
                    $HistoryStmt->execute();
                    
                    echo $twig->render('userhistory.twig', array('history' => $HistoryStmt->fetchAll()));
                }
                else
                {
                    echo $twig->render('userhistory.twig');
                }
                
                
                
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