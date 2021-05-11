<?php
	
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: GET');

	include_once '../includes/connection.php';
	include_once '../includes/articlequery.php';
		
		if (isset($_GET['id'])) {
					
			$article = new Article();
			$articles = $article->fetch_data($_GET['id']);			

		    //while($row = $articles->fetch_array(MYSQLI_ASSOC)) {
    	      //  $myArray[] = $row;
    		//}

    		if (count($articles)>0) {
	    		echo json_encode($articles);	
    		}else{
    			echo json_encode(array("message"=>"no post found"));
    		}

    	}else{
    		echo json_encode(array("message"=>"no id found"));
    	}


