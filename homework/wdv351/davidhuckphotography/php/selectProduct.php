<?php

session_start();

	try {

		require 'PDOconnection.php';	//CONNECT to the database		

		$sql = "(SELECT product_ID, product_image, product_Name, product_Price, product_Description, product_BuyNow, product_BuyNow2, product_AddToCart, product_ViewCart FROM dhp)";	// selecting the data from the database
	  
		//PREPARE the SQL statement
		$stmt = $conn->prepare($sql);
		
		//EXECUTE the prepared statement
		$stmt->execute();		
		
		//Prepared statement result will deliver an associative array
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
	}
	
	catch(PDOException $e)
	{
		$message = "There has been a problem . Please try again later.";
		echo $message;
  
		error_log($e->getMessage()); //Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
		error_log($e->getLine());
		error_log(var_dump(debug_backtrace()));
	
		//Clean up any variables or connections that have been left hanging by this error.		
	
		//header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
	}
	
?>
