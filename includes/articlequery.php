<?php
		
/**
		 * 
		 */
		class Article 
		{
			public function fetch_all()
			{
					global $conn;
				    
				    $sql="SELECT * FROM post;";
    				$result=mysqli_query($conn,$sql) or die($conn);
    				return $result;
			}

			public function fetch_data($post_id)			
			{
					global $conn;
				    
				    $sql="SELECT * FROM post WHERE post.id=$post_id;";
    				$result=mysqli_query($conn,$sql);
    				return mysqli_fetch_assoc($result);	
			}
			
		}		