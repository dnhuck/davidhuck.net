<?php

session_start();

    if(!$_SESSION['validUser'] == true){
        header('Location: ../html/login.php');
    }

require 'selectProduct.php';

$inProductImage = "";
$inProductName = "";
$inProductPrice = "";
$inProductDescription = "";
$inProductBuyNowButton = "";
$inProductBuyNowButton2 = "";
$inProductAddToCartButton = "";
$inProductViewCart= "";

$inProductImageErrMsg = "";
$inProductNameErrMsg = "";
$inProductPriceErrMsg = "";
$inProductDescriptionErrMsg = "";
$inProductBuyNowButtonErrMsg= "";
$inProductBuyNowButton2ErrMsg= "";
$inProductAddToCartErrMsg= "";
$inProductViewCartErrMsg= "";

if(isset($_POST["submit"]))
	{
		// capturing the values of the form inputs
		$inProductImage= $_FILES['productImage']['name'];
		$inProductName = $_POST["productName"];
		$inProductPrice = $_POST["productPrice"];
        $inProductDescription = $_POST["productDescription"];
        $inProductBuyNowButton = $_POST["productBuyNow"];
        $inProductAddToCart= $_POST["addToCart"];
        $inProductBuyNowButton2=$_POST["productBuyNow2"];
        $inProductViewCart= $_POST["viewCart"];

        $target = "../images/".basename($_FILES['productImage']['name']);

        require 'PDOconnection.php';
        require 'insertProduct.php';

        if(move_uploaded_file($_FILES['productImage']['tmp_name'], $target)){
            $msg = 'Success';
        }else{
            $msg = 'Fail';
        }
	
        $validForm = true; // sets a flag/switch to make sure data is valid
        // PHP validation goes here
		
		if($validForm){
			
                require('PDOconnection.php');
                //echo '<script>alert("valid")</script>';
			
			} else{
			
			// BAD BAD Data - Display error message, display form to user
			// 1. bad name
				// put data on the form
				// put error messege on the form
                $inProductPriceErrMsg = "Invalid Product Price";
                $inProductNameErrMsg = "Invalid Product Name";	
                $inProductPriceErrMsg = "Invalid Product Price";
                $inProductDescriptionErrMsg = "Invalid Product Description";
                $inProductBuyNowButtonErrMsg = "Invalid button code";	
                $inProductAddToCartErrMsg = "Invalid Add to cart code";
                $inProductViewCartErrMsg = "invalid view card code";
                $inProductBuyNowButton2ErrMsg = "invalid buy now button code";
                    	
				}
	
	}else{
		}
?>
<!doctype html>
<html>
<head>

<!-- Meta Data -->
<meta charset="UTF-8">
<meta name="description" content="photography">
<meta name="author" content="david huck photography">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Product Form</title>

<!-- JavaScript -->
<script  src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="../js/userNav.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<!-- CSS -->
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>

    <div id="userNav"></div>


    <div id="container" class="p-3 col-9 m-auto">

    <form method="POST" action="addProduct.php" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">
        <h1>Add Product:</h1>
        
        <div class="form-group">
            <label for="productImage">Product Image</label>
            <input type="file" class="form-control" id="productImage" name="productImage">
        </div>

        <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter Product Name" value="<?php echo $inProductName; ?>" required><span><?php echo $inProductNameErrMsg; ?> </span>
        </div>

        <div class="form-group">
            <label for="productPrice">Product Price</label>
            <input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="Enter Product Price" value="<?php echo $inProductPrice; ?>" required><span><?php echo $inProductPriceErrMsg; ?> </span>
        </div>

        <div class="form-group">
            <label for="productDescription">Product Description</label>
            <textarea class="form-control" id="productDescription" name="productDescription" placeholder="What is the picture?" value="<?php echo $inProductDescription; ?>" required></textarea><span><?php echo $inProductDescriptionErrMsg; ?>
        </div>

        <div class="form-group">
            <label for="productBuyNow">Buy Now Online </label>
            <textarea class="form-control" id="productBuyNow" name="productBuyNow" placeholder="buy now button code" value="<?php echo $inProductBuyNowButton; ?>"></textarea><span><?php echo $inProductBuyNowButtonErrMsg; ?>
        </div>

        <div class="form-group">
            <label for="productBuyNow2">Buy Now Paper print</label>
            <textarea class="form-control" id="productBuyNow2" name="productBuyNow2" placeholder="buy now physical print button code" value="<?php echo $inProductBuyNowButton2; ?>"></textarea><span><?php echo $inProductBuyNowButton2ErrMsg; ?>
        </div>

        <div class="form-group">
            <label for="addToCart">online Add To Cart</label>
            <textarea class="form-control" id="addToCart" name="addToCart" placeholder="add to cart button code" value="<?php echo $inProductAddToCart; ?>" required></textarea><span><?php echo $inProductAddToCartErrMsg; ?>
        </div>

        <div class="form-group">
            <label for="viewCart">Paper print add to cart</label>
            <textarea class="form-control" id="viewCart" name="viewCart" placeholder="view cart button code" value="<?php echo $inProductViewCart; ?>" required></textarea><span><?php echo $inProductViewCartErrMsg; ?>
        </div>


        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>

        </div>

        <div id="logout">
                <a href="logout.php">Logout</a>
        </div>
        
	</div>
</body>
</html>