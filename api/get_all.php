<?php
	
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: GET');

	include_once '../includes/connection.php';
	include_once '../includes/articlequery.php';
		$article = new Article();
		$articles = $article->fetch_all();

		$myArray = array();

	    while($row = $articles->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
    	}

    	if (count($myArray)>0) {
    		echo json_encode($myArray);	
    	}else{
    		echo json_encode(array("message"=>"no post found"));
    	}
    	
    	//echo json_encode($myArray);


